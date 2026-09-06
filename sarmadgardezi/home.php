<?php
/**
 * The template for displaying the blog posts index
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="main-content" class="site-main site-blog-main">
    <div class="site-container">
        <?php get_template_part('template-parts/global/breadcrumbs'); ?>

        <header class="page-header blog-index-header">
            <span class="section-tag"><?php esc_html_e('Engineering & Cloud Insights', 'sarmadgardezi'); ?></span>
            <h1 class="page-title">
                <?php
                $blog_title = get_the_title(get_option('page_for_posts'));
                echo esc_html(!empty($blog_title) ? $blog_title : __('Blog & Articles', 'sarmadgardezi'));
                ?>
            </h1>
            <p class="page-description">
                <?php esc_html_e('Articles on full-stack architecture, Google AI, Firebase, Next.js, and modern cloud engineering by Sarmad Gardezi.', 'sarmadgardezi'); ?>
            </p>
        </header>

        <?php
        $categories = get_categories(array('hide_empty' => true));
        if (!empty($categories)) :
        ?>
            <nav class="category-filter-nav" aria-label="<?php esc_attr_e('Filter by topic', 'sarmadgardezi'); ?>">
                <ul class="category-filter-list">
                    <li>
                        <a href="<?php echo esc_url(home_url('/blog/')); ?>" class="filter-chip active">
                            <?php esc_html_e('All Posts', 'sarmadgardezi'); ?>
                        </a>
                    </li>
                    <?php foreach ($categories as $cat) : ?>
                        <li>
                            <a href="<?php echo esc_url(get_category_link($cat->term_id)); ?>" class="filter-chip">
                                <?php echo esc_html($cat->name); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </nav>
        <?php endif; ?>

        <?php if (have_posts()) : ?>
            <div class="posts-grid blog-grid">
                <?php
                while (have_posts()) :
                    the_post();
                    get_template_part('template-parts/blog/post-card');
                endwhile;
                ?>
            </div>

            <?php get_template_part('template-parts/global/pagination'); ?>

        <?php else : ?>
            <div class="no-posts-found glass-card">
                <h2><?php esc_html_e('No articles published yet', 'sarmadgardezi'); ?></h2>
                <p><?php esc_html_e('Check back soon for new articles and tutorials.', 'sarmadgardezi'); ?></p>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php
get_footer();
