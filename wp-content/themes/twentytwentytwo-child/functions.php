<?php
/**
 * Twentytwentytwo-child Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package twentytwentytwo-child
 */

add_action( 'wp_enqueue_scripts', 'twentytwentytwo_parent_theme_enqueue_styles' );

/**
 * Enqueue scripts and styles.
 */
function twentytwentytwo_parent_theme_enqueue_styles() {
	wp_enqueue_style( 'twentytwentytwo-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'twentytwentytwo-child-style',
		get_stylesheet_directory_uri() . '/style.css',
		array( 'twentytwentytwo-style' )
	);

}
