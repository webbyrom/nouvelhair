<?php
defined('ABSPATH') or die('');
/***
 * Template Name: page 404
 * Author: Romain Fourel
 * Theme: Nouvel'Hair
 * 
 * 
 */
get_header(); ?>


<div class="Nvh-error-page container-fluid">
    <h1 class="title-news"><?php bloginfo('name') ?><?php get_the_title(); ?></h1>
    <div class="Nvh-error">

        <div class="error404" style="background-image: url('<?php echo esc_url(get_theme_mod("404_background_image")); ?>');">
            <div class="title-error">
                <h2 class="Nvh-title-error"><?php esc_html_e('Oups rien n\'a afficher ici', 'nouvelhair'); ?></h2>
            </div>

            <?php the_content(); ?>
        </div>
    </div>
</div>
<div class="Nvh-espacement container-fluid"></div>
<?php get_footer(); ?>