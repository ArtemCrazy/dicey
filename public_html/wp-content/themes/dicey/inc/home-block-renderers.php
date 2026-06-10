<?php
/**
 * Render callbacks for editable home page Gutenberg blocks.
 *
 * @package Dicey
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function dicey_home_conveniences_defaults() {
	return array(
		'title' => 'Почему это удобно для Вас',
		'cards' => array(
			array(
				'icon'  => 'imgs/icons/conveniences__icon.svg',
				'title' => 'Экономит ваше <br> время',
				'text'  => 'Доставка до двери. Без закупок, готовки и мытья посуды после кормления',
			),
			array(
				'icon'  => 'imgs/icons/conveniences__icon2.svg',
				'title' => 'Сбалансированный рацион',
				'text'  => 'Учитываем породу, вес и возраст. Все необходимые питательные вещества уже в каждой порции',
			),
			array(
				'icon'  => 'imgs/icons/conveniences__icon3.svg',
				'title' => 'Подача <br> как в ресторане',
				'text'  => 'Аккуратные порции и понятный состав. Еда выглядит эстетично и имеет приятный вкус и аромат',
			),
			array(
				'icon'  => 'imgs/icons/conveniences__icon4.svg',
				'title' => 'Заботимся <br> о природе',
				'text'  => 'Используем экологичный <br> подход к изготовлению <br> упаковки',
			),
		),
	);
}

function dicey_home_delivery_defaults() {
	return array(
		'title'        => 'Регулярные доставки рациона',
		'subtitle'     => 'без повторных заказов',
		'text_first'   => 'Оформите подписку на питание <strong>на 1, 3 или 6 месяцев.</strong> Мы готовим и привозим питание по графику — вам не нужно оформлять заказ каждый раз.',
		'text_second'  => 'Подписку можно оформить при выборе рациона, указав нужный период',
		'button_label' => 'В магазин',
		'button_url'   => '/shop/',
		'image'        => 'imgs/bg/delivery-img.png',
	);
}

function dicey_home_works_defaults() {
	return array(
		'title'      => 'Как это работает',
		'subtitle'   => 'Всего несколько шагов — и питание уже у вас дома',
		'link_label' => 'Подробнее о доставке',
		'link_url'   => '/delivery/',
		'steps'      => array(
			array(
				'title' => 'Выбираете рацион',
				'text'  => 'В онлайн-магазине или с помощью нашего консультанта — с учётом породы, веса, возраста и особенностей собаки',
				'image' => 'imgs/bg/works__block-img1.svg',
				'color' => '',
			),
			array(
				'title' => 'Мы готовим заказ',
				'text'  => 'После оформления и оплаты заказа готовим выбранные рационы',
				'image' => 'imgs/bg/works__block-img2.svg',
				'color' => '#EFF1EB',
			),
			array(
				'title' => 'Доставляем к двери',
				'text'  => 'Свежие рационы приезжают к вам домой в течение 2-х <br> дней после заказа',
				'image' => 'imgs/bg/works__block-img3.svg',
				'color' => '#EEF5FF',
			),
			array(
				'title' => 'Вам остаётся только покормить собаку',
				'text'  => 'Без расчётов рационов, закупок продуктов и готовки — всё уже продумано за Вас',
				'image' => 'imgs/bg/works__block-img4.svg',
				'color' => '#FAF4FF',
			),
		),
	);
}

function dicey_home_questions_defaults() {
	$answer = 'Да, рацион подбирается индивидуально с учётом породы, возраста, веса, уровня активности и особенностей здоровья вашей собаки. Мы учитываем пищевые предпочтения, чувствительное пищеварение, аллергии и другие важные нюансы, чтобы питание было комфортным и полезным именно для вашего питомца.';

	return array(
		'title' => 'часто задаваемые вопросы',
		'tabs'  => array(
			array(
				'title' => 'Питание и состав',
				'items' => array(
					array( 'question' => 'Что входит в рацион?', 'answer' => $answer ),
					array( 'question' => 'Подойдёт ли это моей собаке?', 'answer' => $answer ),
					array( 'question' => 'Можно ли при аллергии или чувствительном пищеварении?', 'answer' => $answer ),
					array( 'question' => 'Это полностью заменяет сухой корм?', 'answer' => $answer ),
					array( 'question' => 'Как перейти с сухого корма на натуральное питание?', 'answer' => $answer ),
				),
			),
			array(
				'title' => 'Доставка и хранение',
				'items' => array(
					array( 'question' => 'Что входит в рацион?', 'answer' => $answer ),
					array( 'question' => 'Подойдёт ли это моей собаке?', 'answer' => $answer ),
					array( 'question' => 'Можно ли при аллергии или чувствительном пищеварении?', 'answer' => $answer ),
					array( 'question' => 'Это полностью заменяет сухой корм?', 'answer' => $answer ),
					array( 'question' => 'Как перейти с сухого корма на натуральное питание?', 'answer' => $answer ),
				),
			),
			array(
				'title' => 'Для владельцев',
				'items' => array(
					array( 'question' => 'Что входит в рацион?', 'answer' => $answer ),
					array( 'question' => 'Подойдёт ли это моей собаке?', 'answer' => $answer ),
					array( 'question' => 'Можно ли при аллергии или чувствительном пищеварении?', 'answer' => $answer ),
					array( 'question' => 'Это полностью заменяет сухой корм?', 'answer' => $answer ),
					array( 'question' => 'Как перейти с сухого корма на натуральное питание?', 'answer' => $answer ),
				),
			),
			array(
				'title' => 'Заказ и оплата',
				'items' => array(
					array( 'question' => 'Что входит в рацион?', 'answer' => $answer ),
					array( 'question' => 'Подойдёт ли это моей собаке?', 'answer' => $answer ),
					array( 'question' => 'Можно ли при аллергии или чувствительном пищеварении?', 'answer' => $answer ),
					array( 'question' => 'Это полностью заменяет сухой корм?', 'answer' => $answer ),
					array( 'question' => 'Как перейти с сухого корма на натуральное питание?', 'answer' => $answer ),
				),
			),
		),
	);
}

function dicey_merge_block_attrs( $attrs, $defaults ) {
	if ( ! is_array( $attrs ) ) {
		return $defaults;
	}

	foreach ( $defaults as $key => $default ) {
		if ( ! array_key_exists( $key, $attrs ) || null === $attrs[ $key ] || '' === $attrs[ $key ] ) {
			$attrs[ $key ] = $default;
			continue;
		}

		if ( is_array( $default ) && is_array( $attrs[ $key ] ) && dicey_is_assoc_array( $default ) ) {
			$attrs[ $key ] = dicey_merge_block_attrs( $attrs[ $key ], $default );
		}
	}

	return $attrs;
}

function dicey_is_assoc_array( $array ) {
	if ( array() === $array ) {
		return false;
	}

	return array_keys( $array ) !== range( 0, count( $array ) - 1 );
}

function dicey_asset_img( $path ) {
	if ( 0 === strpos( $path, 'http://' ) || 0 === strpos( $path, 'https://' ) ) {
		return $path;
	}

	return DICEY_ASSETS_URI . '/' . ltrim( $path, '/' );
}

function dicey_kses_inline( $html ) {
	return wp_kses(
		$html,
		array(
			'br'     => array(),
			'strong' => array(),
			'b'      => array(),
			'em'     => array(),
			'i'      => array(),
			'span'   => array(),
		)
	);
}

function dicey_cta_icon_svg() {
	return '<svg width="26" height="25" viewBox="0 0 26 25" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_2002_287)"><path d="M19.4796 17.2625C18.4227 16.29 17.8689 15.8525 16.9004 14.0013C16.0593 12.3825 15.1103 11.0675 12.9523 11.0675H12.8054C10.6461 11.0675 9.69835 12.3825 8.85725 14.0013C7.88875 15.8525 7.33495 16.29 6.27805 17.2625C5.23935 18.2163 4.28125 19.4163 4.28125 21.0013C4.28125 22.8588 5.66705 24.635 7.87055 24.635C9.54495 24.635 10.8658 23.8075 12.8781 23.7788C14.4837 23.7538 15.6862 24.635 17.8871 24.635C20.0906 24.635 21.6259 22.8588 21.6259 21.0013C21.6259 19.4163 20.6158 18.2675 19.4796 17.2625Z" fill="white"></path><path d="M6.09067 9.98999C5.14817 8.22124 3.88197 7.55999 2.85367 7.61874C1.40807 7.70374 0.351172 9.36499 0.369372 11.215C0.386272 13.1237 1.57187 15.1662 3.42957 15.8412C3.82087 15.9812 4.21347 16.015 4.62297 15.9137C6.24537 15.63 7.43877 13.6037 6.09067 9.98999Z" fill="white"></path><path d="M8.56046 0.375C6.83146 0.375 5.66406 2.14375 5.66406 4.5625C5.66406 7.2575 7.19806 10.0825 9.27286 10.0825C10.9486 10.0825 12.1251 8.24 12.1251 6.1C12.1251 3.77625 10.634 0.375 8.56046 0.375Z" fill="white"></path><path d="M17.415 0.375C15.9954 0.375 14.8943 1.79125 14.1715 3.49375C13.8387 4.33 13.6827 5.21125 13.6918 6.10125C13.7087 8.1525 14.8449 10.1075 16.583 10.1075C18.351 10.1075 20.1437 7.51 20.1437 4.54625C20.1437 2.47875 19.0881 0.375 17.415 0.375Z" fill="white"></path><path d="M23.1072 7.61877C21.6434 7.52627 20.2056 9.12002 19.5491 10.88C18.7626 12.9963 19.3164 15.3288 20.8517 15.85C21.1117 15.9175 21.3717 15.9775 21.6317 15.96C23.3438 15.85 25.1196 13.965 25.5278 11.7638C25.8606 10.0413 24.7868 7.73002 23.1072 7.61877Z" fill="white"></path></g><defs><clipPath id="clip0_2002_287"><rect width="26" height="25" fill="white"></rect></clipPath></defs></svg>';
}

function dicey_faq_icon_svg() {
	return '<svg width="29" height="23" viewBox="0 0 29 23" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_719_9436)"><path d="M13.207 1.95898C14.2337 7.24048 15.8576 12.7843 15.9153 18.209C15.9272 19.3202 16.0498 20.4341 16.1237 21.5423" stroke="#5182A6" stroke-width="2.5" stroke-linecap="round" /><path d="M3 13.5C10.9996 13.1361 18.9979 12.8042 27 12.5" stroke="#5182A6" stroke-width="2.5" stroke-linecap="round" /></g><defs><clipPath id="clip0_719_9436"><rect width="29" height="23" fill="white" /></clipPath></defs></svg>';
}

function dicey_render_home_conveniences( $attrs = array() ) {
	$data = dicey_merge_block_attrs( $attrs, dicey_home_conveniences_defaults() );
	ob_start();
	?>
	<section class="conveniences">
		<div class="container">
			<h2 class="conveniences__title"><?php echo dicey_kses_inline( $data['title'] ); ?></h2>
			<div class="conveniences__blocks">
				<?php foreach ( $data['cards'] as $card ) : ?>
					<div class="conveniences__block">
						<img src="<?php echo esc_url( dicey_asset_img( $card['icon'] ) ); ?>" alt="" class="conveniences__icon">
						<div class="conveniences-info">
							<h3 class="conveniences__name"><?php echo dicey_kses_inline( $card['title'] ); ?></h3>
							<p class="conveniences__text"><?php echo dicey_kses_inline( $card['text'] ); ?></p>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
	<?php
	return ob_get_clean();
}

function dicey_render_home_delivery( $attrs = array() ) {
	$data = dicey_merge_block_attrs( $attrs, dicey_home_delivery_defaults() );
	ob_start();
	?>
	<section class="delivery">
		<div class="container">
			<div class="delivery-block">
				<img src="<?php echo esc_url( dicey_asset_img( $data['image'] ) ); ?>" alt="" class="delivery__img">
				<div class="delivery__content">
					<h2 class="delivery__title"><?php echo dicey_kses_inline( $data['title'] ); ?></h2>
					<p class="delivery__subname"><?php echo dicey_kses_inline( $data['subtitle'] ); ?></p>
					<div class="delivery__text">
						<p><?php echo dicey_kses_inline( $data['text_first'] ); ?></p>
						<p><?php echo dicey_kses_inline( $data['text_second'] ); ?></p>
					</div>
					<a href="<?php echo esc_url( home_url( $data['button_url'] ) ); ?>" class="delivery__link main__link xs-hide">
						<?php echo esc_html( $data['button_label'] ); ?>
						<?php echo dicey_cta_icon_svg(); ?>
					</a>
				</div>
			</div>
			<a href="<?php echo esc_url( home_url( $data['button_url'] ) ); ?>" class="delivery__link main__link xs-show">
				<?php echo esc_html( $data['button_label'] ); ?>
				<?php echo dicey_cta_icon_svg(); ?>
			</a>
		</div>
	</section>
	<?php
	return ob_get_clean();
}

function dicey_render_home_works( $attrs = array() ) {
	$data = dicey_merge_block_attrs( $attrs, dicey_home_works_defaults() );
	ob_start();
	?>
	<section class="works">
		<div class="container">
			<div class="about-food__head">
				<h2 class="about-food__title"><?php echo dicey_kses_inline( $data['title'] ); ?></h2>
				<p class="about-food__text"><?php echo dicey_kses_inline( $data['subtitle'] ); ?></p>
				<a href="<?php echo esc_url( home_url( $data['link_url'] ) ); ?>" class="about-food__link"><?php echo esc_html( $data['link_label'] ); ?></a>
			</div>
			<div class="works__blocks">
				<?php foreach ( $data['steps'] as $step ) : ?>
					<div class="works__block"<?php echo ! empty( $step['color'] ) ? ' style="background-color: ' . esc_attr( $step['color'] ) . ';"' : ''; ?>>
						<span class="works__block-number"></span>
						<div class="works__block-info">
							<p class="works__block-name"><?php echo dicey_kses_inline( $step['title'] ); ?></p>
							<p class="works__block-text"><?php echo dicey_kses_inline( $step['text'] ); ?></p>
							<img src="<?php echo esc_url( dicey_asset_img( $step['image'] ) ); ?>" alt="" class="works__block-img">
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
	<?php
	return ob_get_clean();
}

function dicey_render_home_questions( $attrs = array() ) {
	$data = dicey_merge_block_attrs( $attrs, dicey_home_questions_defaults() );
	ob_start();
	?>
	<section class="questions">
		<div class="container">
			<h2 class="questions__title"><?php echo dicey_kses_inline( $data['title'] ); ?></h2>
			<div class="shipping__tabs">
				<?php foreach ( $data['tabs'] as $tab_index => $tab ) : ?>
					<div class="shipping__tab standart__tab <?php echo 0 === $tab_index ? 'active' : ''; ?>"><?php echo esc_html( $tab['title'] ); ?></div>
				<?php endforeach; ?>
			</div>
			<div class="questions__wr">
				<?php foreach ( $data['tabs'] as $tab_index => $tab ) : ?>
					<div class="standart__tabcontent" style="<?php echo 0 === $tab_index ? 'display: block;' : ''; ?>">
						<div class="questions__blocks">
							<?php foreach ( $tab['items'] as $item_index => $item ) : ?>
								<div class="questions__block <?php echo 1 === $item_index ? 'active' : ''; ?>">
									<div class="questions__top">
										<p><?php echo esc_html( $item['question'] ); ?></p>
										<?php echo dicey_faq_icon_svg(); ?>
									</div>
									<div class="questions__content" style="display: <?php echo 1 === $item_index ? 'block' : 'none'; ?>;">
										<p><?php echo dicey_kses_inline( $item['answer'] ); ?></p>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
	<?php
	return ob_get_clean();
}

