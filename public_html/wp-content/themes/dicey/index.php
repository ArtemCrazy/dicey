<?php
/**
 * Default template.
 *
 * @package Dicey
 */

get_header();

if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		?>
		<main class="site-main">
			<article <?php post_class( 'container' ); ?>>
				<h1><?php the_title(); ?></h1>
				<?php the_content(); ?>
			</article>
		</main>
		<?php
	endwhile;
endif;

get_footer();

