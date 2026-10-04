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

if (!function_exists('sarmadgardezi_core_register_post_types')) :
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

    // 4. Events / Products / Experience Custom Post Type
    $event_labels = array(
        'name'                  => _x('Events & Products', 'Post Type General Name', 'sarmadgardezi-core'),
        'singular_name'         => _x('Event / Product', 'Post Type Singular Name', 'sarmadgardezi-core'),
        'menu_name'             => __('Events', 'sarmadgardezi-core'),
        'name_admin_bar'        => __('Event', 'sarmadgardezi-core'),
        'archives'              => __('Event Archives', 'sarmadgardezi-core'),
        'all_items'             => __('All Events & Products', 'sarmadgardezi-core'),
        'add_new_item'          => __('Add New Event / Product', 'sarmadgardezi-core'),
        'add_new'               => __('Add New', 'sarmadgardezi-core'),
        'edit_item'             => __('Edit Event', 'sarmadgardezi-core'),
        'view_item'             => __('View Event', 'sarmadgardezi-core'),
        'search_items'          => __('Search Events', 'sarmadgardezi-core'),
        'not_found'             => __('No events found', 'sarmadgardezi-core'),
        'not_found_in_trash'    => __('No events found in Trash', 'sarmadgardezi-core'),
        'featured_image'        => __('Event / Brand Logo', 'sarmadgardezi-core'),
        'set_featured_image'    => __('Set logo image', 'sarmadgardezi-core'),
    );

    $event_args = array(
        'label'               => __('Event', 'sarmadgardezi-core'),
        'description'         => __('Product leadership, speaking events, and advisory roles', 'sarmadgardezi-core'),
        'labels'              => $event_labels,
        'supports'            => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'revisions'),
        'taxonomies'          => array('technology'),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'menu_position'       => 23,
        'menu_icon'           => 'dashicons-calendar-alt',
        'show_in_admin_bar'   => true,
        'show_in_nav_menus'   => true,
        'can_export'          => true,
        'has_archive'         => 'events',
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest'        => true,
        'rewrite'             => array(
            'slug'       => 'events',
            'with_front' => false,
        ),
    );
    register_post_type('event', $event_args);

    // 5. Featured Series Custom Post Type
    $featured_labels = array(
        'name'                  => _x('Featured', 'Post Type General Name', 'sarmadgardezi-core'),
        'singular_name'         => _x('Featured Series', 'Post Type Singular Name', 'sarmadgardezi-core'),
        'menu_name'             => __('Featured', 'sarmadgardezi-core'),
        'name_admin_bar'        => __('Featured Series', 'sarmadgardezi-core'),
        'archives'              => __('Featured Archives', 'sarmadgardezi-core'),
        'all_items'             => __('All Featured Series', 'sarmadgardezi-core'),
        'add_new_item'          => __('Add New Featured Series', 'sarmadgardezi-core'),
        'add_new'               => __('Add New', 'sarmadgardezi-core'),
        'edit_item'             => __('Edit Featured Series', 'sarmadgardezi-core'),
        'view_item'             => __('View Featured Series', 'sarmadgardezi-core'),
        'search_items'          => __('Search Featured Series', 'sarmadgardezi-core'),
        'not_found'             => __('No featured series found', 'sarmadgardezi-core'),
        'not_found_in_trash'    => __('No featured series found in Trash', 'sarmadgardezi-core'),
        'featured_image'        => __('Cover Image', 'sarmadgardezi-core'),
        'set_featured_image'    => __('Set cover image', 'sarmadgardezi-core'),
        'remove_featured_image' => __('Remove cover image', 'sarmadgardezi-core'),
        'use_featured_image'    => __('Use as cover image', 'sarmadgardezi-core'),
    );

    // Register featured_category taxonomy
    register_taxonomy('featured_category', array('featured'), array(
        'hierarchical'      => true,
        'labels'            => array(
            'name'              => _x('Categories', 'taxonomy general name', 'sarmadgardezi-core'),
            'singular_name'     => _x('Category', 'taxonomy singular name', 'sarmadgardezi-core'),
            'search_items'      => __('Search Categories', 'sarmadgardezi-core'),
            'all_items'         => __('All Categories', 'sarmadgardezi-core'),
            'edit_item'         => __('Edit Category', 'sarmadgardezi-core'),
            'update_item'       => __('Update Category', 'sarmadgardezi-core'),
            'add_new_item'      => __('Add New Category', 'sarmadgardezi-core'),
            'new_item_name'     => __('New Category Name', 'sarmadgardezi-core'),
            'menu_name'         => __('Categories', 'sarmadgardezi-core'),
        ),
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'show_in_rest'      => true,
        'rewrite'           => array('slug' => 'featured-category'),
    ));

    $featured_args = array(
        'label'               => __('Featured', 'sarmadgardezi-core'),
        'description'         => __('Featured series, podcasts, web design, and documentaries', 'sarmadgardezi-core'),
        'labels'              => $featured_labels,
        'supports'            => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'page-attributes', 'revisions'),
        'taxonomies'          => array('featured_category'),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'menu_position'       => 21,
        'menu_icon'           => 'dashicons-video-alt3',
        'show_in_admin_bar'   => true,
        'show_in_nav_menus'   => true,
        'can_export'          => true,
        'has_archive'         => 'featured',
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest'        => true,
        'rewrite'             => array(
            'slug'       => 'featured',
            'with_front' => false,
        ),
    );
    register_post_type('featured', $featured_args);
}
endif;
add_action('init', 'sarmadgardezi_core_register_post_types', 0);
