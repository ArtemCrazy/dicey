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
	$content         = get_post_field( 'post_content', get_the_ID() );

	if ( '' !== trim( $content ) ) {
		the_content();
	} elseif ( locate_template( $static_template . '.php' ) ) {
		echo dicey_get_template_html( $static_template );
	} else {
		the_content();
	}
endwhile;

get_footer();
