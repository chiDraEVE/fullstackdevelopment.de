<?php
	function clubitsolutions_scripts(){
		if ( strstr($_SERVER['SERVER_NAME'], '.local')) {
			wp_enqueue_script( 'clubitsolutions-js', 'http://127.0.0.1:8080/index.js', array(),
				wp_get_theme()->get
				( 'Version' ) );
		}
		else {
			wp_enqueue_style('clubitsolutions-style', get_theme_file_uri() . '/assets/720.438d9c78a5e7a300516e.css', array(),
				wp_get_theme()->get('Version'));
			wp_enqueue_style('clubitsolutions-darkmode', get_theme_file_uri() . '/assets/422.7e8f94726a71640ab5c5.css', array(),
				wp_get_theme()->get('Version'));
			wp_enqueue_script( 'clubitsolutions-js', get_theme_file_uri() . '/assets/index.js', array(),
				wp_get_theme()->get
			( 'Version' ) );
		}
}

	add_action('wp_enqueue_scripts', 'clubitsolutions_scripts');