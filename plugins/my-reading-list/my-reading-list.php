<?php
/**
 * Plugin Name:       My Reading List
 * Description:       Create a list of books to be rendered in a dynamic block.
 * Version:           0.0.1
 * Requires at least: 6.7
 * Requires PHP:      7.4
 * Author:            chiDraEVE
 * Author URI:		  https://github.com/chiDraEVE
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       my-reading-list
 *
 * @package my-reading-list
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Register a book custom post type
 */
add_action( 'init', 'my_reading_list_register_book_post_type' );
function my_reading_list_register_book_post_type() {
	register_post_type(
		'book',
		array(
			'labels'       => array(
				'name'          => 'Books',
				'singular_name' => 'Book',
			),
			'public'       => true,
			'has_archive'  => true,
			'supports'     => array( 'title', 'editor', 'thumbnail' ),
			'show_in_rest' => true
		)
	);
}

/**
 * Add featured image to the book post type
 */
add_action( 'rest_api_init', 'my_reading_list_register_book_featured_image' );
function my_reading_list_register_book_featured_image() {
	register_rest_field(
		'book',
		'featured_image_src',
		array(
			'get_callback' => 'my_reading_list_get_book_featured_image_src',
			'schema'       => null,
		)
	);
}
function my_reading_list_get_book_featured_image_src( $object ) {
	if ( $object['featured_media'] ) {
		$img = wp_get_attachment_image_src( $object['featured_media'], 'medium' );
		return $img[0];
	}
	return false;
}

add_action( 'init', 'my_reading_list_reading_list_block_init' );
function my_reading_list_reading_list_block_init() {
	/**
	 * Registers the block(s) metadata from the `blocks-manifest.php` and registers the block type(s)
	 * based on the registered block metadata.
	 * Added in WordPress 6.8 to simplify the block metadata registration process added in WordPress 6.7.
	 *
	 * @see https://make.wordpress.org/core/2025/03/13/more-efficient-block-type-registration-in-6-8/
	 */
	if ( function_exists( 'wp_register_block_types_from_metadata_collection' ) ) {
		wp_register_block_types_from_metadata_collection( __DIR__ . '/build', __DIR__ . '/build/blocks-manifest.php' );
		return;
	}

	/**
	 * Registers the block(s) metadata from the `blocks-manifest.php` file.
	 * Added to WordPress 6.7 to improve the performance of block type registration.
	 *
	 * @see https://make.wordpress.org/core/2024/10/17/new-block-type-registration-apis-to-improve-performance-in-wordpress-6-7/
	 */
	if ( function_exists( 'wp_register_block_metadata_collection' ) ) {
		wp_register_block_metadata_collection( __DIR__ . '/build', __DIR__ . '/build/blocks-manifest.php' );
	}
	/**
	 * Registers the block type(s) in the `blocks-manifest.php` file.
	 *
	 * @see https://developer.wordpress.org/reference/functions/register_block_type/
	 */
	$manifest_data = require __DIR__ . '/build/blocks-manifest.php';
	foreach ( array_keys( $manifest_data ) as $block_type ) {
		register_block_type( __DIR__ . "/build/{$block_type}" );
	}
}

