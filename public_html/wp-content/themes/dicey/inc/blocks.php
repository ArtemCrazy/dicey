<?php
/**
 * Gutenberg blocks and patterns.
 *
 * @package Dicey
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_filter( 'block_categories_all', 'dicey_register_block_category', 10, 2 );
add_action( 'init', 'dicey_register_blocks' );
add_action( 'init', 'dicey_register_patterns' );

function dicey_register_block_category( $categories ) {
	array_unshift(
		$categories,
		array(
			'slug'  => 'dicey',
			'title' => __( 'Dicey', 'dicey' ),
			'icon'  => null,
		)
	);

	return $categories;
}

function dicey_register_blocks() {
	wp_register_script(
		'dicey-blocks-editor',
		DICEY_THEME_URI . '/blocks/index.js',
		array( 'wp-blocks', 'wp-element', 'wp-components', 'wp-i18n', 'wp-data', 'wp-block-editor' ),
		filemtime( DICEY_THEME_DIR . '/blocks/index.js' ),
		true
	);

	wp_localize_script(
		'dicey-blocks-editor',
		'diceyBlocks',
		array(
			'assetsUrl' => DICEY_ASSETS_URI,
		)
	);

	$blocks = array(
		'home-legacy' => array(
			'title'    => __( 'Домашняя страница', 'dicey' ),
			'template' => 'template-parts/pages/front-page',
		),
		'home-hero' => array(
			'title'    => __( 'Главный экран', 'dicey' ),
			'template' => 'template-parts/blocks/home-hero',
			'callback' => 'dicey_render_home_hero',
			'attributes' => array(
				'eyebrow' => array( 'type' => 'string' ),
				'title' => array( 'type' => 'string' ),
				'title_accent' => array( 'type' => 'string' ),
				'text' => array( 'type' => 'string' ),
				'button_label' => array( 'type' => 'string' ),
				'button_url' => array( 'type' => 'string' ),
			),
		),
		'home-conveniences' => array(
			'title'    => __( 'Почему это удобно для Вас', 'dicey' ),
			'template' => 'template-parts/blocks/home-conveniences',
			'callback' => 'dicey_render_home_conveniences',
			'attributes' => array(
				'title' => array( 'type' => 'string' ),
				'cards' => array(
					'type' => 'array',
					'default' => dicey_home_conveniences_defaults()['cards'],
				),
			),
		),
		'home-delivery' => array(
			'title'    => __( 'Регулярные доставки рациона', 'dicey' ),
			'template' => 'template-parts/blocks/home-delivery',
			'callback' => 'dicey_render_home_delivery',
			'attributes' => array(
				'title' => array( 'type' => 'string' ),
				'subtitle' => array( 'type' => 'string' ),
				'text_first' => array( 'type' => 'string' ),
				'text_second' => array( 'type' => 'string' ),
				'button_label' => array( 'type' => 'string' ),
				'button_url' => array( 'type' => 'string' ),
			),
		),
		'home-about-food' => array(
			'title'    => __( 'Что получает ваша собака', 'dicey' ),
			'template' => 'template-parts/blocks/home-about-food',
			'callback' => 'dicey_render_home_about_food',
			'attributes' => array(
				'title' => array( 'type' => 'string' ),
				'text' => array( 'type' => 'string' ),
				'link_label' => array( 'type' => 'string' ),
				'link_url' => array( 'type' => 'string' ),
				'items' => array(
					'type' => 'array',
					'default' => dicey_home_about_food_defaults()['items'],
				),
			),
		),
		'home-plan' => array(
			'title'    => __( 'Составим индивидуальный план питания', 'dicey' ),
			'template' => 'template-parts/blocks/home-plan',
			'callback' => 'dicey_render_home_plan',
			'attributes' => array(
				'person_name' => array( 'type' => 'string' ),
				'person_role' => array( 'type' => 'string' ),
				'title' => array( 'type' => 'string' ),
				'subtitle' => array( 'type' => 'string' ),
				'price' => array( 'type' => 'string' ),
				'text' => array( 'type' => 'string' ),
				'button_label' => array( 'type' => 'string' ),
			),
		),
		'home-works' => array(
			'title'    => __( 'Как это работает', 'dicey' ),
			'template' => 'template-parts/blocks/home-works',
			'callback' => 'dicey_render_home_works',
			'attributes' => array(
				'title' => array( 'type' => 'string' ),
				'subtitle' => array( 'type' => 'string' ),
				'link_label' => array( 'type' => 'string' ),
				'link_url' => array( 'type' => 'string' ),
				'steps' => array(
					'type' => 'array',
					'default' => dicey_home_works_defaults()['steps'],
				),
			),
		),
		'home-questions' => array(
			'title'    => __( 'Часто задаваемые вопросы', 'dicey' ),
			'template' => 'template-parts/blocks/home-questions',
			'callback' => 'dicey_render_home_questions',
			'attributes' => array(
				'title' => array( 'type' => 'string' ),
				'tabs' => array(
					'type' => 'array',
					'default' => dicey_home_questions_defaults()['tabs'],
				),
			),
		),
		'dietology' => array(
			'title'    => __( 'Диетология', 'dicey' ),
			'template' => 'template-parts/static/dietology',
			'callback' => 'dicey_render_dietology',
			'attributes' => array(
				'hero_title' => array( 'type' => 'string' ),
				'hero_accent' => array( 'type' => 'string' ),
				'hero_text' => array( 'type' => 'string' ),
				'hero_button_label' => array( 'type' => 'string' ),
				'hero_mobile_label' => array( 'type' => 'string' ),
				'consult_title' => array( 'type' => 'string' ),
				'consult_items' => array(
					'type' => 'array',
					'default' => dicey_dietology_defaults()['consult_items'],
				),
				'plan_person_name' => array( 'type' => 'string' ),
				'plan_person_role' => array( 'type' => 'string' ),
				'plan_person_image' => array( 'type' => 'string' ),
				'plan_title' => array( 'type' => 'string' ),
				'plan_subtitle' => array( 'type' => 'string' ),
				'plan_text' => array( 'type' => 'string' ),
				'plan_link_label' => array( 'type' => 'string' ),
				'plan_certificates' => array(
					'type' => 'array',
					'default' => dicey_dietology_defaults()['plan_certificates'],
				),
				'advisory_title' => array( 'type' => 'string' ),
				'advisory_steps' => array(
					'type' => 'array',
					'default' => dicey_dietology_defaults()['advisory_steps'],
				),
				'advantages_title' => array( 'type' => 'string' ),
				'advantages' => array(
					'type' => 'array',
					'default' => dicey_dietology_defaults()['advantages'],
				),
				'price_title' => array( 'type' => 'string' ),
				'prices' => array(
					'type' => 'array',
					'default' => dicey_dietology_defaults()['prices'],
				),
				'faq_title' => array( 'type' => 'string' ),
				'faq_items' => array(
					'type' => 'array',
					'default' => dicey_dietology_defaults()['faq_items'],
				),
			),
		),
		'works'       => array(
			'title'    => __( 'Шаги оформления заказа', 'dicey' ),
			'template' => 'template-parts/blocks/works',
		),
		'shipping'    => array(
			'title'    => __( 'Бесплатная доставка', 'dicey' ),
			'template' => 'template-parts/blocks/shipping',
			'callback' => 'dicey_render_shipping',
			'attributes' => array(
				'title' => array( 'type' => 'string' ),
				'tabs' => array(
					'type' => 'array',
					'default' => dicey_shipping_defaults()['tabs'],
				),
			),
		),
		'sale'        => array(
			'title'    => __( 'Скидка - 30% на первый заказ', 'dicey' ),
			'template' => 'template-parts/blocks/sale',
			'callback' => 'dicey_render_sale',
			'attributes' => array(
				'title' => array( 'type' => 'string' ),
				'subtitle' => array( 'type' => 'string' ),
				'text' => array( 'type' => 'string' ),
				'button_label' => array( 'type' => 'string' ),
				'button_url' => array( 'type' => 'string' ),
			),
		),
		'why'         => array(
			'title'    => __( 'Остались вопросы по питанию?', 'dicey' ),
			'template' => 'template-parts/blocks/why',
			'callback' => 'dicey_render_why',
			'attributes' => array(
				'title' => array( 'type' => 'string' ),
				'text' => array( 'type' => 'string' ),
				'button_label' => array( 'type' => 'string' ),
			),
		),
	);

	foreach ( $blocks as $slug => $block ) {
		$render_callback = isset( $block['callback'] ) ? $block['callback'] : static function () use ( $block ) {
			return dicey_get_template_html( $block['template'] );
		};

		register_block_type(
			'dicey/' . $slug,
			array(
				'api_version'     => 2,
				'title'           => $block['title'],
				'category'        => 'dicey',
				'editor_script'   => 'dicey-blocks-editor',
				'attributes'      => isset( $block['attributes'] ) ? $block['attributes'] : array(),
				'render_callback' => $render_callback,
				'supports'        => array(
					'align' => array( 'wide', 'full' ),
					'html'  => false,
				),
			)
		);
	}
}

function dicey_register_patterns() {
	if ( ! function_exists( 'register_block_pattern_category' ) ) {
		return;
	}

	register_block_pattern_category(
		'dicey',
		array(
			'label' => __( 'Dicey', 'dicey' ),
		)
	);

	register_block_pattern(
		'dicey/home-page',
		array(
			'title'      => __( 'Dicey home page', 'dicey' ),
			'categories' => array( 'dicey' ),
			'content'    => '<!-- wp:dicey/home-hero /--><!-- wp:dicey/home-conveniences /--><!-- wp:dicey/home-delivery /--><!-- wp:dicey/home-about-food /--><!-- wp:dicey/home-plan /--><!-- wp:dicey/home-works /--><!-- wp:dicey/shipping /--><!-- wp:dicey/sale /--><!-- wp:dicey/home-questions /--><!-- wp:dicey/why /-->',
		)
	);
}
