<?php
/**
 * WooCommerce cart and checkout views.
 *
 * @package Dicey
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'template_redirect', 'dicey_handle_cart_period_change' );
add_filter( 'woocommerce_checkout_fields', 'dicey_simplify_checkout_fields' );
add_action( 'woocommerce_before_checkout_process', 'dicey_apply_checkout_coupon' );
add_action( 'woocommerce_checkout_create_order', 'dicey_save_checkout_delivery_check', 10, 2 );

function dicey_is_woocommerce_ready() {
	return function_exists( 'WC' ) && WC()->cart;
}

function dicey_cart_item_period_label( $cart_item ) {
	if ( empty( $cart_item['variation'] ) || ! is_array( $cart_item['variation'] ) ) {
		return '';
	}

	foreach ( $cart_item['variation'] as $attribute_name => $attribute_value ) {
		if ( '' === $attribute_value ) {
			continue;
		}

		return function_exists( 'dicey_product_variation_label' ) ? dicey_product_variation_label( $attribute_name, $attribute_value ) : $attribute_value;
	}

	return '';
}

function dicey_cart_item_image_url( $product_id, $product ) {
	if ( $product && $product->get_image_id() ) {
		return wp_get_attachment_image_url( $product->get_image_id(), 'medium' );
	}

	if ( function_exists( 'dicey_product_card_image_url' ) ) {
		return dicey_product_card_image_url( $product_id );
	}

	return function_exists( 'dicey_asset_img' ) ? dicey_asset_img( 'imgs/bg/basket__img.png' ) : '';
}

function dicey_cart_item_period_options( $cart_item ) {
	if ( empty( $cart_item['product_id'] ) || ! function_exists( 'dicey_get_wc_product_period_options' ) ) {
		return array();
	}

	return dicey_get_wc_product_period_options( absint( $cart_item['product_id'] ) );
}

function dicey_handle_cart_period_change() {
	if ( empty( $_POST['dicey_change_period'] ) || ! dicey_is_woocommerce_ready() ) {
		return;
	}

	check_admin_referer( 'dicey_change_cart_period', 'dicey_cart_period_nonce' );

	$cart_item_key = isset( $_POST['cart_item_key'] ) ? sanitize_text_field( wp_unslash( $_POST['cart_item_key'] ) ) : '';
	$variation_id  = isset( $_POST['variation_id'] ) ? absint( $_POST['variation_id'] ) : 0;
	$cart_item     = WC()->cart->get_cart_item( $cart_item_key );
	$variation     = $variation_id ? wc_get_product( $variation_id ) : null;

	if ( ! $cart_item || ! $variation || ! $variation->is_type( 'variation' ) ) {
		wc_add_notice( __( 'Не удалось изменить срок рациона.', 'dicey' ), 'error' );
		wp_safe_redirect( wc_get_cart_url() );
		exit;
	}

	$product_id = absint( $cart_item['product_id'] );
	$quantity   = max( 1, absint( $cart_item['quantity'] ) );
	$attributes = wc_get_product_variation_attributes( $variation_id );

	WC()->cart->remove_cart_item( $cart_item_key );
	WC()->cart->add_to_cart( $product_id, $quantity, $variation_id, $attributes );
	wc_add_notice( __( 'Срок рациона обновлен.', 'dicey' ), 'success' );

	wp_safe_redirect( wc_get_cart_url() );
	exit;
}

function dicey_render_basket_page() {
	if ( ! dicey_is_woocommerce_ready() ) {
		return dicey_missing_content_notice( 'Корзина' );
	}

	ob_start();
	wc_print_notices();
	?>
	<main>
		<section class="basket">
			<div class="container">
				<div class="basket__head">
					<div class="standart-nav">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Главная</a>
						<p>Корзина</p>
					</div>
					<h1 class="basket__title">корзина</h1>
				</div>

				<?php if ( WC()->cart->is_empty() ) : ?>
					<div class="basket__empty">
						<p class="basket__empty-text">Ваша корзина пока пуста. <br> Добавьте товары, чтобы оформить заказ.</p>
						<a href="<?php echo esc_url( home_url( '/shop/' ) ); ?>" class="main__link">В магазин</a>
					</div>
				<?php else : ?>
					<div class="basket__blocks">
						<?php foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) : ?>
							<?php
							$product    = isset( $cart_item['data'] ) ? $cart_item['data'] : null;
							$product_id = isset( $cart_item['product_id'] ) ? absint( $cart_item['product_id'] ) : 0;

							if ( ! $product || ! $product->exists() || 0 >= $cart_item['quantity'] ) {
								continue;
							}

							$meta          = function_exists( 'dicey_get_product_meta' ) ? dicey_get_product_meta( $product_id ) : array();
							$period_label  = dicey_cart_item_period_label( $cart_item );
							$period_options = dicey_cart_item_period_options( $cart_item );
							?>
							<div class="basket__block">
								<div class="basket__block-left">
									<img src="<?php echo esc_url( dicey_cart_item_image_url( $product_id, $product ) ); ?>" alt="<?php echo esc_attr( $product->get_name() ); ?>" class="basket__img">
									<div class="basket__block-info">
										<p class="basket__block-name"><?php echo esc_html( $product->get_name() ); ?></p>
										<?php if ( ! empty( $meta['calories'] ) ) : ?>
											<p class="basket__kbju"><?php echo esc_html( $meta['calories'] ); ?></p>
										<?php endif; ?>
									</div>
								</div>
								<div class="basket__block-right">
									<?php if ( $period_label ) : ?>
										<div class="basket__block-time">
											<p class="basket__time-active"><?php echo esc_html( $period_label ); ?></p>
											<?php if ( count( $period_options ) > 1 ) : ?>
												<div class="basket__time-var">
													<?php foreach ( $period_options as $option ) : ?>
														<?php if ( absint( $option['variation_id'] ) === absint( $cart_item['variation_id'] ) ) { continue; } ?>
														<form method="post" class="dicey-cart-period-form">
															<?php wp_nonce_field( 'dicey_change_cart_period', 'dicey_cart_period_nonce' ); ?>
															<input type="hidden" name="dicey_change_period" value="1">
															<input type="hidden" name="cart_item_key" value="<?php echo esc_attr( $cart_item_key ); ?>">
															<input type="hidden" name="variation_id" value="<?php echo esc_attr( $option['variation_id'] ); ?>">
															<button type="submit" class="basket__time-item"><?php echo esc_html( $option['label'] ); ?></button>
														</form>
													<?php endforeach; ?>
												</div>
											<?php endif; ?>
										</div>
									<?php endif; ?>
									<div class="basket__block-price">
										<p class="basket-value"><?php echo wp_kses_post( WC()->cart->get_product_subtotal( $product, $cart_item['quantity'] ) ); ?></p>
										<a class="basket__del" href="<?php echo esc_url( wc_get_cart_remove_url( $cart_item_key ) ); ?>">Удалить</a>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					</div>

					<div class="basket__bottom">
						<div class="basket__wr">
							<div class="basket__wr-total">
								<p class="basket__total-text">Итого:</p>
								<p class="basket__total-value"><?php wc_cart_totals_subtotal_html(); ?></p>
							</div>
							<?php if ( WC()->cart->get_discount_total() > 0 ) : ?>
								<div class="basket__wr-sale">
									<p class="basket__sale-text">Скидка:</p>
									<p class="basket__sale-value">-<?php echo wp_kses_post( wc_price( WC()->cart->get_discount_total() ) ); ?></p>
								</div>
							<?php endif; ?>
							<div class="basket__wr-total2">
								<p class="basket__total2-text">Итого (<?php echo esc_html( WC()->cart->get_cart_contents_count() ); ?> рациона):</p>
								<p class="basket__total2-value"><?php wc_cart_totals_order_total_html(); ?></p>
							</div>
						</div>
						<div class="basket__btns">
							<a href="<?php echo esc_url( home_url( '/shop/' ) ); ?>" class="basket__purchases">Продолжить покупки</a>
							<a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="basket__decoration">Перейти к оформлению</a>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</section>
	</main>
	<?php
	return ob_get_clean();
}

function dicey_simplify_checkout_fields( $fields ) {
	if ( isset( $fields['billing']['billing_last_name'] ) ) {
		$fields['billing']['billing_last_name']['required'] = false;
	}

	foreach ( array( 'billing_company', 'billing_postcode', 'billing_state', 'billing_address_2' ) as $field_key ) {
		unset( $fields['billing'][ $field_key ] );
	}

	return $fields;
}

function dicey_apply_checkout_coupon() {
	if ( empty( $_POST['dicey_coupon_code'] ) || ! dicey_is_woocommerce_ready() ) {
		return;
	}

	$coupon = wc_format_coupon_code( wp_unslash( $_POST['dicey_coupon_code'] ) );
	if ( $coupon && ! WC()->cart->has_discount( $coupon ) ) {
		WC()->cart->apply_coupon( $coupon );
	}
}

function dicey_save_checkout_delivery_check( $order, $data ) {
	unset( $data );

	$fields = array(
		'_dicey_delivery_zone_status'        => 'dicey_delivery_zone_status',
		'_dicey_delivery_normalized_address' => 'dicey_delivery_normalized_address',
		'_dicey_delivery_geo_lat'            => 'dicey_delivery_geo_lat',
		'_dicey_delivery_geo_lon'            => 'dicey_delivery_geo_lon',
	);

	foreach ( $fields as $meta_key => $post_key ) {
		if ( empty( $_POST[ $post_key ] ) ) {
			continue;
		}

		$value = sanitize_text_field( wp_unslash( $_POST[ $post_key ] ) );
		if ( '' !== $value ) {
			$order->update_meta_data( $meta_key, $value );
		}
	}
}

function dicey_render_checkout_payment_methods() {
	$gateways = WC()->payment_gateways()->get_available_payment_gateways();

	if ( empty( $gateways ) ) {
		?>
		<div class="decoration__methods-block active">
			<div class="decoration__icon"></div>
			Способы оплаты будут подключены после выбора платежного шлюза
		</div>
		<?php
		return;
	}

	foreach ( $gateways as $gateway ) :
		?>
		<label class="decoration__methods-block <?php echo checked( $gateway->chosen, true, false ) ? 'active' : ''; ?>">
			<input type="radio" name="payment_method" value="<?php echo esc_attr( $gateway->id ); ?>" <?php checked( $gateway->chosen, true ); ?> style="display:none;">
			<div class="decoration__icon"></div>
			<?php echo esc_html( $gateway->get_title() ); ?>
		</label>
		<?php
	endforeach;
}

function dicey_render_checkout_order_summary() {
	?>
	<div class="decoration__right">
		<div class="decoration__right-head">
			<p class="decoration__right-title">Ваш заказ</p>
			<div class="decoration__right-col"><?php echo esc_html( WC()->cart->get_cart_contents_count() ); ?> рациона</div>
		</div>
		<div class="decoration__right-blocks">
			<?php foreach ( WC()->cart->get_cart() as $cart_item ) : ?>
				<?php
				$product    = isset( $cart_item['data'] ) ? $cart_item['data'] : null;
				$product_id = isset( $cart_item['product_id'] ) ? absint( $cart_item['product_id'] ) : 0;
				if ( ! $product || ! $product->exists() ) {
					continue;
				}
				?>
				<div class="decoration__right-block">
					<div class="decoration__right-wr">
						<img src="<?php echo esc_url( dicey_cart_item_image_url( $product_id, $product ) ); ?>" alt="<?php echo esc_attr( $product->get_name() ); ?>" class="decoration__right-img">
						<div class="decoration__right-info">
							<p class="decoration__right-name"><?php echo esc_html( $product->get_name() ); ?></p>
							<?php $period = dicey_cart_item_period_label( $cart_item ); ?>
							<?php if ( $period ) : ?><p class="decoration__right-date"><?php echo esc_html( $period ); ?></p><?php endif; ?>
						</div>
					</div>
					<div class="decoration__result">
						<p class="decoration__result-value"><?php echo wp_kses_post( WC()->cart->get_product_subtotal( $product, $cart_item['quantity'] ) ); ?></p>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
		<div class="decoration__bottom">
			<?php if ( WC()->cart->get_discount_total() > 0 ) : ?>
				<div class="decoration__sale-wr">
					<p class="decoration__sale-text">Скидка:</p>
					<p class="decoration__sale-value">-<?php echo wp_kses_post( wc_price( WC()->cart->get_discount_total() ) ); ?></p>
				</div>
			<?php endif; ?>
			<div class="decoration__total-wr">
				<p class="decoration__total-text">Итого:</p>
				<p class="decoration__total-value"><?php wc_cart_totals_order_total_html(); ?></p>
			</div>
		</div>
	</div>
	<?php
}

function dicey_render_decoration_page() {
	if ( ! dicey_is_woocommerce_ready() ) {
		return dicey_missing_content_notice( 'Оформление заказа' );
	}

	if ( WC()->cart->is_empty() ) {
		return dicey_render_basket_page();
	}

	$checkout = WC()->checkout();
	$city     = function_exists( 'dicey_get_detected_city' ) ? dicey_get_detected_city() : array( 'label' => 'Москва' );
	$consult_contact = function_exists( 'dicey_get_cart_consultation_contact' ) ? dicey_get_cart_consultation_contact() : array();
	$billing_name    = $checkout->get_value( 'billing_first_name' ) ? $checkout->get_value( 'billing_first_name' ) : ( isset( $consult_contact['name'] ) ? $consult_contact['name'] : '' );
	$billing_email   = $checkout->get_value( 'billing_email' ) ? $checkout->get_value( 'billing_email' ) : ( isset( $consult_contact['email'] ) ? $consult_contact['email'] : '' );
	$billing_phone   = $checkout->get_value( 'billing_phone' ) ? $checkout->get_value( 'billing_phone' ) : ( isset( $consult_contact['phone'] ) ? $consult_contact['phone'] : '' );

	ob_start();
	wc_print_notices();
	?>
	<main>
		<section class="decoration">
			<div class="container">
				<div class="decoration__head">
					<div class="standart-nav">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Главная</a>
						<a href="<?php echo esc_url( wc_get_cart_url() ); ?>">Корзина</a>
						<p>Оформление заказа</p>
					</div>
					<h1 class="decoration__title">Оформление заказа</h1>
				</div>
				<form name="checkout" method="post" class="checkout decoration__wr" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">
					<div class="decoration__left">
						<div class="decoration__block">
							<p class="decoration__name">Покупатель</p>
							<div class="decoration__inputs">
								<input type="text" name="billing_first_name" class="decoration__input" placeholder="Имя и Фамилия" value="<?php echo esc_attr( $billing_name ); ?>" required>
								<input type="hidden" name="billing_last_name" value="<?php echo esc_attr( $checkout->get_value( 'billing_last_name' ) ); ?>">
								<input type="email" name="billing_email" class="decoration__input" placeholder="Почта" value="<?php echo esc_attr( $billing_email ); ?>" required>
								<input type="tel" name="billing_phone" class="decoration__input" placeholder="Телефон" value="<?php echo esc_attr( $billing_phone ); ?>" required>
								<input type="hidden" name="billing_country" value="RU">
							</div>
						</div>
						<div class="decoration__block">
							<p class="decoration__name">Адрес доставки</p>
							<div class="decoration__inputs">
								<details class="select-box">
									<summary><span><?php echo esc_html( $city['label'] ); ?></span></summary>
									<ul class="dropdown">
										<div class="dropdown-wr">
											<li>Москва</li>
											<li>Санкт-Петербург</li>
										</div>
									</ul>
									<input type="hidden" name="billing_city" value="<?php echo esc_attr( $checkout->get_value( 'billing_city' ) ? $checkout->get_value( 'billing_city' ) : $city['label'] ); ?>">
								</details>
								<div class="shipping__suggest-wr">
									<input type="text" id="checkout-shipping-input" name="billing_address_1" class="decoration__input" placeholder="Адрес" value="<?php echo esc_attr( $checkout->get_value( 'billing_address_1' ) ); ?>" autocomplete="off" required>
									<div class="shipping__suggest-list" id="checkout-shipping-suggest"></div>
								</div>
								<div class="shipping__check-result" id="checkout-shipping-result"></div>
								<input type="hidden" name="dicey_delivery_zone_status" id="checkout-shipping-zone-status" value="">
								<input type="hidden" name="dicey_delivery_normalized_address" id="checkout-shipping-normalized-address" value="">
								<input type="hidden" name="dicey_delivery_geo_lat" id="checkout-shipping-geo-lat" value="">
								<input type="hidden" name="dicey_delivery_geo_lon" id="checkout-shipping-geo-lon" value="">
							</div>
						</div>
						<div class="decoration__block">
							<p class="decoration__name">Промокод</p>
							<div class="decoration__inputs">
								<input type="text" name="dicey_coupon_code" class="decoration__input" placeholder="Введите промокод">
							</div>
						</div>
						<div class="decoration__methods">
							<p class="decoration__name">Способ оплаты</p>
							<div class="decoration__methods-blocks">
								<?php dicey_render_checkout_payment_methods(); ?>
							</div>
						</div>
						<label class="checkbox__parent">
							<input type="checkbox" name="terms" required checked>
							<span class="checkbox__icon"></span>
							<p class="consult__text">
								Я <a href="<?php echo esc_url( home_url( '/personal-data-consent/' ) ); ?>">даю своё согласие на обработку персональных данных</a> и ознакомлен с <a href="<?php echo esc_url( home_url( '/offer/' ) ); ?>">договором оферты</a>
							</p>
						</label>
						<?php wp_nonce_field( 'woocommerce-process_checkout', 'woocommerce-process-checkout-nonce' ); ?>
						<button type="submit" class="decoration__btn" name="woocommerce_checkout_place_order" value="Оформить заказ">Оплатить</button>
					</div>

					<?php dicey_render_checkout_order_summary(); ?>
				</form>
			</div>
		</section>
	</main>
	<?php
	return ob_get_clean();
}
