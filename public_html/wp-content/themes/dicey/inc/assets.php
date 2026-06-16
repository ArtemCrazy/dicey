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

function dicey_get_delivery_client_settings() {
	$settings = array(
		'yandexMapsApiKey'    => '',
		'dadataToken'         => '',
		'freeMessage'         => 'Бесплатная доставка по вашему адресу',
		'paidMessage'         => 'Адрес входит в дополнительную зону доставки. Условия нужно уточнить у менеджера.',
		'outsideMessage'      => 'Адрес не входит в зону доставки. Оставьте заявку, и мы уточним возможные варианты.',
		'dadataMissingNotice' => 'Для проверки адреса нужно добавить API-ключ DaData в админке.',
		'mapsMissingNotice'   => 'Для отображения карты нужно добавить API-ключ Яндекс.Карт в админке.',
	);

	if ( function_exists( 'carbon_get_theme_option' ) ) {
		$carbon_settings = array(
			'yandexMapsApiKey'    => carbon_get_theme_option( 'dicey_yandex_maps_api_key' ),
			'dadataToken'         => carbon_get_theme_option( 'dicey_dadata_token' ),
			'freeMessage'         => carbon_get_theme_option( 'dicey_delivery_free_message' ),
			'paidMessage'         => carbon_get_theme_option( 'dicey_delivery_paid_message' ),
			'outsideMessage'      => carbon_get_theme_option( 'dicey_delivery_outside_message' ),
			'dadataMissingNotice' => carbon_get_theme_option( 'dicey_delivery_dadata_missing_notice' ),
			'mapsMissingNotice'   => carbon_get_theme_option( 'dicey_delivery_maps_missing_notice' ),
		);

		foreach ( $carbon_settings as $key => $value ) {
			if ( is_string( $value ) && '' !== trim( $value ) ) {
				$settings[ $key ] = wp_strip_all_tags( $value );
			}
		}
	}

	return $settings;
}

function dicey_enqueue_assets() {
	$city = function_exists( 'dicey_get_detected_city' ) ? dicey_get_detected_city() : array(
		'key'   => 'moscow',
		'label' => 'Москва',
	);

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
			'ajaxUrl'   => admin_url( 'admin-ajax.php' ),
			'newsletter' => array(
				'nonce'    => wp_create_nonce( 'dicey_newsletter' ),
				'pending'  => 'Сохраняем...',
				'success'  => 'Спасибо! Мы сохранили вашу подписку.',
				'error'    => 'Не удалось сохранить подписку. Попробуйте позже.',
			),
			'city'      => array(
				'key'   => $city['key'],
				'label' => $city['label'],
			),
			'delivery'  => dicey_get_delivery_client_settings(),
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
add_action( 'admin_head', 'dicey_print_favicon', 5 );
add_action( 'login_head', 'dicey_print_favicon', 5 );

function dicey_print_favicon() {
	printf(
		'<link rel="icon" href="%s" type="image/svg+xml">' . "\n",
		esc_url( DICEY_ASSETS_URI . '/imgs/icons/fav.svg' )
	);
}
