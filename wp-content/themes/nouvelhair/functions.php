<?php
defined('ABSPATH') or die('');
/**
 * Functions and definitions
 * 
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package Wordpress
 * @subpackage Nouvel'Hair
 * @since Nouvel'Hair 1.0
 * 
 * 
 */

/*******
 * fichiers necessaires
 * 
 */
require_once('inc/assets.php');
require_once('inc/menus.php');
require_once('inc/appearance.php');
require_once('inc/filter-articles.php');
require_once('inc/enqueue-scripts.php');
require_once('inc/query/posts.php');
require_once('inc/images-size.php');
require_once('inc/horaires/horaires.php');
NvhHoraire::register();

add_action('after_setup_theme', function () {
    add_theme_support('title-tag');
    add_theme_support('menus');
    add_theme_support('html5', [
        'comment-list',
        'comment-form',
        'search-form',
        'gallery',
        'caption',
        'style',
        'script',
        'navigation-widgets'
    ]);
    add_theme_support('post-thumbnails');
    add_theme_support('post-formats', array(
        'aside',
        'gallery',
        'link',
        'quote',
        'audio',
        'image',
        'status'
    ));
    add_theme_support('custom-header');
    add_theme_support('automatic-feed-links');
    add_theme_support('wp-block-styles');
    add_theme_support('custom-logo', array(
        'heigth'    => 100,
        'width' => 400,
        'flex-height'   => true,
        'flex-width'    => true,
        'header-text'   => array('site-title', 'site-description')
    ));
    // Add theme support for selective refresh for widgets.
    add_theme_support('customize-selective-refresh-widgets');

    //Add support for full and wide align images
    add_theme_support('align-wide');
});
/********
 * Allow SVG donwload
 */


/**
 * Filters the list of allowed mime types and file extensions.
 *
 * @param array             $t    Mime types keyed by the file extension regex corresponding to those types.
 * @param int|\WP_User|null $user User ID, User object or null if not provided (indicates current user).
 * @return array Mime types keyed by the file extension regex corresponding to those types.
 */
add_filter('upload_mimes', function ($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
});

/*******
 * function title 
 */

function Nvh_title($title)
{
    return $title .= get_bloginfo('name', 'description');
}

add_filter('wp_title', 'Nvh_title');

function Nvh_title_separator($sep)
{
    $new_sep = "|";
    return $new_sep;
   
}
add_filter('document_title_separator', 'Nvh_title_separator',10, 1);

/***
 * icon reseaux sociaux du footer
 */
function Nvh_icon(string $name): string
{
    $spriteUrl = get_template_directory_uri() . '/assets/logo/logo-reseaux.svg';
    return <<<HTML
    <svg class="icon"><use xlink:href="{$spriteUrl}#{$name}"></use></svg>
    HTML;
}

/***
 * create function the excerpt to a different file
 * 
 * Filter the except length to 20 words.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */

function Nvh_custom_excerpt_length($text, $length = 20) {
    $exceprt = wp_trim_words($text, $length);
    //$read_more_link = '<a href="'. get_permalink(). '" class="read-more-link">Lire la suite <i class="fas fa-arrow-right"></i></a>';
   // return wp_kses_post($exceprt. ' ' . $read_more_link);
   return wp_kses_post($exceprt);
}
add_filter('excerpt_length', 'Nvh_custom_excerpt_length', 999);

function Nvh_modify_read_more_link($more) {
    if (!is_single()) {
        $more_link = sprintf('<a href="%s" class="more-link">%s</a>', get_permalink(), __('Lire la suite', 'nouvelhair'));
        return $more_link;
    } else {
        return $more; // Utilise le texte de "Lire la suite" par défaut
    }
}
add_filter('excerpt_more', 'Nvh_modify_read_more_link');




// Supprimer l'avertissement lors de la vérification des mises à jour des plugins
$result = @wp_update_plugins();

if (is_wp_error($result)) {
    // afficher un message d'erreur 
    echo 'impossible de vérifier les mises à jour pour le moment';
}
/******
 * fonction de la pagination
 * 
 * 
 * 
 */
function Nvh_pagination () {
    global $wp_query;
    echo '<nav class="Page navigation" aria-label="Page navigation">';
    echo '<ul class="pagination justify-content-center">';
    $pages = paginate_links();

    if ($pages) {
        $pages = explode("\n", $pages); // Divisez les éléments en un tableau

        foreach ($pages as $page) {
            $active = strpos($page, 'current') !== false;
            $class = 'page-item';
            if ($active){
                $class .= ' active';
            }
            echo '<li class="' . $class . ' p-1">';
            echo str_replace('page-numbers', 'page-link', $page);
            echo '</li>';
        }
    }

    echo '</ul>';
    echo '</nav>';
}

function Nvh_custom_paginate_single() {
    $previous_post = get_previous_post();
    $next_post = get_next_post();
    $output = '' ;

    if ($previous_post) {
        $previous_post_img_url = get_field('image_du_soin', $previous_post->ID);
        if ($previous_post_img_url) {
            $previous_post_title = get_the_title($previous_post);
            //$output .= '<p>'. $previous_post_title .'</p>';
            $output .= '<div class ="Nvh-paginate-snpp">'. '<a class="Nvh-paginate-link-single" href="'. get_permalink($previous_post).'">'. '<span class=" dashicons dashicons-arrow-left-alt2"></span>' .'<h5>'. $previous_post_title .'</h5>' .'<img src="'. $previous_post_img_url. '" class="Nvh-pagiante-image image-fluid" alt="Previous Post Image">'.'</a>'.'</div>';
           
        }
        
    }

    if ($next_post){
        $next_post_image_url = get_field('image_du_soin', $next_post->ID);
        if ($next_post_image_url) {
            $next_post_title = get_the_title($next_post);
            $output .= '<div class="Nvh-pagiante-snnp">'.'<a class="Nvh-paginate-link-single" href="'. get_permalink($next_post).'">'. '<img src="'. $next_post_image_url. '"class="Nvh-pagiante-image image-fluid" alt="Next Post Image">'. '<h5>'.$next_post_title.'</h5>'. '<span class=" dashicons dashicons-arrow-right-alt2"></span>'. '</a>' .'</div>';
           // $output .= '<p>'. $next_post_title .'</p>';
        }
    }
    return $output;
}
/*****
 * function pour la page coté coiffure
 * 
 * 
 */
function get_coiffure_posts_by_term($term) {
    $args_coiffure = array(
        'post_type'      => 'coiffure',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'orderby'        => 'title',
        'order'          => 'asc',
        'tax_query'      => array(
            array(
                'taxonomy' => 'coupe',
                'field'    => 'slug',
                'terms'    => $term
            )
        )
    );

    $coiffure_query = new WP_Query($args_coiffure);

    if ($coiffure_query->have_posts()) {
        return $coiffure_query->posts; // Retourne les résultats de la requête
    } else {
        return array(); // Retourne un tableau vide s'il n'y a pas de résultats
    }
}
/*
function display_coiffures_by_term($term) {
    $results = get_coiffure_posts_by_term($term);

    if ($results) {
        foreach ($results as $post) {
            setup_postdata($post);
            $textchamps = get_post_meta($post->ID, 'descriptif_coiffure', true);
            $Pricecoupe = get_post_meta($post->ID, 'tarif_de_la_coupe_', true);
            $imgcoupe   = get_post_meta($post->ID, 'photo_coupes_de_cheveux', true);

            if (!empty($textchamps) && !empty($imgcoupe)) {
                get_template_part('template-parts/coiffure-block');
            }
        }

        wp_reset_postdata(); // Réinitialise les données globales après la boucle
    } else {
        echo 'Rien à afficher ici.';
    }
}

/*****
 * Function de la page Ayurvedique pour afficher les différents soins
 * 
 * 
 * 
 * 
 */

function get_ayurvedique_posts_by_term($term) {
    $args_ayurvedique = array(
        'post_type'      => 'Ayurvedique',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'orderby'        => 'title',
        'order'          => 'asc',
        'tax_query'      => array(
            array(
                'taxonomy' => 'massage',
                'field'    => 'slug',
                'terms'    => $term
            )
        )
    );

    $ayurvedique_query = new WP_Query($args_ayurvedique);

    if ($ayurvedique_query->have_posts()) {
        return $ayurvedique_query->posts; // Retourne les résultats de la requête
    } else {
        return array(); // Retourne un tableau vide s'il n'y a pas de résultats
    }
}
/*
function display_ayurvedique_by_term($term) {
    $results = get_ayurvedique_posts_by_term($term);

    if ($results) {
        foreach ($results as $post) {
            setup_postdata($post);
            //$textchamps = get_post_meta($post->ID, 'descriptif_coiffure', true);
            //$Pricecoupe = get_post_meta($post->ID, 'tarif_de_la_coupe_', true);
            //$imgcoupe   = get_post_meta($post->ID, 'photo_coupes_de_cheveux', true);

            //if (!empty($textchamps) && !empty($imgcoupe)) {
                get_template_part('template-parts/post-ayurvedique');
            }
        }

        wp_reset_postdata(); // Réinitialise les données globales après la boucle
}
*/









/*
// fonction pour le sous menu et les ancres
function add_active_class_to_links() {
    // Liste des pages du site
    $pages = wp_list_pages(array(
        'echo' => false,
        'post_type' => 'page',
        'speed' => 3000,
    ));

    // Itération sur les pages
    foreach ($pages as $page) {
        // Lien vers la page
        $link = '<a href="' . get_permalink($page->ID) . '">' . $page->post_title . '</a>';

        // Ajout de la classe "active" si la page est actuelle
        if (is_page($page->ID)) {
            // Récupération de l'ancre de la page actuelle
            $anchor = get_the_anchor($page->ID);

            // Ajout de la classe "active" si le lien renvoie vers l'ancre sélectionnée
            if ($anchor && $anchor == get_query_var('anchor')) {
                // Vérification si le lien fait partie du menu de second niveau
                if (is_page($page->ID) && has_nav_menu('Nvh-submenu-ul')) {
                    $menu_items = wp_get_nav_menu_items('Nvh-submenu-ul');

                    foreach ($menu_items as $menu_item) {
                        if ($menu_item->object_id == $page->ID) {
                            // Le lien fait partie du menu de second niveau
                            $link .= ' class="Nvh_m_active"';
                        }
                    }
                }
            }
        }

        // Affichage du lien
        echo $link;
    }
}
*/


/*
function Nvh_pagination () {
    echo '<nav class="Page navigation" aria-label="Page navigation ">';
    echo '<ul class="pagination justify-content-center">';
    $pages = paginate_links();
    foreach ( $pages as $page) {
        $active = strpos($page, 'current') !== false;
        $class = 'page-item';
        if ($active){
            $class .= ' active';
        }
        echo '<li class="' . $class . '">';
        echo str_replace('page-numbers', 'page-link', $page);
        echo '</li>';
    }
}
*/