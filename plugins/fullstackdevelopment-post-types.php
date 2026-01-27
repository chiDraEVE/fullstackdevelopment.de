<?php
/*
  Plugin Name: Fullstackdevelopment Post Types
  Version: 1.0
  Author: chidraeve
  Author URI: https://fullstackdevelopment.de
*/

	add_action('init', 'fullstackdevelopment_post_types');
	
	function fullstackdevelopment_post_types() {
		$common = array(
			'public' => true,
			'has_archive' => true,
			'supports' => array(
				'title',
				'editor',
				'author',
				'thumbnail',
				'excerpt',
				'comments',
				'revision'
			),
            'show_in_rest' => true
		);
		
		$sourceArguments = array(
			'label' => 'source',
			'rewrite' => array( 'slug' => 'source'),
			'menu_icon' => 'dashicons-feedback',
			'labels' => array(
				'name' => 'Quelle',
				'add_new_item' => 'Neue Quelle hinzufügen',
				'edit_item' => 'Quelle bearbeiten',
				'all_items' => 'Alle Quellen',
				'singular_name' => 'Quelle'
			),
			'menu_position' => 40
		);
		
		register_post_type('source', array_merge($common, $sourceArguments));
		
		$projectArguments = array(
			'label' => 'project',
			'rewrite' => array( 'slug' => 'project'),
			'menu_icon' => 'dashicons-portfolio',
			'labels' => array(
				'name' => 'Projekte',
				'add_new_item' => 'Neues Projekt anlegen',
				'edit_item' => 'Projekt bearbeiten',
				'all_items' => 'Alle Projekte',
				'singular_name' => 'Projekt'
			),
			'menu_position' => 30
		);
		
		register_post_type( 'project', array_merge($common, $projectArguments) );
		
		$instructorArguments = array(
			'label' => 'instrctor',
			'rewrite' => array( 'slug' => 'instructor'),
			'menu_icon' => 'dashicons-id',
			'labels' => array(
				'name' => 'Dozenten',
				'add_new_item' => 'Neuen Dozenten anlegen',
				'edit_item' => 'Dozent bearbeiten',
				'all_items' => 'Alle Dozenten',
				'singular_name' => 'Dozent'
			),
			'menu_position' => 50
		);
		
		register_post_type( 'instructor', array_merge($common, $instructorArguments) );
	}
	
	add_action('init', 'fullstackdevelopment_taxonomies');
	function fullstackdevelopment_taxonomies() {
		register_taxonomy( 'vendor', array( 'project' ), array(
			'hierarchical' => false,
			'label' => 'vendor',
			'show_ui' => true,
			'show_in_rest' => true,
			'show_admin_column' => true,
			'query_var' => true,
			'rewrite' => array('slug' => 'vendor')
		) );
		
		register_taxonomy( 'project-type', array( 'project', 'source' ), array(
			'hierarchical' => true,
			'labels' => array(
				'name' => 'Projektarten',
				'singular_name' => 'Projektart',
				'menu_name' => 'Projektart',
				'all_items' => 'Alle Projektarten',
				'edit_item' => 'Projektart bearbeiten',
				'view_item' => 'Projektart anschauen',
				'update_item' => 'Projektart aktualisieren',
				'add_new_item' => 'Neue Projektart erstellen',
				'parent_item' => 'Übergeordnete Projektart',
				'search_items' => 'Projektart suchen'
			),
			'show_ui' => true,
			'show_in_rest' => true,
			'show_admin_column' => true,
			'query_var' => true,
			'rewrite' => array('slug' => 'project-type')
		) );
	}

	add_action('init', 'fullstackdevelopment_add_taxonomies_to_courses');
	function fullstackdevelopment_add_taxonomies_to_courses() {
		register_taxonomy_for_object_type( 'category', 'source' );
		register_taxonomy_for_object_type( 'category', 'project' );
		register_taxonomy_for_object_type( 'post_tag', 'source' );
		register_taxonomy_for_object_type( 'post_tag', 'project' );
	}