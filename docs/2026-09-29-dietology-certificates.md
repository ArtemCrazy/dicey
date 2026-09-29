# Dietology certificate gallery — September 29

Roman's message 408 (September 28), with images 401–405 and 408, is implemented and published. Previous monthly-replacement work remains unchanged.

## Result

- The Gutenberg Dietology block now has an unlimited certificate list with media-library upload/replacement, up/down ordering, removal and addition.
- Explicitly empty lists remain empty when the editor is reopened; legacy pages without the attribute retain their two defaults.
- Only the first two nonempty certificates appear as thumbnails in the original layout. All remaining entries join the existing Fancybox gallery without adding visible images or preloading all full-resolution scans.
- Both thumbnails and “Смотреть все сертификаты” open the same gallery. No additional gallery library or stylesheet was needed.
- Production page 27 retains existing media 717 and 718 in first and second position. Six distinct supplied scans were added as media 727–732; the gallery contains eight documents. Supplied images were preserved as received, including the orientation of message 404.
- The only changed content attribute is `plan_certificates`; the rest of the block attributes and all surrounding page content were checked unchanged. WordPress normalizes some JSON escaping; the import tool verifies parsed attributes plus exact surrounding content.

## Release

- Code commit: `18c6210`, pushed to `origin/main`.
- Deployed files: `blocks/index.js`, `inc/dietology-renderers.php`. Their live originals matched `7debd3b` before writing; updated contents were read back successfully.
- Theme backup: `.codex/backups/20260929-133815-live-theme.zip`.
- Original page and media-import manifest: `.codex/backups/20260929-certificates/`.
- `tools/deploy-theme.py` currently allows only those two files; the next release must set its own allowlist and actual deployed baseline.
- `tools/certificates-content.py` is specific to this imported batch. Do not use it to replace future client edits. It stops on unexpected page changes.

## Verification

- `node tests/dietology-certificates.js`: actual editor callbacks tested for add, replacement, order, removal, empty-list roundtrip and legacy defaults.
- `tests/dietology-certificates.php` ran against the real preview WordPress via SSH stdin: eight gallery links, two thumbnails, six hidden links, order, empty and partially empty lists, view-all target and legacy defaults. It changed no database records.
- Touched-file PHP/JS syntax and `git diff --check` passed.
- Production in-app Browser: “Смотреть все” opens slide 1/8; slide 8/8 loads successfully; the second thumbnail opens 2/8. Exactly two visible thumbnail links remain.
- At the confirmed 390 × 844 viewport, the final certificate loads and fits at 382 × 286.5 CSS pixels. Evidence: `verification/2026-09-29/certificates-gallery-mobile.jpg`.
- Admin limitation: existing credentials log into WordPress successfully, but the in-app Browser renders the Gutenberg `editor-canvas` blob iframe blank, including after reload; no console error was returned. Live manual interaction with the new admin controls could not be verified. The editor callback tests and real WordPress renderer tests passed. No unrelated browser/editor settings were changed to bypass this limitation.

## Continuation

- Latest handled client message: 408. The synchronized `.codex/context/` was read only.
- Existing untracked `docs/HANDOFF.md` and `tools/__pycache__/` were preserved.
- Original six supplied images and their media URL manifest are saved under `docs/verification/2026-09-29/certificates/`, outside the synchronized context.
- This task has accumulated images close to the global transcript limit. Avoid reattaching old images; use durable files and compact contact sheets. Further bulk image work should continue in a fresh task with this report as context.
