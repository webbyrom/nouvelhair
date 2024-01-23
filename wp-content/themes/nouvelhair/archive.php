<?php

/**
 * Template Name: Archive post(affichage de toute les posts)
 * Theme: Nouvel Hair
 * Version: 1.0.5
 * Author: Romain Fourel
 * 
 * 
 */

get_header(); ?>
<section class="Nvh-post-archive container-fluid">
    <div class="Nvh-archive-post container-fluid">
        <!----------Slider Here--------->

    </div>
</section>
<section class="Nvh-content-post-archive container-fluid">
    <h1 class="Nvh-post-archive-title"><?php echo esc_html(get_bloginfo('name')); ?><?php the_title('-'); ?></h1>
    <div class="underlining">
        <span class="Nvh-border-bottom"></span>
    </div>
</section>
<section class="Nvh-news container-fluid">
    <?php
    // Get the posts
    $category = get_queried_object(); //le tri se fait sur la catégory de l'object
    if ($category) :
        $args = [
            'category' => $category->term_id,
            'posts_per_page' => -1,
            'post_status' => 'publish',
            'orderby' => 'DESC'
        ];
        $posts = get_posts($args);
    endif;
    // Loop through the posts
    if ($posts) :
        $count = 0; // initialisation à 0
        foreach ($posts as $post) :
            setup_postdata($post);
            $count++;

            // Get the post thumbnail
            $thumbnail = get_the_post_thumbnail($post, 'Nvh-post-archive', [
                'class' => 'Nvh-img-post-archive rounded',
                'title' => "Nouvel'hair salon de coiffure saint Symphorien sur Coise"
            ]);

            // Get the post description
            $description = get_field('description_du_produit');

            // Get the post price
            $price = get_field('prix');
            $article_classes = 'Nvh-post-archive container-fluid';
            if ($count % 2 === 0) {
                $article_classes .= ' Nvh-reverse-align';
            }

    ?>
            <article class="<?php echo $article_classes; ?>">
                <a href="<?php the_permalink(); ?>" rel="bookmark">
                    <h2 class="title-archive-post"><?= the_title() ?></h2>
                </a>
                <div class="Nvh-archive-content container-fluid">
                    <div class="Nvh-single-archive-img container">
                        <?php echo $thumbnail; ?>
                    </div>
                    <div class="Nvh-single-article container-fluid">
                        <div class="Nvh-archive-post container">
                        <span class="Nvh-archive-post-subtitle"><?= get_the_date(); ?></span>
                            <?php if (!empty($description)) : ?>
                                <p class="Nvh-archive-description container"><?php echo $description; ?></p>
                            <?php endif; ?>
                            
                            <div class="Nvh-single-price Nvh-archive-post-price container">
                                <?php if (!empty($price)) : ?>
                                    <span class="Nvh-arch-post-price"><?php echo $price; ?> € ttc</span>
                                <?php endif; ?>
                            </div>
                        </div><!-----fin du texte--->
                    </div>
                </div>
            </article>
        <?php endforeach; ?>
        <?php wp_reset_postdata(); ?>
    <?php endif; ?>
</section>
<div class="Nvh-espacement container-fluid"></div>
<?php get_footer(); ?>