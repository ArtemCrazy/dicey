<?php
/**
 * WooCommerce single product template.
 *
 * @package Dicey
 */

get_header();

while ( have_posts() ) :
	the_post();
	get_template_part( 'template-parts/product/single-content' );
endwhile;

get_footer();
