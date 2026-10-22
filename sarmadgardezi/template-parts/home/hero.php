<?php
/**
 * Template part for displaying the Dark Aesthetic Showcase Hero section
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;

// Avatar / Portrait URL (defaulting to the AI photo sarmad-hero.jpg)
$portrait_url = get_template_directory_uri() . '/assets/images/sarmad-hero.jpg';
if (function_exists('get_field')) {
    $custom_hero_photo = get_field('hero_profile_photo');
    if (!empty($custom_hero_photo)) {
        if (is_array($custom_hero_photo) && !empty($custom_hero_photo['url'])) {
            $portrait_url = $custom_hero_photo['url'];
        } elseif (is_numeric($custom_hero_photo)) {
            $img_src = wp_get_attachment_image_src($custom_hero_photo, 'full');
            if ($img_src) {
                $portrait_url = $img_src[0];
            }
        } elseif (is_string($custom_hero_photo)) {
            $portrait_url = $custom_hero_photo;
        }
    }
}

// User details
$hero_greeting = 'Hey';
$hero_name = 'Sarmad';
$hero_full_name = 'Sarmad Gardezi';
$hero_title_line1 = 'Cloud &';
$hero_title_line2 = 'Full Stack';
$hero_title_line3 = 'Engineer';
$hero_cta_text = 'Hire Me';
$hero_cta_url = home_url('/#contact');

// ACF overrides if present
if (function_exists('get_field')) {
    $acf_name = get_field('hero_name');
    if (!empty($acf_name)) {
        $hero_full_name = $acf_name;
    }
}
?>

<section id="hero" class="hero-showcase-section">
    <div class="hero-showcase-container">
        <div class="hero-showcase-card">
            
            <!-- Background Radial Glow -->
            <div class="hero-card-glow" aria-hidden="true"></div>

            <!-- Subject: AI Generated Portrait in Center -->
            <div class="hero-portrait-stage" aria-hidden="true">
                <div class="hero-portrait-frame">
                    <img 
                        src="<?php echo esc_url($portrait_url); ?>" 
                        alt="<?php echo esc_attr($hero_full_name); ?> - Cloud & Full Stack Engineer"
                        class="hero-portrait-image"
                        loading="eager"
                        fetchpriority="high"
                        decoding="async"
                    />
                    <div class="hero-portrait-fade"></div>
                </div>
            </div>

            <!-- Main Interactive Content Overlay -->
            <div class="hero-content-grid">

                <!-- TOP ROW -->
                <div class="hero-grid-top">
                    <!-- Top-Left: Greeting, Massive Headline, CTA -->
                    <div class="hero-heading-group">
                        <div class="hero-greeting-line">
                            <span class="greeting-accent"><?php echo esc_html($hero_greeting); ?></span>
                            <span class="greeting-wave" role="img" aria-label="waving hand">👋</span>
                            <span class="greeting-name"><?php echo esc_html(sprintf("I'm %s", $hero_name)); ?></span>
                        </div>

                        <h1 class="hero-display-title">
                            <span class="title-line title-cloud"><?php echo esc_html($hero_title_line1); ?></span>
                            <span class="title-line title-fullstack"><?php echo esc_html($hero_title_line2); ?></span>
                            <span class="title-line title-engineer"><?php echo esc_html($hero_title_line3); ?></span>
                        </h1>

                        <div class="hero-cta-action">
                            <a href="<?php echo esc_url($hero_cta_url); ?>" class="hero-lime-btn" data-cal-trigger>
                                <span><?php echo esc_html($hero_cta_text); ?></span>
                            </a>
                        </div>
                    </div>

                    <!-- Top-Right: "Experienced in" Glass Floating Card -->
                    <div class="hero-exp-card-wrapper">
                        <div class="hero-exp-card">
                            <span class="exp-card-heading"><?php esc_html_e('Experienced in', 'sarmadgardezi'); ?></span>
                            <div class="exp-icons-list">
                                <!-- Google Cloud Platform -->
                                <div class="exp-icon-pill" title="Google Cloud Platform (GCP)" data-tooltip="Google Cloud">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                                        <path d="M19.35 10.04C18.67 6.59 15.64 4 12 4 9.11 4 6.6 5.64 5.35 8.04 2.34 8.36 0 10.91 0 14c0 3.31 2.69 6 6 6h13c2.76 0 5-2.24 5-5 0-2.64-2.05-4.78-4.65-4.96z" fill="#4285F4"/>
                                        <path d="M19 18H6c-2.21 0-4-1.79-4-4 0-2.05 1.53-3.76 3.56-3.97l1.07-.11.5-.95C8.08 7.14 9.94 6 12 6c2.62 0 4.88 1.86 5.39 4.43l.3 1.5 1.53.11c1.6.1 2.78 1.41 2.78 2.96 0 1.65-1.35 3-3 3z" fill="#ffffff" fill-opacity="0.25"/>
                                    </svg>
                                </div>
                                <!-- Kubernetes & Containers -->
                                <div class="exp-icon-pill" title="Kubernetes &amp; Containers" data-tooltip="Kubernetes">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12 2L3.5 6.9v9.8L12 21.6l8.5-4.9V6.9L12 2zm0 2.3l6.5 3.8v7.5L12 19.3l-6.5-3.8V8.1L12 4.3zM12 7a5 5 0 100 10 5 5 0 000-10zm0 2a3 3 0 110 6 3 3 0 010-6z"/>
                                    </svg>
                                </div>
                                <!-- React / Next.js -->
                                <div class="exp-icon-pill" title="React &amp; Next.js" data-tooltip="React / Next.js">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                        <ellipse cx="12" cy="12" rx="10" ry="4.2"></ellipse>
                                        <ellipse cx="12" cy="12" rx="10" ry="4.2" transform="rotate(60 12 12)"></ellipse>
                                        <ellipse cx="12" cy="12" rx="10" ry="4.2" transform="rotate(120 12 12)"></ellipse>
                                        <circle cx="12" cy="12" r="1.8" fill="currentColor"></circle>
                                    </svg>
                                </div>
                                <!-- Node.js & TypeScript -->
                                <div class="exp-icon-pill" title="TypeScript &amp; Node.js" data-tooltip="TypeScript">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M3 3h18v18H3V3zm11.2 13.8c1.6 0 2.8-.8 3.5-2.1l-1.8-1.1c-.4.7-.9 1.1-1.7 1.1-.9 0-1.5-.5-1.5-1.3 0-.9.6-1.3 1.9-1.8 2.2-.9 3.2-1.8 3.2-3.4 0-2-1.6-3.3-3.8-3.3-1.8 0-3.1.8-3.8 2.2l1.7 1c.4-.7.9-1.1 1.7-1.1.9 0 1.4.5 1.4 1.1 0 .7-.5 1.1-1.7 1.6-2.2.9-3.4 1.8-3.4 3.6 0 2.2 1.7 3.2 4.4 3.2zm-7.6-.2h2.4V8.9h2.8V6.8H4.2v2.1H7v7.7z"/>
                                    </svg>
                                </div>
                                <!-- Python & AI Architecture -->
                                <div class="exp-icon-pill" title="Python, AI &amp; Cloud Architecture" data-tooltip="Python &amp; AI">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M11.9 2c-3.1 0-5.2.4-5.2 2.3v2.8h5.3v.8H4.7C2.8 7.9 1 9.9 1 12.8c0 3 1.8 4.7 4.1 4.7h2.4v-2.3c0-1.8 1.5-3.3 3.3-3.3h5.2V9.6c0-1.9-2.1-2.3-5.2-2.3H11.9zm-2.4 1.5a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm2.6 18.5c3.1 0 5.2-.4 5.2-2.3v-2.8h-5.3v-.8h7.3c1.9 0 3.7-2 3.7-4.9 0-3-1.8-4.7-4.1-4.7h-2.4v2.3c0 1.8-1.5 3.3-3.3 3.3H8.3v2.3c0 1.9 2.1 2.3 5.2 2.3h-1.4zm2.4-1.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- BOTTOM ROW -->
                <div class="hero-grid-bottom">
                    <!-- Bottom-Left: Bio text + Socials -->
                    <div class="hero-bio-group">
                        <p class="hero-bio-paragraph">
                            <?php esc_html_e('Lead Cloud Architect & Full Stack Engineer based in Islamabad, building high-scale distributed systems, AI solutions, and modern web products.', 'sarmadgardezi'); ?>
                        </p>
                        
                        <!-- Social Icons Row -->
                        <div class="hero-social-links">
                            <a href="https://github.com/sarmadgardezi" target="_blank" rel="noopener noreferrer" class="hero-social-btn" aria-label="GitHub" title="GitHub">
                                <?php echo sarmadgardezi_get_icon('github'); ?>
                            </a>
                            <a href="https://linkedin.com/in/sarmadgardezi" target="_blank" rel="noopener noreferrer" class="hero-social-btn" aria-label="LinkedIn" title="LinkedIn">
                                <?php echo sarmadgardezi_get_icon('linkedin'); ?>
                            </a>
                            <a href="https://twitter.com/sarmadgardezi" target="_blank" rel="noopener noreferrer" class="hero-social-btn" aria-label="Twitter / X" title="Twitter / X">
                                <?php echo sarmadgardezi_get_icon('x'); ?>
                            </a>
                            <a href="mailto:contact@sarmadgardezi.com" class="hero-social-btn" aria-label="Email" title="Email">
                                <?php echo sarmadgardezi_get_icon('mail'); ?>
                            </a>
                        </div>
                    </div>

                    <!-- Bottom-Right: 3-Column Stats with Underscores -->
                    <div class="hero-stats-group">
                        <div class="hero-stats-row">
                            <!-- Stat 1 -->
                            <div class="hero-stat-col">
                                <span class="stat-value">8+</span>
                                <span class="stat-name"><?php esc_html_e('Years of experience', 'sarmadgardezi'); ?></span>
                                <div class="stat-divider"></div>
                            </div>
                            <!-- Stat 2 -->
                            <div class="hero-stat-col">
                                <span class="stat-value">50+</span>
                                <span class="stat-name"><?php esc_html_e('Happy clients', 'sarmadgardezi'); ?></span>
                                <div class="stat-divider"></div>
                            </div>
                            <!-- Stat 3 -->
                            <div class="hero-stat-col">
                                <span class="stat-value">15+</span>
                                <span class="stat-name"><?php esc_html_e('Countries served', 'sarmadgardezi'); ?></span>
                                <div class="stat-divider"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>
