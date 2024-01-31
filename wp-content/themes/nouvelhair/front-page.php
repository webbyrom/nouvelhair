<?php

/**
 *Template Name: Home page
 *
 * @author     Romain Fourel
 * @subpackage Theme Nouvel Hair
 * @since     1.0.3
 */

defined('ABSPATH') || die;
session_start();

get_header() ?>

<div class="Nvh-news-full container-fluid">
    <div class="Nvh-home-slider container-fluid">
        <!----slider here----->
        <?php add_revslider('futuristic-hairstyles-slider1'); ?>

    </div>
</div>

<div class="container-fluid Nvh-news">
    <h1 class="Nvh-coiffure-title"><?php echo esc_html(get_bloginfo('name')) . ' - ' . esc_html(get_the_title()); ?></h1>

    <div class="underlining">
        <span class="Nvh-border-bottom"></span>
    </div>
    <div class="Nvh-home container-fluid text-center" id="Nvh_home">
        <div class="Nvh-presentation container-fluid">
            <div class="Nvh-bubble" id="Nvh_bubble1"></div>
            <div class="Nvh-bubble" id="Nvh_bubble2"></div>
            <div class="Nvh-bubble" id="Nvh_bubble3"></div>
            <div class="Nvh-cadre container-fluid">
                <div class="Nvh-col-prez-img container-fluid">
                    <!---------------------- partie présentation du salon ----------->
                    <?php
                    //récupération de l'id de l'image du champ acf'img-presentation'
                    $imageId = get_field('img-presentation');

                    if (!empty($imageId)) : ?>
                        <div class="Nvh-prz circle-container container-fluid">
                        </div>
                        <div class="Nvh-prz-img circle-img">
                            <img src="<?php echo esc_url($imageId); ?>" class="Nvh-img-presentation" alt="<?= esc_attr($imageId) ?>">
                        </div>

                    <?php endif; ?>
                </div>
                <div class="Nvh-col-prez-text container-fluid">
                    <div class="text-home container-fluid"><!----coté droit pour le texte--->
                        <?php
                        $textPrez = get_field('description_du_salon');
                        if (!empty($textPrez)) : ?>
                            <div class="text-prez container-fluid">
                                <p><?= $textPrez ?></p>
                            </div>
                        <?php endif; ?>
                        <button type="button" class="btn btn-light Nvh-btn-qsj"><a href="https://nouvelhair.web-byrom.com/qui-suis-je/" class="bouton Nvh-button-salon" target="_blank">Ambiance du Salon<a></button>
                    </div>
                    <div id="Nvh_part_anchor"></div>
                </div>
            </div>
            <div class="title-home-filter">
                <h2 class="title-produits" id="produits_anchor">Les Produits disponibles en Salon</h2>
            </div>
            <div class="underlining">
                <span class="Nvh-border-bottom"></span>
            </div>
            <div class="Nvh-filter container-fluid">
                <!---------début filtre------>
                <button class="filter-button show-all-button" data-filter="all">Tout Afficher</button>
                <?php
                $categories = get_categories(); // Récupère toutes les catégories
                foreach ($categories as $category) {
                    echo '<button class="filter-button" data-filter="' . $category->slug . '">' . $category->name . '</button>';
                }
                ?>
                <!---------fin filtre------>

            </div>
            <div class="Nvh-post-content overflow-hidden filtered-articles container-fluid" id="Nvh_post_content">
                <?php
                // $paged = get_query_var('paged') ? get_query_var('paged') : 1;

                $args = array(
                    'post_type' => 'post', // Type de contenu (articles)
                    //'posts_per_page' => 4, // Nombre d'articles à afficher (-1 pour tous)
                    'post_status' => 'publish',
                    // 'orderby'    => 'post_date',
                    //  'order'  => 'ASC',
                    'paged' => get_query_var('paged'),

                );
                $query = new WP_Query($args);

                if (have_posts()) :
                    ob_start();
                    while ($query->have_posts()) : $query->the_post();
                        // Affichez ici le contenu des articles 
                        get_template_part('template-parts/post');
                    endwhile;
                endif;
                // Ajoutez la pagination
                ob_end_flush();
                wp_reset_postdata();
                ?>
            </div>
        </div>
    </div>
    <div class="Nvh-espacement container-fluid"></div>
</div>
<?php get_footer() ?>