"""Import Roman's September 28 certificate batch without replacing existing content."""
import argparse
import json
import re
from pathlib import Path

import requests

ROOT = Path(__file__).resolve().parents[1]
BACKUP = ROOT / '.codex/backups/20260929-certificates'
SOURCE = ROOT / 'docs/verification/2026-09-29/certificates'
SITE = 'https://daysi.ru'
MESSAGES = [401, 402, 403, 404, 405, 408]


def session():
    journal = (ROOT / '.codex/context/journal.md').read_text(encoding='utf-8')
    password = re.search(r'Логин:\s*dicey_admin\s+Пароль:\s*(\S+)', journal).group(1)
    client = requests.Session()
    client.get(SITE + '/wp-login.php', timeout=30).raise_for_status()
    client.post(SITE + '/wp-login.php', data={'log': 'dicey_admin', 'pwd': password, 'testcookie': '1'}, timeout=30).raise_for_status()
    response = client.get(SITE + '/wp-admin/', timeout=30)
    response.raise_for_status()
    match = re.search(r'wpApiSettings\s*=\s*({.*?});', response.text)
    nonce = json.loads(match.group(1))['nonce'] if match else None
    if nonce is None:
        match = re.search(r'createNonceMiddleware\(\s*[\"\x27]([^\"\x27]+)', response.text)
        nonce = match.group(1) if match else None
    assert nonce, 'REST nonce unavailable'
    client.headers['X-WP-Nonce'] = nonce
    return client


def request(client, method, endpoint, **kwargs):
    response = client.request(method, SITE + '/wp-json/wp/v2/' + endpoint, timeout=60, **kwargs)
    response.raise_for_status()
    return response.json()


def block(raw):
    matches = list(re.finditer(r'<!-- wp:dicey/dietology\s+(\{.*?\})\s*/-->', raw, re.S))
    assert len(matches) == 1, 'Expected exactly one existing dietology block'
    match = matches[0]
    return match, json.loads(match.group(1))


def main(mode):
    original = json.loads((BACKUP / 'page.json').read_text(encoding='utf-8'))
    client = session()
    page_id = original['id']
    original_raw = original['content']['raw']
    current = request(client, 'GET', f'pages/{page_id}', params={'context': 'edit'})
    manifest_path = BACKUP / 'uploads.json'
    uploads = json.loads(manifest_path.read_text(encoding='utf-8')) if manifest_path.exists() else []
    if mode == 'prepare':
        assert current['content']['raw'] == original_raw, 'Page changed since backup; stop to preserve edits'
        for message in MESSAGES:
            if any(item['message'] == message for item in uploads):
                continue
            slug = f'daysi-natalia-certificate-{message}'
            found = request(client, 'GET', 'media', params={'slug': slug})
            assert len(found) <= 1
            if found:
                media = found[0]
            else:
                with (SOURCE / f'{message}-document.jpg').open('rb') as photo:
                    media = request(client, 'POST', 'media', files={'file': (slug + '.jpg', photo, 'image/jpeg')},
                                    data={'title': f'Сертификат Натальи Босуновой — {message}', 'slug': slug,
                                          'alt_text': 'Сертификат Натальи Босуновой'})
            uploads.append({'message': message, 'id': media['id'], 'url': media['source_url']})
            manifest_path.write_text(json.dumps(uploads, ensure_ascii=False, indent=2), encoding='utf-8')
            print('Uploaded certificate', message, 'media', media['id'], flush=True)
        print('Prepared six media attachments; page has not changed.')
        return
    assert [item['message'] for item in uploads] == MESSAGES, 'Incomplete certificate batch'
    match, attrs = block(original_raw)
    existing = attrs['plan_certificates']
    assert existing == [{'image': '717'}, {'image': '718'}], 'Unexpected original certificates'
    attrs['plan_certificates'] = existing + [{'image': str(item['id'])} for item in uploads]
    replacement = json.dumps(attrs, ensure_ascii=False, separators=(',', ':'))
    replacement = replacement.replace('--', '\\u002d\\u002d').replace('<', '\\u003c').replace('>', '\\u003e').replace('&', '\\u0026')
    desired = original_raw[:match.start(1)] + replacement + original_raw[match.end(1):]
    if mode == 'apply' and current['content']['raw'] != desired:
        assert current['content']['raw'] == original_raw, 'Concurrent page edit; no write performed'
        request(client, 'POST', f'pages/{page_id}', json={'content': desired})
    actual = request(client, 'GET', f'pages/{page_id}', params={'context': 'edit'})
    assert actual['content']['raw'] == desired, 'Page readback mismatch'
    assert actual['status'] == original['status'], 'Page status changed'
    (BACKUP / 'page-after.json').write_text(json.dumps(actual, ensure_ascii=False, indent=2), encoding='utf-8')
    print('Verified page', page_id, ': original two certificates plus six new certificates; all other content preserved.')


if __name__ == '__main__':
    parser = argparse.ArgumentParser()
    parser.add_argument('mode', choices=['prepare', 'apply', 'verify'])
    main(parser.parse_args().mode)
