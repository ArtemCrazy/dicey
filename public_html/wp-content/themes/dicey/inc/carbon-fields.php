<?php
/**
 * Carbon Fields integration.
 *
 * @package Dicey
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function dicey_register_carbon_product_fields() {
	if ( ! class_exists( '\Carbon_Fields\Container' ) || ! class_exists( '\Carbon_Fields\Field' ) ) {
		return;
	}

	\Carbon_Fields\Container::make( 'post_meta', 'Данные карточки Дайси' )
		->where( 'post_type', '=', 'product' )
		->add_fields(
			array(
				\Carbon_Fields\Field::make( 'text', 'dicey_product_card_title', 'Название в карточке' )
					->set_help_text( 'Если пусто, берется заголовок товара.' ),
				\Carbon_Fields\Field::make( 'text', 'dicey_product_price', 'Цена' ),
				\Carbon_Fields\Field::make( 'text', 'dicey_product_calories', 'КБЖУ для карточки' ),
				\Carbon_Fields\Field::make( 'image', 'dicey_product_card_image', 'Изображение карточки' )
					->set_value_type( 'id' ),
				\Carbon_Fields\Field::make( 'checkbox', 'dicey_product_show_on_home', 'Показывать на главной' )
					->set_option_value( '1' )
					->set_help_text( 'На главную выводится максимум 4 товара.' ),
				\Carbon_Fields\Field::make( 'checkbox', 'dicey_product_is_vip', 'ВИП-рацион' )
					->set_option_value( '1' ),
				\Carbon_Fields\Field::make( 'textarea', 'dicey_product_tags', 'Теги карточки' )
					->set_help_text( 'Каждый тег с новой строки.' )
					->set_rows( 4 ),
				\Carbon_Fields\Field::make( 'textarea', 'dicey_product_terms', 'Сроки' )
					->set_help_text( 'Каждый срок с новой строки.' )
					->set_rows( 5 ),
				\Carbon_Fields\Field::make( 'textarea', 'dicey_product_gallery', 'Галерея' )
					->set_help_text( 'Каждый URL/путь или ID изображения с новой строки.' )
					->set_rows( 5 ),
				\Carbon_Fields\Field::make( 'textarea', 'dicey_product_gallery_thumbs', 'Миниатюры галереи' )
					->set_help_text( 'Каждый URL/путь или ID изображения с новой строки.' )
					->set_rows( 5 ),
				\Carbon_Fields\Field::make( 'text', 'dicey_product_composition_title', 'Заголовок состава' ),
				\Carbon_Fields\Field::make( 'textarea', 'dicey_product_composition_text', 'Состав' )
					->set_rows( 5 ),
				\Carbon_Fields\Field::make( 'text', 'dicey_product_desc_title', 'Заголовок описания' ),
				\Carbon_Fields\Field::make( 'textarea', 'dicey_product_desc_text', 'Описание рациона' )
					->set_rows( 8 ),
				\Carbon_Fields\Field::make( 'text', 'dicey_product_kbju_title', 'Заголовок КБЖУ' ),
				\Carbon_Fields\Field::make( 'textarea', 'dicey_product_kbju_text', 'КБЖУ' )
					->set_rows( 4 ),
				\Carbon_Fields\Field::make( 'textarea', 'dicey_product_faq', 'FAQ' )
					->set_help_text( 'Формат: вопрос|ответ, каждый пункт с новой строки.' )
					->set_rows( 6 ),
			)
		);
}

add_action( 'carbon_fields_register_fields', 'dicey_register_carbon_product_fields' );
