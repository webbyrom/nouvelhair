<?php
if (!defined('ABSPATH')) {
    die('exit');
};

/******
 * Template Name: Archive Coiffure
 * Theme: Nouvel' Hair
 * Version: 1.0.4
 * Author: Romain Fourel
 */

get_header();

?>

<section class="Nvh-coiffure container-fluid">
    <div class="Nvh-coiffure-slider container-fluid">
        <?php add_revslider('cote-coiffure'); ?>
    </div>
</section>

<section class="Nvh-content-coiffure container-fluid">
    <h1 class="Nvh-coiffure-title">
        <?php echo esc_html(get_bloginfo('name')) . ' - ' . esc_html(get_the_title()); ?>
    </h1>
</section>

<section class="Nvh-coiffure container-fluid">
    <?php
    $textchamps = get_field('descriptif_coiffure');
    $Pricecoupe = get_field('tarif_de_la_coupe_');
    $imgcoupe = get_field('photo_coupes_de_cheveux');

    if (!empty($textchamps) && !empty($imgcoupe)) {
    ?>
        <article class="Nvh-coiffure-prestation container-fluid">
            <div class="Nvh-coiffures">
                <div class="col-md-3 col-sm-4 col-8 flip-box">
                    <div class="front Nvh-flip-front" style="background-image: url('<?php echo esc_url($imgcoupe); ?>')">
                        <div class="content text-center">
                            <?php
                            if (!empty($Pricecoupe)) {
                            ?>
                                <span class="Nvh-price flip single">
                                    <?php echo esc_html($Pricecoupe) . "€"; ?>
                                </span>
                                <span class="click-for-more"></span>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="back">
                        <div class="content">
                            <span class="Nvh-text-flip-single"><?php echo $textchamps; ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    <?php
    }
    ?>
</section>

<div class="Nvh-espacement container-fluid"></div>

<?php get_footer(); ?>