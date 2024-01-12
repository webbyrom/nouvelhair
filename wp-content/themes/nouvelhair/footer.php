<?php
defined('ABSPATH') or die('');
/**
 * The template for displaying the footer
 * Template Name: Footer
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Nouvel'Hair
 * @since Nouvel'Hair 1.0
 */

?>
</main><!----#Nvh-main---->
</div><!----#Nvh-secondary-content---->
</div><!----#Nvh-primary-content---->

<footer class="Nvh_footer container-fluid">
    <?php dynamic_sidebar('footer-nav'); ?>
    <?php dynamic_sidebar('footer-coiffure');?>
    <?php get_option('Nvh_date'); ?>
    <div id="Nvh_scroll_top_button" class="Nvh-button-to-top">
        <a href="#" class="Nvh-scroll-totop">
            <i class="dashicons dashicons-arrow-up-alt"></i>
        </a>
    </div>
    <div class="Nvh-color-footer container">

        <!-------ajouter sidebar---->
    </div>
</footer>
<?php wp_footer() ?>
</body>

</html>