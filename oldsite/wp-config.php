<?php
/**
 * Grundeinstellungen für WordPress
 *
 * Diese Datei wird zur Erstellung der wp-config.php verwendet.
 * Du musst aber dafür nicht das Installationsskript verwenden.
 * Stattdessen kannst du auch diese Datei als „wp-config.php“ mit
 * deinen Zugangsdaten für die Datenbank abspeichern.
 *
 * Diese Datei beinhaltet diese Einstellungen:
 *
 * * Datenbank-Zugangsdaten,
 * * Tabellenpräfix,
 * * Sicherheitsschlüssel
 * * und ABSPATH.
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Datenbank-Einstellungen - Diese Zugangsdaten bekommst du von deinem Webhoster. ** //
/**
 * Ersetze datenbankname_hier_einfuegen
 * mit dem Namen der Datenbank, die du verwenden möchtest.
 */
define( 'DB_NAME', 'fullstack-old' );

/**
 * Ersetze benutzername_hier_einfuegen
 * mit deinem Datenbank-Benutzernamen.
 */
define( 'DB_USER', 'fullstack-old' );

/**
 * Ersetze passwort_hier_einfuegen mit deinem Datenbank-Passwort.
 */
define( 'DB_PASSWORD', '`iU&CwCA9powN^@ur`5%^vQ2b$TYEa`2SJzDwq`' );

/**
 * Ersetze localhost mit der Datenbank-Serveradresse.
 */
define( 'DB_HOST', 'localhost' );

/**
 * Der Datenbankzeichensatz, der beim Erstellen der
 * Datenbanktabellen verwendet werden soll
 */
define( 'DB_CHARSET', 'utf8' );

/**
 * Der Collate-Type sollte nicht geändert werden.
 */
define( 'DB_COLLATE', '' );

/**#@+
 * Sicherheitsschlüssel
 *
 * Ändere jeden untenstehenden Platzhaltertext in eine beliebige,
 * möglichst einmalig genutzte Zeichenkette.
 * Auf der Seite {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * kannst du dir alle Schlüssel generieren lassen.
 *
 * Du kannst die Schlüssel jederzeit wieder ändern, alle angemeldeten
 * Benutzer müssen sich danach erneut anmelden.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '1Kao2tcur7>S)>(f6q0L.5=CG2I:f?6{oBCJk/3Lk>`-GF5R9A]ZBnR+Ec0@LJ-h');
define('SECURE_AUTH_KEY',  'X5Jw1t<4z(6+<Z~7U~Kh_f~.ahS5tM?=}v.+*EGS<tlm9o0S^!}!W:$<0]C)c%H~');
define('LOGGED_IN_KEY',    'XtS|?v/*+Dv)A<+=i7-%k|z9&z+w%CdiuU_-5:~gf*T`ZX)&Cs<5=8{yhR?+KED3');
define('NONCE_KEY',        'yt~PVbf&bn+sMrR-R4`s{]wk>2%- N-ZGdzC(q H4,&W745|8ML3K/;~AB%W7]mI');
define('AUTH_SALT',        '^rH6%6 q=H/Z&S5Vw`tSoh~@vN#JVt:%P?^.OvB+BU9(uHMlnQpuGfcO|&vL7i=M');
define('SECURE_AUTH_SALT', 'gA3O<VXG<7SA+e&TnB58,IE.m+6y&8t76#]vM7w|1DjZ7t|deXe^`ujU;DmN+FO2');
define('LOGGED_IN_SALT',   'CNL5f[|c>`3COM#/lXxu(n<UT+f4&%2}#u8Q~S9EidYn>x12uYhumhI^u:Klqz6M');
define('NONCE_SALT',       'We;)-?_7KSjwG:$Yeu}-b,,6=f-XZ:AjUYdS]c3M~l+Nxem6wv4V?3W.lbh;]P;Y');

/**#@-*/

/**
 * WordPress Datenbanktabellen-Präfix
 *
 * Wenn du verschiedene Präfixe benutzt, kannst du innerhalb einer Datenbank
 * verschiedene WordPress-Installationen betreiben.
 * Bitte verwende nur Zahlen, Buchstaben und Unterstriche!
 */
$table_prefix = 'fullstwp_';

/**
 * Für Entwickler: Der WordPress-Debug-Modus.
 *
 * Setze den Wert auf „true“, um bei der Entwicklung Warnungen und Fehler-Meldungen angezeigt zu bekommen.
 * Plugin- und Theme-Entwicklern wird nachdrücklich empfohlen, WP_DEBUG
 * in ihrer Entwicklungsumgebung zu verwenden.
 *
 * Besuche den Codex, um mehr Informationen über andere Konstanten zu finden,
 * die zum Debuggen genutzt werden können.
 *
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Füge individuelle Werte zwischen dieser Zeile und der „Schluss mit dem Bearbeiten“ Zeile ein. */



/* Das war’s, Schluss mit dem Bearbeiten! Viel Spaß. */
/* That's all, stop editing! Happy publishing. */

/** Der absolute Pfad zum WordPress-Verzeichnis. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Definiert WordPress-Variablen und fügt Dateien ein.  */
require_once ABSPATH . 'wp-settings.php';

/** Sets up 'direct' method for wordpress, auto update without FTP */
define('FS_METHOD', 'direct');
