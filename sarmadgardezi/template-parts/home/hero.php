<?php
/**
 * Template part for displaying the hero section
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;

// Image path pointing to user's photo with custom thumbnail support
$portrait_url = sarmadgardezi_asset('images/sarmad.png');
if (has_post_thumbnail()) {
    $portrait_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
}
?>

<section id="hero" class="hero-boxed-section">
    <div class="site-container hero-boxed-container">
        <!-- Left: Rounded Portrait Card -->
        <div class="hero-portrait-col">
            <div class="hero-portrait-card">
                <img 
                    src="<?php echo esc_url($portrait_url); ?>" 
                    alt="<?php esc_attr_e('Sarmad Gardezi', 'sarmadgardezi'); ?>"
                    class="hero-portrait-img"
                    loading="eager"
                    width="320"
                    height="440"
                />
            </div>
        </div>

        <!-- Right: Headline, Bio & Action Buttons -->
        <div class="hero-content-col">
            <h1 class="hero-boxed-headline">
                <span><?php esc_html_e('Engineering at scale.', 'sarmadgardezi'); ?></span>
                <span><?php esc_html_e('Leading with craft.', 'sarmadgardezi'); ?></span>
                <span><?php esc_html_e('Delivering results.', 'sarmadgardezi'); ?></span>
            </h1>

            <p class="hero-boxed-bio">
                <?php
                echo wp_kses_post(
                    __("I'm <strong>Sarmad Gardezi</strong>, <strong>Software Engineer</strong> and <strong>Associate Manager</strong> at <strong>Google Developer Groups Cloud Islamabad</strong>.<br class=\"bio-line-break\">Currently engineering scalable systems, cloud architectures, and high-performance digital products.", 'sarmadgardezi')
                );
                ?>
            </p>

            <div class="hero-boxed-actions">
                <a href="#contact" class="btn-pill btn-pill-dark">
                    <span><?php esc_html_e('Contact', 'sarmadgardezi'); ?></span>
                    <svg class="pill-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                        <polyline points="22,6 12,13 2,6"></polyline>
                    </svg>
                </a>

                <a href="#resume" class="btn-pill btn-pill-outline">
                    <span><?php esc_html_e('Resume', 'sarmadgardezi'); ?></span>
                    <svg class="pill-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <line x1="16" y1="13" x2="8" y2="13"></line>
                        <line x1="16" y1="17" x2="8" y2="17"></line>
                        <polyline points="10 9 9 9 8 9"></polyline>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section>
