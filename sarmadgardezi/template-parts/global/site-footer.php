<?php
/**
 * Template part for displaying the site footer
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;
?>

<footer id="colophon" class="site-footer">
    <div class="site-container">
        <div class="footer-grid">
            <div class="footer-col footer-brand">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="brand-link">
                    <span class="brand-dot"></span>
                    <span class="brand-name"><?php bloginfo('name'); ?></span>
                </a>
                <p class="footer-bio">
                    <?php esc_html_e('Software Engineer & Web Architect crafting high-performance digital experiences, bespoke WordPress ecosystems, and cloud-native solutions.', 'sarmadgardezi'); ?>
                </p>
                <?php get_template_part('template-parts/global/social-links'); ?>
            </div>

            <div class="footer-col footer-nav">
                <h3 class="footer-heading"><?php esc_html_e('Navigation', 'sarmadgardezi'); ?></h3>
                <?php
                if (has_nav_menu('footer')) :
                    wp_nav_menu(array(
                        'theme_location' => 'footer',
                        'menu_class'     => 'footer-links',
                        'container'      => false,
                        'depth'          => 1,
                    ));
                else :
                    ?>
                    <ul class="footer-links">
                        <li><a href="<?php echo esc_url(home_url('/#about')); ?>"><?php esc_html_e('About', 'sarmadgardezi'); ?></a></li>
                        <li><a href="<?php echo esc_url(home_url('/#expertise')); ?>"><?php esc_html_e('Expertise', 'sarmadgardezi'); ?></a></li>
                        <li><a href="<?php echo esc_url(home_url('/#projects')); ?>"><?php esc_html_e('Featured Projects', 'sarmadgardezi'); ?></a></li>
                        <li><a href="<?php echo esc_url(home_url('/#case-studies')); ?>"><?php esc_html_e('Case Studies', 'sarmadgardezi'); ?></a></li>
                        <li><a href="<?php echo esc_url(home_url('/#contact')); ?>"><?php esc_html_e('Contact', 'sarmadgardezi'); ?></a></li>
                    </ul>
                <?php endif; ?>
            </div>

            <div class="footer-col footer-status">
                <h3 class="footer-heading"><?php esc_html_e('Availability', 'sarmadgardezi'); ?></h3>
                <div class="status-indicator">
                    <span class="status-pulse"></span>
                    <span class="status-text"><?php esc_html_e('Available for new ventures & consulting', 'sarmadgardezi'); ?></span>
                </div>
                <p class="footer-contact-prompt">
                    <?php esc_html_e('Have a project in mind or want to collaborate? Get in touch today.', 'sarmadgardezi'); ?>
                </p>
                <a href="<?php echo esc_url(home_url('/#contact')); ?>" class="btn btn-secondary btn-sm">
                    <?php esc_html_e('Start a Conversation', 'sarmadgardezi'); ?>
                </a>
            </div>
        </div><!-- .footer-grid -->

        <div class="footer-bottom">
            <p class="copyright">
                &copy; <?php echo esc_html(date_i18n('Y')); ?> <?php bloginfo('name'); ?>. <?php esc_html_e('All rights reserved.', 'sarmadgardezi'); ?>
            </p>
            <p class="built-with">
                <?php esc_html_e('Engineered with precision & clean code.', 'sarmadgardezi'); ?>
            </p>
        </div>
    </div><!-- .site-container -->
</footer><!-- #colophon -->
