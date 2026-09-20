<?php
/**
 * Template part for displaying the Results & Impact Showcase Section ("By the numbers")
 *
 * 100% matches the reference design:
 * - Left: Rounded photo card with bold impact overlay ("REAL GROWTH. REAL BRANDS. REAL RESULTS.")
 * - Right: "By the numbers" card featuring 1,200+ main stat & 3 rows (120+ Brands, 4.8X ROAS, 80M+ Views)
 * - Bottom: Seamless horizontal pills ticker with benefit badges
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;

// Dynamic / Editable content with high-fidelity defaults
$visual_photo = 'https://images.unsplash.com/photo-1529156069898-49953e39b3ac?w=1000&h=1000&fit=crop';
if (function_exists('get_field')) {
    $custom_photo = get_field('impact_photo');
    if (!empty($custom_photo)) {
        if (is_array($custom_photo) && !empty($custom_photo['url'])) {
            $visual_photo = $custom_photo['url'];
        } elseif (is_string($custom_photo)) {
            $visual_photo = $custom_photo;
        }
    }
}

// Impact Overlay Lines
$overlay_lines = array(
    'REAL GROWTH.',
    'REAL BRANDS.',
    'REAL RESULTS.',
);

// Main Metric
$main_badge  = 'By the numbers';
$main_number = '1,200';
$main_suffix = '+';
$main_label  = 'Videos delivered briefed, reviewed, approved.';

// Breakdown Rows
$metric_rows = array(
    array(
        'value'     => '120',
        'suffix'    => '+',
        'color'     => '#3b82f6', // Blue
        'title'     => __('Brands Served', 'sarmadgardezi'),
        'desc'      => __('Every niche. Every platform.', 'sarmadgardezi'),
    ),
    array(
        'value'     => '4.8',
        'suffix'    => 'X',
        'color'     => '#eab308', // Yellow
        'title'     => __('Average ROAS Lift', 'sarmadgardezi'),
        'desc'      => __('Nearly 5x return on ad spend.', 'sarmadgardezi'),
    ),
    array(
        'value'     => '80',
        'suffix'    => 'M+',
        'color'     => '#10b981', // Green
        'title'     => __('Total Views Generated', 'sarmadgardezi'),
        'desc'      => __('Organic. Zero ad spend.', 'sarmadgardezi'),
    ),
);

// Bottom Pills
$benefit_pills = array(
    array(
        'icon' => 'check',
        'text' => __('You approve every video', 'sarmadgardezi'),
    ),
    array(
        'icon' => 'rocket',
        'text' => __('First content in 7 days', 'sarmadgardezi'),
    ),
    array(
        'icon' => 'refresh',
        'text' => __('Unlimited revisions', 'sarmadgardezi'),
    ),
    array(
        'icon' => 'target',
        'text' => __('Hook testing included', 'sarmadgardezi'),
    ),
    array(
        'icon' => 'bolt',
        'text' => __('Performance-matched creators', 'sarmadgardezi'),
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
                    alt="<?php esc_attr_e('Real growth, real brands, real results', 'sarmadgardezi'); ?>" 
                    class="impact-photo-img"
                    loading="lazy"
                    width="600"
                    height="600"
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
                            <?php elseif ($pill['icon'] === 'refresh') : ?>
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="23 4 23 10 17 10"></polyline><polyline points="1 20 1 14 7 14"></polyline><path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path></svg>
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
