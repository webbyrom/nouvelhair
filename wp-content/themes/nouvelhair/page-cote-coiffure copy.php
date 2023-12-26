<?php

/**
 * Template Name: Côté coiffure
 * Theme: Nouvel'hair
 * Version: 1.0.0
 * Author: Romain / Webbyrom
 */
defined('ABSPATH') or exit;

get_header();
?>

<section class="Nvh-cote-coiffure container-fluid">
    <div class="Nvh-cote-coiffure-slider container-fluid">
        <?php add_revslider('slider-1'); ?>
    </div>
</section>
<div class="container-fluid Nvh-news">
    <section class="Nvh-cotef-title container">
        <div class="Nvh-title-cotf container">
            <h1 class="Nvh-coifc-title container">
                <?php echo esc_html(get_bloginfo('name')) . ' - ' . esc_html(get_the_title()); ?>
            </h1>
        </div>
        <div class="underlining">
            <span class="Nvh-border-bottom"></span>
        </div>
    </section>

    <section class="Nvh-cote-coiffure container-fluid">
        <div class="Nvh-cooiffure-title container-fluid">
            <h2 class="NVh-title-coiffure">Coupes Femmes</h2>
            <div class="underlining">
                <span class="Nvh-border-bottom"></span>
            </div>
        </div>
        <div class="Nvh-coiffure-post container-fluid">
            <?php
            $term = 'femmes';
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

                    wp_reset_postdata();
                }
            } else {
                echo 'Rien à afficher ici.';
            }
            ?>

        </div>
    </section>
    <section class="Nvh-cote-coiffure container-fluid">
        <div class="Nvh-cooiffure-title container-fluid">
            <h2 class="NVh-title-coiffure">Coupes Enfants</h2>
            <div class="underlining">
                <span class="Nvh-border-bottom"></span>
            </div>
        </div>
        <div class="Nvh-coiffure-post container-fluid">
            <?php
            $term = 'enfants';
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

                    wp_reset_postdata();
                }
            } else {
                echo 'Rien à afficher ici.';
            }
            ?>

        </div>
    </section>
    <section class="Nvh-cote-coiffure container-fluid">
        <div class="Nvh-cooiffure-title container-fluid">
            <h2 class="NVh-title-coiffure">Coupes Hommes</h2>
            <div class="underlining">
                <span class="Nvh-border-bottom"></span>
            </div>
        </div>
        <div class="Nvh-coiffure-post container-fluid">
            <?php
            $term = 'hommes';
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

                    wp_reset_postdata();
                }
            } else {
                echo 'Rien à afficher ici.';
            }
            ?>

        </div>
    </section>
    <section class="Nvh-cote-coiffure container-fluid">
        <div class="Nvh-cooiffure-title container-fluid">
            <h2 class="NVh-title-coiffure">Coupes Adolescents</h2>
            <div class="underlining">
                <span class="Nvh-border-bottom"></span>
            </div>
        </div>
        <div class="Nvh-coiffure-post container-fluid">
            <?php
            $term = 'adolescents';
            $results = get_coiffure_posts_by_term($term);

            if ($results) {
                foreach ($results as $post) {
                    setup_postdata($post);
                    $textchamps = get_post_meta($post->ID, 'descriptif_coiffure', true);
                    $Pricecoupe = get_post_meta($post->ID, 'tarif_de_la_coupe_', true);
                    $imgcoupe   = get_post_meta($post->ID, 'photo_coupes_de_cheveux', true);
                    var_dump($imgcoupe); die;

                    if (!empty($textchamps) && !empty($imgcoupe)) {
                        get_template_part('template-parts/coiffure-block');
                    }

                    wp_reset_postdata();
                }
            } else {
                echo 'Rien à afficher ici.';
            }
            ?>
        </div>
    </section>
</div>
<?php get_footer(); ?>