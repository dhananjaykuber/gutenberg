<?php
/**
 * Changes to the WordPress admin bar.
 *
 * @package WordPress
 */

/**
 * Adds the "Site Editor" link to the Toolbar.
 *
 * @since 5.9.0
 * @since 6.3.0 Added `$_wp_current_template_id` global for editing of current template directly from the admin bar.
 * @since 6.6.0 Added the canvas argument to the url.
 * @since 6.8.0 Changed to open Site Editor at top level instead of specific template.
 *
 * @param WP_Admin_Bar $wp_admin_bar The WP_Admin_Bar instance.
 */
function gutenberg_wp_admin_bar_edit_site_menu( $wp_admin_bar ) {
	// Don't show if a block theme is not activated.
	if ( ! wp_is_block_theme() ) {
		return;
	}

	// Don't show for users who can't edit theme options or when in the admin.
	if ( ! current_user_can( 'edit_theme_options' ) || is_admin() || ( is_blog_admin() && is_multisite() && current_user_can( 'manage_sites' ) ) ) {
		return;
	}

	$wp_admin_bar->add_node(
		array(
			'id'    => 'site-editor',
			'title' => __( 'Edit site' ),
			'href'  => admin_url( 'site-editor.php' ),
		)
	);
}

add_action( 'admin_bar_menu', 'gutenberg_wp_admin_bar_edit_site_menu', 41 );
