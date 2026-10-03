<?php
/**
 * Template part for displaying the Cinematic Generation Showcase Banner
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;

// Image path
$showcase_img_url = get_template_directory_uri() . '/assets/images/generation-showcase.jpg';
if (function_exists('get_field')) {
    $custom_img = get_field('showcase_banner_image');
    if (!empty($custom_img)) {
        if (is_array($custom_img) && !empty($custom_img['url'])) {
            $showcase_img_url = $custom_img['url'];
        } elseif (is_string($custom_img)) {
            $showcase_img_url = $custom_img;
        }
    }
}
?>

<section id="generation-showcase" class="generation-showcase-section">
    <div class="generation-showcase-outer">
        <div class="generation-showcase-card">
            
            <!-- Background Image with Dark Fade Gradient -->
            <div class="generation-showcase-bg">
                <img 
                    src="<?php echo esc_url($showcase_img_url); ?>" 
                    alt="<?php esc_attr_e('Generation Cloud and Full Stack Engineering', 'sarmadgardezi'); ?>" 
                    class="generation-bg-image"
                    loading="lazy"
                />
                <div class="generation-gradient-overlay" aria-hidden="true"></div>
            </div>

            <!-- Foreground Content (Left Aligned) -->
            <div class="generation-showcase-content">
                
                <!-- Eyebrow: Logo Monogram + PRESENTS -->
                <div class="generation-eyebrow">
                    <svg class="generation-eyebrow-logo" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="16 18 22 12 16 6"></polyline>
                        <polyline points="8 6 2 12 8 18"></polyline>
                    </svg>
                    <span class="generation-eyebrow-text"><?php esc_html_e('SG PRESENTS', 'sarmadgardezi'); ?></span>
                </div>

                <!-- Main Pixel-Styled Display Headline -->
                <h2 class="generation-title">
                    <span class="generation-title-line"><?php esc_html_e('GENERATION', 'sarmadgardezi'); ?></span>
                    <span class="generation-title-line generation-pixel-text"><?php esc_html_e('CLOUD & CODE', 'sarmadgardezi'); ?></span>
                </h2>

                <!-- Narrative Description -->
                <p class="generation-desc">
                    <?php esc_html_e('Cloud architecture and full stack engineering are closing the gap between idea and impact. Discover real stories of pursuit, scalable system design, and building high-performance software products that scale to millions.', 'sarmadgardezi'); ?>
                </p>

                <!-- CTA Action Buttons -->
                <div class="generation-actions">
                    <a href="<?php echo esc_url(home_url('/talks')); ?>" class="generation-btn-play">
                        <svg class="generation-play-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <polygon points="5 3 19 12 5 21 5 3"></polygon>
                        </svg>
                        <span><?php esc_html_e('Play trailer', 'sarmadgardezi'); ?></span>
                    </a>

                    <a href="<?php echo esc_url(home_url('/contact')); ?>" class="generation-btn-notify" data-cal-trigger>
                        <span><?php esc_html_e('Get notified', 'sarmadgardezi'); ?></span>
                    </a>
                </div>

            </div>

        </div>
    </div>
</section>
