<?php
/**
 * Page template.
 *
 * @package Dicey
 */

get_header();

while ( have_posts() ) :
	the_post();
	$content = get_post_field( 'post_content', get_the_ID() );
	$slug    = get_post_field( 'post_name', get_the_ID() );

	if ( 'basket' === $slug && function_exists( 'dicey_render_basket_page' ) ) {
		echo dicey_render_basket_page();
	} elseif ( 'shop' === $slug && function_exists( 'dicey_render_shop_page' ) ) {
		echo dicey_render_shop_page();
	} elseif ( 'partners' === $slug && function_exists( 'dicey_get_template_html' ) ) {
		echo dicey_get_template_html( 'template-parts/static/partners' );
	} elseif ( 'decoration' === $slug && function_exists( 'dicey_render_decoration_page' ) ) {
		echo dicey_render_decoration_page();
	} elseif ( 'lk' === $slug && function_exists( 'dicey_render_account_page' ) ) {
		echo dicey_render_account_page();
	} elseif ( in_array( $slug, array( 'policy', 'offer', 'personal-data-consent' ), true ) ) {
		echo dicey_get_template_html( 'template-parts/static/' . $slug );
	} elseif ( '' !== trim( $content ) ) {
		the_content();
	} elseif ( function_exists( 'dicey_missing_content_notice' ) ) {
		echo dicey_missing_content_notice( get_the_title() );
	} else {
		the_content();
	}
endwhile;

get_footer();
