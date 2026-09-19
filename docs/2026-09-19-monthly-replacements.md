# Monthly product-menu replacements

## Contract

- One explicit `_dicey_monthly_replacements` product-meta allowlist per source product. No category, breed, age or weight inference.
- A month contains six ordered five-day blocks. Each slot can select the source or an allowed product, including repeated alternatives.
- Prices come from the existing five-day menu calculation (or a priced five-day WooCommerce variation). Posted prices are never trusted.
- Alternatives must be published, purchasable, in stock, without quantity-based stock management, and have the source's tax class/status. Stock-managed component inventory is not implemented by this composite cart line, so those menus are deliberately not offered.
- Existing 3/5-day selection and monthly orders without replacements remain compatible.
- Session/totals revalidate selections. Checkout and order-line creation reject removed/unavailable alternatives and stale prices.
- Cart and checkout show six day ranges, product names and block prices. Order items store six human-readable metadata rows plus a structured `_dicey_monthly_blocks` snapshot containing IDs, variation IDs, dishes, slot and prices.

## Admin and customer check

1. WordPress → Products → edit the original menu.
2. Find **Замены рационов на месяц** → expand **Выбрать меню для замены**.
3. Select the permitted product-menus and update the product. The box has its own nonce and is independent of Carbon Fields.
4. Open that menu on the site, select **1 месяц**, then **Заменить рацион** on any of the six blocks.
5. Add to basket; check day ranges, chosen names and total. An empty allowlist leaves replacement buttons disabled.

Production allowlists were not populated with arbitrary menus. Client-approved nutritional choices must be selected by the administrator.

## Evidence

- `php tests/monthly-replacements.php`: 17 existing + 34 monthly focused assertions passed.
- PHP syntax: products.php, commerce.php, single-content.php; Node syntax: main.js.
- `python tools/monthly-preview.py verify`: actual Carbon Fields/WP admin registration and nonce-protected save; actual Woo cart/totals/checkout validation and unsaved order-line metadata; actual monthly variation and rejection of mismatched five-day variation.
- In-app Browser: source 15,000 → one replacement 15,100 → repeated alternative in another slot 15,200. Switching to 3 days restores 1,200; switching back retains monthly choices. Basket reload and checkout both retain all six blocks and 15,200.
- Mobile 390×844: sixth-slot replacement, selectable dialog, close/focus return and no final horizontal overflow of the drawer. Uses existing Ivan drawer/button styling.
- No real order or payment created. The preview intentionally has no active bank gateway.

## Preview fixtures and release scope

Preview only: hidden-from-standard-catalog products 164 (source), 165 (allowed +100), 166 (not allowed). They remain available for demonstration at `http://korovai.crazytest.ru/daysi/?post_type=product&p=164`.
The custom theme may still list these preview fixtures in its own related-product queries; none were created on production.

QA runs through authenticated SSH stdin with PHP 8.2; no public PHP helper endpoint, password reset or browser-session copying. The server's default CLI is PHP 5.6 and is not used. Initial HTTPS browser navigation reset; the preview's configured HTTP entry worked and page links subsequently use HTTPS.

Live baseline `aeb7ef0` preserves the client's newer product layout and buttons. Deploy allowlist is only five owned files: `inc/products.php`, `inc/commerce.php`, `template-parts/product/single-content.php`, `assets/js/main.js`, `assets/styles/main.css`. `tools/deploy-theme.py` checks live baseline conflicts, saves a ZIP, updates via the authenticated WP editor API, then verifies readback. No footer/shop/unrelated file is uploaded.
