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
	$link = get_post_type_archive_link( 'dicey_article' );

	if ( $link ) {
		return $link;
	}

	return home_url( '/blog/' );
}

function dicey_register_blog_post_type() {
	$labels = array(
		'name'               => 'Статьи',
		'singular_name'      => 'Статья',
		'menu_name'          => 'Блог',
		'name_admin_bar'     => 'Статью',
		'add_new'            => 'Добавить статью',
		'add_new_item'       => 'Добавить статью',
		'edit_item'          => 'Редактировать статью',
		'new_item'           => 'Новая статья',
		'view_item'          => 'Посмотреть статью',
		'view_items'         => 'Посмотреть статьи',
		'search_items'       => 'Найти статьи',
		'not_found'          => 'Статьи не найдены',
		'not_found_in_trash' => 'В корзине статей нет',
		'all_items'          => 'Все статьи',
	);

	register_post_type(
		'dicey_article',
		array(
			'labels'        => $labels,
			'public'        => true,
			'show_in_rest'  => true,
			'menu_position' => 20,
			'menu_icon'     => 'dashicons-welcome-write-blog',
			'has_archive'   => 'blog',
			'rewrite'       => array(
				'slug'       => 'blog',
				'with_front' => false,
			),
			'supports'      => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions' ),
		)
	);
}

add_action( 'init', 'dicey_register_blog_post_type' );

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
	if ( get_option( 'dicey_blog_cpt_imported' ) ) {
		return;
	}

	if ( get_posts( array( 'post_type' => 'dicey_article', 'post_status' => 'any', 'numberposts' => 1 ) ) ) {
		update_option( 'dicey_blog_cpt_imported', 1 );
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
		foreach ( $content_posts as $post ) {
			wp_update_post(
				array(
					'ID'        => $post->ID,
					'post_type' => 'dicey_article',
				)
			);
		}

		foreach ( $existing_posts as $post ) {
			if ( 'Привет, мир!' === $post->post_title ) {
				wp_update_post(
					array(
						'ID'          => $post->ID,
						'post_status' => 'draft',
					)
				);
			}
		}

		update_option( 'dicey_blog_cpt_imported', 1 );
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
				'post_type'    => 'dicey_article',
				'post_status'  => 'publish',
				'post_title'   => $post['title'],
				'post_excerpt' => $post['excerpt'],
				'post_content' => $post['content'],
				'post_date'    => gmdate( 'Y-m-d H:i:s', strtotime( '2026-03-28 12:00:00' ) + ( $index * 60 ) ),
			)
		);
	}

	update_option( 'dicey_blog_cpt_imported', 1 );
}

add_action( 'init', 'dicey_blog_import_posts', 20 );

function dicey_blog_archive_posts_per_page( $query ) {
	if ( is_admin() || ! $query->is_main_query() || ! $query->is_post_type_archive( 'dicey_article' ) ) {
		return;
	}

	$query->set( 'posts_per_page', 12 );
}

add_action( 'pre_get_posts', 'dicey_blog_archive_posts_per_page' );

function dicey_hide_default_posts_menu() {
	remove_menu_page( 'edit.php' );
}

add_action( 'admin_menu', 'dicey_hide_default_posts_menu' );
