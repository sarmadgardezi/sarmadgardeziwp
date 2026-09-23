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

/**
 * Fallback Native Meta Box for Page Header Settings
 * In case ACF is not active or the core plugin isn't synced.
 */
add_action('add_meta_boxes', 'sarmadgardezi_theme_add_page_meta');
function sarmadgardezi_theme_add_page_meta() {
    if (!function_exists('acf_add_local_field_group')) {
        add_meta_box(
            'sarmad_theme_page_meta',
            __('Page Header Settings', 'sarmadgardezi'),
            'sarmadgardezi_theme_page_meta_callback',
            'page',
            'normal',
            'high'
        );
    }
}

function sarmadgardezi_theme_page_meta_callback($post) {
    wp_nonce_field('sarmad_page_meta_save', 'sarmad_page_meta_nonce');
    $show_hero = get_post_meta($post->ID, '_page_show_hero', true);
    $hero_title = get_post_meta($post->ID, '_page_hero_title', true);
    $hero_subtitle = get_post_meta($post->ID, '_page_hero_subtitle', true);
    
    if ($show_hero === '') $show_hero = '1';
    ?>
    <div style="padding: 10px 0;">
        <label style="font-weight:600; display: block; margin-bottom: 8px;">
            <input type="checkbox" name="page_show_hero" value="1" <?php checked($show_hero, '1'); ?> />
            <?php esc_html_e('Show Global Page Hero (Title & Excerpt)', 'sarmadgardezi'); ?>
        </label>
        
        <div style="margin-bottom: 12px; margin-top: 15px;">
            <label style="display:block; font-weight:600; margin-bottom:4px;" for="page_hero_title"><?php esc_html_e('Custom Hero Title (Overrides Page Title)', 'sarmadgardezi'); ?></label>
            <input type="text" id="page_hero_title" name="page_hero_title" value="<?php echo esc_attr($hero_title); ?>" style="width: 100%;" placeholder="Leave blank to use default page title" />
        </div>

        <div style="margin-bottom: 12px;">
            <label style="display:block; font-weight:600; margin-bottom:4px;" for="page_hero_subtitle"><?php esc_html_e('Hero Subtitle / Excerpt', 'sarmadgardezi'); ?></label>
            <textarea id="page_hero_subtitle" name="page_hero_subtitle" rows="3" style="width: 100%;" placeholder="Enter a subtitle or description to appear below the title..."><?php echo esc_textarea($hero_subtitle); ?></textarea>
        </div>
        
        <p style="font-size: 12px; color: #666; margin-top: 5px;">
            <?php esc_html_e('If the hero is unchecked, the page will only output the content (ideal for Elementor).', 'sarmadgardezi'); ?>
        </p>
    </div>
    <?php
}

add_action('save_post_page', 'sarmadgardezi_theme_save_page_meta');
function sarmadgardezi_theme_save_page_meta($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!isset($_POST['sarmad_page_meta_nonce']) || !wp_verify_nonce($_POST['sarmad_page_meta_nonce'], 'sarmad_page_meta_save')) return;
    if (!current_user_can('edit_page', $post_id)) return;

    update_post_meta($post_id, '_page_show_hero', isset($_POST['page_show_hero']) ? '1' : '0');
    update_post_meta($post_id, '_page_hero_title', sanitize_text_field($_POST['page_hero_title'] ?? ''));
    update_post_meta($post_id, '_page_hero_subtitle', sanitize_textarea_field($_POST['page_hero_subtitle'] ?? ''));
}

