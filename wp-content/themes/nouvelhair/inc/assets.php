<?php
defined('ABSPATH') or die('');
/**
 * Fires when scripts and styles are enqueued.
 *
 */
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('css', get_template_directory_uri(). '/style.css');
    wp_enqueue_style('Nvh-bootstrap-style', get_template_directory_uri(). '/assets/css/bootstrap/bootstrap.css');
    wp_enqueue_script('Nvh-bootstrap-script', get_template_directory_uri(). '/assets/js/bootstrap/bootstrap.js', [], false, true);
    wp_enqueue_script('Nvh-bubble', get_template_directory_uri(). '/assets/js/Nvh.js/bubble.js', [], false, true);
    wp_enqueue_script('Nvh_menu_sticky' , get_template_directory_uri(). '/assets/js/Nvh.js/menu-sticky.js', [], false, true);
    wp_enqueue_script('Nvh-burger', get_template_directory_uri(). '/assets/js/Nvh.js/burger.js', [], false, true);
    wp_enqueue_script('Nvh_logo_animate' , get_template_directory_uri(). '/assets/js/Nvh.js/logo-animate.js', [], false, true);
    wp_enqueue_script('Nvh-contact', get_template_directory_uri(). '/assets/js/Nvh.js/contact-hours.js', [], false, true);
    wp_enqueue_script('Nvh-cure', get_template_directory_uri(). '/assets/js/Nvh.js/microscopie.js', [], false, true);
    wp_enqueue_script('Nvh-map-contact', get_template_directory_uri(). '/assets/js/Nvh.js/map-contact.js', [], false, true);
    wp_enqueue_script('Nvh-partner-script', get_template_directory_uri() . '/assets/js/Nvh.js/partner.js', [], false, true);
    
});
add_action('admin_enqueue_scripts', function(){
    wp_enqueue_style('admin_Nvh', get_template_directory_uri(). '/assets/css/adminNvh/admin.css');
});