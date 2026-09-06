<?php
/**
 * SEO URL Parity, Legacy Redirects & Sitemap Hygiene
 *
 * Ensures 100% URL parity with legacy Next.js routes, eliminating 404 crawl errors
 * in Google Search Console and preventing duplicate thin archives from diluting rank.
 *
 * @package SarmadGardeziCore
 */

defined('ABSPATH') || exit;

if (!function_exists('sarmadgardezi_core_handle_seo_redirects')) :
/**
 * Handle legacy Next.js URL aliases and SEO redirects.
 */
function sarmadgardezi_core_handle_seo_redirects() {
    if (is_admin() || (defined('DOING_AJAX') && DOING_AJAX)) {
        return;
    }

    $request_uri = !empty($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
    $path        = trim((string) parse_url($request_uri, PHP_URL_PATH), '/');

    // 1. Next.js Legacy Sitemap & Feed routes
    if ('sitemap-dynamic.xml' === $path || 'news-sitemap.xml' === $path) {
        wp_safe_redirect(home_url('/sitemap_index.xml'), 301);
        exit;
    }

    if ('rss.xml' === $path) {
        wp_safe_redirect(home_url('/feed/'), 301);
        exit;
    }

    // 2. Legacy page slugs
    if ('aboutme' === $path) {
        wp_safe_redirect(home_url('/about/'), 301);
        exit;
    }

    if ('webdevelopment' === $path) {
        wp_safe_redirect(home_url('/web-development/'), 301);
        exit;
    }

    if ('casestudies' === $path) {
        wp_safe_redirect(home_url('/case-studies/'), 301);
        exit;
    }

    // 3. Single author site hygiene: redirect author pages to /about/
    if (is_author()) {
        wp_safe_redirect(home_url('/about/'), 301);
        exit;
    }

    // 4. Date archives hygiene: prevent thin duplicate archives from indexing
    if (is_date()) {
        wp_safe_redirect(home_url('/blog/'), 301);
        exit;
    }

    // 5. Attachment pages: redirect media pages to their post or home
    if (is_attachment()) {
        global $post;
        if (!empty($post) && !empty($post->post_parent)) {
            wp_safe_redirect(get_permalink($post->post_parent), 301);
        } else {
            wp_safe_redirect(home_url('/'), 301);
        }
        exit;
    }
}
endif;
add_action('template_redirect', 'sarmadgardezi_core_handle_seo_redirects');

if (!function_exists('sarmadgardezi_core_yoast_sitemap_taxonomies')) :
/**
 * Filter Yoast SEO sitemap to exclude thin/empty taxonomies if desired.
 */
function sarmadgardezi_core_yoast_sitemap_taxonomies($taxonomies) {
    // Keep standard sitemap clean
    return $taxonomies;
}
endif;
add_filter('wpseo_sitemap_taxonomies', 'sarmadgardezi_core_yoast_sitemap_taxonomies');
