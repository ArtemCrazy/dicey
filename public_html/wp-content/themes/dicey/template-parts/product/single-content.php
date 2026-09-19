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
$dietary_image     = ! empty( $menu_examples[0]['images'][0]['thumb'] ) ? $menu_examples[0]['images'][0]['thumb'] : dicey_product_card_image_url( $post_id );
$dietary_kbju      = function_exists( 'dicey_product_card_calories_text' ) ? dicey_product_card_calories_text( $meta ) : '';
$default_selection = range( 0, max( 0, $default_menu_limit - 1 ) );
?>
<main>
	<section class="carte" data-menu-limit="<?php echo esc_attr( $default_menu_limit ); ?>" data-menu-selection="<?php echo esc_attr( implode( ',', $default_selection ) ); ?>" data-fallback-price="<?php echo esc_attr( $price ); ?>">
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
							<?php $example_price = function_exists( 'dicey_product_menu_price_number' ) ? dicey_product_menu_price_number( isset( $example['price'] ) ? $example['price'] : '' ) : null; ?>
							<div class="carte-var__content" data-menu-content="<?php echo esc_attr( $index ); ?>" data-menu-price="<?php echo null === $example_price ? '' : esc_attr( $example_price ); ?>" style="<?php echo 0 === $index ? 'display: flex;' : 'display: none;'; ?>">
								
								<button type="button" class="carte-var__btn" data-menu-replace>Заменить блюдо <span aria-hidden="true"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M6.32899 13.8003C6.51072 13.7787 6.69361 13.8299 6.83762 13.9429C6.98163 14.0558 7.07502 14.2212 7.09733 14.4028L7.41399 16.9795C7.43498 17.161 7.38359 17.3434 7.27096 17.4872C7.15833 17.6311 6.99354 17.7247 6.81233 17.7478L4.27483 18.0645C3.83233 18.0987 3.54649 17.8128 3.50233 17.462C3.48061 17.2799 3.53163 17.0967 3.64429 16.952C3.75696 16.8074 3.92216 16.713 4.10399 16.6895L4.94816 16.5845C3.5751 15.5463 2.56001 14.1057 2.04424 12.4634C1.52847 10.8211 1.5377 9.05881 2.07066 7.422C3.16566 4.00866 6.39316 1.66366 9.95483 1.667C10.4173 1.667 10.6898 1.99366 10.6832 2.37533C10.6723 2.75616 10.3932 3.04866 9.95483 3.04866C6.98566 3.05533 4.29816 5.00616 3.38316 7.84783C2.93552 9.22437 2.93213 10.7068 3.37346 12.0854C3.81479 13.464 4.67849 14.6688 5.84233 15.5295L5.72649 14.5728C5.71519 14.4825 5.72181 14.3909 5.74599 14.3031C5.77017 14.2154 5.81143 14.1333 5.8674 14.0615C5.92338 13.9898 5.99296 13.9297 6.07217 13.8849C6.15138 13.8401 6.23865 13.8114 6.32899 13.8003ZM15.894 3.3145L15.0498 3.4195C16.422 4.45687 17.4366 5.89629 17.9524 7.53736C18.4682 9.17843 18.4594 10.9395 17.9273 12.5753C16.8323 15.9887 13.6048 18.3337 10.0407 18.3337C9.57816 18.3337 9.30566 18.007 9.31233 17.6253C9.32316 17.2445 9.60149 16.952 10.0407 16.952C13.0098 16.9453 15.6973 14.9953 16.6123 12.1528C17.06 10.7763 17.0634 9.29383 16.622 7.91526C16.1807 6.53668 15.317 5.33181 14.1532 4.47116L14.2682 5.42783C14.2847 5.52032 14.2823 5.61521 14.2609 5.70672C14.2396 5.79823 14.1999 5.88443 14.1441 5.96007C14.0884 6.03571 14.0178 6.0992 13.9367 6.14666C13.8556 6.19412 13.7657 6.22456 13.6724 6.23613C13.5792 6.24769 13.4846 6.24013 13.3943 6.21392C13.3041 6.1877 13.2202 6.14338 13.1476 6.08365C13.0751 6.02392 13.0155 5.95004 12.9725 5.86651C12.9294 5.78298 12.9039 5.69156 12.8973 5.59783L12.5848 3.02533C12.5636 2.8436 12.615 2.66084 12.7278 2.5168C12.8407 2.37276 13.0058 2.27909 13.1873 2.25616L15.724 1.9395C16.1665 1.90533 16.4523 2.19116 16.4965 2.542C16.5182 2.72418 16.4671 2.90757 16.3542 3.05224C16.2414 3.19692 16.076 3.29117 15.894 3.3145Z" fill="white"/>
                                </svg></span></button>
								
								<div class="carte-var__info">
									<?php if ( '' !== trim( $example['title'] ) ) : ?>
										<h3><?php echo esc_html( $example['title'] ); ?></h3>
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
								
								<div class="carte-var__info">	
									<?php if ( '' !== trim( $example['composition'] ) ) : ?>
										<h4>Состав</h4>
										<?php echo wpautop( wp_kses_post( $example['composition'] ) ); ?>
									<?php endif; ?>
									<?php if ( '' !== trim( $example['energy_value'] ) ) : ?>
                                        <h4>Энергетическая ценность суточного рациона</h4>
        								<p><?php echo esc_html( $example['energy_value'] ); ?></p>
  								    <?php endif; ?>
									<?php if ( '' !== trim( $example['kbju'] ) ) : ?>
										<h4>Пищевая ценность суточного рациона</h4>
										<?php echo wpautop( wp_kses_post( $example['kbju'] ) ); ?>
									<?php endif; ?>
									<?php if ( '' !== trim( $example['minerals'] ) ) : ?>
										<h4>Витамины и минеральные вещества</h4>
										<?php echo wpautop( wp_kses_post( $example['minerals'] ) ); ?>
									<?php endif; ?>
									<?php if ( '' !== trim( $example['portion_weight'] ) ) : ?>
										<h4>Вес суточного рациона</h4>
										<p><?php echo esc_html( $example['portion_weight'] ); ?></p>
									<?php endif; ?>
									<?php if ( null !== $example_price ) : ?>
										<h4>Стоимость суточного рациона</h4>
										<p><?php echo esc_html( dicey_product_price_with_currency( $example['price'] ) ); ?></p>
									<?php endif; ?>
								</div>
								
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
												data-day="<?php echo esc_attr( dicey_product_period_day_count( $option['label'] ) ); ?>"
												data-period-value="<?php echo esc_attr( $option['label'] ); ?>"
												data-variation-id="<?php echo esc_attr( $option['variation_id'] ); ?>"
												data-variation-price="<?php echo esc_attr( $option['price'] ); ?>"
												data-variation-attributes="<?php echo esc_attr( wp_json_encode( $option['attributes'] ) ); ?>"
												aria-selected="<?php echo 0 === $term_index ? 'true' : 'false'; ?>"
											><?php echo esc_html( $option['label'] ); ?></button>
										<?php endforeach; ?>
									<?php else : ?>
										<?php foreach ( $terms as $term_index => $term ) : ?>
											<button type="button" class="carte__term-tab <?php echo 0 === $term_index ? 'active' : ''; ?>" data-menu-limit="<?php echo esc_attr( dicey_product_menu_limit_for_period( $term ) ); ?>" data-day="<?php echo esc_attr( dicey_product_period_day_count( $term ) ); ?>" data-period-value="<?php echo esc_attr( $term ); ?>" aria-selected="<?php echo 0 === $term_index ? 'true' : 'false'; ?>"><?php echo esc_html( $term ); ?></button>
										<?php endforeach; ?>
									<?php endif; ?>
								</div>
								<p class="carte__term-text" style="display: none;">В месячный рацион входят 6 пятидневных рационов. При необходимости блюда можно заменить ниже.</p>
							</div>
						<?php endif; ?>

						<div class="carte__right-contents">
							<div class="carte__right-content" style="display: block;">
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
									<?php if ( '' !== $default_label ) : ?>
										<input type="hidden" name="dicey_product_period" value="<?php echo esc_attr( $default_label ); ?>" data-product-period-input>
									<?php endif; ?>
									<input type="hidden" name="dicey_product_menu_selection" value="<?php echo esc_attr( implode( ',', $default_selection ) ); ?>" data-product-menu-selection-input>
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
								
								<?php if ( '' !== $description ) : ?>
									<div class="carte__right-info">
										<h3>Описание рациона</h3>
										<?php echo apply_filters( 'the_content', $description ); ?>
									</div>
								<?php endif; ?>
								
							</div>
						</div>
					</div>

					<div class="carte__dietary" style="display: none;" aria-hidden="true">
						<div class="carte__dietary-top">
							<h3>Соберите свой рацион</h3>
						</div>
						<div class="carte__dietary-blocks">
							<?php for ( $dietary_index = 1; $dietary_index <= 6; $dietary_index++ ) : ?>
								<div class="carte__dietary-block <?php echo 1 === $dietary_index ? 'active' : ''; ?>">
									<p class="carte__dietary-num"><span><?php echo esc_html( $dietary_index ); ?></span> рацион</p>
									<div class="carte__dietary-wr">
										<?php if ( $dietary_image ) : ?>
											<img src="<?php echo esc_url( $dietary_image ); ?>" alt="<?php the_title_attribute(); ?>" class="carte__dietary-img">
										<?php endif; ?>
										<div class="carte__dietary-info">
											<p class="carte__dietary-name"><?php the_title(); ?></p>
											<?php if ( '' !== trim( $dietary_kbju ) ) : ?>
												<p class="carte__dietary-kb"><?php echo esc_html( $dietary_kbju ); ?></p>
											<?php endif; ?>

											<div class="carte__dietary-btn">
												Заменить рацион
												<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
													<path fill-rule="evenodd" clip-rule="evenodd" d="M6.32899 13.8003C6.51072 13.7787 6.69361 13.8299 6.83762 13.9429C6.98163 14.0558 7.07502 14.2212 7.09733 14.4028L7.41399 16.9795C7.43498 17.161 7.38359 17.3434 7.27096 17.4872C7.15833 17.6311 6.99354 17.7247 6.81233 17.7478L4.27483 18.0645C3.83233 18.0987 3.54649 17.8128 3.50233 17.462C3.48061 17.2799 3.53163 17.0967 3.64429 16.952C3.75696 16.8074 3.92216 16.713 4.10399 16.6895L4.94816 16.5845C3.5751 15.5463 2.56001 14.1057 2.04424 12.4634C1.52847 10.8211 1.5377 9.05881 2.07066 7.422C3.16566 4.00866 6.39316 1.66366 9.95483 1.667C10.4173 1.667 10.6898 1.99366 10.6832 2.37533C10.6723 2.75616 10.3932 3.04866 9.95483 3.04866C6.98566 3.05533 4.29816 5.00616 3.38316 7.84783C2.93552 9.22437 2.93213 10.7068 3.37346 12.0854C3.81479 13.464 4.67849 14.6688 5.84233 15.5295L5.72649 14.5728C5.71519 14.4825 5.72181 14.3909 5.74599 14.3031C5.77017 14.2154 5.81143 14.1333 5.8674 14.0615C5.92338 13.9898 5.99296 13.9297 6.07217 13.8849C6.15138 13.8401 6.23865 13.8114 6.32899 13.8003ZM15.894 3.3145L15.0498 3.4195C16.422 4.45687 17.4366 5.89629 17.9524 7.53736C18.4682 9.17843 18.4594 10.9395 17.9273 12.5753C16.8323 15.9887 13.6048 18.3337 10.0407 18.3337C9.57816 18.3337 9.30566 18.007 9.31233 17.6253C9.32316 17.2445 9.60149 16.952 10.0407 16.952C13.0098 16.9453 15.6973 14.9953 16.6123 12.1528C17.06 10.7763 17.0634 9.29383 16.622 7.91526C16.1807 6.53668 15.317 5.33181 14.1532 4.47116L14.2682 5.42783C14.2847 5.52032 14.2823 5.61521 14.2609 5.70672C14.2396 5.79823 14.1999 5.88443 14.1441 5.96007C14.0884 6.03571 14.0178 6.0992 13.9367 6.14666C13.8556 6.19412 13.7657 6.22456 13.6724 6.23613C13.5792 6.24769 13.4846 6.24013 13.3943 6.21392C13.3041 6.1877 13.2202 6.14338 13.1476 6.08365C13.0751 6.02392 13.0155 5.95004 12.9725 5.86651C12.9294 5.78298 12.9039 5.69156 12.8973 5.59783L12.5848 3.02533C12.5636 2.8436 12.615 2.66084 12.7278 2.5168C12.8407 2.37276 13.0058 2.27909 13.1873 2.25616L15.724 1.9395C16.1665 1.90533 16.4523 2.19116 16.4965 2.542C16.5182 2.72418 16.4671 2.90757 16.3542 3.05224C16.2414 3.19692 16.076 3.29117 15.894 3.3145Z" fill="white"/>
												</svg>													
											</div>

										</div>
									</div>
									
								</div>
							<?php endfor; ?>
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
	<div id="dicey-menu-replace-modal" class="carte-modal" aria-hidden="true">
		<div class="carte-modal__wr">
			<button type="button" class="carte-modal__close" aria-label="Закрыть окно замены">
				<svg width="42" height="42" viewBox="0 0 42 42" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
					<path d="M9.863 9.863L32.137 32.137M32.137 9.863L9.863 32.137" stroke="#5182A6" stroke-width="1.4" stroke-linecap="round" />
				</svg>
			</button>
			<div class="carte-modal__head"><p>Заменить блюдо</p></div>
			<div class="carte-modal__blocks">
				<?php foreach ( $menu_examples as $index => $example ) : ?>
					<div class="carte-modal__block" data-menu-candidate="<?php echo esc_attr( $index ); ?>">
						<?php if ( ! empty( $example['images'][0]['thumb'] ) ) : ?>
							<img src="<?php echo esc_url( $example['images'][0]['thumb'] ); ?>" alt="<?php echo esc_attr( $example['title'] ); ?>" class="carte-modal__img">
						<?php endif; ?>
						<div class="carte-modal__block-info">
							<p class="carte-modal__block-name"><?php echo esc_html( $example['title'] ); ?></p>
							<?php if ( '' !== trim( $example['kbju'] ) ) : ?><p class="carte-modal__block-text"><?php echo esc_html( wp_strip_all_tags( $example['kbju'] ) ); ?></p><?php endif; ?>
							<?php if ( '' !== trim( isset( $example['price'] ) ? $example['price'] : '' ) ) : ?><p class="carte-modal__block-text"><?php echo esc_html( dicey_product_price_with_currency( $example['price'] ) ); ?></p><?php endif; ?>
							<button type="button" class="carte-modal__block-btn" data-menu-choose="<?php echo esc_attr( $index ); ?>">Выбрать</button>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
	<?php echo dicey_render_related_products( $post_id ); ?>
	<?php echo dicey_render_why(); ?>
</main>
