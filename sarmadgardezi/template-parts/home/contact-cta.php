<?php
/**
 * Template part for displaying the homepage contact CTA section
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;
?>

<section id="contact" class="home-section contact-section">
    <div class="site-container">
        <div class="glass-card contact-card">
            <div class="contact-card-content">
                <span class="section-subtitle"><?php esc_html_e("Let's Build Something Great", 'sarmadgardezi'); ?></span>
                <h2 class="contact-title"><?php esc_html_e('Have an Ambitious Project or Architectural Challenge?', 'sarmadgardezi'); ?></h2>
                <p class="contact-desc">
                    <?php esc_html_e('I am always open to discussing new contracts, technical advisory roles, or speaking engagements. Drop me a note and let’s connect.', 'sarmadgardezi'); ?>
                </p>

                <div class="contact-actions">
                    <a href="mailto:contact@sarmadgardezi.com" class="btn btn-primary btn-lg">
                        <span><?php esc_html_e('Email: contact@sarmadgardezi.com', 'sarmadgardezi'); ?></span>
                        <?php echo sarmadgardezi_get_icon('mail', 'btn-icon'); ?>
                    </a>
                    <a href="https://linkedin.com/in/sarmadgardezi" target="_blank" rel="noopener noreferrer" class="btn btn-secondary btn-lg">
                        <span><?php esc_html_e('Connect on LinkedIn', 'sarmadgardezi'); ?></span>
                        <?php echo sarmadgardezi_get_icon('external-link', 'btn-icon'); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
