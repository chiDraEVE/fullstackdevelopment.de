<?php
	
	add_action('init', 'fullstackdevelopment_create_course_cpt');
	
	function fullstackdevelopment_create_course_cpt() {
		$args = array(
			'public' => true,
			'label' => 'course',
			'has_archive' => true,
			'rewrite' => array( 'slug' => 'course'),
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
		
		$args['label'] = 'project';
		$args['rewrite'] = array('slug' => 'project');
		
		register_post_type( 'project', $args );
	}
	
	add_action('init', 'fullstackdevelopment_create_udemy_course_taxonomy');
	function fullstackdevelopment_create_udemy_course_taxonomy() {
		register_taxonomy( 'udemy-course', array( 'page', 'post', 'course', 'project' ), array(
			'hierarchical' => false,
			'label' => 'udemy-course',
			'show_ui' => true,
			'show_in_rest' => true,
			'show_admin_column' => true,
			'query_var' => true,
			'rewrite' => array('slug' => 'udemy-course')
		) );
	}

	add_action('init', 'fullstackdevelopment_add_taxonomies_to_courses');
	function fullstackdevelopment_add_taxonomies_to_courses() {
		register_taxonomy_for_object_type( 'category', 'course' );
		register_taxonomy_for_object_type( 'post_tag', 'course' );
	}