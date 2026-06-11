<?php
/**
 * 404 template.
 *
 * @package Dicey
 */

get_header();

echo dicey_get_template_html( 'template-parts/static/error' );

get_footer();
