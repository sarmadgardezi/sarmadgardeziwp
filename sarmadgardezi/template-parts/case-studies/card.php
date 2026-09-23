<?php
/**
 * Case Study Card Template Part
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;

$post_id  = get_the_ID();
$subtitle = function_exists('sarmad_get_field') ? sarmad_get_field('case_subtitle', $post_id) : get_post_meta($post_id, '_case_subtitle', true);
$m1_val   = function_exists('sarmad_get_field') ? sarmad_get_field('case_metric_1_val', $post_id) : get_post_meta($post_id, '_case_metric_1_val', true);
$m1_lbl   = function_exists('sarmad_get_field') ? sarmad_get_field('case_metric_1_lbl', $post_id) : get_post_meta($post_id, '_case_metric_1_lbl', true);
$m2_val   = function_exists('sarmad_get_field') ? sarmad_get_field('case_metric_2_val', $post_id) : get_post_meta($post_id, '_case_metric_2_val', true);
$m2_lbl   = function_exists('sarmad_get_field') ? sarmad_get_field('case_metric_2_lbl', $post_id) : get_post_meta($post_id, '_case_metric_2_lbl', true);
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('case-study-card style-split'); ?>>
    <a href="<?php the_permalink(); ?>" class="case-study-link-wrap">
        <div class="case-study-thumb">
            <?php if (has_post_thumbnail()) : ?>
                <?php the_post_thumbnail('large', array('loading' => 'lazy')); ?>
            <?php else: ?>
                <div class="case-thumb-placeholder"></div>
            <?php endif; ?>
        </div>

        <div class="case-study-body">
            <div class="case-study-header">
                <h3 class="case-study-title"><?php the_title(); ?></h3>
                <?php if (!empty($subtitle)) : ?>
                    <p class="case-study-subtitle"><?php echo esc_html($subtitle); ?></p>
                <?php endif; ?>
            </div>

            <div class="case-study-metrics">
                <?php if (!empty($m1_val)) : ?>
                    <div class="metric-item">
                        <span class="metric-val"><?php echo esc_html($m1_val); ?></span>
                        <span class="metric-lbl"><?php echo esc_html($m1_lbl); ?></span>
                    </div>
                <?php endif; ?>
                
                <?php if (!empty($m2_val)) : ?>
                    <div class="metric-item">
                        <span class="metric-val"><?php echo esc_html($m2_val); ?></span>
                        <span class="metric-lbl"><?php echo esc_html($m2_lbl); ?></span>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </a>
</article>
