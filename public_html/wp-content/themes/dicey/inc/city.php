<?php
/**
 * Visitor city detection.
 *
 * @package Dicey
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function dicey_city_options() {
	return array(
		'moscow' => array(
			'key'   => 'moscow',
			'label' => 'Москва',
			'lat'   => 55.7558,
			'lon'   => 37.6173,
		),
		'spb'    => array(
			'key'   => 'spb',
			'label' => 'Санкт-Петербург',
			'lat'   => 59.9343,
			'lon'   => 30.3351,
		),
	);
}

function dicey_default_city() {
	$cities = dicey_city_options();

	return $cities['moscow'];
}

function dicey_get_request_ip() {
	$headers = array(
		'HTTP_CF_CONNECTING_IP',
		'HTTP_X_REAL_IP',
		'HTTP_X_FORWARDED_FOR',
		'REMOTE_ADDR',
	);

	foreach ( $headers as $header ) {
		if ( empty( $_SERVER[ $header ] ) ) {
			continue;
		}

		$ips = explode( ',', wp_unslash( $_SERVER[ $header ] ) );
		foreach ( $ips as $ip ) {
			$ip = trim( $ip );
			if ( filter_var( $ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE ) ) {
				return $ip;
			}
		}
	}

	return '';
}

function dicey_city_distance_km( $from_lat, $from_lon, $to_lat, $to_lon ) {
	$earth_radius = 6371;
	$lat_delta    = deg2rad( $to_lat - $from_lat );
	$lon_delta    = deg2rad( $to_lon - $from_lon );

	$a = sin( $lat_delta / 2 ) * sin( $lat_delta / 2 ) + cos( deg2rad( $from_lat ) ) * cos( deg2rad( $to_lat ) ) * sin( $lon_delta / 2 ) * sin( $lon_delta / 2 );
	$c = 2 * atan2( sqrt( $a ), sqrt( 1 - $a ) );

	return $earth_radius * $c;
}

function dicey_city_key_from_name( $name ) {
	if ( ! is_string( $name ) || '' === $name ) {
		return '';
	}

	$normalized = function_exists( 'mb_strtolower' ) ? mb_strtolower( $name, 'UTF-8' ) : strtolower( $name );

	if ( false !== strpos( $normalized, 'санкт' ) || false !== strpos( $normalized, 'петербург' ) || false !== strpos( $normalized, 'petersburg' ) || false !== strpos( $normalized, 'spb' ) ) {
		return 'spb';
	}

	if ( false !== strpos( $normalized, 'моск' ) || false !== strpos( $normalized, 'moscow' ) ) {
		return 'moscow';
	}

	return '';
}

function dicey_city_key_from_coordinates( $lat, $lon ) {
	$cities       = dicey_city_options();
	$nearest_key  = 'moscow';
	$nearest_dist = null;

	foreach ( $cities as $key => $city ) {
		$distance = dicey_city_distance_km( (float) $lat, (float) $lon, $city['lat'], $city['lon'] );
		if ( null === $nearest_dist || $distance < $nearest_dist ) {
			$nearest_dist = $distance;
			$nearest_key  = $key;
		}
	}

	return $nearest_key;
}

function dicey_detect_city_key_by_ip( $ip ) {
	if ( empty( $ip ) ) {
		return 'moscow';
	}

	$cache_key = 'dicey_city_' . md5( $ip );
	$cached    = get_transient( $cache_key );
	if ( in_array( $cached, array( 'moscow', 'spb' ), true ) ) {
		return $cached;
	}

	$key = dicey_detect_city_key_from_ipwhois( $ip );

	if ( ! $key ) {
		$key = dicey_detect_city_key_from_ipapi( $ip );
	}

	if ( ! in_array( $key, array( 'moscow', 'spb' ), true ) ) {
		$key = 'moscow';
	}

	set_transient( $cache_key, $key, 12 * HOUR_IN_SECONDS );

	return $key;
}

function dicey_detect_city_key_from_ipwhois( $ip ) {
	$response = wp_remote_get(
		'https://ipwho.is/' . rawurlencode( $ip ) . '?fields=success,latitude,longitude,city,region,country_code,ip',
		array(
			'timeout' => 2,
		)
	);

	if ( is_wp_error( $response ) || 200 !== wp_remote_retrieve_response_code( $response ) ) {
		return '';
	}

	$data = json_decode( wp_remote_retrieve_body( $response ), true );
	if ( ! is_array( $data ) || empty( $data['success'] ) ) {
		return '';
	}

	$key = dicey_city_key_from_name( isset( $data['city'] ) ? $data['city'] : '' );
	if ( $key ) {
		return $key;
	}

	if ( isset( $data['latitude'], $data['longitude'] ) && is_numeric( $data['latitude'] ) && is_numeric( $data['longitude'] ) ) {
		return dicey_city_key_from_coordinates( $data['latitude'], $data['longitude'] );
	}

	return '';
}

function dicey_detect_city_key_from_ipapi( $ip ) {
	$response = wp_remote_get(
		'http://ip-api.com/json/' . rawurlencode( $ip ) . '?fields=status,lat,lon,city,regionName,countryCode,query',
		array(
			'timeout' => 2,
		)
	);

	if ( is_wp_error( $response ) || 200 !== wp_remote_retrieve_response_code( $response ) ) {
		return '';
	}

	$data = json_decode( wp_remote_retrieve_body( $response ), true );
	if ( ! is_array( $data ) || empty( $data['status'] ) || 'success' !== $data['status'] ) {
		return '';
	}

	$key = dicey_city_key_from_name( isset( $data['city'] ) ? $data['city'] : '' );
	if ( $key ) {
		return $key;
	}

	if ( isset( $data['lat'], $data['lon'] ) && is_numeric( $data['lat'] ) && is_numeric( $data['lon'] ) ) {
		return dicey_city_key_from_coordinates( $data['lat'], $data['lon'] );
	}

	return '';
}

function dicey_get_detected_city_key() {
	return dicey_detect_city_key_by_ip( dicey_get_request_ip() );
}

function dicey_get_detected_city() {
	$cities = dicey_city_options();
	$key    = dicey_get_detected_city_key();

	return isset( $cities[ $key ] ) ? $cities[ $key ] : dicey_default_city();
}

function dicey_ajax_detect_city() {
	$city = dicey_get_detected_city();

	wp_send_json_success(
		array(
			'key'   => $city['key'],
			'label' => $city['label'],
		)
	);
}

add_action( 'wp_ajax_dicey_detect_city', 'dicey_ajax_detect_city' );
add_action( 'wp_ajax_nopriv_dicey_detect_city', 'dicey_ajax_detect_city' );
