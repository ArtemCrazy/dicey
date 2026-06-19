<?php
/**
 * WooCommerce theme bridge.
 *
 * @package Dicey
 */

get_header();

if ( is_product() ) {
	while ( have_posts() ) :
		the_post();
		get_template_part( 'template-parts/product/single-content' );
	endwhile;
} elseif ( is_shop() || is_product_taxonomy() ) {
	echo function_exists( 'dicey_render_shop_page' ) ? dicey_render_shop_page() : dicey_get_template_html( 'template-parts/static/shop' );
} else {
	woocommerce_content();
}

get_footer();
