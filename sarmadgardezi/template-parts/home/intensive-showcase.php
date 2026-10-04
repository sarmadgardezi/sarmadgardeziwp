<?php
/**
 * Template part for displaying the "About the Intensive" Section
 *
 * Placed directly after the logo section:
 * - Eyebrow: "About the Intensive"
 * - Headline: "Where serious leaders come to work on the business"
 * - Top Narrative: 2 structured story paragraphs
 * - Interactive Video Player Card / Customer Story Spotlight
 * - Bottom Narrative: 2 execution and transformation paragraphs
 *
 * Fully dynamic via ACF & Native WordPress Meta with fallback defaults.
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;

// Retrieve Front Page ID
$front_id = get_option('page_on_front');
$target_id = $front_id ? $front_id : get_the_ID();

// Default Data matching reference design
$default_badge      = 'About the Intensive';
$default_title      = 'Where serious leaders come<br>to work on the business';
$default_text_top_1 = 'Most business owners are stuck inside the daily whirlwind reacting to problems, scrambling for the next sale, and hoping “things will calm down” next quarter. But hope isn’t a growth strategy. This event is built for leaders who are ready to step above the noise and engineer growth on purpose.';
$default_text_top_2 = 'Across five immersive days, you’ll step back from the daily grind and rebuild your business from the inside out. Together with experienced operators and growth mentors, you’ll stress-test your current model, sharpen your offers, and redesign the systems that drive profit and scale.';

$theme_img_dir       = get_template_directory_uri() . '/assets/images/';
$default_video_cover = $theme_img_dir . 'intensive-video-cover.jpg';
$default_video_title = 'Using visual development for professional, scalable sites | Webflow customer story';
$default_video_url   = 'https://www.youtube.com/watch?v=dQw4w9WgXcQ';

$default_text_bot_1 = 'This isn’t a motivational seminar. It’s a working room. You’ll be measuring margins, mapping your value chain, and making real decisions in real time with support, feedback, and accountability.';
$default_text_bot_2 = 'By the end of the experience, you’ll walk away with a clear growth playbook, a stronger leadership mindset, and a business that’s positioned to move faster, with far less friction.';

// Dynamic ACF / Meta extraction
$badge      = '';
$title      = '';
$text_top_1 = '';
$text_top_2 = '';
$video_cover= '';
$video_title= '';
$video_url  = '';
$text_bot_1 = '';
$text_bot_2 = '';

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

    if (!empty($raw_badge))  $badge      = $raw_badge;
    if (!empty($raw_title))  $title      = $raw_title;
    if (!empty($raw_top_1))  $text_top_1 = $raw_top_1;
    if (!empty($raw_top_2))  $text_top_2 = $raw_top_2;
    if (!empty($raw_vtitle)) $video_title= $raw_vtitle;
    if (!empty($raw_vurl))   $video_url  = $raw_vurl;
    if (!empty($raw_bot_1))  $text_bot_1 = $raw_bot_1;
    if (!empty($raw_bot_2))  $text_bot_2 = $raw_bot_2;

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
?>

<section id="intensive-section" class="intensive-showcase-section" aria-label="<?php echo esc_attr(strip_tags($title)); ?>">
    <div class="intensive-showcase-container">
        
        <!-- Header: Eyebrow + Main Title -->
        <div class="intensive-header-wrap">
            <span class="intensive-eyebrow"><?php echo esc_html($badge); ?></span>
            <h2 class="intensive-main-title"><?php echo wp_kses_post($title); ?></h2>
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
                    />
                    
                    <!-- Dark Gradient Overlay -->
                    <div class="intensive-video-overlay"></div>

                    <!-- Top Bar: Avatar / Badge + Video Title -->
                    <div class="intensive-video-topbar">
                        <div class="intensive-video-logo-badge">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 14.5v-9l6 4.5-6 4.5z"/>
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
                                <span class="partner-name-strong">Webflow</span>
                                <span class="partner-divider">|</span>
                                <span class="partner-name-light">flow.ninja</span>
                            </div>
                        </div>

                        <div class="intensive-watch-yt-pill">
                            <span>Watch on</span>
                            <svg width="18" height="13" viewBox="0 0 24 17" fill="#ffffff">
                                <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                            </svg>
                            <span class="yt-brand-text">YouTube</span>
                        </div>
                    </div>

                </div>

            </a>
        </div>

        <!-- Narrative Content Block (Bottom) -->
        <div class="intensive-narrative-wrap intensive-narrative-bottom">
            <p class="intensive-paragraph"><?php echo nl2br(esc_html($text_bot_1)); ?></p>
            <p class="intensive-paragraph"><?php echo nl2br(esc_html($text_bot_2)); ?></p>
        </div>

    </div>
</section>
