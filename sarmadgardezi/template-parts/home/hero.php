<?php
/**
 * Template part for displaying the hero section
 * Matches editorial serif typography, avatar speech bubble, warm organic linen background,
 * and social subscriber badges.
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;

// Image path pointing to user's photo
$portrait_url = sarmadgardezi_asset('images/sarmad.png');
if (has_post_thumbnail()) {
    $portrait_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
}
?>

<section id="hero" class="hero-editorial-section">
    <div class="site-container hero-editorial-container">

        <!-- Centered Headline with Floating Avatar Speech Bubble -->
        <div class="hero-headline-wrapper">
            <h1 class="hero-editorial-title">
                <span class="title-line"><?php esc_html_e('Building the Future', 'sarmadgardezi'); ?></span>
                <span class="title-line"><?php esc_html_e('with Agentic AI', 'sarmadgardezi'); ?></span>
            </h1>

            <!-- Floating Speech Bubble Avatar positioned top-right of headline -->
            <div class="hero-speech-avatar" aria-hidden="true">
                <div class="speech-avatar-circle">
                    <img 
                        src="<?php echo esc_url($portrait_url); ?>" 
                        alt="<?php esc_attr_e('Sarmad Gardezi', 'sarmadgardezi'); ?>"
                        class="speech-avatar-img"
                        loading="eager"
                        fetchpriority="high"
                        width="96"
                        height="96"
                    />
                </div>
                <!-- Speech Bubble Tail pointing down-left -->
                <svg class="speech-bubble-tail" width="18" height="18" viewBox="0 0 18 18" fill="none">
                    <path d="M18 0C18 0 14 10 0 16C10 16 17 12 18 6V0Z" fill="#ffffff"/>
                </svg>
            </div>
        </div>

        <!-- Tagline -->
        <p class="hero-editorial-tagline">
            <?php esc_html_e('Entrepreneur. Speaker. Googler.', 'sarmadgardezi'); ?>
        </p>

        <!-- Bio Paragraph -->
        <p class="hero-editorial-bio">
            <?php
            echo esc_html__(
                'Sarmad Gardezi is a Senior Software Engineer and Google Developer Expert (GDE) specializing in Agentic AI, Firebase, and Cloud Architecture.',
                'sarmadgardezi'
            );
            ?>
        </p>

        <!-- Social Proof Stats Badges Row -->
        <div class="hero-social-stats-row">
            <a href="https://youtube.com/@sarmadgardezi" target="_blank" rel="noopener noreferrer" class="social-stat-badge stat-badge-youtube" aria-label="<?php esc_attr_e('782K YouTube Subscribers', 'sarmadgardezi'); ?>">
                <span class="stat-badge-icon icon-youtube" aria-hidden="true">
                    <svg width="18" height="13" viewBox="0 0 18 13" fill="none">
                        <path d="M17.5 2.6C17.3 1.6 16.4 0.7 15.4 0.5C14 0.1 9 0.1 9 0.1C9 0.1 4 0.1 2.6 0.5C1.6 0.7 0.7 1.6 0.5 2.6C0.1 4 0.1 6.5 0.1 6.5C0.1 6.5 0.1 9 0.5 10.4C0.7 11.4 1.6 12.3 2.6 12.5C4 12.9 9 12.9 9 12.9C9 12.9 14 12.9 15.4 12.5C16.4 12.3 17.3 11.4 17.5 10.4C17.9 9 17.9 6.5 17.9 6.5C17.9 6.5 17.9 4 17.5 2.6Z" fill="#FF0000"/>
                        <path d="M7.2 9.2L11.8 6.5L7.2 3.8V9.2Z" fill="#FFFFFF"/>
                    </svg>
                </span>
                <span class="stat-badge-count">782K</span>
            </a>

            <a href="https://instagram.com/sarmadgardezi" target="_blank" rel="noopener noreferrer" class="social-stat-badge stat-badge-instagram" aria-label="<?php esc_attr_e('23.3K Instagram Followers', 'sarmadgardezi'); ?>">
                <span class="stat-badge-icon icon-instagram" aria-hidden="true">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#E1306C" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                        <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                        <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                    </svg>
                </span>
                <span class="stat-badge-count">23.3K</span>
            </a>

            <a href="https://linkedin.com/in/sarmadgardezi" target="_blank" rel="noopener noreferrer" class="social-stat-badge stat-badge-linkedin" aria-label="<?php esc_attr_e('1.3K LinkedIn Followers', 'sarmadgardezi'); ?>">
                <span class="stat-badge-icon icon-linkedin" aria-hidden="true">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="#0A66C2">
                        <path d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14m-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-.85 0-1.84.52-2.28 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 0 1 1.4 1.4v4.93h2.75M6.46 10.9v7.6h2.8v-7.6h-2.8M7.86 6.38a1.63 1.63 0 0 0-1.63 1.63c0 .9.73 1.63 1.63 1.63.9 0 1.63-.73 1.63-1.63 0-.9-.73-1.63-1.63-1.63z"/>
                    </svg>
                </span>
                <span class="stat-badge-count">1.3K</span>
            </a>
        </div>

        <!-- Offerings Checklist Row -->
        <div class="hero-offerings-row">
            <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="offering-chip">
                <svg class="offering-check-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg>
                <span><?php esc_html_e('20min call', 'sarmadgardezi'); ?></span>
            </a>

            <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="offering-chip">
                <svg class="offering-check-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg>
                <span><?php esc_html_e('Get product feedback', 'sarmadgardezi'); ?></span>
            </a>
        </div>

    </div>
</section>
