<?php
/**
 * Enqueue scripts and styles
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;

/**
 * Enqueue scripts and styles.
 */
function sarmadgardezi_scripts() {
    // Google Fonts (Plus Jakarta Sans & JetBrains Mono)
    wp_enqueue_style(
        'sarmadgardezi-fonts',
        'https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap',
        array(),
        null
    );

    // Main Compiled Stylesheet
    $css_file = '/assets/css/main.min.css';
    $css_path = SARMADGARDEZI_DIR . $css_file;
    $css_ver  = file_exists($css_path) ? filemtime($css_path) : SARMADGARDEZI_VERSION;

    wp_enqueue_style(
        'sarmadgardezi-styles',
        SARMADGARDEZI_URI . $css_file,
        array(),
        $css_ver
    );

    // Navigation Script
    $nav_file = '/assets/js/navigation.js';
    $nav_path = SARMADGARDEZI_DIR . $nav_file;
    if (file_exists($nav_path)) {
        wp_enqueue_script(
            'sarmadgardezi-navigation',
            SARMADGARDEZI_URI . $nav_file,
            array(),
            filemtime($nav_path),
            true
        );
    }

    // Animations Script
    $anim_file = '/assets/js/animations.js';
    $anim_path = SARMADGARDEZI_DIR . $anim_file;
    if (file_exists($anim_path)) {
        wp_enqueue_script(
            'sarmadgardezi-animations',
            SARMADGARDEZI_URI . $anim_file,
            array(),
            filemtime($anim_path),
            true
        );
    }

    // Main App Script
    $main_js_file = '/assets/js/main.js';
    $main_js_path = SARMADGARDEZI_DIR . $main_js_file;
    if (file_exists($main_js_path)) {
        wp_enqueue_script(
            'sarmadgardezi-main',
            SARMADGARDEZI_URI . $main_js_file,
            array(),
            filemtime($main_js_path),
            true
        );

        wp_localize_script('sarmadgardezi-main', 'sarmadgardeziData', array(
            'homeUrl'  => esc_url(home_url('/')),
            'themeUrl' => esc_url(SARMADGARDEZI_URI),
        ));
    }

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }

    // Syntax Highlighting (PrismJS) for Single Posts
    if (is_single()) {
        wp_enqueue_style(
            'prism-theme-okaidia',
            'https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism-okaidia.min.css',
            array(),
            '1.29.0'
        );
        wp_enqueue_script(
            'prism-core',
            'https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/prism.min.js',
            array(),
            '1.29.0',
            true
        );
        wp_enqueue_script(
            'prism-autoloader',
            'https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/plugins/autoloader/prism-autoloader.min.js',
            array('prism-core'),
            '1.29.0',
            true
        );
        wp_enqueue_script(
            'prism-show-language',
            'https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/plugins/show-language/prism-show-language.min.js',
            array('prism-core'),
            '1.29.0',
            true
        );
    }
}
add_action('wp_enqueue_scripts', 'sarmadgardezi_scripts');
