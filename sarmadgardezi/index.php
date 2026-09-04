<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="primary" class="site-main site-fallback-main">
    <div class="site-container">
        <?php if (have_posts()) : ?>
            <header class="page-header">
                <h1 class="page-title">
                    <?php
                    if (is_home() && !is_front_page()) {
                        single_post_title();
                    } else {
                        esc_html_e('Latest Updates', 'sarmadgardezi');
                    }
                    ?>
                </h1>
            </header>

            <div class="posts-grid">
                <?php
                while (have_posts()) :
                    the_post();
                    get_template_part('template-parts/blog/post-card');
                endwhile;
                ?>
            </div>

            <?php
            the_posts_navigation(array(
                'prev_text' => '&larr; ' . esc_html__('Older Posts', 'sarmadgardezi'),
                'next_text' => esc_html__('Newer Posts', 'sarmadgardezi') . ' &rarr;',
            ));
            ?>

        <?php else : ?>
            <section class="no-results not-found">
                <header class="page-header">
                    <h1 class="page-title"><?php esc_html_e('Nothing Found', 'sarmadgardezi'); ?></h1>
                </header>
                <div class="page-content">
                    <p><?php esc_html_e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'sarmadgardezi'); ?></p>
                    <?php get_search_form(); ?>
                </div>
            </section>
        <?php endif; ?>
    </div>
</main>

<?php
get_footer();