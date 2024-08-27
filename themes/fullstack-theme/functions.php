<?php
function theme_enqueue_scripts() {
	wp_enqueue_script( 'main-js', get_template_directory_uri() . '/js/main.js', [], false, true );
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_scripts' );