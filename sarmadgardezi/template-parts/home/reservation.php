<?php
/**
 * Template part for displaying the Cal.com Reservation & Booking Section on Homepage
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;

$section_title    = 'Schedule a Chat';
$section_subtitle = 'Select a date and time slot below for a 30m product sparring session via Google Meet.';

if (function_exists('get_field')) {
    $acf_title = get_field('reservation_section_title');
    $acf_sub   = get_field('reservation_section_subtitle');
    if (!empty($acf_title)) $section_title = $acf_title;
    if (!empty($acf_sub))   $section_subtitle = $acf_sub;
}
?>

<section id="reservation" class="home-reservation-section" aria-label="<?php echo esc_attr($section_title); ?>">
    <div class="site-container home-reservation-container">
        
        <!-- Section Header -->
        <div class="home-reservation-header">
            <h2 class="home-reservation-title">
                <?php echo esc_html($section_title); ?>
            </h2>
            <p class="home-reservation-subtitle">
                <?php echo esc_html($section_subtitle); ?>
            </p>
        </div>

        <!-- Interactive Cal.com Booker Frame -->
        <div class="home-reservation-widget-wrap">
            <?php get_template_part('template-parts/contact/booking-widget'); ?>
        </div>

    </div>
</section>
