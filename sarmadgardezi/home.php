<?php
/**
 * The template for displaying the blog posts index
 *
 * Matches the reference editorial layout (Digital Inspiration style):
 * - Top Ambient Glow + Pink Eyebrow + Bold Title + Subtitle
 * - 2-Column Editorial Intro: Left narrative paragraphs, Right Author Philosophy Quote Card
 * - Category-grouped Editorial Grids:
 *   - Left: Boxed Badge Button (e.g. WHAT'S NEW → / CATEGORY NAME →), Large Lead Post, Excerpt
 *   - Right: 3 Stacked Recent Posts with dividers, titles & excerpts
 * - Full Yoast SEO, Semantic HTML5 & Gutenberg support
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;

get_header();

// Fetch blog page settings / ACF if configured, with high-fidelity defaults
$blog_page_id = get_option('page_for_posts');
$eyebrow_text = 'Tech à la carte';
$page_title   = 'Digital Inspiration';
$page_desc    = 'Trusted tech guides and practical software tools. Helping millions work smarter since 2004.';

$intro_p1 = "Digital Inspiration is your go-to resource for mastering Google apps and modern productivity tools. Created by Google Developer Expert Amit Agarwal, we've been helping millions of users since 2004 with clear, practical guides that turn complex technology into simple solutions.";
$intro_p2 = "Automate your workflow with Google Sheets, streamline your inbox with custom Gmail routines, build powerful no-code workflows, or master the latest tech trends. Our popular Google Apps Script solutions save you time and make you more productive.";

$quote_text     = '"Independent and unbiased. No sponsored content, no paid endorsements, no brand partnerships. Just honest tech guidance you can trust."';
$author_name    = 'Amit Agarwal';
$author_handle  = '@labnol';
$author_title   = 'Founder, Digital Inspiration';
$author_avatar  = 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=120&h=120&fit=crop&crop=faces';

// Support ACF overrides if available
if (function_exists('get_field') && $blog_page_id) {
    $custom_eyebrow = get_field('blog_eyebrow', $blog_page_id);
    if (!empty($custom_eyebrow)) $eyebrow_text = $custom_eyebrow;

    $custom_title = get_field('blog_heading', $blog_page_id);
    if (!empty($custom_title)) $page_title = $custom_title;

    $custom_desc = get_field('blog_subtitle', $blog_page_id);
    if (!empty($custom_desc)) $page_desc = $custom_desc;

    $custom_p1 = get_field('blog_intro_p1', $blog_page_id);
    if (!empty($custom_p1)) $intro_p1 = $custom_p1;

    $custom_p2 = get_field('blog_intro_p2', $blog_page_id);
    if (!empty($custom_p2)) $intro_p2 = $custom_p2;

    $custom_quote = get_field('blog_quote', $blog_page_id);
    if (!empty($custom_quote)) $quote_text = $custom_quote;
}
?>

<main id="main-content" class="site-main site-digital-blog-main">
    
    <!-- Top Ambient Radial Glow -->
    <div class="blog-ambient-glow" aria-hidden="true"></div>

    <div class="site-container digital-blog-container">

        <!-- Top Header & Editorial Intro Block -->
        <header class="digital-blog-hero">
            
            <div class="blog-hero-top">
                <span class="blog-eyebrow-pink"><?php echo esc_html($eyebrow_text); ?></span>
                <h1 class="blog-main-title"><?php echo esc_html($page_title); ?></h1>
                <p class="blog-main-subtitle"><?php echo esc_html($page_desc); ?></p>
            </div>

            <!-- Two-Column Editorial Intro -->
            <div class="blog-editorial-intro-grid">
                
                <!-- Left Column: Narrative paragraphs -->
                <div class="intro-text-col">
                    <p class="intro-paragraph"><?php echo esc_html($intro_p1); ?></p>
                    <p class="intro-paragraph"><?php echo esc_html($intro_p2); ?></p>
                </div>

                <!-- Right Column: Philosophy Quote Card -->
                <div class="intro-quote-col">
                    <div class="philosophy-quote-card">
                        <blockquote class="quote-text">
                            <?php echo esc_html($quote_text); ?>
                        </blockquote>
                        
                        <div class="quote-author-row">
                            <img 
                                src="<?php echo esc_url($author_avatar); ?>" 
                                alt="<?php echo esc_attr($author_name); ?>" 
                                class="quote-avatar-img"
                                width="44"
                                height="44"
                                loading="lazy"
                            />
                            <div class="quote-author-info">
                                <span class="author-name-handle">
                                    <strong><?php echo esc_html($author_name); ?></strong>
                                    <span class="author-handle"><?php echo esc_html($author_handle); ?></span>
                                </span>
                                <span class="author-role"><?php echo esc_html($author_title); ?></span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </header>

        <!-- Divider Line -->
        <hr class="digital-blog-divider" />

        <!-- Editorial Category Sections -->
        <div class="digital-categories-stream">
            
            <?php
            // 1. WHAT'S NEW (Latest 4 Posts across the site)
            $whats_new_query = new WP_Query(array(
                'post_type'           => 'post',
                'post_status'         => 'publish',
                'posts_per_page'      => 4,
                'ignore_sticky_posts' => 1,
            ));

            if ($whats_new_query->have_posts()) :
                $whats_new_posts = $whats_new_query->posts;
                $lead_post = array_shift($whats_new_posts);
            ?>
                <section class="editorial-category-block" aria-label="<?php esc_attr_e("What's New", 'sarmadgardezi'); ?>">
                    <div class="editorial-category-grid">
                        
                        <!-- Left Column: Featured Lead Post -->
                        <div class="category-lead-col">
                            <a href="<?php echo esc_url(get_permalink($blog_page_id ? $blog_page_id : home_url('/blog/'))); ?>" class="retro-category-badge">
                                <?php esc_html_e("WHAT'S NEW", 'sarmadgardezi'); ?> &rarr;
                            </a>

                            <article class="lead-post-article">
                                <h2 class="lead-post-title">
                                    <a href="<?php echo esc_url(get_permalink($lead_post->ID)); ?>">
                                        <?php echo esc_html(get_the_title($lead_post->ID)); ?>
                                    </a>
                                </h2>
                                <p class="lead-post-excerpt">
                                    <?php
                                    $lead_excerpt = get_the_excerpt($lead_post->ID);
                                    if (empty($lead_excerpt)) {
                                        $lead_excerpt = wp_trim_words(strip_shortcodes(get_post_field('post_content', $lead_post->ID)), 28, '...');
                                    }
                                    echo esc_html(wp_strip_all_tags($lead_excerpt));
                                    ?>
                                </p>
                            </article>
                        </div>

                        <!-- Right Column: 3 Stacked Recent Posts -->
                        <div class="category-list-col">
                            <?php if (!empty($whats_new_posts)) : ?>
                                <div class="category-stacked-posts">
                                    <?php foreach ($whats_new_posts as $sub_post) : ?>
                                        <article class="stacked-post-item">
                                            <h3 class="stacked-post-title">
                                                <a href="<?php echo esc_url(get_permalink($sub_post->ID)); ?>">
                                                    <?php echo esc_html(get_the_title($sub_post->ID)); ?>
                                                </a>
                                            </h3>
                                            <p class="stacked-post-excerpt">
                                                <?php
                                                $sub_excerpt = get_the_excerpt($sub_post->ID);
                                                if (empty($sub_excerpt)) {
                                                    $sub_excerpt = wp_trim_words(strip_shortcodes(get_post_field('post_content', $sub_post->ID)), 18, '...');
                                                }
                                                echo esc_html(wp_strip_all_tags($sub_excerpt));
                                                ?>
                                            </p>
                                        </article>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>

                    </div>
                </section>

                <hr class="digital-blog-divider" />
            <?php 
                wp_reset_postdata();
            endif; 
            ?>

            <?php
            // 2. Query All Active Categories with Posts
            $active_categories = get_categories(array(
                'orderby'    => 'count',
                'order'      => 'DESC',
                'hide_empty' => true,
            ));

            if (!empty($active_categories)) :
                foreach ($active_categories as $cat) :
                    $cat_query = new WP_Query(array(
                        'post_type'           => 'post',
                        'post_status'         => 'publish',
                        'cat'                 => $cat->term_id,
                        'posts_per_page'      => 4,
                        'ignore_sticky_posts' => 1,
                    ));

                    if ($cat_query->have_posts()) :
                        $cat_posts = $cat_query->posts;
                        $cat_lead  = array_shift($cat_posts);
                    ?>
                        <section class="editorial-category-block" aria-label="<?php echo esc_attr($cat->name); ?>">
                            <div class="editorial-category-grid">
                                
                                <!-- Left Column: Category Badge + Lead Post -->
                                <div class="category-lead-col">
                                    <a href="<?php echo esc_url(get_category_link($cat->term_id)); ?>" class="retro-category-badge">
                                        <?php echo esc_html(strtoupper($cat->name)); ?> &rarr;
                                    </a>

                                    <article class="lead-post-article">
                                        <h2 class="lead-post-title">
                                            <a href="<?php echo esc_url(get_permalink($cat_lead->ID)); ?>">
                                                <?php echo esc_html(get_the_title($cat_lead->ID)); ?>
                                            </a>
                                        </h2>
                                        <p class="lead-post-excerpt">
                                            <?php
                                            $cat_lead_excerpt = get_the_excerpt($cat_lead->ID);
                                            if (empty($cat_lead_excerpt)) {
                                                $cat_lead_excerpt = wp_trim_words(strip_shortcodes(get_post_field('post_content', $cat_lead->ID)), 28, '...');
                                            }
                                            echo esc_html(wp_strip_all_tags($cat_lead_excerpt));
                                            ?>
                                        </p>
                                    </article>
                                </div>

                                <!-- Right Column: Up to 3 Stacked Category Posts -->
                                <div class="category-list-col">
                                    <?php if (!empty($cat_posts)) : ?>
                                        <div class="category-stacked-posts">
                                            <?php foreach ($cat_posts as $cat_sub_post) : ?>
                                                <article class="stacked-post-item">
                                                    <h3 class="stacked-post-title">
                                                        <a href="<?php echo esc_url(get_permalink($cat_sub_post->ID)); ?>">
                                                            <?php echo esc_html(get_the_title($cat_sub_post->ID)); ?>
                                                        </a>
                                                    </h3>
                                                    <p class="stacked-post-excerpt">
                                                        <?php
                                                        $sub_cat_excerpt = get_the_excerpt($cat_sub_post->ID);
                                                        if (empty($sub_cat_excerpt)) {
                                                            $sub_cat_excerpt = wp_trim_words(strip_shortcodes(get_post_field('post_content', $cat_sub_post->ID)), 18, '...');
                                                        }
                                                        echo esc_html(wp_strip_all_tags($sub_cat_excerpt));
                                                        ?>
                                                    </p>
                                                </article>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>

                            </div>
                        </section>

                        <hr class="digital-blog-divider" />
                    <?php
                        wp_reset_postdata();
                    endif;
                endforeach;
            endif;
            ?>

        </div>

    </div>
</main>

<?php
get_footer();
