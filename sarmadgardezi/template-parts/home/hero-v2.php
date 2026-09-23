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
    <div class="site-container hero-v2-container">
        
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
            4+ years designing scalable B2B and B2C web & mobile applications that<br class="hide-mobile" /> 
            simplify complexity across fintech and enterprise SaaS.
        </p>

        <div class="hero-v2-pills">
            <div class="hero-pill pill-purple">
                <span class="pill-dot"></span>
                Senior Software Engineer @ 
                <span class="pill-icon-wrapper">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="coditas-icon"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
                </span>
                TrickleUp
            </div>
            <div class="hero-pill pill-grey">
                <span class="pill-dot-orange"></span>
                Islamabad, Pakistan
            </div>
        </div>

    </div>
</section>
