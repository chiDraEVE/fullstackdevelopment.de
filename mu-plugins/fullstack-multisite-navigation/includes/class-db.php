<?php
// includes/class-db.php
class FSD_Nav_DB {
    public static function create_tables() {
        global $wpdb;
        $table_name = $wpdb->base_prefix . 'network_navigation';
        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE $table_name (
            id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
            parent_id BIGINT(20) UNSIGNED NULL,
            site_id BIGINT(20) UNSIGNED NOT NULL DEFAULT 0,
            slug VARCHAR(191) NOT NULL,
            title VARCHAR(255) NOT NULL,
            url TEXT NOT NULL,
            type VARCHAR(50) NOT NULL,
            hierarchy_group VARCHAR(50) NOT NULL DEFAULT 'main',
            sort_order INT NOT NULL DEFAULT 0,
            is_active TINYINT(1) NOT NULL DEFAULT 1,
            PRIMARY KEY  (id),
            KEY parent_id (parent_id),
            KEY site_id (site_id),
            KEY hierarchy_group (hierarchy_group)
        ) $charset_collate;";

        require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        dbDelta( $sql );
    }
}
