<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="Salon de coiffure, salon de coiffure naturel, salon de coiffure Nouvel'Hair végétal,coiffeur végétal, teinture végétale, couleur naturelle, coupe homme, coupe enfant, coupe femme, salon de massage Ayurvédique, salon de massage Saint Symphorien sur Coise, Monts du Lyonnais ">
    <meta name="description" content="salon de coiffure, salon de coiffure naturel, salon de coiffure végétal, coupe homme, coupe femme, coupe enfant, massage ayurvedique, salon coiffure 69590, salon de coiffure Saint Symphorien sur Coise">
    <meta property="og:locale" content="fr-FR">
    <meta property="og:title" content="Accueil Nouvel'Hair végétal Saint Symphorien sur Coise">
    <meta property="og:type" content="website">
    <meta property="og:description" content="salon de coiffure, salon de coiffure naturel, salon de coiffure végétal, coupe homme, coupe femme, coupe enfant, massage ayurvedique, salon coiffure 69590, salon de coiffure Saint Symphorien sur Coise">
    <meta name="robots" content="follow, index, max-immage-preview:-1, max-video-preview:-1">
    <meta name="googlebot" content="follow, index, max-image-preview:-1, max-video-preview:-1">
    <title content="coiffure naturelle et végétale à Saint-Symphorien-sur-Coise"><?php the_title() ?> <?php bloginfo('name'); ?></title>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <header id="nvh_header" class="nvh-header container-fluid">
        <!---- nav menu---->
        <nav id="Nvh_nav_menu" class="Nvh-nav-menu nav container-fluid" style="background-color: <?= get_theme_mod('header_background') ?>">
            <a href="#" id="Nvh_icon_responsive" class="Nvh-icon-responsive">
                <div class="Nvh-menu-icon menu-icon-animate">
                    <span class="Nvh-respon-icon1"></span>
                </div>

            </a>
            <!-----logo du site---->
            <a href="<?= home_url('/'); ?>" class="nav_logo" title="<?= __('homepage', 'nouvelhair') ?>">
                <img src="<?= get_theme_mod('Logo') ?>" alt="" id="logo_img_header" class="logo-img-header">
            </a>
            <?= esc_html(Nvh_primary_nav());

            ?>
        </nav>
    </header>
    <div class="nvh-line"></div>
    <div id="Nvh_primary_content" class="Nvh-primary-content overflow-hidden container-fluid">
        <div id="Nvh_secondary_content" class="Nvh-secondary-content container-fluid">
            <main id="Nvh_main" class="Nvh-main container-fluid">