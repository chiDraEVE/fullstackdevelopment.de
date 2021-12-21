<?php
/**
 * Clubitsolutions-child_theme Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package clubitsolutions-child_theme
 */

add_action( 'wp_enqueue_scripts', 'clubitsolutions_theme_parent_theme_enqueue_styles' );

/**
 * Enqueue scripts and styles.
 */
function clubitsolutions_theme_parent_theme_enqueue_styles() {
	wp_enqueue_style( 'clubitsolutions-theme-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'clubitsolutions-child_theme-style',
		get_stylesheet_directory_uri() . '/style.css',
		array( 'clubitsolutions-theme-style' )
	);

}
