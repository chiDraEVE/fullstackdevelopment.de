<?php
function shell_exec_available(): bool {
    return function_exists( 'shell_exec' )
        && ! in_array( 'shell_exec', array_map( 'trim', explode( ',', ini_get( 'disable_functions' ) ) ), true );
}

function get_git_branch(): ?string {

    if ( wp_get_environment_type() !== 'local' ) {
        return null;
    }

    if ( ! shell_exec_available() ) {
        return null;
    }

    // optional: Caching
    static $branch = null;
    if ( $branch !== null ) {
        return $branch;
    }

    $repo_path = WP_CONTENT_DIR;

    $cmd = sprintf(
        'cd %s && git branch --show-current 2>/dev/null',
        escapeshellarg( WP_CONTENT_DIR )
    );

    $branch = trim( shell_exec( $cmd ) );

    return $branch ?: null;
}


add_action( 'admin_bar_menu', function ( WP_Admin_Bar $wp_admin_bar ) {

    if ( ! is_admin_bar_showing() ) {
        return;
    }

    $env  = wp_get_environment_type();
    $url  = get_site_url();

    $wp_admin_bar->add_node( [
        'id'    => 'site-env-info',
        'title' => sprintf(
            '<span class="git-branch">%s</span> <span class="site-env">%s</span>',
            get_git_branch(),
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