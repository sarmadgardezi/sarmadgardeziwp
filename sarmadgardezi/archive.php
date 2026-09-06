<?php
/**
 * The template for displaying general archive pages
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="main-content" class="site-main site-archive-main">
    <div class="site-container">
        <?php get_template_part('template-parts/global/breadcrumbs'); ?>

        <header class="page-header archive-header">
            <span class="section-tag"><?php esc_html_e('Archive', 'sarmadgardezi'); ?></span>
            <?php the_archive_title('<h1 class="page-title">', '</h1>'); ?>
            <?php the_archive_description('<div class="page-description">', '</div>'); ?>
        </header>

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
                <h2><?php esc_html_e('No articles found in this archive', 'sarmadgardezi'); ?></h2>
                <p><?php esc_html_e('Explore our other categories or search for specific topics.', 'sarmadgardezi'); ?></p>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php
get_footer();
