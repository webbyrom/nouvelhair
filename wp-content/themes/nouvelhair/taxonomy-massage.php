<?php
/**
 * Template Name: Archive Soin Ayurvédique
 * Theme: Nouvel'hair Végétal
 * Version: 1.0.1
 */

defined('ABSPATH') or die('Exit');
get_header();
?>

<section class="Nvh-ayur-main container-fluid">
    <div class="Nvh-ayur-slider container-fluid">
        <?php add_revslider('slider-7'); ?>
    </div>
</section>
<div class="container-fluid Nvh-news">
    <section class="Nvh-ayur-content container-fluid">
        <h1 class="Nvh-title-single-ayur container">
            <?php echo esc_html(get_bloginfo('name')) . ' - ' . esc_html(get_the_title()); ?>
        </h1>
        <div class="underlining">
            <span class="Nvh-border-bottom"></span>
        </div>
    </section>

    <section class="Nvh-article-ayur container-fluid">
        <article class="Nvh-sing-ayur container-fluid">
            <div class="Nvh-ayur-sing-prez container-fluid">
                <?php
                $AyurDescript = get_field('description_du_soin');
                $AyurvImg = get_field('image_du_soin');
                $ayurPrice = get_field('tarif_du_soin');
                $AyurTime = get_field('duree_du_soin');
                $AyurSweet = get_field('benefices_du_soin');

                if (!empty($AyurvImg)) :
                ?>
                    <div class="Nvh-img-ayurv-single">
                        <img src="<?php echo esc_url($AyurvImg); ?>" class="Img-Ayur-single" alt="Image du soin">
                    </div>
                    <div class="Nvh-ayur-pri-ti container-fluid">
                        <?php if (!empty($ayurPrice)) : ?>
                            <div class="Nvh-ayurv-singP container-fluid">
                                <span class="Nvh-tarif-ayurvsing">Tarif de la Séance: <?php echo esc_html($ayurPrice) . "€ TTC"; ?></span>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($AyurTime)) : ?>
                            <div class="Nvh-ayurv-singT container-fluid">
                                <span class="Nvh-tarif-ayurv-sig">Durée du soin: <?php echo esc_html($AyurTime); ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <div class="Nvh-single-texte-ayur container-fluid">
                    <?php
                    if (!empty($AyurDescript)) :
                    ?>
                        <div class="Nvh-desc-ayurv-single container-fluid">
                            <h2 class="Nvh-ayur-single-descr">Description</h2>
                            <div class="underlining-ayurv"></div>
                            <?php echo $AyurDescript; ?>
                        </div>
                        <?php
                        if (!empty($AyurSweet)) :
                        ?>
                            <div class="Nvh-ayurvbf container-fluid">
                                <h2 class="Nvh-ayur-single-good">Les bienfaits</h2>
                                <div class="underlining-ayurv"></div>
                                <?php echo $AyurSweet; ?>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
                <div class="Nvh-single-ayur-video container-fluid">
                    <?php  
                    $VideAyur = get_field('texte_et_ou_video_');
                    if (!empty($VideAyur)):
                    ?>
                    <h3 class="Nvh-title-ayurv-video">titre a n'afficher que si une vidéo est disponible</h3>
                    <div class="Nvh-content-ayur-vide container-fluid">
                        <?php echo $VideAyur;?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </article>
    </section>
    <div class="Nvh_pagination_single container-fluid">
        <?php echo Nvh_custom_paginate_single(); ?>

    </div>
</div>
    <?php get_footer(); ?>