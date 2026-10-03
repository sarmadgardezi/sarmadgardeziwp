<?php
/**
 * Theme Customizer Settings
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;

function sarmadgardezi_customize_register($wp_customize) {
    // ------------------------------------------------------------------------
    // Section: Header & Branding Settings
    // ------------------------------------------------------------------------
    $wp_customize->add_section('sarmadgardezi_header_section', array(
        'title'       => esc_html__('Header & Branding Settings', 'sarmadgardezi'),
        'priority'    => 30,
        'description' => esc_html__('Configure how the logo and site title appear in the header.', 'sarmadgardezi'),
    ));

    // Setting: Branding Display Type
    $wp_customize->add_setting('sarmadgardezi_brand_display', array(
        'default'           => 'title_only',
        'sanitize_callback' => 'sarmadgardezi_sanitize_select',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('sarmadgardezi_brand_display', array(
        'label'       => esc_html__('Branding Display Style', 'sarmadgardezi'),
        'description' => esc_html__('Choose whether to display site title text, image logo, or both.', 'sarmadgardezi'),
        'section'     => 'sarmadgardezi_header_section',
        'type'        => 'select',
        'choices'     => array(
            'title_only' => esc_html__('Site Title Text Only', 'sarmadgardezi'),
            'logo_only'  => esc_html__('Image Logo Only', 'sarmadgardezi'),
            'both'       => esc_html__('Both Logo and Site Title', 'sarmadgardezi'),
        ),
    ));

    // Setting: Brand Text Override (Optional)
    $wp_customize->add_setting('sarmadgardezi_brand_text', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('sarmadgardezi_brand_text', array(
        'label'       => esc_html__('Custom Brand Title Override (Optional)', 'sarmadgardezi'),
        'description' => esc_html__('Leave blank to use the standard WordPress Site Title.', 'sarmadgardezi'),
        'section'     => 'sarmadgardezi_header_section',
        'type'        => 'text',
    ));
}
add_action('customize_register', 'sarmadgardezi_customize_register');

/**
 * Sanitize select options
 */
function sarmadgardezi_sanitize_select($input, $setting) {
    $input   = sanitize_key($input);
    $choices = $setting->manager->get_control($setting->id)->choices;
    return (array_key_exists($input, $choices) ? $input : $setting->default);
}
