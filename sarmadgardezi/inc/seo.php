<?php
/**
 * Rank Math SEO Integration
 *
 * Makes the theme fully compatible with Rank Math for SEO metadata,
 * schema, sitemaps, canonicals, robots, and breadcrumbs.
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;

/**
 * Admin notice to install Rank Math if not active.
 */
function sarmadgardezi_rank_math_notice() {
    if (!defined('RANK_MATH_VERSION') && current_user_can('install_plugins')) {
        ?>
        <div class="notice notice-info is-dismissible">
            <p><strong><?php esc_html_e('Sarmad Gardezi Theme Recommendation:', 'sarmadgardezi'); ?></strong> <?php esc_html_e('To ensure your website ranks properly on Google, please install and activate the Rank Math SEO plugin. The theme is fully optimized for it.', 'sarmadgardezi'); ?></p>
        </div>
        <?php
    }
}
add_action('admin_notices', 'sarmadgardezi_rank_math_notice');

/**
 * Render Breadcrumbs using Rank Math with HTML5 fallback.
 *
 * @param string $class Additional CSS classes for the nav element.
 */
function sarmadgardezi_breadcrumbs($class = '') {
    if (is_front_page()) {
        return;
    }

    $nav_class = 'site-breadcrumbs' . ($class ? ' ' . esc_attr($class) : '');

    if (function_exists('rank_math_the_breadcrumbs')) {
        echo '<nav class="' . esc_attr($nav_class) . '" aria-label="' . esc_attr__('Breadcrumb navigation', 'sarmadgardezi') . '">';
        rank_math_the_breadcrumbs();
        echo '</nav>';
        return;
    }

    // Fallback if Rank Math isn't active
    echo '<nav class="' . esc_attr($nav_class) . '" aria-label="' . esc_attr__('Breadcrumb navigation', 'sarmadgardezi') . '">';
    echo '<ol class="breadcrumbs-list" itemscope itemtype="https://schema.org/BreadcrumbList">';
    
    // Home item
    echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
    echo '<a itemprop="item" href="' . esc_url(home_url('/')) . '"><span itemprop="name">' . esc_html__('Home', 'sarmadgardezi') . '</span></a>';
    echo '<meta itemprop="position" content="1" />';
    echo '<span class="breadcrumb-separator" aria-hidden="true">/</span>';
    echo '</li>';

    $position = 2;

    if (is_home()) {
        echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
        echo '<span itemprop="name" aria-current="page">' . esc_html__('Blog', 'sarmadgardezi') . '</span>';
        echo '<meta itemprop="position" content="' . $position . '" />';
        echo '</li>';
    } elseif (is_singular('post')) {
        $blog_page_id = get_option('page_for_posts');
        $blog_url = $blog_page_id ? get_permalink($blog_page_id) : home_url('/blog/');
        echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
        echo '<a itemprop="item" href="' . esc_url($blog_url) . '"><span itemprop="name">' . esc_html__('Blog', 'sarmadgardezi') . '</span></a>';
        echo '<meta itemprop="position" content="' . $position++ . '" />';
        echo '<span class="breadcrumb-separator" aria-hidden="true">/</span>';
        echo '</li>';
        echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
        echo '<span itemprop="name" aria-current="page">' . esc_html(get_the_title()) . '</span>';
        echo '<meta itemprop="position" content="' . $position . '" />';
        echo '</li>';
    } elseif (is_singular('project')) {
        echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
        echo '<a itemprop="item" href="' . esc_url(home_url('/projects/')) . '"><span itemprop="name">' . esc_html__('Projects', 'sarmadgardezi') . '</span></a>';
        echo '<meta itemprop="position" content="' . $position++ . '" />';
        echo '<span class="breadcrumb-separator" aria-hidden="true">/</span>';
        echo '</li>';
        echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
        echo '<span itemprop="name" aria-current="page">' . esc_html(get_the_title()) . '</span>';
        echo '<meta itemprop="position" content="' . $position . '" />';
        echo '</li>';
    } elseif (is_page()) {
        echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
        echo '<span itemprop="name" aria-current="page">' . esc_html(get_the_title()) . '</span>';
        echo '<meta itemprop="position" content="' . $position . '" />';
        echo '</li>';
    }

    echo '</ol>';
    echo '</nav>';
}

/**
 * Add Rank Math theme support features.
 */
function sarmadgardezi_rank_math_support() {
    // Allows Rank Math to hook into the title tag properly.
    add_theme_support('title-tag');
    // Ensure Rank Math breadcrumbs are supported.
    add_theme_support('rank-math-breadcrumbs');
}
add_action('after_setup_theme', 'sarmadgardezi_rank_math_support');
