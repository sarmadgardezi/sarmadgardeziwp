<?php
/**
 * Template part for displaying the Mission / Double Visuals Section
 *
 * Faithfully matches the reference design:
 * - Left: 2 rounded visual cards with floating metric badges & media control
 * - Right: Pill badge, bold condensed headline, description, and pill CTA
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;

// Editable section data
$mission_badge = __('Our mission', 'sarmadgardezi');
$mission_heading = __('WE MAKE REAL PEOPLE YOUR BEST MARKETING ASSET.', 'sarmadgardezi');
$mission_description = __('UGC grounded in performance data. We find the right creators, test the right hooks, and build content that earns attention and actually converts it into revenue.', 'sarmadgardezi');
$mission_cta_text = __('See how we do it', 'sarmadgardezi');
$mission_cta_url = home_url('/contact');

// Visual cards photos (Easy to replace)
$photo_1 = 'https://res.cloudinary.com/dy7my4aub/image/upload/v1773469584/Gemini_Generated_Image_p7m59zp7m59zp7m5_buse2a.png';
$photo_2 = 'https://res.cloudinary.com/dy7my4aub/image/upload/v1773559127/Screenshot_2026-03-15_at_12.18.26_PM_bp8cpg.png';
?>

<section class="mission-showcase-section">
    <div class="mission-showcase-container">

        <!-- Left Column: 2 Visual Cards with Floating Badges -->
        <div class="mission-visuals-col">
            
            <!-- Card 1 (Left) -->
            <div class="mission-card mission-card-1">
                <!-- Floating Top-Left Badge: Heart 12M -->
                <div class="mission-floating-badge badge-top-left badge-dark">
                    <span class="badge-icon badge-heart" aria-hidden="true">❤️</span>
                    <span class="badge-text"><?php esc_html_e('12M', 'sarmadgardezi'); ?></span>
                </div>

                <div class="mission-card-inner">
                    <img 
                        src="<?php echo esc_url($photo_1); ?>" 
                        alt="<?php esc_attr_e('Mission visual 1', 'sarmadgardezi'); ?>"
                        width="380"
                        height="480"
                        loading="lazy"
                        class="mission-card-img"
                    />

                    <!-- Media Control Glass Pause Button -->
                    <button type="button" class="mission-media-control" aria-label="<?php esc_attr_e('Pause video preview', 'sarmadgardezi'); ?>">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <rect x="6" y="4" width="4" height="16" rx="1.5"></rect>
                            <rect x="14" y="4" width="4" height="16" rx="1.5"></rect>
                        </svg>
                    </button>
                </div>

                <!-- Floating Bottom-Right Badge: Comments 82+ -->
                <div class="mission-floating-badge badge-bottom-right badge-light">
                    <span class="badge-icon badge-comment" aria-hidden="true">💬</span>
                    <span class="badge-text"><?php esc_html_e('82+', 'sarmadgardezi'); ?></span>
                </div>
            </div>

            <!-- Card 2 (Right) -->
            <div class="mission-card mission-card-2">
                <!-- Floating Top-Right Badge: Eye 18.8M -->
                <div class="mission-floating-badge badge-top-right badge-white">
                    <span class="badge-icon badge-eye" aria-hidden="true">👁️</span>
                    <span class="badge-text"><?php esc_html_e('18.8M', 'sarmadgardezi'); ?></span>
                </div>

                <div class="mission-card-inner">
                    <img 
                        src="<?php echo esc_url($photo_2); ?>" 
                        alt="<?php esc_attr_e('Mission visual 2', 'sarmadgardezi'); ?>"
                        width="380"
                        height="480"
                        loading="lazy"
                        class="mission-card-img"
                    />
                </div>
            </div>

        </div>

        <!-- Right Column: Editorial Narrative & CTA -->
        <div class="mission-content-col">
            
            <!-- Top Tag / Pill Badge -->
            <div class="mission-badge-wrap">
                <span class="mission-badge">
                    <?php echo esc_html($mission_badge); ?>
                </span>
            </div>

            <!-- Main Impact Heading -->
            <h2 class="mission-heading">
                <?php echo esc_html($mission_heading); ?>
            </h2>

            <!-- Narrative Description -->
            <p class="mission-description">
                <?php echo esc_html($mission_description); ?>
            </p>

            <!-- CTA Pill Button -->
            <div class="mission-cta-wrap">
                <a href="<?php echo esc_url($mission_cta_url); ?>" class="mission-cta-btn">
                    <span class="cta-arrow-circle" aria-hidden="true">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </span>
                    <span class="cta-text"><?php echo esc_html($mission_cta_text); ?></span>
                </a>
            </div>

        </div>

    </div>
</section>
