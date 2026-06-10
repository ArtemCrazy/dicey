<?php
/**
 * Theme assets.
 *
 * @package Dicey
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'wp_enqueue_scripts', 'dicey_enqueue_assets' );
add_action( 'enqueue_block_editor_assets', 'dicey_enqueue_editor_assets' );

function dicey_enqueue_assets() {
	wp_enqueue_style(
		'dicey-main',
		DICEY_ASSETS_URI . '/styles/main.css',
		array(),
		dicey_asset_version( 'styles/main.css' )
	);

	wp_enqueue_script(
		'dicey-vendor',
		DICEY_ASSETS_URI . '/js/script.js',
		array(),
		dicey_asset_version( 'js/script.js' ),
		true
	);

	wp_enqueue_script(
		'dicey-main',
		DICEY_ASSETS_URI . '/js/main.js',
		array( 'dicey-vendor' ),
		dicey_asset_version( 'js/main.js' ),
		true
	);

	wp_localize_script(
		'dicey-main',
		'diceyTheme',
		array(
			'assetsUrl' => DICEY_ASSETS_URI,
			'homeUrl'   => home_url( '/' ),
		)
	);
}

function dicey_enqueue_editor_assets() {
	wp_enqueue_style(
		'dicey-editor',
		DICEY_ASSETS_URI . '/styles/editor.css',
		array(),
		dicey_asset_version( 'styles/editor.css' )
	);
}

add_action( 'wp_head', 'dicey_print_favicon', 5 );

function dicey_print_favicon() {
	printf(
		'<link rel="icon" href="%s" type="image/svg+xml">' . "\n",
		esc_url( DICEY_ASSETS_URI . '/imgs/icons/fav.svg' )
	);
}
