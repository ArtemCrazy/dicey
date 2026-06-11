<?php
/**
 * Global theme settings.
 *
 * @package Dicey
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'admin_menu', 'dicey_register_settings_page' );
add_action( 'admin_enqueue_scripts', 'dicey_enqueue_settings_assets' );

function dicey_get_global_why_settings() {
	$settings = get_option( 'dicey_global_why', array() );

	return dicey_merge_block_attrs( is_array( $settings ) ? $settings : array(), dicey_why_defaults() );
}

function dicey_register_settings_page() {
	add_menu_page(
		__( 'Остались вопросы', 'dicey' ),
		__( 'Остались вопросы', 'dicey' ),
		'manage_options',
		'dicey-settings',
		'dicey_render_settings_page',
		'dashicons-pets',
		58
	);
}

function dicey_enqueue_settings_assets( $hook ) {
	if ( 'toplevel_page_dicey-settings' !== $hook ) {
		return;
	}

	wp_enqueue_media();
	wp_add_inline_script(
		'jquery-core',
		<<<'JS'
(function($){$(function(){$('.dicey-media-field').each(function(){var field=$(this),input=field.find('input'),preview=field.find('img');field.find('.dicey-media-select').on('click',function(e){e.preventDefault();var frame=wp.media({title:'Выберите изображение',button:{text:'Использовать'},multiple:false});frame.on('select',function(){var media=frame.state().get('selection').first().toJSON();input.val(media.url);preview.attr('src',media.url).show();});frame.open();});field.find('.dicey-media-clear').on('click',function(e){e.preventDefault();input.val('');preview.attr('src','').hide();});});});})(jQuery);
JS
	);
}

function dicey_render_settings_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	if ( isset( $_POST['dicey_global_why_nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['dicey_global_why_nonce'] ) ), 'dicey_save_global_why' ) ) {
		$settings = array(
			'title'        => isset( $_POST['dicey_why_title'] ) ? wp_kses_post( wp_unslash( $_POST['dicey_why_title'] ) ) : '',
			'text'         => isset( $_POST['dicey_why_text'] ) ? wp_kses_post( wp_unslash( $_POST['dicey_why_text'] ) ) : '',
			'button_label' => isset( $_POST['dicey_why_button_label'] ) ? sanitize_text_field( wp_unslash( $_POST['dicey_why_button_label'] ) ) : '',
			'image'        => isset( $_POST['dicey_why_image'] ) ? esc_url_raw( wp_unslash( $_POST['dicey_why_image'] ) ) : '',
			'image_mobile' => isset( $_POST['dicey_why_image_mobile'] ) ? esc_url_raw( wp_unslash( $_POST['dicey_why_image_mobile'] ) ) : '',
		);

		update_option( 'dicey_global_why', $settings );
		echo '<div class="notice notice-success is-dismissible"><p>' . esc_html__( 'Глобальный блок сохранен.', 'dicey' ) . '</p></div>';
	}

	$settings = dicey_get_global_why_settings();
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'Остались вопросы', 'dicey' ); ?></h1>
		<form method="post">
			<?php wp_nonce_field( 'dicey_save_global_why', 'dicey_global_why_nonce' ); ?>
			<div class="postbox" style="max-width: 920px; padding: 20px;">
				<h2 style="margin-top: 0;"><?php esc_html_e( 'Остались вопросы по питанию?', 'dicey' ); ?></h2>
				<p><?php esc_html_e( 'Этот блок глобальный: изменения применятся на всех страницах, где он выведен.', 'dicey' ); ?></p>
				<table class="form-table" role="presentation">
					<tr>
						<th scope="row"><label for="dicey_why_title"><?php esc_html_e( 'Заголовок', 'dicey' ); ?></label></th>
						<td><textarea id="dicey_why_title" name="dicey_why_title" class="large-text" rows="3"><?php echo esc_textarea( $settings['title'] ); ?></textarea></td>
					</tr>
					<tr>
						<th scope="row"><label for="dicey_why_text"><?php esc_html_e( 'Текст', 'dicey' ); ?></label></th>
						<td><textarea id="dicey_why_text" name="dicey_why_text" class="large-text" rows="3"><?php echo esc_textarea( $settings['text'] ); ?></textarea></td>
					</tr>
					<tr>
						<th scope="row"><label for="dicey_why_button_label"><?php esc_html_e( 'Кнопка', 'dicey' ); ?></label></th>
						<td><input id="dicey_why_button_label" name="dicey_why_button_label" type="text" class="regular-text" value="<?php echo esc_attr( $settings['button_label'] ); ?>"></td>
					</tr>
					<tr>
						<th scope="row"><?php esc_html_e( 'Изображение', 'dicey' ); ?></th>
						<td><?php dicey_render_media_field( 'dicey_why_image', $settings['image'] ); ?></td>
					</tr>
					<tr>
						<th scope="row"><?php esc_html_e( 'Изображение на мобильной версии', 'dicey' ); ?></th>
						<td><?php dicey_render_media_field( 'dicey_why_image_mobile', $settings['image_mobile'] ); ?></td>
					</tr>
				</table>
				<?php submit_button( __( 'Сохранить глобальный блок', 'dicey' ) ); ?>
			</div>
		</form>
	</div>
	<?php
}

function dicey_render_media_field( $name, $value ) {
	$src = $value ? dicey_asset_img( $value ) : '';
	?>
	<div class="dicey-media-field">
		<img src="<?php echo esc_url( $src ); ?>" alt="" style="<?php echo esc_attr( $value ? 'display: block;' : 'display: none;' ); ?> max-width: 220px; max-height: 140px; object-fit: contain; margin-bottom: 10px; background: #f6f7f7; border: 1px solid #dcdcde;">
		<input type="text" name="<?php echo esc_attr( $name ); ?>" class="regular-text" value="<?php echo esc_attr( $value ); ?>">
		<button type="button" class="button dicey-media-select"><?php esc_html_e( 'Выбрать изображение', 'dicey' ); ?></button>
		<button type="button" class="button-link-delete dicey-media-clear" style="margin-left: 8px;"><?php esc_html_e( 'Очистить', 'dicey' ); ?></button>
	</div>
	<?php
}
