<?php
/**
 * Template part for displaying the homepage latest posts section
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;

$latest_posts = new WP_Query(array(
    'posts_per_page'      => 3,
    'post_status'         => 'publish',
    'ignore_sticky_posts' => 1,
));
?>

<section id="posts" class="home-section posts-section">
    <div class="site-container">
        <div class="section-header-flex">
            <div>
                <span class="section-subtitle"><?php esc_html_e('Thoughts & Insights', 'sarmadgardezi'); ?></span>
                <h2 class="section-title"><?php esc_html_e('Latest Engineering Articles', 'sarmadgardezi'); ?></h2>
            </div>
            <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts')) ?: home_url('/blog')); ?>" class="link-arrow">
                <span><?php esc_html_e('Read All Articles', 'sarmadgardezi'); ?></span>
                <?php echo sarmadgardezi_get_icon('arrow-right'); ?>
            </a>
        </div>

        <div class="posts-grid">
            <?php
            if ($latest_posts->have_posts()) :
                while ($latest_posts->have_posts()) :
                    $latest_posts->the_post();
                    get_template_part('template-parts/blog/post-card');
                endwhile;
                wp_reset_postdata();
            else :
                // Default demonstration articles
                $dummy_articles = array(
                    array(
                        'title' => __('Mastering WordPress Block Themes & theme.json Architecture', 'sarmadgardezi'),
                        'desc'  => __('A comprehensive guide on taking full control of modern full-site editing tokens, typography, and palettes.', 'sarmadgardezi'),
                        'date'  => __('Aug 28, 2026', 'sarmadgardezi'),
                    ),
                    array(
                        'title' => __('Scaling Custom REST Endpoints in High-Traffic Environments', 'sarmadgardezi'),
                        'desc'  => __('Strategies for transient caching, Redis object cache layers, and optimal SQL serialization.', 'sarmadgardezi'),
                        'date'  => __('Aug 14, 2026', 'sarmadgardezi'),
                    ),
                    array(
                        'title' => __('The 2026 Modern Sass 7-1 Guide for Scalable Front-Ends', 'sarmadgardezi'),
                        'desc'  => __('Structuring modular CSS architectures that remain clean, maintainable, and blistering fast.', 'sarmadgardezi'),
                        'date'  => __('Jul 30, 2026', 'sarmadgardezi'),
                    ),
                );

                foreach ($dummy_articles as $art) :
                    ?>
                    <article class="glass-card post-card">
                        <div class="post-card-body">
                            <div class="post-card-meta">
                                <span class="post-date"><?php echo esc_html($art['date']); ?></span>
                                <span class="meta-dot">&bull;</span>
                                <span class="post-read-time"><?php esc_html_e('5 min read', 'sarmadgardezi'); ?></span>
                            </div>
                            <h3 class="post-card-title"><?php echo esc_html($art['title']); ?></h3>
                            <p class="post-card-excerpt"><?php echo esc_html($art['desc']); ?></p>
                            <span class="post-card-link">
                                <span><?php esc_html_e('Read Article', 'sarmadgardezi'); ?></span>
                                <?php echo sarmadgardezi_get_icon('arrow-right'); ?>
                            </span>
                        </div>
                    </article>
                    <?php
                endforeach;
            endif;
            ?>
        </div>
    </div>
</section>
