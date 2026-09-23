<?php
/**
 * The template for displaying all static pages
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="main-content" class="site-main site-page-main">
    <div class="site-container">
        <?php
        while (have_posts()) :
            the_post();
            
            $show_hero = function_exists('sarmad_get_field') ? sarmad_get_field('page_show_hero') : get_post_meta(get_the_ID(), '_page_show_hero', true);
            // Default to true if not set
            if ($show_hero === '' || $show_hero === false) {
                $show_hero = '1';
            }
        ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('page-article'); ?>>
                <?php 
                if ($show_hero === '1') {
                    get_template_part('template-parts/global/page-header'); 
                }
                ?>

                <?php if (has_post_thumbnail()) : ?>
                    <div class="page-featured-image">
                        <?php the_post_thumbnail('full', array('loading' => 'eager', 'fetchpriority' => 'high')); ?>
                    </div>
                <?php endif; ?>

                <div class="page-content entry-content prose">
                    <?php
                    the_content();

                    wp_link_pages(array(
                        'before' => '<div class="page-links">' . esc_html__('Pages:', 'sarmadgardezi'),
                        'after'  => '</div>',
                    ));
                    ?>
                </div>
            </article>
        <?php endwhile; ?>
    </div>
</main>

<?php
get_footer();
