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
$hero_img_url = home_url('/wp-content/uploads/2026/10/sarmadgardezihero.png');
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

        <!-- Right Column: Subject Portrait with Floating Badges -->
        <div class="hero-creative-stage">
            
            <!-- Floating Sparkle Stars (Top-Right) -->
            <div class="hero-sparkle-stars" aria-hidden="true">
                <svg class="star star-top" width="28" height="28" viewBox="0 0 24 24" fill="#fde047">
                    <path d="M12 0L14.6 9.4L24 12L14.6 14.6L12 24L9.4 14.6L0 12L9.4 9.4L12 0Z" />
                </svg>
                <svg class="star star-mid" width="20" height="20" viewBox="0 0 24 24" fill="#facc15">
                    <path d="M12 0L14.6 9.4L24 12L14.6 14.6L12 24L9.4 14.6L0 12L9.4 9.4L12 0Z" />
                </svg>
                <svg class="star star-bottom" width="14" height="14" viewBox="0 0 24 24" fill="#fef08a">
                    <path d="M12 0L14.6 9.4L24 12L14.6 14.6L12 24L9.4 14.6L0 12L9.4 9.4L12 0Z" />
                </svg>
            </div>

            <!-- Floating Dual Fan + Anchor + "Uishyed" Badge (Left Side) -->
            <div class="hero-float-uishyed" aria-hidden="true">
                <!-- Top Dual Fan Shape with Stem & Orange Arrow -->
                <div class="uishyed-fan-group">
                    <div class="fan-wings">
                        <span class="wing wing-blue"></span>
                        <span class="wing wing-sky"></span>
                    </div>
                    <div class="fan-anchor">
                        <span class="anchor-ring"></span>
                        <span class="anchor-stem"></span>
                        <span class="anchor-arrow-circle">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <polyline points="19 12 12 19 5 12"></polyline>
                            </svg>
                        </span>
                    </div>
                </div>

                <!-- Floating Card: Green Circle + Text "Uishyed" -->
                <div class="uishyed-card">
                    <span class="uishyed-green-dot"></span>
                    <span class="uishyed-label"><?php esc_html_e('Uishyed', 'sarmadgardezi'); ?></span>
                </div>
            </div>

            <!-- Floating Globe Badge (Right Side) -->
            <div class="hero-float-globe" aria-hidden="true">
                <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#18181b" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="2" y1="12" x2="22" y2="12"></line>
                    <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                </svg>
            </div>

            <!-- Main Subject Portrait -->
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

            <!-- Bottom Horizontal Baseline -->
            <div class="hero-stage-baseline" aria-hidden="true"></div>

            <!-- Floating Yellow Diagonal Arrow Button (Bottom-Right) -->
            <a href="<?php echo esc_url(home_url('/#contact')); ?>" class="hero-float-arrow" aria-label="<?php esc_attr_e('Get Started', 'sarmadgardezi'); ?>">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#18181b" stroke-width="3.2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="7" y1="17" x2="17" y2="7"></line>
                    <polyline points="7 7 17 7 17 17"></polyline>
                </svg>
            </a>

        </div>

    </div>
</section>
