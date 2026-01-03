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

function get_branch_class( string $branch ): string {
    // master / main
    if ( in_array($branch, ['master','main'], true) ) {
        return 'branch-master';
    }

    // staging / prod / development
    if ( in_array($branch, ['staging','production','development'], true) ) {
        return 'branch-' . sanitize_title($branch);
    }

    // feature/* oder learn/*
    if ( str_starts_with($branch, 'feature/') ) {
        return 'branch-feature';
    }
    if ( str_starts_with($branch, 'learn/') ) {
        return 'branch-learn';
    }

    if ( str_starts_with($branch, 'ui/') ) {
        return 'branch-ui';
    }

    // fallback
    return 'branch-generic';
}

add_action( 'admin_bar_menu', function ( WP_Admin_Bar $wp_admin_bar ) {

    if ( ! is_admin_bar_showing() ) {
        return;
    }

    $env = wp_get_environment_type();

    if ( $env === 'local' ) {
        $branch = get_git_branch(); // z.B. learn/advanced_css
        $branch_class = get_branch_class( $branch );

        $wp_admin_bar->add_node( [
            'id'    => 'site-env-info',
            'title' => sprintf(
                '<span class="git-branch %1$s">%2$s</span> <span class="site-env env-%3$s">%4$s</span>',
                esc_attr($branch_class),
                esc_html($branch),
                esc_attr($env),
                esc_html(strtoupper($env))
            ),
            'meta'  => [
                'class' => 'site-env-info site-env-' . esc_attr($env),
            ],
        ] );
    } else {

        $wp_admin_bar->add_node([
            'id' => 'site-env-info',
            'title' => sprintf(
                '<span class="site-env env-%1$s">%2$s</span>',
                esc_attr($env),
                esc_html(strtoupper($env))
            ),
            'meta' => [
                'class' => 'site-env-info site-env-' . esc_attr($env),
            ],
        ]);
    }

}, 999 );

add_action( 'admin_enqueue_scripts', 'env_admin_bar_styles' );
add_action( 'wp_enqueue_scripts', 'env_admin_bar_styles' );

function env_admin_bar_styles() {
    if ( ! is_admin_bar_showing() ) {
        return;
    }

    wp_enqueue_style(
        'site-env-bar',
        MY_PLUGIN_URL . '/admin/admin-style.css',
        [],
        '1.0'
    );
}