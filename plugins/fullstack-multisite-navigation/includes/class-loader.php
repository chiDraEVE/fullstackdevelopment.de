<?php
class FSD_Nav_Loader {
    public static function init() {
        // Klassen laden / instanzieren
        require_once FSD_NAV_PLUGIN_DIR . 'includes/class-db.php';
        require_once FSD_NAV_PLUGIN_DIR . 'includes/class-navigation-service.php';
        require_once FSD_NAV_PLUGIN_DIR . 'includes/class-hooks-frontend.php';
        require_once FSD_NAV_PLUGIN_DIR . 'includes/class-hooks-sync.php';

        FSD_Nav_Hooks_Frontend::register();
        FSD_Nav_Hooks_Sync::register();
    }

    public static function activate( $network_wide ) {
        require_once FSD_NAV_PLUGIN_DIR . 'includes/class-db.php';
        if ( is_multisite() && $network_wide ) {
            // Tabelle nur einmal auf Netzwerk-Ebene mit base_prefix
            FSD_Nav_DB::create_tables();
        } else {
            FSD_Nav_DB::create_tables();
        }
    }
}
