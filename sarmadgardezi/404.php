<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="main-content" class="site-main site-error-main">
    <div class="site-container">
        <section class="error-404 not-found glass-card">
            <div class="error-code-badge">404</div>
            <header class="page-header">
                <h1 class="page-title"><?php esc_html_e('Oops! That page can’t be found.', 'sarmadgardezi'); ?></h1>
            </header>

            <div class="page-content">
                <p>
                    <?php esc_html_e('The route you are looking for might have been moved, renamed, or is temporarily unavailable. Try searching the website or explore the core sections below.', 'sarmadgardezi'); ?>
                </p>

                <div class="error-search-form">
                    <?php get_search_form(); ?>
                </div>

                <div class="error-navigation-links">
                    <span class="links-title"><?php esc_html_e('Helpful Links:', 'sarmadgardezi'); ?></span>
                    <div class="links-row">
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="filter-chip"><?php esc_html_e('Homepage', 'sarmadgardezi'); ?></a>
                        <a href="<?php echo esc_url(home_url('/about/')); ?>" class="filter-chip"><?php esc_html_e('About Sarmad', 'sarmadgardezi'); ?></a>
                        <a href="<?php echo esc_url(home_url('/projects/')); ?>" class="filter-chip"><?php esc_html_e('Projects', 'sarmadgardezi'); ?></a>
                        <a href="<?php echo esc_url(home_url('/talks/')); ?>" class="filter-chip"><?php esc_html_e('Talks', 'sarmadgardezi'); ?></a>
                        <a href="<?php echo esc_url(home_url('/blog/')); ?>" class="filter-chip"><?php esc_html_e('Blog', 'sarmadgardezi'); ?></a>
                        <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="filter-chip"><?php esc_html_e('Contact', 'sarmadgardezi'); ?></a>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>

<?php
get_footer();
