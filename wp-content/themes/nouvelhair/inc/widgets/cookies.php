<?php
/**
 * Plugin Name: GDPR Cookie Banner
 * Description: This plugin adds a cookie banner to your WordPress site in accordance with the GDPR.
 * Author: Romain Fourel
 * Author URI: https://www.web-byrom.com/
 * Version: 1.1
 */

class GDPR_Cookie_Banner_Widget extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'gdpr_cookie_banner_widget',
            'GDPR Cookie Banner',
            array(
                'description' => 'Displays a cookie banner for GDPR compliance.'
            )
        );

        add_action( 'wp_footer', array( $this, 'render_cookie_banner' ) );
        add_action( 'wp_loaded', array( $this, 'handle_cookie_consent' ) );
    }

    public function widget( $args, $instance ) {
        // Widget output
    }

    public function form( $instance ) {
        // Widget form
    }

    public function update( $new_instance, $old_instance ) {
        // Save widget settings
    }

    public function render_cookie_banner() {
        ?>
        <div id="cookie-banner" <?php echo $this->get_cookie_banner_visibility(); ?>>
            <p>This website uses cookies to improve your experience. By continuing to use this website, you agree to our use of cookies.</p>
            <a href="#">Learn more about our cookies policy</a>
            <div class="cookie-consent">
                <h3>Cookie consent</h3>
                <ul>
                    <li>
                        <input type="checkbox" name="analytics" id="analytics">
                        <label for="analytics">Analytics cookies</label>
                    </li>
                    <li>
                        <input type="checkbox" name="marketing" id="marketing">Marketing cookies</li>
                    <li>
                        <input type="checkbox" name="social" id="social">Social media cookies</li>
                </ul>
                <input type="submit" value="Save" onclick="saveCookieConsent();">
            </div>
        </div>
    
        <script>
        function saveCookieConsent() {
            // Make an AJAX request to save the cookie consent settings
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '<?php echo admin_url( 'admin-ajax.php' ); ?>');
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    // If the request is successful, hide the cookie banner
                    var cookieBanner = document.getElementById('cookie-banner');
                    if (cookieBanner) {
                        cookieBanner.style.display = 'none';
                    }
                }
            };
            xhr.send('action=save_cookie_consent&cookie_consent=yes');
        }
        </script>
        <?php
    }
    
    public function handle_cookie_consent() {
        $consent = isset( $_COOKIE['cookie_consent'] ) ? $_COOKIE['cookie_consent'] : 'no';
    
        if ( $consent === 'yes' ) {
            add_action( 'wp_footer', array( $this, 'render_accepted_consent_message' ) );
        } else {
            add_action( 'wp_footer', array( $this, 'render_not_accepted_consent_message' ) );
        }
    
        // Save cookie consent settings.
        if ( isset( $_POST['action'] ) && $_POST['action'] === 'save_cookie_consent' ) {
            $consent = sanitize_text_field( $_POST['cookie_consent'] );
            setcookie( 'cookie_consent', $consent, strtotime( '+1 hours' ), '/' );
            wp_send_json_success();
        }
    }
    
    public function render_accepted_consent_message() {
        echo '<div class="cookie-accepted">You have accepted the cookie consent.</div>';
    }
    
    public function render_not_accepted_consent_message() {
        echo '<div class="cookie-not-accepted">Please accept the cookie consent.</div>';
    }
    
    public function get_cookie_banner_visibility() {
        $consent = isset( $_COOKIE['cookie_consent'] ) ? $_COOKIE['cookie_consent'] : 'no';
        $visibility = $consent === 'yes' ? 'style="display: none;"' : '';
        return $visibility;
    }
}    