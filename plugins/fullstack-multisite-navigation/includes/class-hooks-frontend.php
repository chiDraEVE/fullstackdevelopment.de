<?php
class FSD_Nav_Hooks_Frontend {
    public static function register() {
        add_action( 'wp_body_open', [ __CLASS__, 'output_header_nav' ] );
        add_action( 'wp_footer', [ __CLASS__, 'output_footer_nav' ], 5 );
    }

    public static function output_header_nav() {
        if ( is_admin() || is_main_site() ) {
            return;
        }

        $tree = FSD_Nav_Navigation_Service::get_navigation_tree( 'main' );
        if ( ! $tree ) {
            return;
        }

        include FSD_NAV_PLUGIN_DIR . 'public/partials/navigation.php';
    }

    public static function output_footer_nav() {
        if ( is_admin() ) {
            return;
        }

        $tree = FSD_Nav_Navigation_Service::get_navigation_tree( 'footer' );
        include FSD_NAV_PLUGIN_DIR . 'public/partials/footer-legal.php';
    }
}
