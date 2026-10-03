<?php
/**
 * Template part for displaying the Dark Aesthetic Hero section matching reference design
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;

// Avatar / Portrait URL
$portrait_url = get_template_directory_uri() . '/assets/images/sarmad.png';
if (function_exists('get_field')) {
    $custom_hero_photo = get_field('hero_profile_photo');
    if (!empty($custom_hero_photo)) {
        if (is_array($custom_hero_photo) && !empty($custom_hero_photo['url'])) {
            $portrait_url = $custom_hero_photo['url'];
        } elseif (is_string($custom_hero_photo)) {
            $portrait_url = $custom_hero_photo;
        } elseif (is_numeric($custom_hero_photo)) {
            $img_src = wp_get_attachment_image_src($custom_hero_photo, 'full');
            if ($img_src) {
                $portrait_url = $img_src[0];
            }
        }
    }
}

// Workspace / Secondary Thumbnail
$workspace_url = get_template_directory_uri() . '/assets/images/workspace.jpg';

// Author Name
$hero_name = 'Sarmad Gardezi';
if (function_exists('get_field')) {
    $acf_name = get_field('hero_name');
    if (!empty($acf_name)) {
        $hero_name = $acf_name;
    }
}
?>

<section id="hero-v2" class="hero-dark-inline-section">
    <div class="hero-dark-container">
        <div class="hero-dark-content">
            
            <!-- Main Headline with Inline Badges -->
            <h1 class="hero-dark-title">
                <span class="hero-dark-line line-1">
                    <span class="hero-dark-text"><?php esc_html_e("I'm a Cloud Engineer", 'sarmadgardezi'); ?></span>
                    <span class="hero-inline-media hero-avatar-circle" title="<?php echo esc_attr($hero_name); ?>">
                        <img 
                            src="<?php echo esc_url($portrait_url); ?>" 
                            alt="<?php echo esc_attr($hero_name); ?>" 
                            class="hero-inline-img avatar-fit"
                            loading="eager"
                            fetchpriority="high"
                            decoding="async"
                        />
                    </span>
                    <span class="hero-dark-text"><?php esc_html_e('and', 'sarmadgardezi'); ?></span>
                </span>
                <span class="hero-dark-line line-2">
                    <span class="hero-inline-media hero-thumb-rect" title="<?php esc_attr_e('Full Stack Development', 'sarmadgardezi'); ?>">
                        <img 
                            src="<?php echo esc_url($workspace_url); ?>" 
                            alt="<?php esc_attr_e('Cloud and Full Stack Development', 'sarmadgardezi'); ?>" 
                            class="hero-inline-img thumb-fit"
                            loading="eager"
                            decoding="async"
                        />
                    </span>
                    <span class="hero-dark-text"><?php esc_html_e('Full Stack Developer', 'sarmadgardezi'); ?></span>
                </span>
            </h1>

            <!-- Subtitle Description -->
            <p class="hero-dark-subtitle">
                <?php esc_html_e('Architecting scalable cloud infrastructure, high-throughput backend services, and modern interactive digital experiences.', 'sarmadgardezi'); ?>
            </p>

            <!-- Action / Meta Pills Row -->
            <div class="hero-dark-actions">
                <a href="<?php echo esc_url(home_url('/contact')); ?>" class="hero-dark-btn-primary" data-cal-trigger>
                    <span><?php esc_html_e('Get in touch', 'sarmadgardezi'); ?></span>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </a>
                <a href="<?php echo esc_url(home_url('/projects')); ?>" class="hero-dark-btn-secondary">
                    <span><?php esc_html_e('View Projects', 'sarmadgardezi'); ?></span>
                </a>
            </div>

        </div>
    </div>
</section>

