<?php
/**
 * Template part for displaying the Products & Experience list section
 * Matching exact grid specification with dynamic ACF support and static fallbacks
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;

// Section Label
$section_label = 'Projects';
if (function_exists('get_field')) {
    $acf_label = get_field('projects_section_label');
    if (empty($acf_label)) {
        $acf_label = get_field('events_section_label');
    }
    if (!empty($acf_label)) {
        $section_label = $acf_label;
    }
}

// Query Dynamic Project / Event Posts
$events_args = array(
    'post_type'      => array('project', 'event'),
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'orderby'        => 'menu_order date',
    'order'          => 'DESC',
);
$events_query = new WP_Query($events_args);
$has_dynamic_events = $events_query->have_posts();

// Asset base for fallback logos
$asset_base = function_exists('sarmadgardezi_asset') 
    ? sarmadgardezi_asset('') 
    : get_template_directory_uri() . '/assets/';
$brand_img_dir = rtrim($asset_base, '/') . '/images/brands/';

// Static fallback items from reference specification
$static_products = array(
    array(
        'name'     => 'Maya',
        'role'     => 'Fractional CTO & AI Product Engineer',
        'timeline' => '2026–Today',
        'url'      => 'https://myprotectify.org/',
        'logo_img' => $brand_img_dir . 'maya.svg',
        'logo_svg' => '',
    ),
    array(
        'name'     => 'Sevenflow',
        'role'     => 'Fractional CTO & Product Engineer',
        'timeline' => '2026–Today',
        'url'      => 'https://sevenflow.de/',
        'logo_img' => $brand_img_dir . 'sevenflow.svg',
        'logo_svg' => '',
    ),
    array(
        'name'     => 'Tuuul',
        'role'     => 'Fractional CTO & Product Engineer',
        'timeline' => '2024–Today',
        'url'      => 'https://tuuul.de/',
        'logo_img' => $brand_img_dir . 'tuuul.svg',
        'logo_svg' => '',
    ),
    array(
        'name'     => 'medmingle',
        'role'     => 'Fractional CTO & Product Engineer',
        'timeline' => '2024–Today',
        'url'      => 'https://medmingle.de/',
        'logo_img' => $brand_img_dir . 'medmingle.svg',
        'logo_svg' => '',
    ),
    array(
        'name'     => 'Akindi',
        'role'     => 'Product Engineer',
        'timeline' => '2023–2025',
        'url'      => 'https://akindi.com/',
        'logo_img' => $brand_img_dir . 'akindi.svg',
        'logo_svg' => '',
    ),
    array(
        'name'     => 'vykee',
        'role'     => 'Product Engineer',
        'timeline' => '2023–2024',
        'url'      => 'https://vykee.co/',
        'logo_img' => $brand_img_dir . 'vykee.svg',
        'logo_svg' => '',
    ),
    array(
        'name'     => 'dskrpt',
        'role'     => 'Product Engineer',
        'timeline' => '2023–2024',
        'url'      => 'https://dskrpt.de/',
        'logo_img' => $brand_img_dir . 'dokrypt.svg',
        'logo_svg' => '',
    ),
    array(
        'name'     => 'Lazy',
        'role'     => 'AI Product Engineer',
        'timeline' => '2021–2024',
        'url'      => 'https://lazy.so/',
        'logo_img' => $brand_img_dir . 'lazy.svg',
        'logo_svg' => '',
    ),
);
?>

<section id="products-experience" class="products-section" aria-label="<?php echo esc_attr($section_label); ?>">
    <div class="site-container products-container">
        
        <!-- Section Header Label -->
        <h2 class="reveal products-section-heading" style="--stagger:4"><?php echo esc_html($section_label); ?></h2>

        <!-- Products List -->
        <ul class="products-list">
            
            <?php if ($has_dynamic_events) : ?>
                <?php 
                $item_idx = 0;
                while ($events_query->have_posts()) : $events_query->the_post(); 
                    $p_id      = get_the_ID();
                    $stagger   = 5 + $item_idx;
                    $item_idx++;

                    $role      = get_post_meta($p_id, '_project_role', true);
                    if (empty($role)) $role = get_post_meta($p_id, 'project_role', true);
                    if (empty($role)) $role = get_post_meta($p_id, '_event_role', true);
                    if (empty($role)) $role = get_post_meta($p_id, 'event_role', true);
                    if (empty($role)) $role = get_post_meta($p_id, 'project_subtitle', true);
                    if (empty($role) && has_excerpt()) $role = get_the_excerpt();

                    $timeline  = get_post_meta($p_id, '_project_timeline', true);
                    if (empty($timeline)) $timeline = get_post_meta($p_id, 'project_timeline', true);
                    if (empty($timeline)) $timeline = get_post_meta($p_id, '_project_year', true);
                    if (empty($timeline)) $timeline = get_post_meta($p_id, '_event_timeline', true);
                    if (empty($timeline)) $timeline = get_post_meta($p_id, 'event_timeline', true);
                    if (empty($timeline)) $timeline = get_the_date('Y');

                    $logo_url  = get_post_meta($p_id, '_project_logo', true);
                    if (empty($logo_url)) $logo_url = get_post_meta($p_id, 'project_logo', true);
                    if (empty($logo_url)) $logo_url = get_post_meta($p_id, '_event_logo', true);
                    if (empty($logo_url)) $logo_url = get_post_meta($p_id, 'event_logo', true);
                    if (empty($logo_url) && has_post_thumbnail()) {
                        $logo_url = get_the_post_thumbnail_url($p_id, 'thumbnail');
                    }

                    $ext_url   = get_post_meta($p_id, '_project_live_url', true);
                    if (empty($ext_url)) $ext_url = get_post_meta($p_id, 'project_live_url', true);
                    if (empty($ext_url)) $ext_url = get_post_meta($p_id, '_project_url', true);
                    if (empty($ext_url)) $ext_url = get_post_meta($p_id, 'project_url', true);
                    if (empty($ext_url)) $ext_url = get_post_meta($p_id, '_event_url', true);
                    if (empty($ext_url)) $ext_url = get_post_meta($p_id, 'event_url', true);
                    
                    $item_link   = !empty($ext_url) ? $ext_url : get_permalink($p_id);
                    $target_attr = !empty($ext_url) ? '_blank' : '_self';
                    $rel_attr    = !empty($ext_url) ? 'noopener noreferrer' : '';
                ?>
                    <li class="reveal products-item" style="--stagger:<?php echo esc_attr($stagger); ?>">
                        <a href="<?php echo esc_url($item_link); ?>" target="<?php echo esc_attr($target_attr); ?>" <?php if (!empty($rel_attr)) echo 'rel="' . esc_attr($rel_attr) . '"'; ?> class="group products-item-link">
                            
                            <!-- Logo Column -->
                            <span class="product-logo-slot">
                                <?php if (!empty($logo_url)) : ?>
                                    <img src="<?php echo esc_url($logo_url); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" class="product-logo-img" loading="lazy" />
                                <?php else : ?>
                                    <span class="product-placeholder-logo"><?php echo esc_html(substr(get_the_title(), 0, 1)); ?></span>
                                <?php endif; ?>
                            </span>

                            <!-- Brand Name & Hover Arrow -->
                            <span class="product-name-slot">
                                <?php the_title(); ?>
                                <svg viewBox="0 0 16 16" aria-hidden="true" class="product-arrow-pill">
                                    <rect width="16" height="16" rx="8" fill="#CEAFFA"></rect>
                                    <path d="M5 8h6M8.2 5 11 8l-2.8 3" fill="none" stroke="#121212" stroke-width="1.5" stroke-linecap="square" stroke-linejoin="round"></path>
                                </svg>
                            </span>

                            <!-- Role / Tagline -->
                            <span class="product-role-slot">
                                <?php echo esc_html($role); ?>
                            </span>

                            <!-- Timeline -->
                            <span class="product-timeline-slot">
                                <?php echo esc_html($timeline); ?>
                            </span>

                        </a>
                    </li>
                <?php endwhile; wp_reset_postdata(); ?>

            <?php else : ?>

                <!-- Static Reference Fallbacks -->
                <?php foreach ($static_products as $i => $prod) : 
                    $stagger = 5 + $i;
                ?>
                    <li class="reveal products-item" style="--stagger:<?php echo esc_attr($stagger); ?>">
                        <a href="<?php echo esc_url($prod['url']); ?>" target="_blank" rel="noopener noreferrer" class="group products-item-link">
                            
                            <!-- Logo Column -->
                            <span class="product-logo-slot">
                                <?php if (!empty($prod['logo_img'])) : ?>
                                    <img src="<?php echo esc_url($prod['logo_img']); ?>" alt="<?php echo esc_attr($prod['name']); ?>" class="product-logo-img" loading="lazy" />
                                <?php elseif (!empty($prod['logo_svg'])) : ?>
                                    <?php echo $prod['logo_svg']; ?>
                                <?php else : ?>
                                    <span class="product-placeholder-logo"><?php echo esc_html(substr($prod['name'], 0, 1)); ?></span>
                                <?php endif; ?>
                            </span>

                            <!-- Brand Name & Hover Arrow -->
                            <span class="product-name-slot">
                                <?php echo esc_html($prod['name']); ?>
                                <svg viewBox="0 0 16 16" aria-hidden="true" class="product-arrow-pill">
                                    <rect width="16" height="16" rx="8" fill="#CEAFFA"></rect>
                                    <path d="M5 8h6M8.2 5 11 8l-2.8 3" fill="none" stroke="#121212" stroke-width="1.5" stroke-linecap="square" stroke-linejoin="round"></path>
                                </svg>
                            </span>

                            <!-- Role / Tagline -->
                            <span class="product-role-slot">
                                <?php echo esc_html($prod['role']); ?>
                            </span>

                            <!-- Timeline -->
                            <span class="product-timeline-slot">
                                <?php echo esc_html($prod['timeline']); ?>
                            </span>

                        </a>
                    </li>
                <?php endforeach; ?>

            <?php endif; ?>

        </ul>

    </div>
</section>
