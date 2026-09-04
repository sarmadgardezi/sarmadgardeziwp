<?php
/**
 * Schema.org Structured Data & Google Sitelinks Integration
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;

/**
 * Output JSON-LD Schema in the head for Google Sitelinks & Site Navigation.
 */
function sarmadgardezi_output_schema_jsonld() {
    $site_url  = esc_url(home_url('/'));
    $site_name = get_bloginfo('name');
    $site_desc = get_bloginfo('description');

    $graph = array();

    // 1. WebSite Schema with Sitelinks Searchbox
    $graph[] = array(
        '@type'           => 'WebSite',
        '@id'             => $site_url . '#website',
        'url'             => $site_url,
        'name'            => $site_name,
        'description'     => $site_desc,
        'inLanguage'      => get_bloginfo('language'),
        'potentialAction' => array(
            '@type'       => 'SearchAction',
            'target'      => array(
                '@type'       => 'EntryPoint',
                'urlTemplate' => $site_url . '?s={search_term_string}',
            ),
            'query-input' => 'required name=search_term_string',
        ),
    );

    // 2. Person Schema for Sarmad Gardezi
    $graph[] = array(
        '@type'       => 'Person',
        '@id'         => $site_url . '#person',
        'name'        => 'Sarmad Gardezi',
        'jobTitle'    => 'Software Engineer',
        'affiliation' => array(
            '@type' => 'Organization',
            'name'  => 'Google Developer Groups Cloud Islamabad',
        ),
        'url'         => $site_url,
        'sameAs'      => array(
            'https://github.com/sarmadgardezi',
            'https://linkedin.com/in/sarmadgardezi',
            'https://twitter.com/sarmadgardezi',
        ),
    );

    // 3. SiteNavigationElement Schema dynamically populated from Primary Menu
    $nav_items = array();
    $locations = get_nav_menu_locations();

    if (isset($locations['primary']) && $locations['primary'] !== 0) {
        $menu = wp_get_nav_menu_object($locations['primary']);
        if ($menu) {
            $menu_items = wp_get_nav_menu_items($menu->term_id);
            if (!empty($menu_items)) {
                $position = 1;
                foreach ($menu_items as $item) {
                    // Only top-level items for sitelinks
                    if (empty($item->menu_item_parent)) {
                        $nav_items[] = array(
                            '@type'    => 'SiteNavigationElement',
                            'position' => $position++,
                            'name'     => $item->title,
                            'url'      => esc_url($item->url),
                        );
                    }
                }
            }
        }
    }

    // Fallback if no custom menu is created yet
    if (empty($nav_items)) {
        $default_links = array(
            array('name' => __('Home', 'sarmadgardezi'), 'url' => home_url('/')),
            array('name' => __('About', 'sarmadgardezi'), 'url' => home_url('/#about')),
            array('name' => __('Projects', 'sarmadgardezi'), 'url' => home_url('/#projects')),
            array('name' => __('Case Studies', 'sarmadgardezi'), 'url' => home_url('/#case-studies')),
            array('name' => __('Contact', 'sarmadgardezi'), 'url' => home_url('/#contact')),
        );

        $position = 1;
        foreach ($default_links as $link) {
            $nav_items[] = array(
                '@type'    => 'SiteNavigationElement',
                'position' => $position++,
                'name'     => $link['name'],
                'url'      => esc_url($link['url']),
            );
        }
    }

    if (!empty($nav_items)) {
        $graph[] = array(
            '@type'           => 'ItemList',
            '@id'             => $site_url . '#sitenavigation',
            'name'            => esc_html__('Header Navigation Menu', 'sarmadgardezi'),
            'itemListElement' => $nav_items,
        );
    }

    $schema_data = array(
        '@context' => 'https://schema.org',
        '@graph'   => $graph,
    );

    echo "\n<!-- Google Sitelinks & Navigation Schema -->\n";
    echo '<script type="application/ld+json">' . "\n";
    echo wp_json_encode($schema_data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    echo "\n</script>\n<!-- /Google Sitelinks Schema -->\n\n";
}
add_action('wp_head', 'sarmadgardezi_output_schema_jsonld', 1);

/**
 * Add Schema Microdata attributes to nav menu links.
 *
 * @param array    $atts HTML attributes applied to the menu item's `<a>` element.
 * @param WP_Post  $item The current menu item.
 * @param stdClass $args An object of wp_nav_menu() arguments.
 * @return array Modified attributes.
 */
function sarmadgardezi_nav_menu_link_attributes($atts, $item, $args) {
    if (isset($args->theme_location) && 'primary' === $args->theme_location) {
        $atts['itemprop'] = 'url';
    }
    return $atts;
}
add_filter('nav_menu_link_attributes', 'sarmadgardezi_nav_menu_link_attributes', 10, 3);

/**
 * Add Schema itemprop="name" to menu item title text.
 *
 * @param string   $title The menu item's title.
 * @param WP_Post  $item  The current menu item.
 * @param stdClass $args  An object of wp_nav_menu() arguments.
 * @return string Modified title markup.
 */
function sarmadgardezi_nav_menu_item_title($title, $item, $args) {
    if (isset($args->theme_location) && 'primary' === $args->theme_location) {
        return '<span itemprop="name">' . esc_html($title) . '</span>';
    }
    return $title;
}
add_filter('nav_menu_item_title', 'sarmadgardezi_nav_menu_item_title', 10, 3);
