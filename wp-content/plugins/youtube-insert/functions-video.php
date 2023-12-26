<?php
defined('ABSPATH') or die(exit);
// Fonction d'initialisation spécifique au plugin

function youtube_insert_init() {
    // Créez la page d'administration personnalisée
    function ajouter_page_admin_videos() {
        add_menu_page(
            'Ajouter des Vidéos YouTube',
            'Ajouter Vidéos',
            'manage_options', // Capacité requise pour accéder à cette page
            'page-admin-videos',
            'afficher_page_admin_videos',
            'dashicons-video-alt' // Icône du menu
        );
    }
    add_action('admin_menu', 'ajouter_page_admin_videos');

    // Vérifie si l'ID de la vidéo est valide
    function est_id_video_valide($video_id) {
        return preg_match('/^[A-Za-z0-9_-]{11}$/', $video_id) === 1;
    }

    // Vérifie si une vidéo avec le même ID existe déjà
    function video_existe_deja($video_id) {
        $videos = get_posts(array(
            'post_type' => 'video',
            'meta_key' => 'video_id',
            'meta_value' => $video_id,
            'numberposts' => 1,
        ));
        return !empty($videos);
    }

    // Définit l'état de la vidéo
    function definir_etat_video($video_id, $etat) {
        update_option('video_etat_' . $video_id, $etat);
    }

    // Affiche la page d'administration
    function afficher_page_admin_videos() {
        if (isset($_POST['submit_video'])) {
            $video_id = sanitize_text_field($_POST['video_option']);
            $video_title = sanitize_text_field($_POST['video_title']);

            if (est_id_video_valide($video_id)) {
                if (!video_existe_deja($video_id)) {
                    $post_id = wp_insert_post(array(
                        'post_title' => $video_title, // Titre facultatif
                        'post_type' => 'video', // Le type de post personnalisé 
                        'post_status' => 'publish',
                    ));

                    update_post_meta($post_id, 'video_id', $video_id);
                    definir_etat_video($video_id, 'ajoutee');
                    echo '<div class="Nvh-video-admin updated"><p>Vidéo ajoutée avec succès !</p></div>';
                } else {
                    echo '<div class="Nvh-video-admin-error error"><p>Erreur : Une vidéo avec le même ID existe déjà.</p></div>';
                }
            } else {
                echo '<div class="error"><p>Erreur : ID de vidéo YouTube non valide.</p></div>';
            }
        }
        ?>
        <div class="Nvh-admin-form-vide wrap">
            <h1>Ajouter des Vidéos YouTube</h1>
            <form method="post" action="">
                <label for="video_option">ID de la vidéo YouTube :</label>
                <input type="text" name="video_option" id="video_option" required>
                
                <label for="video_title">Titre :</label>
                <input type="text" name= "video_title" id="video_title" required>
                
                <input type="submit" name="submit_video" class="button button-primary" value="Ajouter la vidéo">
            </form>

            <h2>Liste des Vidéos YouTube</h2>
            <table class="wp-list-table widefat fixed striped">
                <thead>
                    <tr>
                        <th>ID de la Vidéo</th>
                        <th>Titre</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $videos = get_posts(array(
                        'post_type' => 'video',
                        'numberposts' => -1,
                    ));

                    foreach ($videos as $video) {
                        $video_id = get_post_meta($video->ID, 'video_id', true);
                        $video_title = $video->post_title;

                        echo '<tr>';
                        echo '<td>' . esc_html($video_id) . '</td>';
                        echo '<td>' . esc_html($video_title) . '</td>';
                        echo '<td><a href="#" class="Nvh-supprimer-video" data-video-id="' . esc_attr($video_id) . '">Supprimer</a></td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <?php
    }

    function get_enregistred_video_options_ajax() {
        $video_options = get_enregistred_video_options();
        wp_send_json($video_options);
    }
    
    
    function get_enregistred_video_options() {
        $video_posts = get_posts(array(
            'post_type' => 'video',
            'numberposts' => -1,
        ));
    
        $video_options = array();
    
        foreach ($video_posts as $video_post) {
            $video_id = get_post_meta($video_post->ID, 'video_id', true);
            $video_title = $video_post->post_title;
    
            $video_options[] = array(
                'id' => $video_id,
                'title' => $video_title,
            );
        }
    
        return $video_options;
    }
    

    // Fonction pour supprimer une vidéo
    function supprimer_video($video_id) {
        $video_posts = get_posts(array(
            'post_type' => 'video',
            'meta_key' => 'video_id',
            'meta_value' => $video_id,
        ));

        if (!empty($video_posts)) {
            foreach ($video_posts as $video_post) {
                $video_post_id = $video_post->ID;
                wp_delete_post($video_post_id, true); // Le deuxième argument "true" supprime définitivement le post
                // Supprimez l'état de la vidéo
                definir_etat_video($video_id, 'supprimee');
            }
        }
    }

    // Ajoutez une action pour gérer la suppression de la vidéo
    if (isset($_GET['action']) && $_GET['action'] === 'supprimer_video' && isset($_GET['video_id'])) {
        $video_id_a_supprimer = sanitize_text_field($_GET['video_id']);

        // Valider l'ID de la vidéo
        if ($video_id_a_supprimer) {  // if(is_numeric($video_id_a_supprimer)) empêche la suppression
            // supression de  la vidéo
            supprimer_video($video_id_a_supprimer);

            // Redirigez l'utilisateur vers la page d'administration après la suppression
            wp_safe_redirect(admin_url('admin.php?page=page-admin-videos'));
            exit;
        }else {
            echo '<div class="Nvh-error-id"><p> Erreur: ID de la vidéo n\'est pas valide</p></div> ';
        };
}
}
//  action pour initialiser le plugin
add_action('init', 'youtube_insert_init');

add_shortcode('youtube_video', 'shortcode_video_youtube');

// action pour gérer la requête AJAX
add_action('wp_ajax_get_enregistred_video_options', 'get_enregistred_video_options_ajax');
add_action('wp_ajax_get_enregistred_video_ids', 'get_enregistred_video_ids_ajax');
