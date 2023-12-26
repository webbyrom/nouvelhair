<?php 
defined('ABSPATH') or die('');

function enqueue_scripts() {
    wp_enqueue_script('jquery');
  }
  add_action('wp_enqueue_scripts', 'enqueue_scripts');
  function enqueue_custom_scripts() {
    wp_enqueue_script('custom-script', get_stylesheet_directory_uri() . '/assets/js/Nvh.js/ajax-filter.js', array('jquery'), '1.0', true);
    wp_localize_script( 'jquery', 'ajax_params', array(
        'ajax_url' => admin_url( 'admin-ajax.php' )
      ));
  }
  
  add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');
?>