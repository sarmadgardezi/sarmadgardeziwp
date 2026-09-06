<?php
/**
 * The template for displaying search results pages
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="main-content" class="site-main site-search-main">
    <div class="site-container">
        <?php get_template_part('template-parts/global/breadcrumbs'); ?>

        <header class="page-header search-header">
            <span class="section-tag"><?php esc_html_e('Search Results', 'sarmadgardezi'); ?></span>
            <h1 class="page-title">
                <?php
                /* translators: %s: search query. */
                printf(esc_html__('Search Results for: %s', 'sarmadgardezi'), '<span class="highlight">' . esc_html(get_search_query()) . '</span>');
                ?>
            </h1>
            <p class="page-description">
                <?php
                global $wp_query;
                /* translators: %d: number of results. */
                printf(esc_html(_n('%d result discovered', '%d results discovered', $wp_query->found_posts, 'sarmadgardezi')), (int) $wp_query->found_posts);
                ?>
            </p>
            <div class="search-page-bar">
                <?php get_search_form(); ?>
            </div>
        </header>

        <?php if (have_posts()) : ?>
            <div class="posts-grid search-grid">
                <?php
                while (have_posts()) :
                    the_post();
                    if ('project' === get_post_type()) {
                        get_template_part('template-parts/projects/card');
                    } elseif ('talk' === get_post_type()) {
                        get_template_part('template-parts/talks/card');
                    } elseif ('case-study' === get_post_type()) {
                        get_template_part('template-parts/case-studies/card');
                    } else {
                        get_template_part('template-parts/blog/post-card');
                    }
                endwhile;
                ?>
            </div>

            <?php get_template_part('template-parts/global/pagination'); ?>

        <?php else : ?>
            <div class="no-results not-found glass-card">
                <h2><?php esc_html_e('No matching results found', 'sarmadgardezi'); ?></h2>
                <p><?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords or browse the topics below.', 'sarmadgardezi'); ?></p>
                
                <div class="quick-links">
                    <a href="<?php echo esc_url(home_url('/projects/')); ?>" class="filter-chip"><?php esc_html_e('Browse Projects', 'sarmadgardezi'); ?></a>
                    <a href="<?php echo esc_url(home_url('/talks/')); ?>" class="filter-chip"><?php esc_html_e('Explore Talks', 'sarmadgardezi'); ?></a>
                    <a href="<?php echo esc_url(home_url('/blog/')); ?>" class="filter-chip"><?php esc_html_e('Read Blog', 'sarmadgardezi'); ?></a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php
get_footer();
