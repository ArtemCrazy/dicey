<?php
/**
 * Small helpers for adapting legacy markup to the WP theme.
 *
 * @package Dicey
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function dicey_rewrite_legacy_html( $html ) {
	$assets = esc_url( DICEY_ASSETS_URI );

	$replacements = array(
		'src="static/'       => 'src="' . $assets . '/',
		"src='static/"       => "src='" . $assets . '/',
		'href="static/'      => 'href="' . $assets . '/',
		"href='static/"      => "href='" . $assets . '/',
		'src="/static/'      => 'src="' . $assets . '/',
		"src='/static/"      => "src='" . $assets . '/',
		'href="/static/'     => 'href="' . $assets . '/',
		"href='/static/"     => "href='" . $assets . '/',
		'url("../fonts/'     => 'url("../fonts/',
		'url(\'../fonts/'    => 'url(\'../fonts/',
		'url(../fonts/'      => 'url(../fonts/',
		'href="/#'           => 'href="' . esc_url( home_url( '/#' ) ),
		"href='/#"           => "href='" . esc_url( home_url( '/#' ) ),
		'href="/"'           => 'href="' . esc_url( home_url( '/' ) ) . '"',
		'href="index.php"'   => 'href="' . esc_url( home_url( '/' ) ) . '"',
		"href='index.php'"   => "href='" . esc_url( home_url( '/' ) ) . "'",
		'href="/index.php"'  => 'href="' . esc_url( home_url( '/' ) ) . '"',
		'href="/shop.php"'   => 'href="' . esc_url( home_url( '/shop/' ) ) . '"',
		'href="/about.php"'  => 'href="' . esc_url( home_url( '/about/' ) ) . '"',
		'href="/delivery.php"' => 'href="' . esc_url( home_url( '/delivery/' ) ) . '"',
		'href="/dietology.php"' => 'href="' . esc_url( home_url( '/dietology/' ) ) . '"',
		'href="/contacts.php"' => 'href="' . esc_url( home_url( '/contacts/' ) ) . '"',
		'href="/basket.php"' => 'href="' . esc_url( home_url( '/basket/' ) ) . '"',
		'href="blog.php"'     => 'href="' . esc_url( home_url( '/blog/' ) ) . '"',
		"href='blog.php'"     => "href='" . esc_url( home_url( '/blog/' ) ) . "'",
		'href="/blog.php"'    => 'href="' . esc_url( home_url( '/blog/' ) ) . '"',
	);

	$html = strtr( $html, $replacements );

	return preg_replace_callback(
		'/href="([^"]+)\.php"/',
		static function ( $matches ) {
			$slug = trim( $matches[1], '/' );

			if ( '' === $slug ) {
				return 'href="' . esc_url( home_url( '/' ) ) . '"';
			}

			return 'href="' . esc_url( home_url( '/' . $slug . '/' ) ) . '"';
		},
		$html
	);
}

function dicey_get_template_html( $slug, $args = array() ) {
	ob_start();
	get_template_part( $slug, null, $args );

	return dicey_rewrite_legacy_html( ob_get_clean() );
}

function dicey_asset_version( $relative_path ) {
	$file = DICEY_THEME_DIR . '/assets/' . ltrim( $relative_path, '/' );

	return file_exists( $file ) ? (string) filemtime( $file ) : DICEY_VERSION;
}

function dicey_image_url( $value, $size = 'full' ) {
	if ( is_numeric( $value ) ) {
		$image = wp_get_attachment_image_url( absint( $value ), $size );

		if ( $image ) {
			return $image;
		}
	}

	if ( ! is_string( $value ) || '' === trim( $value ) ) {
		return '';
	}

	if ( 0 === strpos( $value, 'http://' ) || 0 === strpos( $value, 'https://' ) ) {
		return $value;
	}

	return DICEY_ASSETS_URI . '/' . ltrim( $value, '/' );
}
