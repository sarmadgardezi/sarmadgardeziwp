<?php
/**
 * Custom Post Types Registration
 *
 * Registers Projects, Talks, and Case Studies.
 * Fully compatible with Yoast SEO Premium, REST API (Gutenberg), and custom templates.
 *
 * @package SarmadGardeziCore
 */

defined('ABSPATH') || exit;

/**
 * Register custom post types.
 */
function sarmadgardezi_core_register_post_types() {

    // 1. Projects Custom Post Type
    $project_labels = array(
        'name'                  => _x('Projects', 'Post Type General Name', 'sarmadgardezi-core'),
        'singular_name'         => _x('Project', 'Post Type Singular Name', 'sarmadgardezi-core'),
        'menu_name'             => __('Projects', 'sarmadgardezi-core'),
        'name_admin_bar'        => __('Project', 'sarmadgardezi-core'),
        'archives'              => __('Project Archives', 'sarmadgardezi-core'),
        'attributes'            => __('Project Attributes', 'sarmadgardezi-core'),
        'parent_item_colon'     => __('Parent Project:', 'sarmadgardezi-core'),
        'all_items'             => __('All Projects', 'sarmadgardezi-core'),
        'add_new_item'          => __('Add New Project', 'sarmadgardezi-core'),
        'add_new'               => __('Add New', 'sarmadgardezi-core'),
        'new_item'              => __('New Project', 'sarmadgardezi-core'),
        'edit_item'             => __('Edit Project', 'sarmadgardezi-core'),
        'update_item'           => __('Update Project', 'sarmadgardezi-core'),
        'view_item'             => __('View Project', 'sarmadgardezi-core'),
        'view_items'            => __('View Projects', 'sarmadgardezi-core'),
        'search_items'          => __('Search Project', 'sarmadgardezi-core'),
        'not_found'             => __('No projects found', 'sarmadgardezi-core'),
        'not_found_in_trash'    => __('No projects found in Trash', 'sarmadgardezi-core'),
        'featured_image'        => __('Project Showcase Image', 'sarmadgardezi-core'),
        'set_featured_image'    => __('Set showcase image', 'sarmadgardezi-core'),
        'remove_featured_image' => __('Remove showcase image', 'sarmadgardezi-core'),
        'use_featured_image'    => __('Use as showcase image', 'sarmadgardezi-core'),
        'insert_into_item'      => __('Insert into project', 'sarmadgardezi-core'),
        'uploaded_to_this_item' => __('Uploaded to this project', 'sarmadgardezi-core'),
        'items_list'            => __('Projects list', 'sarmadgardezi-core'),
        'items_list_navigation' => __('Projects list navigation', 'sarmadgardezi-core'),
        'filter_items_list'     => __('Filter projects list', 'sarmadgardezi-core'),
    );

    $project_args = array(
        'label'               => __('Project', 'sarmadgardezi-core'),
        'description'         => __('Portfolio of software engineering and cloud projects', 'sarmadgardezi-core'),
        'labels'              => $project_labels,
        'supports'            => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'revisions'),
        'taxonomies'          => array('technology', 'project-category'),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'menu_position'       => 20,
        'menu_icon'           => 'dashicons-portfolio',
        'show_in_admin_bar'   => true,
        'show_in_nav_menus'   => true,
        'can_export'          => true,
        'has_archive'         => 'projects',
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest'        => true,
        'rewrite'             => array(
            'slug'       => 'projects',
            'with_front' => false,
        ),
    );
    register_post_type('project', $project_args);

    // 2. Talks / Speaking Engagements Custom Post Type
    $talk_labels = array(
        'name'                  => _x('Talks', 'Post Type General Name', 'sarmadgardezi-core'),
        'singular_name'         => _x('Talk', 'Post Type Singular Name', 'sarmadgardezi-core'),
        'menu_name'             => __('Talks', 'sarmadgardezi-core'),
        'name_admin_bar'        => __('Talk', 'sarmadgardezi-core'),
        'archives'              => __('Talk Archives', 'sarmadgardezi-core'),
        'all_items'             => __('All Talks', 'sarmadgardezi-core'),
        'add_new_item'          => __('Add New Talk', 'sarmadgardezi-core'),
        'add_new'               => __('Add New', 'sarmadgardezi-core'),
        'edit_item'             => __('Edit Talk', 'sarmadgardezi-core'),
        'view_item'             => __('View Talk', 'sarmadgardezi-core'),
        'search_items'          => __('Search Talks', 'sarmadgardezi-core'),
        'not_found'             => __('No talks found', 'sarmadgardezi-core'),
        'not_found_in_trash'    => __('No talks found in Trash', 'sarmadgardezi-core'),
        'featured_image'        => __('Talk Cover Image', 'sarmadgardezi-core'),
        'set_featured_image'    => __('Set cover image', 'sarmadgardezi-core'),
    );

    $talk_args = array(
        'label'               => __('Talk', 'sarmadgardezi-core'),
        'description'         => __('Conference talks, workshops, and speaking engagements', 'sarmadgardezi-core'),
        'labels'              => $talk_labels,
        'supports'            => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'revisions'),
        'taxonomies'          => array('technology'),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'menu_position'       => 21,
        'menu_icon'           => 'dashicons-megaphone',
        'show_in_admin_bar'   => true,
        'show_in_nav_menus'   => true,
        'can_export'          => true,
        'has_archive'         => 'talks',
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest'        => true,
        'rewrite'             => array(
            'slug'       => 'talks',
            'with_front' => false,
        ),
    );
    register_post_type('talk', $talk_args);

    // 3. Case Studies Custom Post Type
    $case_labels = array(
        'name'                  => _x('Case Studies', 'Post Type General Name', 'sarmadgardezi-core'),
        'singular_name'         => _x('Case Study', 'Post Type Singular Name', 'sarmadgardezi-core'),
        'menu_name'             => __('Case Studies', 'sarmadgardezi-core'),
        'name_admin_bar'        => __('Case Study', 'sarmadgardezi-core'),
        'archives'              => __('Case Study Archives', 'sarmadgardezi-core'),
        'all_items'             => __('All Case Studies', 'sarmadgardezi-core'),
        'add_new_item'          => __('Add New Case Study', 'sarmadgardezi-core'),
        'add_new'               => __('Add New', 'sarmadgardezi-core'),
        'edit_item'             => __('Edit Case Study', 'sarmadgardezi-core'),
        'view_item'             => __('View Case Study', 'sarmadgardezi-core'),
        'search_items'          => __('Search Case Studies', 'sarmadgardezi-core'),
        'not_found'             => __('No case studies found', 'sarmadgardezi-core'),
        'not_found_in_trash'    => __('No case studies found in Trash', 'sarmadgardezi-core'),
        'featured_image'        => __('Case Study Banner', 'sarmadgardezi-core'),
        'set_featured_image'    => __('Set banner image', 'sarmadgardezi-core'),
    );

    $case_args = array(
        'label'               => __('Case Study', 'sarmadgardezi-core'),
        'description'         => __('In-depth architectural and business transformation case studies', 'sarmadgardezi-core'),
        'labels'              => $case_labels,
        'supports'            => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'revisions'),
        'taxonomies'          => array('technology'),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'menu_position'       => 22,
        'menu_icon'           => 'dashicons-chart-line',
        'show_in_admin_bar'   => true,
        'show_in_nav_menus'   => true,
        'can_export'          => true,
        'has_archive'         => 'case-studies',
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest'        => true,
        'rewrite'             => array(
            'slug'       => 'case-studies',
            'with_front' => false,
        ),
    );
    register_post_type('case-study', $case_args);
}
add_action('init', 'sarmadgardezi_core_register_post_types', 0);
