<?php
	function clubitsolutions_scripts(){
		if (strstr($_SERVER['SERVER_NAME'], 'localhost')) {
			wp_enqueue_script( 'clubitsolutions-js', 'http://localhost:8080/index.js', array(),
				wp_get_theme()->get
				( 'Version' ) );
		}
		else {
			wp_enqueue_style('clubitsolutions-style', get_theme_file_uri() . '/dist/720.css', array(),
				wp_get_theme()->get('Version'));
			wp_enqueue_script( 'clubitsolutions-js', get_theme_file_uri() . '/dist/index.js', array(),
				wp_get_theme()->get
			( 'Version' ) );
		}
}

	add_action('wp_enqueue_scripts', 'clubitsolutions_scripts');