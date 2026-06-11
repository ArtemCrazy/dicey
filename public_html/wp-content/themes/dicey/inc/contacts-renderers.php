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

function dicey_render_contacts_page( $attrs = array() ) {
	$data = dicey_merge_block_attrs( $attrs, dicey_contacts_defaults() );
	ob_start();
	?>
	<main>
		<section class="about-banner">
			<div class="container">
				<div class="about-banner__wr">
					<?php if ( ! empty( $data['hero_image'] ) ) : ?><img src="<?php echo esc_url( dicey_asset_img( $data['hero_image'] ) ); ?>" alt="" class="about-banner__img"><?php endif; ?>
					<div class="standart-nav"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Главная</a><p>Контакты</p></div>
					<h1 class="about-banner__title"><?php echo dicey_kses_inline( $data['hero_title'] ); ?></h1>
				</div>
			</div>
		</section>
		<section class="apply">
			<div class="container">
				<h2 class="shipping__title"><?php echo dicey_kses_inline( $data['apply_title'] ); ?></h2>
				<div class="apply__blocks">
					<?php foreach ( $data['apply_items'] as $item ) : ?>
						<div class="apply__block">
							<?php if ( ! empty( $item['icon'] ) ) : ?><img src="<?php echo esc_url( dicey_asset_img( $item['icon'] ) ); ?>" alt="" class="apply__icon"><?php endif; ?>
							<p class="apply__name"><?php echo dicey_kses_inline( $item['text'] ); ?></p>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</section>
		<section class="contacts">
			<div class="container">
				<div class="contacts__wr">
					<div class="contacts__blocks">
						<?php foreach ( $data['contact_items'] as $item ) : ?>
							<div class="contacts__block">
								<div class="contacts__icon"><?php if ( ! empty( $item['icon'] ) ) : ?><img src="<?php echo esc_url( dicey_asset_img( $item['icon'] ) ); ?>" alt=""><?php endif; ?></div>
								<a href="<?php echo esc_url( $item['url'] ); ?>"><?php echo esc_html( $item['label'] ); ?></a>
							</div>
						<?php endforeach; ?>
					</div>
					<p class="contacts__info"><?php echo dicey_kses_inline( $data['company_info'] ); ?></p>
				</div>
			</div>
		</section>
	</main>
	<?php
	return ob_get_clean();
}
