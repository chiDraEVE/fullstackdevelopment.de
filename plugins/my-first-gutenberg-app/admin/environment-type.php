<?php
add_action( 'admin_bar_menu', function ( WP_Admin_Bar $wp_admin_bar ) {

    if ( ! is_admin_bar_showing() ) {
        return;
    }

    $env  = wp_get_environment_type();
    $url  = get_site_url();

    $wp_admin_bar->add_node( [
        'id'    => 'site-env-info',
        'title' => sprintf(
            '<span class="site-url">%s</span> <span class="site-env">%s</span>',
            esc_html( $url ),
            esc_html( strtoupper( $env ) )
        ),
        'meta'  => [
            'class' => 'site-env-info site-env-' . esc_attr( $env ),
        ],
    ] );

}, 999 );

add_action( 'admin_enqueue_scripts', function () {
    wp_enqueue_style(
        'site-env-bar',
        MY_PLUGIN_URL . 'admin/admin-style.css',
        [],
        '1.0'
    );
} );