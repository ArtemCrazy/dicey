<?php
/**
 * WooCommerce email polish.
 *
 * @package Dicey
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_filter( 'woocommerce_email_from_name', 'dicey_email_from_name' );
add_filter( 'woocommerce_email_footer_text', 'dicey_email_footer_text' );
add_filter( 'woocommerce_email_styles', 'dicey_email_styles' );
add_action( 'woocommerce_email_before_order_table', 'dicey_email_intro_text', 8, 4 );

function dicey_email_from_name( $name ) {
	unset( $name );

	return 'Дайси';
}

function dicey_email_footer_text( $text ) {
	unset( $text );

	return 'Дайси. Натуральные рационы и диетология для собак.';
}

function dicey_email_styles( $css ) {
	$css .= '
		#wrapper { background-color: #f5f9ff; }
		#template_container { border: 0; border-radius: 18px; overflow: hidden; box-shadow: none; }
		#template_header { background-color: #5182A6; }
		#template_header h1 { color: #ffffff; font-family: Arial, sans-serif; font-weight: 700; }
		#body_content_inner { color: #5182A6; font-family: Arial, sans-serif; font-size: 15px; line-height: 1.55; }
		#body_content_inner a { color: #5182A6; }
		#body_content_inner h2 { color: #5182A6; }
		.td { border-color: #d8e8f5; }
		#template_footer #credit { color: #86AFCC; }
	';

	return $css;
}

function dicey_email_intro_text( $order, $sent_to_admin, $plain_text, $email ) {
	if ( $sent_to_admin || ! $order || ! $email ) {
		return;
	}

	$message = 'Спасибо за заказ. Мы получили данные и скоро продолжим обработку.';

	if ( 'customer_processing_order' === $email->id ) {
		$message = 'Спасибо за заказ. Ниже детали заказа и текущий состав корзины.';
	} elseif ( 'customer_completed_order' === $email->id ) {
		$message = 'Заказ выполнен. Спасибо, что выбрали Дайси.';
	} elseif ( 'customer_on_hold_order' === $email->id ) {
		$message = 'Заказ ожидает подтверждения оплаты. Если платежный шлюз еще не подключен, менеджер свяжется с вами.';
	}

	if ( $plain_text ) {
		echo esc_html( $message ) . "\n\n";
		return;
	}

	echo '<p>' . esc_html( $message ) . '</p>';
}
