<?php
/**
 * Template part for displaying the Minimalist Editorial Hero section
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;

// Avatar
$portrait_url = get_template_directory_uri() . '/assets/images/sarmad.png';
if (function_exists('get_field')) {
    $custom_hero_photo = get_field('hero_profile_photo');
    if (!empty($custom_hero_photo)) {
        if (is_array($custom_hero_photo) && !empty($custom_hero_photo['url'])) {
            $portrait_url = $custom_hero_photo['url'];
        } elseif (is_string($custom_hero_photo)) {
            $portrait_url = $custom_hero_photo;
        } elseif (is_numeric($custom_hero_photo)) {
            $img_src = wp_get_attachment_image_src($custom_hero_photo, 'full');
            if ($img_src) {
                $portrait_url = $img_src[0];
            }
        }
    }
}

// Author Name
$hero_name = 'Sarmad Gardezi';
if (function_exists('get_field')) {
    $acf_name = get_field('hero_name');
    if (!empty($acf_name)) {
        $hero_name = $acf_name;
    }
}

// Location
$hero_location = 'Islamabad, Pakistan';
if (function_exists('get_field')) {
    $acf_location = get_field('hero_location');
    if (!empty($acf_location)) {
        $hero_location = $acf_location;
    }
}

// Social / Profile URLs
$linkedin_url = 'https://linkedin.com/in/sarmadgardezi';
if (function_exists('get_field')) {
    $acf_linkedin = get_field('hero_linkedin_url');
    if (!empty($acf_linkedin)) {
        $linkedin_url = $acf_linkedin;
    }
}

$github_url = 'https://github.com/sarmadgardezi';
if (function_exists('get_field')) {
    $acf_github = get_field('hero_github_url');
    if (!empty($acf_github)) {
        $github_url = $acf_github;
    }
}

$cobuild_url = 'https://cobuild.com';
if (function_exists('get_field')) {
    $acf_cobuild = get_field('hero_company_url');
    if (!empty($acf_cobuild)) {
        $cobuild_url = $acf_cobuild;
    }
}
?>

<section id="hero-v2" class="hero-v2-section">
    <div class="site-container hero-v2-container">
        <div class="hero-v2-content-wrap">
            
            <!-- Avatar Photo -->
            <div class="hero-v2-avatar-wrap">
                <img 
                    src="<?php echo esc_url($portrait_url); ?>" 
                    alt="<?php echo esc_attr($hero_name); ?>" 
                    class="hero-v2-avatar"
                    width="48"
                    height="48"
                    loading="eager"
                    fetchpriority="high"
                    decoding="async"
                />
            </div>

            <!-- Author / Byline -->
            <div class="hero-v2-author">
                <?php echo esc_html($hero_name); ?>
            </div>

            <!-- Main Headline / Statement -->
            <h1 class="hero-v2-statement">
                <?php
                printf(
                    /* translators: 1: opening link tag, 2: closing link tag */
                    esc_html__("I am a product manager turned engineer. I've been building software products for over a decade. Today, I work with startups as a Fractional CTO and AI Product Engineer - mostly through %1\$scobuild%2\$s, a product studio for SaaS founders.", 'sarmadgardezi'),
                    '<a href="' . esc_url($cobuild_url) . '" target="_blank" rel="noopener noreferrer" class="hero-v2-link">',
                    '</a>'
                );
                ?>
            </h1>

            <!-- Meta Info Row: Location + Social Links -->
            <div class="hero-v2-meta">
                <div class="hero-v2-location">
                    <svg class="hero-v2-location-icon" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <circle cx="12" cy="12" r="9"></circle>
                        <circle cx="12" cy="12" r="2.5"></circle>
                    </svg>
                    <span><?php echo esc_html($hero_location); ?></span>
                </div>

                <?php if (!empty($linkedin_url)) : ?>
                    <a href="<?php echo esc_url($linkedin_url); ?>" target="_blank" rel="noopener noreferrer" class="hero-v2-meta-link">
                        <?php esc_html_e('LinkedIn', 'sarmadgardezi'); ?>
                    </a>
                <?php endif; ?>

                <?php if (!empty($github_url)) : ?>
                    <a href="<?php echo esc_url($github_url); ?>" target="_blank" rel="noopener noreferrer" class="hero-v2-meta-link">
                        <?php esc_html_e('GitHub', 'sarmadgardezi'); ?>
                    </a>
                <?php endif; ?>
            </div>

        </div>
    </div>
</section>
