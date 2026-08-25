<?php
/**
 * Plugin Name: Dicey Payment Compatibility
 * Description: Restores the standard WooCommerce order payment flow for the custom Dicey checkout page.
 * Version: 1.0.0
 * Author: Crazy Studio
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'template_redirect', 'dicey_payment_compat_render_order_pay', 20 );

/**
 * Run the WooCommerce order-pay endpoint before the theme sends output.
 *
 * Redirect-based gateways create the remote payment from their receipt hook.
 * The custom Dicey page renderer otherwise shows the checkout form again and
 * never lets WooCommerce dispatch that hook.
 */
function dicey_payment_compat_render_order_pay() {
	if ( ! function_exists( 'is_wc_endpoint_url' ) || ! is_wc_endpoint_url( 'order-pay' ) ) {
		return;
	}

	if ( ! class_exists( 'WC_Shortcode_Checkout' ) ) {
		return;
	}

	WC_Shortcode_Checkout::output( array() );
	exit;
}
