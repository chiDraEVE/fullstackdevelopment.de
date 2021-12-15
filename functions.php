<?php
	function clubitsolutions_scripts(){
		wp_enqueue_style('clubitsolutions-style', get_theme_file_uri() . '/style.css', array(), wp_get_theme()->get('Version'));
}

	add_action('wp_enqueue_scripts', 'clubitsolutions_scripts');