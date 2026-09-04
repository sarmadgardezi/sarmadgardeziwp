<?php
/**
 * Template part for displaying the homepage expertise section
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;

$skills = array(
    array(
        'title' => __('Custom WordPress Development', 'sarmadgardezi'),
        'desc'  => __('Besposke themes, plugins, REST API integrations, and block editor custom extensions without bloat.', 'sarmadgardezi'),
        'tags'  => array('PHP 8+', 'Custom Gutenberg', 'REST API', 'ACF Pro', 'WP-CLI')
    ),
    array(
        'title' => __('Modern Front-End Engineering', 'sarmadgardezi'),
        'desc'  => __('Interactive, high-fidelity interfaces engineered with modern CSS/Sass, TypeScript, and modern JS.', 'sarmadgardezi'),
        'tags'  => array('JavaScript / ESNext', 'TypeScript', 'SCSS / PostCSS', 'React', 'Vite')
    ),
    array(
        'title' => __('Performance & Core Web Vitals', 'sarmadgardezi'),
        'desc'  => __('Micro-optimizations yielding 95+ PageSpeed scores, asset minification, and database query tuning.', 'sarmadgardezi'),
        'tags'  => array('Core Web Vitals', 'Caching Layers', 'Asset Pipelines', 'Redis', 'CDNs')
    ),
    array(
        'title' => __('Architecture & Cloud Solutions', 'sarmadgardezi'),
        'desc'  => __('Resilient serverless and containerized systems ready for horizontal scale and high traffic.', 'sarmadgardezi'),
        'tags'  => array('Docker', 'CI/CD Pipelines', 'AWS / DigitalOcean', 'GitOps', 'Nginx')
    ),
);
?>

<section id="expertise" class="home-section expertise-section">
    <div class="site-container">
        <div class="section-header">
            <span class="section-subtitle"><?php esc_html_e('Core Capabilities', 'sarmadgardezi'); ?></span>
            <h2 class="section-title"><?php esc_html_e('Areas of Expertise & Technical Mastery', 'sarmadgardezi'); ?></h2>
        </div>

        <div class="expertise-grid">
            <?php foreach ($skills as $skill) : ?>
                <div class="glass-card skill-card">
                    <h3 class="skill-title"><?php echo esc_html($skill['title']); ?></h3>
                    <p class="skill-desc"><?php echo esc_html($skill['desc']); ?></p>
                    <div class="skill-tags">
                        <?php foreach ($skill['tags'] as $tag) : ?>
                            <span class="badge badge-subtle"><?php echo esc_html($tag); ?></span>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
