<?php
/**
 * Template part for displaying the homepage hero section
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;
?>

<section id="hero" class="home-section hero-section">
    <div class="hero-glow-bg"></div>
    <div class="site-container hero-container">
        <div class="hero-content">
            <div class="hero-badge">
                <span class="badge-dot"></span>
                <span class="badge-text"><?php esc_html_e('Software Engineer & Web Architect', 'sarmadgardezi'); ?></span>
            </div>

            <h1 class="hero-title">
                <?php esc_html_e('Building Scalable Systems &', 'sarmadgardezi'); ?>
                <span class="gradient-text"><?php esc_html_e('Exceptional Digital Products', 'sarmadgardezi'); ?></span>
            </h1>

            <p class="hero-description">
                <?php esc_html_e('Hi, I’m Sarmad Gardezi. I specialize in crafting high-impact web architectures, enterprise WordPress ecosystems, and intuitive interactive user experiences.', 'sarmadgardezi'); ?>
            </p>

            <div class="hero-actions">
                <a href="#projects" class="btn btn-primary btn-lg">
                    <span><?php esc_html_e('Explore Featured Work', 'sarmadgardezi'); ?></span>
                    <?php echo sarmadgardezi_get_icon('arrow-right', 'btn-icon'); ?>
                </a>
                <a href="#contact" class="btn btn-secondary btn-lg">
                    <?php esc_html_e('Get In Touch', 'sarmadgardezi'); ?>
                </a>
            </div>

            <div class="hero-metrics">
                <div class="metric-item">
                    <span class="metric-number">10+</span>
                    <span class="metric-label"><?php esc_html_e('Years Experience', 'sarmadgardezi'); ?></span>
                </div>
                <div class="metric-divider"></div>
                <div class="metric-item">
                    <span class="metric-number">100+</span>
                    <span class="metric-label"><?php esc_html_e('Projects Shipped', 'sarmadgardezi'); ?></span>
                </div>
                <div class="metric-divider"></div>
                <div class="metric-item">
                    <span class="metric-number">99.9%</span>
                    <span class="metric-label"><?php esc_html_e('Performance Focus', 'sarmadgardezi'); ?></span>
                </div>
            </div>
        </div><!-- .hero-content -->

        <div class="hero-visual">
            <div class="code-terminal-card">
                <div class="terminal-header">
                    <div class="terminal-dots">
                        <span class="dot dot-red"></span>
                        <span class="dot dot-yellow"></span>
                        <span class="dot dot-green"></span>
                    </div>
                    <span class="terminal-title">sarmad-gardezi.config.ts</span>
                </div>
                <div class="terminal-body">
                    <pre><code><span class="token-keyword">const</span> architect = {
  <span class="token-prop">name</span>: <span class="token-string">'Sarmad Gardezi'</span>,
  <span class="token-prop">role</span>: <span class="token-string">'Lead Full-Stack Architect'</span>,
  <span class="token-prop">skills</span>: [<span class="token-string">'WordPress Core'</span>, <span class="token-string">'PHP 8+'</span>, <span class="token-string">'TypeScript'</span>, <span class="token-string">'React'</span>, <span class="token-string">'Cloud Architecture'</span>],
  <span class="token-prop">passion</span>: <span class="token-string">'Crafting resilient & elegant software'</span>,
  <span class="token-prop">status</span>: <span class="token-string">'Open to collaboration'</span>
};</code></pre>
                </div>
            </div>
        </div><!-- .hero-visual -->
    </div><!-- .hero-container -->
</section>
