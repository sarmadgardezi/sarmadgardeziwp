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
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@graph": [
            {
                "@type": "Person",
                "@id": "<?php echo esc_url(home_url('/#person')); ?>",
                "name": "Sarmad Gardezi",
                "jobTitle": "Fractional CTO & AI Product Engineer",
                "description": "Fractional CTO and AI Product Engineer helping startups build and ship scalable software products.",
                "url": "<?php echo esc_url(home_url('/')); ?>",
                "email": "mailto:sarmad@sarmadgardezi.com",
                "address": {
                    "@type": "PostalAddress",
                    "addressLocality": "Islamabad",
                    "addressCountry": "PK"
                },
                "sameAs": [
                    "https://www.linkedin.com/in/sarmadgardezi/",
                    "https://github.com/sarmadgardezi",
                    "https://cobuild.digital"
                ],
                "knowsAbout": [
                    "Fractional CTO",
                    "Product Engineering",
                    "MVP Development",
                    "SaaS",
                    "TypeScript",
                    "React",
                    "Next.js",
                    "AI",
                    "Agentic Workflows"
                ]
            }
        ]
    }
    </script>

    <?php get_template_part('template-parts/home/hero-v2'); ?>
    <?php get_template_part('template-parts/home/brands'); ?>
    <?php get_template_part('template-parts/home/company'); ?>
    <?php get_template_part('template-parts/home/events'); ?>
    <?php get_template_part('template-parts/home/contact-cta'); ?>
</main>

<?php
get_footer();

