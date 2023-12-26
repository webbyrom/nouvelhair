<?php
if (!defined('ABSPATH')) {
    die('exit');
};
/******
 * Template Name: Coté Coiffure
 * Theme: Nouvel' Hair
 * Version: 1.0.2
 * Author: Romain Fourel
 * 
 * 
 * 
 */
?>
<?php get_header() ?>
<section class="Nvh-coiffure container-fluid">
    <div class="Nvh-coiffure container-fluid">
        <!----------Slider Here--------->
        <?php add_revslider('cote-coiffure'); ?>
    </div>
</section>
<section class="Nvh-content-coiffure container-fluid">
    <h1 class="Nvh-coiffure-title"><?php echo esc_html(get_bloginfo('name')) . ' - ' . esc_html(get_the_title()); ?></h1>
</section>
<section class="Nvh-coiffure container-fluid">
    <article class="Nvh-coiffure-prestation container-fluid">
        <div class="Nvh-coiffures">
            <?php
            $conditionRempli = false; // pour afficher le message qu'une fois au lieu de 4
            for ($i = 1; $i <= 4; $i++) {
                $textchamps = get_field('descriptif_coupe_de_cheveux_' . $i);
                $Pricecoupe = get_field('tarif_de_la_prestation_' . $i);
                if (!empty($textchamps) && !empty($Pricecoupe)) {
                    $conditionRempli = true;
            ?>
                    <div class="col-md-3 col-sm-4 col-8 flip-box">
                        <div class="front Nvh-flip-front">
                            <div class="content text-center">
                                <span class="Nvh-pirce flip single"><?php echo esc_html($Pricecoupe) . "€"; ?></span>
                                <span class="click-for-more"></span>
                            </div>
                        </div>
                        <div class="back">
                            <div class="content">
                                <span class="Nvh-text-flip-single"><?php echo $textchamps; ?></span>
                            </div>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </div>
        <?php
        if (!$conditionRempli) {
            echo '<p class="coiffure-empty">Rien n\'a afficher pour l\'instant.</p>';
        }
        ?>
    </article>
</section>
<?php get_footer() ?>