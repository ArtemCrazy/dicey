<?php
/**
 * Product page content.
 *
 * @package Dicey
 */

$post_id           = get_the_ID();
$meta              = dicey_get_product_meta( $post_id );
$variation_options = function_exists( 'dicey_get_wc_product_period_options' ) ? dicey_get_wc_product_period_options( $post_id ) : array();
$terms             = $variation_options ? wp_list_pluck( $variation_options, 'label' ) : dicey_product_lines( $meta['terms'] );
$menu_examples     = function_exists( 'dicey_product_menu_examples_for_display' ) ? dicey_product_menu_examples_for_display( $post_id, $meta ) : array();
$description       = trim( get_post_field( 'post_content', $post_id ) );
$question_items    = function_exists( 'dicey_product_question_items' ) ? dicey_product_question_items( $meta ) : array();
$price             = $variation_options && ! empty( $variation_options[0]['price'] ) ? $variation_options[0]['price'] : dicey_product_price_for_card( $post_id, $meta );
$default_label     = $terms ? reset( $terms ) : '';
$default_menu_limit = function_exists( 'dicey_product_menu_limit_for_period' ) ? dicey_product_menu_limit_for_period( $default_label ) : 5;
$default_variation = $variation_options ? $variation_options[0] : null;
$form_action       = function_exists( 'wc_get_cart_url' ) ? wc_get_cart_url() : home_url( '/basket/' );
?>
<main>
	<section class="carte" data-menu-limit="<?php echo esc_attr( $default_menu_limit ); ?>">
		<div class="container">
			<div class="standart-nav">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Главная</a>
				<a href="<?php echo esc_url( home_url( '/shop/' ) ); ?>">Магазин</a>
				<p><?php the_title(); ?></p>
			</div>
			<div class="carte__wr">
				<div class="carte__left">
					<h2 class="carte-var__title">Пример меню</h2>
					<div class="carte-var__tabs" role="tablist" aria-label="Дни меню">
						<?php foreach ( $menu_examples as $index => $example ) : ?>
							<button
								type="button"
								class="carte-var__tab <?php echo 0 === $index ? 'active' : ''; ?>"
								data-menu-index="<?php echo esc_attr( $index ); ?>"
								role="tab"
								aria-selected="<?php echo 0 === $index ? 'true' : 'false'; ?>"
								<?php echo $index >= $default_menu_limit ? 'style="display: none;"' : ''; ?>
							>День <?php echo esc_html( $index + 1 ); ?></button>
						<?php endforeach; ?>
					</div>
					<div class="carte-var__contets">
						<?php foreach ( $menu_examples as $index => $example ) : ?>
							<div class="carte-var__content" data-menu-content="<?php echo esc_attr( $index ); ?>" style="<?php echo 0 === $index ? 'display: flex;' : 'display: none;'; ?>">
								<div class="carte-var__info">
									<?php if ( '' !== trim( $example['title'] ) ) : ?>
										<h3><?php echo esc_html( $example['title'] ); ?></h3>
									<?php endif; ?>
									<?php if ( '' !== trim( $example['composition'] ) ) : ?>
										<h4>Состав</h4>
										<?php echo wpautop( wp_kses_post( $example['composition'] ) ); ?>
									<?php endif; ?>
									<?php if ( '' !== trim( $example['kbju'] ) ) : ?>
										<h4>КБЖУ</h4>
										<?php echo wpautop( wp_kses_post( $example['kbju'] ) ); ?>
									<?php endif; ?>
									<?php if ( '' !== trim( $example['minerals'] ) ) : ?>
										<h4>Витамины и минеральные вещества</h4>
										<?php echo wpautop( wp_kses_post( $example['minerals'] ) ); ?>
									<?php endif; ?>
									<?php if ( '' !== trim( $example['portion_weight'] ) ) : ?>
										<h4>Вес порции</h4>
										<p><?php echo esc_html( $example['portion_weight'] ); ?></p>
									<?php endif; ?>
								</div>
								<?php if ( ! empty( $example['images'] ) ) : ?>
									<div class="carte-var__imgswr">
										<div class="carte-var__img-big">
											<div class="carte-var__img-slider owl-carousel">
												<?php foreach ( $example['images'] as $image ) : ?>
													<img src="<?php echo esc_url( $image['large'] ); ?>" alt="<?php echo esc_attr( $example['title'] ); ?>">
												<?php endforeach; ?>
											</div>
										</div>
										<div class="carte-var__imgs">
											<?php foreach ( $example['images'] as $image_index => $image ) : ?>
												<img class="<?php echo 0 === $image_index ? 'active' : ''; ?>" src="<?php echo esc_url( $image['thumb'] ); ?>" alt="<?php echo esc_attr( $example['title'] ); ?>">
											<?php endforeach; ?>
										</div>
									</div>
								<?php endif; ?>
							</div>
						<?php endforeach; ?>
					</div>
				</div>

				<div class="carte__right">
					<div class="carte__right-wr">
						<h1 class="carte__title"><?php the_title(); ?></h1>
						<?php if ( $terms ) : ?>
							<div class="carte__term">
								<p class="carte__term-name">Срок</p>
								<div class="carte__term-tabs" role="tablist" aria-label="Срок рациона">
									<?php if ( $variation_options ) : ?>
										<?php foreach ( $variation_options as $term_index => $option ) : ?>
											<button
												type="button"
												class="carte__term-tab <?php echo 0 === $term_index ? 'active' : ''; ?>"
												data-menu-limit="<?php echo esc_attr( dicey_product_menu_limit_for_period( $option['label'] ) ); ?>"
												data-variation-id="<?php echo esc_attr( $option['variation_id'] ); ?>"
												data-variation-price="<?php echo esc_attr( $option['price'] ); ?>"
												data-variation-attributes="<?php echo esc_attr( wp_json_encode( $option['attributes'] ) ); ?>"
												aria-selected="<?php echo 0 === $term_index ? 'true' : 'false'; ?>"
											><?php echo esc_html( $option['label'] ); ?></button>
										<?php endforeach; ?>
									<?php else : ?>
										<?php foreach ( $terms as $term_index => $term ) : ?>
											<button type="button" class="carte__term-tab <?php echo 0 === $term_index ? 'active' : ''; ?>" data-menu-limit="<?php echo esc_attr( dicey_product_menu_limit_for_period( $term ) ); ?>" aria-selected="<?php echo 0 === $term_index ? 'true' : 'false'; ?>"><?php echo esc_html( $term ); ?></button>
										<?php endforeach; ?>
									<?php endif; ?>
								</div>
							</div>
						<?php endif; ?>

						<div class="carte__right-contents">
							<div class="carte__right-content" style="display: block;">
								<?php if ( '' !== $description ) : ?>
									<div class="carte__right-info">
										<h3>Описание рациона</h3>
										<?php echo apply_filters( 'the_content', $description ); ?>
									</div>
								<?php endif; ?>
								<?php if ( '' !== trim( $price ) ) : ?>
									<div class="carte__right-price">
										<p>Итого:</p>
										<span data-product-price><?php echo esc_html( $price ); ?></span>
									</div>
								<?php endif; ?>
								<form class="dicey-product-cart" method="post" action="<?php echo esc_url( $form_action ); ?>">
									<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $post_id ); ?>">
									<input type="hidden" name="product_id" value="<?php echo esc_attr( $post_id ); ?>">
									<input type="hidden" name="quantity" value="1">
									<?php if ( $default_variation ) : ?>
										<input type="hidden" name="variation_id" value="<?php echo esc_attr( $default_variation['variation_id'] ); ?>" data-variation-id-input>
										<?php foreach ( $default_variation['attributes'] as $attribute_key => $attribute_value ) : ?>
											<input type="hidden" class="dicey-product-variation-attribute" name="<?php echo esc_attr( $attribute_key ); ?>" value="<?php echo esc_attr( $attribute_value ); ?>">
										<?php endforeach; ?>
									<?php endif; ?>
									<div class="carte__right-btns">
										<button type="submit" name="dicey_product_action" value="checkout" class="carte__right-btn">Перейти к оформлению</button>
										<button type="submit" name="dicey_product_action" value="cart" class="carte__right-btn blue">В корзину</button>
									</div>
								</form>
							</div>
						</div>
					</div>

					<?php if ( $question_items ) : ?>
						<div class="questions__blocks">
							<?php foreach ( $question_items as $item ) : ?>
								<div class="questions__block">
									<div class="questions__top">
										<p><?php echo esc_html( $item['question'] ); ?></p>
										<?php echo function_exists( 'dicey_faq_icon_svg' ) ? dicey_faq_icon_svg() : ''; ?>
									</div>
									<div class="questions__content" style="display: none;">
										<p><?php echo dicey_kses_inline( $item['answer'] ); ?></p>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</section>
	<?php echo dicey_render_related_products( $post_id ); ?>
	<?php echo dicey_render_why(); ?>
</main>
