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
 * Register ACF Options Page for Site Brands & Settings if ACF Pro is active.
 */
add_action('acf/init', 'sarmadgardezi_register_acf_options_page');
function sarmadgardezi_register_acf_options_page() {
    if (function_exists('acf_add_options_page')) {
        acf_add_options_page(array(
            'page_title'  => __('Brands Marquee Settings', 'sarmadgardezi'),
            'menu_title'  => __('Brands Marquee', 'sarmadgardezi'),
            'menu_slug'   => 'sarmadgardezi-brands',
            'capability'  => 'edit_theme_options',
            'icon_url'    => 'dashicons-images-alt2',
            'position'    => 58,
            'redirect'    => false,
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

    $front_page_id = get_option('page_on_front');

    $location_rules = array(
        array(
            array(
                'param' => 'page_type',
                'operator' => '==',
                'value' => 'front_page',
            ),
        ),
        array(
            array(
                'param' => 'page_template',
                'operator' => '==',
                'value' => 'front-page.php',
            ),
        ),
        array(
            array(
                'param' => 'options_page',
                'operator' => '==',
                'value' => 'sarmadgardezi-brands',
            ),
        ),
    );

    if ($front_page_id) {
        $location_rules[] = array(
            array(
                'param' => 'post',
                'operator' => '==',
                'value' => (string) $front_page_id,
            ),
        );
    }

    acf_add_local_field_group(array(
        'key' => 'group_sarmadgardezi_brands_marquee',
        'title' => __('Front Page — Brands & Companies Marquee', 'sarmadgardezi'),
        'fields' => array(
            array(
                'key' => 'field_brands_section_title',
                'label' => __('Section Title / Heading', 'sarmadgardezi'),
                'name' => 'brands_section_title',
                'type' => 'text',
                'instructions' => __('Heading displayed above the scrolling logos (leave blank for default).', 'sarmadgardezi'),
                'required' => 0,
                'default_value' => 'Trusted by these amazing companies',
                'placeholder' => 'Trusted by these amazing companies',
            ),
            array(
                'key' => 'field_brand_logos',
                'label' => __('Brand Logos', 'sarmadgardezi'),
                'name' => 'brand_logos',
                'type' => 'repeater',
                'instructions' => __('Upload your custom brand logos. If left empty, default showcase logos will automatically be displayed.', 'sarmadgardezi'),
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
                        'instructions' => __('SVG or transparent PNG recommended.', 'sarmadgardezi'),
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
                        'placeholder' => 'e.g. Clickl, Piab, Design Cuebe, Ahlsell',
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
        'location' => $location_rules,
        'menu_order' => 5,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
    ));
}
