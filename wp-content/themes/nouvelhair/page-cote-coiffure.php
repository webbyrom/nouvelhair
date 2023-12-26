<?php
/**
 * Template Name: Côté coiffure
 * Theme: Nouvel'hair
 * Version: 1.0.4
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

    <?php
    // Retrieve and display hairdressing posts by category
    $categories = get_terms(array(
        'taxonomy' => 'coupe',
        'parent' => 0,
        'orderby' => 'name',
        'order' => 'ASC',
    ));

    foreach ($categories as $category) {
        $category_slug = $category->slug;
        $category_name = $category->name;

        $posts = get_coiffure_posts_by_term($category_slug);

        if ($posts) {
            $category_title = 'Coupes' . ' ' . ucfirst($category_name);
            $section_id = esc_attr('Nvh-coiffure-' . $category_slug);
            $post_container_id = esc_attr('Nvh-coiffure-post-' . $category_slug);
            $post_anchor_id = esc_attr('Nvh_'. $category_name . '_anchor');
        

            echo <<<HTML
            <section class="Nvh-cote-coiffure container-fluid" id="$section_id">
                <div class="Nvh-anchor" id="$post_anchor_id"></div>
                <div class="Nvh-cooiffure-title container-fluid">
                    <h2 class="NVh-title-coiffure">{$category_title}</h2>
                    <div class="underlining">
                        <span class="Nvh-border-bottom"></span>
                    </div>
                </div>

                <div class="Nvh-coiffure-post container-fluid" id="$post_container_id">
        HTML;

            foreach ($posts as $post) {
                setup_postdata($post);

                $textchamps = sanitize_text_field(get_post_meta($post->ID, 'descriptif_coiffure', true));
                $Pricecoupe = get_post_meta($post->ID, 'tarif_de_la_coupe_', true);
                $imgcoupe   = get_post_meta($post->ID, 'photo_coupes_de_cheveux', true);

                if (!empty($textchamps) && !empty($imgcoupe)) {
                    get_template_part('template-parts/coiffure-block');
                }

                wp_reset_postdata();
            }

            echo <<<HTML
                </div>
            </section>
        HTML;
        }
    }

    get_footer();
    ?>
</div>
<?php get_footer(); ?>