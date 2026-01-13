<?php
/**
 * Plugin Name: My first Gutenberg App
 * Plugin Dexcription: A simple Gutenberg app integrated into the WordPress admin from the course about wp data layer. Added a custom feature to detect the environment type.
 * Version: 1.0.0
 */

defined('ABSPATH') || exit;

define('MY_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('MY_PLUGIN_URL', plugins_url('', __FILE__));

require_once MY_PLUGIN_PATH . 'admin/environment-type.php';

function my_admin_menu() {
    // Create a new admin page for our app.
    add_menu_page(
        __( 'My first Gutenberg app', 'gutenberg' ),
        __( 'My first Gutenberg app', 'gutenberg' ),
        'manage_options',
        'my-first-gutenberg-app',
        function () {
            echo '
            <h2>Pages</h2>
            <div id="my-first-gutenberg-app"></div>
        ';
        },
        'dashicons-schedule',
        3
    );
}

add_action( 'admin_menu', 'my_admin_menu' );

function load_custom_wp_admin_scripts( $hook ) {
    // Load only on ?page=my-first-gutenberg-app.
    if ( 'toplevel_page_my-first-gutenberg-app' !== $hook ) {
        return;
    }

    // Load the required WordPress packages.

    // Automatically load imported dependencies and assets version.
    $asset_file = include plugin_dir_path( __FILE__ ) . 'build/index.asset.php';

    // Enqueue CSS dependencies.
    foreach ( $asset_file['dependencies'] as $style ) {
        wp_enqueue_style( $style );
    }

    // Load our app.js.
    wp_register_script(
        'my-first-gutenberg-app',
        plugins_url( 'build/index.js', __FILE__ ),
        $asset_file['dependencies'],
        $asset_file['version']
    );
    wp_enqueue_script( 'my-first-gutenberg-app' );

    // Load our style.css.
    wp_register_style(
        'my-first-gutenberg-app',
        plugins_url( 'style.css', __FILE__ ),
        array(),
        $asset_file['version']
    );
    wp_enqueue_style( 'my-first-gutenberg-app' );
}

add_action( 'admin_enqueue_scripts', 'load_custom_wp_admin_scripts' );