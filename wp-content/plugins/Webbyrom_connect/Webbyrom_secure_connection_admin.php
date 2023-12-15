<?php
// Vérifier que le fichier est accédé directement et non pas depuis WordPress
if (!defined('ABSPATH')) {
    exit;
}

class Webbyrom_secure_connection_Admin
{
    public function __construct()
    {
        add_action('wp_login_failed', array($this, 'login_failed_handler'));
        add_filter('authenticate', array($this, 'check_login_status'), 99, 3);
        add_action('login_enqueue_scripts', array($this, 'display_blocked_message'));
        add_action('admin_menu', array($this, 'add_admin_menu'));
        add_action('admin_init', array($this, 'unblock_ip'));
    }

    public function add_admin_menu()
    {
        // Ajoute une page d'administration personnalisée pour gérer les adresses IP bloquées
        add_menu_page(
            'Gérer les IP bloquées',
            'IP bloquées',
            'manage_options',
            'webbyrom_secure_connection_blocked_ips',
            array($this, 'display_blocked_ips_page')
        );
    }

    public function display_blocked_ips_page()
    {
        // Vérifie si l'utilisateur a le rôle d'administrateur
        if (current_user_can('administrator')) {
            global $wpdb;
            $blocked_accounts = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}blocked_accounts");
            include_once 'Webbyrom_secure_blocked_ip.php';
        }
    }

    public function unblock_ip()
    {
        // Vérifie si l'utilisateur a le rôle d'administrateur et si le formulaire de déblocage est soumis
        if (current_user_can('administrator') && isset($_POST['unblock_ip'])) {
            global $wpdb;
            $ip_address_to_unblock = $_POST['unblock_ip'];

            // Vérifie le nonce pour empêcher les attaques CSRF
            if (!wp_verify_nonce($_POST['_wpnonce'], 'unblock_ip_' . $ip_address_to_unblock)) {
                wp_die('Nonce invalide');
            }

            // Supprime l'adresse IP de la table des adresses IP bloquées
            $wpdb->delete($wpdb->prefix . 'blocked_accounts', array('ip_address' => $ip_address_to_unblock));

            echo '<div class="notice notice-success plug-sec-co"><p>L\'adresse IP ' . esc_html($ip_address_to_unblock) . ' a été débloquée.</p></div>';
        }
    }

    public function login_failed_handler($username)
    {
        global $wpdb;
        $ip_address = $_SERVER['REMOTE_ADDR'];

        $blocked_account = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$wpdb->prefix}blocked_accounts WHERE username = %s", $username));

        if ($blocked_account) {
            wp_die(__('Compte bloqué. Veuillez réessayer dans 30 minutes ou contactez l\'administrateur.', 'Webbyrom_secure_connection'), __('Erreur de connexion', 'Webbyrom_secure_connection'));
        }

        // Gère les tentatives de connexion échouées
        if (isset($_COOKIE['login_attempts'])) {
            $attempts = intval($_COOKIE['login_attempts']);
            $attempts++;

            if ($attempts >= 5) {
                $wpdb->insert($wpdb->prefix . 'blocked_accounts', array('username' => $username, 'ip_address' => $ip_address, 'block_time' => current_time('mysql')));
                setcookie('login_attempts', 0, time() + 1800, '/', COOKIE_DOMAIN);
                wp_die(__('Trop de tentatives de connexion infructueuses. Réessayez dans 30 minutes.', 'Webbyrom_secure_connection'), __('Erreur de connexion', 'Webbyrom_secure_connection'));
            } else {
                setcookie('login_attempts', $attempts, time() + (300 * $attempts), '/', COOKIE_DOMAIN);
                $remaining_attempts = 5 - $attempts;
                wp_die(__('Nom d\'utilisateur ou mot de passe incorrect. Vous avez encore ' . $remaining_attempts . ' essai(s) avant le blocage.' . '<br>' . 'Veuillez fermer la page et recommencer.', 'Webbyrom_secure_connection'), __('Erreur de connexion', 'Webbyrom_secure_connection'));
            }
        } else {
            setcookie('login_attempts', 1, time() + 300, '/', COOKIE_DOMAIN);
            wp_die(__('Nom d\'utilisateur ou mot de passe incorrect. Vous avez encore 4 essais avant le blocage.' . '<br>' . 'Veuillez fermer la page et recommencer.', 'Webbyrom_secure_connection'), __('Erreur de connexion', 'Webbyrom_secure_connection'));
        }
    }

    public function check_login_status($user, $username, $password)
    {
        global $wpdb;
        $ip_address = $_SERVER['REMOTE_ADDR'];

        $blocked_account = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$wpdb->prefix}blocked_accounts WHERE username = %s", $username));

        if ($blocked_account) {
            return new WP_Error('blocked_account', __('Compte bloqué. Veuillez réessayer dans 30 minutes ou contactez l\'administrateur.', 'Webbyrom_secure_connection'));
        }

        // Vérifie si le compte est bloqué
        if (isset($_COOKIE['login_attempts']) && intval($_COOKIE['login_attempts']) >= 5) {
            return new WP_Error('blocked_account', __('Compte bloqué. Veuillez réessayer dans 30 minutes ou contactez l\'administrateur.', 'Webbyrom_secure_connection'));
        }
        return $user;
    }

    public function display_blocked_message()
    {
        if (isset($_GET['Webbyrom_secure_connection_blocked']) && intval($_GET['Webbyrom_secure_connection_blocked']) > 0) {
            $remaining_time = intval($_GET['Webbyrom_secure_connection_blocked']);
            $minutes = floor($remaining_time / 60);
            $seconds = $remaining_time % 60;
            $message = sprintf(__('Trop de tentatives de connexion infructueuses. Réessayez dans %d minutes et %d secondes.', 'Webbyrom_secure_connection'), $minutes, $seconds);

            // Vérifie si l'utilisateur a déjà dépassé le nombre maximum de tentatives de connexion
            $max_attempts_reached = isset($_COOKIE['login_attempts']) && intval($_COOKIE['login_attempts']) >= 5;

            // Vérifie si le formulaire de connexion a été soumis avec de nouvelles informations de connexion
            $form_submitted = isset($_POST['log']) && isset($_POST['pwd']);

            // Vérifie si l'utilisateur a été redirigé après dépassé le nombre maximum de tentatives de connexion
            $redirected_after_max_attempts = isset($_SESSION['login_redirect_after_max_attempts']);

            if (!$max_attempts_reached || ($form_submitted && !$redirected_after_max_attempts)) {
                echo '<p class="error">' . $message . '</p>';
            }

            // Stocke le fait que l'utilisateur a été redirigé après dépassé le nombre maximum de tentatives de connexion
            if ($max_attempts_reached && $form_submitted && !$redirected_after_max_attempts) {
                $_SESSION['login_redirect_after_max_attempts'] = true;
            }
        }
    }
}

$Webbyrom_secure_connection_admin = new Webbyrom_secure_connection_Admin();

// ... (fonctions à rajouter?)
