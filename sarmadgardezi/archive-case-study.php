<?php
/**
 * The template for displaying the Case Studies archive catalog
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="main-content" class="site-main site-case-studies-main">
    <div class="site-container">
        <?php get_template_part('template-parts/global/breadcrumbs'); ?>

        <header class="page-header case-studies-header" style="text-align: center; margin-bottom: 3rem;">
            <h1 class="page-title" style="font-size: clamp(3rem, 6vw, 5rem); font-weight: 800; text-transform: uppercase; letter-spacing: -0.02em; margin-bottom: 1rem;"><?php esc_html_e('OUR CASE STUDIES', 'sarmadgardezi'); ?></h1>
            <p class="page-description" style="max-width: 800px; margin: 0 auto; font-size: 1.125rem; color: var(--text-secondary, #666);">
                <?php esc_html_e('See how focused strategies translate into clear, data-backed success for our clients, growth and consistent performance over time.', 'sarmadgardezi'); ?>
            </p>
        </header>

        <?php if (have_posts()) : ?>
            <div class="case-studies-grid">
                <?php
                while (have_posts()) :
                    the_post();
                    get_template_part('template-parts/case-studies/card');
                endwhile;
                ?>
            </div>

            <?php get_template_part('template-parts/global/pagination'); ?>

        <?php else : ?>
            <div class="no-posts-found glass-card">
                <h2><?php esc_html_e('No case studies published yet', 'sarmadgardezi'); ?></h2>
                <p><?php esc_html_e('In-depth case studies are currently being prepared.', 'sarmadgardezi'); ?></p>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php
get_footer();
