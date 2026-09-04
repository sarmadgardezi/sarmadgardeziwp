<?php
/**
 * Template part for displaying the homepage about section
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;
?>

<section id="about" class="home-section about-section">
    <div class="site-container">
        <div class="section-header">
            <span class="section-subtitle"><?php esc_html_e('Background & Philosophy', 'sarmadgardezi'); ?></span>
            <h2 class="section-title"><?php esc_html_e('Engineering Clean Code & Meaningful Results', 'sarmadgardezi'); ?></h2>
        </div>

        <div class="about-grid">
            <div class="about-text">
                <p class="lead-paragraph">
                    <?php esc_html_e('With over a decade in software development and full-stack architecture, I bridge the gap between complex engineering systems and seamless user interfaces.', 'sarmadgardezi'); ?>
                </p>
                <p>
                    <?php esc_html_e('Whether building custom WordPress enterprise ecosystems, headless architectures, or high-throughput cloud APIs, my focus is always on maintainability, speed, and business longevity.', 'sarmadgardezi'); ?>
                </p>
                <div class="about-highlights">
                    <div class="highlight-item">
                        <span class="highlight-icon">&#10003;</span>
                        <span><?php esc_html_e('Clean, modular architecture aligned with modern standards', 'sarmadgardezi'); ?></span>
                    </div>
                    <div class="highlight-item">
                        <span class="highlight-icon">&#10003;</span>
                        <span><?php esc_html_e('Enterprise security hardening & performance optimization', 'sarmadgardezi'); ?></span>
                    </div>
                    <div class="highlight-item">
                        <span class="highlight-icon">&#10003;</span>
                        <span><?php esc_html_e('Intuitive editorial workflows and headless integration', 'sarmadgardezi'); ?></span>
                    </div>
                </div>
            </div>

            <div class="about-cards">
                <div class="glass-card about-stat-card">
                    <span class="card-badge"><?php esc_html_e('Focus', 'sarmadgardezi'); ?></span>
                    <h3 class="card-title"><?php esc_html_e('Scalability & Speed', 'sarmadgardezi'); ?></h3>
                    <p class="card-desc"><?php esc_html_e('Sub-second load times, lightweight DOM footprints, and optimal database queries.', 'sarmadgardezi'); ?></p>
                </div>
                <div class="glass-card about-stat-card">
                    <span class="card-badge"><?php esc_html_e('Craft', 'sarmadgardezi'); ?></span>
                    <h3 class="card-title"><?php esc_html_e('Custom Solutions', 'sarmadgardezi'); ?></h3>
                    <p class="card-desc"><?php esc_html_e('Zero reliance on bloated page-builders; built ground-up for maximum control.', 'sarmadgardezi'); ?></p>
                </div>
            </div>
        </div>
    </div>
</section>
