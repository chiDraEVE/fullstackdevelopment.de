<?php
function theme_enqueue_scripts() {
	wp_enqueue_script( 'main-js', get_template_directory_uri() . '/build/index.js', [], false, true );
	wp_enqueue_style('cousine-regular', get_template_directory_uri() . '/cousine.css');
	wp_enqueue_style('crimson-pro', get_template_directory_uri() . '/crimson-pro.css');
	wp_enqueue_style('libre-franklin', get_template_directory_uri() . '/libre-franklin.css');
	wp_enqueue_style('dancing-script', get_template_directory_uri() . '/dancing-script.css');

	wp_enqueue_style('style-index', get_stylesheet_directory_uri() . '/build/style-index.css');
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_scripts' );