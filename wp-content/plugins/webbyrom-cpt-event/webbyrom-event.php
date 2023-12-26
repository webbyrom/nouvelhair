<?php
defined('ABSPATH') or die();
/**
 * Plugin Name: Webbyrom custom post type
 * Plugin URI: https://web-byrom.com
 * Description: Custom post type pour pour le salon de coiffure Nouvel'Hair
 * Version: 1.0.3
 * Author: Romain Fourel
 * Author URI: https://web-byrom.com
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Requires at least: 6.0.0
 * Tested up to: 6.2.2
 * Requires PHP: 8.0
 * Tags: prise en charge de custom posts type pour les événéments
 * Stable tag: 1.0
 */
add_action('init', function () {

    register_post_type('coiffure', [
        'label' => ('Coiffure'),
        'menu_icon' => get_template_directory_uri() . "/assets/logo/icone-visage.svg",
        'labels' => [
            'name'  =>  __('Coiffure', 'nouvelhair'),
            'singular_name' => __('Coiffure', 'pealudejudo'),
            'edit_item' => __('Modifer Coiffure', 'nouvelhair'),
            'new_item'  => __('Nouveau Coiffure', 'nouvelhair'),
            'view_item' => __('Voir Coiffure', 'nouvelhair'),
            'view_items' => __('Voir Coiffure', 'nouvelhair'),
            'search_items' => __('Recherche Coiffure', 'nouvelhair'),
            'not_found' => __('Pas d\' Coiffures trouvés', 'nouvelhair'),
            'not_found_in_trash' => __('pas de Coiffure trouvé à la poubelle', 'nouvelhair'),
            'all_items' => __('Tous les Coiffures', 'nouvelhair'),
            'archives'  => __('Archives Coiffures', 'nouvelhair'),
            'attributes'    => __('Attributs Coiffure', 'nouvelhair'),
            'insert_into_item'  => __('Insertion dans Coiffure', 'nouvelhair'),
            'uploaded_to_this_item' => __('Charger dans Coiffure', 'nouvelhair'),
            'filter_items_list' => __('Filtrer la liste des Coiffure', 'nouvelhair'),
            'items_list_navigation' => __('Navigation dans la liste de Coiffure', 'nouvelhair'),
            'items_list'    => __('Liste des Coiffure', 'nouvelhair'),
            'item_published'    => __('Coiffure publié', 'nouvelhair'),
            'item_published_privately'  => __('Coiffure publié en privé', 'nouvelhair'),
            'item_reverted_to_draft'    => __('Coiffure redevenu brouillon', 'nouvelhair'),
            'item_scheduled'    => __('Coiffure prevu', 'nouvelhair'),
            'item_updated'  => __('Coiffure mis à jour', 'nouvelhair'),
        ],
        'public'  => true,
        'hierarchical'  => true,
        'menu_position' => 5,
        'menu_order'    =>  1,
        'capability_type' => 'post',
        'publicly_queryable' => true,
        'exclude_from_search' =>  false,
        'show_in_nav_menu' => true,
        'show_in_admin_bar' => true,
        'query_var'          => true,
        'rewrite'   => ['slug' => 'coiffure'],
        'taxonomies'  => ['coupe'],
        'supports'  =>  ['title', 'editor', 'custom-fields', 'page-attributes', 'comments', 'author', 'excerpt', 'thumbnail'],
        'show_in_rest'  => true,
        'has_archive'   => true

    ]);
    register_taxonomy('coupe', 'coiffure', [
        'labels' => [
            'name'  => __('Coupes', 'nouvelhair'),
            'singular_name' => __('coupe', 'nouvelhair'),
            'search_items'  => __('Recherche de Coupes', 'nouvelhair'),
            'popular_items' => __('Coupes Populaires', 'nouvelhair'),
            'name_field_description' => __('coupe', 'nouvelhair'),
            'all_items' => __('Toutes les Coupes', 'nouvelhair'),
            'parent_item'   => __('coupe Parente', 'nouvelhair'),
            'parent_item_colon' => __('coupe Parente', 'nouvelhair'),
            'edit_item' => __('Modifier la coupe', 'nouvelhair'),
            'view_item' => __('Voir la coupe', 'nouvelhair'),
            'update_item'   => __('Mettre à jour la coupe', 'nouvelhair'),
            'add_new_item'  => __('Ajouter une nouvelle coupe', 'nouvelhair'),
            'new_item_name' => __('Nouveau nom de coupe', 'nouvelhair'),
            'separate_items_with_commas' => __('Séparer les Coupes avec des virgules', 'nouvelhair'),
            'add_or_remove_items'  => __('Ajouter ou supprimer des Coupes', 'nouvelhair'),
            'choose_from_most_used' => __('Choisir parmi les plus utilisés', 'nouvelhair'),
            'not_found' => __('Rien trouvé', 'nouvelhair'),
            'no_terms'  => __('Pas de conditions', 'nouvelhair'),
            'items_list_navigation' => __('Navigation dans la liste des Coupes', 'nouvelhair'),
            'items_list'  => __('liste des Articles', 'nouvelhair'),
            'most_used' => _x('Le plus utlisé', 'nouvelhair'),
            'back_to_items' => __('&larr; Retour à l\'article', 'nouvelhair'),
        ],
        'show_in_rest' => true,
        'show_ui'   => true,
        'hierarchical' => true,
        'show_in_menu'  => true,
        'show_in_nav_menu' => true,
        'show_in_admin_bar' => true,
        'query_var' => true,
        'public'    => true,
        'exclude_from_search' =>  false,
        'show_admin_column'  => true,
        'show_in_quick_edit'  => true

    ]);
    register_post_type('Ayurvedique', [
        'label' => ('Ayurvedique'),
        'menu_icon' => get_template_directory_uri() . "/assets/logo/icone-visage.svg",
        'labels' => [
            'name'  =>  __('Ayurvedique', 'nouvelhair'),
            'singular_name' => __('Ayurvedique', 'pealudejudo'),
            'edit_item' => __('Modifer Ayurvedique', 'nouvelhair'),
            'new_item'  => __('Nouveau Ayurvedique', 'nouvelhair'),
            'view_item' => __('Voir Ayurvedique', 'nouvelhair'),
            'view_items' => __('Voir Ayurvedique', 'nouvelhair'),
            'search_items' => __('Recherche Ayurvedique', 'nouvelhair'),
            'not_found' => __('Pas d\' Ayurvediques trouvés', 'nouvelhair'),
            'not_found_in_trash' => __('pas de Ayurvedique trouvé à la poubelle', 'nouvelhair'),
            'all_items' => __('Tous les Ayurvediques', 'nouvelhair'),
            'archives'  => __('Archives Ayurvediques', 'nouvelhair'),
            'attributes'    => __('Attributs Ayurvedique', 'nouvelhair'),
            'insert_into_item'  => __('Insertion dans Ayurvedique', 'nouvelhair'),
            'uploaded_to_this_item' => __('Charger dans Ayurvedique', 'nouvelhair'),
            'filter_items_list' => __('Filtrer la liste des Ayurvedique', 'nouvelhair'),
            'items_list_navigation' => __('Navigation dans la liste de Ayurvedique', 'nouvelhair'),
            'items_list'    => __('Liste des Ayurvedique', 'nouvelhair'),
            'item_published'    => __('Ayurvedique publié', 'nouvelhair'),
            'item_published_privately'  => __('Ayurvedique publié en privé', 'nouvelhair'),
            'item_reverted_to_draft'    => __('Ayurvedique redevenu brouillon', 'nouvelhair'),
            'item_scheduled'    => __('Ayurvedique prevu', 'nouvelhair'),
            'item_updated'  => __('Ayurvedique mis à jour', 'nouvelhair'),
        ],
        'public'  => true,
        'hierarchical'  => true,
        'menu_position' => 5,
        'menu_order'    =>  2,
        'capability_type' => 'post',
        'publicly_queryable' => true,
        'exclude_from_search' =>  false,
        'show_in_nav_menu' => true,
        'show_in_admin_bar' => true,
        'query_var'          => true,
        'rewrite'   => ['slug' => 'ayurvedique'],
        'taxonomies'  => ['massage'],
        'supports'  =>  ['title', 'editor', 'custom-fields', 'page-attributes', 'comments', 'author', 'excerpt', 'thumbnail'],
        'show_in_rest'  => true,
        'has_archive'   => true

    ]);
    register_taxonomy('massage', 'Ayurvedique', [
        'labels' => [
            'name'  => __('massages', 'nouvelhair'),
            'singular_name' => __('massage', 'nouvelhair'),
            'search_items'  => __('Recherche de massages', 'nouvelhair'),
            'popular_items' => __('massages Populaires', 'nouvelhair'),
            'name_field_description' => __('massage', 'nouvelhair'),
            'all_items' => __('Toutes les massages', 'nouvelhair'),
            'parent_item'   => __('massage Parente', 'nouvelhair'),
            'parent_item_colon' => __('massage Parente', 'nouvelhair'),
            'edit_item' => __('Modifier la massage', 'nouvelhair'),
            'view_item' => __('Voir la massage', 'nouvelhair'),
            'update_item'   => __('Mettre à jour la massage', 'nouvelhair'),
            'add_new_item'  => __('Ajouter une nouvelle massage', 'nouvelhair'),
            'new_item_name' => __('Nouveau nom de massage', 'nouvelhair'),
            'separate_items_with_commas' => __('Séparer les massages avec des virgules', 'nouvelhair'),
            'add_or_remove_items'  => __('Ajouter ou supprimer des massages', 'nouvelhair'),
            'choose_from_most_used' => __('Choisir parmi les plus utilisés', 'nouvelhair'),
            'not_found' => __('Rien trouvé', 'nouvelhair'),
            'no_terms'  => __('Pas de conditions', 'nouvelhair'),
            'items_list_navigation' => __('Navigation dans la liste des massages', 'nouvelhair'),
            'items_list'  => __('liste des Articles', 'nouvelhair'),
            'most_used' => _x('Le plus utlisé', 'nouvelhair'),
            'back_to_items' => __('&larr; Retour à l\'article', 'nouvelhair'),
        ],
        'show_in_rest' => true,
        'show_ui'   => true,
        'hierarchical' => true,
        'show_in_menu'  => true,
        'show_in_nav_menu' => true,
        'show_in_admin_bar' => true,
        'query_var' => true,
        'public'    => true,
        'exclude_from_search' =>  false,
        'show_admin_column'  => true,
        'show_in_quick_edit'  => true

    ]);
    register_post_type('Partenaire', [
        'label' => ('Partenaire'),
        'menu_icon' => 'dashicons-groups',
        'labels' => [
            'name'  =>  __('Partenaire', 'nouvelhair'),
            'singular_name' => __('Partenaire', 'nouvelhair'),
            'edit_item' => __('Modifer Partenaire', 'nouvelhair'),
            'new_item'  => __('Nouveau Partenaire', 'nouvelhair'),
            'view_item' => __('Voir Partenaire', 'nouvelhair'),
            'view_items' => __('Voir Partenaires', 'nouvelhair'),
            'search_items' => __('Recherche Partenaire', 'nouvelhair'),
            'not_found' => __('Pas d\' Partenaires trouvés', 'nouvelhair'),
            'not_found_in_trash' => __('pas de Partenaire trouvé à la poubelle', 'nouvelhair'),
            'all_items' => __('Tous les Partenaires', 'nouvelhair'),
            'archives'  => __('Archives Partenaires', 'nouvelhair'),
            'attributes'    => __('Attributs Partenaires', 'nouvelhair'),
            'insert_into_item'  => __('Insertion dans Partenaire', 'nouvelhair'),
            'uploaded_to_this_item' => __('Charger dans Partenaire', 'nouvelhair'),
            'filter_items_list' => __('Filtrer la liste des Partenaires', 'nouvelhair'),
            'items_list_navigation' => __('Navigation dans la liste de Partenaire', 'nouvelhair'),
            'items_list'    => __('Liste des Partenaires', 'nouvelhair'),
            'item_published'    => __('Partenaire publié', 'nouvelhair'),
            'item_published_privately'  => __('Partenaire publié en privé', 'nouvelhair'),
            'item_reverted_to_draft'    => __('Partenaire redevenu brouillon', 'nouvelhair'),
            'item_scheduled'    => __('Partenaire prevu', 'nouvelhair'),
            'item_updated'  => __('Partenaire mis à jour', 'nouvelhair'),
        ],
        'public'  => true,
        'hierarchical'  => true,
        'menu_position' => 5,
        'menu_order'    =>  2,
        'capability_type' => 'post',
        'publicly_queryable' => true,
        'exclude_from_search' =>  false,
        'show_in_nav_menu' => true,
        'show_in_admin_bar' => true,
        'query_var'          => true,
        'rewrite'   => ['slug' => 'partenaire'],
        'taxonomies'  => ['fournisseur'],
        'supports'  =>  ['title', 'editor', 'custom-fields', 'page-attributes', 'comments', 'author', 'excerpt', 'thumbnail'],
        'show_in_rest'  => true,
        'has_archive'   => true

    ]);
    register_taxonomy('fournisseur', 'partenaire', [
        'labels' => [
            'name'  => __('Fournisseurs', 'nouvelhair'),
            'singular_name' => __('fournisseur', 'nouvelhair'),
            'search_items'  => __('Recherche de fournisseurs', 'nouvelhair'),
            'popular_items' => __('fournisseurs Populaires', 'nouvelhair'),
            'name_field_description' => __('fournisseur', 'nouvelhair'),
            'all_items' => __('Toutes les fournisseurs', 'nouvelhair'),
            'parent_item'   => __('fournisseur Parent', 'nouvelhair'),
            'parent_item_colon' => __('fournisseur Parent', 'nouvelhair'),
            'edit_item' => __('Modifier le fournisseur', 'nouvelhair'),
            'view_item' => __('Voir le fournisseur', 'nouvelhair'),
            'update_item'   => __('Mettre à jour le fournisseur', 'nouvelhair'),
            'add_new_item'  => __('Ajouter un nouveau fournisseur', 'nouvelhair'),
            'new_item_name' => __('Nouveau nom de fournisseur', 'nouvelhair'),
            'separate_items_with_commas' => __('Séparer les fournisseurs avec des virgules', 'nouvelhair'),
            'add_or_remove_items'  => __('Ajouter ou supprimer des fournisseurs', 'nouvelhair'),
            'choose_from_most_used' => __('Choisir parmi les plus utilisés', 'nouvelhair'),
            'not_found' => __('Rien trouvé', 'nouvelhair'),
            'no_terms'  => __('Pas de conditions', 'nouvelhair'),
            'items_list_navigation' => __('Navigation dans la liste des fournisseurs', 'nouvelhair'),
            'items_list'  => __('liste des Articles', 'nouvelhair'),
            'most_used' => _x('Le plus utlisé', 'nouvelhair'),
            'back_to_items' => __('&larr;Retour à la liste des fournisseurs', 'nouvelhair'),
        ],
        'show_in_rest' => true,
        'show_ui'   => true,
        'hierarchical' => true,
        'show_in_menu'  => true,
        'show_in_nav_menu' => true,
        'show_in_admin_bar' => true,
        'query_var' => true,
        'public'    => true,
        'exclude_from_search' =>  false,
        'show_admin_column'  => true,
        'show_in_quick_edit'  => true

    ]);
});
register_activation_hook(__FILE__, 'flush_rewrite_rules');
register_deactivation_hook(__FILE__, 'flush_rewrite_rules');
//require_once plugin_dir_path(__FILE__) . 'function-event.php';
//require_once plugin_dir_path(__FILE__) . '/inc/event-images.php';

