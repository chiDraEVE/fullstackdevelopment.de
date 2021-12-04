<?php

/**
 * Registers the `fullstackdevelopment` post type.
 */
function fullstackdevelopment_init() {
	register_post_type( 'fullstackdevelopment', array(
		'labels'                => array(
			'name'                  => __( 'Fullstackdevelopments', 'fullstackdevelopment' ),
			'singular_name'         => __( 'Fullstackdevelopment', 'fullstackdevelopment' ),
			'all_items'             => __( 'All Fullstackdevelopments', 'fullstackdevelopment' ),
			'archives'              => __( 'Fullstackdevelopment Archives', 'fullstackdevelopment' ),
			'attributes'            => __( 'Fullstackdevelopment Attributes', 'fullstackdevelopment' ),
			'insert_into_item'      => __( 'Insert into fullstackdevelopment', 'fullstackdevelopment' ),
			'uploaded_to_this_item' => __( 'Uploaded to this fullstackdevelopment', 'fullstackdevelopment' ),
			'featured_image'        => _x( 'Featured Image', 'fullstackdevelopment', 'fullstackdevelopment' ),
			'set_featured_image'    => _x( 'Set featured image', 'fullstackdevelopment', 'fullstackdevelopment' ),
			'remove_featured_image' => _x( 'Remove featured image', 'fullstackdevelopment', 'fullstackdevelopment' ),
			'use_featured_image'    => _x( 'Use as featured image', 'fullstackdevelopment', 'fullstackdevelopment' ),
			'filter_items_list'     => __( 'Filter fullstackdevelopments list', 'fullstackdevelopment' ),
			'items_list_navigation' => __( 'Fullstackdevelopments list navigation', 'fullstackdevelopment' ),
			'items_list'            => __( 'Fullstackdevelopments list', 'fullstackdevelopment' ),
			'new_item'              => __( 'New Fullstackdevelopment', 'fullstackdevelopment' ),
			'add_new'               => __( 'Add New', 'fullstackdevelopment' ),
			'add_new_item'          => __( 'Add New Fullstackdevelopment', 'fullstackdevelopment' ),
			'edit_item'             => __( 'Edit Fullstackdevelopment', 'fullstackdevelopment' ),
			'view_item'             => __( 'View Fullstackdevelopment', 'fullstackdevelopment' ),
			'view_items'            => __( 'View Fullstackdevelopments', 'fullstackdevelopment' ),
			'search_items'          => __( 'Search fullstackdevelopments', 'fullstackdevelopment' ),
			'not_found'             => __( 'No fullstackdevelopments found', 'fullstackdevelopment' ),
			'not_found_in_trash'    => __( 'No fullstackdevelopments found in trash', 'fullstackdevelopment' ),
			'parent_item_colon'     => __( 'Parent Fullstackdevelopment:', 'fullstackdevelopment' ),
			'menu_name'             => __( 'Fullstackdevelopments', 'fullstackdevelopment' ),
		),
		'public'                => true,
		'hierarchical'          => false,
		'show_ui'               => true,
		'show_in_nav_menus'     => true,
		'supports'              => array( 'title', 'editor' ),
		'has_archive'           => true,
		'rewrite'               => true,
		'query_var'             => true,
		'menu_position'         => null,
		'menu_icon'             => 'dashicons-superhero-alt',
		'show_in_rest'          => true,
		'rest_base'             => 'fullstackdevelopment',
		'rest_controller_class' => 'WP_REST_Posts_Controller',
	) );

}
add_action( 'init', 'fullstackdevelopment_init' );

/**
 * Sets the post updated messages for the `fullstackdevelopment` post type.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `fullstackdevelopment` post type.
 */
function fullstackdevelopment_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['fullstackdevelopment'] = array(
		0  => '', // Unused. Messages start at index 1.
		/* translators: %s: post permalink */
		1  => sprintf( __( 'Fullstackdevelopment updated. <a target="_blank" href="%s">View fullstackdevelopment</a>', 'fullstackdevelopment' ), esc_url( $permalink ) ),
		2  => __( 'Custom field updated.', 'fullstackdevelopment' ),
		3  => __( 'Custom field deleted.', 'fullstackdevelopment' ),
		4  => __( 'Fullstackdevelopment updated.', 'fullstackdevelopment' ),
		/* translators: %s: date and time of the revision */
		5  => isset( $_GET['revision'] ) ? sprintf( __( 'Fullstackdevelopment restored to revision from %s', 'fullstackdevelopment' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		/* translators: %s: post permalink */
		6  => sprintf( __( 'Fullstackdevelopment published. <a href="%s">View fullstackdevelopment</a>', 'fullstackdevelopment' ), esc_url( $permalink ) ),
		7  => __( 'Fullstackdevelopment saved.', 'fullstackdevelopment' ),
		/* translators: %s: post permalink */
		8  => sprintf( __( 'Fullstackdevelopment submitted. <a target="_blank" href="%s">Preview fullstackdevelopment</a>', 'fullstackdevelopment' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		/* translators: 1: Publish box date format, see https://secure.php.net/date 2: Post permalink */
		9  => sprintf( __( 'Fullstackdevelopment scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview fullstackdevelopment</a>', 'fullstackdevelopment' ),
		date_i18n( __( 'M j, Y @ G:i', 'fullstackdevelopment' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
		/* translators: %s: post permalink */
		10 => sprintf( __( 'Fullstackdevelopment draft updated. <a target="_blank" href="%s">Preview fullstackdevelopment</a>', 'fullstackdevelopment' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	);

	return $messages;
}
add_filter( 'post_updated_messages', 'fullstackdevelopment_updated_messages' );
