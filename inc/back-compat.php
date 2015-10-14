<?php
/**
 * Prevent switching to ST on old versions of WordPress.
 *
 * Switches to the default theme.
 *
 * @since ST 1.0
 */
function st_switch_theme() {
	switch_theme( WP_DEFAULT_THEME, WP_DEFAULT_THEME );
	unset( $_GET['activated'] );
	add_action( 'admin_notices', 'st_upgrade_notice' );
}
add_action( 'after_switch_theme', 'st_switch_theme' );

/**
 * Add message for unsuccessful theme switch.
 *
 * Prints an update nag after an unsuccessful attempt to switch to
 * ST on WordPress versions prior to 3.6.
 *
 * @since ST 1.0
 */
function st_upgrade_notice() {
	$message = sprintf( __( 'ST requires at least WordPress version 3.6. You are running version %s. Please upgrade and try again.', 'st' ), $GLOBALS['wp_version'] );
	printf( '<div class="error"><p>%s</p></div>', $message );
}

/**
 * Prevent the Theme Customizer from being loaded on WordPress versions prior to 3.6.
 *
 * @since ST 1.0
 */
function st_customize() {
	wp_die( sprintf( __( 'ST requires at least WordPress version 3.6. You are running version %s. Please upgrade and try again.', 'st' ), $GLOBALS['wp_version'] ), '', array(
		'back_link' => true,
	) );
}
add_action( 'load-customize.php', 'st_customize' );

/**
 * Prevent the Theme Preview from being loaded on WordPress versions prior to 3.4.
 *
 * @since ST 1.0
 */
function st_preview() {
	if ( isset( $_GET['preview'] ) ) {
		wp_die( sprintf( __( 'ST requires at least WordPress version 3.6. You are running version %s. Please upgrade and try again.', 'st' ), $GLOBALS['wp_version'] ) );
	}
}
add_action( 'template_redirect', 'st_preview' );
