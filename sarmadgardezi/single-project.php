<?php
/**
 * The template for displaying a single project / case study
 *
 * Matching exact editorial specification with dynamic ACF support and curated fallbacks.
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;

get_header();

while (have_posts()) :
    the_post();
    $p_id = get_the_ID();

    // 1. Title & Subtitle
    $title    = get_the_title();
    $subtitle = function_exists('sarmad_get_field') ? sarmad_get_field('project_subtitle', $p_id) : get_post_meta($p_id, '_project_subtitle', true);
    if (empty($subtitle)) $subtitle = get_post_meta($p_id, '_case_hero_subtitle', true);
    if (empty($subtitle)) $subtitle = get_post_meta($p_id, '_event_role', true);
    if (empty($subtitle)) $subtitle = get_post_meta($p_id, 'event_role', true);
    if (empty($subtitle)) $subtitle = 'From a rigid rental solution to your own scalable platform';

    // 2. Tags
    $raw_tags = function_exists('sarmad_get_field') ? sarmad_get_field('project_tags', $p_id) : get_post_meta($p_id, '_project_tags', true);
    $tags_list = array();
    if (!empty($raw_tags)) {
        if (is_array($raw_tags)) {
            $tags_list = $raw_tags;
        } else {
            $tags_list = array_filter(array_map('trim', explode(',', $raw_tags)));
        }
    } else {
        $terms = get_the_terms($p_id, 'technology');
        if (!empty($terms) && !is_wp_error($terms)) {
            foreach ($terms as $t) {
                $tags_list[] = $t->name;
            }
        }
    }
    if (empty($tags_list)) {
        $tags_list = array('SaaS development', 'Healthcare');
    }

    // 3. Live URL
    $live_url = function_exists('sarmad_get_field') ? sarmad_get_field('project_live_url', $p_id) : get_post_meta($p_id, '_project_live_url', true);
    if (empty($live_url)) $live_url = get_post_meta($p_id, '_event_url', true);
    if (empty($live_url)) $live_url = get_post_meta($p_id, 'event_url', true);
    if (empty($live_url)) $live_url = 'https://medmingle.de';

    $url_display = preg_replace('#^https?://(www\.)?#', '', rtrim($live_url, '/'));

    // 4. Timeline
    $timeline = function_exists('sarmad_get_field') ? sarmad_get_field('project_timeline', $p_id) : get_post_meta($p_id, '_project_timeline', true);
    if (empty($timeline)) $timeline = get_post_meta($p_id, '_event_timeline', true);
    if (empty($timeline)) $timeline = get_post_meta($p_id, 'event_timeline', true);
    if (empty($timeline)) $timeline = '2024 – today';

    // 5. Hero Cover Image
    $cover_img = function_exists('sarmad_get_field') ? sarmad_get_field('project_cover_image', $p_id) : get_post_meta($p_id, '_project_cover_image', true);
    if (empty($cover_img)) $cover_img = get_post_meta($p_id, '_case_cover_image', true);
    if (empty($cover_img) && has_post_thumbnail()) {
        $cover_img = get_the_post_thumbnail_url($p_id, 'full');
    }
    if (empty($cover_img)) {
        $cover_img = get_template_directory_uri() . '/assets/images/brands/medmingle.svg';
    }

    // 6. Summary
    $summary = function_exists('sarmad_get_field') ? sarmad_get_field('project_summary', $p_id) : get_post_meta($p_id, '_project_summary', true);
    if (empty($summary) && has_excerpt()) {
        $summary = get_the_excerpt();
    }
    if (empty($summary)) {
        $summary = sprintf(
            /* translators: %s: project name */
            __('%s connects professionals and organizations with high-efficiency workflows. Together, we replaced legacy infrastructure and built a state-of-the-art scalable platform serving thousands of active users.', 'sarmadgardezi'),
            esc_html($title)
        );
    }

    // 7. Team Avatars
    $author_avatar = get_template_directory_uri() . '/assets/images/sarmad.png';
    $custom_photo  = function_exists('get_field') ? get_field('hero_profile_photo') : '';
    if (!empty($custom_photo)) {
        if (is_array($custom_photo) && !empty($custom_photo['url'])) {
            $author_avatar = $custom_photo['url'];
        } elseif (is_string($custom_photo)) {
            $author_avatar = $custom_photo;
        }
    }

    // 8. Results Highlights
    $r1_badge = function_exists('sarmad_get_field') ? sarmad_get_field('project_r1_badge', $p_id) : get_post_meta($p_id, 'project_r1_badge', true);
    $r1_title = function_exists('sarmad_get_field') ? sarmad_get_field('project_r1_title', $p_id) : get_post_meta($p_id, 'project_r1_title', true);
    $r1_desc  = function_exists('sarmad_get_field') ? sarmad_get_field('project_r1_desc', $p_id) : get_post_meta($p_id, 'project_r1_desc', true);

    if (empty($r1_title)) {
        $r1_badge = 'Product';
        $r1_title = 'Minimal operational effort';
        $r1_desc  = 'through a scalable platform where employers and candidates can connect directly, without time-consuming manual matching.';
    }

    $r2_badge = function_exists('sarmad_get_field') ? sarmad_get_field('project_r2_badge', $p_id) : get_post_meta($p_id, 'project_r2_badge', true);
    $r2_title = function_exists('sarmad_get_field') ? sarmad_get_field('project_r2_title', $p_id) : get_post_meta($p_id, 'project_r2_title', true);
    $r2_desc  = function_exists('sarmad_get_field') ? sarmad_get_field('project_r2_desc', $p_id) : get_post_meta($p_id, 'project_r2_desc', true);

    if (empty($r2_title)) {
        $r2_badge = 'Growth';
        $r2_title = 'Five-figure monthly revenues, over 2,000 users';
        $r2_desc  = ', and full flexibility for long-term scaling of your own product.';
    }

    $r3_badge = function_exists('sarmad_get_field') ? sarmad_get_field('project_r3_badge', $p_id) : get_post_meta($p_id, 'project_r3_badge', true);
    $r3_title = function_exists('sarmad_get_field') ? sarmad_get_field('project_r3_title', $p_id) : get_post_meta($p_id, 'project_r3_title', true);
    $r3_desc  = function_exists('sarmad_get_field') ? sarmad_get_field('project_r3_desc', $p_id) : get_post_meta($p_id, 'project_r3_desc', true);

    if (empty($r3_title)) {
        $r3_badge = 'Collaboration';
        $r3_title = 'A product partnership spanning years:';
        $r3_desc  = 'jointly conceived, iteratively developed, side by side with the founders.';
    }
?>

<main id="main-content" class="site-main site-single-cs-main">
    <article id="post-<?php the_ID(); ?>" <?php post_class('cs-article'); ?>>
        
        <div class="cs-outer-wrap">
            <div class="cs-inner-container">
                
                <!-- 1. Back Navigation Link -->
                <div class="cs-back-nav">
                    <a href="<?php echo esc_url(get_post_type_archive_link('project') ?: home_url('/projects/')); ?>" class="cs-back-btn">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="m12 19-7-7 7-7"></path>
                            <path d="M19 12H5"></path>
                        </svg>
                        <span><?php esc_html_e('Projects', 'sarmadgardezi'); ?></span>
                    </a>
                </div>

                <!-- 2. Header Grid: Title, Subtitle, Badges & Timeline -->
                <header class="cs-header-grid">
                    <div class="cs-header-left">
                        <h1 class="cs-main-title"><?php echo esc_html($title); ?></h1>
                        
                        <?php if (!empty($subtitle)) : ?>
                            <p class="cs-subtitle"><?php echo esc_html($subtitle); ?></p>
                        <?php endif; ?>

                        <!-- Pills & External Link Row -->
                        <div class="cs-tags-actions-row">
                            <?php foreach ($tags_list as $index => $tag) : 
                                $pill_class = ($index % 2 === 0) ? 'pill-sky' : 'pill-zinc';
                            ?>
                                <span class="cs-tag-pill <?php echo esc_attr($pill_class); ?>">
                                    <?php echo esc_html($tag); ?>
                                </span>
                            <?php endforeach; ?>

                            <?php if (!empty($live_url)) : ?>
                                <a href="<?php echo esc_url($live_url); ?>" target="_blank" rel="noopener noreferrer" class="cs-live-link-btn">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                        <path d="M9 17H7A5 5 0 0 1 7 7h2"></path>
                                        <path d="M15 7h2a5 5 0 1 1 0 10h-2"></path>
                                        <line x1="8" y1="12" x2="16" y2="12"></line>
                                    </svg>
                                    <span><?php echo esc_html($url_display); ?></span>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="cs-header-right">
                        <span class="cs-timeline-text"><?php echo esc_html($timeline); ?></span>
                    </div>
                </header>

                <!-- 3. Large High-Res Cover Visual Mockup -->
                <div class="cs-cover-visual-card">
                    <div class="cs-cover-frame">
                        <img 
                            src="<?php echo esc_url($cover_img); ?>" 
                            alt="<?php echo esc_attr($title); ?>" 
                            class="cs-cover-img"
                            loading="eager"
                            fetchpriority="high"
                        />
                    </div>
                </div>

                <!-- 4. Summary & Our Team 2-Column Split -->
                <section class="cs-summary-team-grid">
                    <div class="cs-summary-col">
                        <span class="cs-section-label"><?php esc_html_e('Summary', 'sarmadgardezi'); ?></span>
                        <p class="cs-summary-paragraph">
                            <?php echo wp_kses_post($summary); ?>
                        </p>
                    </div>

                    <div class="cs-team-col">
                        <span class="cs-section-label"><?php esc_html_e('Our team', 'sarmadgardezi'); ?></span>
                        <div class="cs-team-avatar-group">
                            <span class="cs-avatar-item" title="<?php esc_attr_e('Sarmad Gardezi — Fractional CTO & AI Product Engineer', 'sarmadgardezi'); ?>">
                                <img src="<?php echo esc_url($author_avatar); ?>" alt="<?php esc_attr_e('Sarmad Gardezi', 'sarmadgardezi'); ?>" class="cs-avatar-img" />
                            </span>
                            <span class="cs-avatar-item" title="<?php esc_attr_e('Senior Full-Stack Engineer', 'sarmadgardezi'); ?>">
                                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/brands/tuuul.svg'); ?>" alt="Team Member" class="cs-avatar-img" />
                            </span>
                            <span class="cs-avatar-item" title="<?php esc_attr_e('Product Designer', 'sarmadgardezi'); ?>">
                                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/brands/dokrypt.svg'); ?>" alt="Team Member" class="cs-avatar-img" />
                            </span>
                        </div>
                    </div>
                </section>

                <!-- 5. Results Grid: 3 Interactive Metric Cards -->
                <section class="cs-results-section">
                    <span class="cs-section-label"><?php esc_html_e('Results', 'sarmadgardezi'); ?></span>
                    
                    <div class="cs-results-cards-grid">
                        
                        <!-- Card 1: Product -->
                        <div class="cs-result-card">
                            <div class="cs-result-badge-wrap">
                                <span class="cs-card-badge badge-amber"><?php echo esc_html($r1_badge); ?></span>
                            </div>
                            <p class="cs-result-text">
                                <strong class="cs-result-lead"><?php echo esc_html($r1_title); ?></strong> 
                                <?php echo esc_html($r1_desc); ?>
                            </p>
                        </div>

                        <!-- Card 2: Growth -->
                        <div class="cs-result-card">
                            <div class="cs-result-badge-wrap">
                                <span class="cs-card-badge badge-sky"><?php echo esc_html($r2_badge); ?></span>
                            </div>
                            <p class="cs-result-text">
                                <strong class="cs-result-lead"><?php echo esc_html($r2_title); ?></strong> 
                                <?php echo esc_html($r2_desc); ?>
                            </p>
                        </div>

                        <!-- Card 3: Collaboration -->
                        <div class="cs-result-card">
                            <div class="cs-result-badge-wrap">
                                <span class="cs-card-badge badge-purple"><?php echo esc_html($r3_badge); ?></span>
                            </div>
                            <p class="cs-result-text">
                                <strong class="cs-result-lead"><?php echo esc_html($r3_title); ?></strong> 
                                <?php echo esc_html($r3_desc); ?>
                            </p>
                        </div>

                    </div>
                </section>

                <!-- 6. Feature Deep-Dive Showcase Row -->
                <section class="cs-features-showcase-section">
                    <div class="cs-features-grid">
                        
                        <!-- Feature Card 1 -->
                        <div class="cs-feature-item">
                            <div class="cs-feature-card-visual">
                                <div class="cs-mockup-topbar">
                                    <span class="mockup-dot dot-red"></span>
                                    <span class="mockup-dot dot-yellow"></span>
                                    <span class="mockup-dot dot-green"></span>
                                </div>
                                <div class="cs-mockup-inner-preview">
                                    <div class="cs-profile-card-mini">
                                        <div class="cs-profile-avatar-ph"></div>
                                        <div class="cs-profile-lines">
                                            <span class="line-title"></span>
                                            <span class="line-sub"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h3 class="cs-feature-title"><?php esc_html_e('Profiles instead of job postings', 'sarmadgardezi'); ?></h3>
                        </div>

                        <!-- Feature Card 2 -->
                        <div class="cs-feature-item">
                            <div class="cs-feature-card-visual">
                                <div class="cs-mockup-topbar">
                                    <span class="mockup-dot dot-red"></span>
                                    <span class="mockup-dot dot-yellow"></span>
                                    <span class="mockup-dot dot-green"></span>
                                </div>
                                <div class="cs-mockup-inner-preview">
                                    <div class="cs-chat-bubble-ph bubble-left">
                                        <span>Direct messaging protocol</span>
                                    </div>
                                    <div class="cs-chat-bubble-ph bubble-right">
                                        <span>Instant founder sync</span>
                                    </div>
                                </div>
                            </div>
                            <h3 class="cs-feature-title"><?php esc_html_e('Chat instead of applying', 'sarmadgardezi'); ?></h3>
                            <p class="cs-feature-caption"><?php esc_html_e('No cover letters, no formal applications. Employers and candidates communicate directly — as easily as a message on WhatsApp.', 'sarmadgardezi'); ?></p>
                        </div>

                        <!-- Feature Card 3 -->
                        <div class="cs-feature-item">
                            <div class="cs-feature-card-visual">
                                <div class="cs-mockup-topbar">
                                    <span class="mockup-dot dot-red"></span>
                                    <span class="mockup-dot dot-yellow"></span>
                                    <span class="mockup-dot dot-green"></span>
                                </div>
                                <div class="cs-mockup-inner-preview">
                                    <div class="cs-matching-metric-card">
                                        <span class="match-score">98% Match</span>
                                        <span class="match-sub">Algorithmic Fit</span>
                                    </div>
                                </div>
                            </div>
                            <h3 class="cs-feature-title"><?php esc_html_e('Smart Matching', 'sarmadgardezi'); ?></h3>
                        </div>

                    </div>
                </section>

                <!-- 7. WordPress Editor Full Content (if provided) -->
                <?php if (get_the_content()) : ?>
                    <section class="cs-editor-body prose">
                        <?php the_content(); ?>
                    </section>
                <?php endif; ?>

                <!-- 8. Bottom Navigation / Project Switcher -->
                <nav class="cs-post-nav" aria-label="<?php esc_attr_e('Project Navigation', 'sarmadgardezi'); ?>">
                    <div class="cs-nav-prev">
                        <?php previous_post_link('%link', '&larr; %title'); ?>
                    </div>
                    <div class="cs-nav-next">
                        <?php next_post_link('%link', '%title &rarr;'); ?>
                    </div>
                </nav>

            </div>
        </div>

    </article>
</main>

<?php
endwhile;

get_footer();
