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
		array( 'wp-blocks', 'wp-element', 'wp-components', 'wp-i18n' ),
		filemtime( DICEY_THEME_DIR . '/blocks/index.js' ),
		true
	);

	$blocks = array(
		'home-legacy' => array(
			'title'    => __( 'Dicey: Home Page', 'dicey' ),
			'template' => 'template-parts/pages/front-page',
		),
		'home-hero' => array(
			'title'    => __( 'Dicey: Hero', 'dicey' ),
			'template' => 'template-parts/blocks/home-hero',
		),
		'home-conveniences' => array(
			'title'    => __( 'Dicey: Conveniences', 'dicey' ),
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
		'home-popularity' => array(
			'title'    => __( 'Dicey: Popular Products', 'dicey' ),
			'template' => 'template-parts/blocks/home-popularity',
		),
		'home-delivery' => array(
			'title'    => __( 'Dicey: Subscription Delivery', 'dicey' ),
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
			'title'    => __( 'Dicey: Food Benefits', 'dicey' ),
			'template' => 'template-parts/blocks/home-about-food',
		),
		'home-plan' => array(
			'title'    => __( 'Dicey: Nutrition Plan', 'dicey' ),
			'template' => 'template-parts/blocks/home-plan',
		),
		'home-works' => array(
			'title'    => __( 'Dicey: How It Works Section', 'dicey' ),
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
			'title'    => __( 'Dicey: FAQ', 'dicey' ),
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
		'works'       => array(
			'title'    => __( 'Dicey: How It Works', 'dicey' ),
			'template' => 'template-parts/blocks/works',
		),
		'shipping'    => array(
			'title'    => __( 'Dicey: Shipping', 'dicey' ),
			'template' => 'template-parts/blocks/shipping',
		),
		'sale'        => array(
			'title'    => __( 'Dicey: Sale Banner', 'dicey' ),
			'template' => 'template-parts/blocks/sale',
		),
		'why'         => array(
			'title'    => __( 'Dicey: Contact CTA', 'dicey' ),
			'template' => 'template-parts/blocks/why',
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
			'content'    => '<!-- wp:dicey/home-hero /--><!-- wp:dicey/home-conveniences /--><!-- wp:dicey/home-popularity /--><!-- wp:dicey/home-delivery /--><!-- wp:dicey/home-about-food /--><!-- wp:dicey/home-plan /--><!-- wp:dicey/home-works /--><!-- wp:dicey/shipping /--><!-- wp:dicey/sale /--><!-- wp:dicey/home-questions /--><!-- wp:dicey/why /-->',
		)
	);
}
