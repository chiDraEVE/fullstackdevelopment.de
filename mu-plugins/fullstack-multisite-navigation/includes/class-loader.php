<?php
class FSD_Nav_Loader {
    public static function init() {
        // Klassen laden / instanzieren
        require_once FSD_NAV_PLUGIN_DIR . 'includes/class-db.php';
        require_once FSD_NAV_PLUGIN_DIR . 'includes/class-navigation-service.php';
        require_once FSD_NAV_PLUGIN_DIR . 'includes/class-hooks-frontend.php';
        require_once FSD_NAV_PLUGIN_DIR . 'includes/class-hooks-sync.php';
        require_once FSD_NAV_PLUGIN_DIR . 'includes/class-hooks-admin.php';

        FSD_Nav_Hooks_Frontend::register();
        FSD_Nav_Hooks_Sync::register();
        FSD_Nav_Hooks_Admin::register();
    }

    public static function activate( $network_wide ) {
        require_once FSD_NAV_PLUGIN_DIR . 'includes/class-db.php';
        if ( is_multisite() ) {
            if ( $network_wide ) {
                // Netzwerk-Aktivierung: Tabellen einmalig mit base_prefix anlegen
                FSD_Nav_DB::create_tables( true );
            } else {
                // Einzelne Seiten-Aktivierung in Multisite: abbrechen und Fehlermeldung zeigen
                wp_die( esc_html__( 'Dieses Plugin muss netzwerkweit aktiviert werden. Bitte "Netzwerk aktivieren" wählen.', 'fsd-nav' ) );
            }
        } else {
            // Single-Site: normale Anlage pro Site
            FSD_Nav_DB::create_tables( false );
        }
    }
}
