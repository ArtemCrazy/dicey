<?php
/**
 * Product page content.
 *
 * @package Dicey
 */

$meta    = dicey_get_product_meta( get_the_ID() );
$gallery = dicey_product_lines( $meta['gallery'] );
$thumbs  = dicey_product_lines( $meta['gallery_thumbs'] );
$variation_options = function_exists( 'dicey_get_wc_product_period_options' ) ? dicey_get_wc_product_period_options( get_the_ID() ) : array();
$terms   = $variation_options ? wp_list_pluck( $variation_options, 'label' ) : dicey_product_lines( $meta['terms'] );
$faq     = dicey_product_faq_items( $meta['faq'] );
$price   = $variation_options && ! empty( $variation_options[0]['price'] ) ? $variation_options[0]['price'] : dicey_product_price_for_card( get_the_ID(), $meta );

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
					<p class="product__price" data-product-price><?php echo esc_html( $price ); ?></p>
				<?php endif; ?>
				<?php if ( $terms ) : ?>
					<div class="product__term">
						<p class="product__term-name">Срок</p>
						<div class="product__term-tabs">
							<?php if ( $variation_options ) : ?>
								<?php foreach ( $variation_options as $term_index => $option ) : ?>
									<button
										type="button"
										class="product__term-tab <?php echo 0 === $term_index ? 'active' : ''; ?>"
										data-variation-id="<?php echo esc_attr( $option['variation_id'] ); ?>"
										data-variation-price="<?php echo esc_attr( $option['price'] ); ?>"
										data-variation-attributes="<?php echo esc_attr( wp_json_encode( $option['attributes'] ) ); ?>"
									><?php echo esc_html( $option['label'] ); ?></button>
								<?php endforeach; ?>
							<?php else : ?>
								<?php foreach ( $terms as $term_index => $term ) : ?>
									<button type="button" class="product__term-tab <?php echo 0 === $term_index ? 'active' : ''; ?>"><?php echo esc_html( $term ); ?></button>
								<?php endforeach; ?>
							<?php endif; ?>
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
				<?php
				$default_variation = $variation_options ? $variation_options[0] : null;
				$form_action       = function_exists( 'wc_get_cart_url' ) ? wc_get_cart_url() : home_url( '/basket/' );
				$checkout_url      = function_exists( 'wc_get_checkout_url' ) ? wc_get_checkout_url() : home_url( '/decoration/' );
				?>
				<form class="dicey-product-cart" method="post" action="<?php echo esc_url( $form_action ); ?>">
					<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( get_the_ID() ); ?>">
					<input type="hidden" name="product_id" value="<?php echo esc_attr( get_the_ID() ); ?>">
					<input type="hidden" name="quantity" value="1">
					<?php if ( $default_variation ) : ?>
						<input type="hidden" name="variation_id" value="<?php echo esc_attr( $default_variation['variation_id'] ); ?>" data-variation-id-input>
						<?php foreach ( $default_variation['attributes'] as $attribute_key => $attribute_value ) : ?>
							<input type="hidden" class="dicey-product-variation-attribute" name="<?php echo esc_attr( $attribute_key ); ?>" value="<?php echo esc_attr( $attribute_value ); ?>">
						<?php endforeach; ?>
					<?php endif; ?>
					<div class="shop__btns">
						<a href="<?php echo esc_url( $checkout_url ); ?>" class="shop__btn-clear">Перейти к оформлению</a>
						<button type="submit" class="shop__btn-apply2">В корзину</button>
					</div>
				</form>
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
