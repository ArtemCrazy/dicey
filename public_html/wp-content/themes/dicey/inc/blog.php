<?php
/**
 * Blog helpers.
 *
 * @package Dicey
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function dicey_blog_page_url() {
	$page = get_page_by_path( 'blog' );

	if ( $page ) {
		return get_permalink( $page );
	}

	return home_url( '/blog/' );
}

function dicey_blog_fallback_images() {
	return array(
		'imgs/bg/blog__img1.png',
		'imgs/bg/blog__img2.png',
		'imgs/bg/blog__img3.png',
		'imgs/bg/blog__img4.png',
		'imgs/bg/blog__img5.png',
		'imgs/bg/blog__img6.png',
	);
}

function dicey_blog_image_url( $post_id, $index = 0, $single = false ) {
	$thumbnail = get_the_post_thumbnail_url( $post_id, 'large' );

	if ( $thumbnail ) {
		return $thumbnail;
	}

	if ( $single ) {
		return dicey_asset_img( 'imgs/bg/article-img.png' );
	}

	$fallbacks = dicey_blog_fallback_images();
	$index     = absint( $index ) % count( $fallbacks );

	return dicey_asset_img( $fallbacks[ $index ] );
}

function dicey_blog_excerpt( $post_id, $words = 22 ) {
	$excerpt = get_the_excerpt( $post_id );

	if ( '' === trim( $excerpt ) ) {
		$excerpt = get_post_field( 'post_content', $post_id );
	}

	return wp_trim_words( wp_strip_all_tags( strip_shortcodes( $excerpt ) ), $words, '...' );
}

function dicey_render_blog_card( $post_id, $index = 0 ) {
	?>
	<a href="<?php echo esc_url( get_permalink( $post_id ) ); ?>" class="blog__block">
		<div class="blog__img">
			<img src="<?php echo esc_url( dicey_blog_image_url( $post_id, $index ) ); ?>" alt="<?php echo esc_attr( get_the_title( $post_id ) ); ?>">
		</div>
		<div class="blog__info">
			<span class="blog__date"><?php echo esc_html( get_the_date( 'd.m.Y', $post_id ) ); ?></span>
			<p class="blog__name"><?php echo esc_html( get_the_title( $post_id ) ); ?></p>
			<p class="blog__text"><?php echo esc_html( dicey_blog_excerpt( $post_id ) ); ?></p>
		</div>
	</a>
	<?php
}

function dicey_blog_import_posts() {
	if ( get_option( 'dicey_blog_demo_imported' ) ) {
		return;
	}

	$existing_posts = get_posts(
		array(
			'post_type'   => 'post',
			'post_status' => 'any',
			'numberposts' => -1,
		)
	);

	$content_posts = array_filter(
		$existing_posts,
		static function ( $post ) {
			return 'Привет, мир!' !== $post->post_title;
		}
	);

	if ( $content_posts ) {
		update_option( 'dicey_blog_demo_imported', 1 );
		return;
	}

	foreach ( $existing_posts as $post ) {
		wp_update_post(
			array(
				'ID'          => $post->ID,
				'post_status' => 'draft',
			)
		);
	}

	$posts = array(
		array(
			'title'   => 'Чем кормить собаку: натуральное питание или сухой корм',
			'excerpt' => 'Разбираем плюсы и минусы разных типов питания и объясняем, как выбрать рацион под вашу собаку',
			'content' => '<p>Выбор питания — один из главных вопросов для владельцев собак. Кто-то выбирает сухой корм, кто-то — натуральное питание. Разберёмся, в чём разница и как понять, что подойдёт именно вашей собаке.</p><h2>Натуральное питание</h2><p>Это рацион из мяса, субпродуктов, овощей и других компонентов.</p><p><strong>Плюсы</strong></p><ul><li>Понятный состав — вы видите, что ест собака</li><li>Можно учитывать особенности и предпочтения</li><li>Ближе к естественному питанию</li></ul><p><strong>Минусы</strong></p><ul><li>Нужно рассчитывать баланс</li><li>Требует времени на подготовку</li><li>Ошибки в составе могут повлиять на здоровье</li></ul><h2>Что выбрать</h2><p>Универсального ответа нет — всё зависит от собаки: возраста, веса, активности и особенностей здоровья.</p>',
		),
		array(
			'title'   => 'Как понять, что рацион подходит вашей собаке',
			'excerpt' => 'Разбираем основные вопросы',
			'content' => '<p>Подходящий рацион обычно видно по самочувствию, активности, состоянию шерсти и стабильному пищеварению собаки.</p>',
		),
		array(
			'title'   => 'Питание с расширенным составом и вниманием к деталям',
			'excerpt' => 'В Дайси доступны VIP-рационы — это более разнообразное питание с тщательно подобранными ингредиентами.',
			'content' => '<p>Расширенный рацион помогает сделать питание разнообразнее и точнее учитывать индивидуальные потребности питомца.</p>',
		),
		array(
			'title'   => 'Почему важно учитывать породу при подборе питания',
			'excerpt' => 'Как особенности породы влияют на рацион и потребности собаки',
			'content' => '<p>Порода влияет на размер порции, уровень активности, склонность к набору веса и чувствительность пищеварения.</p>',
		),
		array(
			'title'   => 'Натуральное питание для собак: основные ошибки',
			'excerpt' => 'Что чаще всего делают неправильно и как этого избежать',
			'content' => '<p>Главная ошибка — собирать рацион без баланса белков, жиров, клетчатки, витаминов и минералов.</p>',
		),
		array(
			'title'   => 'Рационы для возрастных собак',
			'excerpt' => 'С возрастом у собак меняются потребности в питании — снижается активность, пищеварение становится более чувствительным.',
			'content' => '<p>Возрастным собакам важно подбирать рацион с учетом активности, состояния зубов, пищеварения и хронических особенностей.</p>',
		),
	);

	foreach ( $posts as $index => $post ) {
		wp_insert_post(
			array(
				'post_type'    => 'post',
				'post_status'  => 'publish',
				'post_title'   => $post['title'],
				'post_excerpt' => $post['excerpt'],
				'post_content' => $post['content'],
				'post_date'    => gmdate( 'Y-m-d H:i:s', strtotime( '2026-03-28 12:00:00' ) + ( $index * 60 ) ),
			)
		);
	}

	update_option( 'dicey_blog_demo_imported', 1 );
}

add_action( 'after_switch_theme', 'dicey_blog_import_posts' );

function dicey_blog_update_post_labels() {
	global $wp_post_types;

	if ( empty( $wp_post_types['post'] ) ) {
		return;
	}

	$labels = $wp_post_types['post']->labels;

	$labels->name               = 'Статьи';
	$labels->singular_name      = 'Статья';
	$labels->menu_name          = 'Блог';
	$labels->name_admin_bar     = 'Статью';
	$labels->add_new            = 'Добавить статью';
	$labels->add_new_item       = 'Добавить статью';
	$labels->edit_item          = 'Редактировать статью';
	$labels->new_item           = 'Новая статья';
	$labels->view_item          = 'Посмотреть статью';
	$labels->view_items         = 'Посмотреть статьи';
	$labels->search_items       = 'Найти статьи';
	$labels->not_found          = 'Статьи не найдены';
	$labels->not_found_in_trash = 'В корзине статей нет';
	$labels->all_items          = 'Все статьи';
}

add_action( 'init', 'dicey_blog_update_post_labels' );
