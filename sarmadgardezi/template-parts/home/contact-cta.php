<?php
/**
 * Template part for displaying the Pre-Footer Booking / Sparring CTA section
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;

// Avatar / Portrait with fallback
$portrait_url = get_template_directory_uri() . '/assets/images/sarmad.png';
if (function_exists('get_field')) {
    $custom_photo = get_field('booking_cta_photo');
    if (empty($custom_photo)) {
        $custom_photo = get_field('hero_profile_photo');
    }
    if (!empty($custom_photo)) {
        if (is_array($custom_photo) && !empty($custom_photo['url'])) {
            $portrait_url = $custom_photo['url'];
        } elseif (is_string($custom_photo)) {
            $portrait_url = $custom_photo;
        } elseif (is_numeric($custom_photo)) {
            $img_src = wp_get_attachment_image_src($custom_photo, 'thumbnail');
            if ($img_src) {
                $portrait_url = $img_src[0];
            }
        }
    }
}

// Heading
$cta_heading_line1 = 'Ready for the';
$cta_heading_line2 = 'next step?';
if (function_exists('get_field')) {
    $acf_h1 = get_field('booking_cta_heading_1');
    $acf_h2 = get_field('booking_cta_heading_2');
    if (!empty($acf_h1)) $cta_heading_line1 = $acf_h1;
    if (!empty($acf_h2)) $cta_heading_line2 = $acf_h2;
}

// Subtitle
$cta_desc = 'Get honest feedback on your product — and a clear plan for what comes next.';
if (function_exists('get_field')) {
    $acf_desc = get_field('booking_cta_desc');
    if (!empty($acf_desc)) $cta_desc = $acf_desc;
}

// Button
$btn_text = 'Book a Product Sparring session';
$btn_url  = home_url('/contact');
if (function_exists('get_field')) {
    $acf_btn_text = get_field('booking_cta_btn_text');
    $acf_btn_url  = get_field('booking_cta_btn_url');
    if (!empty($acf_btn_text)) $btn_text = $acf_btn_text;
    if (!empty($acf_btn_url))  $btn_url  = $acf_btn_url;
}

// Features / Benefits
$features = array(
    '30 min. Product Sparring',
    'Non-binding & free of charge',
);
if (function_exists('get_field')) {
    $acf_features = get_field('booking_cta_features');
    if (!empty($acf_features) && is_array($acf_features)) {
        $features = array_map(function($f) { return is_array($f) ? ($f['text'] ?? $f['feature'] ?? '') : $f; }, $acf_features);
    }
}
?>

<section id="booking-cta" class="booking-cta-section" aria-label="<?php echo esc_attr($cta_heading_line1 . ' ' . $cta_heading_line2); ?>">
    <div class="site-container booking-cta-container">
        
        <div class="booking-cta-card">
            
            <!-- Floating Decorative Shapes Matching Reference Design -->
            
            <!-- 1. Top Left: Periwinkle Stepped Shape -->
            <svg class="cta-floating-shape cta-shape-top-left" width="86" height="74" viewBox="0 0 86 74" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <path d="M32 9C32 4.02944 36.0294 0 41 0H77C81.9706 0 86 4.02944 86 9V27C86 31.9706 81.9706 36 77 36H50C45.0294 36 41 40.0294 41 45V65C41 69.9706 36.9706 74 32 74H9C4.02944 74 0 69.9706 0 65V47C0 42.0294 4.02944 38 9 38H23C27.9706 38 32 33.9706 32 29V9Z" fill="#C3DAFE"/>
            </svg>

            <!-- 2. Top Center-Right: Pastel Yellow Circle -->
            <span class="cta-floating-shape cta-shape-top-yellow-dot" aria-hidden="true"></span>

            <!-- 3. Top Right: Pastel Mint/Teal Rounded Block -->
            <span class="cta-floating-shape cta-shape-top-mint-block" aria-hidden="true"></span>

            <!-- 4. Bottom Left: Pastel Pink/Blush Circle -->
            <span class="cta-floating-shape cta-shape-bottom-pink-dot" aria-hidden="true"></span>

            <!-- 5. Bottom Right: Pastel Coral/Pink Stepped Shape -->
            <svg class="cta-floating-shape cta-shape-bottom-right" width="86" height="74" viewBox="0 0 86 74" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <path d="M32 9C32 4.02944 36.0294 0 41 0H77C81.9706 0 86 4.02944 86 9V27C86 31.9706 81.9706 36 77 36H50C45.0294 36 41 40.0294 41 45V65C41 69.9706 36.9706 74 32 74H9C4.02944 74 0 69.9706 0 65V47C0 42.0294 4.02944 38 9 38H23C27.9706 38 32 33.9706 32 29V9Z" fill="#FDA4AF"/>
            </svg>

            <!-- Central Content Column -->
            <div class="booking-cta-content">
                
                <!-- Main Headline -->
                <h2 class="booking-cta-heading">
                    <span class="cta-heading-line"><?php echo esc_html($cta_heading_line1); ?></span>
                    <span class="cta-heading-line"><?php echo esc_html($cta_heading_line2); ?></span>
                </h2>

                <!-- Subtitle Description -->
                <p class="booking-cta-description">
                    <?php echo wp_kses_post($cta_desc); ?>
                </p>

                <!-- Action Button with Avatar -->
                <div class="booking-cta-action-row">
                    
                    <div class="booking-avatar-circle">
                        <img 
                            src="<?php echo esc_url($portrait_url); ?>" 
                            alt="<?php esc_attr_e('Sarmad Gardezi', 'sarmadgardezi'); ?>" 
                            class="booking-avatar-img"
                            loading="lazy"
                        />
                    </div>

                    <a href="<?php echo esc_url($btn_url); ?>" class="booking-submit-btn">
                        <span class="btn-text"><?php echo esc_html($btn_text); ?></span>
                        <svg class="btn-arrow-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </a>

                </div>

                <!-- Trust Badges with Teal Checkmarks -->
                <?php if (!empty($features)) : ?>
                    <div class="booking-cta-features-row">
                        <?php foreach ($features as $feature) : if (empty($feature)) continue; ?>
                            <div class="booking-feature-badge">
                                <span class="feature-check-icon" aria-hidden="true">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                                        <circle cx="12" cy="12" r="10" stroke="#14b8a6" stroke-width="2" fill="#e6fffa"/>
                                        <polyline points="8 12 11 15 16 9" stroke="#0d9488" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </span>
                                <span class="feature-label"><?php echo esc_html($feature); ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

            </div>

        </div>

    </div>
</section>
