# Automatic monthly replacements — September 20

Roman's September 20 voice message supersedes the September 19 manual allowlist requirement. The six-block UI, pricing and order snapshot remain unchanged.

## Matching

- Uses existing `match_age_groups`, `match_weight_min`, `match_weight_max` product fields, including Carbon Fields data.
- Breed, taxonomy/category and the old `_dicey_monthly_replacements` list do not participate. Historical manual metadata is preserved for rollback, but its save handler and checkbox UI are removed.
- Without an individual pet's precise age/weight in the cart, a candidate must cover every age group and the full weight interval of the original product. Mere overlap or a shared endpoint is insufficient. This conservative rule was explained in the implementation update.
- Empty age means both existing age groups, consistent with the current editor help. Missing both weight bounds or malformed/reversed/negative bounds disable matching. A missing lower bound means zero; a missing upper bound means unbounded. Decimal commas are supported.
- Existing publication, availability, five-day price, stock-management and tax checks still apply. Cart restoration, checkout and order creation use the same freshly computed eligibility.
- Admin box “Замены рационов на месяц” now explains automatic matching and shows current eligible menus instead of manual checkboxes. Product age and weight fields remain in their original editor locations.

## Verification

- PHP syntax check and focused monthly regression passed, including all existing price/order scenarios plus age, weight boundaries, missing/invalid fields, breed independence, obsolete manual-list independence and changed-eligibility checkout rejection.
- Real preview WordPress/Carbon Fields/WooCommerce verification passed: automatic admin summary, simple-product cart/totals/checkout/order-line snapshot and actual monthly variation.
- In-app Browser preview: only the age/weight-compatible alternative appears; the deliberately hand-listed senior alternative is excluded, despite the compatible alternative having a different breed. Replacing block two changes 15,000 to 15,100 and basket shows all six correct ranges and prices.
- Preview fixtures 164/165: adult, 3–5 kg, different breeds. Fixture 166: senior, 3–5 kg. Only these dedicated fixture fields were populated; temporary variable-product preview fields were restored by the QA script.
- No production product metadata changes, orders, payments, category changes or migrations are required.

## Release

Only `inc/products.php` is deployed, with conflict checking against `eb11b3b` and a pre-change backup. No JS, CSS, commerce, footer or unrelated template is uploaded.
