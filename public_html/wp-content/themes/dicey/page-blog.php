<?php
/**
 * Blog listing page.
 *
 * @package Dicey
 */

get_header();

$paged = max( 1, get_query_var( 'paged' ), get_query_var( 'page' ) );
$query = new WP_Query(
	array(
		'post_type'           => 'post',
		'post_status'         => 'publish',
		'posts_per_page'      => 12,
		'paged'               => $paged,
		'ignore_sticky_posts' => true,
	)
);
?>
<main>
	<section class="blog">
		<div class="container">
			<div class="blog__head">
				<div class="standart-nav">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Главная</a>
					<p>Блог</p>
				</div>
				<h1 class="blog__title"><?php the_title(); ?></h1>
			</div>
			<?php if ( $query->have_posts() ) : ?>
				<div class="blog__blocks">
					<?php
					$index = 0;
					while ( $query->have_posts() ) :
						$query->the_post();
						dicey_render_blog_card( get_the_ID(), $index );
						$index++;
					endwhile;
					?>
				</div>
				<?php if ( $paged < (int) $query->max_num_pages ) : ?>
					<a class="blog__btn" href="<?php echo esc_url( get_pagenum_link( $paged + 1 ) ); ?>">Смотреть еще</a>
				<?php endif; ?>
			<?php else : ?>
				<p class="blog__empty">Статьи пока не добавлены.</p>
			<?php endif; ?>
		</div>
	</section>
</main>
<?php
wp_reset_postdata();
get_footer();
