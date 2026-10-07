# Partnership dropdown — October 7

Roman's message 410 reports that the partnership form's topic dropdown is hidden in iPhone Safari. The supplied screenshot shows the expanded arrow and the message textarea covering the dropdown area.

## Change and release

- Code commit: `1567e39`, pushed to `origin/main`.
- Only public theme change: `.contacts-form .select-box[open] { z-index: 1; }` in `assets/styles/main.css`. This gives the open topic list an explicit stacking level above the following textarea. No markup, option text, JavaScript, or form submission changes.
- Live CSS matched the local baseline `df666f0`. The deployment tool checked it again before updating and verified readback.
- Backup: `.codex/backups/20261007-132421-live-theme.zip`.
- Deployment allowlist now contains only `assets/styles/main.css`. Use an explicit current baseline for any future release.

## Evidence and limits

- tinycss2 structural comparison passed: exactly one added rule with one z-index declaration, all existing rules unchanged. Deployment script Python syntax and `git diff --check` passed.
- Production in-app Browser at an observed 375 CSS-pixel viewport: eight existing options present, expanded select has computed z-index 1. Clicking `Оставить отзыв` and then the bottom option `Письмо директору` updates the visible label and closes the list. No form submitted.
- Chromium already displayed the list before the fix. The iPhone Safari screenshot and missing stacking level support the fix, but this does not constitute reproducing or verifying the Safari-specific defect. Ask Roman to recheck on the affected iPhone.
- Browser package 26.1002.51308 has an empty skills directory. Existing deferred `mcp__node_repl__js` still works: import `setupBrowserRuntime`, assign its return value to `agent`, select `agent.browsers.get('iab')`, read `iab.documentation()`. No approval or DPAPI error occurred; no alternate browser surface used. Temporary viewport reset and tab closed.
- No additional full-resolution images attached: this long-lived task is at its image limit. Source screenshot remains in synchronized media `2026-10-07/410-photo.jpg`.
- Existing untracked `docs/HANDOFF.md` and `tools/__pycache__/` preserved. Synchronized `.codex/context/` untouched.
