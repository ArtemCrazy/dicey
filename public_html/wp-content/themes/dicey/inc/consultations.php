<?php
/**
 * Dietology consultation products and order flow.
 *
 * @package Dicey
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'init', 'dicey_ensure_consultation_products', 35 );
add_filter( 'woocommerce_add_cart_item_data', 'dicey_add_consultation_cart_item_data', 10, 3 );
add_filter( 'woocommerce_get_item_data', 'dicey_render_consultation_cart_item_data', 10, 2 );
add_action( 'woocommerce_checkout_create_order_line_item', 'dicey_add_consultation_order_item_data', 10, 4 );
add_action( 'woocommerce_order_status_processing', 'dicey_handle_paid_consultation_order' );
add_action( 'woocommerce_order_status_completed', 'dicey_handle_paid_consultation_order' );
add_action( 'woocommerce_payment_complete', 'dicey_handle_paid_consultation_order' );

function dicey_consultation_definitions() {
	return array(
		array(
			'slug'  => 'consultation-dietologist-gastroenterologist',
			'title' => 'Консультация ветеринарного врача диетолога/гастроэнтеролога',
			'price' => '1500',
			'text'  => 'Ответы на вопросы, разбор анализов и дополнительных исследований, рекомендации по лечению.',
		),
		array(
			'slug'  => 'healthy-pet-ration-selection',
			'title' => 'Подбор рациона для здорового питомца',
			'price' => '3000',
			'text'  => 'Составление индивидуального рациона питания, ответы на вопросы по рациону, рекомендации по кормлению.',
		),
		array(
			'slug'  => 'sick-pet-ration-selection',
			'title' => 'Подбор рациона для питомца с заболеванием',
			'price' => '3500',
			'text'  => 'Индивидуальное составление рациона питания при заболевании, ответы на вопросы и рекомендации по кормлению.',
		),
		array(
			'slug'  => 'nutrition-support',
			'title' => 'Ведение питания',
			'price' => '2500',
			'text'  => 'Контроль состояния питомца и корректировка питания при необходимости.',
		),
	);
}

function dicey_ensure_consultation_products() {
	if ( ! function_exists( 'wc_get_product' ) ) {
		return;
	}

	$category = get_term_by( 'slug', 'consultations', 'product_cat' );
	if ( ! $category ) {
		$category = wp_insert_term( 'Консультации', 'product_cat', array( 'slug' => 'consultations' ) );
	}

	$category_id = is_array( $category ) && ! empty( $category['term_id'] ) ? absint( $category['term_id'] ) : ( $category && ! is_wp_error( $category ) ? absint( $category->term_id ) : 0 );

	foreach ( dicey_consultation_definitions() as $definition ) {
		$existing = get_posts(
			array(
				'post_type'      => 'product',
				'post_status'    => array( 'publish', 'draft', 'private' ),
				'name'           => $definition['slug'],
				'fields'         => 'ids',
				'posts_per_page' => 1,
			)
		);

		$product_id = $existing ? absint( $existing[0] ) : 0;
		if ( ! $product_id ) {
			$product_id = wp_insert_post(
				array(
					'post_type'    => 'product',
					'post_status'  => 'publish',
					'post_title'   => $definition['title'],
					'post_name'    => $definition['slug'],
					'post_content' => $definition['text'],
				)
			);
		}

		if ( ! $product_id || is_wp_error( $product_id ) ) {
			continue;
		}

		wp_set_object_terms( $product_id, 'simple', 'product_type' );
		if ( $category_id ) {
			wp_set_object_terms( $product_id, array( $category_id ), 'product_cat' );
		}

		update_post_meta( $product_id, '_dicey_is_consultation', '1' );
		update_post_meta( $product_id, '_regular_price', $definition['price'] );
		update_post_meta( $product_id, '_price', $definition['price'] );
		update_post_meta( $product_id, '_virtual', 'yes' );
		update_post_meta( $product_id, '_sold_individually', 'yes' );
		update_post_meta( $product_id, '_stock_status', 'instock' );
		update_post_meta( $product_id, '_manage_stock', 'no' );
		update_post_meta( $product_id, '_visibility', 'hidden' );
		update_post_meta( $product_id, 'total_sales', get_post_meta( $product_id, 'total_sales', true ) );
	}
}

function dicey_is_consultation_product( $product_id ) {
	$product_id = absint( $product_id );
	if ( ! $product_id ) {
		return false;
	}

	$product = function_exists( 'wc_get_product' ) ? wc_get_product( $product_id ) : null;
	if ( $product && $product->is_type( 'variation' ) ) {
		$product_id = $product->get_parent_id();
	}

	return '1' === get_post_meta( $product_id, '_dicey_is_consultation', true );
}

function dicey_get_consultation_products() {
	if ( ! function_exists( 'wc_get_product' ) ) {
		return array();
	}

	$products = array();
	foreach ( dicey_consultation_definitions() as $definition ) {
		$post = get_page_by_path( $definition['slug'], OBJECT, 'product' );
		if ( ! $post ) {
			continue;
		}

		$product = wc_get_product( $post->ID );
		if ( $product ) {
			$products[] = $product;
		}
	}

	return $products;
}

function dicey_consultation_form_url() {
	if ( function_exists( 'carbon_get_theme_option' ) ) {
		$url = carbon_get_theme_option( 'dicey_consultation_form_url' );
		if ( $url ) {
			return $url;
		}
	}

	return get_option( 'dicey_consultation_form_url', '' );
}

function dicey_add_consultation_cart_item_data( $cart_item_data, $product_id, $variation_id ) {
	if ( ! dicey_is_consultation_product( $product_id ) ) {
		return $cart_item_data;
	}

	$fields = array(
		'name'    => 'Имя',
		'phone'   => 'Телефон',
		'email'   => 'Почта',
		'comment' => 'Комментарий',
	);

	$cart_item_data['dicey_consultation'] = array();
	foreach ( $fields as $key => $label ) {
		$field_name = 'dicey_consultation_' . $key;
		if ( ! isset( $_POST[ $field_name ] ) ) {
			continue;
		}

		$value = wp_unslash( $_POST[ $field_name ] );
		$value = 'email' === $key ? sanitize_email( $value ) : sanitize_text_field( $value );
		if ( '' !== $value ) {
			$cart_item_data['dicey_consultation'][ $label ] = $value;
		}
	}

	$cart_item_data['unique_key'] = md5( wp_json_encode( $cart_item_data['dicey_consultation'] ) . microtime() );

	return $cart_item_data;
}

function dicey_render_consultation_cart_item_data( $item_data, $cart_item ) {
	if ( empty( $cart_item['dicey_consultation'] ) || ! is_array( $cart_item['dicey_consultation'] ) ) {
		return $item_data;
	}

	foreach ( $cart_item['dicey_consultation'] as $name => $value ) {
		$item_data[] = array(
			'name'  => $name,
			'value' => $value,
		);
	}

	return $item_data;
}

function dicey_add_consultation_order_item_data( $item, $cart_item_key, $values, $order ) {
	if ( empty( $values['dicey_consultation'] ) || ! is_array( $values['dicey_consultation'] ) ) {
		return;
	}

	$item->add_meta_data( 'Тип', 'Консультация', true );
	foreach ( $values['dicey_consultation'] as $name => $value ) {
		$item->add_meta_data( $name, $value, true );
	}
}

function dicey_order_has_consultation( $order ) {
	if ( ! $order instanceof WC_Order ) {
		return false;
	}

	foreach ( $order->get_items() as $item ) {
		$product = $item->get_product();
		if ( $product && dicey_is_consultation_product( $product->get_id() ) ) {
			return true;
		}
	}

	return false;
}

function dicey_handle_paid_consultation_order( $order_id ) {
	$order = wc_get_order( $order_id );
	if ( ! $order || ! dicey_order_has_consultation( $order ) ) {
		return;
	}

	if ( '1' === $order->get_meta( '_dicey_consultation_email_sent' ) ) {
		return;
	}

	dicey_record_user_consultations_from_order( $order );
	dicey_send_consultation_form_email( $order );

	$order->update_meta_data( '_dicey_consultation_email_sent', '1' );
	$order->save();
}

function dicey_record_user_consultations_from_order( $order ) {
	$user_id = $order->get_user_id();
	if ( ! $user_id ) {
		return;
	}

	$consultations = get_user_meta( $user_id, 'dicey_consultations', true );
	if ( ! is_array( $consultations ) ) {
		$consultations = array();
	}

	foreach ( $order->get_items() as $item ) {
		$product = $item->get_product();
		if ( ! $product || ! dicey_is_consultation_product( $product->get_id() ) ) {
			continue;
		}

		$consultations[] = array(
			'title'  => $item->get_name(),
			'Дата'   => wc_format_datetime( $order->get_date_created(), 'd.m.Y' ),
			'Статус' => wc_get_order_status_name( $order->get_status() ),
			'Заказ'  => '#' . $order->get_order_number(),
		);
	}

	update_user_meta( $user_id, 'dicey_consultations', $consultations );
}

function dicey_send_consultation_form_email( $order ) {
	$email = $order->get_billing_email();
	if ( ! $email || ! is_email( $email ) ) {
		return;
	}

	$form_url = dicey_consultation_form_url();
	$subject  = 'Анкета для консультации Дайси';
	$message  = "Здравствуйте!\n\nСпасибо за оплату консультации.\n\n";
	$message .= $form_url ? "Пожалуйста, заполните анкету перед консультацией: {$form_url}\n\n" : "Ссылка на анкету будет отправлена менеджером дополнительно.\n\n";
	$message .= "После заполнения анкеты специалист свяжется с вами.\n\nДайси";

	wp_mail( $email, $subject, $message );
}

function dicey_render_consultation_product_cards( $button_class = 'lk-vet__btn' ) {
	$products = dicey_get_consultation_products();
	if ( ! $products ) {
		return '';
	}

	ob_start();
	?>
	<div class="dicey-consultation-products">
		<?php foreach ( $products as $product ) : ?>
			<div class="dicey-consultation-product">
				<p class="dicey-consultation-product__title"><?php echo esc_html( $product->get_name() ); ?></p>
				<p class="dicey-consultation-product__price"><?php echo wp_kses_post( $product->get_price_html() ); ?></p>
				<a class="<?php echo esc_attr( $button_class ); ?>" href="<?php echo esc_url( add_query_arg( array( 'add-to-cart' => $product->get_id() ), wc_get_cart_url() ) ); ?>">Заказать консультацию</a>
			</div>
		<?php endforeach; ?>
	</div>
	<?php
	return ob_get_clean();
}

function dicey_get_cart_consultation_contact() {
	if ( ! function_exists( 'WC' ) || ! WC()->cart ) {
		return array();
	}

	foreach ( WC()->cart->get_cart() as $cart_item ) {
		if ( empty( $cart_item['dicey_consultation'] ) || ! is_array( $cart_item['dicey_consultation'] ) ) {
			continue;
		}

		return array(
			'name'    => isset( $cart_item['dicey_consultation']['Имя'] ) ? $cart_item['dicey_consultation']['Имя'] : '',
			'phone'   => isset( $cart_item['dicey_consultation']['Телефон'] ) ? $cart_item['dicey_consultation']['Телефон'] : '',
			'email'   => isset( $cart_item['dicey_consultation']['Почта'] ) ? $cart_item['dicey_consultation']['Почта'] : '',
			'comment' => isset( $cart_item['dicey_consultation']['Комментарий'] ) ? $cart_item['dicey_consultation']['Комментарий'] : '',
		);
	}

	return array();
}
