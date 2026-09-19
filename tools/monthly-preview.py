"""Run preview-only QA via authenticated SSH; no public debug endpoint."""
import sys
from pathlib import Path
import paramiko
sys.stdout.reconfigure(encoding='utf-8')
sys.stderr.reconfigure(encoding='utf-8')

root = Path(__file__).resolve().parents[1]
env_path = Path(r'C:\Users\CrazyStudio\AppData\Local\CrazyAssistant\creds\card-52.env')
env = dict(line.split('=', 1) for line in env_path.read_text(encoding='utf-8-sig').splitlines()
           if '=' in line and not line.startswith('#'))
transport = paramiko.Transport((env['SFTP_HOST'], int(env['SFTP_PORT'])))
try:
    transport.connect(username=env['SFTP_USER'], password=env['SFTP_PASSWORD'])
    channel = transport.open_session()
    mode = sys.argv[1] if len(sys.argv) > 1 else 'inspect'
    assert mode in ('inspect', 'setup', 'verify')
    channel.exec_command('/usr/local/bin/php8.2 -d display_errors=stderr -- ' + mode)
    channel.sendall((root / 'tools/monthly-preview.php').read_bytes())
    channel.shutdown_write()
    stdout = channel.makefile('r').read().decode('utf-8', errors='replace')
    stderr = channel.makefile_stderr('r').read().decode('utf-8', errors='replace')
    print(stdout)
    if stderr:
        print(stderr, file=sys.stderr)
    sys.exit(channel.recv_exit_status())
finally:
    transport.close()
