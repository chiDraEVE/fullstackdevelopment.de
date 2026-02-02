<?php
class FSD_Nav_Navigation_Service {

    protected static $cache_key = 'fsd_network_navigation';

    public static function get_navigation_tree( $group = 'main' ) {
        $all = get_site_transient( self::$cache_key );

        if ( ! is_array( $all ) ) {
            $all = self::load_all_items();
            set_site_transient( self::$cache_key, $all, 3 * HOUR_IN_SECONDS );
        }

        $items = array_filter(
            $all,
            function( $item ) use ( $group ) {
                return $item['hierarchy_group'] === $group && (int) $item['is_active'] === 1;
            }
        );

        return self::build_tree( $items );
    }

    public static function clear_cache() {
        delete_site_transient( self::$cache_key );
    }

    protected static function load_all_items() {
        global $wpdb;
        $table = $wpdb->base_prefix . 'network_navigation';

        $rows = $wpdb->get_results(
            "SELECT * FROM $table ORDER BY hierarchy_group, sort_order, id",
            ARRAY_A
        );

        return is_array( $rows ) ? $rows : array();
    }

    protected static function build_tree( array $items ) {
        $by_parent = array();
        foreach ( $items as $item ) {
            $parent_id = (int) ( $item['parent_id'] ?? 0 );
            if ( ! isset( $by_parent[ $parent_id ] ) ) {
                $by_parent[ $parent_id ] = array();
            }
            $by_parent[ $parent_id ][] = $item;
        }

        $build = function( $parent_id ) use ( &$build, $by_parent ) {
            $branch = array();
            if ( empty( $by_parent[ $parent_id ] ) ) {
                return $branch;
            }

            foreach ( $by_parent[ $parent_id ] as $item ) {
                $item['children'] = $build( (int) $item['id'] );
                $branch[] = $item;
            }

            return $branch;
        };

        return $build( 0 );
    }
}