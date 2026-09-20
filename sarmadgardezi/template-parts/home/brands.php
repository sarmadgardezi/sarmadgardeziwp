<?php
/**
 * Template part for displaying the Brands / Client Logos Marquee section
 *
 * Full-width, white background, continuous infinite scroll on desktop and mobile,
 * stops on mouse hover. Integrated with ACF repeater field with high-fidelity defaults.
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;

// Retrieve Section Heading Title (from options or ACF)
$section_title = get_option('brands_section_title', '');
if (empty($section_title)) {
    if (function_exists('sarmadgardezi_get_field')) {
        $section_title = sarmadgardezi_get_field('brands_section_title');
    } elseif (function_exists('sarmad_get_field')) {
        $section_title = sarmad_get_field('brands_section_title');
    } elseif (function_exists('get_field')) {
        $section_title = get_field('brands_section_title');
    }
}

if (empty($section_title) && function_exists('get_field')) {
    $section_title = get_field('brands_section_title', 'option');
}

if (empty($section_title)) {
    $section_title = __('Trusted by these amazing companies', 'sarmadgardezi');
}

// Retrieve Brand Logos (from native Brands Marquee manager or ACF)
$brand_items = array();

// 1. Try WP Option (from Brands Marquee manager)
$opt_brands = get_option('brand_logos');
if (!empty($opt_brands) && is_array($opt_brands)) {
    foreach ($opt_brands as $b) {
        $u = is_array($b) ? ($b['url'] ?? $b['brand_logo'] ?? '') : '';
        if (is_array($u) && !empty($u['url'])) {
            $u = $u['url'];
        }
        $n = is_array($b) ? ($b['name'] ?? $b['brand_name'] ?? '') : '';
        $l = is_array($b) ? ($b['link'] ?? $b['brand_url'] ?? '') : '';
        if (!empty($u)) {
            $brand_items[] = array(
                'url'  => $u,
                'name' => !empty($n) ? $n : __('Client Brand', 'sarmadgardezi'),
                'link' => $l,
            );
        }
    }
}

// 2. If empty, try ACF / Meta fields
if (empty($brand_items) && function_exists('get_field')) {
    // 2a. Try ACF repeater from current page / front page
    $acf_brands = get_field('brand_logos');

    // 2b. Try explicit front page ID
    if (empty($acf_brands)) {
        $front_page_id = get_option('page_on_front');
        if ($front_page_id) {
            $acf_brands = get_field('brand_logos', $front_page_id);
        }
    }

    // 2c. Try ACF repeater from options page
    if (empty($acf_brands)) {
        $acf_brands = get_field('brand_logos', 'option');
    }

    if (!empty($acf_brands) && is_array($acf_brands)) {
        foreach ($acf_brands as $brand) {
            $logo_url = '';
            $alt_text = !empty($brand['brand_name']) ? $brand['brand_name'] : '';
            $link_url = !empty($brand['brand_url']) ? $brand['brand_url'] : '';

            if (!empty($brand['brand_logo'])) {
                if (is_array($brand['brand_logo']) && !empty($brand['brand_logo']['url'])) {
                    $logo_url = $brand['brand_logo']['url'];
                    if (empty($alt_text) && !empty($brand['brand_logo']['alt'])) {
                        $alt_text = $brand['brand_logo']['alt'];
                    }
                } elseif (is_numeric($brand['brand_logo'])) {
                    $img_src = wp_get_attachment_image_src($brand['brand_logo'], 'full');
                    if ($img_src && !empty($img_src[0])) {
                        $logo_url = $img_src[0];
                    }
                    if (empty($alt_text)) {
                        $alt_text = get_post_meta($brand['brand_logo'], '_wp_attachment_image_alt', true);
                    }
                } elseif (is_string($brand['brand_logo'])) {
                    $logo_url = $brand['brand_logo'];
                }
            }

            if (!empty($logo_url)) {
                $brand_items[] = array(
                    'url'  => $logo_url,
                    'name' => !empty($alt_text) ? $alt_text : __('Client Brand', 'sarmadgardezi'),
                    'link' => $link_url,
                );
            }
        }
    }
}

// Helper for asset URL
$asset_base = function_exists('sarmadgardezi_asset') 
    ? sarmadgardezi_asset('') 
    : get_template_directory_uri() . '/assets/';

// 3. Fallback to default high-fidelity brands from reference design if none uploaded yet
if (empty($brand_items)) {
    $brand_items = array(
        array(
            'url'  => rtrim($asset_base, '/') . '/images/brands/clickl.svg',
            'name' => 'Clickl',
            'link' => '',
        ),
        array(
            'url'  => rtrim($asset_base, '/') . '/images/brands/piab.svg',
            'name' => 'piab',
            'link' => '',
        ),
        array(
            'url'  => rtrim($asset_base, '/') . '/images/brands/design-cuebe.svg',
            'name' => 'DESIGN CUEBE',
            'link' => '',
        ),
        array(
            'url'  => rtrim($asset_base, '/') . '/images/brands/ahlsell.svg',
            'name' => 'ahlsell',
            'link' => '',
        ),
    );
}

if (empty($brand_items)) {
    return;
}

// Multiply brand items if needed so each track half has plenty of items for wide screens
$repeated_items = $brand_items;
while (count($repeated_items) < 8) {
    $repeated_items = array_merge($repeated_items, $brand_items);
}
?>

<section class="hero-brands-section" aria-label="<?php echo esc_attr($section_title); ?>">
    <div class="brands-boxed-container">
        <?php if (!empty($section_title)) : ?>
            <p class="brands-header-title">
                <?php echo esc_html($section_title); ?>
            </p>
        <?php endif; ?>

        <!-- Infinite Scrolling Marquee Track (Stops on Hover) -->
        <div class="brands-marquee-wrapper" tabindex="0" role="region" aria-label="<?php esc_attr_e('Partner Brands Carousel', 'sarmadgardezi'); ?>">
            <div class="brands-marquee-track">
                <?php 
                // Render original list + cloned list for seamless 100% infinite loop
                for ($loop = 0; $loop < 2; $loop++) : 
                ?>
                    <div class="brands-group" <?php echo $loop > 0 ? 'aria-hidden="true"' : ''; ?>>
                        <?php foreach ($repeated_items as $item) : ?>
                            <div class="brand-logo-item">
                                <?php if (!empty($item['link'])) : ?>
                                    <a href="<?php echo esc_url($item['link']); ?>" target="_blank" rel="noopener noreferrer" class="brand-logo-link" title="<?php echo esc_attr($item['name']); ?>">
                                        <img 
                                            src="<?php echo esc_url($item['url']); ?>" 
                                            alt="<?php echo esc_attr($item['name']); ?>" 
                                            class="brand-logo-img"
                                            loading="lazy"
                                        />
                                    </a>
                                <?php else : ?>
                                    <div class="brand-logo-img-wrapper" title="<?php echo esc_attr($item['name']); ?>">
                                        <img 
                                            src="<?php echo esc_url($item['url']); ?>" 
                                            alt="<?php echo esc_attr($item['name']); ?>" 
                                            class="brand-logo-img"
                                            loading="lazy"
                                        />
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endfor; ?>
            </div>
        </div>
    </div>
</section>
