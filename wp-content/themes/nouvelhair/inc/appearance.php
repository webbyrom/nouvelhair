<?php /********
 * logo management
 */
defined('ABSPATH') or die('interdit!!');
/*******
 *  Adding the Theme Appearance section to the customization menu
 */
add_action('customize_register', function (WP_Customize_Manager $manager){
    $manager->add_section('Nvh_logo_apparence', [
        'title' => __('Votre Logo')
    ]);
/*****
 * sanitize_callback prevents the user from entering anything
 */
    $manager->add_setting('Logo', [
        'sanitize_callback' =>  'esc_url_raw'
    ]);
/******
 * Create the form at the logo level customization
 */
    $manager->add_control(new WP_Customize_Image_Control($manager, 'Logo',
    [
        'label' => __('Logo', 'nouvelhair'),
        'section'   => 'Nvh_logo_apparence'
        
    ]));
 });
 /*******
  * color picker header
  */
  add_action('customize_register', function(WP_Customize_Manager $manager){
    $manager->add_section('Nvh_apparence',[
        'title' => 'Couleur Header',
    ]);
    $manager->add_setting('header_background',[
        'default'   =>  '#87d1c2',
        'transport' =>  'postMessage',
        'sanitize_callback' =>  'sanitize_hex_color'
    ]);
    $manager->add_control(new WP_Customize_Color_Control($manager, 'header_background', [
        'label' =>  __('Couleur Header', 'nouvelhair'),
        'section'   =>  'Nvh_apparence',
        'settings'=>'header_background'
    ]));
  });
  add_action('customize_preview_init', function(){
    wp_enqueue_script('Nvh_apparence', get_template_directory_uri(). './assets/js/Nvh.js/apparence.js', ['jquery', 'customize-preview'], '', true);
  });
  /***
 * personnalisation image background page 404
 * 
 */
function Nvh_customize_register($wp_customize) {
    $wp_customize->add_section('404_background_section', array(
        'title' => __( 'Image fond page 404', 'nouvelhair'),
        'priority'=> 30,
    ));
    $wp_customize->add_setting('404_background_image', array(
        'default'   => '',
        'transport'=> 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control( $wp_customize, '404_background_image', array(
        'label' =>  __( 'Background Image', 'nouvelhair'),
        'section'   =>  '404_background_section',
        'settings'  =>  '404_background_image',

    )));
}
add_action('customize_register','Nvh_customize_register' );