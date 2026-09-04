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
            'default-color' => '0a0d14',
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

        // Gutenberg / block editor alignments.
        add_theme_support('align-wide');
        add_theme_support('responsive-embeds');

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
