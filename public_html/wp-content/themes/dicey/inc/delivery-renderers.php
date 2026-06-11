<?php
/**
 * Render callback for the editable delivery page.
 *
 * @package Dicey
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function dicey_delivery_defaults() {
	$answer = 'Да, рацион подбирается индивидуально с учётом породы, возраста, веса, уровня активности и особенностей здоровья вашей собаки. Мы учитываем пищевые предпочтения, чувствительное пищеварение, аллергии и другие важные нюансы, чтобы питание было комфортным и полезным именно для вашего питомца.';

	return array(
		'hero_title'        => 'Оплата и доставка <span>до двери</span>',
		'hero_text'         => 'Мы не храним готовую еду — каждый рацион <br> готовится после заказа, чтобы сохранить <br> максимум свежести и пользы',
		'hero_button_label' => 'Выбрать рацион',
		'hero_button_url'   => '/shop/',
		'hero_image'        => 'imgs/bg/main-img3.png',
		'works_title'       => 'Как это работает',
		'works_text'        => 'Всего несколько шагов — и питание уже у вас дома',
		'works_steps'       => dicey_home_works_defaults()['steps'],
		'info_blocks'       => array(
			array(
				'title' => 'доставка',
				'items' => array(
					array( 'label' => 'Сроки', 'text' => 'Заказы, оформленные до 21:00, доставляются в течение 2х дней' ),
					array( 'label' => 'Время', 'text' => 'Доставка осуществляется с 11:00 до 23:00 <br>Время согласовывается заранее курьером' ),
					array( 'label' => 'Стоимость', 'text' => 'Бесплатная доставка по Москве и Санкт-Петербургу' ),
					array( 'label' => 'Важно', 'text' => 'Мы привозим готовые свежие рационы — важно, чтобы вы могли сразу убрать их в холодильник.' ),
				),
			),
			array(
				'title' => 'оплата',
				'items' => array(
					array( 'label' => 'Способы оплаты', 'text' => 'Онлайн-оплата на сайте банковской картой' ),
					array( 'label' => 'Дополнение', 'text' => 'После оплаты вы получаете электронный чек на указанную почту' ),
					array( 'label' => 'Важно', 'text' => 'Каждый заказ готовится индивидуально после оплаты' ),
				),
			),
			array(
				'title' => 'Что происходит после оплаты?',
				'list' => array(
					'Приходит смс-уведомление с номером заказа и датой доставки',
					'Готовим заказ',
					'Доставляем в течение 2х дней курьером. Точное время доставки уточняется у курьера в день доставки',
				),
			),
			array(
				'title' => 'Изменение и отмена',
				'text' => 'Изменение адреса и отмена заказа производится не позднее чем за сутки до даты доставки через нашего специалиста 8(800)000-00-00',
			),
		),
		'faq_title'         => 'часто задаваемые вопросы',
		'faq_items'         => array(
			array( 'question' => 'Можно ли выбрать удобное время доставки?', 'answer' => $answer ),
			array( 'question' => 'Можно ли перенести доставку?', 'answer' => $answer ),
			array( 'question' => 'Как хранить рацион?', 'answer' => $answer ),
			array( 'question' => 'На сколько дней хватает набора?', 'answer' => $answer ),
		),
	);
}

function dicey_render_delivery_page( $attrs = array() ) {
	$data = dicey_merge_block_attrs( $attrs, dicey_delivery_defaults() );
	$works_steps = dicey_non_empty_items( $data['works_steps'] );
	$info_blocks = dicey_non_empty_items( $data['info_blocks'] );
	$faq_items   = dicey_non_empty_items( $data['faq_items'] );

	if ( ! dicey_has_value( $data ) ) {
		return '';
	}

	ob_start();
	?>
	<main>
		<?php if ( '' !== trim( $data['hero_title'] ) || '' !== trim( $data['hero_text'] ) || ! empty( $data['hero_image'] ) ) : ?>
			<section class="main main3">
				<div class="container">
					<div class="main-wr">
						<div class="standart-nav"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Главная</a><p>Доставка и оплата</p></div>
						<?php if ( '' !== trim( $data['hero_title'] ) ) : ?><h1 class="main__title"><?php echo dicey_kses_inline( $data['hero_title'] ); ?></h1><?php endif; ?>
						<?php if ( '' !== trim( $data['hero_text'] ) ) : ?><p class="main__text"><?php echo dicey_kses_inline( $data['hero_text'] ); ?></p><?php endif; ?>
						<?php if ( '' !== trim( $data['hero_button_label'] ) && '' !== trim( $data['hero_button_url'] ) ) : ?><a href="<?php echo esc_url( home_url( $data['hero_button_url'] ) ); ?>" class="main__link xs-hide"><?php echo esc_html( $data['hero_button_label'] ); ?><?php echo dicey_cta_icon_svg(); ?></a><?php endif; ?>
					</div>
					<?php if ( ! empty( $data['hero_image'] ) ) : ?><img src="<?php echo esc_url( dicey_asset_img( $data['hero_image'] ) ); ?>" alt="" class="main__img"><?php endif; ?>
					<?php if ( '' !== trim( $data['hero_button_label'] ) && '' !== trim( $data['hero_button_url'] ) ) : ?><a href="<?php echo esc_url( home_url( $data['hero_button_url'] ) ); ?>" class="main__link xs-show"><?php echo esc_html( $data['hero_button_label'] ); ?><?php echo dicey_cta_icon_svg(); ?></a><?php endif; ?>
				</div>
			</section>
		<?php endif; ?>
		<?php if ( '' !== trim( $data['works_title'] ) || '' !== trim( $data['works_text'] ) || $works_steps ) : ?>
			<section class="works works2">
				<div class="container">
					<div class="about-food__head">
						<?php if ( '' !== trim( $data['works_title'] ) ) : ?><h2 class="about-food__title"><?php echo dicey_kses_inline( $data['works_title'] ); ?></h2><?php endif; ?>
						<?php if ( '' !== trim( $data['works_text'] ) ) : ?><p class="about-food__text"><?php echo dicey_kses_inline( $data['works_text'] ); ?></p><?php endif; ?>
					</div>
					<?php if ( $works_steps ) : ?><div class="works__blocks">
						<?php foreach ( $works_steps as $step ) : ?>
							<div class="works__block"<?php echo ! empty( $step['color'] ) ? ' style="background-color: ' . esc_attr( $step['color'] ) . ';"' : ''; ?>>
								<span class="works__block-number"></span>
								<div class="works__block-info">
									<?php if ( ! empty( $step['title'] ) ) : ?><p class="works__block-name"><?php echo dicey_kses_inline( $step['title'] ); ?></p><?php endif; ?>
									<?php if ( ! empty( $step['text'] ) ) : ?><p class="works__block-text"><?php echo dicey_kses_inline( $step['text'] ); ?></p><?php endif; ?>
									<?php if ( ! empty( $step['image'] ) ) : ?><img src="<?php echo esc_url( dicey_asset_img( $step['image'] ) ); ?>" alt="" class="works__block-img"><?php endif; ?>
								</div>
							</div>
						<?php endforeach; ?>
					</div><?php endif; ?>
				</div>
			</section>
		<?php endif; ?>
		<?php if ( $info_blocks ) : ?>
			<section class="functional">
				<div class="container">
					<?php foreach ( $info_blocks as $block ) : ?>
						<?php
						$items = dicey_non_empty_items( isset( $block['items'] ) ? $block['items'] : array() );
						$list  = dicey_non_empty_items( isset( $block['list'] ) ? $block['list'] : array() );
						?>
						<div class="functional__block">
							<?php if ( ! empty( $block['title'] ) ) : ?><p class="functional__name"><?php echo dicey_kses_inline( $block['title'] ); ?></p><?php endif; ?>
							<?php if ( $items || $list || ! empty( $block['text'] ) ) : ?><div class="functional__content">
								<?php if ( $items ) : ?>
									<?php foreach ( $items as $item ) : ?><?php if ( ! empty( $item['label'] ) ) : ?><span><?php echo dicey_kses_inline( $item['label'] ); ?></span><?php endif; ?><?php if ( ! empty( $item['text'] ) ) : ?><p><?php echo dicey_kses_inline( $item['text'] ); ?></p><?php endif; ?><?php endforeach; ?>
								<?php elseif ( $list ) : ?>
									<ul><?php foreach ( $list as $item ) : ?><li><?php echo dicey_kses_inline( $item ); ?></li><?php endforeach; ?></ul>
								<?php elseif ( ! empty( $block['text'] ) ) : ?>
									<p><?php echo dicey_kses_inline( $block['text'] ); ?></p>
								<?php endif; ?>
							</div><?php endif; ?>
						</div>
					<?php endforeach; ?>
				</div>
			</section>
		<?php endif; ?>
		<?php if ( '' !== trim( $data['faq_title'] ) || $faq_items ) : ?>
			<section class="questions2">
				<div class="container">
					<?php if ( '' !== trim( $data['faq_title'] ) ) : ?><h2 class="popularity__title"><?php echo dicey_kses_inline( $data['faq_title'] ); ?></h2><?php endif; ?>
					<?php if ( $faq_items ) : ?><div class="questions__blocks">
						<?php foreach ( $faq_items as $item ) : ?>
							<div class="questions__block">
								<div class="questions__top"><?php if ( ! empty( $item['question'] ) ) : ?><p><?php echo esc_html( $item['question'] ); ?></p><?php endif; ?><?php echo dicey_faq_icon_svg(); ?></div>
								<?php if ( ! empty( $item['answer'] ) ) : ?><div class="questions__content" style="display: none;"><p><?php echo dicey_kses_inline( $item['answer'] ); ?></p></div><?php endif; ?>
							</div>
						<?php endforeach; ?>
					</div><?php endif; ?>
				</div>
			</section>
		<?php endif; ?>
	</main>
	<?php
	return ob_get_clean();
}
