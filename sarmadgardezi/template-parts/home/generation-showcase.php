<?php
/**
 * Template part for displaying the Featured Series / Shows Section
 *
 * Dynamic Carousel & Grid with Custom Post Type ('featured'), ACF support,
 * Category filter pills, and smooth horizontal scrolling navigation.
 * Uses 3 authentic static dummy cards when no dynamic posts are uploaded,
 * and automatically switches to dynamic items when uploaded in WordPress.
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;

// 1. Query Dynamic Featured Post Type
$featured_query = new WP_Query(array(
    'post_type'      => 'featured',
    'posts_per_page' => 12,
    'post_status'    => 'publish',
    'orderby'        => 'menu_order date',
    'order'          => 'ASC',
));

$has_dynamic_posts = $featured_query->have_posts();

// 2. Fallback check for ACF Repeater / Option fields
$acf_items = array();
if (!$has_dynamic_posts && function_exists('get_field')) {
    $raw_acf = get_field('featured_series_list');
    if (empty($raw_acf)) {
        $front_id = get_option('page_on_front');
        if ($front_id) {
            $raw_acf = get_field('featured_series_list', $front_id);
        }
    }
    if (empty($raw_acf)) {
        $raw_acf = get_field('featured_series_list', 'option');
    }
    if (!empty($raw_acf) && is_array($raw_acf)) {
        $acf_items = $raw_acf;
    }
}

// 3. Section Title & Subtitle (Customizable via ACF / options)
$section_title = 'Featured';
$section_desc  = 'Press play on new and popular series that are worth the watch.';

if (function_exists('get_field')) {
    $custom_title = get_field('featured_section_title');
    $custom_desc  = get_field('featured_section_subtitle');
    if (!empty($custom_title)) $section_title = $custom_title;
    if (!empty($custom_desc))  $section_desc  = $custom_desc;
}

// 4. Fallback Default 3 Dummy Cards (Matching Exact Reference Design)
$theme_assets_dir = get_template_directory_uri() . '/assets/images/featured/';

$default_cards = array(
    array(
        'title'       => 'GENERATION NO-CODE',
        'subtitle'    => 'No-code is closing the gap between idea and impact. Gain inspiration from four real stories of pursuit, empowerment, and the magic of creativity. Coming in early 2022.',
        'image'       => $theme_assets_dir . 'generation-no-code.jpg',
        'categories'  => array('DOCUMENTARY', 'WEB DESIGN'),
        'badge'       => 'DOCUMENTARY',
        'logo_svg'    => '',
        'logo_img'    => '',
        'link'        => home_url('/talks'),
        'card_type'   => 'pixel',
    ),
    array(
        'title'       => 'inside MARKETING DESIGN',
        'subtitle'    => 'A podcast created to help you improve your skills and have more impact as a marketing design professional.',
        'image'       => $theme_assets_dir . 'inside-marketing.jpg',
        'categories'  => array('PODCAST', 'IN HOUSE DESIGN'),
        'badge'       => 'PODCAST',
        'logo_svg'    => '',
        'logo_img'    => '',
        'link'        => home_url('/podcast'),
        'card_type'   => 'script',
    ),
    array(
        'title'       => 'portfolio design',
        'subtitle'    => 'As a creative, your most powerful tool is your portfolio. Learn how to use that power wisely and responsibly.',
        'image'       => $theme_assets_dir . 'portfolio-design.jpg',
        'categories'  => array('CAREER DEVELOPMENT', 'FREELANCING'),
        'badge'       => 'CAREER DEVELOPMENT',
        'logo_svg'    => '',
        'logo_img'    => '',
        'link'        => home_url('/courses'),
        'card_type'   => 'serif',
    ),
);

// Collect all unique categories for filter pills
$filter_categories = array('PODCAST', 'CAREER DEVELOPMENT', 'WEB DESIGN', 'FREELANCING', 'BRANDING', 'DOCUMENTARY', 'IN HOUSE DESIGN');

if ($has_dynamic_posts) {
    $tax_terms = get_terms(array(
        'taxonomy'   => 'featured_category',
        'hide_empty' => true,
    ));
    if (!empty($tax_terms) && !is_wp_error($tax_terms)) {
        $dynamic_cats = wp_list_pluck($tax_terms, 'name');
        if (!empty($dynamic_cats)) {
            $filter_categories = array_map('strtoupper', $dynamic_cats);
        }
    }
}
?>

<section id="featured-section" class="featured-showcase-section" aria-label="<?php echo esc_attr($section_title); ?>">
    <div class="featured-showcase-container">
        
        <!-- Section Header -->
        <div class="featured-header-block">
            <h2 class="featured-main-title"><?php echo esc_html($section_title); ?></h2>
            <p class="featured-main-desc"><?php echo esc_html($section_desc); ?></p>
        </div>

        <!-- Controls Bar: Category Filter Pills + Carousel Navigation Arrows -->
        <div class="featured-controls-bar">
            
            <!-- Category Filter Pills (Horizontal Scrollable) -->
            <div class="featured-filter-scroll-wrap">
                <div class="featured-filter-pills" role="tablist" aria-label="<?php esc_attr_e('Filter featured series', 'sarmadgardezi'); ?>">
                    <button type="button" class="featured-pill is-active" data-filter="all" role="tab" aria-selected="true">
                        <?php esc_html_e('ALL', 'sarmadgardezi'); ?>
                    </button>
                    <?php foreach ($filter_categories as $cat) : ?>
                        <button type="button" class="featured-pill" data-filter="<?php echo esc_attr(sanitize_title($cat)); ?>" role="tab" aria-selected="false">
                            <?php echo esc_html($cat); ?>
                        </button>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Carousel Navigation Arrows -->
            <div class="featured-carousel-arrows" aria-label="<?php esc_attr_e('Carousel navigation', 'sarmadgardezi'); ?>">
                <button type="button" class="featured-arrow-btn featured-arrow-prev" id="featured-prev-btn" aria-label="<?php esc_attr_e('Previous items', 'sarmadgardezi'); ?>">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>
                </button>
                <button type="button" class="featured-arrow-btn featured-arrow-next" id="featured-next-btn" aria-label="<?php esc_attr_e('Next items', 'sarmadgardezi'); ?>">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </button>
            </div>

        </div>

        <!-- Featured Carousel Track -->
        <div class="featured-carousel-viewport">
            <div class="featured-carousel-track" id="featured-track">
                
                <?php if ($has_dynamic_posts) : ?>
                    <?php while ($featured_query->have_posts()) : $featured_query->the_post(); 
                        $p_id        = get_the_ID();
                        $card_title  = get_the_title();
                        $card_desc   = get_post_meta($p_id, 'featured_description', true);
                        if (empty($card_desc)) $card_desc = get_post_meta($p_id, '_featured_description', true);
                        if (empty($card_desc) && has_excerpt()) $card_desc = get_the_excerpt();

                        $card_link   = get_post_meta($p_id, 'featured_link', true);
                        if (empty($card_link)) $card_link = get_post_meta($p_id, '_featured_link', true);
                        if (empty($card_link)) $card_link = get_permalink($p_id);

                        $card_logo   = get_post_meta($p_id, 'featured_title_logo', true);
                        if (empty($card_logo)) $card_logo = get_post_meta($p_id, '_featured_title_logo', true);

                        $card_img    = get_the_post_thumbnail_url($p_id, 'large');
                        if (empty($card_img)) $card_img = $theme_assets_dir . 'generation-no-code.jpg';

                        $terms = get_the_terms($p_id, 'featured_category');
                        $cat_slugs = array();
                        $badge_text = '';
                        if (!empty($terms) && !is_wp_error($terms)) {
                            foreach ($terms as $t) {
                                $cat_slugs[] = sanitize_title($t->name);
                            }
                            $badge_text = strtoupper($terms[0]->name);
                        }
                        $cats_attr = implode(' ', $cat_slugs);
                    ?>
                        <div class="featured-card-item" data-categories="<?php echo esc_attr($cats_attr); ?>">
                            <a href="<?php echo esc_url($card_link); ?>" class="featured-card-link">
                                <div class="featured-card-inner">
                                    
                                    <!-- Background Cover Image -->
                                    <div class="featured-card-bg">
                                        <img src="<?php echo esc_url($card_img); ?>" alt="<?php echo esc_attr($card_title); ?>" class="featured-card-image" loading="lazy" />
                                        <div class="featured-card-overlay" aria-hidden="true"></div>
                                    </div>

                                    <!-- Content Overlay -->
                                    <div class="featured-card-content">
                                        
                                        <!-- Title / Logo Area -->
                                        <div class="featured-card-title-wrap">
                                            <?php if (!empty($card_logo)) : ?>
                                                <img src="<?php echo esc_url($card_logo); ?>" alt="<?php echo esc_attr($card_title); ?>" class="featured-card-logo-img" />
                                            <?php else : ?>
                                                <h3 class="featured-card-headline"><?php echo esc_html($card_title); ?></h3>
                                            <?php endif; ?>
                                        </div>

                                        <!-- Description -->
                                        <?php if (!empty($card_desc)) : ?>
                                            <p class="featured-card-description">
                                                <?php echo esc_html($card_desc); ?>
                                            </p>
                                        <?php endif; ?>

                                    </div>

                                </div>
                            </a>
                        </div>
                    <?php endwhile; wp_reset_postdata(); ?>

                <?php elseif (!empty($acf_items)) : ?>
                    <?php foreach ($acf_items as $item) : 
                        $c_title = $item['title'] ?? $item['featured_title'] ?? '';
                        $c_desc  = $item['description'] ?? $item['featured_description'] ?? '';
                        $c_img   = is_array($item['image'] ?? null) ? ($item['image']['url'] ?? '') : ($item['image'] ?? $item['featured_image'] ?? '');
                        if (empty($c_img)) $c_img = $theme_assets_dir . 'generation-no-code.jpg';
                        $c_link  = $item['link'] ?? $item['featured_link'] ?? '#';
                        $c_logo  = is_array($item['logo'] ?? null) ? ($item['logo']['url'] ?? '') : ($item['logo'] ?? '');
                        $c_cat   = $item['category'] ?? $item['featured_category'] ?? '';
                        $c_cat_slug = sanitize_title($c_cat);
                    ?>
                        <div class="featured-card-item" data-categories="<?php echo esc_attr($c_cat_slug); ?>">
                            <a href="<?php echo esc_url($c_link); ?>" class="featured-card-link">
                                <div class="featured-card-inner">
                                    <div class="featured-card-bg">
                                        <img src="<?php echo esc_url($c_img); ?>" alt="<?php echo esc_attr($c_title); ?>" class="featured-card-image" loading="lazy" />
                                        <div class="featured-card-overlay" aria-hidden="true"></div>
                                    </div>
                                    <div class="featured-card-content">
                                        <div class="featured-card-title-wrap">
                                            <?php if (!empty($c_logo)) : ?>
                                                <img src="<?php echo esc_url($c_logo); ?>" alt="<?php echo esc_attr($c_title); ?>" class="featured-card-logo-img" />
                                            <?php else : ?>
                                                <h3 class="featured-card-headline"><?php echo esc_html($c_title); ?></h3>
                                            <?php endif; ?>
                                        </div>
                                        <?php if (!empty($c_desc)) : ?>
                                            <p class="featured-card-description"><?php echo esc_html($c_desc); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>

                <?php else : ?>
                    <!-- Default Static Fallback (3 Dummy Cards Matching Exact Reference Design) -->
                    <?php foreach ($default_cards as $card) : 
                        $cat_slugs = array_map('sanitize_title', $card['categories']);
                        $cats_attr = implode(' ', $cat_slugs);
                    ?>
                        <div class="featured-card-item" data-categories="<?php echo esc_attr($cats_attr); ?>">
                            <a href="<?php echo esc_url($card['link']); ?>" class="featured-card-link">
                                <div class="featured-card-inner card-type-<?php echo esc_attr($card['card_type']); ?>">
                                    
                                    <!-- Background Cover Image -->
                                    <div class="featured-card-bg">
                                        <img src="<?php echo esc_url($card['image']); ?>" alt="<?php echo esc_attr($card['title']); ?>" class="featured-card-image" loading="lazy" />
                                        <div class="featured-card-overlay" aria-hidden="true"></div>
                                    </div>

                                    <!-- Content Overlay -->
                                    <div class="featured-card-content">
                                        
                                        <!-- Stylized Typography Overlay Matching Screenshot -->
                                        <div class="featured-card-title-wrap">
                                            <?php if ($card['card_type'] === 'pixel') : ?>
                                                <h3 class="featured-card-headline font-pixel">
                                                    <span class="line-1">GENERATION</span>
                                                    <span class="line-2">NO-CODE</span>
                                                </h3>
                                            <?php elseif ($card['card_type'] === 'script') : ?>
                                                <h3 class="featured-card-headline font-script">
                                                    <span class="script-arrow">&rarr; inside</span>
                                                    <span class="script-main">MARKETING</span>
                                                    <span class="script-sub">DESIGN</span>
                                                </h3>
                                            <?php else : ?>
                                                <h3 class="featured-card-headline font-serif">
                                                    <span class="serif-sparkle">&lowast; portfolio</span>
                                                    <span class="serif-main">design <span class="serif-circle-w">W</span></span>
                                                </h3>
                                            <?php endif; ?>
                                        </div>

                                        <!-- Description -->
                                        <p class="featured-card-description">
                                            <?php echo esc_html($card['subtitle']); ?>
                                        </p>

                                    </div>

                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>

            </div>
        </div>

    </div>
</section>
