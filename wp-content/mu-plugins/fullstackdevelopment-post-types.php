<?php
	
	add_action('init', create_course_cpt);
	
	function create_course_cpt() {
		$args = array(
			'public' => true,
			'label' => 'Kurse',
			'has_archive' => true,
			'rewrite' => array( 'slug' => 'kurs'),
			'supports' => array(
				'title',
				'editor',
				'author',
				'thumbnail',
				'excerpt',
				'comments',
				'revision'
			)
		);
		register_post_type('course', $args);
	}

