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
        <?php
        get_template_part('template-parts/global/page-header', null, array(
            'title'       => __('OUR CASE STUDIES', 'sarmadgardezi'),
            'description' => __('See how focused strategies translate into clear, data-backed success for our clients, growth and consistent performance over time.', 'sarmadgardezi')
        ));
        ?>

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
