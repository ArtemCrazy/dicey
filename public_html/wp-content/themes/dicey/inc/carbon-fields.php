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

function dicey_register_carbon_global_fields() {
	if ( ! class_exists( '\Carbon_Fields\Container' ) || ! class_exists( '\Carbon_Fields\Field' ) ) {
		return;
	}

	\Carbon_Fields\Container::make( 'theme_options', 'Остались вопросы' )
		->add_fields(
			array(
				\Carbon_Fields\Field::make( 'html', 'dicey_why_note' )
					->set_html( '<p>Глобальный блок: изменения применяются на всех страницах, где он выведен.</p>' ),
				\Carbon_Fields\Field::make( 'textarea', 'dicey_why_title', 'Заголовок' )
					->set_rows( 3 ),
				\Carbon_Fields\Field::make( 'textarea', 'dicey_why_text', 'Текст' )
					->set_rows( 3 ),
				\Carbon_Fields\Field::make( 'text', 'dicey_why_button_label', 'Кнопка' ),
				\Carbon_Fields\Field::make( 'image', 'dicey_why_image', 'Изображение' )
					->set_value_type( 'url' ),
				\Carbon_Fields\Field::make( 'image', 'dicey_why_image_mobile', 'Изображение на мобильной версии' )
					->set_value_type( 'url' ),
			)
		);
}

function dicey_get_page_id_by_slug( $slug ) {
	$page = get_page_by_path( $slug, OBJECT, 'page' );

	return $page ? (int) $page->ID : 0;
}

function dicey_register_carbon_contacts_fields() {
	if ( ! class_exists( '\Carbon_Fields\Container' ) || ! class_exists( '\Carbon_Fields\Field' ) ) {
		return;
	}

	$page_id = dicey_get_page_id_by_slug( 'contacts' );
	if ( ! $page_id ) {
		return;
	}

	\Carbon_Fields\Container::make( 'post_meta', 'Контакты' )
		->where( 'post_id', '=', $page_id )
		->add_tab(
			'Главный экран',
			array(
				\Carbon_Fields\Field::make( 'text', 'dicey_contacts_hero_title', 'Заголовок' ),
				\Carbon_Fields\Field::make( 'image', 'dicey_contacts_hero_image', 'Изображение' )
					->set_value_type( 'url' ),
			)
		)
		->add_tab(
			'По каким вопросам можно обратиться',
			array(
				\Carbon_Fields\Field::make( 'textarea', 'dicey_contacts_apply_title', 'Заголовок' )
					->set_rows( 3 ),
				\Carbon_Fields\Field::make( 'complex', 'dicey_contacts_apply_items', 'Пункты' )
					->set_layout( 'tabbed-horizontal' )
					->add_fields(
						array(
							\Carbon_Fields\Field::make( 'text', 'icon', 'Иконка' )
								->set_help_text( 'URL, ID изображения или путь в теме, например imgs/icons/apply__icon1.svg.' ),
							\Carbon_Fields\Field::make( 'text', 'text', 'Текст' ),
						)
					),
			)
		)
		->add_tab(
			'Контактные данные',
			array(
				\Carbon_Fields\Field::make( 'complex', 'dicey_contacts_contact_items', 'Контакты' )
					->set_layout( 'tabbed-horizontal' )
					->add_fields(
						array(
							\Carbon_Fields\Field::make( 'text', 'icon', 'Иконка' )
								->set_help_text( 'URL, ID изображения или путь в теме, например imgs/icons/contacts__icon1.svg.' ),
							\Carbon_Fields\Field::make( 'text', 'label', 'Текст ссылки' ),
							\Carbon_Fields\Field::make( 'text', 'url', 'URL' ),
						)
					),
				\Carbon_Fields\Field::make( 'textarea', 'dicey_contacts_company_info', 'Реквизиты' )
					->set_rows( 5 ),
			)
		);
}

add_action( 'carbon_fields_register_fields', 'dicey_register_carbon_product_fields' );
add_action( 'carbon_fields_register_fields', 'dicey_register_carbon_global_fields' );
add_action( 'carbon_fields_register_fields', 'dicey_register_carbon_contacts_fields' );
