<?php
/**
 * SEO and public housekeeping.
 *
 * @package Dicey
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function dicey_legacy_redirect_map() {
	return array(
		'index.php'     => home_url( '/' ),
		'shop.php'      => home_url( '/shop/' ),
		'about.php'     => home_url( '/about/' ),
		'delivery.php'  => home_url( '/delivery/' ),
		'dietology.php' => home_url( '/dietology/' ),
		'contacts.php'  => home_url( '/contacts/' ),
		'partners.php'  => home_url( '/partners/' ),
		'blog.php'      => home_url( '/blog/' ),
		'basket.php'    => home_url( '/basket/' ),
		'basket2.php'   => home_url( '/basket2/' ),
		'decoration.php' => home_url( '/decoration/' ),
		'gratitude.php' => home_url( '/gratitude/' ),
		'gratitude2.php' => home_url( '/gratitude2/' ),
		'policy.php'    => home_url( '/policy/' ),
		'cookies.php'   => home_url( '/cookies/' ),
		'lk.php'        => home_url( '/lk/' ),
		'lk2.php'       => home_url( '/lk2/' ),
		'lk3.php'       => home_url( '/lk3/' ),
		'lk4.php'       => home_url( '/lk4/' ),
		'lk5.php'       => home_url( '/lk5/' ),
		'product.php'   => home_url( '/shop/' ),
		'article.php'   => home_url( '/blog/' ),
	);
}

function dicey_redirect_legacy_php_urls() {
	if ( is_admin() || wp_doing_ajax() ) {
		return;
	}

	$path = isset( $_SERVER['REQUEST_URI'] ) ? wp_parse_url( wp_unslash( $_SERVER['REQUEST_URI'] ), PHP_URL_PATH ) : '';
	if ( ! $path ) {
		return;
	}

	$basename = basename( $path );
	$map      = dicey_legacy_redirect_map();

	if ( isset( $map[ $basename ] ) ) {
		wp_safe_redirect( $map[ $basename ], 301 );
		exit;
	}
}

add_action( 'template_redirect', 'dicey_redirect_legacy_php_urls', 1 );

function dicey_noindex_slugs() {
	return array(
		'basket',
		'basket2',
		'decoration',
		'lk',
		'lk2',
		'lk3',
		'lk4',
		'lk5',
		'gratitude',
		'gratitude2',
		'error',
		'cookies',
	);
}

function dicey_is_noindex_view() {
	if ( is_404() ) {
		return true;
	}

	if ( ! is_page() ) {
		return false;
	}

	$slug = get_post_field( 'post_name', get_queried_object_id() );

	return in_array( $slug, dicey_noindex_slugs(), true );
}

function dicey_wp_robots( $robots ) {
	if ( defined( 'WPSEO_VERSION' ) ) {
		return $robots;
	}

	if ( ! dicey_is_noindex_view() ) {
		return $robots;
	}

	$robots['noindex']  = true;
	$robots['nofollow'] = true;
	unset( $robots['index'], $robots['follow'] );

	return $robots;
}

add_filter( 'wp_robots', 'dicey_wp_robots' );

function dicey_yoast_robots( $robots ) {
	if ( dicey_is_noindex_view() ) {
		return 'noindex,nofollow';
	}

	return $robots;
}

add_filter( 'wpseo_robots', 'dicey_yoast_robots' );

function dicey_archive_title( $title ) {
	if ( is_post_type_archive( 'dicey_article' ) ) {
		return 'Блог';
	}

	return $title;
}

add_filter( 'get_the_archive_title', 'dicey_archive_title' );

function dicey_yoast_title( $title ) {
	if ( is_post_type_archive( 'dicey_article' ) ) {
		return 'Блог — Дайси';
	}

	return $title;
}

add_filter( 'wpseo_title', 'dicey_yoast_title' );

function dicey_yoast_metadesc( $description ) {
	if ( is_post_type_archive( 'dicey_article' ) ) {
		return 'Полезные статьи Дайси о натуральном питании, уходе и здоровье собак.';
	}

	return $description;
}

add_filter( 'wpseo_metadesc', 'dicey_yoast_metadesc' );

function dicey_disable_comments_support() {
	$post_types = get_post_types();

	foreach ( $post_types as $post_type ) {
		if ( post_type_supports( $post_type, 'comments' ) ) {
			remove_post_type_support( $post_type, 'comments' );
			remove_post_type_support( $post_type, 'trackbacks' );
		}
	}
}

add_action( 'init', 'dicey_disable_comments_support', 100 );

add_filter( 'comments_open', '__return_false', 20 );
add_filter( 'pings_open', '__return_false', 20 );
add_filter( 'comments_array', '__return_empty_array', 20 );

function dicey_cleanup_admin_menu() {
	remove_menu_page( 'edit-comments.php' );
}

add_action( 'admin_menu', 'dicey_cleanup_admin_menu', 99 );
