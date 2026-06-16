<?php
/**
 * Newsletter subscriptions.
 *
 * @package Dicey
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'init', 'dicey_register_subscriber_post_type' );
add_action( 'wp_ajax_dicey_subscribe_newsletter', 'dicey_ajax_subscribe_newsletter' );
add_action( 'wp_ajax_nopriv_dicey_subscribe_newsletter', 'dicey_ajax_subscribe_newsletter' );
add_filter( 'manage_dicey_subscriber_posts_columns', 'dicey_subscriber_columns' );
add_action( 'manage_dicey_subscriber_posts_custom_column', 'dicey_render_subscriber_column', 10, 2 );

function dicey_register_subscriber_post_type() {
	register_post_type(
		'dicey_subscriber',
		array(
			'labels'              => array(
				'name'               => 'Подписчики',
				'singular_name'      => 'Подписчик',
				'menu_name'          => 'Подписчики',
				'add_new_item'       => 'Добавить подписчика',
				'edit_item'          => 'Подписчик',
				'view_item'          => 'Посмотреть подписчика',
				'search_items'       => 'Найти подписчика',
				'not_found'          => 'Подписчики не найдены',
				'not_found_in_trash' => 'В корзине подписчиков нет',
			),
			'public'              => false,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 29,
			'menu_icon'           => 'dashicons-email-alt2',
			'capability_type'     => 'post',
			'exclude_from_search' => true,
			'supports'            => array( 'title' ),
		)
	);
}

function dicey_subscriber_columns( $columns ) {
	return array(
		'cb'         => isset( $columns['cb'] ) ? $columns['cb'] : '',
		'title'      => 'Email',
		'source'     => 'Источник',
		'ip'         => 'IP',
		'created_at' => 'Дата подписки',
	);
}

function dicey_render_subscriber_column( $column, $post_id ) {
	if ( 'source' === $column ) {
		echo esc_html( get_post_meta( $post_id, '_dicey_subscriber_source', true ) );
	}

	if ( 'ip' === $column ) {
		echo esc_html( get_post_meta( $post_id, '_dicey_subscriber_ip', true ) );
	}

	if ( 'created_at' === $column ) {
		echo esc_html( get_the_date( 'd.m.Y H:i', $post_id ) );
	}
}

function dicey_get_subscriber_by_email( $email ) {
	$existing = get_posts(
		array(
			'post_type'      => 'dicey_subscriber',
			'post_status'    => array( 'publish', 'draft' ),
			'posts_per_page' => 1,
			'title'          => $email,
			'fields'         => 'ids',
		)
	);

	return $existing ? absint( $existing[0] ) : 0;
}

function dicey_ajax_subscribe_newsletter() {
	check_ajax_referer( 'dicey_newsletter', 'nonce' );

	$email   = isset( $_POST['email'] ) ? strtolower( sanitize_email( wp_unslash( $_POST['email'] ) ) ) : '';
	$consent = ! empty( $_POST['consent'] );

	if ( ! is_email( $email ) ) {
		wp_send_json_error( array( 'message' => 'Введите корректную почту.' ), 400 );
	}

	if ( ! $consent ) {
		wp_send_json_error( array( 'message' => 'Подтвердите согласие на рассылку.' ), 400 );
	}

	$post_id = dicey_get_subscriber_by_email( $email );
	if ( ! $post_id ) {
		$post_id = wp_insert_post(
			array(
				'post_type'   => 'dicey_subscriber',
				'post_status' => 'publish',
				'post_title'  => $email,
			)
		);
	}

	if ( ! $post_id || is_wp_error( $post_id ) ) {
		wp_send_json_error( array( 'message' => 'Не удалось сохранить подписку. Попробуйте позже.' ), 500 );
	}

	update_post_meta( $post_id, '_dicey_subscriber_source', 'Форма в футере' );
	update_post_meta( $post_id, '_dicey_subscriber_ip', dicey_get_request_ip() );
	update_post_meta( $post_id, '_dicey_subscriber_user_agent', isset( $_SERVER['HTTP_USER_AGENT'] ) ? sanitize_text_field( wp_unslash( $_SERVER['HTTP_USER_AGENT'] ) ) : '' );
	update_post_meta( $post_id, '_dicey_subscriber_consent', '1' );

	wp_send_json_success( array( 'message' => 'Спасибо! Мы сохранили вашу подписку.' ) );
}
