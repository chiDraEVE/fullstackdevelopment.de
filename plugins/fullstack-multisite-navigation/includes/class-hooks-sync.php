<?php
class FSD_Nav_Hooks_Sync {

    public static function register() {
        // Neue Site in Multisite
        add_action( 'wp_insert_site', [ __CLASS__, 'on_new_site' ], 10, 1 );

        // CPTs auf Hauptseite
        add_action( 'save_post_project', [ __CLASS__, 'on_save_project' ], 10, 3 );
    }

    public static function on_new_site( WP_Site $site ) {
        if ( ! is_multisite() ) {
            return;
        }

        global $wpdb;
        $table = $wpdb->base_prefix . 'network_navigation';

        $url   = get_site_url( $site->blog_id, '/' );
        $title = $site->blogname ?: $url;

        $wpdb->insert(
            $table,
            array(
                'parent_id'       => null,
                'site_id'         => $site->blog_id,
                'slug'            => sanitize_title( $title ),
                'title'           => $title,
                'url'             => $url,
                'type'            => 'site',
                'hierarchy_group' => 'main',
                'sort_order'      => 0,
                'is_active'       => 1,
            ),
            array( '%d', '%d', '%s', '%s', '%s', '%s', '%s', '%d', '%d' )
        );

        FSD_Nav_Navigation_Service::clear_cache();
    }

    public static function on_save_project( $post_id, $post, $update ) {
        if ( ! is_main_site() ) {
            return;
        }

        if ( wp_is_post_revision( $post_id ) ) {
            return;
        }

        global $wpdb;
        $table = $wpdb->base_prefix . 'network_navigation';

        $url   = get_permalink( $post_id );
        $title = get_the_title( $post_id );

        $existing_id = $wpdb->get_var(
            $wpdb->prepare(
                "SELECT id FROM $table WHERE type = %s AND slug = %s LIMIT 1",
                'project',
                $post->post_name
            )
        );

        $data = array(
            'parent_id'       => null,
            'site_id'         => get_current_blog_id(),
            'slug'            => $post->post_name,
            'title'           => $title,
            'url'             => $url,
            'type'            => 'project',
            'hierarchy_group' => 'main',
            'sort_order'      => 0,
            'is_active'       => ( $post->post_status === 'publish' ) ? 1 : 0,
        );

        if ( $existing_id ) {
            $wpdb->update( $table, $data, array( 'id' => $existing_id ) );
        } else {
            $wpdb->insert( $table, $data );
        }

        FSD_Nav_Navigation_Service::clear_cache();
    }
}
