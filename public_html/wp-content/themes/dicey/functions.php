<?php
/**
 * Dicey theme bootstrap.
 *
 * @package Dicey
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'DICEY_THEME_DIR', get_template_directory() );
define( 'DICEY_THEME_URI', get_template_directory_uri() );
define( 'DICEY_ASSETS_URI', DICEY_THEME_URI . '/assets' );
define( 'DICEY_VERSION', '0.1.0' );

require DICEY_THEME_DIR . '/inc/helpers.php';
require DICEY_THEME_DIR . '/inc/city.php';
require DICEY_THEME_DIR . '/inc/blog.php';
require DICEY_THEME_DIR . '/inc/home-block-renderers.php';
require DICEY_THEME_DIR . '/inc/dietology-renderers.php';
require DICEY_THEME_DIR . '/inc/about-renderers.php';
require DICEY_THEME_DIR . '/inc/delivery-renderers.php';
require DICEY_THEME_DIR . '/inc/contacts-renderers.php';
require DICEY_THEME_DIR . '/inc/settings.php';
require DICEY_THEME_DIR . '/inc/assets.php';
require DICEY_THEME_DIR . '/inc/blocks.php';

add_action( 'after_setup_theme', 'dicey_theme_setup' );

function dicey_theme_setup() {
	load_theme_textdomain( 'dicey', DICEY_THEME_DIR . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'editor-styles' );
	add_editor_style( 'assets/styles/main.css' );
	add_editor_style( 'assets/styles/editor.css' );

	add_theme_support(
		'html5',
		array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
			'navigation-widgets',
		)
	);

	register_nav_menus(
		array(
			'primary' => __( 'Primary Menu', 'dicey' ),
			'footer'  => __( 'Footer Menu', 'dicey' ),
		)
	);
}

add_filter( 'upload_mimes', 'dicey_allow_svg_uploads' );

function dicey_allow_svg_uploads( $mimes ) {
	$mimes['svg'] = 'image/svg+xml';

	return $mimes;
}
