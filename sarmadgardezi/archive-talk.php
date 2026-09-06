<?php
/**
 * The template for displaying the Talks archive catalog
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="main-content" class="site-main site-talks-main">
    <div class="site-container">
        <?php get_template_part('template-parts/global/breadcrumbs'); ?>

        <header class="page-header talks-header">
            <span class="section-tag"><?php esc_html_e('Speaking & Workshops', 'sarmadgardezi'); ?></span>
            <h1 class="page-title"><?php esc_html_e('Tech Talks & Presentations', 'sarmadgardezi'); ?></h1>
            <p class="page-description">
                <?php esc_html_e('Sessions delivered at Google Developer Groups, tech conferences, university seminars, and developer workshops.', 'sarmadgardezi'); ?>
            </p>
        </header>

        <?php if (have_posts()) : ?>
            <div class="talks-grid">
                <?php
                while (have_posts()) :
                    the_post();
                    get_template_part('template-parts/talks/card');
                endwhile;
                ?>
            </div>

            <?php get_template_part('template-parts/global/pagination'); ?>

        <?php else : ?>
            <div class="no-posts-found glass-card">
                <h2><?php esc_html_e('No talks published yet', 'sarmadgardezi'); ?></h2>
                <p><?php esc_html_e('Upcoming session details will be published here.', 'sarmadgardezi'); ?></p>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php
get_footer();
