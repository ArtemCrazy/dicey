<?php
/**
 * Render callback for the editable contacts page.
 *
 * @package Dicey
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function dicey_contacts_defaults() {
	return array(
		'hero_title'   => 'Контакты',
		'hero_image'   => 'imgs/bg/about-banner___img2.png',
		'apply_title'  => 'по каким вопросам к нам <br> можно обратиться?',
		'apply_items'  => array(
			array( 'icon' => 'imgs/icons/apply__icon1.svg', 'text' => 'Подбор рациона' ),
			array( 'icon' => 'imgs/icons/apply__icon2.svg', 'text' => 'Вопросы по заказу' ),
			array( 'icon' => 'imgs/icons/apply__icon3.svg', 'text' => 'Уточнение доставки' ),
			array( 'icon' => 'imgs/icons/apply__icon4.svg', 'text' => 'Консультация диетолога' ),
		),
		'contact_items' => array(
			array( 'icon' => 'imgs/icons/contacts__icon1.svg', 'label' => '+1 (555) 000-0000', 'url' => 'tel:+15550000000' ),
			array( 'icon' => 'imgs/icons/contacts__icon2.svg', 'label' => 'info@mail.ru', 'url' => 'mailto:info@mail.ru' ),
			array( 'icon' => 'imgs/icons/contacts__icon3.svg', 'label' => '+1 (555) 000-0000', 'url' => 'tel:+15550000000' ),
		),
		'company_info' => 'ООО «ДАЙСИ», 192171, город Санкт-Петербург, ул Седова, д.. 70 литера. А <br> ОГРН 1267800025283 / ИНН 7811815173 / КПП 781101001',
	);
}

function dicey_contacts_data( $attrs = array() ) {
	return dicey_merge_block_attrs( $attrs, dicey_contacts_defaults() );
}

function dicey_render_contacts_page( $attrs = array() ) {
	$data = dicey_contacts_data( $attrs );
	$apply_items   = dicey_non_empty_items( $data['apply_items'] );
	$contact_items = dicey_non_empty_items( $data['contact_items'] );

	if ( ! dicey_has_value( $data ) ) {
		return '';
	}

	ob_start();
	?>
	<main>
		<?php if ( '' !== trim( $data['hero_title'] ) || ! empty( $data['hero_image'] ) ) : ?>
			<section class="about-banner">
				<div class="container">
					<div class="about-banner__wr">
						<?php if ( ! empty( $data['hero_image'] ) ) : ?><img src="<?php echo esc_url( dicey_asset_img( $data['hero_image'] ) ); ?>" alt="" class="about-banner__img"><?php endif; ?>
						<div class="standart-nav"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Главная</a><p>Контакты</p></div>
						<?php if ( '' !== trim( $data['hero_title'] ) ) : ?><h1 class="about-banner__title"><?php echo dicey_kses_inline( $data['hero_title'] ); ?></h1><?php endif; ?>
					</div>
				</div>
			</section>
		<?php endif; ?>
		<?php if ( '' !== trim( $data['apply_title'] ) || $apply_items ) : ?>
			<section class="apply">
				<div class="container">
					<?php if ( '' !== trim( $data['apply_title'] ) ) : ?><h2 class="shipping__title"><?php echo dicey_kses_inline( $data['apply_title'] ); ?></h2><?php endif; ?>
					<?php if ( $apply_items ) : ?><div class="apply__blocks">
						<?php foreach ( $apply_items as $item ) : ?>
							<div class="apply__block">
								<?php if ( ! empty( $item['icon'] ) ) : ?><img src="<?php echo esc_url( dicey_asset_img( $item['icon'] ) ); ?>" alt="" class="apply__icon"><?php endif; ?>
								<?php if ( ! empty( $item['text'] ) ) : ?><p class="apply__name"><?php echo dicey_kses_inline( $item['text'] ); ?></p><?php endif; ?>
							</div>
						<?php endforeach; ?>
					</div><?php endif; ?>
				</div>
			</section>
		<?php endif; ?>
		<?php if ( $contact_items || '' !== trim( $data['company_info'] ) ) : ?>
			<section class="contacts">
				<div class="container">
					<div class="contacts__wr">
						<?php if ( $contact_items ) : ?><div class="contacts__blocks">
							<?php foreach ( $contact_items as $item ) : ?>
								<div class="contacts__block">
									<?php if ( ! empty( $item['icon'] ) ) : ?><div class="contacts__icon"><img src="<?php echo esc_url( dicey_asset_img( $item['icon'] ) ); ?>" alt=""></div><?php endif; ?>
									<?php if ( ! empty( $item['label'] ) ) : ?><a href="<?php echo esc_url( ! empty( $item['url'] ) ? $item['url'] : '#' ); ?>"><?php echo esc_html( $item['label'] ); ?></a><?php endif; ?>
								</div>
							<?php endforeach; ?>
						</div><?php endif; ?>
						<?php if ( '' !== trim( $data['company_info'] ) ) : ?><p class="contacts__info"><?php echo dicey_kses_inline( $data['company_info'] ); ?></p><?php endif; ?>
					</div>
				</div>
			</section>
		<?php endif; ?>
	</main>
	<?php
	return ob_get_clean();
}
