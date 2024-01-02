<?php

/**
 *Template Name: Page Microscopie Capillaire
 *
 * @author     Romain Fourel
 * @subpackage Theme Nouvel Hair
 * @since     1.0.4
 */

defined('ABSPATH') || die;
//session_start();

get_header() ?>

<div class="Nvh-news container-fluid">
    <div class="Nvh-capillaire-slider container-fluid">
        <!-----------Slider page capillaire --------------->
        <?php add_revslider('slider-9'); ?>
    </div>
</div>

<div class="Nvh-news container-fluid">
    <h1 class="Nvh-capillaire-title"><?php echo esc_html(get_bloginfo('name')) . ' -' . esc_html(get_the_title()); ?></h1>
    <div class="underlining">
        <span class="Nvh-border-bottom"></span>
    </div>
    <section class="Nvh-descript-capillaire container-fluid">
        <div class="Nvh-decript-capillaire container-fluid">
            <?php
            $DescriptCapillaire = get_post_meta($post->ID, 'description_microscopie_capillaaire', true);
            // Extraire le texte et l'image de la variable.
            $texte = wp_strip_all_tags($DescriptCapillaire); // Supprimer les balises pour obtenir seulement le texte.
            $image = preg_match('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $DescriptCapillaire, $matches) ? $matches[1] : '';
            if (!empty($texte)) {

                // Afficher le texte sécurisé dans une balise <p>.
                echo '<p class="Nvh-capillaire-texte container">' . '<span>' . wp_kses_post($texte) . '</span>' . '</p>';
            }
            if (!empty($image)) {
                // Afficher l'image dans une balise <div>.
                echo '<div class="Nvh-img-capillaire container"><img src="' . esc_url($image) . '" class="Nvh-capillaire-imgdescp img-fluid" alt="Description de l\'image"></div>';
            }

            ?>


        </div>
        <div class="Nvh-img-descirpt-capillaire container-fluid">
            <h2 class="Nvh-capillaire-default">Les problèmatiques rencontrées peuvent être:</h2>

            <div class="Nvh-list-defaulthair container-fluid">
                <?php
                $CapillairDefault = get_post_meta($post->ID, 'description_des_problematiques_capillaires', true);

                // Check if $CapillairDefault is empty before processing
                if (!empty($CapillairDefault)) {
                    // Convert the string into an array of list items
                    $CapiTexts = [];
                    $regularExpression = '/<ul>(.*?)<\/ul>/si';

                    preg_match_all($regularExpression, $CapillairDefault, $matches_array);

                    if (!empty($matches_array[1])) {
                        $CapiTexts = $matches_array[1];

                        // Replace <li> tags with <li class="specific-class"> tags
                        foreach ($CapiTexts as &$listItem) { //& devant la variablle permet d'avoir dans le tableau les modifiacations
                            $listItem = preg_replace('/<li>/', '<li class="Nvh-listCap">', $listItem);
                        }

                        // Generate the list HTML structure
                        echo '<ul class="Nvh-CapiListe">';
                        foreach ($CapiTexts as $listItem) {
                            echo $listItem;
                        }
                        echo '</ul>';
                    }
                    $textOutsideList = preg_replace('/<ul>.*?<\/ul>/si', '', $CapillairDefault);
                    echo '<p class="Nvh-text-capillaire-list container">' . wp_kses_post($textOutsideList) . '</p>';
                }
                ?>
            </div>
            <div class="Nvh-left-graphisme container-fluid"></div>
            <div class="Nvh-right-graphisme container-fluid"></div>
        </div>
    </section>
    <section class="Nvh-capillaire-ttt container-fluid">
        <h2 class="Nvh-capil-ttt">Le Traitement</h2>

        <?php
        $CapillaireExplain = get_field('traitment_explain');
        //$CapillaireExplain = get_post_meta($post->ID, 'traitment_explain', true);
        if (!empty($CapillaireExplain)) {
            echo '<div class="Nvh-ttt-Capillaire container">' . wp_kses_post($CapillaireExplain) . '</div>';
        }

        ?>

    </section>
    <section class="Nvh-capillaire-tarif container-fluid">
        <div class="Nvh-tarf-microcapillaire container-fluid">
            <h3 class="Nvh-microcapil-tarf-title">Tarifs</h3>
            <div class="Nvh-analyse-micro container-fluid">
                <?php
                $analyse_micro = get_field('analyse_et_prelevement');
                $tarif_analyse = get_field('tarif_analyse');
                $time_analyse = get_field('duree');
                if (!empty($analyse_micro) && !empty($tarif_analyse) && !empty($time_analyse)) {
                    echo '<div class="Nvh-tarif-dure container-fluid">';
                    echo '<p class="Nvh-analyse-mc container-fluid">' . wp_kses_post($analyse_micro) . '</p>';
                    echo '<p class="Nvh-tarif-dure container-fluid">' . wp_kses_post($tarif_analyse) . '€ ttc' . '/' . wp_kses_post($time_analyse) . 'minutes' . '</p>';
                    echo '</div>';
                }
                ?>
            </div>
            <h4 class="Nvh-capi-cure-title">Cure</h4>
            <div class="underlining">
                <span class="Nvh-border-bottom"></span>
            </div>
            <!-----
            <div class="Nvh-trait-cure container-fluid"></div>
            <div class="Nvh-trait-cure-salon container-fluid"></div>
            ---->
            <div class="Nvh-cure container-fluid">
                <div class="Nvh-cure-maison Nvh-anim-cure container-fluid">
                    <h5 class="Nvh-cure-home-title">Réalisée à la Maison</h5>
                    <?php
                    $cure_home = get_field('cure_maison');
                    $cure_home = wp_kses_post($cure_home);
                    $sold_parts = get_field('tarif_des_produits');
                    if (!empty($cure_home) && !empty($sold_parts)) {
                        echo '<div class="Nvh-homet-cure">';
                        echo '<p class="Nvh-cure-homet">' . strip_tags($cure_home) . '</p>';
                        echo '<p class="Nvh-parts-sold">' . 'pour un coût de ' . $sold_parts . '€ttc' . '</p>';
                        echo '</div>';
                    }


                    ?>
                    <div class="Nvh-total-cure-home container-fluid">
                        <?php
                        $cure_total_home = get_field('total_cure_maison');
                        $cure_total_home = wp_kses_post($cure_total_home);
                        if (!empty($cure_total_home)) {
                            echo '<span class="Nvh-total-homet-cure Nvh-anim-cure">' . "soit un total de " . '</span>' . '</span class="Nvh-total-homep">' . $cure_total_home . "€ttc" . '</span>';
                        }

                        ?>
                    </div>

                </div>
                <div class="Nvh-cure-salon Nvh-anim-cure container-fluid">
                    <h5 class="Nvh-cure-salon-title">Réalisée au Salon</h5>
                    <?php
                    $cure_salon = get_field('cure_salon');
                    $cure_salon = wp_kses_post($cure_salon);
                    if (!empty($cure_salon)) {
                        echo '<div class="Nvh-cure-salont container-fluid">';
                        echo '<p class="Nvh-cure-salonp">' . strip_tags($cure_salon) . '</p>';
                        echo '</div>';
                    }

                    ?>
                    <div class="Nvh-total-cure-salon container-fluid">
                        <?php
                        $cure_total_salon = get_field('total_cure_salon');
                        if (!empty($cure_total_salon)) {
                            echo '<span class="Nvh-total-salont-cure">' . "soit un total de " . '</span>' . '</span class="Nvh-total-salonp">' . wp_kses_post($cure_total_salon) . "€ttc" . '</span>';
                        }
                        ?>
                    </div>

                </div>

            </div>

        </div>

    </section>

</div>

<?php get_footer(); ?>