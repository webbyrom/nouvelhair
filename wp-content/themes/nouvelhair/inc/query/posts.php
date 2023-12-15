<?php
/****
 *  @param WP_Query $query
 * * 
 */
defined('ABSPATH') or die('Accés non autorisé!');
add_action('pre_get_posts', function (WP_Query $query) {
    if (is_admin() || !$query->is_main_query()) {
        return;
    }
    
    if ( is_home()) {
        $query->set('posts_per_page', 4);
    }
}, 999);
