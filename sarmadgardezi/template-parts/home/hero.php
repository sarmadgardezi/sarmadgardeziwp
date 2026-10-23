<?php
/**
 * Template part for displaying the Creative White Hero Section
 * Matching Reference: "Build [Cloud Toggle] </>[Modern] Cloud Apps & Scalable Systems [Duo Cloud] Together",
 * Cloud App Developer & Cloud Engineer copy, "Get in Touch ->" & "View My Work ->".
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;

// Image URL requested by user
$hero_img_url = home_url('/wp-content/uploads/2026/10/sarmadgardezihero21.png');
$fallback_img_url = get_template_directory_uri() . '/assets/images/sarmad-hero.jpg';
?>

<section id="hero" class="hero-creative-section">
    <div class="hero-creative-container">
        
        <!-- Left Column: Creative Typography & Copy Matching Exact Reference -->
        <div class="hero-creative-content">
            
            <h1 class="hero-creative-title">
                
                <!-- Line 1: "Build" + Capsule Cloud Toggle Badge -->
                <span class="hero-title-line">
                    <span class="title-word">Build</span>
                    <span class="badge-capsule-arrow" aria-hidden="true">
                        <span class="badge-circle-green"></span>
                        <span class="badge-body-blue">
                            <svg class="badge-cloud-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M17.5 19H9a7 7 0 1 1 6.71-9h1.79a4.5 4.5 0 1 1 0 9Z"/>
                            </svg>
                        </span>
                    </span>
                </span>

                <!-- Line 2: Code Circle </> + "Modern" Outline Pill + "Cloud Apps" -->
                <span class="hero-title-line">
                    <span class="badge-circle-code" aria-hidden="true">
                        <span class="code-symbol">&lt;/&gt;</span>
                    </span>
                    <span class="badge-pill-outline" aria-hidden="true">
                        <span class="badge-pill-text">Modern</span>
                    </span>
                    <span class="title-word">Cloud Apps</span>
                </span>

                <!-- Line 3: "& Scalable Systems" + Duo Circles with Cloud Upload -->
                <span class="hero-title-line">
                    <span class="title-word">&amp; Scalable Systems</span>
                    <span class="badge-duo-circles" aria-hidden="true">
                        <span class="circle-yellow"></span>
                        <span class="circle-dark">
                            <svg class="badge-cloud-upload-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 14.899A7 7 0 1 1 15.71 8h1.79a4.5 4.5 0 0 1 2.5 8.242"/>
                                <path d="M12 12v9"/>
                                <path d="m8 16 4-4 4 4"/>
                            </svg>
                        </span>
                    </span>
                </span>

                <!-- Line 4: "Together" -->
                <span class="hero-title-line">
                    <span class="title-word">Together</span>
                </span>

            </h1>

            <p class="hero-creative-desc">
                <?php esc_html_e('I’m a', 'sarmadgardezi'); ?>
                <span class="hero-accent-blue"><?php esc_html_e('Cloud App Developer', 'sarmadgardezi'); ?></span>
                <?php esc_html_e('and', 'sarmadgardezi'); ?>
                <span class="hero-accent-blue"><?php esc_html_e('Cloud Engineer', 'sarmadgardezi'); ?></span>,
                <?php esc_html_e('building modern web applications and scalable cloud solutions using Google Cloud, Firebase, and modern technologies.', 'sarmadgardezi'); ?>
            </p>

            <div class="hero-creative-actions">
                <a href="<?php echo esc_url(home_url('/#contact')); ?>" class="hero-btn-blue">
                    <span><?php esc_html_e('Get in Touch', 'sarmadgardezi'); ?></span>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </a>
                <a href="<?php echo esc_url(home_url('/#projects')); ?>" class="hero-btn-text-blue">
                    <span><?php esc_html_e('View My Work', 'sarmadgardezi'); ?></span>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
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
