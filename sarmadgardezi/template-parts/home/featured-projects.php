<?php
/**
 * Template part for displaying the Stacking Featured Projects / Portfolio Section
 *
 * Implements Google-colored stacking cards on scroll with interactive metrics,
 * feature checkmark pills, floating badges, and dynamic WordPress CPT/ACF integration.
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;

// Retrieve Section Heading Title (default "HOW WE GROW YOU")
$section_title = get_option('portfolio_section_title', '');
if (empty($section_title) && function_exists('get_field')) {
    $section_title = get_field('portfolio_section_title');
}
if (empty($section_title)) {
    $section_title = 'HOW WE GROW YOU';
}

// Check for custom cards from:
// 1. Dedicated Portfolio Cards Admin Tab (WP Option)
// 2. ACF Repeater on Front Page
// 3. Published 'project' Custom Post Type entries
$portfolio_items = array();

// Source 1: WP Option from Portfolio Cards Admin Manager
$opt_cards = get_option('portfolio_cards');
if (!empty($opt_cards) && is_array($opt_cards)) {
    foreach ($opt_cards as $c) {
        $t = $c['title'] ?? '';
        $d = $c['desc'] ?? '';
        $img = $c['image'] ?? '';
        if (!empty($t) || !empty($d) || !empty($img)) {
            $raw_pills = $c['pills'] ?? '';
            $pills_arr = array();
            if (!empty($raw_pills)) {
                $lines = preg_split('/[\r\n,]+/', $raw_pills);
                foreach ($lines as $l) {
                    $clean = trim($l);
                    if (!empty($clean)) $pills_arr[] = $clean;
                }
            }
            $portfolio_items[] = array(
                'title'      => $t,
                'desc'       => $d,
                'color'      => $c['color'] ?? 'blue',
                'icon'       => $c['icon'] ?? 'video',
                'pills'      => $pills_arr,
                'metric_val' => $c['metric_val'] ?? '',
                'metric_lbl' => $c['metric_lbl'] ?? '',
                'image'      => !empty($img) ? $img : 'https://images.unsplash.com/photo-1574717024653-61fd2cf4d44d?w=900&h=700&fit=crop',
                'link'       => !empty($c['link']) ? $c['link'] : home_url('/projects/'),
            );
        }
    }
}

// Source 2: ACF Repeater from Front page if option is empty
if (empty($portfolio_items) && function_exists('get_field')) {
    $acf_cards = get_field('portfolio_cards');
    if (empty($acf_cards)) {
        $front_id = get_option('page_on_front');
        if ($front_id) {
            $acf_cards = get_field('portfolio_cards', $front_id);
        }
    }
    if (!empty($acf_cards) && is_array($acf_cards)) {
        foreach ($acf_cards as $c) {
            $t = $c['title'] ?? '';
            $d = $c['desc'] ?? '';
            $img = $c['image'] ?? '';
            if (is_array($img) && !empty($img['url'])) {
                $img = $img['url'];
            }
            $raw_pills = $c['pills'] ?? '';
            $pills_arr = array();
            if (!empty($raw_pills)) {
                $lines = preg_split('/[\r\n,]+/', $raw_pills);
                foreach ($lines as $l) {
                    $clean = trim($l);
                    if (!empty($clean)) $pills_arr[] = $clean;
                }
            }
            $portfolio_items[] = array(
                'title'      => $t,
                'desc'       => $d,
                'color'      => $c['color'] ?? 'blue',
                'icon'       => $c['icon'] ?? 'video',
                'pills'      => $pills_arr,
                'metric_val' => $c['metric_val'] ?? '',
                'metric_lbl' => $c['metric_lbl'] ?? '',
                'image'      => !empty($img) ? $img : 'https://images.unsplash.com/photo-1574717024653-61fd2cf4d44d?w=900&h=700&fit=crop',
                'link'       => !empty($c['link']) ? $c['link'] : home_url('/projects/'),
            );
        }
    }
}

// Source 3: Published 'project' Custom Post Type entries if still empty
if (empty($portfolio_items)) {
    $projects_query = new WP_Query(array(
        'post_type'      => 'project',
        'posts_per_page' => 3,
        'post_status'    => 'publish',
        'meta_query'     => array(
            'relation' => 'OR',
            array(
                'key'     => '_project_featured',
                'value'   => '1',
                'compare' => '=',
            ),
            array(
                'key'     => '_project_featured',
                'compare' => 'NOT EXISTS',
            ),
        ),
        'orderby'        => array(
            'meta_value' => 'DESC',
            'date'       => 'DESC',
        ),
    ));

    if ($projects_query->have_posts()) {
        $idx = 0;
        $default_colors = array('blue', 'pink', 'green');
        while ($projects_query->have_posts()) {
            $projects_query->the_post();
            $pid = get_the_ID();
            $color = get_post_meta($pid, '_project_card_color', true);
            if (empty($color)) $color = $default_colors[$idx % 3];
            $icon = get_post_meta($pid, '_project_icon', true);
            if (empty($icon)) $icon = 'video';
            $raw_pills = get_post_meta($pid, '_project_pills', true);
            $pills_arr = array();
            if (!empty($raw_pills)) {
                $lines = preg_split('/[\r\n,]+/', $raw_pills);
                foreach ($lines as $l) {
                    $clean = trim($l);
                    if (!empty($clean)) $pills_arr[] = $clean;
                }
            }
            $img = get_the_post_thumbnail_url($pid, 'large');
            if (empty($img)) {
                $img = 'https://images.unsplash.com/photo-1574717024653-61fd2cf4d44d?w=900&h=700&fit=crop';
            }

            $desc = has_excerpt() ? get_the_excerpt() : wp_trim_words(get_the_content(), 28);

            $portfolio_items[] = array(
                'title'      => get_the_title(),
                'desc'       => $desc,
                'color'      => $color,
                'icon'       => $icon,
                'pills'      => $pills_arr,
                'metric_val' => get_post_meta($pid, '_project_metric_val', true),
                'metric_lbl' => get_post_meta($pid, '_project_metric_lbl', true),
                'image'      => $img,
                'link'       => get_permalink(),
            );
            $idx++;
        }
        wp_reset_postdata();
    }
}

// Fallback: 3 High-Fidelity Default Showcase Cards
if (empty($portfolio_items)) {
    $portfolio_items = array(
        array(
            'color'      => 'blue',
            'icon'       => 'video',
            'title'      => __('UGC video production', 'sarmadgardezi'),
            'desc'       => __('We source, brief, and deliver creator videos that feel native to the platform. Every video is built around your audience, not a production checklist designed to perform, not just look good.', 'sarmadgardezi'),
            'pills'      => array(__('Creator sourcing', 'sarmadgardezi'), __('Full brief included', 'sarmadgardezi'), __('Unlimited revisions', 'sarmadgardezi')),
            'metric_val' => '1,200+',
            'metric_lbl' => __('Videos delivered', 'sarmadgardezi'),
            'image'      => 'https://images.unsplash.com/photo-1574717024653-61fd2cf4d44d?w=900&h=650&fit=crop',
            'link'       => home_url('/projects/'),
        ),
        array(
            'color'      => 'pink',
            'icon'       => 'user',
            'title'      => __('Creator campaign strategy', 'sarmadgardezi'),
            'desc'       => __("We don't just find creators we match them to your niche, test multiple hooks, and build storytelling frameworks that scale what works. Data drives every decision, not gut feeling.", 'sarmadgardezi'),
            'pills'      => array(__('Niche matching', 'sarmadgardezi'), __('Hook testing', 'sarmadgardezi'), __('Weekly iteration', 'sarmadgardezi')),
            'metric_val' => '50M+',
            'metric_lbl' => __('Organic views', 'sarmadgardezi'),
            'image'      => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=900&h=650&fit=crop',
            'link'       => home_url('/projects/'),
        ),
        array(
            'color'      => 'green',
            'icon'       => 'chart',
            'title'      => __('Paid ad scaling & optimization', 'sarmadgardezi'),
            'desc'       => __('High-converting creative variations deployed across TikTok, Instagram, and YouTube Shorts with continuous A/B testing, hook iteration, and algorithmic distribution.', 'sarmadgardezi'),
            'pills'      => array(__('Multi-platform testing', 'sarmadgardezi'), __('Creative fatigue defense', 'sarmadgardezi'), __('High ROAS framework', 'sarmadgardezi')),
            'metric_val' => '4.8x',
            'metric_lbl' => __('Average ROAS', 'sarmadgardezi'),
            'image'      => 'https://images.unsplash.com/photo-1551836022-d5d88e9218df?w=900&h=650&fit=crop',
            'link'       => home_url('/projects/'),
        ),
    );
}

// Helper to render corner icon SVG
function sarmadgardezi_render_card_icon($icon_key) {
    switch ($icon_key) {
        case 'user':
            return '<svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/></svg>';
        case 'chart':
            return '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="20" x2="18" y2="10"></line><line x1="12" y1="20" x2="12" y2="4"></line><line x1="6" y1="20" x2="6" y2="14"></line></svg>';
        case 'cloud':
            return '<svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M19.35 10.04C18.67 6.59 15.64 4 12 4 9.11 4 6.6 5.64 5.35 8.04 2.34 8.36 0 10.91 0 14c0 3.31 2.69 6 6 6h13c2.76 0 5-2.24 5-5 0-2.64-2.05-4.78-4.65-4.96z"/></svg>';
        case 'spark':
            return '<svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l2.4 7.2L22 12l-7.6 2.8L12 22l-2.4-7.2L2 12l7.6-2.8z"/></svg>';
        case 'code':
            return '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="16 18 22 12 16 6"></polyline><polyline points="8 6 2 12 8 18"></polyline></svg>';
        case 'video':
        default:
            return '<svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M17 10.5V7c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1v10c0 .55.45 1 1 1h12c.55 0 1-.45 1-1v-3.5l4 4v-11l-4 4zM14 13h-3v3H9v-3H6v-2h3V8h2v3h3v2z"/></svg>';
    }
}
?>

<section id="portfolio-stack" class="portfolio-stack-section" aria-label="<?php echo esc_attr($section_title); ?>">
    <div class="portfolio-stack-wrap">
        
        <!-- Big Impact Section Header -->
        <div class="portfolio-stack-header">
            <h2 class="portfolio-main-title"><?php echo esc_html($section_title); ?></h2>
        </div>

        <!-- Sticky Stacking Cards Container -->
        <div class="portfolio-cards-stack">
            <?php foreach ($portfolio_items as $idx => $card) : ?>
                <article 
                    class="portfolio-stack-card card-color-<?php echo esc_attr($card['color']); ?>"
                    style="--card-index: <?php echo esc_attr($idx); ?>;"
                >
                    <!-- Top-Right Dark Icon Bubble -->
                    <div class="stack-card-icon-badge" aria-hidden="true">
                        <?php echo sarmadgardezi_render_card_icon($card['icon']); ?>
                    </div>

                    <!-- Card Content Grid -->
                    <div class="stack-card-grid">
                        <!-- Left Details Column -->
                        <div class="stack-card-content">
                            <h3 class="stack-card-title">
                                <a href="<?php echo esc_url($card['link']); ?>"><?php echo esc_html($card['title']); ?></a>
                            </h3>

                            <div class="stack-card-desc">
                                <p><?php echo esc_html($card['desc']); ?></p>
                            </div>

                            <?php if (!empty($card['pills'])) : ?>
                                <div class="stack-card-pills">
                                    <?php foreach ($card['pills'] as $pill) : ?>
                                        <span class="stack-pill">
                                            <svg class="pill-check" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                            <?php echo esc_html($pill); ?>
                                        </span>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($card['metric_val'])) : ?>
                                <div class="stack-card-metric">
                                    <div class="metric-number"><?php echo esc_html($card['metric_val']); ?></div>
                                    <?php if (!empty($card['metric_lbl'])) : ?>
                                        <div class="metric-label"><?php echo esc_html($card['metric_lbl']); ?></div>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Right Visual Column -->
                        <div class="stack-card-visual-wrap">
                            <a href="<?php echo esc_url($card['link']); ?>" class="stack-card-visual-link" title="<?php echo esc_attr($card['title']); ?>">
                                <img 
                                    src="<?php echo esc_url($card['image']); ?>" 
                                    alt="<?php echo esc_attr($card['title']); ?>" 
                                    class="stack-card-img"
                                    loading="lazy"
                                />
                            </a>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>

    </div>
</section>
