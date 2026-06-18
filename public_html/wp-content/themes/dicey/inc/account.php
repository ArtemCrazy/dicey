<?php
/**
 * Customer account views.
 *
 * @package Dicey
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'template_redirect', 'dicey_handle_account_updates' );
add_filter( 'woocommerce_login_redirect', 'dicey_account_auth_redirect', 10, 2 );
add_filter( 'woocommerce_registration_redirect', 'dicey_account_auth_redirect', 10, 1 );

function dicey_account_sections() {
	return array(
		'orders'    => 'Мои заказы',
		'profile'   => 'Мой профиль',
		'vet'       => 'Ветеринария',
		'addresses' => 'Адреса доставки',
	);
}

function dicey_current_account_section() {
	$section  = isset( $_GET['lk_section'] ) ? sanitize_key( wp_unslash( $_GET['lk_section'] ) ) : 'profile';
	$sections = dicey_account_sections();

	return isset( $sections[ $section ] ) ? $section : 'profile';
}

function dicey_account_url( $section = 'profile' ) {
	$page = get_page_by_path( 'lk' );
	$url  = $page ? get_permalink( $page ) : home_url( '/lk/' );

	if ( 'profile' === $section ) {
		return $url;
	}

	return add_query_arg( 'lk_section', $section, $url );
}

function dicey_account_auth_redirect( $redirect, $user = null ) {
	if ( ! empty( $_POST['redirect'] ) ) {
		$posted_redirect = esc_url_raw( wp_unslash( $_POST['redirect'] ) );

		return wp_validate_redirect( $posted_redirect, dicey_account_url( 'profile' ) );
	}

	return $redirect;
}

function dicey_handle_account_updates() {
	if ( ! is_user_logged_in() || empty( $_POST['dicey_account_action'] ) ) {
		return;
	}

	$action = sanitize_key( wp_unslash( $_POST['dicey_account_action'] ) );

	if ( 'profile' === $action ) {
		check_admin_referer( 'dicey_save_account_profile', 'dicey_account_nonce' );
		dicey_save_account_profile();
		wp_safe_redirect( add_query_arg( 'account_saved', '1', dicey_account_url( 'profile' ) ) );
		exit;
	}

	if ( 'address' === $action ) {
		check_admin_referer( 'dicey_save_account_address', 'dicey_account_nonce' );
		dicey_save_account_address();
		wp_safe_redirect( add_query_arg( array( 'lk_section' => 'addresses', 'address_saved' => '1' ), dicey_account_url( 'profile' ) ) );
		exit;
	}
}

function dicey_save_account_profile() {
	$user_id    = get_current_user_id();
	$first_name = isset( $_POST['first_name'] ) ? sanitize_text_field( wp_unslash( $_POST['first_name'] ) ) : '';
	$last_name  = isset( $_POST['last_name'] ) ? sanitize_text_field( wp_unslash( $_POST['last_name'] ) ) : '';
	$email      = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
	$phone      = isset( $_POST['phone'] ) ? sanitize_text_field( wp_unslash( $_POST['phone'] ) ) : '';

	$user_data = array(
		'ID'           => $user_id,
		'first_name'   => $first_name,
		'last_name'    => $last_name,
		'display_name' => trim( $first_name . ' ' . $last_name ),
	);

	if ( is_email( $email ) ) {
		$user_data['user_email'] = $email;
	}

	wp_update_user( $user_data );
	update_user_meta( $user_id, 'billing_first_name', $first_name );
	update_user_meta( $user_id, 'billing_last_name', $last_name );
	update_user_meta( $user_id, 'billing_email', $email );
	update_user_meta( $user_id, 'billing_phone', $phone );
}

function dicey_save_account_address() {
	$user_id = get_current_user_id();
	$city    = isset( $_POST['billing_city'] ) ? sanitize_text_field( wp_unslash( $_POST['billing_city'] ) ) : '';
	$address = isset( $_POST['billing_address_1'] ) ? sanitize_text_field( wp_unslash( $_POST['billing_address_1'] ) ) : '';

	update_user_meta( $user_id, 'billing_country', 'RU' );
	update_user_meta( $user_id, 'shipping_country', 'RU' );
	update_user_meta( $user_id, 'billing_city', $city );
	update_user_meta( $user_id, 'shipping_city', $city );
	update_user_meta( $user_id, 'billing_address_1', $address );
	update_user_meta( $user_id, 'shipping_address_1', $address );
}

function dicey_render_account_page() {
	if ( ! function_exists( 'WC' ) ) {
		return function_exists( 'dicey_missing_content_notice' ) ? dicey_missing_content_notice( 'Личный кабинет' ) : '';
	}

	ob_start();
	wc_print_notices();

	if ( ! is_user_logged_in() ) {
		dicey_render_account_auth();
		return ob_get_clean();
	}

	$section  = dicey_current_account_section();
	$sections = dicey_account_sections();
	?>
	<main>
		<section class="lk">
			<div class="container">
				<div class="decoration__head">
					<div class="standart-nav">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Главная</a>
						<p>Личный кабинет</p>
					</div>
					<h1 class="decoration__title"><?php echo esc_html( $sections[ $section ] ); ?></h1>
				</div>
				<div class="lk__wr">
					<div class="lk__nav">
						<?php foreach ( $sections as $section_key => $label ) : ?>
							<a class="lk__nav-item <?php echo $section === $section_key ? 'active' : ''; ?>" href="<?php echo esc_url( dicey_account_url( $section_key ) ); ?>"><?php echo esc_html( $label ); ?></a>
						<?php endforeach; ?>
						<a class="lk__nav-item" href="<?php echo esc_url( wc_logout_url( home_url( '/' ) ) ); ?>">Выйти</a>
					</div>
					<div class="lk__contents">
						<div class="lk__content">
							<?php
							if ( 'orders' === $section ) {
								dicey_render_account_orders();
							} elseif ( 'vet' === $section ) {
								dicey_render_account_vet();
							} elseif ( 'addresses' === $section ) {
								dicey_render_account_addresses();
							} else {
								dicey_render_account_profile();
							}
							?>
						</div>
					</div>
				</div>
			</div>
		</section>
	</main>
	<?php
	return ob_get_clean();
}

function dicey_render_account_auth() {
	?>
	<main>
		<section class="lk">
			<div class="container">
				<div class="decoration__head">
					<div class="standart-nav">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Главная</a>
						<p>Личный кабинет</p>
					</div>
					<h1 class="decoration__title">Личный кабинет</h1>
				</div>
				<div class="lk__wr dicey-account-auth">
					<div class="lk__contents">
						<div class="lk__content">
							<?php if ( function_exists( 'wc_print_notices' ) ) { wc_print_notices(); } ?>
							<div class="dicey-account-auth__grid">
								<form method="post" class="lk__form" action="<?php echo esc_url( dicey_account_url( 'profile' ) ); ?>">
									<p class="decoration__name">Вход</p>
									<div class="lk__form-blocks">
										<div class="lk__form-block">
											<p class="lk__form-name">Почта:</p>
											<input type="email" class="lk__form-input" name="username" autocomplete="email" required>
										</div>
										<div class="lk__form-block">
											<p class="lk__form-name">Пароль:</p>
											<input type="password" class="lk__form-input" name="password" autocomplete="current-password" required>
										</div>
									</div>
									<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
									<input type="hidden" name="redirect" value="<?php echo esc_url( dicey_account_url( 'profile' ) ); ?>">
									<div class="lk__form-btns">
										<button type="submit" class="lk__form-btn-save" name="login" value="Войти">Войти</button>
									</div>
								</form>
								<form method="post" class="lk__form" action="<?php echo esc_url( dicey_account_url( 'profile' ) ); ?>">
									<p class="decoration__name">Регистрация</p>
									<div class="lk__form-blocks">
										<div class="lk__form-block">
											<p class="lk__form-name">Почта:</p>
											<input type="email" class="lk__form-input" name="email" autocomplete="email" required>
										</div>
										<div class="lk__form-block">
											<p class="lk__form-name">Пароль:</p>
											<input type="password" class="lk__form-input" name="password" autocomplete="new-password" required>
										</div>
									</div>
									<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
									<input type="hidden" name="redirect" value="<?php echo esc_url( dicey_account_url( 'profile' ) ); ?>">
									<div class="lk__form-btns">
										<button type="submit" class="lk__form-btn-save" name="register" value="Зарегистрироваться">Зарегистрироваться</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</main>
	<?php
}

function dicey_render_account_profile() {
	$user_id = get_current_user_id();
	$user    = wp_get_current_user();
	?>
	<?php if ( ! empty( $_GET['account_saved'] ) ) : ?><p class="dicey-account-notice">Данные сохранены.</p><?php endif; ?>
	<form class="lk__form" method="post">
		<input type="hidden" name="dicey_account_action" value="profile">
		<?php wp_nonce_field( 'dicey_save_account_profile', 'dicey_account_nonce' ); ?>
		<div class="lk__form-blocks">
			<div class="lk__form-block">
				<p class="lk__form-name">Имя:</p>
				<input type="text" name="first_name" class="lk__form-input" value="<?php echo esc_attr( get_user_meta( $user_id, 'first_name', true ) ); ?>">
			</div>
			<div class="lk__form-block">
				<p class="lk__form-name">Фамилия:</p>
				<input type="text" name="last_name" class="lk__form-input" value="<?php echo esc_attr( get_user_meta( $user_id, 'last_name', true ) ); ?>">
			</div>
			<div class="lk__form-block">
				<p class="lk__form-name">Почта:</p>
				<input type="email" name="email" class="lk__form-input" value="<?php echo esc_attr( $user->user_email ); ?>">
			</div>
			<div class="lk__form-block">
				<p class="lk__form-name">Номер телефона:</p>
				<input type="tel" name="phone" class="lk__form-input" value="<?php echo esc_attr( get_user_meta( $user_id, 'billing_phone', true ) ); ?>">
			</div>
		</div>
		<div class="lk__form-btns">
			<button type="submit" class="lk__form-btn-save">Сохранить</button>
			<a href="<?php echo esc_url( dicey_account_url( 'profile' ) ); ?>" class="lk__form-btn-cancel">Отменить</a>
		</div>
	</form>
	<?php
}

function dicey_render_account_empty_state( $title, $text, $button_label = '', $button_url = '' ) {
	?>
	<div class="dicey-account-empty">
		<p class="dicey-account-empty__title"><?php echo esc_html( $title ); ?></p>
		<p class="dicey-account-empty__text"><?php echo esc_html( $text ); ?></p>
		<?php if ( $button_label && $button_url ) : ?>
			<a href="<?php echo esc_url( $button_url ); ?>" class="lk-vet__btn"><?php echo esc_html( $button_label ); ?></a>
		<?php endif; ?>
	</div>
	<?php
}

function dicey_render_account_orders() {
	if ( ! function_exists( 'wc_get_orders' ) ) {
		return;
	}

	$orders = wc_get_orders(
		array(
			'customer_id' => get_current_user_id(),
			'limit'       => 20,
			'orderby'     => 'date',
			'order'       => 'DESC',
		)
	);

	if ( ! $orders ) {
		dicey_render_account_empty_state( 'Заказов пока нет', 'Когда вы оформите первый рацион, он появится здесь вместе со статусом и деталями.', 'Перейти в магазин', home_url( '/shop/' ) );
		return;
	}

	$has_product_orders = false;
	foreach ( $orders as $order ) {
		foreach ( $order->get_items() as $item ) {
			$product = $item->get_product();
			if ( $product && function_exists( 'dicey_is_consultation_product' ) && dicey_is_consultation_product( $product->get_id() ) ) {
				continue;
			}

			$has_product_orders = true;
			$meta    = $product && function_exists( 'dicey_get_product_meta' ) ? dicey_get_product_meta( $product->get_parent_id() ? $product->get_parent_id() : $product->get_id() ) : array();
			?>
			<div class="lk__history-block">
				<div class="lk__history-info">
					<p class="lk__history-name"><?php echo esc_html( $item->get_name() ); ?></p>
					<?php foreach ( $item->get_meta_data() as $meta_item ) : ?>
						<?php if ( false !== mb_stripos( $meta_item->key, 'срок' ) || false !== stripos( $meta_item->key, 'period' ) ) : ?>
							<p class="lk__history-day"><?php echo esc_html( $meta_item->value ); ?></p>
						<?php endif; ?>
					<?php endforeach; ?>
					<?php if ( ! empty( $meta['calories'] ) ) : ?><p class="lk__history-kbju"><?php echo esc_html( $meta['calories'] ); ?></p><?php endif; ?>
				</div>
				<div class="lk__history-wr">
					<p class="lk__history-data"><?php echo esc_html( wc_format_datetime( $order->get_date_created(), 'd.m.Y, H:i' ) ); ?></p>
					<a class="lk__cheque" href="<?php echo esc_url( $order->get_view_order_url() ); ?>">Чек</a>
					<?php if ( $product ) : ?><a class="lk__repeat" href="<?php echo esc_url( $product->add_to_cart_url() ); ?>">Повторить</a><?php endif; ?>
				</div>
			</div>
			<?php
		}
	}

	if ( ! $has_product_orders ) {
		dicey_render_account_empty_state( 'Рационов пока нет', 'Здесь будут отображаться только заказы рационов. Консультации вынесены в отдельный раздел.', 'Перейти в магазин', home_url( '/shop/' ) );
	}
}

function dicey_render_account_addresses() {
	$user_id = get_current_user_id();
	$city    = get_user_meta( $user_id, 'billing_city', true );
	$address = get_user_meta( $user_id, 'billing_address_1', true );
	?>
	<?php if ( ! empty( $_GET['address_saved'] ) ) : ?><p class="dicey-account-notice">Адрес сохранен.</p><?php endif; ?>
	<?php if ( '' === trim( $city ) && '' === trim( $address ) ) : ?>
		<?php dicey_render_account_empty_state( 'Адрес не добавлен', 'Добавьте город и адрес доставки, чтобы быстрее оформлять следующие заказы.' ); ?>
	<?php endif; ?>
	<form method="post" class="lk__address-wr">
		<input type="hidden" name="dicey_account_action" value="address">
		<?php wp_nonce_field( 'dicey_save_account_address', 'dicey_account_nonce' ); ?>
		<div class="lk__address-blocks">
			<div class="lk__address-block">
				<p class="lk__address-name">Город:</p>
				<div class="lk__address-info"><input type="text" name="billing_city" value="<?php echo esc_attr( $city ); ?>" placeholder="Москва"></div>
			</div>
			<div class="lk__address-block">
				<p class="lk__address-name">Адрес:</p>
				<div class="lk__address-info"><input type="text" name="billing_address_1" value="<?php echo esc_attr( $address ); ?>" placeholder="г. Москва, ул. Тверская, д. 12, кв. 45"></div>
			</div>
		</div>
		<button type="submit" class="lk__address-btn">Сохранить адрес</button>
	</form>
	<?php
}

function dicey_render_account_vet() {
	$consultations = dicey_get_customer_consultations( get_current_user_id() );

	if ( ! $consultations ) {
		echo '<div class="lk-vet">';
		echo '<p class="lk-vet__text">У вас еще нет консультаций у ветеринара</p>';
		echo '<a href="' . esc_url( home_url( '/dietology/' ) ) . '" class="lk-vet__btn">Получить консультацию</a>';
		echo '</div>';
		return;
	}

	foreach ( $consultations as $index => $consultation ) {
		$title = ! empty( $consultation['title'] ) ? $consultation['title'] : 'Консультация с диетологом';
		?>
		<div class="questions__block <?php echo 0 === $index ? 'active' : ''; ?>">
			<div class="questions__top">
				<p><?php echo esc_html( $title ); ?></p>
				<?php echo function_exists( 'dicey_faq_icon_svg' ) ? dicey_faq_icon_svg() : ''; ?>
			</div>
			<div class="questions__content" style="<?php echo 0 === $index ? 'display: block;' : 'display: none;'; ?>">
				<div class="questions__content-wr">
					<?php foreach ( $consultation as $key => $value ) : ?>
						<?php if ( 'title' === $key || '' === $value ) { continue; } ?>
						<div class="questions__line <?php echo 'Рекомендации диетолога' === $key ? 'rec' : ''; ?>">
							<p><?php echo esc_html( $key ); ?></p>
							<p><?php echo esc_html( $value ); ?></p>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
		<?php
	}
}

function dicey_get_customer_consultations( $user_id ) {
	$items = array();

	if ( function_exists( 'wc_get_orders' ) && function_exists( 'dicey_is_consultation_product' ) ) {
		$orders = wc_get_orders(
			array(
				'customer_id' => $user_id,
				'limit'       => 50,
				'orderby'     => 'date',
				'order'       => 'DESC',
			)
		);

		foreach ( $orders as $order ) {
			foreach ( $order->get_items() as $order_item ) {
				$product = $order_item->get_product();
				if ( ! $product || ! dicey_is_consultation_product( $product->get_id() ) ) {
					continue;
				}

				$consultation = array(
					'title'  => $order_item->get_name() . ' от ' . wc_format_datetime( $order->get_date_created(), 'd.m.y' ),
					'Дата'   => wc_format_datetime( $order->get_date_created(), 'd.m.Y' ),
					'Статус' => wc_get_order_status_name( $order->get_status() ),
					'Заказ'  => '#' . $order->get_order_number(),
				);

				foreach ( $order_item->get_meta_data() as $meta ) {
					$data = $meta->get_data();
					if ( empty( $data['key'] ) || empty( $data['value'] ) || '_' === substr( $data['key'], 0, 1 ) ) {
						continue;
					}
					$consultation[ $data['key'] ] = $data['value'];
				}

				$items[] = $consultation;
			}
		}
	}

	if ( $items ) {
		return $items;
	}

	$legacy = get_user_meta( $user_id, 'dicey_consultations', true );
	return is_array( $legacy ) ? $legacy : array();
}
