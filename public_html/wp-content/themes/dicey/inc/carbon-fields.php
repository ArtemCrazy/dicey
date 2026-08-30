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

	\Carbon_Fields\Container::make( 'post_meta', 'Данные карточки' )
		->where( 'post_type', '=', 'product' )
		->add_fields(
			array(
				\Carbon_Fields\Field::make( 'text', 'dicey_product_price', 'Цена' )
					->set_help_text( 'Например: 5 000. Знак ₽ добавится на сайте автоматически.' ),
				\Carbon_Fields\Field::make( 'separator', 'dicey_product_card_kbju_separator', 'КБЖУ для карточки' ),
				\Carbon_Fields\Field::make( 'text', 'dicey_product_calories_k', 'К' ),
				\Carbon_Fields\Field::make( 'text', 'dicey_product_calories_b', 'Б' ),
				\Carbon_Fields\Field::make( 'text', 'dicey_product_calories_f', 'Ж' ),
				\Carbon_Fields\Field::make( 'text', 'dicey_product_calories_c', 'У' ),
				\Carbon_Fields\Field::make( 'set', 'dicey_product_terms', 'Сроки' )
					->add_options( function_exists( 'dicey_product_term_options' ) ? dicey_product_term_options() : array() ),
				\Carbon_Fields\Field::make( 'textarea', 'dicey_product_composition_text', 'Состав' )
					->set_rows( 5 ),
				\Carbon_Fields\Field::make( 'separator', 'dicey_product_questions_separator', 'Вопросы в карточке' ),
				\Carbon_Fields\Field::make( 'textarea', 'dicey_product_feeding_answer', 'Как кормить?' )
					->set_rows( 4 ),
				\Carbon_Fields\Field::make( 'textarea', 'dicey_product_storage_answer', 'Как хранить?' )
					->set_rows( 4 ),
				\Carbon_Fields\Field::make( 'textarea', 'dicey_product_delivery_answer', 'Доставка' )
					->set_rows( 4 ),
				\Carbon_Fields\Field::make( 'separator', 'dicey_product_menu_separator', 'Примеры меню' ),
				\Carbon_Fields\Field::make( 'complex', 'dicey_product_menu_examples', 'Дни меню' )
					->set_help_text( 'Добавьте до пяти примеров. Для срока 3 дня выводятся первые три, для 5 дней и месяца — все пять.' )
					->set_max( 5 )
					->add_fields(
						array(
							\Carbon_Fields\Field::make( 'text', 'title', 'Название блюда' ),
							\Carbon_Fields\Field::make( 'textarea', 'composition', 'Состав' )->set_rows( 4 ),
							\Carbon_Fields\Field::make( 'textarea', 'kbju', 'КБЖУ' )->set_rows( 4 ),
							\Carbon_Fields\Field::make( 'textarea', 'minerals', 'Витамины и минеральные вещества' )->set_rows( 3 ),
							\Carbon_Fields\Field::make( 'text', 'portion_weight', 'Вес порции' ),
							\Carbon_Fields\Field::make( 'image', 'image_main', 'Основное изображение' )->set_value_type( 'id' ),
							\Carbon_Fields\Field::make( 'image', 'image_second', 'Дополнительное изображение 1' )->set_value_type( 'id' ),
							\Carbon_Fields\Field::make( 'image', 'image_third', 'Дополнительное изображение 2' )->set_value_type( 'id' ),
						)
					),
			)
		);

	\Carbon_Fields\Container::make( 'post_meta', 'Подбор рациона' )
		->where( 'post_type', '=', 'product' )
		->set_context( 'side' )
		->set_priority( 'default' )
		->add_fields(
			array(
				\Carbon_Fields\Field::make( 'checkbox', 'dicey_product_is_vip', 'ВИП-рацион' )
					->set_option_value( '1' ),
				\Carbon_Fields\Field::make( 'set', 'dicey_product_match_age_groups', 'Возраст собаки' )
					->set_help_text( 'Если ничего не выбрано, рацион считается подходящим для любого возраста.' )
					->add_options(
						array(
							'adult'  => '1-10 лет',
							'senior' => '> 10 лет',
						)
					),
				\Carbon_Fields\Field::make( 'text', 'dicey_product_match_weight_min', 'Вес от, кг' )
					->set_help_text( 'Можно указать дробное значение через точку или запятую, например 2.5.' )
					->set_attribute( 'type', 'number' )
					->set_attribute( 'step', '0.5' )
					->set_attribute( 'min', '0' ),
				\Carbon_Fields\Field::make( 'text', 'dicey_product_match_weight_max', 'Вес до, кг' )
					->set_help_text( 'Если пусто, верхняя граница не ограничена.' )
					->set_attribute( 'type', 'number' )
					->set_attribute( 'step', '0.5' )
					->set_attribute( 'min', '0' ),
				\Carbon_Fields\Field::make( 'set', 'dicey_product_match_breeds', 'Породы для подбора' )
					->set_help_text( 'Если ничего не выбрано, рацион подходит для любой породы.' )
					->add_options( function_exists( 'dicey_product_breed_options' ) ? dicey_product_breed_options() : array() ),
			)
		);

	\Carbon_Fields\Container::make( 'post_meta', 'Главная' )
		->where( 'post_type', '=', 'product' )
		->set_context( 'side' )
		->set_priority( 'low' )
		->add_fields(
			array(
				\Carbon_Fields\Field::make( 'checkbox', 'dicey_product_show_on_home', 'Показывать на главной' )
					->set_option_value( '1' )
					->set_help_text( 'На главную выводится максимум 4 товара.' ),
			)
		);
}

function dicey_register_carbon_global_fields() {
	if ( ! class_exists( '\Carbon_Fields\Container' ) || ! class_exists( '\Carbon_Fields\Field' ) ) {
		return;
	}

	\Carbon_Fields\Container::make( 'theme_options', 'Консультации' )
		->add_fields(
			array(
				\Carbon_Fields\Field::make( 'html', 'dicey_consultation_note' )
					->set_html( '<p>Ссылка отправляется пользователю по email после оплаты консультации.</p>' ),
				\Carbon_Fields\Field::make( 'text', 'dicey_consultation_form_url', 'Ссылка на Яндекс.Форму' )
					->set_attribute( 'type', 'url' ),
			)
		);

	\Carbon_Fields\Container::make( 'theme_options', 'Доставка и адреса' )
		->add_fields(
			array(
				\Carbon_Fields\Field::make( 'html', 'dicey_delivery_keys_note' )
					->set_html( '<p>Эти ключи используются на фронте для подсказок адреса и карты. В кабинетах DaData и Яндекс.Карт ограничьте их доменом сайта.</p>' ),
				\Carbon_Fields\Field::make( 'text', 'dicey_dadata_token', 'API-ключ DaData для подсказок адреса' )
					->set_help_text( 'Нужен публичный токен Suggestions API.' ),
				\Carbon_Fields\Field::make( 'text', 'dicey_yandex_maps_api_key', 'API-ключ Яндекс.Карт' )
					->set_help_text( 'Нужен браузерный ключ JavaScript API.' ),
				\Carbon_Fields\Field::make( 'textarea', 'dicey_delivery_free_message', 'Сообщение: бесплатная зона' )
					->set_rows( 2 )
					->set_default_value( 'Бесплатная доставка по вашему адресу' ),
				\Carbon_Fields\Field::make( 'textarea', 'dicey_delivery_paid_message', 'Сообщение: дополнительная зона' )
					->set_rows( 2 )
					->set_default_value( 'Адрес входит в дополнительную зону доставки. Условия нужно уточнить у менеджера.' ),
				\Carbon_Fields\Field::make( 'textarea', 'dicey_delivery_outside_message', 'Сообщение: вне зоны доставки' )
					->set_rows( 3 )
					->set_default_value( 'Адрес не входит в зону доставки. Оставьте заявку, и мы уточним возможные варианты.' ),
				\Carbon_Fields\Field::make( 'textarea', 'dicey_delivery_dadata_missing_notice', 'Сообщение: нет ключа DaData' )
					->set_rows( 2 )
					->set_default_value( 'Для проверки адреса нужно добавить API-ключ DaData в админке.' ),
				\Carbon_Fields\Field::make( 'textarea', 'dicey_delivery_maps_missing_notice', 'Сообщение: нет ключа Яндекс.Карт' )
					->set_rows( 2 )
					->set_default_value( 'Для отображения карты нужно добавить API-ключ Яндекс.Карт в админке.' ),
			)
		);

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

add_action( 'carbon_fields_register_fields', 'dicey_register_carbon_product_fields' );
add_action( 'carbon_fields_register_fields', 'dicey_register_carbon_global_fields' );
