<?php
/**
 * Custom Taxonomies Registration
 *
 * Registers Technologies and Project Categories.
 *
 * @package SarmadGardeziCore
 */

defined('ABSPATH') || exit;

if (!function_exists('sarmadgardezi_core_register_taxonomies')) :
/**
 * Register custom taxonomies.
 */
function sarmadgardezi_core_register_taxonomies() {

    // 1. Technology Taxonomy (Tags-style, non-hierarchical)
    $tech_labels = array(
        'name'                       => _x('Technologies', 'Taxonomy General Name', 'sarmadgardezi-core'),
        'singular_name'              => _x('Technology', 'Taxonomy Singular Name', 'sarmadgardezi-core'),
        'menu_name'                  => __('Technologies', 'sarmadgardezi-core'),
        'all_items'                  => __('All Technologies', 'sarmadgardezi-core'),
        'new_item_name'              => __('New Technology Name', 'sarmadgardezi-core'),
        'add_new_item'               => __('Add New Technology', 'sarmadgardezi-core'),
        'edit_item'                  => __('Edit Technology', 'sarmadgardezi-core'),
        'update_item'                => __('Update Technology', 'sarmadgardezi-core'),
        'view_item'                  => __('View Technology', 'sarmadgardezi-core'),
        'separate_items_with_commas' => __('Separate technologies with commas', 'sarmadgardezi-core'),
        'add_or_remove_items'        => __('Add or remove technologies', 'sarmadgardezi-core'),
        'choose_from_most_used'      => __('Choose from most used technologies', 'sarmadgardezi-core'),
        'popular_items'              => __('Popular Technologies', 'sarmadgardezi-core'),
        'search_items'               => __('Search Technologies', 'sarmadgardezi-core'),
        'not_found'                  => __('Not Found', 'sarmadgardezi-core'),
    );

    $tech_args = array(
        'labels'                     => $tech_labels,
        'hierarchical'               => false,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'show_in_rest'               => true,
        'rewrite'                    => array(
            'slug'         => 'technology',
            'with_front'   => false,
            'hierarchical' => false,
        ),
    );
    register_taxonomy('technology', array('project', 'case-study', 'talk'), $tech_args);

    // 2. Project Category Taxonomy (Hierarchical)
    $cat_labels = array(
        'name'              => _x('Project Categories', 'Taxonomy General Name', 'sarmadgardezi-core'),
        'singular_name'     => _x('Project Category', 'Taxonomy Singular Name', 'sarmadgardezi-core'),
        'menu_name'         => __('Project Categories', 'sarmadgardezi-core'),
        'all_items'         => __('All Categories', 'sarmadgardezi-core'),
        'parent_item'       => __('Parent Category', 'sarmadgardezi-core'),
        'parent_item_colon' => __('Parent Category:', 'sarmadgardezi-core'),
        'new_item_name'     => __('New Category Name', 'sarmadgardezi-core'),
        'add_new_item'      => __('Add New Category', 'sarmadgardezi-core'),
        'edit_item'         => __('Edit Category', 'sarmadgardezi-core'),
        'update_item'       => __('Update Category', 'sarmadgardezi-core'),
        'view_item'         => __('View Category', 'sarmadgardezi-core'),
        'search_items'      => __('Search Categories', 'sarmadgardezi-core'),
    );

    $cat_args = array(
        'labels'            => $cat_labels,
        'hierarchical'      => true,
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_in_rest'      => true,
        'rewrite'           => array(
            'slug'         => 'project-category',
            'with_front'   => false,
            'hierarchical' => true,
        ),
    );
    register_taxonomy('project-category', array('project'), $cat_args);
}
endif;
add_action('init', 'sarmadgardezi_core_register_taxonomies', 0);
