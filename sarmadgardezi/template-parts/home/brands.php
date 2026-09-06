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

// Retrieve Section Heading Title (from front page or options)
$section_title = '';
if (function_exists('sarmadgardezi_get_field')) {
    $section_title = sarmadgardezi_get_field('brands_section_title');
} elseif (function_exists('sarmad_get_field')) {
    $section_title = sarmad_get_field('brands_section_title');
} elseif (function_exists('get_field')) {
    $section_title = get_field('brands_section_title');
}

if (empty($section_title) && function_exists('get_field')) {
    $section_title = get_field('brands_section_title', 'option');
}

if (empty($section_title)) {
    $section_title = __('I HAVE WORKED WITH TEAMS AT', 'sarmadgardezi');
}

// Retrieve Brand Logos from ACF
$brand_items = array();

if (function_exists('get_field')) {
    // 1. Try ACF repeater from current page / front page
    $acf_brands = get_field('brand_logos');

    // 2. Try ACF repeater from options page
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
                    'name' => $alt_text,
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
            'url'  => rtrim($asset_base, '/') . '/images/brands/rediff.svg',
            'name' => 'Rediff.com',
            'link' => '',
        ),
        array(
            'url'  => rtrim($asset_base, '/') . '/images/brands/sony.svg',
            'name' => 'Sony Pictures',
            'link' => '',
        ),
        array(
            'url'  => rtrim($asset_base, '/') . '/images/brands/times-of-india.svg',
            'name' => 'The Times of India',
            'link' => '',
        ),
        array(
            'url'  => rtrim($asset_base, '/') . '/images/brands/stayzilla.svg',
            'name' => 'Stayzilla',
            'link' => '',
        ),
        array(
            'url'  => rtrim($asset_base, '/') . '/images/brands/pharmeasy.svg',
            'name' => 'PharmEasy',
            'link' => '',
        ),
        array(
            'url'  => rtrim($asset_base, '/') . '/images/brands/spire.svg',
            'name' => 'SPIRE',
            'link' => '',
        ),
        array(
            'url'  => rtrim($asset_base, '/') . '/images/brands/flipkart.svg',
            'name' => 'Flipkart',
            'link' => '',
        ),
    );
}

if (empty($brand_items)) {
    return;
}
?>

<section class="hero-brands-section" aria-label="<?php echo esc_attr($section_title); ?>">
    <div class="brands-inner-wrapper">
        <p class="brands-header-title">
            <?php echo esc_html($section_title); ?>
        </p>

        <!-- Infinite Scrolling Marquee Track (Stops on Hover) -->
        <div class="brands-marquee-wrapper" tabindex="0" role="region" aria-label="<?php esc_attr_e('Partner Brands Carousel', 'sarmadgardezi'); ?>">
            <div class="brands-marquee-track">
                <?php 
                // Render original list + cloned list to create an seamless 360 loop
                for ($loop = 0; $loop < 2; $loop++) : 
                ?>
                    <div class="brands-group" <?php echo $loop > 0 ? 'aria-hidden="true"' : ''; ?>>
                        <?php foreach ($brand_items as $item) : ?>
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
