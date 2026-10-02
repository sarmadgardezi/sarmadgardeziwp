<?php
/**
 * Template part for displaying the Dynamic Minimalist Client Logos Section
 *
 * Rendered directly under the Hero section with matching container width (580px).
 * Displays a clean row of 4 slots that dynamically swap logos with a vertical
 * sliding/fade animation without showing duplicates, looping infinitely.
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;

// Retrieve Brand Logos from ACF or WP Option
$brand_items = array();

// 1. Check WP Option
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

// 2. Check ACF fields
if (empty($brand_items) && function_exists('get_field')) {
    $acf_brands = get_field('brand_logos');
    if (empty($acf_brands)) {
        $front_page_id = get_option('page_on_front');
        if ($front_page_id) {
            $acf_brands = get_field('brand_logos', $front_page_id);
        }
    }
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

// 3. Fallback to comprehensive startup & enterprise brand pool matching reference design
$asset_base = function_exists('sarmadgardezi_asset') 
    ? sarmadgardezi_asset('') 
    : get_template_directory_uri() . '/assets/';
$brand_img_dir = rtrim($asset_base, '/') . '/images/brands/';

if (empty($brand_items)) {
    $brand_items = array(
        array('url' => $brand_img_dir . 'tuuul.svg', 'name' => 'tuuul', 'link' => ''),
        array('url' => $brand_img_dir . 'medmingle.svg', 'name' => 'medmingle', 'link' => ''),
        array('url' => $brand_img_dir . 'lazy.svg', 'name' => 'Lazy', 'link' => ''),
        array('url' => $brand_img_dir . 'akindi.svg', 'name' => 'AKINDI', 'link' => ''),
        array('url' => $brand_img_dir . 'dokrypt.svg', 'name' => 'dokrypt', 'link' => ''),
        array('url' => $brand_img_dir . 'clickl.svg', 'name' => 'Clickl', 'link' => ''),
        array('url' => $brand_img_dir . 'piab.svg', 'name' => 'piab', 'link' => ''),
        array('url' => $brand_img_dir . 'design-cuebe.svg', 'name' => 'Design Cuebe', 'link' => ''),
        array('url' => $brand_img_dir . 'ahlsell.svg', 'name' => 'Ahlsell', 'link' => ''),
        array('url' => $brand_img_dir . 'sony.svg', 'name' => 'Sony', 'link' => ''),
        array('url' => $brand_img_dir . 'pharmeasy.svg', 'name' => 'PharmEasy', 'link' => ''),
    );
}

// Number of visible slots
$slot_count = 4;
$initial_brands = array_slice($brand_items, 0, $slot_count);
?>

<section id="hero-brands" class="hero-logo-strip-section" aria-label="<?php esc_attr_e('Client Logos', 'sarmadgardezi'); ?>">
    <div class="site-container hero-logo-strip-container">
        <div class="hero-logo-strip-wrap" id="dynamic-logo-strip" data-brands="<?php echo esc_attr(wp_json_encode($brand_items)); ?>">
            <?php foreach ($initial_brands as $index => $brand) : ?>
                <div class="logo-slot" data-slot-index="<?php echo esc_attr($index); ?>" data-current-brand="<?php echo esc_attr($index); ?>">
                    <div class="logo-item current-logo">
                        <?php if (!empty($brand['link'])) : ?>
                            <a href="<?php echo esc_url($brand['link']); ?>" target="_blank" rel="noopener noreferrer" title="<?php echo esc_attr($brand['name']); ?>">
                                <img src="<?php echo esc_url($brand['url']); ?>" alt="<?php echo esc_attr($brand['name']); ?>" class="brand-img" loading="lazy" />
                            </a>
                        <?php else : ?>
                            <img src="<?php echo esc_url($brand['url']); ?>" alt="<?php echo esc_attr($brand['name']); ?>" class="brand-img" loading="lazy" />
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
