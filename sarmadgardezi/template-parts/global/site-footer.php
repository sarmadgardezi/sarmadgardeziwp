<?php
/**
 * Template part for displaying the Minimalist Dark Footer matching the reference design
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;

$nav_items = sarmadgardezi_get_nav_items();
?>

<footer id="colophon" class="site-footer">
    <div class="site-container footer-inner-container">
        
        <!-- Top Section (2 Columns: Brand & Socials on Left, Scroll-Top & Nav on Right) -->
        <div class="footer-top-grid">
            
            <!-- Left Column: Brand, Tagline, and Social Icons -->
            <div class="footer-info-col">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="footer-brand" rel="home">
                    <span class="footer-brand-title"><?php echo esc_html(get_bloginfo('name')); ?></span>
                </a>

                <p class="footer-brand-desc">
                    <?php esc_html_e('Senior Software Engineer & AI Architect building high-performance cloud architectures, scalable SaaS solutions, and intelligent agentic workflows.', 'sarmadgardezi'); ?>
                </p>

                <!-- Social Icons Row -->
                <div class="footer-social-icons">
                    <a href="https://linkedin.com/in/sarmadgardezi" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn" class="footer-social-link">
                        <svg width="19" height="19" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14m-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-.85 0-1.84.52-2.28 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 0 1 1.4 1.4v4.93h2.75M6.46 10.9v7.6h2.76v-7.6H6.46M7.84 6.2a1.6 1.6 0 0 0-1.6 1.6 1.6 1.6 0 0 0 1.6 1.6 1.6 1.6 0 0 0 1.6-1.6 1.6 1.6 0 0 0-1.6-1.6Z"/>
                        </svg>
                    </a>
                    <a href="https://github.com/sarmadgardezi" target="_blank" rel="noopener noreferrer" aria-label="GitHub" class="footer-social-link">
                        <svg width="19" height="19" viewBox="0 0 24 24" fill="currentColor">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.53 1.032 1.53 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"/>
                        </svg>
                    </a>
                    <a href="https://instagram.com/sarmadgardezi" target="_blank" rel="noopener noreferrer" aria-label="Instagram" class="footer-social-link">
                        <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                            <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                        </svg>
                    </a>
                    <a href="https://facebook.com/sarmadgardezi" target="_blank" rel="noopener noreferrer" aria-label="Facebook" class="footer-social-link">
                        <svg width="19" height="19" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                    </a>
                    <a href="https://twitter.com/sarmadgardezi" target="_blank" rel="noopener noreferrer" aria-label="X (Twitter)" class="footer-social-link">
                        <svg width="17" height="17" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Right Column: Scroll-Top Button, Nav Links, Legal Links -->
            <div class="footer-nav-col">
                
                <!-- Scroll to Top Circular Button -->
                <button id="footer-scroll-top-btn" class="footer-scroll-top" aria-label="<?php esc_attr_e('Scroll to top', 'sarmadgardezi'); ?>">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="19" x2="12" y2="5"></line>
                        <polyline points="5 12 12 5 19 12"></polyline>
                    </svg>
                </button>

                <!-- Primary Navigation Links -->
                <nav class="footer-primary-nav" aria-label="<?php esc_attr_e('Footer Navigation', 'sarmadgardezi'); ?>">
                    <ul class="footer-primary-nav-list">
                        <?php foreach ($nav_items as $item) : ?>
                            <li>
                                <a href="<?php echo esc_url($item['url']); ?>" target="<?php echo esc_attr($item['target']); ?>">
                                    <?php echo esc_html($item['title']); ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </nav>

                <!-- Secondary Legal Links -->
                <div class="footer-secondary-nav">
                    <a href="<?php echo esc_url(home_url('/privacy')); ?>"><?php esc_html_e('Privacy Policy', 'sarmadgardezi'); ?></a>
                    <a href="<?php echo esc_url(home_url('/terms')); ?>"><?php esc_html_e('Terms Of Services', 'sarmadgardezi'); ?></a>
                    <a href="<?php echo esc_url(home_url('/cookie-settings')); ?>"><?php esc_html_e('Cookie Settings', 'sarmadgardezi'); ?></a>
                </div>

            </div>

        </div>

        <!-- Full Width Subtle Divider -->
        <div class="footer-divider" aria-hidden="true"></div>

        <!-- Bottom Centered Copyright Line -->
        <div class="footer-copyright-wrap">
            <p class="footer-copyright-text">
                &copy;<?php echo esc_html(date_i18n('Y')); ?> &middot; <?php esc_html_e('All Right Reserved', 'sarmadgardezi'); ?> &middot; <?php echo esc_html(get_bloginfo('name')); ?>
            </p>
        </div>

    </div>
</footer>
