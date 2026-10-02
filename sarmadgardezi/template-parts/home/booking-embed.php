<?php
/**
 * Template part for displaying the Cal.com inline booking embed section
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;

// Booking Cal URL
$cal_link = 'sarmadgardezi/chat';
if (function_exists('get_field')) {
    $acf_cal = get_field('cal_com_link');
    if (!empty($acf_cal)) {
        $cal_link = $acf_cal;
    }
}
?>

<section id="booking-cal-section" class="booking-cal-section" aria-label="<?php esc_attr_e('Book a Call', 'sarmadgardezi'); ?>">
    <div class="site-container booking-cal-container">
        <div class="reveal booking-cal-wrapper" style="--stagger:23">
            <div class="cal-inline-container">
                <iframe 
                    class="cal-embed" 
                    name="cal-embed=chat" 
                    title="<?php esc_attr_e('Book a call', 'sarmadgardezi'); ?>" 
                    allow="payment" 
                    data-effective-cal-link="<?php echo esc_attr($cal_link); ?>" 
                    src="https://app.cal.com/<?php echo esc_attr($cal_link); ?>/embed?layout=month_view&amp;theme=light&amp;embedType=inline&amp;embed=chat" 
                    style="height: 580px; width: 100%; border: 0; border-radius: 16px; background-color: #ffffff;">
                </iframe>
            </div>
        </div>
    </div>
</section>
