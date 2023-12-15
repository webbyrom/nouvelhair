<?php 
defined('ABSPATH') or die('');
/******
 * Primary Menu
 */
if (!function_exists('Nhv_register_menu')) {
    function Nhv_register_menu()
    {
        register_nav_menus([
            'primary' =>    esc_html__('Primary Menu', 'nouvelhair'),
            'footer'    =>  esc_html__('Footer Menu', 'nouvelhair')
        ]);
    }
    add_action('init', 'Nhv_register_menu');
}
if (! function_exists('Nvh_primary_nav')) {
    function Nvh_primary_nav() {
        wp_nav_menu([
            'theme_location'    => 'primary',
            'sort_column'   => 'menu_order',
            'container' =>  'div',
            'container_class'   => 'collapse Nvh-collapse container-fluid',
            'container_id'  =>  'Nvh_collapse',
            'container_aria_label'  =>  'Nvh_m_active',
            'menu_class'    =>  'Nvh-primary-nav nav-menu',
            'menu_id'   =>  'Nvh_primary_nav nav_menu',
            'echo'  =>  true,
            'show_home' =>  true,
            'before'    =>  '',
            'after' =>  '',
            'link_before'   =>  '<span>',
            'link_after'    =>  '</span>',
            'item_wrap' =>  '<ul id="%1$s" class="%2$s">%3$s</ul>',
            'item_spacing'  =>  'preserve',
            'depth' =>  0,
            'walker'    => ''
        ]);
    }
}
/****
 * customisation des éléments ul /li du menu et du sous menu 
 * 
 */


if (!function_exists('Nvh_custom_nav_classes')) {
    function Nvh_custom_nav_classes($classes, $item, $args) {
        // Vérifiez si l'élément a la classe 'sub-menu' pour les sous-menus
        if (in_array('sub-menu', $classes)) {
            // Ajoutez la classe 'Nvh-submenu-ul' aux sous-menus
            $classes[] = 'Nvh-submenu-ul';
        }
        return $classes;
    }
    add_filter('nav_menu_submenu_css_class', 'Nvh_custom_nav_classes', 10, 3);
}

/*********
 * add active link custom class
 */

 if (!function_exists('NvhCustom_nav_class')) {
    function NvhCustom_nav_class($classes, $item, $args) {
        if (in_array('menu-item-type-post_type', $classes)) {
            $classes[] = 'Nvh-nav-li';
        }

        if ( 
            in_array('current_page_item', $classes) ||
            in_array('current-menu-ancestor', $classes) ||
            in_array('current-menu-parent', $classes) ||
            in_array('current_page_parent', $classes) ||
            in_array('current_page_ancestor', $classes)
        ) {
            $classes[] = 'Nvh_m_active';
        }
       //voir pour faire un méga menu 
       

        return $classes;
    }
    add_filter('nav_menu_css_class', 'NvhCustom_nav_class', 10, 3);
}


/*********************
 * Widget menus
 * 
 *création de la navigation au niveau du footer via un widget
 *
 */
require_once('widgets/social.php');
require_once('widgets/cookies.php');

add_action('widgets_init', function () {
    register_widget(Nvh_Social_Widget::class);
    register_widget(GDPR_Cookie_Banner_Widget::class);
    
    register_sidebar([
        'id'    => 'footer-nav',
        'name'  => __('Footer_nav', 'Nvh'),
        'before_title' => '<div class="footer-title">',
        'after_title'    => '</div>',
        'before_widget' => '<div class="footer_col">',
        'after_widget'   => '</div>'
    ]);
    register_sidebar([
        'id'    => 'blog',
        'name'  => __('Blog sidebar', 'Nvh'),
        'before_title' => '<div class="sidebar_title">',
        'after_title'    => '</div>',
        'before_widget' => '<div class="sidebar_widget">',
        'after_widget'   => '</div>'
    ]);
});