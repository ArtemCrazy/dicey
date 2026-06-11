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
			echo dicey_missing_content_notice( 'Главная страница' );
		}
	endwhile;
else :
	echo dicey_missing_content_notice( 'Главная страница' );
endif;

get_footer();
