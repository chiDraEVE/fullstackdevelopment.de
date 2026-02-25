<?php
/**
 * Plugin Name: Fullstack Network Navigation
 * Description: Globale Navigation und Footer für Multisite.
 * Network: true
 * Version: 0.1.0
 * Author: chidraeve
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'FSD_NAV_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'FSD_NAV_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

//// Autoloader / Loader
//require_once FSD_NAV_PLUGIN_DIR . 'includes/class-loader.php';
//
//// Plugin starten
//add_action( 'plugins_loaded', [ 'FSD_Nav_Loader', 'init' ] );
//
//// Aktivierung: DB-Schema anlegen
register_activation_hook( __FILE__, [ 'FSD_Nav_Loader', 'activate' ] );

add_action( 'wp_enqueue_scripts', function () {
    wp_enqueue_style(
        'fsd-network-navigation',
        FSD_NAV_PLUGIN_URL . 'public/css/navigation.css',
        array(),
        '0.1.0'
    );
} );