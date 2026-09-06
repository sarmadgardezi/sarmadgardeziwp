<?php
/**
 * Template part for displaying the About / Philosophy section
 *
 * Faithfully matches the reference design:
 * - 2-line statement heading with Light Blue accent
 * - Rounded portrait card with embedded floating social icons
 * - Author name in Light Blue & role subtitle
 * - Editorial paragraphs with Light Blue highlighted opening phrases
 * - Built with theme font: Google Sans Flex
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;

// Dynamic field retrieval with defensive checks
$heading_1 = function_exists('sarmadgardezi_get_field') ? sarmadgardezi_get_field('about_heading_line_1') : '';
if (empty($heading_1)) {
    $heading_1 = __('Designing experiences', 'sarmadgardezi');
}

$heading_2 = function_exists('sarmadgardezi_get_field') ? sarmadgardezi_get_field('about_heading_line_2') : '';
if (empty($heading_2)) {
    $heading_2 = __('that solve real problems.', 'sarmadgardezi');
}

$name = function_exists('sarmadgardezi_get_field') ? sarmadgardezi_get_field('about_name') : '';
if (empty($name)) {
    $name = __('Sarmad Gardezi', 'sarmadgardezi');
}

$role = function_exists('sarmadgardezi_get_field') ? sarmadgardezi_get_field('about_role') : '';
if (empty($role)) {
    $role = __('Senior Software Engineer & Google Cloud Expert', 'sarmadgardezi');
}

// Portrait image
$photo_url = '';
if (function_exists('get_field')) {
    $custom_photo = get_field('about_photo');
    if (!empty($custom_photo)) {
        if (is_array($custom_photo) && !empty($custom_photo['url'])) {
            $photo_url = $custom_photo['url'];
        } elseif (is_numeric($custom_photo)) {
            $img_src = wp_get_attachment_image_src($custom_photo, 'large');
            if ($img_src) {
                $photo_url = $img_src[0];
            }
        } elseif (is_string($custom_photo)) {
            $photo_url = $custom_photo;
        }
    }
}
if (empty($photo_url)) {
    $photo_url = function_exists('sarmadgardezi_asset') 
        ? sarmadgardezi_asset('images/sarmad.png') 
        : get_template_directory_uri() . '/assets/images/sarmad.png';
}

// Social links
$linkedin_url  = 'https://linkedin.com/in/sarmadgardezi';
$github_url    = 'https://github.com/sarmadgardezi';
$instagram_url = 'https://instagram.com/sarmadgardezi';
if (function_exists('get_field')) {
    $acf_linkedin = get_field('about_linkedin');
    if (!empty($acf_linkedin)) $linkedin_url = $acf_linkedin;
    $acf_github = get_field('about_github');
    if (!empty($acf_github)) $github_url = $acf_github;
    $acf_instagram = get_field('about_instagram');
    if (!empty($acf_instagram)) $instagram_url = $acf_instagram;
}
?>

<section id="about" class="about-philosophy-section" aria-label="<?php echo esc_attr($heading_1 . ' ' . $heading_2); ?>">
    <div class="site-container about-philosophy-container">

        <!-- Statement Heading -->
        <div class="about-statement-header">
            <h2 class="about-statement-title">
                <span class="title-lead"><?php echo esc_html($heading_1); ?></span>
                <span class="title-accent"><?php echo esc_html($heading_2); ?></span>
            </h2>
        </div>

        <!-- Two-Column Editorial Grid -->
        <div class="about-editorial-grid">

            <!-- Left Column: Photo Card & Details -->
            <div class="about-profile-col">
                <div class="about-photo-card">
                    <img 
                        src="<?php echo esc_url($photo_url); ?>" 
                        alt="<?php echo esc_attr($name . ' - ' . $role); ?>" 
                        class="about-photo-img"
                        loading="lazy"
                        width="380"
                        height="440"
                    />

                    <!-- Floating Social Media Icons on Photo -->
                    <div class="about-card-socials" aria-label="<?php esc_attr_e('Social Profiles', 'sarmadgardezi'); ?>">
                        <a href="<?php echo esc_url($linkedin_url); ?>" target="_blank" rel="noopener noreferrer" class="social-icon-bubble" aria-label="LinkedIn">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                            </svg>
                        </a>
                        <a href="<?php echo esc_url($github_url); ?>" target="_blank" rel="noopener noreferrer" class="social-icon-bubble" aria-label="GitHub">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z"/>
                            </svg>
                        </a>
                        <a href="<?php echo esc_url($instagram_url); ?>" target="_blank" rel="noopener noreferrer" class="social-icon-bubble" aria-label="Instagram">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Profile Info under Photo -->
                <div class="about-profile-meta">
                    <h3 class="about-profile-name"><?php echo esc_html($name); ?></h3>
                    <p class="about-profile-role"><?php echo esc_html($role); ?></p>
                </div>
            </div>

            <!-- Right Column: Editorial Paragraphs with Highlighted Openings -->
            <div class="about-narrative-col">
                <p class="about-narrative-paragraph">
                    <span class="highlight-accent"><?php esc_html_e('I turn brand strategy and cloud architecture into things people actually stop for,', 'sarmadgardezi'); ?></span>
                    <?php esc_html_e('design systems that scale, and software experiences that keep delivering.', 'sarmadgardezi'); ?>
                </p>

                <p class="about-narrative-paragraph">
                    <span class="highlight-accent"><?php esc_html_e("I don't fill briefs, I solve problems.", 'sarmadgardezi'); ?></span>
                    <?php esc_html_e('Identity refresh or full-stack cloud strategy, the goal stays the same: grab attention, then communicate and execute with zero confusion.', 'sarmadgardezi'); ?>
                </p>

                <p class="about-narrative-paragraph">
                    <span class="highlight-accent"><?php esc_html_e("I'm continuously evolving my toolkit", 'sarmadgardezi'); ?></span>
                    <?php esc_html_e("integrating advanced platforms, Google Cloud architectures, and generative AI workflows to ensure the technical and creative assets I build don't just follow trends, but consistently elevate market positioning.", 'sarmadgardezi'); ?>
                </p>
            </div>

        </div>

    </div>
</section>
