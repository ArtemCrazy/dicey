<?php
/**
 * Products catalog.
 *
 * @package Dicey
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function dicey_register_product_post_type() {
	if ( post_type_exists( 'product' ) ) {
		return;
	}

	$labels = array(
		'name'               => 'Товары',
		'singular_name'      => 'Товар',
		'menu_name'          => 'Товары',
		'name_admin_bar'     => 'Товар',
		'add_new'            => 'Добавить товар',
		'add_new_item'       => 'Добавить товар',
		'edit_item'          => 'Редактировать товар',
		'new_item'           => 'Новый товар',
		'view_item'          => 'Посмотреть товар',
		'view_items'         => 'Посмотреть товары',
		'search_items'       => 'Найти товары',
		'not_found'          => 'Товары не найдены',
		'not_found_in_trash' => 'В корзине товаров нет',
		'all_items'          => 'Все товары',
	);

	register_post_type(
		'dicey_product',
		array(
			'labels'        => $labels,
			'public'        => true,
			'show_in_rest'  => true,
			'menu_position' => 21,
			'menu_icon'     => 'dashicons-products',
			'has_archive'   => false,
			'rewrite'       => array(
				'slug'       => 'product',
				'with_front' => false,
			),
			'supports'      => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'page-attributes' ),
		)
	);
}

add_action( 'init', 'dicey_register_product_post_type' );

function dicey_product_post_type() {
	return post_type_exists( 'product' ) ? 'product' : 'dicey_product';
}

function dicey_product_meta_defaults() {
	return array(
		'card_title'        => '',
		'price'             => '5 000 ₽',
		'calories'          => 'КБЖУ: 450 / 52 / 6 / 38',
		'card_image'        => 'imgs/bg/popularity__img.png',
		'gallery'           => "imgs/bg/product-img1.png\nimgs/bg/product-img1.png\nimgs/bg/product-img1.png\nimgs/bg/product-img1.png",
		'gallery_thumbs'    => "imgs/bg/product-img2.png\nimgs/bg/product-img2.png\nimgs/bg/product-img2.png\nimgs/bg/product-img2.png",
		'tags'              => '',
		'is_vip'            => '',
		'show_on_home'      => '',
		'match_age_groups'  => '',
		'match_weight_min'  => '',
		'match_weight_max'  => '',
		'match_breeds'      => '',
		'terms'             => "3 дня\n5 дней\n1 месяц\n3 месяца\n6 месяцев",
		'composition_title' => 'Состав',
		'composition_text'  => 'Курица, куриные сердечки/куриные желудки , рис/гречка , овощи',
		'desc_title'        => 'Описание рациона',
		'desc_text'         => "Набор «С курицей для мелких пород» – это 6 порций еды для собаки на 3 дня. Он будет приготовлен из свежих сырых продуктов после вашего заказа. Каждая порция пронумерована и подписана. Точный состав и вес порции указан на упаковке.\n\nРацион рассчитан на ежедневное кормление.\nУтром и вечером даётся одинаковая порция.\n\nВ течение срока рацион чередуется, чтобы питание было разнообразным.",
		'kbju_title'        => 'КБЖУ',
		'kbju_text'         => 'Расчет дневного рациона: калории: ~240 ккал, белки: ~28–30 г, жиры: ~10–12 г, углеводы: ~10–12 г',
		'faq'               => "Как кормить?|Да, рацион подбирается индивидуально с учётом породы, возраста, веса, уровня активности и особенностей здоровья вашей собаки. Мы учитываем пищевые предпочтения, чувствительное пищеварение, аллергии и другие важные нюансы, чтобы питание было комфортным и полезным именно для вашего питомца.\nКак хранить?|Да, рацион подбирается индивидуально с учётом породы, возраста, веса, уровня активности и особенностей здоровья вашей собаки.\nДоставка|Да, рацион подбирается индивидуально с учётом породы, возраста, веса, уровня активности и особенностей здоровья вашей собаки.",
	);
}

function dicey_product_meta_keys() {
	return array_keys( dicey_product_meta_defaults() );
}

function dicey_get_product_meta( $post_id ) {
	$defaults = dicey_product_meta_defaults();
	$data     = array();

	foreach ( $defaults as $key => $default ) {
		$value = '';

		if ( function_exists( 'carbon_get_post_meta' ) ) {
			$value = carbon_get_post_meta( $post_id, 'dicey_product_' . $key );
		}

		if ( '' === $value || null === $value ) {
			$value = get_post_meta( $post_id, '_dicey_product_' . $key, true );
		}

		$data[ $key ] = '' === $value ? $default : $value;
	}

	return $data;
}

function dicey_product_lines( $value ) {
	if ( is_array( $value ) ) {
		$lines = array_map( 'trim', $value );

		return array_values( array_filter( $lines, static function ( $line ) { return '' !== $line; } ) );
	}

	$lines = preg_split( '/\r\n|\r|\n/', (string) $value );
	$lines = array_map( 'trim', $lines );

	return array_values( array_filter( $lines, static function ( $line ) { return '' !== $line; } ) );
}

function dicey_product_image_url( $value, $post_id = 0, $single = false ) {
	$value = trim( (string) $value );

	if ( '' !== $value ) {
		if ( is_numeric( $value ) ) {
			$image = wp_get_attachment_image_url( absint( $value ), $single ? 'large' : 'medium_large' );
			if ( $image ) {
				return $image;
			}
		}

		return dicey_asset_img( $value );
	}

	if ( $post_id && has_post_thumbnail( $post_id ) ) {
		return get_the_post_thumbnail_url( $post_id, $single ? 'large' : 'medium_large' );
	}

	return dicey_asset_img( $single ? 'imgs/bg/product-img1.png' : 'imgs/bg/popularity__img.png' );
}

function dicey_product_card_image_url( $post_id ) {
	$meta = dicey_get_product_meta( $post_id );

	if ( has_post_thumbnail( $post_id ) ) {
		return get_the_post_thumbnail_url( $post_id, 'medium_large' );
	}

	return dicey_product_image_url( $meta['card_image'], $post_id );
}

function dicey_product_title_for_card( $post_id ) {
	$meta = dicey_get_product_meta( $post_id );

	return '' !== trim( $meta['card_title'] ) ? $meta['card_title'] : get_the_title( $post_id );
}

function dicey_product_price_for_card( $post_id, $meta = null ) {
	$meta = null === $meta ? dicey_get_product_meta( $post_id ) : $meta;

	if ( function_exists( 'wc_get_product' ) ) {
		$product = wc_get_product( $post_id );
		if ( $product ) {
			$price_html = wp_strip_all_tags( $product->get_price_html() );
			if ( '' !== trim( $price_html ) ) {
				return $price_html;
			}
		}
	}

	if ( '' !== trim( $meta['price'] ) ) {
		return $meta['price'];
	}

	return '';
}

function dicey_product_cart_payload( $post_id ) {
	if ( ! function_exists( 'wc_get_product' ) || ! function_exists( 'wc_get_cart_url' ) ) {
		return array();
	}

	$product = wc_get_product( $post_id );
	if ( ! $product || ! $product->exists() || ! $product->is_purchasable() || ! $product->is_in_stock() ) {
		return array();
	}

	$payload = array(
		'action' => wc_get_cart_url(),
		'fields' => array(
			'add-to-cart' => $post_id,
			'product_id'  => $post_id,
			'quantity'    => 1,
		),
	);

	if ( $product->is_type( 'variable' ) ) {
		$options = dicey_get_wc_product_period_options( $post_id );
		if ( empty( $options[0] ) ) {
			return array();
		}

		$payload['fields']['variation_id'] = $options[0]['variation_id'];
		foreach ( $options[0]['attributes'] as $attribute_key => $attribute_value ) {
			$payload['fields'][ $attribute_key ] = $attribute_value;
		}
	}

	return $payload;
}

function dicey_render_product_cart_button( $post_id ) {
	$payload = dicey_product_cart_payload( $post_id );

	if ( ! $payload ) {
		?>
		<a href="<?php echo esc_url( get_permalink( $post_id ) ); ?>" class="popularity__btn">Смотреть</a>
		<?php
		return;
	}
	?>
	<form class="popularity__cart-form" method="post" action="<?php echo esc_url( $payload['action'] ); ?>">
		<?php foreach ( $payload['fields'] as $field_name => $field_value ) : ?>
			<input type="hidden" name="<?php echo esc_attr( $field_name ); ?>" value="<?php echo esc_attr( $field_value ); ?>">
		<?php endforeach; ?>
		<button type="submit" class="popularity__btn">В корзину</button>
	</form>
	<?php
}

function dicey_product_variation_label( $attribute_name, $attribute_value ) {
	$attribute_name  = preg_replace( '/^attribute_/', '', (string) $attribute_name );
	$attribute_value = (string) $attribute_value;

	if ( taxonomy_exists( $attribute_name ) ) {
		$term = get_term_by( 'slug', $attribute_value, $attribute_name );
		if ( $term && ! is_wp_error( $term ) ) {
			return $term->name;
		}
	}

	return $attribute_value;
}

function dicey_get_wc_product_period_options( $post_id ) {
	if ( ! function_exists( 'wc_get_product' ) ) {
		return array();
	}

	$product = wc_get_product( $post_id );
	if ( ! $product || ! $product->is_type( 'variable' ) ) {
		return array();
	}

	$options = array();
	foreach ( $product->get_children() as $variation_id ) {
		$variation = wc_get_product( $variation_id );
		if ( ! $variation || ! $variation->exists() || ! $variation->is_purchasable() || ! $variation->is_in_stock() ) {
			continue;
		}

		$attributes = $variation->get_variation_attributes();
		if ( empty( $attributes ) ) {
			continue;
		}

		$period_key   = '';
		$period_value = '';
		foreach ( $attributes as $attribute_key => $attribute_value ) {
			$period_key   = $attribute_key;
			$period_value = $attribute_value;
			break;
		}

		if ( '' === $period_key ) {
			continue;
		}

		$options[] = array(
			'variation_id' => $variation_id,
			'label'        => dicey_product_variation_label( $period_key, $period_value ),
			'price'        => wp_strip_all_tags( $variation->get_price_html() ),
			'attributes'   => $attributes,
		);
	}

	return $options;
}

function dicey_render_product_card( $post_id ) {
	$meta        = dicey_get_product_meta( $post_id );
	$tags        = dicey_product_lines( $meta['tags'] );
	$age_groups  = dicey_product_lines( $meta['match_age_groups'] );
	$breeds      = dicey_product_lines( $meta['match_breeds'] );
	$weight_min  = '' !== trim( $meta['match_weight_min'] ) ? (float) str_replace( ',', '.', $meta['match_weight_min'] ) : '';
	$weight_max  = '' !== trim( $meta['match_weight_max'] ) ? (float) str_replace( ',', '.', $meta['match_weight_max'] ) : '';
	?>
	<div class="popularity__block" data-dicey-product="1" data-age-groups="<?php echo esc_attr( implode( ',', $age_groups ) ); ?>" data-weight-min="<?php echo esc_attr( $weight_min ); ?>" data-weight-max="<?php echo esc_attr( $weight_max ); ?>" data-breeds="<?php echo esc_attr( implode( ',', $breeds ) ); ?>" data-vip="<?php echo esc_attr( $meta['is_vip'] ? '1' : '0' ); ?>">
		<a href="<?php echo esc_url( get_permalink( $post_id ) ); ?>" class="popularity__link">
			<div class="popularity__img-wr">
				<?php if ( $tags || $meta['is_vip'] ) : ?>
					<div class="popularity__tags">
						<?php if ( $meta['is_vip'] ) : ?><div class="popularity__tag vip"><img src="<?php echo esc_url( dicey_asset_img( 'imgs/icons/vip.svg' ) ); ?>" alt="">ВИП</div><?php endif; ?>
						<?php foreach ( $tags as $tag ) : ?><div class="popularity__tag"><?php echo esc_html( $tag ); ?></div><?php endforeach; ?>
					</div>
				<?php endif; ?>
				<img src="<?php echo esc_url( dicey_product_card_image_url( $post_id ) ); ?>" alt="<?php echo esc_attr( get_the_title( $post_id ) ); ?>" class="popularity__diet">
				<img src="<?php echo esc_url( dicey_asset_img( 'imgs/icons/popularity__hover.svg' ) ); ?>" alt="" class="popularity__hover">
				<div class="popularity__shadow"></div>
			</div>
			<div class="popularity__head">
				<p class="popularity__name"><?php echo esc_html( dicey_product_title_for_card( $post_id ) ); ?></p>
				<?php if ( '' !== trim( $meta['calories'] ) ) : ?><p class="popularity__calories"><?php echo esc_html( $meta['calories'] ); ?></p><?php endif; ?>
			</div>
			<?php $price = dicey_product_price_for_card( $post_id, $meta ); ?>
			<?php if ( '' !== trim( $price ) ) : ?>
				<p class="popularity__price"><?php echo esc_html( $price ); ?></p>
			<?php endif; ?>
		</a>
		<?php dicey_render_product_cart_button( $post_id ); ?>
	</div>
	<?php
}

function dicey_get_products_query( $args = array() ) {
	$defaults = array(
		'post_type'           => dicey_product_post_type(),
		'post_status'         => 'publish',
		'posts_per_page'      => -1,
		'orderby'             => array( 'menu_order' => 'ASC', 'date' => 'DESC' ),
		'ignore_sticky_posts' => true,
		'meta_query'          => array(
			'relation' => 'OR',
			array(
				'key'     => '_dicey_is_consultation',
				'compare' => 'NOT EXISTS',
			),
			array(
				'key'     => '_dicey_is_consultation',
				'value'   => '1',
				'compare' => '!=',
			),
		),
	);

	return new WP_Query( array_merge( $defaults, $args ) );
}

function dicey_has_products() {
	$query = dicey_get_products_query( array( 'posts_per_page' => 1 ) );
	$has   = $query->have_posts();
	wp_reset_postdata();

	return $has;
}

function dicey_render_products_grid() {
	$query = dicey_get_products_query();

	if ( ! $query->have_posts() ) {
		return false;
	}

	while ( $query->have_posts() ) {
		$query->the_post();
		dicey_render_product_card( get_the_ID() );
	}

	wp_reset_postdata();
	return true;
}

function dicey_render_shop_page() {
	return dicey_get_template_html( 'template-parts/static/shop' );
}

function dicey_render_featured_products() {
	$query = dicey_get_products_query(
		array(
			'posts_per_page' => 4,
			'meta_key'       => '_dicey_product_show_on_home',
			'meta_value'     => '1',
		)
	);

	if ( ! $query->have_posts() ) {
		return '';
	}

	ob_start();
	?>
	<section class="popularity">
		<div class="container">
			<h2 class="popularity__title">Заказывают чаще всего</h2>
			<div class="popularity__blocks">
				<?php
				while ( $query->have_posts() ) {
					$query->the_post();
					dicey_render_product_card( get_the_ID() );
				}
				wp_reset_postdata();
				?>
			</div>
		</div>
	</section>
	<?php
	return ob_get_clean();
}

function dicey_append_featured_products_after_conveniences( $block_content, $block ) {
	if ( is_admin() || ! is_front_page() || empty( $block['blockName'] ) || 'dicey/home-conveniences' !== $block['blockName'] ) {
		return $block_content;
	}

	return $block_content . dicey_render_featured_products();
}

add_filter( 'render_block', 'dicey_append_featured_products_after_conveniences', 10, 2 );

function dicey_render_related_products( $current_id = 0 ) {
	$args = array(
		'posts_per_page' => 4,
	);

	if ( $current_id ) {
		$args['post__not_in'] = array( $current_id );
	}

	$query = dicey_get_products_query( $args );

	if ( ! $query->have_posts() ) {
		return '';
	}

	ob_start();
	?>
	<section class="popularity">
		<div class="container">
			<h2 class="popularity__title">Похожие рационы</h2>
			<div class="popularity__blocks">
				<?php
				while ( $query->have_posts() ) {
					$query->the_post();
					dicey_render_product_card( get_the_ID() );
				}
				wp_reset_postdata();
				?>
			</div>
		</div>
	</section>
	<?php
	return ob_get_clean();
}

function dicey_product_faq_items( $value ) {
	$items = array();
	foreach ( dicey_product_lines( $value ) as $line ) {
		$parts = array_map( 'trim', explode( '|', $line, 2 ) );
		if ( ! empty( $parts[0] ) ) {
			$items[] = array(
				'question' => $parts[0],
				'answer'   => isset( $parts[1] ) ? $parts[1] : '',
			);
		}
	}

	return $items;
}

function dicey_add_product_meta_box() {
	if ( function_exists( 'carbon_get_post_meta' ) && 'product' === dicey_product_post_type() ) {
		return;
	}

	add_meta_box( 'dicey-product-data', 'Карточка товара', 'dicey_render_product_meta_box', dicey_product_post_type(), 'normal', 'high' );
}

add_action( 'add_meta_boxes', 'dicey_add_product_meta_box' );

function dicey_render_product_meta_box( $post ) {
	$meta = dicey_get_product_meta( $post->ID );
	wp_nonce_field( 'dicey_product_meta', 'dicey_product_meta_nonce' );
	?>
	<style>
		.dicey-product-grid{display:grid;grid-template-columns:1fr 1fr;gap:16px 20px}.dicey-product-field label{display:block;font-weight:600;margin-bottom:6px}.dicey-product-field input[type=text],.dicey-product-field textarea{width:100%}.dicey-product-field textarea{min-height:86px}.dicey-product-wide{grid-column:1/-1}.dicey-product-note{color:#646970;font-size:12px;margin:4px 0 0}
	</style>
	<div class="dicey-product-grid">
		<div class="dicey-product-field"><label>Название в карточке</label><input type="text" name="dicey_product[card_title]" value="<?php echo esc_attr( $meta['card_title'] ); ?>"><p class="dicey-product-note">Если пусто, берется заголовок товара.</p></div>
		<div class="dicey-product-field"><label>Цена</label><input type="text" name="dicey_product[price]" value="<?php echo esc_attr( $meta['price'] ); ?>"></div>
		<div class="dicey-product-field"><label>КБЖУ для карточки</label><input type="text" name="dicey_product[calories]" value="<?php echo esc_attr( $meta['calories'] ); ?>"></div>
		<div class="dicey-product-field"><label>Изображение карточки</label><input type="text" name="dicey_product[card_image]" value="<?php echo esc_attr( $meta['card_image'] ); ?>"><p class="dicey-product-note">Можно использовать «Изображение записи» справа или путь/URL здесь.</p></div>
		<div class="dicey-product-field"><label><input type="checkbox" name="dicey_product[show_on_home]" value="1" <?php checked( $meta['show_on_home'], '1' ); ?>> Показывать на главной</label><p class="dicey-product-note">На главную выводится максимум 4 товара.</p></div>
		<div class="dicey-product-field"><label><input type="checkbox" name="dicey_product[is_vip]" value="1" <?php checked( $meta['is_vip'], '1' ); ?>> ВИП-рацион</label></div>
		<div class="dicey-product-field dicey-product-wide"><strong>Логика подбора рациона</strong><p class="dicey-product-note">Если поля ниже пустые, товар считается подходящим всем. Реальные значения нужно заполнить после получения таблицы от заказчика.</p></div>
		<div class="dicey-product-field">
			<label>Возраст собаки</label>
			<?php $selected_age_groups = dicey_product_lines( $meta['match_age_groups'] ); ?>
			<label><input type="checkbox" name="dicey_product[match_age_groups][]" value="adult" <?php checked( in_array( 'adult', $selected_age_groups, true ) ); ?>> 1-10 лет</label>
			<label><input type="checkbox" name="dicey_product[match_age_groups][]" value="senior" <?php checked( in_array( 'senior', $selected_age_groups, true ) ); ?>> &gt; 10 лет</label>
		</div>
		<div class="dicey-product-field"><label>Вес от, кг</label><input type="text" name="dicey_product[match_weight_min]" value="<?php echo esc_attr( $meta['match_weight_min'] ); ?>"><p class="dicey-product-note">Например: 2.5</p></div>
		<div class="dicey-product-field"><label>Вес до, кг</label><input type="text" name="dicey_product[match_weight_max]" value="<?php echo esc_attr( $meta['match_weight_max'] ); ?>"><p class="dicey-product-note">Если пусто, верхняя граница не ограничена.</p></div>
		<div class="dicey-product-field dicey-product-wide"><label>Породы для подбора, каждая с новой строки</label><textarea name="dicey_product[match_breeds]"><?php echo esc_textarea( is_array( $meta['match_breeds'] ) ? implode( "\n", $meta['match_breeds'] ) : $meta['match_breeds'] ); ?></textarea><p class="dicey-product-note">Если пусто, рацион подходит для любой породы.</p></div>
		<div class="dicey-product-field dicey-product-wide"><label>Теги карточки, каждый с новой строки</label><textarea name="dicey_product[tags]"><?php echo esc_textarea( $meta['tags'] ); ?></textarea></div>
		<div class="dicey-product-field"><label>Сроки, каждый с новой строки</label><textarea name="dicey_product[terms]"><?php echo esc_textarea( $meta['terms'] ); ?></textarea></div>
		<div class="dicey-product-field"><label>Галерея, каждый URL/путь с новой строки</label><textarea name="dicey_product[gallery]"><?php echo esc_textarea( $meta['gallery'] ); ?></textarea></div>
		<div class="dicey-product-field"><label>Миниатюры галереи, каждый URL/путь с новой строки</label><textarea name="dicey_product[gallery_thumbs]"><?php echo esc_textarea( $meta['gallery_thumbs'] ); ?></textarea></div>
		<div class="dicey-product-field"><label>Заголовок состава</label><input type="text" name="dicey_product[composition_title]" value="<?php echo esc_attr( $meta['composition_title'] ); ?>"></div>
		<div class="dicey-product-field"><label>Состав</label><textarea name="dicey_product[composition_text]"><?php echo esc_textarea( $meta['composition_text'] ); ?></textarea></div>
		<div class="dicey-product-field"><label>Заголовок описания</label><input type="text" name="dicey_product[desc_title]" value="<?php echo esc_attr( $meta['desc_title'] ); ?>"></div>
		<div class="dicey-product-field"><label>Описание рациона</label><textarea name="dicey_product[desc_text]"><?php echo esc_textarea( $meta['desc_text'] ); ?></textarea></div>
		<div class="dicey-product-field"><label>Заголовок КБЖУ</label><input type="text" name="dicey_product[kbju_title]" value="<?php echo esc_attr( $meta['kbju_title'] ); ?>"></div>
		<div class="dicey-product-field"><label>КБЖУ</label><textarea name="dicey_product[kbju_text]"><?php echo esc_textarea( $meta['kbju_text'] ); ?></textarea></div>
		<div class="dicey-product-field dicey-product-wide"><label>FAQ: вопрос|ответ, каждый пункт с новой строки</label><textarea name="dicey_product[faq]"><?php echo esc_textarea( $meta['faq'] ); ?></textarea></div>
	</div>
	<?php
}

function dicey_save_product_meta( $post_id ) {
	if ( ! isset( $_POST['dicey_product_meta_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['dicey_product_meta_nonce'] ) ), 'dicey_product_meta' ) ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( ! current_user_can( 'edit_post', $post_id ) || empty( $_POST['dicey_product'] ) || ! is_array( $_POST['dicey_product'] ) ) {
		return;
	}

	$raw = wp_unslash( $_POST['dicey_product'] );
	foreach ( dicey_product_meta_keys() as $key ) {
		$value = isset( $raw[ $key ] ) ? $raw[ $key ] : '';
		if ( in_array( $key, array( 'show_on_home', 'is_vip' ), true ) ) {
			$value = $value ? '1' : '';
		} elseif ( 'match_age_groups' === $key ) {
			$value = is_array( $value ) ? implode( "\n", array_map( 'sanitize_key', $value ) ) : '';
		} else {
			$value = is_array( $value ) ? '' : wp_kses_post( $value );
		}
		update_post_meta( $post_id, '_dicey_product_' . $key, $value );
	}
}

add_action( 'save_post_dicey_product', 'dicey_save_product_meta' );
add_action( 'save_post_product', 'dicey_save_product_meta' );

function dicey_products_import_demo() {
	if ( get_option( 'dicey_products_demo_imported' ) || dicey_has_products() ) {
		return;
	}

	$post_type = dicey_product_post_type();

	$products = array(
		array( 'title' => 'С кроликом и крупой, для собак весом 3 кг', 'price' => '5 000 ₽', 'calories' => 'КБЖУ: 450 / 52 / 6 / 38', 'card_image' => 'imgs/bg/popularity__img.png', 'tags' => 'Мальтипу', 'home' => '1' ),
		array( 'title' => 'С курицей и крупой, для собак с весом 7 кг', 'price' => '5 000 ₽', 'calories' => 'КБЖУ: 450 / 52 / 6 / 38', 'card_image' => 'imgs/bg/popularity__img2.png', 'tags' => 'Мопс', 'home' => '1' ),
		array( 'title' => 'С рыбой, овощами и крупой, для собак с весом 10 кг', 'price' => '7 000 ₽', 'calories' => 'КБЖУ: 450 / 52 / 6 / 38', 'card_image' => 'imgs/bg/popularity__img3.png', 'tags' => 'Вельш корги', 'vip' => '1', 'home' => '1' ),
		array( 'title' => 'С говядиной и крупой, для собак с весом 12 кг', 'price' => '5 000 ₽', 'calories' => 'КБЖУ: 450 / 52 / 6 / 38', 'card_image' => 'imgs/bg/popularity__img4.png', 'tags' => 'Бордер колли', 'home' => '1' ),
	);

	foreach ( $products as $index => $product ) {
		$post_id = wp_insert_post(
			array(
				'post_type'    => $post_type,
				'post_status'  => 'publish',
				'post_title'   => $product['title'],
				'post_excerpt' => $product['calories'],
				'menu_order'   => $index,
			)
		);

		if ( ! $post_id || is_wp_error( $post_id ) ) {
			continue;
		}

		update_post_meta( $post_id, '_dicey_product_card_title', $product['title'] );
		update_post_meta( $post_id, '_dicey_product_price', $product['price'] );
		update_post_meta( $post_id, '_dicey_product_calories', $product['calories'] );
		update_post_meta( $post_id, '_dicey_product_card_image', $product['card_image'] );
		update_post_meta( $post_id, '_dicey_product_tags', $product['tags'] );
		update_post_meta( $post_id, '_dicey_product_show_on_home', $product['home'] );
		update_post_meta( $post_id, '_dicey_product_is_vip', isset( $product['vip'] ) ? $product['vip'] : '' );

		if ( 'product' === $post_type ) {
			$woo_price = preg_replace( '/[^\d.,]/', '', $product['price'] );
			wp_set_object_terms( $post_id, 'simple', 'product_type' );
			update_post_meta( $post_id, '_regular_price', $woo_price );
			update_post_meta( $post_id, '_price', $woo_price );
			update_post_meta( $post_id, '_stock_status', 'instock' );
			update_post_meta( $post_id, '_manage_stock', 'no' );
		}
	}

	update_option( 'dicey_products_demo_imported', 1 );
}

add_action( 'init', 'dicey_products_import_demo', 20 );
