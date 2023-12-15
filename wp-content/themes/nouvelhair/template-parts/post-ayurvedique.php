<?php

/**************
 * Theme: Nouvel'Hair Végétal
 * Template Name: Ayurvedique page côté massages
 * Author: 1.0.0
 * 
 * 
 */

defined('ABSPATH') or die('Exit');

get_header();
?>
<?php

$Testextrait = get_field('description_du_soin'); ?>

<div class="Nvh-ayurlist-descr container-fluid">

    <?php
    $textExcerpt = Nvh_custom_excerpt_length($Testextrait, 20);
    if (!empty($textExcerpt)) {
        echo esc_html($textExcerpt);
    } else {
        echo '<p>' . 'Descirption à venir rapidement' . '</p>';
    }
    ?>
    <div class="Nvh-ayurv-vp">
        <a href="<?php the_permalink(); ?>" class="btn btn-primary Nvh-button-inf">Toutes les infos</a> <!-- Bouton "Voir plus" avec lien vers le post -->
    </div>
</div>