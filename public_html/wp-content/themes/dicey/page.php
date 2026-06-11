<?php
/**
 * Page template.
 *
 * @package Dicey
 */

get_header();

while ( have_posts() ) :
	the_post();
	$static_template = 'template-parts/static/' . get_post_field( 'post_name', get_the_ID() );

	if ( locate_template( $static_template . '.php' ) ) {
		echo dicey_get_template_html( $static_template );
	} else {
		the_content();
	}
endwhile;

get_footer();
