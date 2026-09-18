<?php
/**
 * Helper Functions and Template Utilities
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;

/**
 * Return asset URL helper.
 *
 * @param string $path Relative asset path.
 * @return string Full asset URL.
 */
function sarmadgardezi_asset($path = '') {
    return SARMADGARDEZI_URI . '/assets/' . ltrim($path, '/');
}

/**
 * Calculate approximate reading time for a post.
 *
 * @param int $post_id Post ID.
 * @return string Estimated minutes read.
 */
function sarmadgardezi_reading_time($post_id = null) {
    $content = get_post_field('post_content', $post_id);
    $word_count = str_word_count(strip_tags($content));
    $reading_time = ceil($word_count / 200);
    return max(1, $reading_time) . ' ' . esc_html__('min read', 'sarmadgardezi');
}

/**
 * Render inline SVG icons.
 *
 * @param string $icon Icon key.
 * @param string $class Additional CSS classes.
 * @return string SVG markup.
 */
function sarmadgardezi_get_icon($icon, $class = 'icon') {
    $icons = array(
        'arrow-right' => '<svg class="' . esc_attr($class) . '" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>',
        'github' => '<svg class="' . esc_attr($class) . '" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"></path></svg>',
        'linkedin' => '<svg class="' . esc_attr($class) . '" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path><rect x="2" y="9" width="4" height="12"></rect><circle cx="4" cy="4" r="2"></circle></svg>',
        'twitter' => '<svg class="' . esc_attr($class) . '" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg>',
        'external-link' => '<svg class="' . esc_attr($class) . '" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>',
        'terminal' => '<svg class="' . esc_attr($class) . '" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="4 17 10 11 4 5"></polyline><line x1="12" y1="19" x2="20" y2="19"></line></svg>',
        'mail' => '<svg class="' . esc_attr($class) . '" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>',
        'instagram' => '<svg class="' . esc_attr($class) . '" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>',
        'x' => '<svg class="' . esc_attr($class) . '" width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>',
        'youtube' => '<svg class="' . esc_attr($class) . '" width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>',
        'facebook' => '<svg class="' . esc_attr($class) . '" width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>',
    );

    return isset($icons[$icon]) ? $icons[$icon] : '';
}

/**
 * Retrieve primary navigation items, whether from WordPress registered menu
 * or fallback to default links, with active state and Schema.org metadata.
 *
 * @return array List of nav item arrays: array('title', 'url', 'target', 'active').
 */
function sarmadgardezi_get_nav_items() {
    $menu_items = array();
    $locations  = get_nav_menu_locations();

    if (isset($locations['primary']) && $locations['primary']) {
        $wp_menu = wp_get_nav_menu_object($locations['primary']);
        if ($wp_menu) {
            $raw_items = wp_get_nav_menu_items($wp_menu->term_id);
            if (!empty($raw_items)) {
                $current_url = trailingslashit((is_ssl() ? 'https://' : 'http://') . ($_SERVER['HTTP_HOST'] ?? '') . strtok($_SERVER['REQUEST_URI'] ?? '/', '?'));
                $home_url    = trailingslashit(home_url('/'));

                foreach ($raw_items as $item) {
                    // Only top-level items for the navigation
                    if (!empty($item->menu_item_parent)) {
                        continue;
                    }

                    $item_url  = trailingslashit($item->url);
                    $is_active = false;

                    if (is_front_page()) {
                        $is_active = ($item_url === $home_url);
                    } else {
                        $is_active = ($item_url === $current_url) || !empty($item->current);
                    }

                    $menu_items[] = array(
                        'title'  => $item->title,
                        'url'    => $item->url,
                        'target' => !empty($item->target) ? $item->target : '_self',
                        'active' => $is_active,
                    );
                }
            }
        }
    }

    // Default fallback matching exact custom specification (HOME, ABOUT, CASE STUDIES, BLOG, FAQS, CONTACT)
    if (empty($menu_items)) {
        $req_path = strtok($_SERVER['REQUEST_URI'] ?? '/', '?');
        $clean_path = '/' . trim($req_path, '/');
        if ($clean_path === '//') {
            $clean_path = '/';
        }

        $defaults = array(
            array('title' => __('Home', 'sarmadgardezi'), 'url' => home_url('/'), 'path' => '/'),
            array('title' => __('About', 'sarmadgardezi'), 'url' => home_url('/about'), 'path' => '/about'),
            array('title' => __('Case Studies', 'sarmadgardezi'), 'url' => home_url('/case-studies'), 'path' => '/case-studies'),
            array('title' => __('Blog', 'sarmadgardezi'), 'url' => home_url('/blog'), 'path' => '/blog'),
            array('title' => __('FAQs', 'sarmadgardezi'), 'url' => home_url('/faqs'), 'path' => '/faqs'),
            array('title' => __('Contact', 'sarmadgardezi'), 'url' => home_url('/contact'), 'path' => '/contact'),
        );

        foreach ($defaults as $def) {
            $is_active = false;
            if ($def['path'] === '/') {
                $is_active = is_front_page();
            } else {
                $is_active = (strpos($clean_path, $def['path']) === 0);
            }

            $menu_items[] = array(
                'title'  => $def['title'],
                'url'    => $def['url'],
                'target' => '_self',
                'active' => $is_active,
            );
        }
    }

    return $menu_items;
}

if (!function_exists('sarmad_get_field')) {
    /**
     * Safe accessor for custom fields, checking ACF first with fallback to post meta.
     *
     * @param string   $field_name Field name / key.
     * @param int|null $post_id    Post ID.
     * @return mixed
     */
    function sarmad_get_field($field_name, $post_id = null) {
        if (!$post_id) {
            $post_id = get_the_ID();
        }
        if (!$post_id) {
            return '';
        }

        if (function_exists('get_field')) {
            $acf_val = get_field($field_name, $post_id);
            if ($acf_val !== null && $acf_val !== '' && $acf_val !== false) {
                return $acf_val;
            }
        }

        $val = get_post_meta($post_id, '_' . $field_name, true);
        if ($val !== '') {
            return $val;
        }

        return get_post_meta($post_id, $field_name, true);
    }
}

if (!function_exists('sarmadgardezi_get_field')) {
    /**
     * Safe accessor alias for custom fields.
     *
     * @param string   $field_name Field name / key.
     * @param int|null $post_id    Post ID.
     * @return mixed
     */
    function sarmadgardezi_get_field($field_name, $post_id = null) {
        return sarmad_get_field($field_name, $post_id);
    }
}


