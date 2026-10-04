<?php
/**
 * Template part for displaying the Keynote Quote Section
 *
 * Displays a high-impact speaker keynote photo and quote banner on a crisp white background.
 * Fully dynamic via ACF & Native WordPress Meta fields with instant fallbacks.
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;

// Retrieve front page ID
$front_page_id = get_option('page_on_front');
$target_id = $front_page_id ? $front_page_id : get_the_ID();

// Default values matching reference design
$default_quote        = '“Nothing changes until you commit to a different way of operating. Once you decide, the rest is execution.”';
$default_pre_attr     = 'You can attribute this to:';
$default_author       = 'Tomy Robin – Event Host';

// Check for Sarmad photo or fallback image
$theme_img_dir = get_template_directory_uri() . '/assets/images/';
$default_photo = file_exists(get_template_directory() . '/assets/images/quote-speaker.jpg')
    ? $theme_img_dir . 'quote-speaker.jpg'
    : $theme_img_dir . 'sarmad.png';

// Dynamic ACF / Meta extraction
$quote_text        = '';
$quote_attribution = '';
$quote_author      = '';
$quote_photo_url   = '';

if (function_exists('get_field')) {
    $raw_quote    = get_field('keynote_quote_text', $target_id);
    $raw_pre_attr = get_field('keynote_quote_pre_attr', $target_id);
    $raw_author   = get_field('keynote_quote_author', $target_id);
    $raw_photo    = get_field('keynote_quote_photo', $target_id);

    if (!empty($raw_quote)) $quote_text = $raw_quote;
    if (!empty($raw_pre_attr)) $quote_attribution = $raw_pre_attr;
    if (!empty($raw_author)) $quote_author = $raw_author;

    if (!empty($raw_photo)) {
        if (is_array($raw_photo) && !empty($raw_photo['url'])) {
            $quote_photo_url = $raw_photo['url'];
        } elseif (is_string($raw_photo)) {
            $quote_photo_url = $raw_photo;
        }
    }
}

// Fallback to post meta if ACF is not active
if (empty($quote_text)) {
    $meta_quote = get_post_meta($target_id, 'keynote_quote_text', true);
    if (!empty($meta_quote)) $quote_text = $meta_quote;
}
if (empty($quote_attribution)) {
    $meta_pre = get_post_meta($target_id, 'keynote_quote_pre_attr', true);
    if (!empty($meta_pre)) $quote_attribution = $meta_pre;
}
if (empty($quote_author)) {
    $meta_author = get_post_meta($target_id, 'keynote_quote_author', true);
    if (!empty($meta_author)) $quote_author = $meta_author;
}
if (empty($quote_photo_url)) {
    $meta_photo = get_post_meta($target_id, 'keynote_quote_photo', true);
    if (!empty($meta_photo)) $quote_photo_url = $meta_photo;
}

// Apply defaults if still empty
if (empty($quote_text)) $quote_text = $default_quote;
if (empty($quote_attribution)) $quote_attribution = $default_pre_attr;
if (empty($quote_author)) $quote_author = $default_author;
if (empty($quote_photo_url)) $quote_photo_url = $default_photo;
?>

<section id="keynote-quote-section" class="keynote-quote-section" aria-label="<?php esc_attr_e('Keynote Quote', 'sarmadgardezi'); ?>">
    <div class="keynote-quote-container">
        <div class="keynote-quote-grid">
            
            <!-- Left: Speaker / Keynote Photo -->
            <div class="keynote-quote-media-wrap">
                <div class="keynote-quote-img-box">
                    <img 
                        src="<?php echo esc_url($quote_photo_url); ?>" 
                        alt="<?php echo esc_attr($quote_author); ?>" 
                        class="keynote-quote-img"
                        loading="lazy"
                        width="540"
                        height="540"
                    />
                </div>
            </div>

            <!-- Right: Quote Content & Attribution -->
            <div class="keynote-quote-content-wrap">
                <blockquote class="keynote-quote-blockquote">
                    <p class="keynote-quote-text">
                        <?php echo nl2br(esc_html($quote_text)); ?>
                    </p>
                </blockquote>

                <div class="keynote-quote-attribution-box">
                    <span class="keynote-quote-pre-attr">
                        <?php echo esc_html($quote_attribution); ?>
                    </span>
                    <h3 class="keynote-quote-author">
                        <?php echo esc_html($quote_author); ?>
                    </h3>
                </div>
            </div>

        </div>
    </div>
</section>
