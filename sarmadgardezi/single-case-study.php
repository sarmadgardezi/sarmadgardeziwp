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
        <div style="text-align: center;">
            <?php get_template_part('template-parts/global/breadcrumbs'); ?>
        </div>

        <?php
        while (have_posts()) :
            the_post();
            $post_id  = get_the_ID();
            
            $hero_subtitle = function_exists('sarmad_get_field') ? sarmad_get_field('case_hero_subtitle', $post_id) : get_post_meta($post_id, '_case_hero_subtitle', true);
            $category  = function_exists('sarmad_get_field') ? sarmad_get_field('case_category', $post_id) : get_post_meta($post_id, '_case_category', true);
            $platforms = function_exists('sarmad_get_field') ? sarmad_get_field('case_platforms', $post_id) : get_post_meta($post_id, '_case_platforms', true);
            $timeline  = function_exists('sarmad_get_field') ? sarmad_get_field('case_timeline', $post_id) : get_post_meta($post_id, '_case_timeline', true);
            $focus     = function_exists('sarmad_get_field') ? sarmad_get_field('case_focus', $post_id) : get_post_meta($post_id, '_case_focus', true);
            
            $m1_val    = function_exists('sarmad_get_field') ? sarmad_get_field('case_metric_1_val', $post_id) : get_post_meta($post_id, '_case_metric_1_val', true);
            $m1_lbl    = function_exists('sarmad_get_field') ? sarmad_get_field('case_metric_1_lbl', $post_id) : get_post_meta($post_id, '_case_metric_1_lbl', true);
            $m2_val    = function_exists('sarmad_get_field') ? sarmad_get_field('case_metric_2_val', $post_id) : get_post_meta($post_id, '_case_metric_2_val', true);
            $m2_lbl    = function_exists('sarmad_get_field') ? sarmad_get_field('case_metric_2_lbl', $post_id) : get_post_meta($post_id, '_case_metric_2_lbl', true);
            $m3_val    = function_exists('sarmad_get_field') ? sarmad_get_field('case_metric_3_val', $post_id) : get_post_meta($post_id, '_case_metric_3_val', true);
            $m3_lbl    = function_exists('sarmad_get_field') ? sarmad_get_field('case_metric_3_lbl', $post_id) : get_post_meta($post_id, '_case_metric_3_lbl', true);
            
            $t_text    = function_exists('sarmad_get_field') ? sarmad_get_field('case_testimonial_text', $post_id) : get_post_meta($post_id, '_case_testimonial_text', true);
            $t_name    = function_exists('sarmad_get_field') ? sarmad_get_field('case_testimonial_name', $post_id) : get_post_meta($post_id, '_case_testimonial_name', true);
            $t_title   = function_exists('sarmad_get_field') ? sarmad_get_field('case_testimonial_title', $post_id) : get_post_meta($post_id, '_case_testimonial_title', true);
            $t_avatar  = function_exists('sarmad_get_field') ? sarmad_get_field('case_testimonial_avatar_url', $post_id) : get_post_meta($post_id, '_case_testimonial_avatar_url', true);
        ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('single-case-article'); ?>>
                <header class="case-header">
                    <h1 class="case-title"><?php the_title(); ?></h1>
                    <?php if (!empty($hero_subtitle)) : ?>
                        <p class="case-subtitle"><?php echo esc_html($hero_subtitle); ?></p>
                    <?php endif; ?>

                    <div class="case-meta-cards">
                        <?php if (!empty($category)) : ?>
                            <div class="meta-card">
                                <span class="meta-label"><?php esc_html_e('Category', 'sarmadgardezi'); ?></span>
                                <span class="meta-value"><?php echo esc_html($category); ?></span>
                            </div>
                        <?php endif; ?>
                        
                        <?php if (!empty($platforms)) : ?>
                            <div class="meta-card">
                                <span class="meta-label"><?php esc_html_e('Platforms', 'sarmadgardezi'); ?></span>
                                <span class="meta-value">
                                    <?php
                                    $platforms_array = array_map('trim', explode(',', $platforms));
                                    foreach ($platforms_array as $platform) {
                                        echo '<span class="platform-tag">' . esc_html($platform) . '</span>';
                                    }
                                    ?>
                                </span>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($timeline)) : ?>
                            <div class="meta-card">
                                <span class="meta-label"><?php esc_html_e('Timeline', 'sarmadgardezi'); ?></span>
                                <span class="meta-value"><?php echo esc_html($timeline); ?></span>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($focus)) : ?>
                            <div class="meta-card">
                                <span class="meta-label"><?php esc_html_e('Key focus', 'sarmadgardezi'); ?></span>
                                <span class="meta-value"><?php echo esc_html($focus); ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                </header>

                <?php 
                $cover_image = function_exists('sarmad_get_field') ? sarmad_get_field('case_cover_image', $post_id) : get_post_meta($post_id, '_case_cover_image', true);
                if (!empty($cover_image)) : ?>
                    <figure class="case-featured-visual">
                        <img src="<?php echo esc_url($cover_image); ?>" alt="<?php the_title_attribute(); ?>" loading="eager" fetchpriority="high" />
                    </figure>
                <?php elseif (has_post_thumbnail()) : ?>
                    <figure class="case-featured-visual">
                        <?php the_post_thumbnail('full', array('loading' => 'eager', 'fetchpriority' => 'high')); ?>
                    </figure>
                <?php endif; ?>

                <div class="case-content-wrapper">
                    <div class="case-content entry-content prose">
                        <?php the_content(); ?>
                    </div>

                    <?php if (!empty($m1_val) || !empty($m2_val) || !empty($m3_val)) : ?>
                        <div class="case-results-cards">
                            <?php if (!empty($m1_val)) : ?>
                                <div class="result-card style-pink">
                                    <span class="result-label"><?php echo esc_html($m1_lbl); ?></span>
                                    <span class="result-value"><?php echo esc_html($m1_val); ?></span>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($m2_val)) : ?>
                                <div class="result-card style-blue">
                                    <span class="result-label"><?php echo esc_html($m2_lbl); ?></span>
                                    <span class="result-value"><?php echo esc_html($m2_val); ?></span>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($m3_val)) : ?>
                                <div class="result-card style-yellow">
                                    <span class="result-label"><?php echo esc_html($m3_lbl); ?></span>
                                    <span class="result-value"><?php echo esc_html($m3_val); ?></span>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($t_text)) : ?>
                        <div class="case-testimonial-block">
                            <p class="testimonial-text"><?php echo esc_html($t_text); ?></p>
                            
                            <?php if (!empty($t_name) || !empty($t_avatar)) : ?>
                                <div class="testimonial-author">
                                    <?php if (!empty($t_avatar)) : ?>
                                        <img src="<?php echo esc_url($t_avatar); ?>" alt="<?php echo esc_attr($t_name); ?>" class="author-avatar" />
                                    <?php endif; ?>
                                    <div class="author-details">
                                        <?php if (!empty($t_name)) : ?>
                                            <span class="author-name"><?php echo esc_html($t_name); ?></span>
                                        <?php endif; ?>
                                        <?php if (!empty($t_title)) : ?>
                                            <span class="author-title"><?php echo esc_html($t_title); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>

            </article>
        <?php endwhile; ?>
    </div>
    
    <div class="related-cases-section">
        <div class="site-container">
            <div class="related-cases-header">
                <h2><?php esc_html_e('CHECK OTHER CASES', 'sarmadgardezi'); ?></h2>
                <a href="<?php echo esc_url(get_post_type_archive_link('case-study')); ?>" class="btn-dark-pill">
                    <span class="icon-arrow-right">&rarr;</span> <?php esc_html_e('All case studies', 'sarmadgardezi'); ?>
                </a>
            </div>

            <div class="case-studies-grid">
                <?php
                $related_cases = new WP_Query(array(
                    'post_type'      => 'case-study',
                    'posts_per_page' => 2,
                    'post__not_in'   => array(get_the_ID()),
                    'orderby'        => 'rand'
                ));

                if ($related_cases->have_posts()) :
                    while ($related_cases->have_posts()) :
                        $related_cases->the_post();
                        get_template_part('template-parts/case-studies/card');
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>
        </div>
    </div>
</main>

<?php
get_footer();
