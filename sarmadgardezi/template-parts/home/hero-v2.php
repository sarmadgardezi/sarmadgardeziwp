<?php
/**
 * Template part for displaying the New Hero section (v2)
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;

// Avatar
$portrait_url = '/wp-content/uploads/2026/09/me-removebg-preview.png';
if (function_exists('get_field')) {
    $custom_hero_photo = get_field('hero_profile_photo');
    if (!empty($custom_hero_photo)) {
        if (is_array($custom_hero_photo) && !empty($custom_hero_photo['url'])) {
            $portrait_url = $custom_hero_photo['url'];
        } elseif (is_string($custom_hero_photo)) {
            $portrait_url = $custom_hero_photo;
        }
    }
}
?>

<section id="hero-v2" class="hero-v2-section">
    <!-- Ambient Background Effects -->
    <div class="hero-v2-bg-glow-left" aria-hidden="true"></div>
    <div class="hero-v2-bg-card-right" aria-hidden="true">
        <div class="hero-v2-floating-card"></div>
    </div>

    <div class="site-container hero-v2-container">
        
        <!-- Left Side Accent Arc -->
        <div class="hero-v2-arc-left" aria-hidden="true">
            <svg viewBox="0 0 100 180" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M 85 15 C 28 55, 18 125, 68 172" stroke="url(#hero-arc-grad)" stroke-width="2.5" stroke-linecap="round"/>
                <defs>
                    <linearGradient id="hero-arc-grad" x1="0%" y1="0%" x2="0%" y2="100%">
                        <stop offset="0%" stop-color="#38bdf8" />
                        <stop offset="55%" stop-color="#818cf8" />
                        <stop offset="100%" stop-color="#ec4899" />
                    </linearGradient>
                </defs>
            </svg>
        </div>

        <h1 class="hero-v2-heading">
            <span class="heading-line line-1">
                Hi, I&rsquo;m 
                <span class="hero-v2-avatar-wrapper">
                    <img src="<?php echo esc_url($portrait_url); ?>" alt="Sarmad" class="hero-v2-avatar" />
                </span> 
                Sarmad &mdash;
            </span>
            <span class="heading-line line-2">
                I take products from <span class="highlight-purple">zero</span>
            </span>
            <span class="heading-line line-3">
                <span class="highlight-purple">to one</span>, minus the chaos.
            </span>
        </h1>

        <p class="hero-v2-description">
            6+ years engineering high-performance web &amp; mobile applications.<br class="hide-mobile" /> 
            Transforming complex ideas into scalable, production-ready SaaS products.
        </p>

        <div class="hero-v2-pills-wrapper">
            <div class="hero-v2-pills">
                <div class="hero-pill pill-purple">
                    <span class="pill-dot"></span>
                    <span class="pill-title">Senior Software Engineer @</span>
                    <span class="pill-icon-wrapper">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#2563eb" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="coditas-icon"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
                    </span>
                    <span class="pill-brand">TrickleUp</span>
                </div>
                <div class="hero-pill pill-grey">
                    <span class="pill-dot-orange"></span>
                    <span class="pill-title">Islamabad, Pakistan</span>
                </div>
            </div>

            <!-- Hand-drawn Annotation & Arrow -->
            <div class="hero-v2-annotation" aria-hidden="true">
                <div class="annotation-text">
                    <span>Build</span>
                    <span>Connect</span>
                    <span>Grow</span>
                </div>
                <div class="annotation-arrow">
                    <svg viewBox="0 0 65 75" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M 48 4 C 44 24, 35 48, 12 60" stroke="#5d5fef" stroke-width="2" stroke-linecap="round"/>
                        <path d="M 23 54 L 10 60 L 16 71" stroke="#5d5fef" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
            </div>
        </div>

    </div>
</section>
