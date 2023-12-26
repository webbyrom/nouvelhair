<?php

use Yoast\WP\SEO\Presenters\Admin\Sidebar_Presenter;

get_header();
defined('ABSPATH') or die();
/*******
 *Template Name: Contact
 *Version: 1.0.5
 *Theme: Nouvel'Hair
 * 
 */
?>
<div class="Nvh-contact container-fluid">

    <div class="Nvh-contact-slider container-fluid">
        <?php add_revslider('slider-3'); ?>
    </div>
    <div id="Nvh_horaires_anchor"></div>
    <div class="Nvh-contact-title-page container-fluid">
        <h1 class="Nvh-coiffure-title"><?php echo esc_html(get_bloginfo('name')) . ' - ' . esc_html(get_the_title()); ?></h1>

    </div>
    <div class="underlining">
        <span class="Nvh-border-bottom"></span>
    </div>
    <div id="Nvh_contact_hours" class="Nvh-contact-hours container-fluid">

        <?php
        $horaires_semaine = get_option('Nvh_horaires_semaine');
        $Nvh_congés = get_option('Nvh_conges');
        ?>
        <h2 class="Nvh-contact-horaires-title">Horaires d'ouverture du salon.</h2>
        <?php if (!empty($horaires_semaine)) : ?>
            <ul class="Nvh-contact-horaires">
                <?php foreach ($horaires_semaine as $jour => $horaires) : ?>
                    <?php if (!empty($horaires['ouverture']) && !empty($horaires['fermeture'])) : ?>
                        <?php
                        $ouverture_formattee = date('H:i', strtotime($horaires['ouverture']));
                        $fermeture_formattee = date('H:i', strtotime($horaires['fermeture']));
                        ?>
                        <li class="Nvh-contact-list-horaires"><?= ucfirst($jour) ?> : <?= esc_html($ouverture_formattee) ?> - <?= esc_html($fermeture_formattee) ?></li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        <?php else : ?>
            <p class="Nvh-contact-coment">Les horaires d'ouverture ne sont pas disponibles.</p>
        <?php endif; ?>
    </div>
    <div id="Nvh_contact_conges" class="Nvh-contact-conges container-fluid">
        <h2 class="Nvh-contact-congés-title">Dates de congés du salon.</h2>
        <?php if (!empty($Nvh_congés['debut']) && !empty($Nvh_congés['fin'])) : ?>
            <?php
            $debut_formatte = date('d/m/Y H:i', strtotime($Nvh_congés['debut']));
            $fin_formattee = date('d/m/Y H:i', strtotime($Nvh_congés['fin']));
            ?>
            <p class="Nvh-contact-début-congé">Début de congés : <?= esc_html($debut_formatte) ?></p>
            <p class="Nvh-contact-fin-congé">Fin de congés : <?= esc_html($fin_formattee) ?></p>
        <?php else : ?>
            <p class="Nvh-contact-coment-congé">Les dates de congés ne sont pas disponibles.</p>
        <?php endif; ?>
        <div id="Nvh_info_anchor"></div>
    </div>
    <!-- Nouvelle section pour afficher le numéro de téléphone et l'adresse -->
    <div id="Nvh_contact_info" class="Nvh-contact-info container-fluid">
        <?php
        // Récupérer le numéro de téléphone et l'adresse enregistrés
        $telephone = get_option('Nvh_telephone');
        $adresse = get_option('Nvh_adresse');
        ?>

        <?php
        // Afficher le numéro de téléphone et l'adresse
        if (!empty($telephone)) {
        ?>
            <h2 class="Nvh-info-contact-title">Numéro de téléphone</h2>
            <p class="Nvh-rdv-info">Prise de rendez-vous et renseignements par téléphone</p>
            <p class="Nvh-contact-tel"><a class="Nvh-tel-contact" href="tel:+330478190201"><span class="dashicons dashicons-phone m-2"></span><?php echo esc_html($telephone); ?></a></p>
            <p class="Nvh-rdv-salon"> ou sur place au Salon</p>
        <?php
        }
        ?>

        <?php
        $adresse = get_option('Nvh_adresse');
        if (!empty($adresse)) {

        ?>
            <h2 class="Nvh-title-adress">Adresse</h2>
            <p class="Nvh-info-adress"><?= nl2br(esc_html($adresse)) ?></p>
            <div id="Nvh_maps_container" class="Nvh-maps-container container">
                <div id="map"></div>
                <button class="Nvh-maps-close">Fermer la carte</button>
            </div>

        <?php
        }
        ?>
    </div>
</div>
<div class="Nvh-lunaire container-fluid">
    <aside>
        <?php dynamic_sidebar('blog'); ?>
        <!---- <a target="blank"
	style="text-decoration:none;"
	href="https://www.calendrier-lunaire.net/">
		<img src="https://www.calendrier-lunaire.net/module/MY3lScVA2Mk1aeWlpakpQeWpRa2Zkci9BV1pQL1N1b0w3QXBKTXdiRjB4NXluTzlVUWFnbkdSQ3RqME1EV0NGUXlRQUlkOHR5ODFnZWJXcWdvak5yQVE9PQ.png" />
 </a>----->
    </aside>
</div>
<div class="Nvh-espacement container-fluid"></div>
<?php get_footer(); ?>