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
    <?php get_template_part('template-parts/home/brands'); ?>
    <?php get_template_part('template-parts/home/events'); ?>
    <?php get_template_part('template-parts/home/about'); ?>
    <?php get_template_part('template-parts/home/contact-cta'); ?>
    <?php /* Removed for now per request:
    get_template_part('template-parts/home/reels');
    get_template_part('template-parts/home/problem');
    get_template_part('template-parts/home/mission');
    get_template_part('template-parts/home/featured-projects');
    */ ?>
</main>

<?php
get_footer();
