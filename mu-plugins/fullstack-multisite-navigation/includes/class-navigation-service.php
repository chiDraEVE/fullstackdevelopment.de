<?php

/**
 * Class FSD_Nav_Navigation_Service
 *
 * Provides methods for managing and retrieving hierarchical navigation trees,
 * including caching mechanisms for efficient data retrieval.
 */
class FSD_Nav_Navigation_Service {

    protected static $cache_key = 'fsd_network_navigation';

    /**
     * Retrieves a hierarchical navigation tree for a specified group.
     *
     * This method fetches all cached navigation items from the transient storage.
     * If the cache is not available, it loads all items and stores them
     * in the transient storage. It then filters the items to include only
     * those that belong to the specified hierarchy group and are marked as active.
     * Finally, it builds and returns the navigation tree.
     *
     * @param string $group The name of the hierarchy group to filter items by. Defaults to 'main'.
     * @return array The constructed navigation tree as a hierarchical array.
     */
    public static function get_navigation_tree( $group = 'main' ) {
        $all = get_site_transient( self::$cache_key );

//        if ( ! is_array( $all ) ) {
//            $all = self::load_all_items();
//            set_site_transient( self::$cache_key, $all, 3 * HOUR_IN_SECONDS );
//        }

        $items = array_filter(
            $all,
            function( $item ) use ( $group ) {
                return $item['hierarchy_group'] === $group && (int) $item['is_active'] === 1;
            }
        );

        return self::build_tree( $items );
    }

    /**
     * Clears the cached navigation data from the transient storage.
     *
     * This method removes the stored transient containing navigation items
     * by deleting it from the site's transient storage.
     *
     * @return void
     */
    public static function clear_cache() {
        delete_site_transient( self::$cache_key );
    }

    /**
     * Loads all navigation items from the database.*
     *
     * This method retrieves all rows from the network navigation database table
     * and orders them by hierarchy group, sort order, and ID. The retrieved data
     * is returned as an array, or an empty array if the query result is not an array.
     *
     * @return array The list of navigation items as an associative array.
     */
    protected static function load_all_items() {
        global $wpdb;
        $table = $wpdb->base_prefix . 'network_navigation';

        $rows = $wpdb->get_results(
            "SELECT * FROM $table ORDER BY hierarchy_group, sort_order, id",
            ARRAY_A
        );

        return is_array( $rows ) ? $rows : array();
    }

    /**
     * Constructs a hierarchical tree structure from a flat array of items.
     *
     * This method organizes a flat list of items into a tree structure based on
     * their parent-child relationships. Each item is grouped by its parent ID,
     * and the hierarchy is recursively built starting from the root level
     * (parent ID = 0). The resulting tree includes nested children for each item.
     *
     * @param array $items An array of items, where each item must contain an 'id' and optionally a 'parent_id' key.
     * @return array The hierarchical tree structure, with each item including a nested 'children' array.
     */
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