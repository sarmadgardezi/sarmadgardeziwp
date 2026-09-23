<?php
/**
 * The template for displaying the front page
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="main-content" class="site-main site-home-main">
    <?php // get_template_part('template-parts/home/hero'); ?>
    <?php get_template_part('template-parts/home/hero-v2'); ?>
    <?php get_template_part('template-parts/home/reels'); ?>
    <?php get_template_part('template-parts/home/brands'); ?>
    <?php get_template_part('template-parts/home/problem'); ?>
    <?php get_template_part('template-parts/home/mission'); ?>
    <?php get_template_part('template-parts/home/featured-projects'); ?>
    <?php get_template_part('template-parts/home/about'); ?>
</main>

<?php
get_footer();
