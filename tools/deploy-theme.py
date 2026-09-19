"""Deploy an explicit theme-file allowlist, with backups and live conflict checks."""
import argparse
import io
import re
import subprocess
import zipfile
from datetime import datetime
from pathlib import Path

import paramiko
import requests
from bs4 import BeautifulSoup

ROOT = Path(__file__).resolve().parents[1]
PREFIX = 'public_html/wp-content/themes/dicey/'
FILES = [
    'assets/styles/main.css', 'assets/js/main.js', 'inc/products.php',
    'inc/commerce.php', 'template-parts/product/single-content.php',
]
PREVIEW_FILES = FILES

def normalized(value):
    return value.replace('\r\n', '\n').rstrip() + '\n'

def backup(contents, target):
    folder = ROOT / '.codex' / 'backups'
    folder.mkdir(parents=True, exist_ok=True)
    path = folder / (datetime.now().strftime('%Y%m%d-%H%M%S') + '-' + target + '-theme.zip')
    with zipfile.ZipFile(path, 'w', zipfile.ZIP_DEFLATED) as archive:
        for name, data in contents.items():
            archive.writestr(name, data)
    print('Backup:', path)

def preview():
    env_path = Path(r'C:\Users\CrazyStudio\AppData\Local\CrazyAssistant\creds\card-52.env')
    env = dict(line.split('=', 1) for line in env_path.read_text(encoding='utf-8-sig').splitlines()
               if '=' in line and not line.startswith('#'))
    transport = paramiko.Transport((env['SFTP_HOST'], int(env['SFTP_PORT'])))
    transport.connect(username=env['SFTP_USER'], password=env['SFTP_PASSWORD'])
    sftp = paramiko.SFTPClient.from_transport(transport)
    base = env['SFTP_DIR'].rstrip('/') + '/wp-content/themes/dicey/'
    originals = {}
    try:
        for name in PREVIEW_FILES:
            with sftp.open(base + name, 'rb') as source:
                originals[name] = source.read()
        backup(originals, 'preview')
        for name in PREVIEW_FILES:
            data = (ROOT / PREFIX / name).read_bytes()
            sftp.putfo(io.BytesIO(data), base + name)
            with sftp.open(base + name, 'rb') as source:
                assert source.read() == data, 'Readback mismatch: ' + name
            print('Verified:', name)
    finally:
        sftp.close()
        transport.close()

def live(baseline):
    journal = (ROOT / '.codex/context/journal.md').read_text(encoding='utf-8')
    password = re.search(r'Логин:\s*dicey_admin\s+Пароль:\s*(\S+)', journal).group(1)
    session = requests.Session()
    site = 'https://daysi.ru'
    session.get(site + '/wp-login.php', timeout=30).raise_for_status()
    session.post(site + '/wp-login.php', data={'log': 'dicey_admin', 'pwd': password, 'testcookie': '1'}, timeout=30).raise_for_status()

    def read(name):
        response = session.get(site + '/wp-admin/theme-editor.php', params={'file': name, 'theme': 'dicey'}, timeout=30)
        response.raise_for_status()
        soup = BeautifulSoup(response.text, 'html.parser')
        source = soup.select_one('#newcontent')
        assert source is not None, 'Theme editor unavailable'
        return normalized(source.text), soup

    originals = {}
    for name in FILES:
        current, _ = read(name)
        expected = subprocess.check_output(['git', 'show', baseline + ':' + PREFIX + name], cwd=ROOT).decode('utf-8')
        assert current == normalized(expected), 'Concurrent live edit: ' + name
        originals[name] = current
    backup(originals, 'live')

    for name in FILES:
        current, soup = read(name)
        assert current == originals[name], 'Concurrent live edit: ' + name
        desired = normalized((ROOT / PREFIX / name).read_text(encoding='utf-8'))
        form = soup.select_one('form#template')
        assert form is not None, 'Editor form unavailable'
        fields = {el['name']: el.get('value', '') for el in form.select('input[name]')}
        fields.update({'action': 'edit-theme-plugin-file', 'file': name, 'theme': 'dicey', 'newcontent': desired})
        # Core's authenticated editor API performs its own PHP fatal-error rollback.
        nonce = form.select_one('input[name="nonce"]')
        assert nonce is not None, 'Editor nonce unavailable'
        fields['nonce'] = nonce.get('value', '')
        response = session.post(site + '/wp-admin/admin-ajax.php', data=fields, timeout=60)
        response.raise_for_status()
        result = response.json()
        assert result.get('success'), 'WordPress rejected update: ' + name + ' ' + str(result.get('data'))
        actual, _ = read(name)
        assert actual == desired, 'Readback mismatch: ' + name
        print('Verified:', name, flush=True)
    print('Live theme deployment verified.')

if __name__ == '__main__':
    parser = argparse.ArgumentParser()
    parser.add_argument('target', choices=['preview', 'live'])
    parser.add_argument('--baseline', default='aeb7ef0')
    args = parser.parse_args()
    if args.target == 'preview':
        preview()
    else:
        live(args.baseline)
