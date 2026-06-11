<?php
/**
 * Blog articles archive.
 *
 * @package Dicey
 */

get_header();

$paged = max( 1, get_query_var( 'paged' ) );
?>
<main>
	<section class="blog">
		<div class="container">
			<div class="blog__head">
				<div class="standart-nav">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Главная</a>
					<p>Блог</p>
				</div>
				<h1 class="blog__title">Блог</h1>
			</div>
			<?php if ( have_posts() ) : ?>
				<div class="blog__blocks">
					<?php
					$index = 0;
					while ( have_posts() ) :
						the_post();
						dicey_render_blog_card( get_the_ID(), $index );
						$index++;
					endwhile;
					?>
				</div>
				<?php if ( $paged < (int) $wp_query->max_num_pages ) : ?>
					<a class="blog__btn" href="<?php echo esc_url( get_pagenum_link( $paged + 1 ) ); ?>">Смотреть еще</a>
				<?php endif; ?>
			<?php else : ?>
				<p class="blog__empty">Статьи пока не добавлены.</p>
			<?php endif; ?>
		</div>
	</section>
</main>
<?php
get_footer();
