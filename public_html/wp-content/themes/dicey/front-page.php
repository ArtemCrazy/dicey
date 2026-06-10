<?php
/**
 * Front page template.
 *
 * @package Dicey
 */

get_header();

if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();

		if ( trim( get_the_content() ) ) {
			the_content();
		} else {
			echo dicey_get_template_html( 'template-parts/pages/front-page' );
		}
	endwhile;
else :
	echo dicey_get_template_html( 'template-parts/pages/front-page' );
endif;

get_footer();

