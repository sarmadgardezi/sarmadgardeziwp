<?php
/**
 * Template part for displaying a post card
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('glass-card post-card'); ?>>
    <?php if (has_post_thumbnail()) : ?>
        <div class="post-card-thumb">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail('sarmadgardezi-card'); ?>
            </a>
        </div>
    <?php endif; ?>

    <div class="post-card-body">
        <div class="post-card-meta">
            <span class="post-date"><?php echo esc_html(get_the_date('M j, Y')); ?></span>
            <span class="meta-dot">&bull;</span>
            <span class="post-read-time"><?php echo esc_html(sarmadgardezi_reading_time(get_the_ID())); ?></span>
        </div>

        <h3 class="post-card-title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h3>

        <div class="post-card-excerpt">
            <?php the_excerpt(); ?>
        </div>

        <a href="<?php the_permalink(); ?>" class="post-card-link">
            <span><?php esc_html_e('Read Article', 'sarmadgardezi'); ?></span>
            <?php echo sarmadgardezi_get_icon('arrow-right'); ?>
        </a>
    </div>
</article>
