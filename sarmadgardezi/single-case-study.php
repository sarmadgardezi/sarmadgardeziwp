<?php
/**
 * The template for displaying a single case study
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="main-content" class="site-main site-single-case-main">
    <div class="site-container">
        <?php get_template_part('template-parts/global/breadcrumbs'); ?>

        <?php
        while (have_posts()) :
            the_post();
            $post_id  = get_the_ID();
            $client   = function_exists('sarmad_get_field') ? sarmad_get_field('case_client', $post_id) : get_post_meta($post_id, '_case_client', true);
            $timeline = function_exists('sarmad_get_field') ? sarmad_get_field('case_timeline', $post_id) : get_post_meta($post_id, '_case_timeline', true);
            $m1_val   = function_exists('sarmad_get_field') ? sarmad_get_field('case_metric_1_val', $post_id) : get_post_meta($post_id, '_case_metric_1_val', true);
            $m1_lbl   = function_exists('sarmad_get_field') ? sarmad_get_field('case_metric_1_lbl', $post_id) : get_post_meta($post_id, '_case_metric_1_lbl', true);
            $m2_val   = function_exists('sarmad_get_field') ? sarmad_get_field('case_metric_2_val', $post_id) : get_post_meta($post_id, '_case_metric_2_val', true);
            $m2_lbl   = function_exists('sarmad_get_field') ? sarmad_get_field('case_metric_2_lbl', $post_id) : get_post_meta($post_id, '_case_metric_2_lbl', true);
            $m3_val   = function_exists('sarmad_get_field') ? sarmad_get_field('case_metric_3_val', $post_id) : get_post_meta($post_id, '_case_metric_3_val', true);
            $m3_lbl   = function_exists('sarmad_get_field') ? sarmad_get_field('case_metric_3_lbl', $post_id) : get_post_meta($post_id, '_case_metric_3_lbl', true);
        ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('single-case-article'); ?>>
                <header class="case-header">
                    <span class="section-tag"><?php esc_html_e('Architectural Transformation', 'sarmadgardezi'); ?></span>
                    <h1 class="case-title"><?php the_title(); ?></h1>

                    <div class="case-meta-bar glass-card">
                        <?php if (!empty($client)) : ?>
                            <div class="meta-item">
                                <span class="meta-label"><?php esc_html_e('Client', 'sarmadgardezi'); ?></span>
                                <span class="meta-value"><?php echo esc_html($client); ?></span>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($timeline)) : ?>
                            <div class="meta-item">
                                <span class="meta-label"><?php esc_html_e('Timeline', 'sarmadgardezi'); ?></span>
                                <span class="meta-value"><?php echo esc_html($timeline); ?></span>
                            </div>
                        <?php endif; ?>
                    </div>

                    <?php if (!empty($m1_val) || !empty($m2_val) || !empty($m3_val)) : ?>
                        <div class="case-metrics-grid">
                            <?php if (!empty($m1_val)) : ?>
                                <div class="case-metric-card glass-card">
                                    <span class="metric-number"><?php echo esc_html($m1_val); ?></span>
                                    <span class="metric-description"><?php echo esc_html($m1_lbl); ?></span>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($m2_val)) : ?>
                                <div class="case-metric-card glass-card">
                                    <span class="metric-number"><?php echo esc_html($m2_val); ?></span>
                                    <span class="metric-description"><?php echo esc_html($m2_lbl); ?></span>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($m3_val)) : ?>
                                <div class="case-metric-card glass-card">
                                    <span class="metric-number"><?php echo esc_html($m3_val); ?></span>
                                    <span class="metric-description"><?php echo esc_html($m3_lbl); ?></span>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </header>

                <?php if (has_post_thumbnail()) : ?>
                    <figure class="case-featured-visual">
                        <?php the_post_thumbnail('full', array('loading' => 'eager', 'fetchpriority' => 'high')); ?>
                    </figure>
                <?php endif; ?>

                <div class="case-content entry-content prose">
                    <?php the_content(); ?>
                </div>

                <footer class="case-footer">
                    <nav class="article-navigation" aria-label="<?php esc_attr_e('Adjacent case studies', 'sarmadgardezi'); ?>">
                        <div class="nav-links">
                            <?php
                            $prev_case = get_previous_post();
                            if ($prev_case) :
                            ?>
                                <a href="<?php echo esc_url(get_permalink($prev_case->ID)); ?>" class="nav-previous glass-card">
                                    <span class="nav-subtitle">&larr; <?php esc_html_e('Previous Case Study', 'sarmadgardezi'); ?></span>
                                    <span class="nav-title"><?php echo esc_html(get_the_title($prev_case->ID)); ?></span>
                                </a>
                            <?php endif; ?>

                            <?php
                            $next_case = get_next_post();
                            if ($next_case) :
                            ?>
                                <a href="<?php echo esc_url(get_permalink($next_case->ID)); ?>" class="nav-next glass-card">
                                    <span class="nav-subtitle"><?php esc_html_e('Next Case Study', 'sarmadgardezi'); ?> &rarr;</span>
                                    <span class="nav-title"><?php echo esc_html(get_the_title($next_case->ID)); ?></span>
                                </a>
                            <?php endif; ?>
                        </div>
                    </nav>

                    <div class="case-cta glass-card">
                        <h3><?php esc_html_e('Want results like this for your system?', 'sarmadgardezi'); ?></h3>
                        <p><?php esc_html_e('I help engineering organizations design resilient distributed systems and achieve scalable software velocity.', 'sarmadgardezi'); ?></p>
                        <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn-primary">
                            <span><?php esc_html_e('Initiate Consultation', 'sarmadgardezi'); ?></span>
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
