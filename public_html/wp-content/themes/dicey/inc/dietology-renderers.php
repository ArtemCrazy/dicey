<?php
/**
 * Render callback for the editable dietology page.
 *
 * @package Dicey
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function dicey_dietology_defaults() {
	$answer = 'Да, рацион подбирается индивидуально с учётом породы, возраста, веса, уровня активности и особенностей здоровья вашей собаки. Мы учитываем пищевые предпочтения, чувствительное пищеварение, аллергии и другие важные нюансы, чтобы питание было комфортным и полезным именно для вашего питомца.';

	return array(
		'hero_title'        => 'Правильное питание',
		'hero_accent'       => '— основа здоровья собаки',
		'hero_text'         => 'Подберем и приготовим рацион с учётом возраста, породы и состояния здоровья вашего питомца',
		'hero_button_label' => 'получить консультацию',
		'hero_mobile_label' => 'Выбрать рацион',
		'consult_title'     => 'Вам нужна консультация если у Вас:',
		'consult_items'     => array(
			array( 'icon' => 'imgs/bg/consultation__img1.svg', 'text' => 'Щенок' ),
			array( 'icon' => 'imgs/bg/consultation__img2.svg', 'text' => 'Беременная или лактирующая собака' ),
			array( 'icon' => 'imgs/bg/consultation__img3.svg', 'text' => 'Питомец с лишним или недостаточным весом' ),
			array( 'icon' => 'imgs/bg/consultation__img4.svg', 'text' => 'У собаки есть заболевания' ),
			array( 'icon' => 'imgs/bg/consultation__img5.svg', 'icon_mobile' => 'imgs/bg/consultation__img7.svg', 'text' => 'Собака с пищевой аллергия или непереносимостью' ),
			array( 'icon' => 'imgs/bg/consultation__img6.svg', 'text' => 'Ваш хвостик привередлив в еде' ),
		),
		'plan_person_name'  => 'Босунова Наталья',
		'plan_person_role'  => 'Главный ветеринар-диетолог <br> компании',
		'plan_person_image' => 'imgs/bg/plan__img2.png',
		'plan_title'        => 'Составление рациона питания',
		'plan_subtitle'     => 'ветеринарным врачом-диетологом',
		'plan_text'         => 'Поможем разобраться в рационе и подобрать питание с учётом особенностей собаки. Рекомендации подходят для ежедневного кормления и легко применяются на практике',
		'plan_link_label'   => 'Смотреть все сертификаты',
		'plan_certificates' => array(
			array( 'image' => 'imgs/bg/plan__img1.png' ),
			array( 'image' => 'imgs/bg/plan__img3.png' ),
		),
		'advisory_title'    => 'Как проходит консультация',
		'advisory_steps'    => array(
			array( 'title' => 'Заполняете заявку и оплачиваете консультацию', 'text' => 'Оставляете контактные данные, <br> чтобы мы могли связаться с вами', 'button' => 'Получить консультацию' ),
			array( 'title' => 'Заполняете анкету о вашей собаке', 'text' => 'После оплаты вы получаете на почту короткую анкету (3–5 минут). После её заполнения мы свяжемся с вами и согласуем время онлайн-консультации с диетологом', 'icon' => 'imgs/icons/advisory__icon.svg' ),
			array( 'title' => 'Диетолог проводит консультацию', 'text' => 'Изучаем особенности вашей собаки, отвечаем на вопросы и уточняетм все особенности питания собаки', 'icon' => 'imgs/icons/advisory__icon2.svg' ),
			array( 'title' => 'Мы составляем рацион', 'text' => 'Составляем подходящее меню по результатам консультации', 'icon' => 'imgs/icons/advisory__icon3.svg' ),
			array( 'title' => 'Передаём план питания', 'text' => 'и при необходимости оформляем доставку', 'icon' => 'imgs/icons/advisory__icon4.svg' ),
		),
		'advantages_title'  => 'Что вы получите после <br> консультации',
		'advantages'        => array(
			array( 'image' => 'imgs/bg/advantages__img1.png', 'title' => 'Понятный <br> план питания' ),
			array( 'image' => 'imgs/bg/advantages__img.png', 'title' => 'Подходящий <br> рацион' ),
			array( 'image' => 'imgs/bg/advantages__img3.svg', 'title' => 'Рекомендации <br> по кормлению' ),
			array( 'image' => 'imgs/bg/advantages__img4.png', 'title' => 'Уверенность <br> в выборе питания' ),
		),
		'price_title'       => 'Стоимость консультаций',
		'prices'            => array(
			array( 'title' => 'Консультация ветеринарного врача диетолога/гастроэнтеролога', 'text' => 'При заказе рациона стоимость консультации возвращается при оплате, без заказа рациона стоимость 1500 руб.', 'items' => array( 'Ответы на вопросы', 'Разбор анализов и дополнительных исследований', 'Рекомендации по лечению' ), 'button' => 'Заказать консультацию и подобрать рацион' ),
			array( 'title' => 'Подбор рациона для здорового питомца', 'text' => 'При заказе рациона стоимость консультации возвращается при оплате, без заказа рациона стоимость 3000 руб.', 'items' => array( 'Составление индивидуального рациона питания', 'Ответы на вопросы по рациону', 'Рекомендации по лечению' ), 'button' => 'Заказать консультацию и подобрать рацион' ),
			array( 'title' => 'Подбор рациона для питомца с заболеванием', 'text' => 'При заказе рациона стоимость консультации возвращается при оплате, без заказа рациона стоимость 3500 руб.', 'items' => array( 'Индивидуальное составление рациона питания при заболевании', 'Ответы на вопросы по рациону', 'Рекомендации по кормлению' ), 'button' => 'Заказать консультацию и подобрать рацион' ),
			array( 'title' => 'Ведение', 'text' => 'При заказе рациона стоимость консультации возвращается при оплате, без заказа рациона стоимость 2500 руб.', 'items' => array( 'Необходимо для питомцев с заболеваниями, чтобы контролировать состояние питомца и по необходимости корректировать лечение', 'Ответы на вопросы по рациону', 'Рекомендации по кормлению' ), 'button' => 'Заказать консультацию и подобрать рацион' ),
		),
		'faq_title'         => 'часто задаваемые вопросы',
		'faq_items'         => array(
			array( 'question' => 'Что входит в консультацию?', 'answer' => $answer ),
			array( 'question' => 'Кто проводит консультацию?', 'answer' => $answer ),
			array( 'question' => 'Консультация проходит онлайн или офлайн?', 'answer' => $answer ),
			array( 'question' => 'Можно задать любые вопросы по питанию?', 'answer' => $answer ),
			array( 'question' => 'Вы подбираете рацион под мою собаку?', 'answer' => $answer ),
			array( 'question' => 'Можно ли перейти с сухого корма?', 'answer' => $answer ),
			array( 'question' => 'Это питание на каждый день?', 'answer' => $answer ),
			array( 'question' => 'Можно кормить данными рационами если у моей собаки пищевая аллергия или чувствительное пищеварение?', 'answer' => $answer ),
			array( 'question' => 'Подойдет ли рацион моему питомцу?', 'answer' => $answer ),
		),
	);
}

function dicey_render_dietology( $attrs = array() ) {
	$data = dicey_merge_block_attrs( $attrs, dicey_dietology_defaults() );
	ob_start();
	?>
	<main>
		<section class="main main2">
			<div class="container">
				<div class="main-wr">
					<div class="standart-nav"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Главная</a><p>Диетология</p></div>
					<h1 class="main__title"><?php echo dicey_kses_inline( $data['hero_title'] ); ?> <span><?php echo dicey_kses_inline( $data['hero_accent'] ); ?></span></h1>
					<p class="main__text"><?php echo dicey_kses_inline( $data['hero_text'] ); ?></p>
					<button data-fancybox data-src="#consult-modal" class="main__link xs-hide"><?php echo esc_html( $data['hero_button_label'] ); ?><?php echo dicey_cta_icon_svg(); ?></button>
				</div>
				<img src="<?php echo esc_url( dicey_asset_img( 'imgs/bg/main-img2.png' ) ); ?>" alt="" class="main__img">
				<button data-fancybox data-src="#consult-modal" class="main__link xs-show"><?php echo esc_html( $data['hero_mobile_label'] ); ?><?php echo dicey_cta_icon_svg(); ?></button>
			</div>
		</section>
		<section class="consultation">
			<div class="container">
				<h2 class="conveniences__title"><?php echo dicey_kses_inline( $data['consult_title'] ); ?></h2>
				<div class="consultation__blocks">
					<?php foreach ( $data['consult_items'] as $item ) : ?>
						<div class="consultation__block">
							<?php if ( ! empty( $item['icon'] ) ) : ?><img src="<?php echo esc_url( dicey_asset_img( $item['icon'] ) ); ?>" alt="" class="consultation__img<?php echo ! empty( $item['icon_mobile'] ) ? ' xs-hide' : ''; ?>"><?php endif; ?>
							<?php if ( ! empty( $item['icon_mobile'] ) ) : ?><img src="<?php echo esc_url( dicey_asset_img( $item['icon_mobile'] ) ); ?>" alt="" class="consultation__img xs-show"><?php endif; ?>
							<p class="consultation__text"><?php echo dicey_kses_inline( $item['text'] ); ?></p>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</section>
		<section class="plan plan2">
			<div class="container">
				<div class="plan__img-wr">
					<?php if ( ! empty( $data['plan_person_image'] ) ) : ?><img src="<?php echo esc_url( dicey_asset_img( $data['plan_person_image'] ) ); ?>" alt="" class="plan__img-people"><?php endif; ?>
					<div class="plan__img-shadow"></div>
					<div class="plan__img-info"><p class="plan__img-name"><?php echo esc_html( $data['plan_person_name'] ); ?></p><p class="plan__img-text"><?php echo dicey_kses_inline( $data['plan_person_role'] ); ?></p></div>
				</div>
				<div class="plan__wr">
					<h2 class="plan__title"><?php echo dicey_kses_inline( $data['plan_title'] ); ?></h2>
					<p class="plan__subname"><?php echo dicey_kses_inline( $data['plan_subtitle'] ); ?></p>
					<p class="plan__text"><?php echo dicey_kses_inline( $data['plan_text'] ); ?></p>
					<div class="plan__imgs">
						<?php foreach ( $data['plan_certificates'] as $certificate ) : ?>
							<?php if ( ! empty( $certificate['image'] ) ) : ?><a href="<?php echo esc_url( dicey_asset_img( $certificate['image'] ) ); ?>" data-fancybox class="plan__img"><img src="<?php echo esc_url( dicey_asset_img( $certificate['image'] ) ); ?>" alt=""></a><?php endif; ?>
						<?php endforeach; ?>
					</div>
					<a href="#" class="plan__imgs-link"><?php echo esc_html( $data['plan_link_label'] ); ?></a>
				</div>
			</div>
		</section>
		<section class="advisory">
			<div class="container">
				<h2 class="popularity__title"><?php echo dicey_kses_inline( $data['advisory_title'] ); ?></h2>
				<div class="advisory__blocks">
					<?php foreach ( $data['advisory_steps'] as $step ) : ?>
						<div class="advisory__block"><span class="works__block-number"></span><div class="advisory__info"><p class="advisory__name"><?php echo dicey_kses_inline( $step['title'] ); ?></p><p class="advisory__text"><?php echo dicey_kses_inline( $step['text'] ); ?></p><?php if ( ! empty( $step['icon'] ) ) : ?><img src="<?php echo esc_url( dicey_asset_img( $step['icon'] ) ); ?>" alt="" class="advisory__icon"><?php endif; ?></div><?php if ( ! empty( $step['button'] ) ) : ?><button class="advisory__btn" data-fancybox data-src="#consult-modal"><?php echo esc_html( $step['button'] ); ?></button><?php endif; ?></div>
					<?php endforeach; ?>
				</div>
			</div>
		</section>
		<section class="advantages">
			<div class="container">
				<h2 class="popularity__title"><?php echo dicey_kses_inline( $data['advantages_title'] ); ?></h2>
				<div class="advantages__blocks">
					<?php foreach ( $data['advantages'] as $item ) : ?><div class="advantages__block"><img src="<?php echo esc_url( dicey_asset_img( $item['image'] ) ); ?>" alt="" class="advantages__img"><p class="advantages__name"><?php echo dicey_kses_inline( $item['title'] ); ?></p></div><?php endforeach; ?>
				</div>
			</div>
		</section>
		<section class="price">
			<div class="container">
				<h2 class="popularity__title"><?php echo dicey_kses_inline( $data['price_title'] ); ?></h2>
				<div class="price__blocks">
					<?php foreach ( $data['prices'] as $card ) : ?>
						<div class="price__block"><div class="price__head"><h3 class="price__title"><?php echo dicey_kses_inline( $card['title'] ); ?></h3><p class="price__text"><?php echo dicey_kses_inline( $card['text'] ); ?></p></div><div class="price__info"><div class="price__list"><ul><?php foreach ( $card['items'] as $item ) : ?><li><?php echo dicey_kses_inline( $item ); ?></li><?php endforeach; ?></ul></div><button class="price__btn" data-fancybox data-src="#consult-modal"><?php echo esc_html( $card['button'] ); ?></button></div></div>
					<?php endforeach; ?>
				</div>
			</div>
		</section>
		<section class="questions2">
			<div class="container">
				<h2 class="popularity__title"><?php echo dicey_kses_inline( $data['faq_title'] ); ?></h2>
				<div class="questions__blocks">
					<?php foreach ( $data['faq_items'] as $item_index => $item ) : ?><div class="questions__block"><div class="questions__top"><p><?php echo esc_html( $item['question'] ); ?></p><?php echo dicey_faq_icon_svg(); ?></div><div class="questions__content" style="display: none;"><p><?php echo dicey_kses_inline( $item['answer'] ); ?></p></div></div><?php endforeach; ?>
				</div>
			</div>
		</section>
	</main>
	<?php
	return ob_get_clean();
}
