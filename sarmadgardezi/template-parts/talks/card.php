<?php
/**
 * Talk Card Template Part
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;

$post_id       = get_the_ID();
$event         = function_exists('sarmad_get_field') ? sarmad_get_field('talk_event', $post_id) : get_post_meta($post_id, '_talk_event', true);
$date          = function_exists('sarmad_get_field') ? sarmad_get_field('talk_date', $post_id) : get_post_meta($post_id, '_talk_date', true);
$location      = function_exists('sarmad_get_field') ? sarmad_get_field('talk_location', $post_id) : get_post_meta($post_id, '_talk_location', true);
$slides_url    = function_exists('sarmad_get_field') ? sarmad_get_field('talk_slides_url', $post_id) : get_post_meta($post_id, '_talk_slides_url', true);
$recording_url = function_exists('sarmad_get_field') ? sarmad_get_field('talk_recording_url', $post_id) : get_post_meta($post_id, '_talk_recording_url', true);
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('glass-card talk-card'); ?>>
    <?php if (has_post_thumbnail()) : ?>
        <div class="talk-card-thumb">
            <a href="<?php the_permalink(); ?>" aria-label="<?php echo esc_attr(sprintf(__('Watch or view %s talk', 'sarmadgardezi'), get_the_title())); ?>">
                <?php the_post_thumbnail('sarmadgardezi-card', array('loading' => 'lazy')); ?>
            </a>
        </div>
    <?php endif; ?>

    <div class="talk-card-body">
        <div class="talk-card-meta">
            <?php if (!empty($event)) : ?>
                <span class="talk-event"><?php echo esc_html($event); ?></span>
            <?php endif; ?>
            <?php if (!empty($date)) : ?>
                <span class="meta-dot" aria-hidden="true">&bull;</span>
                <time class="talk-date" datetime="<?php echo esc_attr($date); ?>">
                    <?php echo esc_html(date_i18n('M Y', strtotime($date))); ?>
                </time>
            <?php endif; ?>
        </div>

        <h3 class="talk-card-title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h3>

        <div class="talk-card-excerpt">
            <?php the_excerpt(); ?>
        </div>

        <?php if (!empty($location)) : ?>
            <div class="talk-location">
                <span>📍 <?php echo esc_html($location); ?></span>
            </div>
        <?php endif; ?>

        <div class="talk-card-actions">
            <a href="<?php the_permalink(); ?>" class="btn btn-secondary btn-sm">
                <span><?php esc_html_e('Talk Details', 'sarmadgardezi'); ?></span>
                <?php echo sarmadgardezi_get_icon('arrow-right'); ?>
            </a>

            <?php if (!empty($slides_url)) : ?>
                <a href="<?php echo esc_url($slides_url); ?>" target="_blank" rel="noopener noreferrer" class="btn btn-outline btn-sm">
                    <span><?php esc_html_e('Slides', 'sarmadgardezi'); ?></span>
                    <?php echo sarmadgardezi_get_icon('external-link'); ?>
                </a>
            <?php endif; ?>

            <?php if (!empty($recording_url)) : ?>
                <a href="<?php echo esc_url($recording_url); ?>" target="_blank" rel="noopener noreferrer" class="btn btn-outline btn-sm">
                    <span><?php esc_html_e('Video', 'sarmadgardezi'); ?></span>
                    <?php echo sarmadgardezi_get_icon('external-link'); ?>
                </a>
            <?php endif; ?>
        </div>
    </div>
</article>
