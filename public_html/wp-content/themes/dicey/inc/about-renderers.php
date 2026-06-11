<?php
/**
 * Render callback for the editable about page.
 *
 * @package Dicey
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function dicey_about_defaults() {
	return array(
		'hero_title' => 'Заботимся <br class="xs-show"> о питании <br> <span>вашей собаки</span>',
		'hero_image' => 'imgs/bg/about-banner___img.png',
		'nutrition_title' => 'Почему мы это делаем ?',
		'nutrition_text' => 'Подобрать правильное питание для собаки — не так просто. <br> Не хватает времени, сложно разобраться в составе и нет уверенности, что рацион подходит. <br> Мы создали подход, где всё уже продумано — остаётся только кормить собаку',
		'nutrition_items' => array(
			array( 'icon' => 'imgs/icons/nutrition-item1.svg', 'icon_class' => 'nutrition-icon', 'icon_second' => 'imgs/icons/nutrition-item4.svg', 'icon_second_class' => 'nutrition-icon2', 'text' => 'Опираемся на исследования <br> по питанию собак' ),
			array( 'icon' => 'imgs/icons/nutrition-item2.svg', 'icon_class' => 'nutrition-icon3', 'text' => 'Учитываем вес, возраст и особенности' ),
			array( 'icon' => 'imgs/icons/nutrition-item3.svg', 'icon_class' => 'nutrition-icon4', 'text' => 'Рационы проходят <br> термическую обработку' ),
			array( 'text' => 'Подбираем рацион по составу <br> и калорийности для каждой породы <br> собаки индивидуально' ),
		),
		'acquaintances_title' => 'Давай знакомиться?',
		'acquaintances_lead' => 'Кожаные называют мою породу Акита-ину, а мне больше нравится когда меня зовут по моей кличке — Дайси',
		'acquaintances_paragraphs' => array(
			'Вообще я парень простой: люблю гулять, играть и, конечно, поесть. Особенно то, что ест мой хозяин. У него всегда самое вкусное, но делится он редко — говорит, мне вредно. Ну да, конечно.',
			'Я намекал. Сначала взглядом. Потом просто сидел рядом. Потом очень долго смотрел. И это сработало. Мой хозяин задумался и сделал сервис правильного питания. И назвал его в мою честь — Дайси.',
			'Теперь вкусно питаться смогу не только я, но и другие хвостатые с нашего двора… и даже всего города. Так что да — это я всё придумал. Ну, почти.',
		),
		'acquaintances_image' => 'imgs/bg/acquaintances__img.png',
		'team_title' => 'Кто работает над рационами',
		'team_items' => array(
			array( 'image' => 'imgs/bg/job__img1.png', 'name' => 'Лукьянов Валентин', 'text' => 'Мой хозяин. Главный по идеям, коробкам и доставке' ),
			array( 'image' => 'imgs/bg/job__img2.png', 'name' => 'Босунова Наталья', 'text' => 'Ветеринарный врач-диетолог. Следит, чтобы мне было вкусно, а не «просто можно»' ),
		),
		'choice_title' => 'Почему выбирают наши рационы',
		'choice_items' => array(
			array( 'icon' => 'imgs/icons/conveniences2-icon1.svg', 'title' => 'Натуральные <br> ингредиенты', 'text' => 'Полностью натуральные <br> продукты высокого качества' ),
			array( 'icon' => 'imgs/icons/conveniences2-icon2.svg', 'title' => 'Сбалансированный состав', 'text' => 'Мы используем добавки, благодаря чему собака получит все необходимые витамины и минералы' ),
			array( 'icon' => 'imgs/icons/conveniences2-icon3.svg', 'title' => 'Приятный вкус даже для приверед', 'text' => 'Рационы имеет приятный вкус и аромат, привлекающий даже привередливых животных' ),
			array( 'icon' => 'imgs/icons/conveniences2-icon4.svg', 'title' => 'Безопасная обработка продуктов', 'text' => 'Тщательная обработка продуктов гарантирует безопасность и минимизирует риск инфекций' ),
		),
		'nature_image' => 'imgs/bg/nature__img.png',
		'nature_title' => 'Заботимся о природе',
		'nature_paragraphs' => array(
			'Мы не только готовим питание, но и думаем о том, как снизить влияние на окружающую среду.',
			'Мы используем качественные продукты и выстраиваем процессы так, чтобы минимизировать отходы на всех этапах — от приготовления до доставки. Упаковка изготавливается из экологичных материалов, а логистика выстроена с учётом снижения лишних перемещений.',
		),
		'partnership_title' => 'Открыты к партнёрству',
		'partnership_subtitle' => 'и совместным проектам',
		'partnership_text' => 'Готовы рассмотреть разные форматы сотрудничества — от работы с питомниками и ветеринарными специалистами до партнёрств с блогерами и сервисами для владельцев собак',
		'partnership_button_label' => 'Узнать подробнее',
		'partnership_image' => 'imgs/bg/partnership-img.png',
	);
}

function dicey_render_about( $attrs = array() ) {
	$data = dicey_merge_block_attrs( $attrs, dicey_about_defaults() );
	$nutrition_items = dicey_non_empty_items( $data['nutrition_items'] );
	$paragraphs      = dicey_non_empty_items( $data['acquaintances_paragraphs'] );
	$team_items      = dicey_non_empty_items( $data['team_items'] );
	$choice_items    = dicey_non_empty_items( $data['choice_items'] );
	$nature_text     = dicey_non_empty_items( $data['nature_paragraphs'] );

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
						<div class="standart-nav"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Главная</a><p>О нас</p></div>
						<?php if ( '' !== trim( $data['hero_title'] ) ) : ?><h1 class="about-banner__title"><?php echo dicey_kses_inline( $data['hero_title'] ); ?></h1><?php endif; ?>
					</div>
				</div>
			</section>
		<?php endif; ?>
		<?php if ( '' !== trim( $data['nutrition_title'] ) || '' !== trim( $data['nutrition_text'] ) || $nutrition_items ) : ?>
			<section class="nutrition">
				<div class="container">
					<div class="nutrition__head">
						<?php if ( '' !== trim( $data['nutrition_title'] ) ) : ?><h2 class="popularity__title"><?php echo dicey_kses_inline( $data['nutrition_title'] ); ?></h2><?php endif; ?>
						<?php if ( '' !== trim( $data['nutrition_text'] ) ) : ?><p class="nutrition__text"><?php echo dicey_kses_inline( $data['nutrition_text'] ); ?></p><?php endif; ?>
					</div>
					<?php if ( $nutrition_items ) : ?><div class="nutrition__blocks">
						<?php foreach ( $nutrition_items as $item ) : ?>
							<div class="nutrition__block">
								<?php if ( ! empty( $item['icon'] ) ) : ?><img src="<?php echo esc_url( dicey_asset_img( $item['icon'] ) ); ?>" alt="" class="<?php echo esc_attr( isset( $item['icon_class'] ) ? $item['icon_class'] : 'nutrition-icon' ); ?>"><?php endif; ?>
								<?php if ( ! empty( $item['text'] ) ) : ?><p class="nutrition__block-text"><?php echo dicey_kses_inline( $item['text'] ); ?></p><?php endif; ?>
								<?php if ( ! empty( $item['icon_second'] ) ) : ?><img src="<?php echo esc_url( dicey_asset_img( $item['icon_second'] ) ); ?>" alt="" class="<?php echo esc_attr( isset( $item['icon_second_class'] ) ? $item['icon_second_class'] : 'nutrition-icon2' ); ?>"><?php endif; ?>
							</div>
						<?php endforeach; ?>
					</div><?php endif; ?>
				</div>
			</section>
		<?php endif; ?>
		<?php if ( '' !== trim( $data['acquaintances_title'] ) || '' !== trim( $data['acquaintances_lead'] ) || $paragraphs || ! empty( $data['acquaintances_image'] ) ) : ?>
			<section class="acquaintances">
				<div class="container">
					<div class="acquaintances__wr">
						<div class="acquaintances__info">
							<?php if ( '' !== trim( $data['acquaintances_title'] ) ) : ?><h2 class="acquaintances__title"><?php echo dicey_kses_inline( $data['acquaintances_title'] ); ?></h2><?php endif; ?>
							<?php if ( '' !== trim( $data['acquaintances_lead'] ) ) : ?><p class="acquaintances__text-big"><?php echo dicey_kses_inline( $data['acquaintances_lead'] ); ?></p><?php endif; ?>
							<?php if ( $paragraphs ) : ?><div class="acquaintances__text">
								<?php foreach ( $paragraphs as $paragraph ) : ?><p><?php echo dicey_kses_inline( $paragraph ); ?></p><?php endforeach; ?>
							</div><?php endif; ?>
						</div>
						<?php if ( ! empty( $data['acquaintances_image'] ) ) : ?><img src="<?php echo esc_url( dicey_asset_img( $data['acquaintances_image'] ) ); ?>" alt="" class="acquaintances__img"><?php endif; ?>
					</div>
				</div>
			</section>
		<?php endif; ?>
		<?php if ( '' !== trim( $data['team_title'] ) || $team_items ) : ?>
			<section class="job">
				<div class="container">
					<?php if ( '' !== trim( $data['team_title'] ) ) : ?><h2 class="popularity__title"><?php echo dicey_kses_inline( $data['team_title'] ); ?></h2><?php endif; ?>
					<?php if ( $team_items ) : ?><div class="job__blocks">
						<?php foreach ( $team_items as $item ) : ?>
							<div class="job__block">
								<?php if ( ! empty( $item['image'] ) ) : ?><img src="<?php echo esc_url( dicey_asset_img( $item['image'] ) ); ?>" alt="" class="job__img"><?php endif; ?>
								<?php if ( ! empty( $item['name'] ) || ! empty( $item['text'] ) ) : ?><div class="job__info"><?php if ( ! empty( $item['name'] ) ) : ?><p class="job__name"><?php echo esc_html( $item['name'] ); ?></p><?php endif; ?><?php if ( ! empty( $item['text'] ) ) : ?><p class="job__text"><?php echo dicey_kses_inline( $item['text'] ); ?></p><?php endif; ?></div><?php endif; ?>
							</div>
						<?php endforeach; ?>
					</div><?php endif; ?>
				</div>
			</section>
		<?php endif; ?>
		<?php if ( '' !== trim( $data['choice_title'] ) || $choice_items ) : ?>
			<section class="conveniences conveniences2">
				<div class="container">
					<?php if ( '' !== trim( $data['choice_title'] ) ) : ?><h2 class="conveniences__title"><?php echo dicey_kses_inline( $data['choice_title'] ); ?></h2><?php endif; ?>
					<?php if ( $choice_items ) : ?><div class="conveniences__blocks">
						<?php foreach ( $choice_items as $item ) : ?>
							<div class="conveniences__block">
								<?php if ( ! empty( $item['icon'] ) ) : ?><img src="<?php echo esc_url( dicey_asset_img( $item['icon'] ) ); ?>" alt="" class="conveniences__icon"><?php endif; ?>
								<?php if ( ! empty( $item['title'] ) || ! empty( $item['text'] ) ) : ?><div class="conveniences-info"><?php if ( ! empty( $item['title'] ) ) : ?><h3 class="conveniences__name"><?php echo dicey_kses_inline( $item['title'] ); ?></h3><?php endif; ?><?php if ( ! empty( $item['text'] ) ) : ?><p class="conveniences__text"><?php echo dicey_kses_inline( $item['text'] ); ?></p><?php endif; ?></div><?php endif; ?>
							</div>
						<?php endforeach; ?>
					</div><?php endif; ?>
				</div>
			</section>
		<?php endif; ?>
		<?php if ( ! empty( $data['nature_image'] ) || '' !== trim( $data['nature_title'] ) || $nature_text ) : ?>
			<section class="nature">
				<div class="container">
					<div class="nature__wr">
						<?php if ( ! empty( $data['nature_image'] ) ) : ?><img src="<?php echo esc_url( dicey_asset_img( $data['nature_image'] ) ); ?>" alt="" class="nature__img"><?php endif; ?>
						<div class="nature__content">
							<?php if ( '' !== trim( $data['nature_title'] ) ) : ?><h2 class="nature__title"><?php echo dicey_kses_inline( $data['nature_title'] ); ?></h2><?php endif; ?>
							<?php if ( $nature_text ) : ?><div class="nature__text"><?php foreach ( $nature_text as $paragraph ) : ?><p><?php echo dicey_kses_inline( $paragraph ); ?></p><?php endforeach; ?></div><?php endif; ?>
						</div>
					</div>
				</div>
			</section>
		<?php endif; ?>
		<?php if ( '' !== trim( $data['partnership_title'] ) || '' !== trim( $data['partnership_subtitle'] ) || '' !== trim( $data['partnership_text'] ) || '' !== trim( $data['partnership_button_label'] ) || ! empty( $data['partnership_image'] ) ) : ?>
			<section class="partnership">
				<div class="container">
					<?php if ( '' !== trim( $data['partnership_title'] ) || '' !== trim( $data['partnership_subtitle'] ) || '' !== trim( $data['partnership_text'] ) || '' !== trim( $data['partnership_button_label'] ) ) : ?><div class="partnership__info">
						<div class="partnership__top">
							<?php if ( '' !== trim( $data['partnership_title'] ) || '' !== trim( $data['partnership_subtitle'] ) ) : ?><div class="partnership__head"><?php if ( '' !== trim( $data['partnership_title'] ) ) : ?><h2 class="partnership__title"><?php echo dicey_kses_inline( $data['partnership_title'] ); ?></h2><?php endif; ?><?php if ( '' !== trim( $data['partnership_subtitle'] ) ) : ?><p class="partnership__subname"><?php echo dicey_kses_inline( $data['partnership_subtitle'] ); ?></p><?php endif; ?></div><?php endif; ?>
							<?php if ( '' !== trim( $data['partnership_text'] ) ) : ?><p class="partnership__text"><?php echo dicey_kses_inline( $data['partnership_text'] ); ?></p><?php endif; ?>
						</div>
						<?php if ( '' !== trim( $data['partnership_button_label'] ) ) : ?><button data-fancybox data-src="#why-modal" class="partnership__link"><?php echo esc_html( $data['partnership_button_label'] ); ?></button><?php endif; ?>
					</div><?php endif; ?>
					<?php if ( ! empty( $data['partnership_image'] ) ) : ?><img src="<?php echo esc_url( dicey_asset_img( $data['partnership_image'] ) ); ?>" alt="" class="partnership__img"><?php endif; ?>
				</div>
			</section>
		<?php endif; ?>
	</main>
	<?php
	return ob_get_clean();
}
