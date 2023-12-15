<?php
/**
 * Plugin Name:Youtube insert vidéo 
 * Plugin URI: https://web-byrom.com
 * Description: Plugin permettant l'insertion de vidéo youtube 
 * Version: 1.1.5
 * Author: Romain Fourel
 * Author URI: https://web-byrom.com
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Requires at least: 6.0.0
 * Tested up to: 6.2.2
 * Requires PHP: 8.0
 * Tags: Vidéo 
 * Stable tag: 1.0
 */



// Enregistrement des scripts et des styles

require_once(plugin_dir_path(__FILE__) . 'functions-video.php');

function enregistrer_scripts_et_styles() {
    // Enregistrement de TinyMCE
    wp_enqueue_script('tinymce', includes_url('js/tinymce/tinymce.min.js'));

    // Enregistrement du CSS admin
    wp_enqueue_style('styles-admin', plugins_url('/assets/admin.css', __FILE__));

    // Enregistrement du script pour l'insertion de vidéos YouTube
    wp_enqueue_script('Pdj_youtube_insert_video', plugin_dir_url(__FILE__) . '/assets/js/video-functions.js', array('tinymce', 'jquery'), '1.0', true);
   // wp_enqueue_script('PDj_insert_tinymce_video', plugin_dir_url(__FILE__) . '/assets/js/youtube-insert-tinymce.js', array('tinymce'), '1.0', true);
}

add_action('admin_enqueue_scripts', 'enregistrer_scripts_et_styles');
// Définition de la fonction de rappel pour le shortcode
function shortcode_video_youtube($atts) {
    // Attributs du shortcode
    $atts = shortcode_atts(
        array(
            'id'    => '', // ID de la vidéo YouTube
            'title' => '', // Titre de la vidéo (facultatif)
        ),
        $atts,
        'youtube_video'
    );

    // Extrait les attributs
    $video_id  = sanitize_text_field($atts['id']);
    $video_title = $atts['title'];

    // Logique pour générer le contenu du shortcode
    $output = '<div class="youtube-video">';
    $output .= '<iframe width="560" height="315" src="https://www.youtube.com/embed/' . esc_attr($video_id) . '" frameborder="0" allowfullscreen></iframe>';
    $output .= '<p>' . esc_html(stripslashes($video_title)) . '</p>';
    $output .= '</div>';

    return $output;
}

// Enregistrement du shortcode
add_shortcode('youtube_video', 'shortcode_video_youtube');


function ajouter_bouton_tinymce($buttons) {
    array_push($buttons, 'youtube_button');
    return $buttons;
}

function ajouter_plugin_tinymce($plugin_array) {
    $plugin_array['youtube_button'] = plugin_dir_url(__FILE__) . '/assets/js/video-functions.js';
    return $plugin_array;
}

function ajouter_bouton_tinymce_editeur() {
    if (current_user_can('edit_posts')) {
        add_filter('mce_buttons', 'ajouter_bouton_tinymce');
        add_filter('mce_external_plugins', 'ajouter_plugin_tinymce');
    }
}

add_action('admin_init', 'ajouter_bouton_tinymce_editeur');

function afficher_fenetre_modale_tinymce() {
    $video_options = get_enregistred_video_options();
    ?>
    <div id="video-modal-content">
        <label for="video_option">Sélectionnez une vidéo :</label>
        <select name="video_option" id="video_option" required>
            <?php
            foreach ($video_options as $video) {
                echo '<option value="' . esc_attr($video['id']) . '">' . esc_html($video['title']) . '</option>';
            }
            ?>
        </select>
        
        <label for="video_title">Titre :</label>
        <input type="text" name="video_title" id="video_title">
    </div>
    <?php
}

// Fonction de désactivation du plugin
function desactivation_du_plugin() {
    $videos = get_posts(array(
        'post_type' => 'video',
        'numberposts' => -1,
    ));

    foreach ($videos as $video) {
        $video_id = get_post_meta($video->ID, 'video_id', true);
        delete_option('video_etat_' . $video_id);
        wp_delete_post($video->ID, true);
    }
}

register_deactivation_hook(__FILE__, 'desactivation_du_plugin');
