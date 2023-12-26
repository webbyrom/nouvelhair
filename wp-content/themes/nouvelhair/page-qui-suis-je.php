<?php

/*******
 * Template Name: Qui suis-je
 * Theme: Nouvel'hair
 * Version: 1.0.2
 * Author: Romain Fourel
 * 
 */
defined('ABSPATH') or exit;
?>
<?php get_header(); ?>
<section class="Nvh-quisuisje container-fluid">
    <div class="Nvh-quisuisje-slider container-fluid">
    <?php add_revslider('slider-8'); ?>
    </div>
</section>
<div class="Nvh-qsj-title container-fluid">
<h1 class="Nvh-coiffure-title"><?php echo esc_html(get_bloginfo('name')) . ' - ' . esc_html(get_the_title()); ?></h1>
</div>
<div class="underlining">
        <span class="Nvh-border-bottom"></span>
    </div>
<section class="Nvh-qsj-img container">
    <div class="Nvhqsj-text Nvh-col-qsjz-text">
        <?php
        $textqsj = get_field('texte_de_presentation_de_la_page_qui_suis-je');
        if (!empty($textqsj)) : ?>
            <div class="Nvh-textqsj">
                <?= $textqsj ?>
            <?php else : ?>
                <p>Pas de texte à afficher!</p>
            </div>
        <?php endif; ?>
    </div>
    <div class="Nvh-img-qsj container-fluid">
        <?php
        $imgqsj = get_field('photo_de_la_page_qui_suis-je');
        if (!empty($imgqsj)) : ?>
            <div class="Nvh-qsj-img circle-img">
                <img src="<?php echo esc_url($imgqsj); ?>" alt="" class="Nvh-qsj-img">
            <?php else : ?>
                <img width="100%" height="250" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mN8c/CJCwAICQLXkCArnAAAAABJRU5ErkJggg==" class=" card-img-top rounded-start" alt="...">
            </div>
        <?php endif; ?>
    </div>

</section>
<section class="Nvh-qsj-ambiance">
    <div class="Nvh-qsj-ambiance-text">
        <?php
        $TextqsjAmbiance = get_field('ambiance');
        if (!empty($TextqsjAmbiance)) : ?>
            <div class="Nvh-text-qsj-ambiance col-5">
                <?= $TextqsjAmbiance; ?>
            <?php else : ?>
                <p>Pas de texte à afficher!</p>
            </div>
        <?php endif ?>
    </div>
    <div class="Nvh-qsj-ethique col-5">
        <?php
        $TextqsjEthique = get_field('ethique');
        if (!empty($TextqsjEthique)) : ?>
            <div class="Nvh-text-qsj-ethique">
                <?= $TextqsjEthique ?>
            <?php else : ?>
                <p>Pas de texte à afficher!</p>
            </div>
        <?php endif; ?>
    </div>
</section>
<?php get_footer(); ?>