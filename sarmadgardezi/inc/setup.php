<?php
/**
 * Theme Setup and Configuration
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;

if (!function_exists('sarmadgardezi_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     */
    function sarmadgardezi_setup() {
        // Make theme available for translation.
        load_theme_textdomain('sarmadgardezi', SARMADGARDEZI_DIR . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        // Let WordPress manage the document title.
        add_theme_support('title-tag');

        // Enable support for Post Thumbnails on posts and pages.
        add_theme_support('post-thumbnails');
        set_post_thumbnail_size(1200, 675, true); // 16:9 ratio
        add_image_size('sarmadgardezi-card', 640, 360, true);
        add_image_size('sarmadgardezi-portrait', 600, 800, true);

        // Switch default core markup to output valid HTML5.
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        ));

        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', array(
            'default-color' => 'efede5',
        ));

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        // Add support for core custom logo.
        add_theme_support('custom-logo', array(
            'height'      => 80,
            'width'       => 280,
            'flex-width'  => true,
            'flex-height' => true,
        ));

        // Gutenberg / block editor alignments and styles.
        add_theme_support('align-wide');
        add_theme_support('responsive-embeds');
        add_theme_support('wp-block-styles');
        add_theme_support('editor-styles');
        add_editor_style('assets/css/main.min.css');

        // Register navigation menus.
        register_nav_menus(array(
            'primary' => esc_html__('Primary Navigation', 'sarmadgardezi'),
            'footer'  => esc_html__('Footer Navigation', 'sarmadgardezi'),
            'social'  => esc_html__('Social Links Menu', 'sarmadgardezi'),
        ));
    }
endif;
add_action('after_setup_theme', 'sarmadgardezi_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 */
function sarmadgardezi_content_width() {
    $GLOBALS['content_width'] = apply_filters('sarmadgardezi_content_width', 1200);
}
add_action('after_setup_theme', 'sarmadgardezi_content_width', 0);

/**
 * Register widget sidebars.
 */
function sarmadgardezi_widgets_init() {
    register_sidebar(array(
        'name'          => esc_html__('Blog Sidebar', 'sarmadgardezi'),
        'id'            => 'sidebar-1',
        'description'   => esc_html__('Add widgets here to appear in your single blog posts and article pages.', 'sarmadgardezi'),
        'before_widget' => '<section id="%1$s" class="widget %2$s glass-card">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'name'          => esc_html__('Footer Widgets', 'sarmadgardezi'),
        'id'            => 'sidebar-footer',
        'description'   => esc_html__('Add widgets here to appear in your footer area.', 'sarmadgardezi'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="footer-widget-title">',
        'after_title'   => '</h4>',
    ));
}
add_action('widgets_init', 'sarmadgardezi_widgets_init');

