<?php
/**
 * The template for displaying the Projects archive catalog
 *
 * Matching exact reference design with dynamic project posts and curated fallbacks.
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;

get_header();

// 1. Query Projects / Case Studies
$projects_args = array(
    'post_type'      => array('project', 'case-study', 'event'),
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'orderby'        => 'menu_order date',
    'order'          => 'DESC',
);
$projects_query = new WP_Query($projects_args);
$has_dynamic_projects = $projects_query->have_posts();

// Asset base for fallback images
$asset_base = function_exists('sarmadgardezi_asset') 
    ? sarmadgardezi_asset('') 
    : get_template_directory_uri() . '/assets/';
$brand_img_dir = rtrim($asset_base, '/') . '/images/brands/';

// Curated static fallback items from reference specification
$static_showcase_projects = array(
    array(
        'title'      => 'medmingle',
        'subtitle'   => 'From a rigid rental solution to your own scalable platform',
        'timeline'   => '2024 – today',
        'tags'       => array('SaaS development', 'healthcare'),
        'bg_color'   => 'rgb(157, 196, 249)', // #9DC4F9
        'image'      => $brand_img_dir . 'medmingle.svg',
        'url'        => home_url('/project/medmingle/'),
    ),
    array(
        'title'      => 'Tuuul',
        'subtitle'   => 'From practical problem to SaaS product — in just 3 months.',
        'timeline'   => '2024 – today',
        'tags'       => array('SaaS development', 'healthcare'),
        'bg_color'   => 'rgb(0, 180, 159)', // #00B49F
        'image'      => $brand_img_dir . 'tuuul.svg',
        'url'        => home_url('/project/tuuul/'),
    ),
    array(
        'title'      => 'Maya',
        'subtitle'   => 'AI-driven security intelligence and platform engineering.',
        'timeline'   => '2026 – today',
        'tags'       => array('AI Engineering', 'SaaS'),
        'bg_color'   => '#C3DAFE',
        'image'      => $brand_img_dir . 'maya.svg',
        'url'        => home_url('/project/maya/'),
    ),
    array(
        'title'      => 'Sevenflow',
        'subtitle'   => 'Next-generation workflow orchestration and developer tools.',
        'timeline'   => '2026 – today',
        'tags'       => array('Product Engineering', 'DevTools'),
        'bg_color'   => '#DDD6FE',
        'image'      => $brand_img_dir . 'sevenflow.svg',
        'url'        => home_url('/project/sevenflow/'),
    ),
);

// Modern dynamic palette for backgrounds if not specified
$palette = array(
    'rgb(157, 196, 249)', // #9DC4F9
    'rgb(0, 180, 159)',   // #00B49F
    '#C3DAFE',            // Sky / Theme primary
    '#DDD6FE',            // Lavender
    '#FED7AA',            // Peach
    '#FDE68A',            // Amber
    '#BAE6FD',            // Light cyan
);
?>

<main id="main-content" class="site-main site-projects-archive-main">
    <div class="projects-archive-wrap">
        
        <!-- Page Title & Lead -->
        <header class="projects-page-header">
            <h1 class="projects-page-title"><?php esc_html_e('Projects', 'sarmadgardezi'); ?></h1>
            <p class="projects-page-subtitle">
                <?php esc_html_e('A selection of our projects. Learn how we have built scalable products together with our partners.', 'sarmadgardezi'); ?>
            </p>
        </header>

        <!-- Projects Cards Showcase List -->
        <div class="projects-showcase-list">
            
            <?php if ($has_dynamic_projects) : ?>
                <?php 
                $idx = 0;
                while ($projects_query->have_posts()) : $projects_query->the_post(); 
                    $p_id = get_the_ID();
                    
                    // Subtitle / Tagline
                    $subtitle = function_exists('sarmad_get_field') ? sarmad_get_field('project_subtitle', $p_id) : get_post_meta($p_id, '_project_subtitle', true);
                    if (empty($subtitle)) $subtitle = get_post_meta($p_id, '_project_role', true);
                    if (empty($subtitle)) $subtitle = get_post_meta($p_id, '_event_role', true);
                    if (empty($subtitle) && has_excerpt()) $subtitle = get_the_excerpt();
                    if (empty($subtitle)) $subtitle = 'From a rigid rental solution to your own scalable platform';

                    // Timeline
                    $timeline = function_exists('sarmad_get_field') ? sarmad_get_field('project_timeline', $p_id) : get_post_meta($p_id, '_project_timeline', true);
                    if (empty($timeline)) $timeline = get_post_meta($p_id, '_event_timeline', true);
                    if (empty($timeline)) $timeline = get_the_date('Y') . ' – today';

                    // Tags
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
                        $tags_list = array('SaaS development', 'Product Engineering');
                    }

                    // Background color
                    $bg_color = get_post_meta($p_id, '_project_card_bg_color', true);
                    if (empty($bg_color)) $bg_color = get_post_meta($p_id, 'project_card_bg_color', true);
                    if (empty($bg_color)) {
                        $bg_color = $palette[$idx % count($palette)];
                    }

                    // Cover / Mockup Image
                    $cover_img = function_exists('sarmad_get_field') ? sarmad_get_field('project_cover_image', $p_id) : get_post_meta($p_id, '_project_cover_image', true);
                    if (empty($cover_img) && has_post_thumbnail()) {
                        $cover_img = get_the_post_thumbnail_url($p_id, 'large');
                    }
                    if (empty($cover_img)) {
                        $logo = get_post_meta($p_id, '_project_logo', true);
                        if (!empty($logo)) $cover_img = $logo;
                    }
                    if (empty($cover_img)) {
                        $cover_img = $brand_img_dir . 'medmingle.svg';
                    }

                    $idx++;
                ?>
                    <div class="project-showcase-item">
                        <a href="<?php the_permalink(); ?>" class="group project-showcase-card" aria-label="<?php echo esc_attr(sprintf(__('Project: %s', 'sarmadgardezi'), get_the_title())); ?>">
                            
                            <!-- Corner Crosshair Marks -->
                            <div class="corner-cross top-left" aria-hidden="true"></div>
                            <div class="corner-cross top-right" aria-hidden="true"></div>
                            <div class="corner-cross bottom-right" aria-hidden="true"></div>
                            <div class="corner-cross bottom-left" aria-hidden="true"></div>

                            <!-- 2-Column Split Grid -->
                            <div class="project-card-grid">
                                
                                <!-- Left Preview Box -->
                                <div class="project-preview-slot">
                                    <div class="project-preview-frame" style="background-color: <?php echo esc_attr($bg_color); ?>;">
                                        <img 
                                            src="<?php echo esc_url($cover_img); ?>" 
                                            alt="<?php echo esc_attr(get_the_title()); ?>" 
                                            class="project-preview-mockup"
                                            loading="lazy"
                                        />
                                    </div>
                                </div>

                                <!-- Right Details Box -->
                                <div class="project-details-slot">
                                    <span class="project-timeline-label"><?php echo esc_html($timeline); ?></span>
                                    
                                    <h3 class="project-card-title"><?php the_title(); ?></h3>
                                    
                                    <p class="project-card-desc"><?php echo esc_html($subtitle); ?></p>
                                    
                                    <div class="project-card-tags">
                                        <?php foreach ($tags_list as $tag) : ?>
                                            <span class="tag-pill"><?php echo esc_html($tag); ?></span>
                                        <?php endforeach; ?>
                                    </div>

                                    <div class="project-card-action">
                                        <span><?php esc_html_e('Read the project', 'sarmadgardezi'); ?></span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="action-arrow-icon" aria-hidden="true">
                                            <path d="M5 12h14"></path>
                                            <path d="m12 5 7 7-7 7"></path>
                                        </svg>
                                    </div>
                                </div>

                            </div>

                        </a>
                    </div>
                <?php endwhile; wp_reset_postdata(); ?>

            <?php else : ?>

                <!-- Static Curated Fallback Showcase Items -->
                <?php foreach ($static_showcase_projects as $item) : ?>
                    <div class="project-showcase-item">
                        <a href="<?php echo esc_url($item['url']); ?>" class="group project-showcase-card" aria-label="<?php echo esc_attr(sprintf(__('Project: %s', 'sarmadgardezi'), $item['title'])); ?>">
                            
                            <!-- Corner Crosshair Marks -->
                            <div class="corner-cross top-left" aria-hidden="true"></div>
                            <div class="corner-cross top-right" aria-hidden="true"></div>
                            <div class="corner-cross bottom-right" aria-hidden="true"></div>
                            <div class="corner-cross bottom-left" aria-hidden="true"></div>

                            <!-- 2-Column Split Grid -->
                            <div class="project-card-grid">
                                
                                <!-- Left Preview Box -->
                                <div class="project-preview-slot">
                                    <div class="project-preview-frame" style="background-color: <?php echo esc_attr($item['bg_color']); ?>;">
                                        <img 
                                            src="<?php echo esc_url($item['image']); ?>" 
                                            alt="<?php echo esc_attr($item['title']); ?>" 
                                            class="project-preview-mockup"
                                            loading="lazy"
                                        />
                                    </div>
                                </div>

                                <!-- Right Details Box -->
                                <div class="project-details-slot">
                                    <span class="project-timeline-label"><?php echo esc_html($item['timeline']); ?></span>
                                    
                                    <h3 class="project-card-title"><?php echo esc_html($item['title']); ?></h3>
                                    
                                    <p class="project-card-desc"><?php echo esc_html($item['subtitle']); ?></p>
                                    
                                    <div class="project-card-tags">
                                        <?php foreach ($item['tags'] as $tag) : ?>
                                            <span class="tag-pill"><?php echo esc_html($tag); ?></span>
                                        <?php endforeach; ?>
                                    </div>

                                    <div class="project-card-action">
                                        <span><?php esc_html_e('Read the project', 'sarmadgardezi'); ?></span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="action-arrow-icon" aria-hidden="true">
                                            <path d="M5 12h14"></path>
                                            <path d="m12 5 7 7-7 7"></path>
                                        </svg>
                                    </div>
                                </div>

                            </div>

                        </a>
                    </div>
                <?php endforeach; ?>

            <?php endif; ?>

        </div>

    </div>
</main>

<?php
get_footer();
