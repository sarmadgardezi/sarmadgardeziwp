<?php
/**
 * Global Analytics & Search Console Integration
 *
 * Provides Customizer settings and script injection for GA4 and Search Console.
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;

/**
 * Register Customizer settings for Analytics.
 */
function sarmadgardezi_analytics_customize_register($wp_customize) {
    // Add SEO & Analytics Section
    $wp_customize->add_section('sarmadgardezi_analytics_section', array(
        'title'    => __('SEO & Analytics', 'sarmadgardezi'),
        'priority' => 30,
        'panel'    => 'theme_options', // Optional: attach to a panel if it exists
    ));

    // GA4 Measurement ID
    $wp_customize->add_setting('sarmadgardezi_ga4_id', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('sarmadgardezi_ga4_id', array(
        'label'       => __('GA4 Measurement ID', 'sarmadgardezi'),
        'description' => __('Enter your Measurement ID (e.g. G-XXXXXXXXXX)', 'sarmadgardezi'),
        'section'     => 'sarmadgardezi_analytics_section',
        'type'        => 'text',
    ));

    // Google Site Verification
    $wp_customize->add_setting('sarmadgardezi_gsc_verification', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('sarmadgardezi_gsc_verification', array(
        'label'       => __('Google Site Verification Code', 'sarmadgardezi'),
        'description' => __('Enter the string code for <meta name="google-site-verification" content="...">', 'sarmadgardezi'),
        'section'     => 'sarmadgardezi_analytics_section',
        'type'        => 'text',
    ));
}
add_action('customize_register', 'sarmadgardezi_analytics_customize_register');

/**
 * Inject tracking codes into <head>.
 */
function sarmadgardezi_inject_analytics_scripts() {
    // 1. Google Site Verification
    $gsc_code = get_theme_mod('sarmadgardezi_gsc_verification');
    if (!empty($gsc_code)) {
        echo '<!-- Google Site Verification -->' . "\n";
        echo '<meta name="google-site-verification" content="' . esc_attr($gsc_code) . '" />' . "\n";
    }

    // 2. Google Analytics 4 (gtag.js)
    $ga4_id = get_theme_mod('sarmadgardezi_ga4_id');
    if (!empty($ga4_id)) {
        ?>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo esc_attr($ga4_id); ?>"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', '<?php echo esc_attr($ga4_id); ?>');
</script>
        <?php
    }
}
add_action('wp_head', 'sarmadgardezi_inject_analytics_scripts', 5);
