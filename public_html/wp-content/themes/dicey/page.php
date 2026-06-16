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
	} elseif ( 'decoration' === $slug && function_exists( 'dicey_render_decoration_page' ) ) {
		echo dicey_render_decoration_page();
	} elseif ( 'lk' === $slug && function_exists( 'dicey_render_account_page' ) ) {
		echo dicey_render_account_page();
	} elseif ( '' !== trim( $content ) ) {
		the_content();
	} elseif ( function_exists( 'dicey_missing_content_notice' ) ) {
		echo dicey_missing_content_notice( get_the_title() );
	} else {
		the_content();
	}
endwhile;

get_footer();
