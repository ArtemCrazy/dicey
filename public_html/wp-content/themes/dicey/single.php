<?php
/**
 * Single post template.
 *
 * @package Dicey
 */

get_header();

while ( have_posts() ) :
	the_post();
	?>
	<main>
		<section class="article">
			<div class="container">
				<div class="article__head">
					<div class="standart-nav">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Главная</a>
						<a href="<?php echo esc_url( dicey_blog_page_url() ); ?>">Блог</a>
						<p><?php the_title(); ?></p>
					</div>
					<h1 class="article__title"><?php the_title(); ?></h1>
				</div>
				<div class="article__wr">
					<div class="article__img">
						<img src="<?php echo esc_url( dicey_blog_image_url( get_the_ID(), 0, true ) ); ?>" alt="<?php the_title_attribute(); ?>">
					</div>
					<div class="article__content">
						<data value="<?php echo esc_attr( get_the_date( 'Y-m-d' ) ); ?>"><?php echo esc_html( get_the_date( 'd.m.Y' ) ); ?></data>
						<?php the_content(); ?>
					</div>
				</div>
			</div>
		</section>
		<?php
		$related = new WP_Query(
			array(
				'post_type'           => 'post',
				'post_status'         => 'publish',
				'posts_per_page'      => 3,
				'post__not_in'        => array( get_the_ID() ),
				'ignore_sticky_posts' => true,
			)
		);
		if ( $related->have_posts() ) :
			?>
			<section class="article-more">
				<div class="container">
					<h2 class="article-more__title">Похожие новости</h2>
					<div class="article-more__blocks">
						<?php
						$index = 0;
						while ( $related->have_posts() ) :
							$related->the_post();
							dicey_render_blog_card( get_the_ID(), $index );
							$index++;
						endwhile;
						?>
					</div>
				</div>
			</section>
			<?php
		endif;
		wp_reset_postdata();
		?>
	</main>
	<?php
endwhile;

get_footer();
