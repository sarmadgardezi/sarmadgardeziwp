<?php
/**
 * Template part for displaying the Events & Products List section matching reference design
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;

// Section Label
$section_label = 'Products';
if (function_exists('get_field')) {
    $acf_label = get_field('events_section_label');
    if (!empty($acf_label)) {
        $section_label = $acf_label;
    }
}

// Query Dynamic Event Posts
$events_args = array(
    'post_type'      => 'event',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'orderby'        => 'menu_order date',
    'order'          => 'DESC',
);
$events_query = new WP_Query($events_args);
$has_dynamic_events = $events_query->have_posts();

// Static fallback items (from user reference screenshot)
$static_events = array(
    array(
        'name'     => 'Maya',
        'role'     => 'Fractional CTO & AI Product Engineer',
        'timeline' => '2026–Today',
        'has_arrow'=> true,
        'link'     => home_url('/events/maya/'),
        'svg'      => '<svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7 23C7 19.5 9 16 11.5 16C14 16 15 19.5 17 23C19 19.5 20 16 22.5 16C25 16 27 19.5 27 23" stroke="#84cc16" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/><path d="M11.5 16C11.5 13.5 13 11 15 11C16.8 11 17.5 12.8 18 14.5" stroke="#84cc16" stroke-width="2.5" stroke-linecap="round"/></svg>',
    ),
    array(
        'name'     => 'Sevenflow',
        'role'     => 'Fractional CTO & Product Engineer',
        'timeline' => '2026–Today',
        'has_arrow'=> true,
        'link'     => home_url('/events/sevenflow/'),
        'svg'      => '<svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="4" y="8" width="14" height="6.5" rx="3" fill="#111111"/><rect x="14" y="17.5" width="14" height="6.5" rx="3" fill="#111111"/><rect x="11.5" y="12.5" width="9" height="7" rx="2" fill="#111111"/></svg>',
    ),
    array(
        'name'     => 'Tuuul',
        'role'     => 'Fractional CTO & Product Engineer',
        'timeline' => '2024–Today',
        'has_arrow'=> false,
        'link'     => home_url('/events/tuuul/'),
        'svg'      => '<svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg"><rect width="32" height="32" rx="8" fill="#111111"/><circle cx="11" cy="12" r="1.8" fill="#ffffff"/><circle cx="21" cy="12" r="1.8" fill="#ffffff"/><path d="M11 16.5C11 19.5 13.2 21.5 16 21.5C18.8 21.5 21 19.5 21 16.5" stroke="#ffffff" stroke-width="2" stroke-linecap="round"/></svg>',
    ),
    array(
        'name'     => 'medmingle',
        'role'     => 'Fractional CTO & Product Engineer',
        'timeline' => '2024–Today',
        'has_arrow'=> false,
        'link'     => home_url('/events/medmingle/'),
        'svg'      => '<svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9 7L13 23" stroke="#3b82f6" stroke-width="4" stroke-linecap="round"/><path d="M17 11L21 23" stroke="#60a5fa" stroke-width="4" stroke-linecap="round"/></svg>',
    ),
    array(
        'name'     => 'Akindi',
        'role'     => 'Product Engineer',
        'timeline' => '2023–2025',
        'has_arrow'=> false,
        'link'     => home_url('/events/akindi/'),
        'svg'      => '<svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15 5L25 24H15L15 5Z" fill="#ea580c"/><path d="M15 5L5 24H15L15 5Z" fill="#f97316" fill-opacity="0.85"/></svg>',
    ),
);
?>

<section id="events-products" class="events-products-section" aria-label="<?php echo esc_attr($section_label); ?>">
    <div class="site-container events-products-container">
        
        <!-- Section Header Label -->
        <div class="events-products-header">
            <h2 class="events-products-label"><?php echo esc_html($section_label); ?></h2>
        </div>

        <!-- Events List Table -->
        <div class="events-products-list">
            
            <?php if ($has_dynamic_events) : ?>
                <?php while ($events_query->have_posts()) : $events_query->the_post(); 
                    $p_id      = get_the_ID();
                    $role      = get_post_meta($p_id, '_event_role', true);
                    if (empty($role)) $role = get_post_meta($p_id, 'event_role', true);
                    if (empty($role) && has_excerpt()) $role = get_the_excerpt();

                    $timeline  = get_post_meta($p_id, '_event_timeline', true);
                    if (empty($timeline)) $timeline = get_post_meta($p_id, 'event_timeline', true);
                    if (empty($timeline)) $timeline = get_the_date('Y');

                    $logo_url  = get_post_meta($p_id, '_event_logo', true);
                    if (empty($logo_url)) $logo_url = get_post_meta($p_id, 'event_logo', true);
                    if (empty($logo_url) && has_post_thumbnail()) {
                        $logo_url = get_the_post_thumbnail_url($p_id, 'thumbnail');
                    }
                    $permalink = get_permalink($p_id);
                ?>
                    <a href="<?php echo esc_url($permalink); ?>" class="event-row-link" aria-label="<?php echo esc_attr(get_the_title()); ?>">
                        
                        <!-- Left: Brand Logo & Title -->
                        <div class="event-col-brand">
                            <?php if (!empty($logo_url)) : ?>
                                <div class="event-brand-icon">
                                    <img src="<?php echo esc_url($logo_url); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" loading="lazy" />
                                </div>
                            <?php else : ?>
                                <div class="event-brand-icon placeholder-icon">
                                    <span><?php echo esc_html(substr(get_the_title(), 0, 1)); ?></span>
                                </div>
                            <?php endif; ?>
                            
                            <span class="event-brand-title"><?php the_title(); ?></span>
                            
                            <span class="event-arrow-indicator" aria-hidden="true">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                    <polyline points="12 5 19 12 12 19"></polyline>
                                </svg>
                            </span>
                        </div>

                        <!-- Middle: Role / Subtitle -->
                        <div class="event-col-role">
                            <span><?php echo esc_html($role); ?></span>
                        </div>

                        <!-- Right: Timeline Date -->
                        <div class="event-col-timeline">
                            <span><?php echo esc_html($timeline); ?></span>
                        </div>

                    </a>
                <?php endwhile; wp_reset_postdata(); ?>

            <?php else : ?>
                
                <!-- Static Fallback (Reference Screenshot Design) -->
                <?php foreach ($static_events as $event) : ?>
                    <a href="<?php echo esc_url($event['link']); ?>" class="event-row-link" aria-label="<?php echo esc_attr($event['name']); ?>">
                        
                        <!-- Left: Brand Logo & Title -->
                        <div class="event-col-brand">
                            <div class="event-brand-icon">
                                <?php echo $event['svg']; ?>
                            </div>
                            
                            <span class="event-brand-title"><?php echo esc_html($event['name']); ?></span>
                            
                            <?php if ($event['has_arrow']) : ?>
                                <span class="event-arrow-indicator" aria-hidden="true">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                        <polyline points="12 5 19 12 12 19"></polyline>
                                    </svg>
                                </span>
                            <?php endif; ?>
                        </div>

                        <!-- Middle: Role / Subtitle -->
                        <div class="event-col-role">
                            <span><?php echo esc_html($event['role']); ?></span>
                        </div>

                        <!-- Right: Timeline Date -->
                        <div class="event-col-timeline">
                            <span><?php echo esc_html($event['timeline']); ?></span>
                        </div>

                    </a>
                <?php endforeach; ?>

            <?php endif; ?>

        </div>

    </div>
</section>
