<?php
if (!defined('ABSPATH')) {
    die('exit');
};

/******
 * Template Name: Coté Massage
 * Theme: Nouvel' Hair
 * Version: 1.0.5
 * Author: Romain Fourel
 *  
 */
?>

<?php get_header(); ?>

<section class="Nvh-massage-slider container-fluid">
    <div class="Nvh-massage-slider-content container-fluid">
        <!----------Slider Here--------->
        <?php add_revslider('slider-6'); ?>
    </div>
</section>

<div class="container-fluid Nvh-news">
    <section class="Nvh-content-massage container-fluid">
        <h1 class="Nvh-massage-title"><?php echo esc_html(get_bloginfo('name')) . ' - ' . esc_html(get_the_title()); ?></h1>
        <div class="underlining">
            <span class="Nvh-border-bottom"></span>
        </div>
    </section>

    <section class="Nvh-ayur-massage container-fluid">
        <article class="Nvh-type-massage container-fluid">
            <?php
            $ayurTexte = get_field('explications_ayurveda');
            if (!empty($ayurTexte)) : ?>
                <div class="Nvh-ayr-texte container-fluid">
                    <?php
                    echo $ayurTexte;
                    ?>
                </div>
            <?php endif; ?>

            <?php
            $ayurImg = get_field('soins_ayurvediques');
            if (!empty($ayurImg)) : ?>
                <div class="Nvh-ayur-image container-fluid">
                    <img src="<?php echo esc_url($ayurImg); ?>" alt="" class="Nvh-img-ayur img-fluid">
                </div>
            <?php endif; ?>
        </article>
    </section>

    <div class="Nvh-title-ayurType container">
        <h2 class="Nvh-ayurTitle-section">Les Massages Ayurvédiques</h2>
        <div class="underlining">
            <span class="Nvh-border-bottom"></span>
        </div>
    </div>

    <section class="Nvh-ayurvedique container-fluid">
        <article class="Nvh-ayurv-type container-fluid">
            <div class="accordion" id="accordionExample">
                <?php
                $categories = get_terms(array(
                    'taxonomy' => 'massage',
                    'orderby'  => 'name',
                    'order' => 'DESC'
                ));

                if (!empty($categories) && !is_wp_error($categories)) {
                    $index = 1; // Initialiser l'index

                    foreach ($categories as $category) {
                        if (isset($category->slug) && isset($category->name)) {
                            $category_slug = $category->slug;
                            $category_name = $category->name;

                            $posts = get_ayurvedique_posts_by_term($category_slug);

                            if (!empty($posts) && !is_wp_error($posts)) {
                                $category_title = ucfirst($category_name);
                                $accordion_item_Class = esc_attr('Nvh-ayurvedique' . $category_slug);
                                $ayur_accordion_anchor = esc_attr('Nvh_' . $category_slug . '_anchor');
                                $collapseId = "collapse$index";
                                echo <<<HTML
                                <div class="Nvh-anchor" id="$ayur_accordion_anchor"></div>
                                <div class="accordion-item Nvh-accordion-item">
                                    <h2 class="Nvh-title-ayur">
                                        <button class="accordion-button Nvh-button-accordion-ayurv" type="button" data-bs-toggle="collapse" data-bs-target="#$collapseId" aria-expanded="<?php echo ($index === 1) ? 'true' : 'false' ?>" aria-controls="$collapseId">
                                            {$category_title}
                                        </button>
                                    </h2>
                                    <div id="$collapseId" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                            HTML;

                                foreach ($posts as $post) {
                                    setup_postdata($post);
                                    get_template_part('template-parts/post-ayurvedique');
                                    wp_reset_postdata();
                                }

                                echo <<<HTML
                                        </div>
                                    </div>
                                </div>
                            HTML;

                                $index++;
                            }
                        }
                    }
                }
                ?>
            </div>
        </article>
    </section>
    <div class="Nvh-espacement container-fluid"></div>
</div>
    <?php get_footer(); ?>