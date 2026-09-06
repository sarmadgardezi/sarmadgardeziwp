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
    <?php get_template_part('template-parts/home/hero'); ?>
    <?php get_template_part('template-parts/home/brands'); ?>
</main>

<?php
get_footer();
