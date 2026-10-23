<?php
/**
 * Template part for displaying the "About Me" Section
 *
 * Placed directly after the logo section:
 * - Eyebrow: "About Me"
 * - Headline: "Turning Ideas Into Powerful Digital Products" with 3 visual badges/icons matching the hero style
 * - Narrative: 2 structured story paragraphs
 * - Interactive Video Showcase Card: YouTube video player spotlight with thumbnail & custom styling
 * - Channel Highlight: Callout for YouTube channel started 8 years ago with direct channel link
 *
 * Fully dynamic via ACF & Native WordPress Meta with fallback defaults.
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;

// Retrieve Front Page ID
$front_id = get_option('page_on_front');
$target_id = $front_id ? $front_id : get_the_ID();

// Default Data matching requested "About Me" copy
$default_badge      = 'About Me';
$default_title      = 'Turning Ideas Into Powerful Digital Products';
$default_text_top_1 = 'I help businesses turn their ideas into modern web applications and reliable cloud solutions. As a Cloud App Developer and Cloud Engineer, I build fast, secure, and scalable products using Google Cloud, Firebase, and modern web technologies.';
$default_text_top_2 = 'From building websites and web applications to developing cloud systems and AI-powered tools, I focus on creating practical solutions that solve real problems, improve efficiency, and help businesses grow.';

$default_video_url   = 'https://www.youtube.com/watch?v=LAjvWf7dMYA';
$default_video_cover = 'https://img.youtube.com/vi/LAjvWf7dMYA/maxresdefault.jpg';
$default_video_title = 'How to Start Blog in Pakistan Step by Step Guide';
$default_channel_url = 'https://www.youtube.com/@SarmadGardezi';

$default_text_bot_1 = 'I started my YouTube channel 8 years ago to document my journey, teach cloud engineering, and share practical web development guides with builders around the world.';
$default_text_bot_2 = 'Through real-world code breakdowns, tutorials, and cloud architecture deep dives, I help businesses and creators turn ideas into reliable, scalable digital products.';
$default_text_bot_3 = 'Explore hands-on guides on my <a href="https://www.youtube.com/@SarmadGardezi" target="_blank" rel="noopener noreferrer">YouTube channel (@SarmadGardezi)</a>, or connect with me directly to build your next web application.';

// Dynamic ACF / Meta extraction
$badge       = '';
$title       = '';
$text_top_1  = '';
$text_top_2  = '';
$video_cover = '';
$video_title = '';
$video_url   = '';
$text_bot_1  = '';
$text_bot_2  = '';
$text_bot_3  = '';
$channel_url = '';

if (function_exists('get_field')) {
    $raw_badge      = get_field('intensive_badge', $target_id);
    $raw_title      = get_field('intensive_title', $target_id);
    $raw_top_1      = get_field('intensive_text_top_1', $target_id);
    $raw_top_2      = get_field('intensive_text_top_2', $target_id);
    $raw_cover      = get_field('intensive_video_cover', $target_id);
    $raw_vtitle     = get_field('intensive_video_title', $target_id);
    $raw_vurl       = get_field('intensive_video_url', $target_id);
    $raw_bot_1      = get_field('intensive_text_bot_1', $target_id);
    $raw_bot_2      = get_field('intensive_text_bot_2', $target_id);
    $raw_bot_3      = get_field('intensive_text_bot_3', $target_id);
    $raw_churl      = get_field('about_youtube_channel_url', $target_id);

    if (!empty($raw_badge))  $badge      = $raw_badge;
    if (!empty($raw_title))  $title      = $raw_title;
    if (!empty($raw_top_1))  $text_top_1 = $raw_top_1;
    if (!empty($raw_top_2))  $text_top_2 = $raw_top_2;
    if (!empty($raw_vtitle)) $video_title= $raw_vtitle;
    if (!empty($raw_vurl))   $video_url  = $raw_vurl;
    if (!empty($raw_bot_1))  $text_bot_1 = $raw_bot_1;
    if (!empty($raw_bot_2))  $text_bot_2 = $raw_bot_2;
    if (!empty($raw_bot_3))  $text_bot_3 = $raw_bot_3;
    if (!empty($raw_churl))  $channel_url= $raw_churl;

    if (!empty($raw_cover)) {
        if (is_array($raw_cover) && !empty($raw_cover['url'])) {
            $video_cover = $raw_cover['url'];
        } elseif (is_string($raw_cover)) {
            $video_cover = $raw_cover;
        }
    }
}

// Fallback to post meta
if (empty($badge))       $badge       = get_post_meta($target_id, 'intensive_badge', true);
if (empty($title))       $title       = get_post_meta($target_id, 'intensive_title', true);
if (empty($text_top_1))  $text_top_1  = get_post_meta($target_id, 'intensive_text_top_1', true);
if (empty($text_top_2))  $text_top_2  = get_post_meta($target_id, 'intensive_text_top_2', true);
if (empty($video_cover)) $video_cover = get_post_meta($target_id, 'intensive_video_cover', true);
if (empty($video_title)) $video_title = get_post_meta($target_id, 'intensive_video_title', true);
if (empty($video_url))   $video_url   = get_post_meta($target_id, 'intensive_video_url', true);
if (empty($text_bot_1))  $text_bot_1  = get_post_meta($target_id, 'intensive_text_bot_1', true);
if (empty($text_bot_2))  $text_bot_2  = get_post_meta($target_id, 'intensive_text_bot_2', true);
if (empty($text_bot_3))  $text_bot_3  = get_post_meta($target_id, 'intensive_text_bot_3', true);
if (empty($channel_url)) $channel_url = get_post_meta($target_id, 'about_youtube_channel_url', true);

// Clean out legacy "Intensive" content if migrated/saved previously
if ($badge === 'About the Intensive') $badge = '';
if (!empty($title) && strpos($title, 'Where serious leaders come') !== false) $title = '';
if (!empty($text_top_1) && strpos($text_top_1, 'Most business owners are stuck') !== false) $text_top_1 = '';
if (!empty($text_top_2) && strpos($text_top_2, 'Across five immersive days') !== false) $text_top_2 = '';
if (!empty($video_url) && strpos($video_url, 'dQw4w9WgXcQ') !== false) $video_url = '';
if (!empty($video_title) && strpos($video_title, 'Webflow customer story') !== false) $video_title = '';
if (!empty($text_bot_1) && strpos($text_bot_1, 'This isn’t a motivational seminar') !== false) $text_bot_1 = '';
if (!empty($text_bot_2) && strpos($text_bot_2, 'By the end of the experience') !== false) $text_bot_2 = '';

// Set final values with defaults
if (empty($badge))       $badge       = $default_badge;
if (empty($title))       $title       = $default_title;
if (empty($text_top_1))  $text_top_1  = $default_text_top_1;
if (empty($text_top_2))  $text_top_2  = $default_text_top_2;
if (empty($video_cover)) $video_cover = $default_video_cover;
if (empty($video_title)) $video_title = $default_video_title;
if (empty($video_url))   $video_url   = $default_video_url;
if (empty($text_bot_1))  $text_bot_1  = $default_text_bot_1;
if (empty($text_bot_2))  $text_bot_2  = $default_text_bot_2;
if (empty($text_bot_3))  $text_bot_3  = $default_text_bot_3;
if (empty($channel_url)) $channel_url = $default_channel_url;

// Milestone Photos Defaults (3 Framed Polaroid-Style Photos Matching Reference)
$default_photos = array(
    array(
        'img'     => 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=700&h=700&fit=crop&q=80',
        'caption' => 'tuuul Planning – 2024',
        'tilt'    => 'tilt-left',
    ),
    array(
        'img'     => 'https://images.unsplash.com/photo-1531482615713-2afd69097998?w=700&h=700&fit=crop&q=80',
        'caption' => 'tuuul Launch – 2025',
        'tilt'    => 'tilt-center',
    ),
    array(
        'img'     => 'https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?w=700&h=700&fit=crop&q=80',
        'caption' => 'Cursor Hackathon – 2026',
        'tilt'    => 'tilt-right',
    ),
);

$milestone_photos = array();
for ($i = 1; $i <= 3; $i++) {
    $c_img = '';
    $c_cap = '';
    if (function_exists('get_field')) {
        $c_img = get_field('about_photo_' . $i . '_img', $target_id);
        $c_cap = get_field('about_photo_' . $i . '_caption', $target_id);
    }
    if (empty($c_img)) $c_img = get_post_meta($target_id, 'about_photo_' . $i . '_img', true);
    if (empty($c_cap)) $c_cap = get_post_meta($target_id, 'about_photo_' . $i . '_caption', true);

    if (is_array($c_img) && !empty($c_img['url'])) {
        $c_img = $c_img['url'];
    }

    $milestone_photos[] = array(
        'img'     => !empty($c_img) ? $c_img : $default_photos[$i - 1]['img'],
        'caption' => !empty($c_cap) ? $c_cap : $default_photos[$i - 1]['caption'],
        'tilt'    => $default_photos[$i - 1]['tilt'],
    );
}

// Determine whether we render the default rich headline with 3 creative icons
$is_default_title = empty($title) || trim($title) === $default_title || strip_tags($title) === $default_title;
?>

<section id="about" class="intensive-showcase-section about-me-showcase-section" aria-label="<?php echo esc_attr(strip_tags($title)); ?>">
    <div class="intensive-showcase-container">
        
        <!-- Header: Eyebrow + Main Title with 3 Creative Hero Badges -->
        <div class="intensive-header-wrap">
            <span class="intensive-eyebrow"><?php echo esc_html($badge); ?></span>

            <?php if ($is_default_title) : ?>
                <h2 class="intensive-main-title about-main-title">
                    <!-- Line 1: "Turning Ideas" + Capsule Cloud Toggle Badge -->
                    <span class="about-title-line">
                        <span class="title-word"><?php esc_html_e('Turning Ideas', 'sarmadgardezi'); ?></span>
                        <span class="badge-capsule-arrow" aria-hidden="true">
                            <span class="badge-circle-green"></span>
                            <span class="badge-body-blue">
                                <svg class="badge-cloud-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M17.5 19H9a7 7 0 1 1 6.71-9h1.79a4.5 4.5 0 1 1 0 9Z"/>
                                </svg>
                            </span>
                        </span>
                    </span>

                    <!-- Line 2: "Into" + Code Circle </> + "Powerful Digital Products" + Duo Cloud Circles -->
                    <span class="about-title-line">
                        <span class="title-word"><?php esc_html_e('Into', 'sarmadgardezi'); ?></span>
                        <span class="badge-circle-code" aria-hidden="true">
                            <span class="code-symbol">&lt;/&gt;</span>
                        </span>
                        <span class="title-word"><?php esc_html_e('Powerful Digital Products', 'sarmadgardezi'); ?></span>
                        <span class="badge-duo-circles" aria-hidden="true">
                            <span class="circle-yellow"></span>
                            <span class="circle-dark">
                                <svg class="badge-cloud-upload-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M4 14.899A7 7 0 1 1 15.71 8h1.79a4.5 4.5 0 0 1 2.5 8.242"/>
                                    <path d="M12 12v9"/>
                                    <path d="m8 16 4-4 4 4"/>
                                </svg>
                            </span>
                        </span>
                    </span>
                </h2>
            <?php else : ?>
                <h2 class="intensive-main-title about-main-title"><?php echo wp_kses_post($title); ?></h2>
            <?php endif; ?>
        </div>

        <!-- Narrative Content Block (Top) -->
        <div class="intensive-narrative-wrap">
            <p class="intensive-paragraph"><?php echo nl2br(esc_html($text_top_1)); ?></p>
            <p class="intensive-paragraph"><?php echo nl2br(esc_html($text_top_2)); ?></p>
        </div>

        <!-- Video Showcase Player Box -->
        <div class="intensive-video-container">
            <a href="<?php echo esc_url($video_url); ?>" target="_blank" rel="noopener noreferrer" class="intensive-video-card" aria-label="<?php echo esc_attr($video_title); ?>">
                
                <!-- Video Cover Image -->
                <div class="intensive-video-media-box">
                    <img 
                        src="<?php echo esc_url($video_cover); ?>" 
                        alt="<?php echo esc_attr($video_title); ?>" 
                        class="intensive-video-img"
                        loading="lazy"
                        width="1120"
                        height="630"
                        onerror="this.onerror=null; this.src='https://img.youtube.com/vi/LAjvWf7dMYA/hqdefault.jpg';"
                    />
                    
                    <!-- Dark Gradient Overlay -->
                    <div class="intensive-video-overlay"></div>

                    <!-- Top Bar: YouTube Red Badge + Video Title -->
                    <div class="intensive-video-topbar">
                        <div class="intensive-video-logo-badge yt-badge" aria-hidden="true">
                            <svg width="20" height="15" viewBox="0 0 24 17" fill="#ffffff">
                                <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                            </svg>
                        </div>
                        <span class="intensive-video-topbar-title"><?php echo esc_html($video_title); ?></span>
                    </div>

                    <!-- Center YouTube Style Red Play Button -->
                    <div class="intensive-play-btn-wrap">
                        <div class="intensive-play-btn" aria-hidden="true">
                            <svg width="68" height="48" viewBox="0 0 68 48">
                                <path class="intensive-play-btn-bg" d="M66.52,7.74c-0.78-2.93-2.49-5.41-5.42-6.19C55.79,.13,34,0,34,0S12.21,.13,6.9,1.55 C3.97,2.33,2.27,4.81,1.48,7.74C0.06,13.05,0,24,0,24s0.06,10.95,1.48,16.26c0.78,2.93,2.49,5.41,5.42,6.19 C12.21,47.87,34,48,34,48s21.79-0.13,27.1-1.55c2.93-0.78,4.64-3.26,5.42-6.19C67.94,34.95,68,24,68,24S67.94,13.05,66.52,7.74z" fill="#ff0000"></path>
                                <path d="M 45,24 27,14 27,34" fill="#ffffff"></path>
                            </svg>
                        </div>
                    </div>

                    <!-- Bottom Bar: Branding & Watch on YouTube Button -->
                    <div class="intensive-video-bottombar">
                        <div class="intensive-video-partner-logos">
                            <div class="intensive-partner-brand">
                                <span class="partner-name-strong"><?php esc_html_e('Sarmad Gardezi', 'sarmadgardezi'); ?></span>
                                <span class="partner-divider">•</span>
                                <span class="partner-name-light"><?php esc_html_e('YouTube Channel (8+ Years)', 'sarmadgardezi'); ?></span>
                            </div>
                        </div>

                        <div class="intensive-watch-yt-pill">
                            <span><?php esc_html_e('Watch on', 'sarmadgardezi'); ?></span>
                            <svg width="18" height="13" viewBox="0 0 24 17" fill="#ffffff">
                                <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                            </svg>
                            <span class="yt-brand-text"><?php esc_html_e('YouTube', 'sarmadgardezi'); ?></span>
                        </div>
                    </div>

                </div>

            </a>
        </div>

        <!-- Narrative Content Block (Bottom: 3 Lines) -->
        <div class="intensive-narrative-wrap intensive-narrative-bottom">
            <?php if (!empty($text_bot_1)) : ?>
                <p class="intensive-paragraph"><?php echo wp_kses_post($text_bot_1); ?></p>
            <?php endif; ?>
            <?php if (!empty($text_bot_2)) : ?>
                <p class="intensive-paragraph"><?php echo wp_kses_post($text_bot_2); ?></p>
            <?php endif; ?>
            <?php if (!empty($text_bot_3)) : ?>
                <p class="intensive-paragraph"><?php echo wp_kses_post($text_bot_3); ?></p>
            <?php endif; ?>
        </div>

        <!-- 3 Framed Polaroid-Style Milestone Photos -->
        <div class="about-photo-milestones-wrap" aria-label="<?php esc_attr_e('Milestones and team moments', 'sarmadgardezi'); ?>">
            <div class="about-photo-milestones-grid">
                <?php foreach ($milestone_photos as $p) : ?>
                    <div class="photo-milestone-item <?php echo esc_attr($p['tilt']); ?>">
                        <div class="photo-milestone-card">
                            <div class="photo-milestone-img-wrap">
                                <img 
                                    src="<?php echo esc_url($p['img']); ?>" 
                                    alt="<?php echo esc_attr($p['caption']); ?>" 
                                    class="photo-milestone-img"
                                    loading="lazy"
                                    width="500"
                                    height="500"
                                />
                            </div>
                        </div>
                        <span class="photo-milestone-caption"><?php echo esc_html($p['caption']); ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

    </div>
</section>
