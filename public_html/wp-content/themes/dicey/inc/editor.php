<?php
/**
 * Editor restrictions and admin safety.
 *
 * @package Dicey
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function dicey_allowed_block_types( $allowed_block_types, $editor_context ) {
	if ( empty( $editor_context->post ) ) {
		return $allowed_block_types;
	}

	if ( 'dicey_article' === $editor_context->post->post_type ) {
		return array(
			'core/paragraph',
			'core/heading',
			'core/list',
			'core/list-item',
			'core/quote',
		);
	}

	return $allowed_block_types;
}

add_filter( 'allowed_block_types_all', 'dicey_allowed_block_types', 10, 2 );

function dicey_missing_content_notice( $label ) {
	if ( ! current_user_can( 'edit_pages' ) ) {
		return '';
	}

	return sprintf(
		'<main><div class="container" style="padding:80px 0"><p>%s</p></div></main>',
		esc_html( sprintf( '%s: заполните страницу в редакторе WordPress.', $label ) )
	);
}
