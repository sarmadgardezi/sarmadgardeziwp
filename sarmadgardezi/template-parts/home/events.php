<?php
/**
 * Template part for displaying the Events & Sessions Showcase Section
 *
 * Matching exact reference design:
 * - Header: "No code, no limits", subtitle, "See all sessions →" link
 * - Left: Featured Opening Keynote card with large thumbnail, title & narrative
 * - Right: Vertical list of session cards with thumbnails, titles & speaker credits
 * - Dynamic via 'event' Custom Post Type & ACF with full static fallback.
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;

// Retrieve Front Page ID
$front_id = get_option('page_on_front');
$target_id = $front_id ? $front_id : get_the_ID();

// Section Header Data
$section_title = 'No code, no <span class="events-accent-title">limits</span>';
$section_desc  = "Webflow's annual No-Code Conf features the brightest minds behind the no-code movement. Relive the experience of NCC 2021 on-demand.";
$see_all_text  = 'See all sessions';
$see_all_url   = home_url('/events');

if (function_exists('get_field')) {
    $c_title = get_field('events_section_title', $target_id);
    $c_desc  = get_field('events_section_subtitle', $target_id);
    $c_ltext = get_field('events_section_link_text', $target_id);
    $c_lurl  = get_field('events_section_link_url', $target_id);

    if (!empty($c_title)) $section_title = $c_title;
    if (!empty($c_desc))  $section_desc  = $c_desc;
    if (!empty($c_ltext)) $see_all_text  = $c_ltext;
    if (!empty($c_lurl))  $see_all_url   = $c_lurl;
}

// 1. Query Dynamic Event Posts
$events_query = new WP_Query(array(
    'post_type'      => 'event',
    'posts_per_page' => 5,
    'post_status'    => 'publish',
    'orderby'        => 'menu_order date',
    'order'          => 'ASC',
));

$has_dynamic_events = $events_query->have_posts();

// Assets Directory for Default Fallbacks
$theme_img_dir = get_template_directory_uri() . '/assets/images/events/';

// Static Default Keynote & Sessions (Exact match with reference design)
$default_keynote = array(
    'title'       => 'No-Code Conference 2021 - Opening Keynote',
    'description' => "Webflow's Vlad Magdalin, Bryant Chou, Arquay Harris, Jiaona Zhang, Sara Lundberg, and McGuire Brannon announce new features and updates at Webflow's No-Code Conf 2021.",
    'image'       => $theme_img_dir . 'opening-keynote.jpg',
    'link'        => home_url('/talks'),
);

$default_sessions = array(
    array(
        'title'   => 'How to create uncommon microsites with Webflow',
        'speaker' => 'TIMOTHY RICKS',
        'image'   => $theme_img_dir . 'session-1.jpg',
        'link'    => home_url('/talks'),
    ),
    array(
        'title'   => 'Democratizing the web, one no-code tool at a time',
        'speaker' => 'LACEY KESLER',
        'image'   => $theme_img_dir . 'session-2.jpg',
        'link'    => home_url('/talks'),
    ),
    array(
        'title'   => 'How Webflow inspired a career change — and a community for women in no-code',
        'speaker' => 'CLAUDIA CAFEO',
        'image'   => $theme_img_dir . 'session-3.jpg',
        'link'    => home_url('/talks'),
    ),
    array(
        'title'   => 'How to build a successful powerhouse agency from zero in 3 years',
        'speaker' => 'JOE KRUG',
        'image'   => $theme_img_dir . 'session-4.jpg',
        'link'    => home_url('/talks'),
    ),
);

// Process dynamic items if available
$featured_item = null;
$session_items = array();

if ($has_dynamic_events) {
    $all_posts = $events_query->posts;
    
    // Check if any post is marked explicitly as keynote / featured
    $found_keynote_index = null;
    foreach ($all_posts as $idx => $p) {
        $is_feat = get_post_meta($p->ID, 'event_is_featured', true);
        if (empty($is_feat)) $is_feat = get_post_meta($p->ID, '_event_is_featured', true);
        if ($is_feat) {
            $found_keynote_index = $idx;
            break;
        }
    }

    if ($found_keynote_index !== null) {
        $p = $all_posts[$found_keynote_index];
        unset($all_posts[$found_keynote_index]);
        $all_posts = array_values($all_posts);
    } else {
        $p = array_shift($all_posts);
    }

    if ($p) {
        $k_img = get_the_post_thumbnail_url($p->ID, 'large');
        if (empty($k_img)) $k_img = $default_keynote['image'];
        $k_desc = get_post_meta($p->ID, 'event_description', true);
        if (empty($k_desc)) $k_desc = get_post_meta($p->ID, '_event_description', true);
        if (empty($k_desc)) $k_desc = get_post_meta($p->ID, 'event_role', true);
        if (empty($k_desc) && has_excerpt($p->ID)) $k_desc = get_the_excerpt($p->ID);

        $k_link = get_post_meta($p->ID, 'event_url', true);
        if (empty($k_link)) $k_link = get_post_meta($p->ID, '_event_url', true);
        if (empty($k_link)) $k_link = get_permalink($p->ID);

        $featured_item = array(
            'title'       => get_the_title($p->ID),
            'description' => $k_desc,
            'image'       => $k_img,
            'link'        => $k_link,
        );
    }

    foreach ($all_posts as $p) {
        $s_img = get_the_post_thumbnail_url($p->ID, 'medium_large');
        if (empty($s_img)) $s_img = $default_sessions[count($session_items) % count($default_sessions)]['image'];
        
        $s_speaker = get_post_meta($p->ID, 'event_speaker', true);
        if (empty($s_speaker)) $s_speaker = get_post_meta($p->ID, '_event_speaker', true);
        if (empty($s_speaker)) $s_speaker = get_post_meta($p->ID, 'event_role', true);
        if (empty($s_speaker)) $s_speaker = 'SPEAKER';

        $s_link = get_post_meta($p->ID, 'event_url', true);
        if (empty($s_link)) $s_link = get_post_meta($p->ID, '_event_url', true);
        if (empty($s_link)) $s_link = get_permalink($p->ID);

        $session_items[] = array(
            'title'   => get_the_title($p->ID),
            'speaker' => strtoupper($s_speaker),
            'image'   => $s_img,
            'link'    => $s_link,
        );
    }
} else {
    $featured_item = $default_keynote;
    $session_items = $default_sessions;
}
?>

<section id="events-section" class="events-showcase-section" aria-label="<?php esc_attr_e('Events and Sessions', 'sarmadgardezi'); ?>">
    <div class="events-showcase-container">
        
        <!-- Section Top Header Bar -->
        <div class="events-header-row">
            <div class="events-header-info">
                <h2 class="events-main-title"><?php echo wp_kses_post($section_title); ?></h2>
                <p class="events-main-desc"><?php echo esc_html($section_desc); ?></p>
            </div>
            
            <?php if (!empty($see_all_url)) : ?>
                <div class="events-header-action">
                    <a href="<?php echo esc_url($see_all_url); ?>" class="events-see-all-link">
                        <span><?php echo esc_html($see_all_text); ?></span>
                        <svg class="events-link-arrow" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </a>
                </div>
            <?php endif; ?>
        </div>

        <!-- Section 2-Column Grid -->
        <div class="events-grid-layout">
            
            <!-- Left Column: Featured Opening Keynote -->
            <?php if (!empty($featured_item)) : ?>
                <div class="events-keynote-col">
                    <a href="<?php echo esc_url($featured_item['link']); ?>" class="events-keynote-card" aria-label="<?php echo esc_attr($featured_item['title']); ?>">
                        <div class="events-keynote-media-box">
                            <img 
                                src="<?php echo esc_url($featured_item['image']); ?>" 
                                alt="<?php echo esc_attr($featured_item['title']); ?>" 
                                class="events-keynote-img"
                                loading="lazy"
                                width="720"
                                height="405"
                            />
                            <div class="events-keynote-media-overlay"></div>
                        </div>
                        
                        <div class="events-keynote-content">
                            <h3 class="events-keynote-title"><?php echo esc_html($featured_item['title']); ?></h3>
                            <?php if (!empty($featured_item['description'])) : ?>
                                <p class="events-keynote-desc"><?php echo esc_html($featured_item['description']); ?></p>
                            <?php endif; ?>
                        </div>
                    </a>
                </div>
            <?php endif; ?>

            <!-- Right Column: Vertical Session Cards List -->
            <div class="events-sessions-col">
                <div class="events-sessions-list">
                    <?php foreach ($session_items as $session) : ?>
                        <a href="<?php echo esc_url($session['link']); ?>" class="events-session-item" aria-label="<?php echo esc_attr($session['title']); ?>">
                            
                            <div class="events-session-thumb-box">
                                <img 
                                    src="<?php echo esc_url($session['image']); ?>" 
                                    alt="<?php echo esc_attr($session['title']); ?>" 
                                    class="events-session-thumb"
                                    loading="lazy"
                                    width="240"
                                    height="135"
                                />
                            </div>

                            <div class="events-session-details">
                                <h4 class="events-session-title"><?php echo esc_html($session['title']); ?></h4>
                                <span class="events-session-speaker"><?php echo esc_html($session['speaker']); ?></span>
                            </div>

                        </a>
                    <?php endforeach; ?>
                </div>
            </div>

        </div>

    </div>
</section>
