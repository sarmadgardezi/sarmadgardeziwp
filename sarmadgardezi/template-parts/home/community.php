<?php
/**
 * Template part for displaying the homepage community & open source section
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;
?>

<section id="community" class="home-section community-section">
    <div class="site-container">
        <div class="section-header">
            <span class="section-subtitle"><?php esc_html_e('Open Source & Ecosystem', 'sarmadgardezi'); ?></span>
            <h2 class="section-title"><?php esc_html_e('Giving Back to the Developer Community', 'sarmadgardezi'); ?></h2>
        </div>

        <div class="community-grid">
            <div class="glass-card community-card">
                <div class="community-icon">
                    <?php echo sarmadgardezi_get_icon('github'); ?>
                </div>
                <h3 class="community-title"><?php esc_html_e('Open Source Contributions', 'sarmadgardezi'); ?></h3>
                <p class="community-desc">
                    <?php esc_html_e('Maintaining and contributing to open-source libraries, WordPress tooling, and developer productivity CLI utilities.', 'sarmadgardezi'); ?>
                </p>
                <a href="https://github.com/sarmadgardezi" target="_blank" rel="noopener noreferrer" class="link-arrow">
                    <span><?php esc_html_e('Follow on GitHub', 'sarmadgardezi'); ?></span>
                    <?php echo sarmadgardezi_get_icon('arrow-right'); ?>
                </a>
            </div>

            <div class="glass-card community-card">
                <div class="community-icon">
                    <?php echo sarmadgardezi_get_icon('terminal'); ?>
                </div>
                <h3 class="community-title"><?php esc_html_e('Mentorship & Architecture Reviews', 'sarmadgardezi'); ?></h3>
                <p class="community-desc">
                    <?php esc_html_e('Advising engineering teams on modern codebase migrations, performance bottlenecks, and automated testing strategies.', 'sarmadgardezi'); ?>
                </p>
                <a href="#contact" class="link-arrow">
                    <span><?php esc_html_e('Book a Strategy Call', 'sarmadgardezi'); ?></span>
                    <?php echo sarmadgardezi_get_icon('arrow-right'); ?>
                </a>
            </div>
        </div>
    </div>
</section>
