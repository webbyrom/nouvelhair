<?php
defined('ABSPATH') or die('');
/**
 * Plugin Name: Web-byrrom secure connection
 * Plugin URI: https://web-byrom.com
 * Description: Limite les tentatives de connexion infructueuses et bloque les adresses IP après un certain nombre de tentatives.
 * Version: 2.0.5
 * Author: Romain Fourel
 * Author URI: https://web-byrom.com
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Requires at least: 6.0.0
 * Tested up to: 6.2.2
 * Requires PHP: 8.0
 * Tags: fonctionanlités pour la sécurité au niveau de la connexion de l'administration
 * Stable tag: 1.0
 */

// Installe le plugin
add_action( 'init', 'Webbyrom_secure_connection_check_installation');
function Webbyrom_secure_connection_check_installation(){
    if (get_option( 'Webybrom_secure_connection_installed') !== true) {
        Webbyrom_secure_connection_install();
    }
}
//register_activation_hook(__FILE__, 'Webbyrom_secure_connection_install');
function Webbyrom_secure_connection_install()
{
    // Code pour l'installation (vérification des tables, etc.)
    // Ici vous pouvez créer les tables nécessaires pour stocker les tentatives de connexion, le blocage, etc.
    global $wpdb;
    $table_name = $wpdb->prefix . 'Webbyrom_secure_connection_attempts';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        user_id mediumint(9) NOT NULL,
        attempt_time datetime NOT NULL,
        PRIMARY KEY  (id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    $result = dbDelta($sql);
    // Affiche une notification d'activation réussie
    if (is_wp_error($result)){
        // En cas d'erreur désactive le plugin
        deactivate_plugins( plugin_basename( __FILE__ ));
        wp_die("Erreur lors de la création de la table: " . $result->get_error_message());
    } else {
        // Enregistre le puglin comme étant activé
        add_option( 'Webbyrom_secure_connection_installed', true );
    }
}
// Nettoie tout lors de la désactivation
register_deactivation_hook(__FILE__, 'Webbyrom_secure_connection_deactivate');
function Webbyrom_secure_connection_deactivate()
{
    // Code pour la désactivation (supprimer les tables créées, etc.)
    global $wpdb;
    $table_name = $wpdb->prefix . 'Webbyrom_secure_connection_attempts';
    $wpdb->query("DROP TABLE IF EXISTS $table_name");
}

// Nettoie tout lors de la suppression
register_uninstall_hook(__FILE__, 'Webbyrom_secure_connection_uninstall');
function Webbyrom_secure_connection_uninstall()
{
    // Code pour la suppression (supprimer les tables créées, etc.)
    global $wpdb;
    $table_name = $wpdb->prefix . 'Webbyrom_secure_connection_attempts';
    $wpdb->query("DROP TABLE IF EXISTS $table_name");
}

// Inclure ici les actions et filtres nécessaires pour la sécurité de la connexion
require_once plugin_dir_path(__FILE__) . 'Webbyrom_secure_connection_admin.php';
