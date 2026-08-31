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
add_action( 'add_meta_boxes_product', 'dicey_add_product_type_meta_box' );
add_action( 'add_meta_boxes_product', 'dicey_cleanup_product_taxonomy_meta_boxes', 1000 );
add_action( 'do_meta_boxes', 'dicey_cleanup_product_taxonomy_meta_boxes', 1000 );
add_filter( 'manage_product_posts_columns', 'dicey_product_admin_columns' );
add_action( 'manage_product_posts_custom_column', 'dicey_render_product_admin_column', 10, 2 );

function dicey_product_post_type() {
	return post_type_exists( 'product' ) ? 'product' : 'dicey_product';
}

function dicey_product_kind( $post_id ) {
	return '1' === get_post_meta( $post_id, '_dicey_is_consultation', true ) ? 'consultation' : 'ration';
}

function dicey_product_kind_label( $post_id ) {
	return 'consultation' === dicey_product_kind( $post_id ) ? 'Консультация' : 'Рацион';
}

function dicey_add_product_type_meta_box() {
	add_meta_box( 'dicey-product-type', 'Тип позиции Дайси', 'dicey_render_product_type_meta_box', 'product', 'side', 'high' );
}

function dicey_cleanup_product_taxonomy_meta_boxes() {
	foreach ( array( 'product_brand', 'pa_brand', 'brand' ) as $taxonomy ) {
		foreach ( array( 'side', 'normal', 'advanced' ) as $context ) {
			remove_meta_box( $taxonomy . 'div', 'product', $context );
			remove_meta_box( 'tagsdiv-' . $taxonomy, 'product', $context );
		}
	}

	if ( taxonomy_exists( 'product_tag' ) ) {
		remove_meta_box( 'tagsdiv-product_tag', 'product', 'side' );
		add_meta_box( 'tagsdiv-product_tag', 'Теги породы', 'post_tags_meta_box', 'product', 'side', 'default', array( 'taxonomy' => 'product_tag' ) );
	}
}

function dicey_render_product_type_meta_box( $post ) {
	$kind  = dicey_product_kind( $post->ID );
	$label = dicey_product_kind_label( $post->ID );
	?>
	<style>
		.dicey-product-kind{display:inline-flex;align-items:center;border-radius:999px;padding:6px 10px;font-weight:600;background:#f5f9ff;color:#295d82}.dicey-product-kind--consultation{background:#faf4ff;color:#7c4ca5}.dicey-product-kind-note{margin:10px 0 0;color:#646970}
	</style>
	<p><span class="dicey-product-kind dicey-product-kind--<?php echo esc_attr( $kind ); ?>"><?php echo esc_html( $label ); ?></span></p>
	<?php if ( 'ration' === $kind ) : ?>
		<p class="dicey-product-kind-note">Это обычный товар WooCommerce из каталога рационов.</p>
	<?php else : ?>
		<p class="dicey-product-kind-note">Это услуга консультации, скрытая из общего каталога рационов.</p>
	<?php endif; ?>
	<?php
}

function dicey_product_admin_columns( $columns ) {
	$updated = array();

	foreach ( $columns as $key => $label ) {
		$updated[ $key ] = $label;
		if ( 'name' === $key || 'title' === $key ) {
			$updated['dicey_product_kind'] = 'Тип Дайси';
		}
	}

	return $updated;
}

function dicey_render_product_admin_column( $column, $post_id ) {
	if ( 'dicey_product_kind' !== $column ) {
		return;
	}

	echo esc_html( dicey_product_kind_label( $post_id ) );
}

function dicey_product_meta_defaults() {
	return array(
		'price'             => '5 000',
		'calories'          => '',
		'calories_k'        => '',
		'calories_b'        => '',
		'calories_f'        => '',
		'calories_c'        => '',
		'is_vip'            => '',
		'show_on_home'      => '',
		'match_age_groups'  => '',
		'match_weight_min'  => '',
		'match_weight_max'  => '',
		'match_breeds'      => '',
		'terms'             => "3 дня\n5 дней\n1 месяц\n3 месяца\n6 месяцев",
		'composition_text'  => '',
		'feeding_answer'    => '',
		'storage_answer'    => '',
		'delivery_answer'   => '',
		'menu_examples'     => array(),
	);
}

function dicey_product_breed_options() {
	return array(
		'Другая порода' => 'Другая порода',
		'Мальтипу'      => 'Мальтипу',
		'Мопс'          => 'Мопс',
		'Вельш корги'   => 'Вельш корги',
		'Бордер колли'  => 'Бордер колли',
	);
}

function dicey_product_term_options() {
	return array(
		'3 дня'     => '3 дня',
		'5 дней'    => '5 дней',
		'1 месяц'   => '1 месяц',
		'3 месяца'  => '3 месяца',
		'6 месяцев' => '6 месяцев',
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

function dicey_normalize_product_price_value( $price ) {
	$price = trim( wp_strip_all_tags( (string) $price ) );

	if ( '' === $price ) {
		return '';
	}

	$price = html_entity_decode( $price, ENT_QUOTES, get_bloginfo( 'charset' ) );
	$price = str_replace( array( "\xc2\xa0", '&nbsp;' ), ' ', $price );
	$price = preg_replace( '/\s*(?:₽|р\.?|руб\.?|RUB)\s*/iu', ' ', $price );
	$price = trim( preg_replace( '/\s+/u', ' ', $price ) );
	$value = preg_replace( '/\s+/u', '', $price );

	if ( preg_match( '/^(\d+)([,.](\d{1,2}))?$/', $value, $matches ) ) {
		$formatted = number_format( (int) $matches[1], 0, '', ' ' );

		if ( ! empty( $matches[3] ) ) {
			$formatted .= ',' . $matches[3];
		}

		return $formatted;
	}

	return $price;
}

function dicey_product_price_with_currency( $price ) {
	$price = trim( (string) $price );

	if ( '' === $price ) {
		return '';
	}

	if ( preg_match( '/(?:₽|р\.?|руб\.?|RUB)/iu', $price ) ) {
		return $price;
	}

	$price = dicey_normalize_product_price_value( $price );

	return '' === $price ? '' : $price . ' ₽';
}

function dicey_wc_product_price_fallback( $price, $product ) {
	if ( '' !== (string) $price || ! $product || ! $product->is_type( 'simple' ) ) {
		return $price;
	}

	$fallback = dicey_normalize_product_price_value( get_post_meta( $product->get_id(), '_dicey_product_price', true ) );
	$fallback = str_replace( array( ' ', ',' ), array( '', '.' ), $fallback );

	return is_numeric( $fallback ) ? $fallback : $price;
}

add_filter( 'woocommerce_product_get_price', 'dicey_wc_product_price_fallback', 10, 2 );
add_filter( 'woocommerce_product_get_regular_price', 'dicey_wc_product_price_fallback', 10, 2 );

function dicey_normalize_kbju_value( $value ) {
	$value = trim( wp_strip_all_tags( (string) $value ) );
	$value = str_replace( ',', '.', $value );
	$value = preg_replace( '/[^\d.]/', '', $value );

	return trim( $value, '.' );
}

function dicey_product_card_kbju_values( $meta ) {
	$values = array(
		'k' => isset( $meta['calories_k'] ) ? dicey_normalize_kbju_value( $meta['calories_k'] ) : '',
		'b' => isset( $meta['calories_b'] ) ? dicey_normalize_kbju_value( $meta['calories_b'] ) : '',
		'f' => isset( $meta['calories_f'] ) ? dicey_normalize_kbju_value( $meta['calories_f'] ) : '',
		'c' => isset( $meta['calories_c'] ) ? dicey_normalize_kbju_value( $meta['calories_c'] ) : '',
	);

	if ( array_filter( $values ) || empty( $meta['calories'] ) ) {
		return $values;
	}

	if ( preg_match_all( '/\d+(?:[,.]\d+)?/u', (string) $meta['calories'], $matches ) && count( $matches[0] ) >= 4 ) {
		$values['k'] = dicey_normalize_kbju_value( $matches[0][0] );
		$values['b'] = dicey_normalize_kbju_value( $matches[0][1] );
		$values['f'] = dicey_normalize_kbju_value( $matches[0][2] );
		$values['c'] = dicey_normalize_kbju_value( $matches[0][3] );
	}

	return $values;
}

function dicey_product_kbju_values_text( $meta ) {
	$values = dicey_product_card_kbju_values( $meta );
	$parts  = array();
	$labels = array(
		'k' => 'К',
		'b' => 'Б',
		'f' => 'Ж',
		'c' => 'У',
	);

	foreach ( $labels as $key => $label ) {
		if ( '' !== $values[ $key ] ) {
			$parts[] = $label . ' ' . $values[ $key ];
		}
	}

	return implode( ' / ', $parts );
}

function dicey_product_card_calories_text( $meta ) {
	$kbju = dicey_product_kbju_values_text( $meta );

	return '' === $kbju ? '' : 'КБЖУ: ' . $kbju;
}

function dicey_product_legacy_tags( $post_id ) {
	$value = get_post_meta( $post_id, '_dicey_product_tags', true );

	if ( '' === $value && function_exists( 'carbon_get_post_meta' ) ) {
		$value = carbon_get_post_meta( $post_id, 'dicey_product_tags' );
	}

	return dicey_product_lines( $value );
}

function dicey_product_card_tags( $post_id ) {
	$tags = array();

	if ( taxonomy_exists( 'product_tag' ) ) {
		$terms = get_the_terms( $post_id, 'product_tag' );

		if ( ! is_wp_error( $terms ) && $terms ) {
			$tags = wp_list_pluck( $terms, 'name' );
		}
	}

	if ( ! $tags ) {
		$tags = dicey_product_legacy_tags( $post_id );
	}

	return array_values( array_unique( array_filter( array_map( 'trim', $tags ) ) ) );
}

function dicey_product_question_items( $meta ) {
	$items = array(
		array(
			'question' => 'Как кормить?',
			'answer'   => isset( $meta['feeding_answer'] ) ? $meta['feeding_answer'] : '',
		),
		array(
			'question' => 'Как хранить?',
			'answer'   => isset( $meta['storage_answer'] ) ? $meta['storage_answer'] : '',
		),
		array(
			'question' => 'Доставка',
			'answer'   => isset( $meta['delivery_answer'] ) ? $meta['delivery_answer'] : '',
		),
	);

	return array_values(
		array_filter(
			$items,
			static function ( $item ) {
				return '' !== trim( (string) $item['answer'] );
			}
		)
	);
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

function dicey_product_legacy_card_image_value( $post_id ) {
	$value = get_post_meta( $post_id, '_dicey_product_card_image', true );

	if ( '' === $value && function_exists( 'carbon_get_post_meta' ) ) {
		$value = carbon_get_post_meta( $post_id, 'dicey_product_card_image' );
	}

	return trim( (string) $value );
}

function dicey_product_card_image_url( $post_id ) {
	if ( has_post_thumbnail( $post_id ) ) {
		return get_the_post_thumbnail_url( $post_id, 'medium_large' );
	}

	$legacy_image = dicey_product_legacy_card_image_value( $post_id );

	if ( '' !== $legacy_image ) {
		return dicey_product_image_url( $legacy_image, $post_id );
	}

	return dicey_asset_img( 'imgs/bg/popularity__img.png' );
}

function dicey_product_legacy_gallery_values( $post_id, $key ) {
	$value = get_post_meta( $post_id, '_dicey_product_' . $key, true );

	if ( '' === $value && function_exists( 'carbon_get_post_meta' ) ) {
		$value = carbon_get_post_meta( $post_id, 'dicey_product_' . $key );
	}

	return dicey_product_lines( $value );
}

function dicey_product_gallery_items( $post_id ) {
	$items     = array();
	$image_ids = array();

	if ( has_post_thumbnail( $post_id ) ) {
		$image_ids[] = get_post_thumbnail_id( $post_id );
	}

	if ( function_exists( 'wc_get_product' ) ) {
		$product = wc_get_product( $post_id );

		if ( $product ) {
			$image_ids = array_merge( $image_ids, $product->get_gallery_image_ids() );
		}
	}

	foreach ( array_unique( array_filter( array_map( 'absint', $image_ids ) ) ) as $image_id ) {
		$large = wp_get_attachment_image_url( $image_id, 'large' );
		$thumb = wp_get_attachment_image_url( $image_id, 'medium_large' );

		if ( $large ) {
			$items[] = array(
				'large' => $large,
				'thumb' => $thumb ? $thumb : $large,
			);
		}
	}

	if ( $items ) {
		return $items;
	}

	$legacy_gallery = dicey_product_legacy_gallery_values( $post_id, 'gallery' );
	$legacy_thumbs  = dicey_product_legacy_gallery_values( $post_id, 'gallery_thumbs' );

	foreach ( $legacy_gallery as $index => $image ) {
		$thumb   = isset( $legacy_thumbs[ $index ] ) ? $legacy_thumbs[ $index ] : $image;
		$items[] = array(
			'large' => dicey_product_image_url( $image, $post_id, true ),
			'thumb' => dicey_product_image_url( $thumb, $post_id ),
		);
	}

	if ( $items ) {
		return $items;
	}

	return array(
		array(
			'large' => dicey_asset_img( 'imgs/bg/product-img1.png' ),
			'thumb' => dicey_asset_img( 'imgs/bg/product-img2.png' ),
		),
	);
}

function dicey_product_menu_limit_for_period( $label ) {
	$label = function_exists( 'mb_strtolower' ) ? mb_strtolower( (string) $label, 'UTF-8' ) : strtolower( (string) $label );

	if ( false !== strpos( $label, 'месяц' ) || false !== strpos( $label, 'month' ) ) {
		return 5;
	}

	if ( preg_match( '/(\d+)/u', $label, $matches ) ) {
		return min( 5, max( 1, absint( $matches[1] ) ) );
	}

	return 5;
}

function dicey_product_period_day_count( $label ) {
	$label = function_exists( 'mb_strtolower' ) ? mb_strtolower( trim( (string) $label ), 'UTF-8' ) : strtolower( trim( (string) $label ) );

	if ( preg_match( '/(\d+)\s*(?:месяц|месяца|месяцев)/u', $label, $matches ) ) {
		return max( 1, absint( $matches[1] ) ) * 30;
	}

	if ( false !== strpos( $label, 'месяц' ) ) {
		return 30;
	}

	if ( preg_match( '/(\d+)/', $label, $matches ) ) {
		return absint( $matches[1] );
	}

	return 0;
}

function dicey_sanitize_product_menu_examples( $examples ) {
	if ( ! is_array( $examples ) ) {
		return array();
	}

	$clean = array();
	foreach ( array_slice( $examples, 0, 5 ) as $example ) {
		if ( ! is_array( $example ) ) {
			continue;
		}

		$item = array(
			'title'          => isset( $example['title'] ) ? sanitize_text_field( $example['title'] ) : '',
			'price'          => isset( $example['price'] ) && ! is_array( $example['price'] ) ? dicey_normalize_product_price_value( $example['price'] ) : '',
			'composition'    => isset( $example['composition'] ) ? wp_kses_post( $example['composition'] ) : '',
			'kbju'           => isset( $example['kbju'] ) ? wp_kses_post( $example['kbju'] ) : '',
			'minerals'       => isset( $example['minerals'] ) ? wp_kses_post( $example['minerals'] ) : '',
			'portion_weight' => isset( $example['portion_weight'] ) ? sanitize_text_field( $example['portion_weight'] ) : '',
			'image_main'     => isset( $example['image_main'] ) ? absint( $example['image_main'] ) : 0,
			'image_second'   => isset( $example['image_second'] ) ? absint( $example['image_second'] ) : 0,
			'image_third'    => isset( $example['image_third'] ) ? absint( $example['image_third'] ) : 0,
		);

		if ( array_filter( $item, static function ( $value ) { return '' !== $value && 0 !== $value; } ) ) {
			$clean[] = $item;
		}
	}

	return $clean;
}

function dicey_product_menu_example_images( $example, $fallback_gallery ) {
	$images = array();
	foreach ( array( 'image_main', 'image_second', 'image_third' ) as $key ) {
		$image_id = isset( $example[ $key ] ) ? absint( $example[ $key ] ) : 0;
		if ( ! $image_id ) {
			continue;
		}

		$large = wp_get_attachment_image_url( $image_id, 'large' );
		$thumb = wp_get_attachment_image_url( $image_id, 'medium' );
		if ( $large ) {
			$images[] = array(
				'large' => $large,
				'thumb' => $thumb ? $thumb : $large,
			);
		}
	}

	return $images ? $images : $fallback_gallery;
}

function dicey_product_menu_examples_for_display( $post_id, $meta = null ) {
	$meta             = null === $meta ? dicey_get_product_meta( $post_id ) : $meta;
	$fallback_gallery = dicey_product_gallery_items( $post_id );
	$examples         = dicey_sanitize_product_menu_examples( isset( $meta['menu_examples'] ) ? $meta['menu_examples'] : array() );
	$fallback         = array(
		'title'          => get_the_title( $post_id ),
		'price'          => '',
		'composition'    => isset( $meta['composition_text'] ) ? $meta['composition_text'] : '',
		'kbju'           => function_exists( 'dicey_product_kbju_values_text' ) ? dicey_product_kbju_values_text( $meta ) : '',
		'minerals'       => '',
		'portion_weight' => '',
		'images'         => $fallback_gallery,
	);

	$prepared = array();
	for ( $index = 0; $index < 5; $index++ ) {
		if ( isset( $examples[ $index ] ) ) {
			$example           = $examples[ $index ];
			$example['images'] = dicey_product_menu_example_images( $example, $fallback_gallery );
			$prepared[]        = wp_parse_args( $example, $fallback );
		} else {
			$prepared[] = $fallback;
		}
	}

	return $prepared;
}

function dicey_product_menu_price_number( $price ) {
	$price = dicey_normalize_product_price_value( $price );
	$price = str_replace( array( ' ', ',' ), array( '', '.' ), $price );

	return is_numeric( $price ) ? (float) $price : null;
}

function dicey_product_menu_selection_for_period( $selection, $period, $candidate_count = 5 ) {
	$required = min( $candidate_count, max( 1, dicey_product_menu_limit_for_period( $period ) ) );
	$raw      = is_array( $selection ) ? $selection : preg_split( '/\s*,\s*/', (string) $selection, -1, PREG_SPLIT_NO_EMPTY );
	$clean    = array();

	foreach ( $raw as $candidate ) {
		$candidate = absint( $candidate );
		if ( $candidate < $candidate_count && ! in_array( $candidate, $clean, true ) ) {
			$clean[] = $candidate;
		}
	}

	for ( $candidate = 0; count( $clean ) < $required && $candidate < $candidate_count; $candidate++ ) {
		if ( ! in_array( $candidate, $clean, true ) ) {
			$clean[] = $candidate;
		}
	}

	return array_slice( $clean, 0, $required );
}

function dicey_product_menu_price_details( $post_id, $selection, $period ) {
	$meta      = dicey_get_product_meta( $post_id );
	$examples  = dicey_sanitize_product_menu_examples( isset( $meta['menu_examples'] ) ? $meta['menu_examples'] : array() );
	$selection = dicey_product_menu_selection_for_period( $selection, $period, 5 );
	$total     = 0.0;
	$titles    = array();
	$priced    = true;

	foreach ( $selection as $candidate ) {
		$example  = isset( $examples[ $candidate ] ) ? $examples[ $candidate ] : array();
		$price    = dicey_product_menu_price_number( isset( $example['price'] ) ? $example['price'] : '' );
		$titles[] = isset( $example['title'] ) && '' !== trim( $example['title'] ) ? $example['title'] : sprintf( 'Рацион %d', $candidate + 1 );

		if ( null === $price ) {
			$priced = false;
			continue;
		}

		$total += $price;
	}

	$days       = dicey_product_period_day_count( $period );
	$multiplier = $days >= 28 ? max( 1, (int) ceil( $days / 5 ) ) : 1;

	return array(
		'selection'  => $selection,
		'titles'     => $titles,
		'multiplier' => $multiplier,
		'total'      => $priced ? $total * $multiplier : null,
	);
}

function dicey_product_title_for_card( $post_id ) {
	return get_the_title( $post_id );
}

function dicey_product_price_for_card( $post_id, $meta = null ) {
	$meta = null === $meta ? dicey_get_product_meta( $post_id ) : $meta;

	if ( '' !== trim( $meta['price'] ) ) {
		return dicey_product_price_with_currency( $meta['price'] );
	}

	if ( function_exists( 'wc_get_product' ) ) {
		$product = wc_get_product( $post_id );
		if ( $product ) {
			$price_html = html_entity_decode( wp_strip_all_tags( $product->get_price_html() ), ENT_QUOTES, get_bloginfo( 'charset' ) );
			$price_html = trim( preg_replace( '/\s+/u', ' ', $price_html ) );
			if ( '' !== trim( $price_html ) ) {
				return $price_html;
			}
		}
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

function dicey_product_add_to_cart_redirect( $url ) {
	$action = isset( $_REQUEST['dicey_product_action'] ) ? sanitize_key( wp_unslash( $_REQUEST['dicey_product_action'] ) ) : '';

	if ( 'checkout' === $action && function_exists( 'wc_get_checkout_url' ) ) {
		return wc_get_checkout_url();
	}

	return $url;
}

add_filter( 'woocommerce_add_to_cart_redirect', 'dicey_product_add_to_cart_redirect' );

function dicey_product_add_period_to_cart_item( $cart_item_data, $product_id, $variation_id ) {
	if ( empty( $_POST['dicey_product_period'] ) ) {
		return $cart_item_data;
	}

	$period = sanitize_text_field( wp_unslash( $_POST['dicey_product_period'] ) );
	$meta   = dicey_get_product_meta( $product_id );
	if ( $variation_id ) {
		$options = dicey_get_wc_product_period_options( $product_id );
		$matched = null;
		foreach ( $options as $option ) {
			if ( absint( $option['variation_id'] ) === absint( $variation_id ) ) {
				$matched = $option;
				break;
			}
		}

		if ( ! $matched || $period !== $matched['label'] ) {
			return $cart_item_data;
		}
	} else {
		$allowed = dicey_product_lines( isset( $meta['terms'] ) ? $meta['terms'] : array() );
		if ( ! in_array( $period, $allowed, true ) ) {
			return $cart_item_data;
		}
	}

	$raw_selection = isset( $_POST['dicey_product_menu_selection'] ) ? sanitize_text_field( wp_unslash( $_POST['dicey_product_menu_selection'] ) ) : '';
	$details       = dicey_product_menu_price_details( $product_id, $raw_selection, $period );

	$cart_item_data['dicey_period']         = $period;
	$cart_item_data['dicey_menu_selection'] = $details['selection'];
	$cart_item_data['dicey_menu_titles']    = $details['titles'];
	if ( null !== $details['total'] ) {
		$cart_item_data['dicey_menu_total'] = $details['total'];
	}

	return $cart_item_data;
}

add_filter( 'woocommerce_add_cart_item_data', 'dicey_product_add_period_to_cart_item', 10, 3 );

function dicey_product_apply_menu_price_to_cart( $cart ) {
	if ( is_admin() && ! defined( 'DOING_AJAX' ) ) {
		return;
	}

	foreach ( $cart->get_cart() as $cart_item_key => $cart_item ) {
		if ( empty( $cart_item['data'] ) || empty( $cart_item['product_id'] ) || empty( $cart_item['dicey_period'] ) || ! isset( $cart_item['dicey_menu_selection'] ) ) {
			continue;
		}

		$details = dicey_product_menu_price_details( absint( $cart_item['product_id'] ), $cart_item['dicey_menu_selection'], $cart_item['dicey_period'] );
		$cart->cart_contents[ $cart_item_key ]['dicey_menu_selection'] = $details['selection'];
		$cart->cart_contents[ $cart_item_key ]['dicey_menu_titles']    = $details['titles'];

		if ( null === $details['total'] ) {
			unset( $cart->cart_contents[ $cart_item_key ]['dicey_menu_total'] );
			continue;
		}

		$cart->cart_contents[ $cart_item_key ]['dicey_menu_total'] = $details['total'];
		$cart_item['data']->set_price( (float) $details['total'] );
	}
}

add_action( 'woocommerce_before_calculate_totals', 'dicey_product_apply_menu_price_to_cart' );

function dicey_render_product_card( $post_id ) {
	$meta        = dicey_get_product_meta( $post_id );
	$tags        = dicey_product_card_tags( $post_id );
	$age_groups  = dicey_product_lines( $meta['match_age_groups'] );
	$breeds      = dicey_product_lines( $meta['match_breeds'] );
	$weight_min  = '' !== trim( $meta['match_weight_min'] ) ? (float) str_replace( ',', '.', $meta['match_weight_min'] ) : '';
	$weight_max  = '' !== trim( $meta['match_weight_max'] ) ? (float) str_replace( ',', '.', $meta['match_weight_max'] ) : '';
	$calories    = dicey_product_card_calories_text( $meta );
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
				<?php if ( '' !== trim( $calories ) ) : ?><p class="popularity__calories"><?php echo esc_html( $calories ); ?></p><?php endif; ?>
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

function dicey_add_product_meta_box() {
	if ( function_exists( 'carbon_get_post_meta' ) && 'product' === dicey_product_post_type() ) {
		return;
	}

	add_meta_box( 'dicey-product-data', 'Карточка товара', 'dicey_render_product_meta_box', dicey_product_post_type(), 'normal', 'high' );
	add_meta_box( 'dicey-product-home', 'Главная', 'dicey_render_product_home_meta_box', dicey_product_post_type(), 'side', 'low' );
	add_meta_box( 'dicey-product-matching', 'Подбор рациона', 'dicey_render_product_matching_meta_box', dicey_product_post_type(), 'side', 'default' );
}

add_action( 'add_meta_boxes', 'dicey_add_product_meta_box' );

function dicey_render_product_meta_box( $post ) {
	$meta          = dicey_get_product_meta( $post->ID );
	$kbju          = dicey_product_card_kbju_values( $meta );
	$menu_examples = dicey_sanitize_product_menu_examples( $meta['menu_examples'] );
	$selected_terms = dicey_product_lines( $meta['terms'] );
	while ( count( $menu_examples ) < 5 ) {
		$menu_examples[] = array();
	}
	wp_nonce_field( 'dicey_product_meta', 'dicey_product_meta_nonce' );
	?>
	<style>
		.dicey-product-grid{display:grid;grid-template-columns:1fr 1fr;gap:16px 20px}.dicey-product-field label{display:block;font-weight:600;margin-bottom:6px}.dicey-product-field input[type=text],.dicey-product-field textarea{width:100%}.dicey-product-field textarea{min-height:86px}.dicey-product-wide{grid-column:1/-1}.dicey-product-note{color:#646970;font-size:12px;margin:4px 0 0}.dicey-product-kbju{display:grid;grid-template-columns:repeat(4,minmax(72px,1fr));gap:10px}.dicey-product-kbju label{font-weight:600}
	</style>
	<div class="dicey-product-grid">
		<div class="dicey-product-field"><label>Цена</label><input type="text" name="dicey_product[price]" value="<?php echo esc_attr( dicey_normalize_product_price_value( $meta['price'] ) ); ?>"><p class="dicey-product-note">Например: 5 000. Знак ₽ добавится на сайте автоматически.</p></div>
		<div class="dicey-product-field"><label>КБЖУ для карточки</label><div class="dicey-product-kbju">
			<label>К <input type="text" name="dicey_product[calories_k]" value="<?php echo esc_attr( $kbju['k'] ); ?>"></label>
			<label>Б <input type="text" name="dicey_product[calories_b]" value="<?php echo esc_attr( $kbju['b'] ); ?>"></label>
			<label>Ж <input type="text" name="dicey_product[calories_f]" value="<?php echo esc_attr( $kbju['f'] ); ?>"></label>
			<label>У <input type="text" name="dicey_product[calories_c]" value="<?php echo esc_attr( $kbju['c'] ); ?>"></label>
		</div><p class="dicey-product-note">На сайте текст КБЖУ и буквы добавятся автоматически.</p></div>
		<div class="dicey-product-field">
			<label>Сроки</label>
			<?php foreach ( dicey_product_term_options() as $term_value => $term_label ) : ?>
				<label><input type="checkbox" name="dicey_product[terms][]" value="<?php echo esc_attr( $term_value ); ?>" <?php checked( in_array( $term_value, $selected_terms, true ) ); ?>> <?php echo esc_html( $term_label ); ?></label>
			<?php endforeach; ?>
		</div>
		<div class="dicey-product-field"><label>Состав</label><textarea name="dicey_product[composition_text]"><?php echo esc_textarea( $meta['composition_text'] ); ?></textarea></div>
		<div class="dicey-product-field dicey-product-wide"><label>Как кормить?</label><textarea name="dicey_product[feeding_answer]"><?php echo esc_textarea( $meta['feeding_answer'] ); ?></textarea></div>
		<div class="dicey-product-field dicey-product-wide"><label>Как хранить?</label><textarea name="dicey_product[storage_answer]"><?php echo esc_textarea( $meta['storage_answer'] ); ?></textarea></div>
		<div class="dicey-product-field dicey-product-wide"><label>Доставка</label><textarea name="dicey_product[delivery_answer]"><?php echo esc_textarea( $meta['delivery_answer'] ); ?></textarea></div>
		<div class="dicey-product-field dicey-product-wide"><h3>Примеры меню</h3><p class="dicey-product-note">Заполните пять вариантов и цену каждого. Для 3 дней покупатель выбирает любые три из пяти; итог считается как сумма выбранных вариантов. Для месяца сумма пяти вариантов умножается на шесть.</p></div>
		<?php foreach ( $menu_examples as $index => $example ) : ?>
			<div class="dicey-product-field dicey-product-wide"><strong>День <?php echo esc_html( $index + 1 ); ?></strong></div>
			<div class="dicey-product-field"><label>Название блюда</label><input type="text" name="dicey_product[menu_examples][<?php echo esc_attr( $index ); ?>][title]" value="<?php echo esc_attr( isset( $example['title'] ) ? $example['title'] : '' ); ?>"></div>
			<div class="dicey-product-field"><label>Стоимость одного дня</label><input type="text" name="dicey_product[menu_examples][<?php echo esc_attr( $index ); ?>][price]" value="<?php echo esc_attr( isset( $example['price'] ) ? $example['price'] : '' ); ?>"><p class="dicey-product-note">Например: 600. Знак ₽ добавится автоматически.</p></div>
			<div class="dicey-product-field"><label>Вес порции</label><input type="text" name="dicey_product[menu_examples][<?php echo esc_attr( $index ); ?>][portion_weight]" value="<?php echo esc_attr( isset( $example['portion_weight'] ) ? $example['portion_weight'] : '' ); ?>"></div>
			<div class="dicey-product-field"><label>Состав</label><textarea name="dicey_product[menu_examples][<?php echo esc_attr( $index ); ?>][composition]"><?php echo esc_textarea( isset( $example['composition'] ) ? $example['composition'] : '' ); ?></textarea></div>
			<div class="dicey-product-field"><label>КБЖУ</label><textarea name="dicey_product[menu_examples][<?php echo esc_attr( $index ); ?>][kbju]"><?php echo esc_textarea( isset( $example['kbju'] ) ? $example['kbju'] : '' ); ?></textarea></div>
			<div class="dicey-product-field dicey-product-wide"><label>Витамины и минеральные вещества</label><textarea name="dicey_product[menu_examples][<?php echo esc_attr( $index ); ?>][minerals]"><?php echo esc_textarea( isset( $example['minerals'] ) ? $example['minerals'] : '' ); ?></textarea></div>
			<?php foreach ( array( 'image_main' => 'Основное изображение', 'image_second' => 'Дополнительное изображение 1', 'image_third' => 'Дополнительное изображение 2' ) as $image_key => $image_label ) : ?>
				<div class="dicey-product-field"><label><?php echo esc_html( $image_label ); ?> (ID)</label><input type="text" name="dicey_product[menu_examples][<?php echo esc_attr( $index ); ?>][<?php echo esc_attr( $image_key ); ?>]" value="<?php echo esc_attr( isset( $example[ $image_key ] ) ? $example[ $image_key ] : '' ); ?>"></div>
			<?php endforeach; ?>
		<?php endforeach; ?>
	</div>
	<?php
}

function dicey_render_product_matching_meta_box( $post ) {
	$meta                = dicey_get_product_meta( $post->ID );
	$selected_age_groups = dicey_product_lines( $meta['match_age_groups'] );
	$selected_breeds     = dicey_product_lines( $meta['match_breeds'] );
	?>
	<style>
		.dicey-product-side-field{margin:0 0 12px}.dicey-product-side-field label{display:block;margin:0 0 6px;font-weight:600}.dicey-product-side-field input[type=text]{width:100%}.dicey-product-side-choice{font-weight:400!important}.dicey-product-side-note{color:#646970;font-size:12px;margin:4px 0 0}
	</style>
	<p class="dicey-product-side-field">
		<label><input type="checkbox" name="dicey_product[is_vip]" value="1" <?php checked( $meta['is_vip'], '1' ); ?>> ВИП-рацион</label>
	</p>
	<div class="dicey-product-side-field">
		<label>Возраст собаки</label>
		<label><input type="checkbox" name="dicey_product[match_age_groups][]" value="adult" <?php checked( in_array( 'adult', $selected_age_groups, true ) ); ?>> 1-10 лет</label>
		<label><input type="checkbox" name="dicey_product[match_age_groups][]" value="senior" <?php checked( in_array( 'senior', $selected_age_groups, true ) ); ?>> &gt; 10 лет</label>
		<p class="dicey-product-side-note">Если ничего не выбрано, рацион считается подходящим для любого возраста.</p>
	</div>
	<div class="dicey-product-side-field">
		<label>Вес от, кг</label>
		<input type="text" name="dicey_product[match_weight_min]" value="<?php echo esc_attr( $meta['match_weight_min'] ); ?>">
		<p class="dicey-product-side-note">Например: 2.5</p>
	</div>
	<div class="dicey-product-side-field">
		<label>Вес до, кг</label>
		<input type="text" name="dicey_product[match_weight_max]" value="<?php echo esc_attr( $meta['match_weight_max'] ); ?>">
		<p class="dicey-product-side-note">Если пусто, верхняя граница не ограничена.</p>
	</div>
	<div class="dicey-product-side-field">
		<label>Породы для подбора</label>
		<?php foreach ( dicey_product_breed_options() as $breed_value => $breed_label ) : ?>
			<label class="dicey-product-side-choice"><input type="checkbox" name="dicey_product[match_breeds][]" value="<?php echo esc_attr( $breed_value ); ?>" <?php checked( in_array( $breed_value, $selected_breeds, true ) ); ?>> <?php echo esc_html( $breed_label ); ?></label>
		<?php endforeach; ?>
		<p class="dicey-product-side-note">Если ничего не выбрано, рацион подходит для любой породы.</p>
	</div>
	<?php
}

function dicey_render_product_home_meta_box( $post ) {
	$meta = dicey_get_product_meta( $post->ID );
	?>
	<p>
		<label>
			<input type="checkbox" name="dicey_product[show_on_home]" value="1" <?php checked( $meta['show_on_home'], '1' ); ?>>
			Показывать на главной
		</label>
	</p>
	<p class="description">На главную выводится максимум 4 товара.</p>
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
		} elseif ( 'match_breeds' === $key ) {
			$allowed = array_keys( dicey_product_breed_options() );
			$value   = is_array( $value ) ? implode( "\n", array_values( array_intersect( array_map( 'sanitize_text_field', $value ), $allowed ) ) ) : sanitize_textarea_field( $value );
		} elseif ( 'terms' === $key ) {
			$allowed = array_keys( dicey_product_term_options() );
			$value   = is_array( $value ) ? implode( "\n", array_values( array_intersect( array_map( 'sanitize_text_field', $value ), $allowed ) ) ) : sanitize_textarea_field( $value );
		} elseif ( 'price' === $key ) {
			$value = is_array( $value ) ? '' : dicey_normalize_product_price_value( $value );
		} elseif ( in_array( $key, array( 'calories_k', 'calories_b', 'calories_f', 'calories_c' ), true ) ) {
			$value = is_array( $value ) ? '' : dicey_normalize_kbju_value( $value );
		} elseif ( 'menu_examples' === $key ) {
			$value = dicey_sanitize_product_menu_examples( $value );
		} else {
			$value = is_array( $value ) ? '' : wp_kses_post( $value );
		}
		update_post_meta( $post_id, '_dicey_product_' . $key, $value );
	}
}

add_action( 'save_post_dicey_product', 'dicey_save_product_meta' );
add_action( 'save_post_product', 'dicey_save_product_meta' );

function dicey_normalize_product_price_meta( $post_id ) {
	if ( ! in_array( get_post_type( $post_id ), array( 'product', 'dicey_product' ), true ) ) {
		return;
	}

	$value       = get_post_meta( $post_id, '_dicey_product_price', true );
	$normalized = dicey_normalize_product_price_value( $value );

	if ( $value !== $normalized ) {
		update_post_meta( $post_id, '_dicey_product_price', $normalized );
	}

	foreach ( array( 'calories_k', 'calories_b', 'calories_f', 'calories_c' ) as $key ) {
		$meta_key   = '_dicey_product_' . $key;
		$value      = get_post_meta( $post_id, $meta_key, true );
		$normalized = dicey_normalize_kbju_value( $value );

		if ( $value !== $normalized ) {
			update_post_meta( $post_id, $meta_key, $normalized );
		}
	}
}

add_action( 'carbon_fields_post_meta_container_saved', 'dicey_normalize_product_price_meta' );

function dicey_products_import_demo() {
	if ( get_option( 'dicey_products_demo_imported' ) || dicey_has_products() ) {
		return;
	}

	$post_type = dicey_product_post_type();

	$products = array(
		array( 'title' => 'С кроликом и крупой, для собак весом 3 кг', 'price' => '5 000', 'calories_k' => '450', 'calories_b' => '52', 'calories_f' => '6', 'calories_c' => '38', 'card_image' => 'imgs/bg/popularity__img.png', 'tags' => 'Мальтипу', 'home' => '1' ),
		array( 'title' => 'С курицей и крупой, для собак с весом 7 кг', 'price' => '5 000', 'calories_k' => '450', 'calories_b' => '52', 'calories_f' => '6', 'calories_c' => '38', 'card_image' => 'imgs/bg/popularity__img2.png', 'tags' => 'Мопс', 'home' => '1' ),
		array( 'title' => 'С рыбой, овощами и крупой, для собак с весом 10 кг', 'price' => '7 000', 'calories_k' => '450', 'calories_b' => '52', 'calories_f' => '6', 'calories_c' => '38', 'card_image' => 'imgs/bg/popularity__img3.png', 'tags' => 'Вельш корги', 'vip' => '1', 'home' => '1' ),
		array( 'title' => 'С говядиной и крупой, для собак с весом 12 кг', 'price' => '5 000', 'calories_k' => '450', 'calories_b' => '52', 'calories_f' => '6', 'calories_c' => '38', 'card_image' => 'imgs/bg/popularity__img4.png', 'tags' => 'Бордер колли', 'home' => '1' ),
	);

	foreach ( $products as $index => $product ) {
		$post_id = wp_insert_post(
			array(
				'post_type'    => $post_type,
				'post_status'  => 'publish',
				'post_title'   => $product['title'],
				'post_excerpt' => dicey_product_card_calories_text( $product ),
				'menu_order'   => $index,
			)
		);

		if ( ! $post_id || is_wp_error( $post_id ) ) {
			continue;
		}

		update_post_meta( $post_id, '_dicey_product_price', $product['price'] );
		update_post_meta( $post_id, '_dicey_product_calories_k', $product['calories_k'] );
		update_post_meta( $post_id, '_dicey_product_calories_b', $product['calories_b'] );
		update_post_meta( $post_id, '_dicey_product_calories_f', $product['calories_f'] );
		update_post_meta( $post_id, '_dicey_product_calories_c', $product['calories_c'] );
		update_post_meta( $post_id, '_dicey_product_card_image', $product['card_image'] );
		if ( taxonomy_exists( 'product_tag' ) ) {
			wp_set_object_terms( $post_id, dicey_product_lines( $product['tags'] ), 'product_tag', false );
		} else {
			update_post_meta( $post_id, '_dicey_product_tags', $product['tags'] );
		}
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
