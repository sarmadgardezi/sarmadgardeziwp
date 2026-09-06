<?php
/**
 * The template for displaying a single talk
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="main-content" class="site-main site-single-talk-main">
    <div class="site-container">
        <?php get_template_part('template-parts/global/breadcrumbs'); ?>

        <?php
        while (have_posts()) :
            the_post();
            $post_id       = get_the_ID();
            $event         = function_exists('sarmad_get_field') ? sarmad_get_field('talk_event', $post_id) : get_post_meta($post_id, '_talk_event', true);
            $date          = function_exists('sarmad_get_field') ? sarmad_get_field('talk_date', $post_id) : get_post_meta($post_id, '_talk_date', true);
            $location      = function_exists('sarmad_get_field') ? sarmad_get_field('talk_location', $post_id) : get_post_meta($post_id, '_talk_location', true);
            $slides_url    = function_exists('sarmad_get_field') ? sarmad_get_field('talk_slides_url', $post_id) : get_post_meta($post_id, '_talk_slides_url', true);
            $recording_url = function_exists('sarmad_get_field') ? sarmad_get_field('talk_recording_url', $post_id) : get_post_meta($post_id, '_talk_recording_url', true);
        ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('single-talk-article'); ?>>
                <header class="talk-header">
                    <span class="section-tag"><?php esc_html_e('Tech Talk & Workshop', 'sarmadgardezi'); ?></span>
                    <h1 class="talk-title"><?php the_title(); ?></h1>

                    <div class="talk-meta-bar glass-card">
                        <?php if (!empty($event)) : ?>
                            <div class="meta-item">
                                <span class="meta-label"><?php esc_html_e('Event', 'sarmadgardezi'); ?></span>
                                <span class="meta-value"><?php echo esc_html($event); ?></span>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($date)) : ?>
                            <div class="meta-item">
                                <span class="meta-label"><?php esc_html_e('Date', 'sarmadgardezi'); ?></span>
                                <span class="meta-value">
                                    <time datetime="<?php echo esc_attr($date); ?>">
                                        <?php echo esc_html(date_i18n(get_option('date_format'), strtotime($date))); ?>
                                    </time>
                                </span>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($location)) : ?>
                            <div class="meta-item">
                                <span class="meta-label"><?php esc_html_e('Location', 'sarmadgardezi'); ?></span>
                                <span class="meta-value"><?php echo esc_html($location); ?></span>
                            </div>
                        <?php endif; ?>

                        <div class="meta-item meta-actions">
                            <?php if (!empty($slides_url)) : ?>
                                <a href="<?php echo esc_url($slides_url); ?>" target="_blank" rel="noopener noreferrer" class="btn btn-primary btn-sm">
                                    <span><?php esc_html_e('View Slides', 'sarmadgardezi'); ?></span>
                                    <?php echo sarmadgardezi_get_icon('external-link'); ?>
                                </a>
                            <?php endif; ?>

                            <?php if (!empty($recording_url)) : ?>
                                <a href="<?php echo esc_url($recording_url); ?>" target="_blank" rel="noopener noreferrer" class="btn btn-outline btn-sm">
                                    <span><?php esc_html_e('Watch Recording', 'sarmadgardezi'); ?></span>
                                    <?php echo sarmadgardezi_get_icon('external-link'); ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </header>

                <?php if (!empty($recording_url) && (strpos($recording_url, 'youtube.com') !== false || strpos($recording_url, 'youtu.be') !== false)) : ?>
                    <div class="talk-video-embed glass-card">
                        <?php
                        echo wp_oembed_get($recording_url, array('width' => 1024, 'height' => 576));
                        ?>
                    </div>
                <?php elseif (has_post_thumbnail()) : ?>
                    <figure class="talk-featured-visual">
                        <?php the_post_thumbnail('full', array('loading' => 'eager', 'fetchpriority' => 'high')); ?>
                    </figure>
                <?php endif; ?>

                <div class="talk-content entry-content prose">
                    <?php the_content(); ?>
                </div>

                <footer class="talk-footer">
                    <nav class="article-navigation" aria-label="<?php esc_attr_e('Adjacent talks', 'sarmadgardezi'); ?>">
                        <div class="nav-links">
                            <?php
                            $prev_talk = get_previous_post();
                            if ($prev_talk) :
                            ?>
                                <a href="<?php echo esc_url(get_permalink($prev_talk->ID)); ?>" class="nav-previous glass-card">
                                    <span class="nav-subtitle">&larr; <?php esc_html_e('Previous Talk', 'sarmadgardezi'); ?></span>
                                    <span class="nav-title"><?php echo esc_html(get_the_title($prev_talk->ID)); ?></span>
                                </a>
                            <?php endif; ?>

                            <?php
                            $next_talk = get_next_post();
                            if ($next_talk) :
                            ?>
                                <a href="<?php echo esc_url(get_permalink($next_talk->ID)); ?>" class="nav-next glass-card">
                                    <span class="nav-subtitle"><?php esc_html_e('Next Talk', 'sarmadgardezi'); ?> &rarr;</span>
                                    <span class="nav-title"><?php echo esc_html(get_the_title($next_talk->ID)); ?></span>
                                </a>
                            <?php endif; ?>
                        </div>
                    </nav>

                    <div class="talk-invite-cta glass-card">
                        <h3><?php esc_html_e('Interested in having me speak at your event?', 'sarmadgardezi'); ?></h3>
                        <p><?php esc_html_e('I regularly speak on Google AI Studio, cloud architectures, Firebase, and modern full-stack web engineering.', 'sarmadgardezi'); ?></p>
                        <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn-primary">
                            <span><?php esc_html_e('Invite for a Talk', 'sarmadgardezi'); ?></span>
                            <?php echo sarmadgardezi_get_icon('arrow-right'); ?>
                        </a>
                    </div>
                </footer>
            </article>
        <?php endwhile; ?>
    </div>
</main>

<?php
get_footer();
