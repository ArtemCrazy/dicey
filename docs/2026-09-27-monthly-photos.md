# Monthly replacement photos — September 27

Roman's message 399 reports cropped food photos in the monthly replacement picker on mobile.

## Change and release

- The original 768 × 576 photos were displayed with `object-fit: cover` inside 310 × 180 mobile frames, cropping the top and bottom.
- Scoped `.dicey-monthly-modal .carte-modal__img` to `object-fit: contain`. Existing frame dimensions, layout, original images and replacement logic are preserved. Photos now fit completely and appear smaller on mobile.
- Preserved the existing production `.contacts__icon` change in commit `3a699a4` before applying the fix.
- Published code: `5457c5b`, pushed to `origin/main`. Only `assets/styles/main.css` was deployed, after a live-content comparison with `3a699a4`.
- Private backup: `.codex/backups/20260927-000915-live-theme.zip`. WordPress editor readback matched the desired CSS.
- Deployment allowlist now targets this CSS file; an explicit `--baseline` is required. Future releases must update the allowlist and choose the actual deployed baseline rather than repeating this release.

## Verification

- Parsed the exact CSS delta with tinycss2; confirmed that image containment is the only change relative to the captured production stylesheet. Deployment-script syntax and `git diff --check` passed.
- Post-deploy in-app Browser, product 698, mobile viewport requested at 390 × 844: all six images loaded and computed to `contain`. Screenshot confirms full trays without cropping.
- Replacing the second block with beef changes the total from 40,800 to 40,070 RUB and leaves the other five blocks unchanged.
- Default desktop viewport: all six images remain contained in 312 × 306 frames; visually checked.
- No production cart, order, payment or product metadata was submitted or changed. No physical iPhone Safari check was performed.
- Evidence: `verification/2026-09-27/monthly-photos-mobile.jpg` and `verification/2026-09-27/monthly-photos-desktop.jpg`.

The original untracked `docs/HANDOFF.md` remains untouched. The synchronized client journal was read only.
