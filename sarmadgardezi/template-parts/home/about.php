<?php
/**
 * Template part for displaying the Results & Impact Showcase Section ("By the numbers")
 *
 * Sarmad Gardezi - Google Achievements, Talks, Global Hackathons & Cloud Impact
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;

// Photo URL with Sarmad Gardezi Google 2026 Photo default & ACF support
$default_photo = content_url('/uploads/2026/09/sarmadgardezi-google-2026.webp');
$visual_photo  = $default_photo;

if (function_exists('get_field')) {
    $custom_photo = get_field('impact_photo');
    if (!empty($custom_photo)) {
        if (is_array($custom_photo) && !empty($custom_photo['url'])) {
            $visual_photo = $custom_photo['url'];
        } elseif (is_numeric($custom_photo)) {
            $img_src = wp_get_attachment_image_src($custom_photo, 'full');
            if ($img_src) {
                $visual_photo = $img_src[0];
            }
        } elseif (is_string($custom_photo)) {
            $visual_photo = $custom_photo;
        }
    }
}

// Impact Overlay Lines
$overlay_lines = array(
    'GOOGLE TALKS.',
    'GLOBAL HACKATHONS.',
);

// Main Metric
$main_badge  = 'By the numbers';
$main_number = '50';
$main_suffix = '+';
$main_label  = 'Keynote talks, Google events & hackathons led globally.';

// Breakdown Rows
$metric_rows = array(
    array(
        'value'     => '15',
        'suffix'    => '+',
        'color'     => '#3b82f6', // Google Blue
        'title'     => __('Hackathons Won & Judged', 'sarmadgardezi'),
        'desc'      => __('Global AI & Cloud buildathons.', 'sarmadgardezi'),
    ),
    array(
        'value'     => '50',
        'suffix'    => '+',
        'color'     => '#eab308', // Google Yellow
        'title'     => __('Google & Community Talks', 'sarmadgardezi'),
        'desc'      => __('GDG Cloud, DevFests & Global Summits.', 'sarmadgardezi'),
    ),
    array(
        'value'     => '25',
        'suffix'    => 'K+',
        'color'     => '#10b981', // Google Green
        'title'     => __('Engineers & Viewers Reached', 'sarmadgardezi'),
        'desc'      => __('Tech talks, workshops & open-source.', 'sarmadgardezi'),
    ),
);

// Bottom Pills
$benefit_pills = array(
    array(
        'icon' => 'check',
        'text' => __('Google Cloud Speaker & Architect', 'sarmadgardezi'),
    ),
    array(
        'icon' => 'rocket',
        'text' => __('GDG Cloud Islamabad Leader', 'sarmadgardezi'),
    ),
    array(
        'icon' => 'trophy',
        'text' => __('Global Hackathon Judge & Mentor', 'sarmadgardezi'),
    ),
    array(
        'icon' => 'target',
        'text' => __('Keynotes & Hands-on Workshops', 'sarmadgardezi'),
    ),
    array(
        'icon' => 'bolt',
        'text' => __('Scalable Agentic AI & Cloud Systems', 'sarmadgardezi'),
    ),
);
?>

<section id="numbers-impact" class="numbers-impact-section" aria-label="<?php esc_attr_e('By the numbers impact', 'sarmadgardezi'); ?>">
    <div class="numbers-impact-container">

        <!-- Top Two-Column Grid -->
        <div class="numbers-impact-grid">

            <!-- Left Card: Visual Photo Card with Bottom Overlay Text -->
            <div class="impact-photo-card">
                <img 
                    src="<?php echo esc_url($visual_photo); ?>" 
                    alt="<?php esc_attr_e('Sarmad Gardezi - Google Talks & Hackathons', 'sarmadgardezi'); ?>" 
                    class="impact-photo-img"
                    loading="lazy"
                    width="600"
                    height="600"
                    onerror="this.onerror=null;this.src='/wp-content/uploads/2026/09/sarmadgardezi-google-2026.webp';"
                />
                
                <!-- Bottom Dark Gradient Overlay -->
                <div class="impact-gradient-overlay" aria-hidden="true"></div>

                <!-- Overlay Typography -->
                <div class="impact-overlay-content">
                    <h2 class="impact-overlay-title">
                        <?php foreach ($overlay_lines as $line) : ?>
                            <span class="impact-title-line"><?php echo esc_html($line); ?></span>
                        <?php endforeach; ?>
                    </h2>
                </div>
            </div>

            <!-- Right Card: White Numbers & Breakdown Card -->
            <div class="impact-numbers-card">
                
                <!-- Top Centered Pill Badge -->
                <div class="numbers-pill-badge-wrap">
                    <span class="numbers-pill-badge"><?php echo esc_html($main_badge); ?></span>
                </div>

                <!-- Main Highlight Number -->
                <div class="numbers-main-metric">
                    <div class="main-metric-value">
                        <?php echo esc_html($main_number); ?><span class="metric-accent-purple"><?php echo esc_html($main_suffix); ?></span>
                    </div>
                    <p class="main-metric-label"><?php echo esc_html($main_label); ?></p>
                </div>

                <!-- 3 Metric Rows -->
                <div class="numbers-rows-list">
                    <?php foreach ($metric_rows as $row) : ?>
                        <div class="numbers-row-item">
                            <div class="row-value-col">
                                <span class="row-num"><?php echo esc_html($row['value']); ?></span><span class="row-accent" style="color: <?php echo esc_attr($row['color']); ?>;"><?php echo esc_html($row['suffix']); ?></span>
                            </div>
                            <div class="row-text-col">
                                <h3 class="row-heading"><?php echo esc_html($row['title']); ?></h3>
                                <p class="row-subtext"><?php echo esc_html($row['desc']); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

            </div>

        </div>

        <!-- Bottom Horizontal Benefit Pills Row -->
        <div class="impact-pills-marquee-wrap">
            <div class="impact-pills-row">
                <?php foreach ($benefit_pills as $pill) : ?>
                    <div class="impact-benefit-pill">
                        <span class="benefit-icon-circle">
                            <?php if ($pill['icon'] === 'check') : ?>
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            <?php elseif ($pill['icon'] === 'rocket') : ?>
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.5s-4 4.5-4 9.5c0 2.2 1.3 4.2 3 5v4l1-1 1 1v-4c1.7-.8 3-2.8 3-5 0-5-4-9.5-4-9.5z"/></svg>
                            <?php elseif ($pill['icon'] === 'trophy') : ?>
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor"><path d="M19 5h-2V3H7v2H5c-1.1 0-2 .9-2 2v1c0 2.55 1.92 4.63 4.39 4.94A5.01 5.01 0 0 0 11 15.9V19H8v2h8v-2h-3v-3.1c1.8-.3 3.32-1.5 3.61-3.06C19.08 12.63 21 10.55 21 8V7c0-1.1-.9-2-2-2zM5 8V7h2v3.82C5.84 10.4 5 9.3 5 8zm14 0c0 1.3-.84 2.4-2 2.82V7h2v1z"/></svg>
                            <?php elseif ($pill['icon'] === 'target') : ?>
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><circle cx="12" cy="12" r="6"></circle><circle cx="12" cy="12" r="2"></circle></svg>
                            <?php elseif ($pill['icon'] === 'bolt') : ?>
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon></svg>
                            <?php endif; ?>
                        </span>
                        <span class="benefit-pill-text"><?php echo esc_html($pill['text']); ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

    </div>
</section>

