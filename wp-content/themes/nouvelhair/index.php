<?php

/****
 * Theme : Nouvel'Hair
 * Template Name : Tous les Produits
 * Version: 1.0.4
 * 
 */
 session_start();
?>
<? defined('ABSPATH') or die('Exit!'); ?>

<?php get_header() ?>
<div class="Nvh-news-full">
    <div class="Nvh-home-slider">
        <!----slider here----->
        <?php add_revslider('slider-2'); ?>

    </div>
</div>

<div class="container-fluid Nvh-news">
    <h1 class="Nvh-coiffure-title"><?php esc_html(single_post_title()); ?></h1>

    <div class="underlining">
        <span class="Nvh-border-bottom"></span>
    </div>
    <div class="Nvh-home container-fluid">


        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <!-----créer front des posts pour un template pleine page---->
                <?php get_template_part('template-parts/post-single'); ?>
            <?php endwhile; ?>
        <?php else : ?>
            <h2 class="Nvh-post"><?= __('Pas d\'article', 'nouvelhair') ?></h2>
           
        <?php endif; ?>
        <div id="Nvh_partner_anchor"></div>
        <?= Nvh_pagination(); ?>
           
    </div>

</div>
<!-------------section pour les partenairs------>
<section class="Nvh-partner container-fluid">
    <div class="Nvh-partner-title">
        <h3 class="nvh-title-partner">Mes Partenaires</h3>
        <div class="underlining">
        <span class="Nvh-border-bottom"></span>
    </div>
    </div>
    <div class="Nvh-partner-content container-fluid">
    <?php 
    $args_partner = array(
        'post_type' => 'partenaire',
        'post_status' => 'publish',
        'post_per_page' => -1,
        'orderby' => 'rand',
        //'order' => 'ASC'
    );
    $random_query = new WP_Query($args_partner);
    if ($random_query->have_posts()){
        while ($random_query->have_posts()){
            $random_query->the_post();
            echo '<div class="card mb-3 Nvh-partner-cardcontent fade-in" style="max-width: 540px;">';
            get_template_part('template-parts/partner');
            echo '</div>';
        }
        wp_reset_postdata();

    }else {
        echo '<h4>'. 'La liste de nos partenaies sera bientôt disponibles ici' . '</h4>';
    }
     ?>
 </div>
</section>
<?php get_footer() ?>