<?php
// includes/class-hooks-admin.php
class FSD_Nav_Hooks_Admin {

    public static function register() {
        add_action( 'admin_menu', [ __CLASS__, 'add_admin_menu' ] );
    }

    public static function add_admin_menu() {
        add_menu_page(
            'Network Navigation',
            'Netzwerk Nav',
            'manage_options',
            'fsd-network-navigation',
            [ __CLASS__, 'admin_page' ],
            'dashicons-menu'
        );
    }

    public static function admin_page() {
        ?>
        <div class="wrap">
            <h1>Netzwerk Navigation</h1>

            <h2>Aktionen</h2>
            <form method="post">
                <?php wp_nonce_field( 'fsd_nav_admin' ); ?>
                <?php // Cache leeren prüfen
                    if ( isset( $_POST['fsd_clear_cache'] ) &&
                         check_admin_referer( 'fsd_nav_admin' ) ) {
                        FSD_Nav_Navigation_Service::clear_cache();
                        echo '<div class="notice notice-success"><p>✅ Cache geleert!</p></div>';
                    }

                    // Sites importieren prüfen
                    if ( isset( $_POST['fsd_import_sites'] ) &&
                         check_admin_referer( 'fsd_nav_import' ) ) {
                        $imported_count = self::import_all_sites();
                        echo '<div class="notice notice-success">';
                        echo '<p>✅ ' . $imported_count . ' Sites importiert!</p>';
                        echo '</div>';
                    }
                    ?>

                    <!-- Formulare -->
                    <form method="post">
                        <?php wp_nonce_field( 'fsd_nav_admin' ); ?>
                        <input type="submit" name="fsd_clear_cache" class="button button-primary" value="Cache leeren">
                    </form>

                    <form method="post">
                        <?php wp_nonce_field( 'fsd_nav_import' ); ?>
                        <input type="submit" name="fsd_import_sites" class="button button-secondary" value="Sites importieren">
                    </form>

                </div>
        <?php
    }

    public static function import_all_sites() {
        if ( ! is_multisite() ) {
            error_log( 'FSD: Nicht Multisite!' );
            return 0;
        }

        global $wpdb;
        $table = $wpdb->base_prefix . 'network_navigation';

        $sites = get_sites( [ 'number' => 1000 ] );
        error_log( 'FSD: ' . count( $sites ) . ' Sites gefunden' );
        $imported = 0;

        foreach ( $sites as $site ) {
            $url   = get_site_url( $site->blog_id );
            $title = $site->blogname ?: $url;

            // Nur wenn noch nicht vorhanden
            $exists = $wpdb->get_var(
                $wpdb->prepare(
                    "SELECT id FROM $table WHERE site_id = %d AND type = 'site'",
                    $site->blog_id
                )
            );

            if ( ! $exists ) {
                $wpdb->insert( $table, [
                    'parent_id'       => 0,  // 0 statt null für DB
                    'site_id'         => $site->blog_id,
                    'slug'            => sanitize_title( $title ),
                    'title'           => $title,
                    'url'             => $url,
                    'type'            => 'site',
                    'hierarchy_group' => 'main',
                    'sort_order'      => 0,
                    'is_active'       => 1,
                ] );
                $imported++;
            }
        }

        FSD_Nav_Navigation_Service::clear_cache();
        return $imported;
    }
}
