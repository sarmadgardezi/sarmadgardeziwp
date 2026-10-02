<?php
/**
 * Template part for displaying the Company section
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;

// Dynamic ACF / fallback values
$company_name     = 'cobuild';
$company_role     = 'Managing Director';
$company_timeline = '2025–Today';
$company_url      = 'https://cobuild.digital/';

if (function_exists('get_field')) {
    $acf_c_name = get_field('company_name');
    if (!empty($acf_c_name)) $company_name = $acf_c_name;
    
    $acf_c_role = get_field('company_role');
    if (!empty($acf_c_role)) $company_role = $acf_c_role;

    $acf_c_timeline = get_field('company_timeline');
    if (!empty($acf_c_timeline)) $company_timeline = $acf_c_timeline;

    $acf_c_url = get_field('company_url');
    if (!empty($acf_c_url)) $company_url = $acf_c_url;
}

$asset_base = function_exists('sarmadgardezi_asset') 
    ? sarmadgardezi_asset('') 
    : get_template_directory_uri() . '/assets/';
$cobuild_logo = rtrim($asset_base, '/') . '/images/brands/cobuild.svg';
?>

<section id="company-section" class="company-section" aria-label="<?php esc_attr_e('Company', 'sarmadgardezi'); ?>">
    <div class="site-container company-container">
        
        <h2 class="reveal company-section-heading" style="--stagger:2"><?php esc_html_e('Company', 'sarmadgardezi'); ?></h2>
        
        <div class="reveal company-row-wrap" style="--stagger:3">
            <a href="<?php echo esc_url($company_url); ?>" target="_blank" rel="noopener noreferrer" class="group company-item-link">
                
                <!-- Logo Slot -->
                <span class="company-logo-slot">
                    <img src="<?php echo esc_url($cobuild_logo); ?>" alt="<?php echo esc_attr($company_name); ?>" class="company-logo-img" loading="lazy" />
                </span>

                <!-- Name & Hover Arrow -->
                <span class="company-name-slot">
                    <?php echo esc_html($company_name); ?>
                    <svg viewBox="0 0 16 16" aria-hidden="true" class="company-arrow-pill">
                        <rect width="16" height="16" rx="8" fill="#CEAFFA"></rect>
                        <path d="M5 8h6M8.2 5 11 8l-2.8 3" fill="none" stroke="#121212" stroke-width="1.5" stroke-linecap="square" stroke-linejoin="round"></path>
                    </svg>
                </span>

                <!-- Role / Subtitle -->
                <span class="company-role-slot">
                    <?php echo esc_html($company_role); ?>
                </span>

                <!-- Timeline -->
                <span class="company-timeline-slot">
                    <?php echo esc_html($company_timeline); ?>
                </span>

            </a>
        </div>

    </div>
</section>
