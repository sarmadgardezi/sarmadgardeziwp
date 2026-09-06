<?php
/**
 * ACF Field Groups Registration
 *
 * Provides native ACF registration for the Brands / Client Logos marquee section.
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;

/**
 * Register ACF Options Page for Site Brands & Hero Settings if ACF Pro is active.
 */
add_action('acf/init', 'sarmadgardezi_register_acf_options_page');
function sarmadgardezi_register_acf_options_page() {
    if (function_exists('acf_add_options_sub_page')) {
        acf_add_options_sub_page(array(
            'page_title'  => __('Brands & Teams Marquee', 'sarmadgardezi'),
            'menu_title'  => __('Brands Marquee', 'sarmadgardezi'),
            'parent_slug' => 'themes.php',
            'menu_slug'   => 'sarmadgardezi-brands',
            'capability'  => 'edit_theme_options',
        ));
    }
}

/**
 * Register ACF Field Group for Brands Marquee.
 */
add_action('acf/include_fields', 'sarmadgardezi_register_brands_acf_fields');
add_action('acf/init', 'sarmadgardezi_register_brands_acf_fields');
function sarmadgardezi_register_brands_acf_fields() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    // Prevent duplicate registration
    static $registered = false;
    if ($registered) {
        return;
    }
    $registered = true;

    acf_add_local_field_group(array(
        'key' => 'group_sarmadgardezi_brands_marquee',
        'title' => __('Front Page — Brands & Teams Marquee', 'sarmadgardezi'),
        'fields' => array(
            array(
                'key' => 'field_brands_section_title',
                'label' => __('Section Title / Heading', 'sarmadgardezi'),
                'name' => 'brands_section_title',
                'type' => 'text',
                'instructions' => __('The small uppercase heading displayed above the scrolling logos.', 'sarmadgardezi'),
                'required' => 0,
                'default_value' => 'I HAVE WORKED WITH TEAMS AT',
                'placeholder' => 'I HAVE WORKED WITH TEAMS AT',
            ),
            array(
                'key' => 'field_brand_logos',
                'label' => __('Brand Logos', 'sarmadgardezi'),
                'name' => 'brand_logos',
                'type' => 'repeater',
                'instructions' => __('Upload brand logos to display in the continuous infinite marquee. On hover, the marquee automatically pauses.', 'sarmadgardezi'),
                'required' => 0,
                'collapsed' => 'field_brand_name',
                'min' => 0,
                'max' => 0,
                'layout' => 'table',
                'button_label' => __('+ Add Brand Logo', 'sarmadgardezi'),
                'sub_fields' => array(
                    array(
                        'key' => 'field_brand_logo',
                        'label' => __('Logo Image', 'sarmadgardezi'),
                        'name' => 'brand_logo',
                        'type' => 'image',
                        'instructions' => __('SVG or transparent PNG recommended (min 120px wide).', 'sarmadgardezi'),
                        'required' => 1,
                        'return_format' => 'array',
                        'preview_size' => 'medium',
                        'library' => 'all',
                    ),
                    array(
                        'key' => 'field_brand_name',
                        'label' => __('Brand Name', 'sarmadgardezi'),
                        'name' => 'brand_name',
                        'type' => 'text',
                        'instructions' => __('Used for accessibility (alt text).', 'sarmadgardezi'),
                        'required' => 0,
                        'placeholder' => 'e.g. Google, Sony, Flipkart',
                    ),
                    array(
                        'key' => 'field_brand_url',
                        'label' => __('Website URL (Optional)', 'sarmadgardezi'),
                        'name' => 'brand_url',
                        'type' => 'url',
                        'instructions' => __('Optional link destination when user clicks the logo.', 'sarmadgardezi'),
                        'required' => 0,
                        'placeholder' => 'https://...',
                    ),
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'page_type',
                    'operator' => '==',
                    'value' => 'front_page',
                ),
            ),
            array(
                array(
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'sarmadgardezi-brands',
                ),
            ),
        ),
        'menu_order' => 5,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
    ));
}
