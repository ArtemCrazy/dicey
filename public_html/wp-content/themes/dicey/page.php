<?php
/**
 * Page template.
 *
 * @package Dicey
 */

get_header();

while ( have_posts() ) :
	the_post();
	$page_slug       = get_post_field( 'post_name', get_the_ID() );
	$static_template = 'template-parts/static/' . $page_slug;
	$content         = get_post_field( 'post_content', get_the_ID() );
	$dynamic_pages   = array(
		'contacts' => 'dicey_render_contacts_page',
	);

	if ( 'contacts' === $page_slug && function_exists( 'dicey_render_contacts_page' ) ) {
		echo dicey_render_contacts_page();
		echo dicey_render_why();
	} elseif ( isset( $dynamic_pages[ $page_slug ] ) && function_exists( $dynamic_pages[ $page_slug ] ) ) {
		echo call_user_func( $dynamic_pages[ $page_slug ] );
	} elseif ( '' !== trim( $content ) ) {
		the_content();
	} elseif ( locate_template( $static_template . '.php' ) ) {
		echo dicey_get_template_html( $static_template );
	} else {
		the_content();
	}
endwhile;

get_footer();
