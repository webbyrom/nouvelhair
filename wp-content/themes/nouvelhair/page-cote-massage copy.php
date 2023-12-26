<?php
if (!defined('ABSPATH')) {
    die('exit');
};
/******
 * Template Name: Coté Massage
 * Theme: Nouvel' Hair
 * Version: 1.0.2
 * Author: Romain Fourel
 *  
 */
?>
<?php get_header() ?>
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
            endif; ?>

                </div>
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
                $args = [
                    'post_type' => 'Ayurvedique',
                    'posts_per_page' => -1,
                    'post_status' => 'publish',
                    'orderby' => 'title',
                    'order' => 'DESC',
                ];
                $query = new WP_Query($args);

                if ($query->have_posts()) :
                    $index = 1;
                    while ($query->have_posts()) : $query->the_post();
                ?>
                        <div class="accordion-item Nvh-accordion-item">
                            <h2 class="accordion-header Nvh-accordion-ayurv">
                                <button class="accordion-button Nvh-button-accordion-ayurv" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $index ?>" aria-expanded="<?php echo ($index === 1) ? 'true' : 'false' ?>" aria-controls="collapse<?php echo $index; ?>">
                                    <?php the_title(); ?>
                                </button>
                            </h2>
                            <div id="collapse<?php echo $index ?>" class="accordion-collapse collapse <?php echo ($index === 1) ? 'show' : ''; ?>" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <?php get_template_part('template-parts/post-ayurvedique'); ?>
                                </div>
                            </div>
                        </div>
                <?php
                        $index++;
                    endwhile;
                endif;
                wp_reset_postdata();
                ?>
            </div>
        </article>
    </section>
</div>
<div class="Nvh-espacement container-fluid"></div>
<?php get_footer() ?>