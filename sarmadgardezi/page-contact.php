<?php
/**
 * Template Name: Contact & Booking
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="main-content" class="site-main site-contact-main">
    <div class="site-container" style="max-width: 980px; margin: 0 auto; padding: clamp(2.5rem, 5vw, 4rem) 1.5rem clamp(4rem, 8vw, 6rem);">
        
        <header class="contact-page-header" style="text-align: center; margin-bottom: clamp(2rem, 4vw, 3rem);">
            <h1 class="contact-page-title" style="font-family: 'Wotfard', sans-serif; font-size: clamp(2.25rem, 5vw, 3.25rem); font-weight: 700; color: #111827; letter-spacing: -0.03em; margin: 0 0 0.75rem 0;">
                <?php esc_html_e('Schedule a Meeting', 'sarmadgardezi'); ?>
            </h1>
            <p class="contact-page-subtitle" style="font-family: 'Wotfard', sans-serif; font-size: clamp(1rem, 1.8vw, 1.15rem); color: #71717a; max-width: 580px; margin: 0 auto; line-height: 1.55;">
                <?php esc_html_e('Select a convenient time slot below for a 30m product sparring session via Google Meet.', 'sarmadgardezi'); ?>
            </p>
        </header>

        <!-- Cal.com Interactive Booking Widget -->
        <div class="booking-widget-wrapper">
            <?php get_template_part('template-parts/contact/booking-widget'); ?>
        </div>

    </div>
</main>

<?php
get_footer();
