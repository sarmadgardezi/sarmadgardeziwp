<?php
/**
 * Template part for displaying the Hero section
 *
 * Faithfully matches the Next.js architecture, styling, and responsiveness:
 * - Content wrapper with title block
 * - Circular image bubble with speech tail
 * - Main heading with theme font
 * - Subtitle & description
 * - Social proof stats row
 * - Offerings badge row
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;

// Image path pointing to user's logo avatar
$portrait_url = sarmadgardezi_asset('images/sarmadgardezilogo.webp');
if (has_post_thumbnail()) {
    $portrait_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
}
?>

<section id="hero" class="hero-section Hero-module__RrIjAW__heroSection">
    <div class="hero-content-wrapper Hero-module__RrIjAW__contentWrapper">

        <!-- Title Block with Floating Image Bubble -->
        <div class="hero-title-block Hero-module__RrIjAW__titleBlock">
            <div class="hero-image-bubble Hero-module__RrIjAW__imageBubble">
                <div class="hero-inner-image Hero-module__RrIjAW__innerImage">
                    <img 
                        src="<?php echo esc_url($portrait_url); ?>" 
                        alt="<?php esc_attr_e('Sarmad Gardezi - Software Engineer and Google Cloud Expert', 'sarmadgardezi'); ?>"
                        width="140"
                        height="140"
                        loading="eager"
                        fetchpriority="high"
                        decoding="async"
                        class="speech-avatar-img"
                    />
                </div>
            </div>

            <h1 class="hero-main-heading Hero-module__RrIjAW__mainHeading">
                <?php esc_html_e('Building  the  Future', 'sarmadgardezi'); ?><br>
                <span><?php esc_html_e('with Agentic AI', 'sarmadgardezi'); ?></span>
            </h1>
        </div>

        <!-- Subtitle -->
        <h2 class="hero-subtitle Hero-module__RrIjAW__subtitle">
            <?php esc_html_e('Entrepreneur. Speaker. Googler.', 'sarmadgardezi'); ?>
        </h2>

        <!-- Description -->
        <p class="hero-description Hero-module__RrIjAW__description">
            <?php esc_html_e('Sarmad Gardezi is a Senior Software Engineer and Google Cloud Expert specializing in Agentic AI, Firebase, and Cloud Architecture.', 'sarmadgardezi'); ?>
        </p>

        <!-- Socials Row -->
        <div class="hero-socials-row Hero-module__RrIjAW__socialsRow">
            <a href="https://youtube.com/c/sarmadgardezi" target="_blank" rel="me noopener noreferrer" class="hero-social-item Hero-module__RrIjAW__socialItem">
                <svg viewBox="0 0 24 24" width="22" height="22" fill="#E24A4A" aria-hidden="true">
                    <path d="M21.582,6.186c-0.23-0.86-0.908-1.538-1.768-1.768C18.254,4,12,4,12,4S5.746,4,4.186,4.418 c-0.86,0.23-1.538,0.908-1.768,1.768C2,7.746,2,12,2,12s0,4.254,0.418,5.814c0.23,0.86,0.908,1.538,1.768,1.768 C5.746,20,12,20,12,20s6.254,0,7.814-0.418c0.86-0.23,1.538-0.908,1.768-1.768C22,16.254,22,12,22,12S22,7.746,21.582,6.186z M10,15.464V8.536L16,12L10,15.464z"></path>
                </svg>
                <span>782K</span>
            </a>
            <a href="https://instagram.com/sarmadgardezi" target="_blank" rel="me noopener noreferrer" class="hero-social-item Hero-module__RrIjAW__socialItem">
                <svg viewBox="0 0 24 24" width="20" height="20" fill="none" aria-hidden="true">
                    <rect x="2" y="2" width="20" height="20" rx="5" ry="5" stroke="#E1306C" stroke-width="2"></rect>
                    <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z" stroke="#E1306C" stroke-width="2"></path>
                    <line x1="17.5" y1="6.5" x2="17.51" y2="6.5" stroke="#E1306C" stroke-width="2" stroke-linecap="round"></line>
                </svg>
                <span>23.3K</span>
            </a>
            <a href="https://linkedin.com/in/sarmadgardezi" target="_blank" rel="me noopener noreferrer" class="hero-social-item Hero-module__RrIjAW__socialItem">
                <svg viewBox="0 0 24 24" width="20" height="20" fill="#0A66C2" aria-hidden="true">
                    <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"></path>
                </svg>
                <span>1.3K</span>
            </a>
        </div>

        <!-- Badges Row -->
        <div class="hero-badges-row Hero-module__RrIjAW__badgesRow">
            <div class="hero-badge-item Hero-module__RrIjAW__badgeItem">
                <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg>
                <span><?php esc_html_e('20min call', 'sarmadgardezi'); ?></span>
            </div>
            <div class="hero-badge-item Hero-module__RrIjAW__badgeItem">
                <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg>
                <span><?php esc_html_e('Get product feedback', 'sarmadgardezi'); ?></span>
            </div>
        </div>

    </div>
</section>
