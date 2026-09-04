<?php
/**
 * The template for displaying the dynamic front page
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="primary" class="site-main site-home-main">
    <?php
    // Hero Section
    get_template_part('template-parts/home/hero');

    // About Summary Section
    get_template_part('template-parts/home/about');

    // Expertise & Skills Matrix Section
    get_template_part('template-parts/home/expertise');

    // Featured Projects Section
    get_template_part('template-parts/home/featured-projects');

    // Case Studies Showcase Section
    get_template_part('template-parts/home/case-studies');

    // Latest Insights / Blog Section
    get_template_part('template-parts/home/latest-posts');

    // Open Source & Community Section
    get_template_part('template-parts/home/community');

    // Contact Call to Action Section
    get_template_part('template-parts/home/contact-cta');
    ?>
</main>

<?php
get_footer();
