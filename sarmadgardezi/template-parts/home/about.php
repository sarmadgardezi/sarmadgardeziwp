<?php
/**
 * Template part for displaying the Minimalist About / Intro Split section
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;

// Photo URL with fallbacks & ACF support
$photo_url = content_url('/uploads/2026/09/sarmadgardezi-google-2026.webp');
if (function_exists('get_field')) {
    $custom_photo = get_field('about_photo');
    if (empty($custom_photo)) {
        $custom_photo = get_field('impact_photo');
    }
    if (empty($custom_photo)) {
        $custom_photo = get_field('about_hero_photo');
    }
    if (!empty($custom_photo)) {
        if (is_array($custom_photo) && !empty($custom_photo['url'])) {
            $photo_url = $custom_photo['url'];
        } elseif (is_string($custom_photo)) {
            $photo_url = $custom_photo;
        } elseif (is_numeric($custom_photo)) {
            $img_src = wp_get_attachment_image_src($custom_photo, 'full');
            if ($img_src) {
                $photo_url = $img_src[0];
            }
        }
    }
}

// Fallback photo
$fallback_photo = get_template_directory_uri() . '/assets/images/sarmad.png';

// Copy Details
$about_heading = 'Hey, I am Sarmad';
if (function_exists('get_field')) {
    $acf_h = get_field('about_split_heading');
    if (!empty($acf_h)) $about_heading = $acf_h;
}

$about_subtitle = 'A Senior Software Engineer & Product Builder &mdash; or to put it simply: an engineer who builds &amp; scales products.';
if (function_exists('get_field')) {
    $acf_sub = get_field('about_split_subtitle');
    if (!empty($acf_sub)) $about_subtitle = $acf_sub;
}

$about_bio = 'My passion has always been at the intersection of product architecture and modern full-stack development. I love turning complex ideas into intuitive, scalable software as much as coding with a good lo-fi playlist running in the back 🎧';
if (function_exists('get_field')) {
    $acf_bio = get_field('about_split_bio');
    if (!empty($acf_bio)) $about_bio = $acf_bio;
}

$photo_caption = 'Building web apps since high school. Waiting for yours since.';
if (function_exists('get_field')) {
    $acf_cap = get_field('about_split_caption');
    if (!empty($acf_cap)) $photo_caption = $acf_cap;
}

$pills = array(
    '6+ years of building web apps',
    'Organizer at GDG Cloud Islamabad',
);
if (function_exists('get_field')) {
    $acf_pills = get_field('about_split_pills');
    if (!empty($acf_pills) && is_array($acf_pills)) {
        $pills = array_map(function($p) { return is_array($p) ? ($p['text'] ?? $p['pill'] ?? '') : $p; }, $acf_pills);
    }
}
?>

<section id="about-intro" class="about-intro-split-section" aria-label="<?php echo esc_attr($about_heading); ?>">
    <div class="site-container about-intro-container">
        <div class="about-intro-grid">
            
            <!-- Left Column: Text Content & Badges -->
            <div class="about-intro-content">
                <h2 class="about-intro-heading"><?php echo esc_html($about_heading); ?></h2>
                
                <p class="about-intro-subtitle">
                    <?php echo wp_kses_post($about_subtitle); ?>
                </p>

                <p class="about-intro-bio">
                    <?php echo wp_kses_post($about_bio); ?>
                </p>

                <?php if (!empty($pills)) : ?>
                    <div class="about-intro-pills">
                        <?php foreach ($pills as $pill) : if (empty($pill)) continue; ?>
                            <span class="intro-pill-badge"><?php echo esc_html($pill); ?></span>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Right Column: Photo Card with Caption -->
            <div class="about-intro-visual">
                <div class="intro-photo-card">
                    <img 
                        src="<?php echo esc_url($photo_url); ?>" 
                        alt="<?php echo esc_attr($about_heading); ?>" 
                        class="intro-photo-img"
                        loading="lazy"
                        onerror="this.onerror=null;this.src='<?php echo esc_url($fallback_photo); ?>';"
                    />
                </div>
                <?php if (!empty($photo_caption)) : ?>
                    <p class="intro-photo-caption"><?php echo esc_html($photo_caption); ?></p>
                <?php endif; ?>
            </div>

        </div>
    </div>
</section>
