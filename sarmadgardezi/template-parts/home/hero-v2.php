<?php
/**
 * Template part for displaying the Creative White Hero Section
 * Matching Reference: "Grow [Badge] [Badge] a team together [Badge]",
 * UI/UX copy, "Get for free" & "How its Work", Subject Portrait with
 * Dual-fan Anchor, "Uishyed" Card, Sparkle Stars, Globe Badge & Yellow Arrow.
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;

// Image URL requested by user
$hero_img_url = home_url('/wp-content/uploads/2026/10/sarmadgardezihero2.png');
$fallback_img_url = get_template_directory_uri() . '/assets/images/sarmad-hero.jpg';
?>

<section id="hero" class="hero-creative-section">
    <div class="hero-creative-container">
        
        <!-- Left Column: Creative Typography & Copy -->
        <div class="hero-creative-content">
            
            <h1 class="hero-creative-title">
                
                <!-- Line 1: "Grow" + Capsule Arrow Badge -->
                <span class="hero-title-line">
                    <span class="title-word">Grow</span>
                    <span class="badge-capsule-arrow" aria-hidden="true">
                        <span class="badge-circle-green"></span>
                        <span class="badge-body-blue">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </span>
                    </span>
                </span>

                <!-- Line 2: Circle Dot + Outline Capsule + "a team" -->
                <span class="hero-title-line">
                    <span class="badge-circle-dot" aria-hidden="true">
                        <span class="inner-dot"></span>
                    </span>
                    <span class="badge-capsule-outline" aria-hidden="true">
                        <span class="inner-bar"></span>
                    </span>
                    <span class="title-word">a team</span>
                </span>

                <!-- Line 3: "together" + Duo Circles Badge -->
                <span class="hero-title-line">
                    <span class="title-word">together</span>
                    <span class="badge-duo-circles" aria-hidden="true">
                        <span class="circle-yellow"></span>
                        <span class="circle-dark">
                            <span class="connecting-line"></span>
                        </span>
                    </span>
                </span>

            </h1>

            <p class="hero-creative-desc">
                <?php esc_html_e('UI UX designers create the user interface for an app, website, or other', 'sarmadgardezi'); ?>
                <span class="hero-accent-green"><?php esc_html_e('interactive media', 'sarmadgardezi'); ?></span>.
                <?php esc_html_e('Their work includes collaborating with product ...', 'sarmadgardezi'); ?>
            </p>

            <div class="hero-creative-actions">
                <a href="<?php echo esc_url(home_url('/#contact')); ?>" class="hero-btn-dark">
                    <?php esc_html_e('Get for free', 'sarmadgardezi'); ?>
                </a>
                <a href="<?php echo esc_url(home_url('/#about')); ?>" class="hero-btn-text">
                    <?php esc_html_e('How its Work', 'sarmadgardezi'); ?>
                </a>
            </div>

        </div>

        <!-- Right Column: Subject Portrait Artwork -->
        <div class="hero-creative-stage">
            <div class="hero-portrait-wrap">
                <img 
                    src="<?php echo esc_url($hero_img_url); ?>" 
                    alt="<?php esc_attr_e('Sarmad Gardezi', 'sarmadgardezi'); ?>"
                    class="hero-portrait-img"
                    loading="eager"
                    fetchpriority="high"
                    decoding="async"
                    onerror="this.onerror=null; this.src='<?php echo esc_url($fallback_img_url); ?>';"
                />
            </div>
        </div>

    </div>
</section>
