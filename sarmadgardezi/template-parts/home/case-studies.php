<?php
/**
 * Template part for displaying the homepage case studies section
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;

// Query custom post type 'case-study' if registered, or provide initial fallback data.
$case_studies_query = new WP_Query(array(
    'post_type'      => 'case-study',
    'posts_per_page' => 2,
    'post_status'    => 'publish',
));
?>

<section id="case-studies" class="home-section case-studies-section">
    <div class="site-container">
        <div class="section-header-flex">
            <div>
                <span class="section-subtitle"><?php esc_html_e('Deep Dives', 'sarmadgardezi'); ?></span>
                <h2 class="section-title"><?php esc_html_e('Architectural Case Studies', 'sarmadgardezi'); ?></h2>
            </div>
            <a href="<?php echo esc_url(get_post_type_archive_link('case-study') ?: '#'); ?>" class="link-arrow">
                <span><?php esc_html_e('Explore All Case Studies', 'sarmadgardezi'); ?></span>
                <?php echo sarmadgardezi_get_icon('arrow-right'); ?>
            </a>
        </div>

        <div class="case-studies-grid">
            <?php
            if ($case_studies_query->have_posts()) :
                while ($case_studies_query->have_posts()) :
                    $case_studies_query->the_post();
                    ?>
                    <article class="glass-card case-study-card">
                        <div class="case-study-content">
                            <span class="case-study-label"><?php esc_html_e('Case Study', 'sarmadgardezi'); ?></span>
                            <h3 class="case-study-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <div class="case-study-excerpt"><?php the_excerpt(); ?></div>
                            <a href="<?php the_permalink(); ?>" class="btn btn-sm btn-ghost">
                                <span><?php esc_html_e('Read Full Analysis', 'sarmadgardezi'); ?></span>
                                <?php echo sarmadgardezi_get_icon('arrow-right'); ?>
                            </a>
                        </div>
                    </article>
                    <?php
                endwhile;
                wp_reset_postdata();
            else :
                // Default demonstration case studies
                $default_studies = array(
                    array(
                        'client'  => __('FinTech Platform Migration', 'sarmadgardezi'),
                        'title'   => __('Refactoring Legacy Monolith to Micro-Frontends', 'sarmadgardezi'),
                        'summary' => __('Redesigned the multi-tenant architecture, reducing response latency by 64% and streamlining continuous integration.', 'sarmadgardezi'),
                        'metrics' => array(
                            array('value' => '-64%', 'label' => __('Latency', 'sarmadgardezi')),
                            array('value' => '99.99%', 'label' => __('Uptime', 'sarmadgardezi')),
                            array('value' => '3.5x', 'label' => __('Velocity', 'sarmadgardezi')),
                        ),
                    ),
                    array(
                        'client'  => __('Global Media Publisher', 'sarmadgardezi'),
                        'title'   => __('Core Web Vitals Optimization for 10M+ Monthly Readers', 'sarmadgardezi'),
                        'summary' => __('Engineered bespoke asset chunking, server-side caching, and dynamic critical CSS generation across 50,000+ indexed URLs.', 'sarmadgardezi'),
                        'metrics' => array(
                            array('value' => '98/100', 'label' => __('PageSpeed', 'sarmadgardezi')),
                            array('value' => '0.8s', 'label' => __('LCP Score', 'sarmadgardezi')),
                            array('value' => '+28%', 'label' => __('Ad Revenue', 'sarmadgardezi')),
                        ),
                    ),
                );

                foreach ($default_studies as $study) :
                    ?>
                    <article class="glass-card case-study-card">
                        <div class="case-study-content">
                            <span class="case-study-label"><?php echo esc_html($study['client']); ?></span>
                            <h3 class="case-study-title"><?php echo esc_html($study['title']); ?></h3>
                            <p class="case-study-desc"><?php echo esc_html($study['summary']); ?></p>

                            <div class="case-study-metrics">
                                <?php foreach ($study['metrics'] as $metric) : ?>
                                    <div class="metric-pill">
                                        <span class="metric-val"><?php echo esc_html($metric['value']); ?></span>
                                        <span class="metric-lbl"><?php echo esc_html($metric['label']); ?></span>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </article>
                    <?php
                endforeach;
            endif;
            ?>
        </div>
    </div>
</section>
