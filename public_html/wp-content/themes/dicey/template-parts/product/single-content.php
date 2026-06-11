<?php
/**
 * Product page content.
 *
 * @package Dicey
 */

$meta    = dicey_get_product_meta( get_the_ID() );
$gallery = dicey_product_lines( $meta['gallery'] );
$thumbs  = dicey_product_lines( $meta['gallery_thumbs'] );
$terms   = dicey_product_lines( $meta['terms'] );
$faq     = dicey_product_faq_items( $meta['faq'] );
$price   = dicey_product_price_for_card( get_the_ID(), $meta );

if ( ! $gallery ) {
	$gallery = array( 'imgs/bg/product-img1.png' );
}

if ( ! $thumbs ) {
	$thumbs = $gallery;
}
?>
<main>
	<section class="product">
		<div class="container">
			<div class="product__imgs-wr">
				<div class="product__img-big">
					<div class="product__img-slider owl-carousel">
						<?php foreach ( $gallery as $image ) : ?>
							<img src="<?php echo esc_url( dicey_product_image_url( $image, get_the_ID(), true ) ); ?>" alt="<?php the_title_attribute(); ?>">
						<?php endforeach; ?>
					</div>
				</div>
				<div class="product__imgs">
					<?php foreach ( $thumbs as $image ) : ?>
						<img src="<?php echo esc_url( dicey_product_image_url( $image, get_the_ID() ) ); ?>" alt="<?php the_title_attribute(); ?>">
					<?php endforeach; ?>
				</div>
			</div>
			<div class="product__content">
				<div class="standart-nav">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Главная</a>
					<a href="<?php echo esc_url( home_url( '/shop/' ) ); ?>">Магазин</a>
					<p><?php the_title(); ?></p>
				</div>
				<h1 class="product__title"><?php the_title(); ?></h1>
				<?php if ( '' !== trim( $price ) ) : ?>
					<p class="product__price"><?php echo esc_html( $price ); ?></p>
				<?php endif; ?>
				<?php if ( $terms ) : ?>
					<div class="product__term">
						<p class="product__term-name">Срок</p>
						<div class="product__term-tabs">
							<?php foreach ( $terms as $term_index => $term ) : ?>
								<div class="product__term-tab <?php echo 0 === $term_index ? 'active' : ''; ?>"><?php echo esc_html( $term ); ?></div>
							<?php endforeach; ?>
						</div>
					</div>
				<?php endif; ?>
				<div class="product__descr">
					<?php if ( '' !== trim( $meta['composition_title'] ) || '' !== trim( $meta['composition_text'] ) ) : ?>
						<?php if ( '' !== trim( $meta['composition_title'] ) ) : ?><h3><?php echo esc_html( $meta['composition_title'] ); ?></h3><?php endif; ?>
						<?php echo wpautop( wp_kses_post( $meta['composition_text'] ) ); ?>
					<?php endif; ?>
					<?php if ( '' !== trim( $meta['desc_title'] ) || '' !== trim( $meta['desc_text'] ) ) : ?>
						<?php if ( '' !== trim( $meta['desc_title'] ) ) : ?><h3><?php echo esc_html( $meta['desc_title'] ); ?></h3><?php endif; ?>
						<?php echo wpautop( wp_kses_post( $meta['desc_text'] ) ); ?>
					<?php endif; ?>
					<?php if ( '' !== trim( $meta['kbju_title'] ) || '' !== trim( $meta['kbju_text'] ) ) : ?>
						<?php if ( '' !== trim( $meta['kbju_title'] ) ) : ?><h3><?php echo esc_html( $meta['kbju_title'] ); ?></h3><?php endif; ?>
						<?php echo wpautop( wp_kses_post( $meta['kbju_text'] ) ); ?>
					<?php endif; ?>
				</div>
				<div class="shop__btns">
					<a href="<?php echo esc_url( home_url( '/decoration/' ) ); ?>" class="shop__btn-clear">Перейти к оформлению</a>
					<div class="shop__btn-apply2">В корзину</div>
				</div>
				<?php if ( $faq ) : ?>
					<div class="questions__blocks">
						<?php foreach ( $faq as $item ) : ?>
							<div class="questions__block">
								<div class="questions__top">
									<p><?php echo esc_html( $item['question'] ); ?></p>
									<?php echo dicey_faq_icon_svg(); ?>
								</div>
								<?php if ( '' !== trim( $item['answer'] ) ) : ?>
									<div class="questions__content" style="display: none;">
										<p><?php echo dicey_kses_inline( $item['answer'] ); ?></p>
									</div>
								<?php endif; ?>
							</div>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</section>
	<?php echo dicey_render_related_products( get_the_ID() ); ?>
	<?php echo dicey_render_why(); ?>
</main>
