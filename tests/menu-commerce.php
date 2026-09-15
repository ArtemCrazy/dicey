<?php
// Isolated regression using the actual theme functions; no database or orders.
define( 'ABSPATH', __DIR__ );
$hooks = array();
$fixture = array();
function add_action( $name, $fn, ...$rest ) { $GLOBALS['hooks'][$name][] = $fn; }
function add_filter( $name, $fn, ...$rest ) { add_action( $name, $fn ); }
function absint( $value ) { return abs( (int) $value ); }
function wp_strip_all_tags( $value ) { return strip_tags( $value ); }
function get_bloginfo( $key ) { return 'UTF-8'; }
function sanitize_text_field( $value ) { return strip_tags( $value ); }
function wp_kses_post( $value ) { return $value; }
function wp_unslash( $value ) { return $value; }
function is_admin() { return false; }
function get_post_meta( $id, $key, $single ) { return $GLOBALS['fixture'][$id][$key] ?? ''; }
function wc_get_cart_url() { return '/basket/'; }
function wp_list_pluck( $rows, $key ) { return array_column( $rows, $key ); }
function wc_price( $price ) { return number_format( $price, 2, ',', ' ' ) . ' ₽'; }
function wc_get_price_to_display( $product, $args ) { return $args['price']; }
function wc_get_product( $id ) { return new TestProduct(); }
class TestProduct {
    public $price = 2880;
    function set_price( $value ) { $this->price = $value; }
    function exists() { return true; }
    function is_purchasable() { return true; }
    function is_in_stock() { return true; }
    function is_type( $type ) { return 'simple' === $type; }
}
class TestCart {
    public $cart_contents;
    function get_cart() { return $this->cart_contents; }
}
class TestWoo {
    public $gateways = array();
    function payment_gateways() { return $this; }
    function get_available_payment_gateways() { return $this->gateways; }
}
$woo = new TestWoo();
function WC() { return $GLOBALS['woo']; }
function check( $condition, $message ) {
    if ( ! $condition ) { throw new RuntimeException( $message ); }
    echo "PASS: $message\n";
}
require __DIR__ . '/../public_html/wp-content/themes/dicey/inc/products.php';
require __DIR__ . '/../public_html/wp-content/themes/dicey/inc/commerce.php';
$fixture[1] = array(
    '_dicey_product_terms' => "3 дня\n5 дней\n1 месяц",
    '_dicey_product_menu_examples' => array_map( function ( $price, $index ) {
        return array( 'title' => 'Dish ' . $index, 'price' => (string) $price );
    }, array( 400, 300, 500, 600, 700 ), range( 0, 4 ) ),
);
check( dicey_product_menu_price_details( 1, '', '3 дня' )['total'] === 1200.0, 'Three-day server price' );
check( dicey_product_menu_price_details( 1, '0,3,4', '3 дня' )['total'] === 1700.0, 'Replacement changes server price' );
check( dicey_product_menu_price_details( 1, '', '5 дней' )['total'] === 2500.0, 'Five-day server price' );
check( dicey_product_menu_price_details( 1, '', '1 месяц' )['total'] === 15000.0, 'Month is six five-day menus' );
$product = new TestProduct();
$item = array( 'data' => $product, 'product_id' => 1, 'quantity' => 2, 'dicey_period' => '1 месяц', 'dicey_menu_selection' => array(0,1,2,3,4), 'dicey_menu_total' => 1 );
$month = dicey_product_restore_menu_price( $item );
check( $month['data']->price === 15000.0 && $month['dicey_menu_total'] === 15000.0, 'Session GET restores trusted monthly price, ignoring stale total' );
check( $month['quantity'] === 2 && $month['data']->price * $month['quantity'] === 30000.0, 'Quantity is applied exactly once by cart' );
$item['dicey_period'] = '3 дня';
$short = dicey_product_restore_menu_price( $item );
check( $short['data']->price === 1200.0 && $month['data']->price === 15000.0 && $product->price === 2880, 'Two periods never share a mutable product price' );
$cart = new TestCart();
$cart->cart_contents = array( 'month' => $month, 'short' => $short );
dicey_product_apply_menu_price_to_cart( $cart );
dicey_product_apply_menu_price_to_cart( $cart );
check( $cart->cart_contents['month']['data']->price === 15000.0 && $cart->cart_contents['short']['data']->price === 1200.0, 'Repeated calculation is idempotent' );
check( in_array( 'dicey_product_restore_menu_price', $hooks['woocommerce_get_cart_item_from_session'], true ), 'Session restoration hook is registered' );
$options = dicey_product_card_period_options( 1 );
check( array_column( $options, 'label' ) === array('3 дня','5 дней','1 месяц'), 'All listing periods are available' );
check( $options[2]['fields']['dicey_product_period'] === '1 месяц' && $options[2]['fields']['dicey_product_menu_selection'] === '0,1,2,3,4', 'Listing month form carries the correct period and menu' );
check( $options[2]['price'] === '15 000,00 ₽', 'Listing price equals server monthly price' );
check( array() === dicey_product_cart_payload( 1, '99 дней' ), 'Invalid listing period is rejected' );
$_POST = array( 'dicey_product_period' => '1 месяц', 'dicey_product_menu_selection' => '0,0,999', 'dicey_menu_total' => 1 );
$added = dicey_product_add_period_to_cart_item( array(), 1, 0 );
check( $added['dicey_menu_total'] === 15000.0 && count( $added['dicey_menu_selection'] ) === 5, 'Submitted total and invalid selection cannot underprice the order' );
unset( $fixture[1]['_dicey_product_menu_examples'][4]['price'] );
$fallback = dicey_product_restore_menu_price( array_merge( $item, array('dicey_period'=>'1 месяц') ) );
check( !isset($fallback['dicey_menu_total']) && $fallback['data']->price === 2880, 'Missing menu prices retain the catalog fallback' );
$woo->gateways = array( 'dicey_pending_payment' => (object) array(), 'tbank' => (object) array() );
ob_start(); dicey_render_checkout_payment_methods(); $html = ob_get_clean();
check( strpos($html, 'type="hidden" name="payment_method" value="tbank"') !== false && strpos($html,'dicey_pending_payment') === false, 'Pay button submits T-Bank, not the legacy placeholder' );
$woo->gateways = array( 'dicey_pending_payment' => (object) array() );
ob_start(); dicey_render_checkout_payment_methods(); $html = ob_get_clean();
check( strpos($html,'role="alert"') !== false && strpos($html,'name="payment_method"') === false, 'Unavailable bank is reported without silently switching gateways' );
echo "All menu and checkout regressions passed.\n";
