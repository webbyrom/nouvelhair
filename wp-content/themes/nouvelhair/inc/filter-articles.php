<?php
defined('ABSPATH') or die('');
//session_start();
/*****************
 * filtre des articles
 * 
 * 
 */
//version fonctionnelle
add_action('wp_ajax_filter_articles', 'filter_articles');
add_action('wp_ajax_nopriv_filter_articles', 'filter_articles');
function filter_articles()
{
    $filter = $_POST['filter'];
    $paged = get_query_var('paged') ? get_query_var('paged') : 1;
    // $post_per_page = 4;

    if ($filter === 'all') {
        // Récupère tous les articles sans filtre
        $args = array(
            'post_type' => 'post',
            'posts_per_page' => -1,
            'orderby' => 'post_date',
            'order' => 'ASC',
            'paged' => $paged,
            'post_status' => 'publish',
            //'post_excerpt'=> true,
        );
    } else {
        // Filtre les articles en fonction de la catégorie sélectionnée
        $args = array(
            'post_type' => 'post',
            'posts_per_page' => -1,
            'paged' => $paged,
            'post_status' => 'publish',
            'orderby' => 'post_date',
            'order' => 'ASC',
            'tax_query' => array(
                array(
                    'taxonomy' => 'category',
                    'field' => 'slug',
                    'terms' => $filter,
                ),
            ),
            //'post_excerpt' => true,// ajout de la prise en charge de l'extrait des articles
        );
    }

    $query = new WP_Query($args);
    //if (have_posts()) :
    ob_start();
    while ($query->have_posts()) : $query->the_post();
        // Affichez ici le contenu des articles filtrés selon votre mise en page
        get_template_part('template-parts/post');
    endwhile;
    //endif;
    //echo Nvh_pagination();
    wp_reset_postdata();
    $output = ob_get_clean();
    echo $output;

    wp_die(); // Termine la requête AJAX
}


/*
 // version d'essai pour la mise en cache

add_action('wp_ajax_filter_articles', 'filter_articles');
add_action('wp_ajax_nopriv_filter_articles', 'filter_articles');
function filter_articles() {
  $filter = $_POST['filter'];

  // Générer une clé de cache unique en fonction du filtre utilisé
  $cache_key = 'filtered_articles_' . md5( serialize( $filter ) );

  // Vérifier si les résultats sont déjà en cache
  $cached_results = wp_cache_get( $cache_key );

  if ( false !== $cached_results ) {
    echo $cached_results; // Récupérer les résultats en cache
    wp_die(); // Termine la requête AJAX
  }

  if ($filter === 'all') {
    // Récupère tous les articles sans filtre
    $args = array(
      'post_type' => 'post',
      'posts_per_page' => -1,
      'post_status' => 'publish',
    );
  } else {
    // Filtre les articles en fonction de la catégorie sélectionnée
    $args = array(
      'post_type' => 'post',
      'posts_per_page' => -1,
      'post_status' => 'publish',
      'tax_query' => array(
        array(
          'taxonomy' => 'category',
          'field' => 'slug',
          'terms' => $filter,
        ),
      ),
    );
  }

  $query = new WP_Query($args);
  ob_start();
  while ($query->have_posts()) : $query->the_post();
    // Affichez ici le contenu des articles filtrés selon votre mise en page
    get_template_part('template-parts/post');
  endwhile;
  wp_reset_postdata();
  $output = ob_get_clean();

  // Mettre en cache les résultats pour une durée spécifique (par exemple, 1 heure)
  wp_cache_set( $cache_key, $output, '', 3600 );

  echo $output;

  wp_die(); // Termine la requête AJAX
}
*/
