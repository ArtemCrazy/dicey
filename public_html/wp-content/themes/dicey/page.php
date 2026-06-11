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

	if ( '' !== trim( $content ) ) {
		the_content();
	} elseif ( function_exists( 'dicey_missing_content_notice' ) ) {
		echo dicey_missing_content_notice( get_the_title() );
	} else {
		the_content();
	}
endwhile;

get_footer();
