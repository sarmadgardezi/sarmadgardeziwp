<?php
/**
 * Yoast SEO Integration and Schema Bridge
 *
 * Sarmad Gardezi Theme treats Yoast SEO / Yoast SEO Premium as the sole authority
 * for document title, meta descriptions, canonical URLs, robots directives,
 * Open Graph, Twitter cards, XML sitemaps, and Schema.org JSON-LD graph.
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;

/**
 * Render Yoast Breadcrumbs with semantic HTML5 wrapper or fallback.
 *
 * @param string $class Additional CSS classes for the nav element.
 * @return void
 */
function sarmadgardezi_breadcrumbs($class = '') {
    $nav_class = 'site-breadcrumbs' . ($class ? ' ' . esc_attr($class) : '');

    if (function_exists('yoast_breadcrumb')) {
        yoast_breadcrumb(
            '<nav class="' . esc_attr($nav_class) . '" aria-label="' . esc_attr__('Breadcrumb navigation', 'sarmadgardezi') . '">',
            '</nav>'
        );
        return;
    }

    // Fallback if Yoast is not active.
    if (is_front_page()) {
        return;
    }

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
    } elseif (is_singular('talk')) {
        echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
        echo '<a itemprop="item" href="' . esc_url(home_url('/talks/')) . '"><span itemprop="name">' . esc_html__('Talks', 'sarmadgardezi') . '</span></a>';
        echo '<meta itemprop="position" content="' . $position++ . '" />';
        echo '<span class="breadcrumb-separator" aria-hidden="true">/</span>';
        echo '</li>';
        echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
        echo '<span itemprop="name" aria-current="page">' . esc_html(get_the_title()) . '</span>';
        echo '<meta itemprop="position" content="' . $position . '" />';
        echo '</li>';
    } elseif (is_singular('case-study')) {
        echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
        echo '<a itemprop="item" href="' . esc_url(home_url('/case-studies/')) . '"><span itemprop="name">' . esc_html__('Case Studies', 'sarmadgardezi') . '</span></a>';
        echo '<meta itemprop="position" content="' . $position++ . '" />';
        echo '<span class="breadcrumb-separator" aria-hidden="true">/</span>';
        echo '</li>';
        echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
        echo '<span itemprop="name" aria-current="page">' . esc_html(get_the_title()) . '</span>';
        echo '<meta itemprop="position" content="' . $position . '" />';
        echo '</li>';
    } elseif (is_post_type_archive('project')) {
        echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
        echo '<span itemprop="name" aria-current="page">' . esc_html__('Projects', 'sarmadgardezi') . '</span>';
        echo '<meta itemprop="position" content="' . $position . '" />';
        echo '</li>';
    } elseif (is_post_type_archive('talk')) {
        echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
        echo '<span itemprop="name" aria-current="page">' . esc_html__('Talks', 'sarmadgardezi') . '</span>';
        echo '<meta itemprop="position" content="' . $position . '" />';
        echo '</li>';
    } elseif (is_post_type_archive('case-study')) {
        echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
        echo '<span itemprop="name" aria-current="page">' . esc_html__('Case Studies', 'sarmadgardezi') . '</span>';
        echo '<meta itemprop="position" content="' . $position . '" />';
        echo '</li>';
    } elseif (is_page()) {
        echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
        echo '<span itemprop="name" aria-current="page">' . esc_html(get_the_title()) . '</span>';
        echo '<meta itemprop="position" content="' . $position . '" />';
        echo '</li>';
    } elseif (is_archive()) {
        echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
        echo '<span itemprop="name" aria-current="page">' . esc_html(get_the_archive_title()) . '</span>';
        echo '<meta itemprop="position" content="' . $position . '" />';
        echo '</li>';
    } elseif (is_search()) {
        echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
        echo '<span itemprop="name" aria-current="page">' . sprintf(esc_html__('Search: "%s"', 'sarmadgardezi'), get_search_query()) . '</span>';
        echo '<meta itemprop="position" content="' . $position . '" />';
        echo '</li>';
    } elseif (is_404()) {
        echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
        echo '<span itemprop="name" aria-current="page">' . esc_html__('404 Not Found', 'sarmadgardezi') . '</span>';
        echo '<meta itemprop="position" content="' . $position . '" />';
        echo '</li>';
    }

    echo '</ol>';
    echo '</nav>';
}

/**
 * Seamlessly enrich Yoast SEO schema graph without generating duplicate or broken schema blocks.
 *
 * @param array $pieces Yoast Schema pieces.
 * @return array Filtered pieces.
 */
function sarmadgardezi_enrich_yoast_schema_graph($pieces) {
    if (!is_array($pieces)) {
        return $pieces;
    }

    foreach ($pieces as &$piece) {
        if (isset($piece['@type']) && 'Person' === $piece['@type']) {
            if (empty($piece['jobTitle'])) {
                $piece['jobTitle'] = 'Software Engineer';
            }
            if (empty($piece['affiliation'])) {
                $piece['affiliation'] = array(
                    '@type' => 'Organization',
                    'name'  => 'Google Developer Groups Cloud Islamabad',
                );
            }
            $known_profiles = array(
                'https://github.com/sarmadgardezi',
                'https://linkedin.com/in/sarmadgardezi',
                'https://twitter.com/sarmadgardezi',
            );
            if (!isset($piece['sameAs']) || !is_array($piece['sameAs'])) {
                $piece['sameAs'] = $known_profiles;
            } else {
                $piece['sameAs'] = array_values(array_unique(array_merge($piece['sameAs'], $known_profiles)));
            }
        }
    }

    return $pieces;
}
add_filter('wpseo_schema_graph', 'sarmadgardezi_enrich_yoast_schema_graph', 20);

/**
 * Instruct Yoast to register CPTs in breadcrumbs or sitemaps smoothly.
 */
function sarmadgardezi_yoast_cpt_breadcrumbs($links) {
    if (is_singular('project')) {
        $breadcrumb = array(
            'url'  => home_url('/projects/'),
            'text' => __('Projects', 'sarmadgardezi'),
        );
        array_splice($links, 1, 0, array($breadcrumb));
    } elseif (is_singular('talk')) {
        $breadcrumb = array(
            'url'  => home_url('/talks/'),
            'text' => __('Talks', 'sarmadgardezi'),
        );
        array_splice($links, 1, 0, array($breadcrumb));
    } elseif (is_singular('case-study')) {
        $breadcrumb = array(
            'url'  => home_url('/case-studies/'),
            'text' => __('Case Studies', 'sarmadgardezi'),
        );
        array_splice($links, 1, 0, array($breadcrumb));
    }
    return $links;
}
add_filter('wpseo_breadcrumb_links', 'sarmadgardezi_yoast_cpt_breadcrumbs', 10, 1);
