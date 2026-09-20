<?php
/**
 * Template Name: About Page
 * Description: High-impact About page with 3D Depth Card Hero & Engineering Journey
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;

get_header();

// Default images & content
$sarmad_photo = content_url('/uploads/2026/09/sarmadgardezi-google-2026.webp');
$left_card_photo  = 'https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?w=600&h=800&fit=crop';
$right_card_photo = 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=600&h=800&fit=crop';

// ACF support
if (function_exists('get_field')) {
    $custom_photo = get_field('about_hero_photo');
    if (!empty($custom_photo)) {
        if (is_array($custom_photo) && !empty($custom_photo['url'])) {
            $sarmad_photo = $custom_photo['url'];
        } elseif (is_string($custom_photo)) {
            $sarmad_photo = $custom_photo;
        }
    }
}
?>

<main id="main-content" class="site-main site-about-main">

    <!-- 1. Hero Section (Matching Exact Reference: Bold Headline + 3D Depth Card Stack) -->
    <section class="about-hero-section" aria-label="<?php esc_attr_e('About Sarmad Gardezi', 'sarmadgardezi'); ?>">
        <div class="site-container about-hero-container">
            <div class="about-hero-grid">

                <!-- Left Column: Pill Badge, Big Headline with Orange Pill, Bio & CTA -->
                <div class="about-hero-content">
                    
                    <!-- Top Pill Badge -->
                    <div class="about-badge-wrap">
                        <span class="about-hero-badge">
                            <?php esc_html_e('About me', 'sarmadgardezi'); ?>
                        </span>
                    </div>

                    <!-- Main Impact Headline -->
                    <h1 class="about-hero-title">
                        <span class="title-line-1"><?php esc_html_e('SYSTEMS BUILT TO', 'sarmadgardezi'); ?></span>
                        <span class="title-pill-orange"><?php esc_html_e('SCALE.', 'sarmadgardezi'); ?></span>
                    </h1>

                    <!-- Description -->
                    <p class="about-hero-description">
                        <?php esc_html_e('Architecting resilient Agentic AI workflows, high-performance cloud infrastructure, and software systems that drive real growth for modern engineering teams.', 'sarmadgardezi'); ?>
                    </p>

                    <!-- CTA Button -->
                    <div class="about-hero-cta">
                        <a href="<?php echo esc_url(home_url('/projects/')); ?>" class="about-explore-btn">
                            <span class="btn-arrow-circle" aria-hidden="true">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                    <polyline points="12 5 19 12 12 19"></polyline>
                                </svg>
                            </span>
                            <span class="btn-text"><?php esc_html_e('Explore my work', 'sarmadgardezi'); ?></span>
                        </a>
                    </div>

                </div>

                <!-- Right Column: 3D Depth Layered Card Stack -->
                <div class="about-hero-cards-col">
                    <div class="about-cards-deck">
                        
                        <!-- Left Background Card (Blurred & Scaled) -->
                        <div class="deck-card card-flank card-left" aria-hidden="true">
                            <div class="deck-card-inner">
                                <img 
                                    src="<?php echo esc_url($left_card_photo); ?>" 
                                    alt="<?php esc_attr_e('Tech talk event', 'sarmadgardezi'); ?>" 
                                    class="deck-card-img"
                                    loading="lazy"
                                />
                                <div class="deck-card-overlay"></div>
                            </div>
                        </div>

                        <!-- Center Active Card (High Focus & Details) -->
                        <div class="deck-card card-center">
                            <div class="deck-card-inner">
                                <img 
                                    src="<?php echo esc_url($sarmad_photo); ?>" 
                                    alt="<?php esc_attr_e('Sarmad Gardezi', 'sarmadgardezi'); ?>" 
                                    class="deck-card-img main-portrait-img"
                                    loading="eager"
                                    onerror="this.onerror=null;this.src='/wp-content/uploads/2026/09/sarmadgardezi-google-2026.webp';"
                                />
                                
                                <!-- Bottom Gradient Vignette -->
                                <div class="deck-card-overlay"></div>

                                <!-- Creator Bottom Bar -->
                                <div class="deck-card-bottom-bar">
                                    <div class="deck-creator-chip">
                                        <img 
                                            src="<?php echo esc_url($sarmad_photo); ?>" 
                                            alt="" 
                                            class="creator-mini-avatar"
                                            onerror="this.onerror=null;this.src='/wp-content/uploads/2026/09/sarmadgardezi-google-2026.webp';"
                                        />
                                        <span class="creator-handle">@sarmadgardezi</span>
                                        <svg class="verified-check-icon" width="14" height="14" viewBox="0 0 24 24" fill="#3b82f6" aria-label="Verified">
                                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                        </svg>
                                    </div>

                                    <button type="button" class="deck-control-pill" aria-label="<?php esc_attr_e('Pause media', 'sarmadgardezi'); ?>">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor">
                                            <rect x="6" y="4" width="4" height="16" rx="1"></rect>
                                            <rect x="14" y="4" width="4" height="16" rx="1"></rect>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Right Background Card (Blurred & Scaled) -->
                        <div class="deck-card card-flank card-right" aria-hidden="true">
                            <div class="deck-card-inner">
                                <img 
                                    src="<?php echo esc_url($right_card_photo); ?>" 
                                    alt="<?php esc_attr_e('Hackathon and workshop', 'sarmadgardezi'); ?>" 
                                    class="deck-card-img"
                                    loading="lazy"
                                />
                                <div class="deck-card-overlay"></div>
                            </div>
                        </div>

                    </div>

                    <!-- Pagination Dots -->
                    <div class="about-cards-dots" aria-hidden="true">
                        <span class="card-dot active"></span>
                        <span class="card-dot"></span>
                        <span class="card-dot"></span>
                    </div>

                </div>

            </div>
        </div>
    </section>

    <!-- 2. Metrics 4-Cards Grid & Wide Video Showcase Section (Exact Reference Layout) -->
    <section class="about-metrics-video-section" aria-label="<?php esc_attr_e('Achievements and Video Showcase', 'sarmadgardezi'); ?>">
        <div class="site-container metrics-video-container">
            
            <!-- Top 4 Metric Cards Grid -->
            <div class="metrics-cards-grid">
                
                <!-- Card 1 (Light) -->
                <div class="metric-card-item card-light">
                    <p class="card-top-desc"><?php esc_html_e('Google & Community events organized since 2017.', 'sarmadgardezi'); ?></p>
                    <div class="card-bottom-num">
                        <span>70</span><span class="num-accent-blue" style="color: #3b82f6;">+</span>
                    </div>
                </div>

                <!-- Card 2 (Light) -->
                <div class="metric-card-item card-light">
                    <p class="card-top-desc"><?php esc_html_e('Technical keynotes and conference talks delivered.', 'sarmadgardezi'); ?></p>
                    <div class="card-bottom-num">
                        <span>10</span><span class="num-accent-yellow" style="color: #eab308;">+</span>
                    </div>
                </div>

                <!-- Card 3 (Dark Black Card) -->
                <div class="metric-card-item card-dark">
                    <p class="card-top-desc"><?php esc_html_e('Buildathons & hackathons successfully led & judged.', 'sarmadgardezi'); ?></p>
                    <div class="card-bottom-num">
                        <span>25</span><span class="num-accent-green" style="color: #10b981;">+</span>
                    </div>
                </div>

                <!-- Card 4 (Light) -->
                <div class="metric-card-item card-light">
                    <p class="card-top-desc"><?php esc_html_e('Developers & engineers reached on YouTube and open source.', 'sarmadgardezi'); ?></p>
                    <div class="card-bottom-num">
                        <span>50</span><span class="num-accent-purple" style="color: #8b5cf6;">K+</span>
                    </div>
                </div>

            </div>

            <!-- Bottom Full-Width Rounded Video Banner -->
            <div class="showcase-video-wrapper">
                <video 
                    class="showcase-video-element" 
                    src="https://res.cloudinary.com/dy7my4aub/video/upload/v1773558615/copy_DFCADF75-F8F0-4B86-8487-687F09459A83_ynrsxm.mov" 
                    autoplay 
                    loop 
                    muted 
                    playsinline
                    preload="auto"
                ></video>
                <div class="video-subtle-overlay" aria-hidden="true"></div>
            </div>

        </div>
    </section>

    <!-- 3. The Journey Narrative Section (Blogging Since 2012 & GDG Cloud Leader) -->
    <section class="about-journey-section">
        <div class="site-container about-journey-container">
            
            <div class="journey-header">
                <span class="section-eyebrow"><?php esc_html_e('The Journey', 'sarmadgardezi'); ?></span>
                <h2 class="journey-title"><?php esc_html_e('Writing, speaking & building scalable systems for over a decade.', 'sarmadgardezi'); ?></h2>
            </div>

            <div class="journey-grid">
                
                <div class="journey-item glass-card">
                    <span class="journey-year">2012</span>
                    <h3 class="journey-item-title"><?php esc_html_e('Started Technical Blogging', 'sarmadgardezi'); ?></h3>
                    <p class="journey-item-desc">
                        <?php esc_html_e('Began writing in-depth tutorials, software blueprints, and developer guides to simplify complex technology for engineers around the world.', 'sarmadgardezi'); ?>
                    </p>
                </div>

                <div class="journey-item glass-card">
                    <span class="journey-year">2017</span>
                    <h3 class="journey-item-title"><?php esc_html_e('GDG Cloud Islamabad Organizer', 'sarmadgardezi'); ?></h3>
                    <p class="journey-item-desc">
                        <?php esc_html_e('Began leading Google Developer Groups Cloud Islamabad, organizing DevFests, hands-on Cloud buildathons, and mentoring hundreds of developers.', 'sarmadgardezi'); ?>
                    </p>
                </div>

                <div class="journey-item glass-card">
                    <span class="journey-year"><?php echo date('Y'); ?></span>
                    <h3 class="journey-item-title"><?php esc_html_e('Agentic AI & Cloud Architecture', 'sarmadgardezi'); ?></h3>
                    <p class="journey-item-desc">
                        <?php esc_html_e('Architecting cutting-edge Agentic AI workflows, high-throughput cloud infrastructure, and speaking at global technical conferences.', 'sarmadgardezi'); ?>
                    </p>
                </div>

            </div>

        </div>
    </section>

    <!-- 3. Key Expertise & Core Pillars -->
    <section class="about-pillars-section">
        <div class="site-container about-pillars-container">
            
            <div class="pillars-header">
                <span class="section-eyebrow"><?php esc_html_e('What I Do', 'sarmadgardezi'); ?></span>
                <h2 class="pillars-title"><?php esc_html_e('Core Competencies & Engineering Focus', 'sarmadgardezi'); ?></h2>
            </div>

            <div class="pillars-grid">
                
                <div class="pillar-card">
                    <div class="pillar-icon-box">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#ff6b2c" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon>
                        </svg>
                    </div>
                    <h3 class="pillar-heading"><?php esc_html_e('Agentic AI & LLM Systems', 'sarmadgardezi'); ?></h3>
                    <p class="pillar-text"><?php esc_html_e('Designing autonomous multi-agent pipelines, RAG architecture, and production-grade AI applications using Vertex AI and modern LLMs.', 'sarmadgardezi'); ?></p>
                </div>

                <div class="pillar-card">
                    <div class="pillar-icon-box">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#3b82f6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 10h-1.26A8 8 0 1 0 9 20h9a5 5 0 0 0 0-10z"></path>
                        </svg>
                    </div>
                    <h3 class="pillar-heading"><?php esc_html_e('Google Cloud Architecture', 'sarmadgardezi'); ?></h3>
                    <p class="pillar-text"><?php esc_html_e('Building fault-tolerant serverless backends, microservices, and Kubernetes clusters optimized for high scalability and low latency.', 'sarmadgardezi'); ?></p>
                </div>

                <div class="pillar-card">
                    <div class="pillar-icon-box">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
                            <line x1="8" y1="21" x2="16" y2="21"></line>
                            <line x1="12" y1="17" x2="12" y2="21"></line>
                        </svg>
                    </div>
                    <h3 class="pillar-heading"><?php esc_html_e('Full-Stack Web Engineering', 'sarmadgardezi'); ?></h3>
                    <p class="pillar-text"><?php esc_html_e('Developing responsive, blazing-fast web applications with Next.js, React, Node.js, and TypeScript tailored for optimal user conversion.', 'sarmadgardezi'); ?></p>
                </div>

                <div class="pillar-card">
                    <div class="pillar-icon-box">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#8b5cf6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                    </div>
                    <h3 class="pillar-heading"><?php esc_html_e('Tech Speaking & Workshops', 'sarmadgardezi'); ?></h3>
                    <p class="pillar-text"><?php esc_html_e('Delivering technical keynotes, judging global hackathons, and teaching software engineering concepts to tens of thousands on YouTube.', 'sarmadgardezi'); ?></p>
                </div>

            </div>

        </div>
    </section>

    <!-- 4. Numbers & Proven Track Record -->
    <?php get_template_part('template-parts/home/about'); ?>

    <!-- 5. CTA Section -->
    <section class="about-cta-section">
        <div class="site-container about-cta-container">
            <div class="about-cta-card">
                <h2 class="cta-title"><?php esc_html_e('Have a project in mind?', 'sarmadgardezi'); ?></h2>
                <p class="cta-desc"><?php esc_html_e("Let's discuss how Agentic AI and resilient cloud architecture can accelerate your product roadmap.", 'sarmadgardezi'); ?></p>
                <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="cta-action-btn">
                    <span><?php esc_html_e("Let's build together", 'sarmadgardezi'); ?> &rarr;</span>
                </a>
            </div>
        </div>
    </section>

</main>

<?php
get_footer();
