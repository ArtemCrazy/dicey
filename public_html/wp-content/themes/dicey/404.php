<?php
/**
 * 404 template.
 *
 * @package Dicey
 */

get_header();
?>
<main>
	<section class="error">
		<div class="container">
			<h1 class="error__title"><?php esc_html_e( 'Page not found', 'dicey' ); ?></h1>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="main__link">
				<?php esc_html_e( 'Go home', 'dicey' ); ?>
			</a>
		</div>
	</section>
</main>
<?php
get_footer();

