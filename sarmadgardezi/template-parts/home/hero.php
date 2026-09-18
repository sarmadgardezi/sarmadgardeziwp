<?php
/**
 * Template part for displaying the Hero section
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;

// Image path pointing to user's hero avatar
$portrait_url = '/wp-content/uploads/2026/09/me-removebg-preview.png';
?>

<section id="hero" class="hero-section hero-agentic-future">
    <div class="hero-boxed-container">

        <!-- Top Elements Wrapper (Photo + Pill) -->
        <div class="hero-top-elements">
            <!-- Profile Photo (Above pill, left-aligned) -->
            <div class="hero-profile-photo">
                <div class="hero-inner-image">
                    <img 
                        src="<?php echo esc_url($portrait_url); ?>" 
                        alt="<?php esc_attr_e('Sarmad Gardezi', 'sarmadgardezi'); ?>"
                        width="86"
                        height="86"
                        loading="eager"
                        fetchpriority="high"
                        decoding="async"
                        class="speech-avatar-img"
                    />
                </div>
            </div>

            <!-- Top Tag / Pill Badge -->
            <div class="hero-badge-pill-wrap">
                <span class="hero-badge-pill">
                    <?php esc_html_e('Senior Software Engineer · Cloud Architect · Agentic AI', 'sarmadgardezi'); ?>
                </span>
            </div>
        </div>

        <!-- Headline Block -->
        <div class="hero-title-block">
            <!-- Big Impact Headline -->
            <h1 class="hero-main-heading">
                <span class="hero-heading-line line-1"><?php esc_html_e('SHAPING THE FUTURE', 'sarmadgardezi'); ?></span>
                <span class="hero-heading-line line-2">
                    <span class="word-agentic"><?php esc_html_e('WITH', 'sarmadgardezi'); ?></span>
                    <span class="hero-purple-pill"><?php esc_html_e('AGENTIC AI.', 'sarmadgardezi'); ?></span>
                </span>
            </h1>
        </div>

        <!-- Tagline -->
        <p class="hero-tagline">
            <?php esc_html_e('AI Consultant · Speaker & Googler', 'sarmadgardezi'); ?>
        </p>

        <!-- Description Subtitle -->
        <p class="hero-description">
            <?php esc_html_e('Sarmad Gardezi helps businesses scale by architecting cutting-edge Agentic AI workflows and high-performance cloud solutions that drive real growth.', 'sarmadgardezi'); ?>
        </p>

        <!-- CTA Button: Let's Build Together -->
        <div class="hero-cta-wrap">
            <a href="<?php echo esc_url(home_url('/contact')); ?>" class="hero-start-cta">
                <span class="cta-arrow-circle" aria-hidden="true">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </span>
                <span class="cta-text"><?php esc_html_e("Let's build together", 'sarmadgardezi'); ?></span>
            </a>
        </div>

        <!-- Social Pills Row (FB, GitHub, Twitter/X, Instagram, YouTube) -->
        <div class="hero-social-pills-wrap">
            <p class="hero-social-pills-label"><?php esc_html_e('Your audience is everywhere. So are we.', 'sarmadgardezi'); ?></p>
            <div class="hero-social-pills-list">
                <a href="https://facebook.com/sarmadgardezi" target="_blank" rel="noopener noreferrer" class="social-pill-btn pill-facebook">
                    <span class="social-pill-icon icon-fb" aria-hidden="true">
                        <svg viewBox="0 0 24 24" width="15" height="15" fill="currentColor">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                    </span>
                    <span class="social-pill-text"><?php esc_html_e('Facebook', 'sarmadgardezi'); ?></span>
                </a>
                <a href="https://github.com/sarmadgardezi" target="_blank" rel="noopener noreferrer" class="social-pill-btn pill-github">
                    <span class="social-pill-icon icon-github" aria-hidden="true">
                        <svg viewBox="0 0 24 24" width="15" height="15" fill="currentColor">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.53 1.032 1.53 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"/>
                        </svg>
                    </span>
                    <span class="social-pill-text"><?php esc_html_e('GitHub', 'sarmadgardezi'); ?></span>
                </a>
                <a href="https://twitter.com/sarmadgardezi" target="_blank" rel="noopener noreferrer" class="social-pill-btn pill-x">
                    <span class="social-pill-icon icon-x" aria-hidden="true">
                        <svg viewBox="0 0 24 24" width="13" height="13" fill="currentColor">
                            <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                        </svg>
                    </span>
                    <span class="social-pill-text"><?php esc_html_e('X', 'sarmadgardezi'); ?></span>
                </a>
                <a href="https://instagram.com/sarmadgardezi" target="_blank" rel="noopener noreferrer" class="social-pill-btn pill-instagram">
                    <span class="social-pill-icon icon-instagram" aria-hidden="true">
                        <svg viewBox="0 0 24 24" width="14" height="14" fill="currentColor">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                        </svg>
                    </span>
                    <span class="social-pill-text"><?php esc_html_e('Instagram', 'sarmadgardezi'); ?></span>
                </a>
            </div>
        </div>

        <?php /*
        <!-- Socials Row (Commented out per request) -->
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

        <!-- Badges Row (Commented out per request) -->
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
        */ ?>

    </div>
</section>
