<?php
/**
 * Case Study Card Template Part
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;

$post_id  = get_the_ID();
$client   = function_exists('sarmad_get_field') ? sarmad_get_field('case_client', $post_id) : get_post_meta($post_id, '_case_client', true);
$timeline = function_exists('sarmad_get_field') ? sarmad_get_field('case_timeline', $post_id) : get_post_meta($post_id, '_case_timeline', true);
$m1_val   = function_exists('sarmad_get_field') ? sarmad_get_field('case_metric_1_val', $post_id) : get_post_meta($post_id, '_case_metric_1_val', true);
$m1_lbl   = function_exists('sarmad_get_field') ? sarmad_get_field('case_metric_1_lbl', $post_id) : get_post_meta($post_id, '_case_metric_1_lbl', true);
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('glass-card case-study-card'); ?>>
    <?php if (has_post_thumbnail()) : ?>
        <div class="case-study-thumb">
            <a href="<?php the_permalink(); ?>" aria-label="<?php echo esc_attr(sprintf(__('Read case study: %s', 'sarmadgardezi'), get_the_title())); ?>">
                <?php the_post_thumbnail('sarmadgardezi-card', array('loading' => 'lazy')); ?>
            </a>
        </div>
    <?php endif; ?>

    <div class="case-study-body">
        <div class="case-study-meta">
            <?php if (!empty($client)) : ?>
                <span class="case-client"><?php echo esc_html($client); ?></span>
            <?php endif; ?>
            <?php if (!empty($client) && !empty($timeline)) : ?>
                <span class="meta-dot" aria-hidden="true">&bull;</span>
            <?php endif; ?>
            <?php if (!empty($timeline)) : ?>
                <span class="case-timeline"><?php echo esc_html($timeline); ?></span>
            <?php endif; ?>
        </div>

        <h3 class="case-study-title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h3>

        <div class="case-study-excerpt">
            <?php the_excerpt(); ?>
        </div>

        <?php if (!empty($m1_val)) : ?>
            <div class="case-highlight-metric">
                <span class="metric-val"><?php echo esc_html($m1_val); ?></span>
                <span class="metric-lbl"><?php echo esc_html($m1_lbl); ?></span>
            </div>
        <?php endif; ?>

        <div class="case-study-actions">
            <a href="<?php the_permalink(); ?>" class="btn btn-secondary btn-sm">
                <span><?php esc_html_e('Read Full Case Study', 'sarmadgardezi'); ?></span>
                <?php echo sarmadgardezi_get_icon('arrow-right'); ?>
            </a>
        </div>
    </div>
</article>
