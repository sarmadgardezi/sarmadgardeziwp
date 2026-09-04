<?php
/**
 * The template for displaying the front page
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="primary" class="site-main site-home-main">
    <?php get_template_part('template-parts/home/hero'); ?>
</main>

<?php
get_footer();
