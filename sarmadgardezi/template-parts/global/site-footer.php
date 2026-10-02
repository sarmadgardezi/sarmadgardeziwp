<?php
/**
 * Template part for displaying the modern minimalist footer matching reference design
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;
?>

<footer id="colophon" class="site-footer">
    <div class="footer-outer-wrap">
        <div class="footer-grid">
            
            <!-- Left Column: Brand, Bio, Socials & Signature -->
            <div class="footer-col-brand">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="footer-brand-title" rel="home">
                    <?php echo esc_html(get_bloginfo('name')); ?>
                </a>
                
                <p class="footer-brand-bio">
                    <?php esc_html_e('Senior Software Engineer & AI Architect making digital experiences faster, smarter, and scalable.', 'sarmadgardezi'); ?>
                </p>

                <div class="footer-social-signature-wrap">
                    <div class="footer-social-row">
                        <!-- GitHub -->
                        <a href="https://github.com/sarmadgardezi" target="_blank" rel="noopener noreferrer" class="footer-social-link" aria-label="GitHub">
                            <svg width="32" height="32" fill="none" viewBox="0 0 24 24">
                                <title>GitHub</title>
                                <path fill="currentColor" d="M12,2A10,10 0 0,0 2,12C2,16.42 4.87,20.17 8.84,21.5C9.34,21.58 9.5,21.27 9.5,21C9.5,20.77 9.5,20.14 9.5,19.31C6.73,19.91 6.14,17.97 6.14,17.97C5.68,16.81 5.03,16.5 5.03,16.5C4.12,15.88 5.1,15.9 5.1,15.9C6.1,15.97 6.63,16.93 6.63,16.93C7.5,18.45 8.97,18 9.54,17.76C9.63,17.11 9.89,16.67 10.17,16.42C7.95,16.17 5.62,15.31 5.62,11.5C5.62,10.39 6,9.5 6.65,8.79C6.55,8.54 6.2,7.5 6.75,6.15C6.75,6.15 7.59,5.88 9.5,7.17C10.29,6.95 11.15,6.84 12,6.84C12.85,6.84 13.71,6.95 14.5,7.17C16.41,5.88 17.25,6.15 17.25,6.15C17.8,7.5 17.45,8.54 17.35,8.79C18,9.5 18.38,10.39 18.38,11.5C18.38,15.32 16.04,16.16 13.81,16.41C14.17,16.72 14.5,17.33 14.5,18.26C14.5,19.6 14.5,20.68 14.5,21C14.5,21.27 14.66,21.59 15.17,21.5C19.14,20.16 22,16.42 22,12A10,10 0 0,0 12,2Z"></path>
                            </svg>
                        </a>
                        
                        <!-- LinkedIn -->
                        <a href="https://linkedin.com/in/sarmadgardezi" target="_blank" rel="noopener noreferrer" class="footer-social-link" aria-label="LinkedIn">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="currentColor">
                                <title>LinkedIn</title>
                                <path d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14m-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-.85 0-1.84.52-2.28 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 0 1 1.4 1.4v4.93h2.75M6.46 10.9v7.6h2.76v-7.6H6.46M7.84 6.2a1.6 1.6 0 0 0-1.6 1.6 1.6 1.6 0 0 0 1.6 1.6 1.6 1.6 0 0 0 1.6-1.6 1.6 1.6 0 0 0-1.6-1.6Z"/>
                            </svg>
                        </a>
                        
                        <!-- X (Twitter) -->
                        <a href="https://x.com/sarmadgardezi" target="_blank" rel="noopener noreferrer" class="footer-social-link" aria-label="X (Twitter)">
                            <svg width="32" height="32" fill="currentColor" viewBox="0 0 24 24">
                                <title>𝕏</title>
                                <path d="M18.901 1.153h3.68l-8.04 9.19L24 22.846h-7.406l-5.8-7.584-6.638 7.584H.474l8.6-9.83L0 1.154h7.594l5.243 6.932ZM17.61 20.644h2.039L6.486 3.24H4.298Z"></path>
                            </svg>
                        </a>
                        
                        <!-- RSS -->
                        <a href="<?php echo esc_url(home_url('/feed')); ?>" target="_blank" rel="noopener noreferrer" class="footer-social-link" aria-label="RSS">
                            <svg width="32" height="32" fill="none" viewBox="0 0 24 24">
                                <title>RSS</title>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M7.33465 15.52C6.23018 15.52 5.33459 16.4153 5.33459 17.5199C5.33459 18.6244 6.23018 19.5201 7.33465 19.5201C8.43912 19.5201 9.33471 18.6244 9.33471 17.5199C9.33471 16.4153 8.43912 15.52 7.33465 15.52Z" fill="currentColor"></path>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M5.33472 10.52V13.0919C8.87972 13.0919 11.7639 15.9753 11.7639 19.5202H14.3347C14.3347 14.5577 10.2973 10.52 5.33472 10.52Z" fill="currentColor"></path>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M5.33472 5.52002V8.18702C11.5846 8.18702 16.6688 13.2701 16.6688 19.52H19.3347C19.3347 11.8001 13.0546 5.52002 5.33472 5.52002Z" fill="currentColor"></path>
                            </svg>
                        </a>
                    </div>

                    <!-- Signature SVG -->
                    <div class="footer-signature-wrap">
                        <svg width="170" height="90" viewBox="0 0 208 110" class="footer-signature-svg" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="m10.7 8.7c-0.4 4.3-2.7 19-5.2 32.7s-4.5 25.7-4.5 26.5c0 2.6 1.6 4.2 3.3 3.5 2.1-0.8 2.2-2.4 0.2-2.4-1.2 0-1.5-0.7-1-3.3 0.3-1.7 1.2-6.8 1.9-11.2 1.1-7 1.5-8 3.2-7.7 10.1 1.7 21.1 1.2 43.4-2.2 28.3-4.2 50-6.9 50.7-6.3 0.2 0.3-0.1 3.3-0.7 6.7s-0.9 6.4-0.6 6.7c1.2 1.3 2.4-1.1 2.9-6.3 0.3-3.1 1-6.1 1.5-6.6 0.6-0.6 9.9-1.8 20.9-2.8 33-3.1 38.7-3.4 38-2.3-0.4 0.6-1.9 1.4-3.4 1.8-1.6 0.3-8 2.6-14.3 5-6.3 2.5-23.2 8.7-37.5 13.9s-33.2 12.2-42 15.6c-28.5 10.9-50.4 19-51.5 19-0.5 0-1 0.4-1 1 0 0.5 0.2 1 0.4 1 1.2 0 28-9.7 60.6-22 20.6-7.8 42.5-15.9 48.5-18 6.1-2.1 13.6-4.8 16.8-6s6-2 6.3-1.8c0.2 0.3-0.5 1.7-1.6 3.1-1.2 1.4-2.7 4.3-3.4 6.4-1.1 3.2-1.7 3.8-4.5 3.9-3.9 0.2-7.1 2.9-7.1 6 0 2.3 2.5 4.4 4.5 3.9 0.6-0.2 2.2-0.6 3.8-0.9 4.2-1 3.2-2.5-1.3-1.9-3.6 0.5-4 0.3-4-1.5 0-2.9 4.4-4 6.9-1.8 1.7 1.5 1.8 1.3 3-3.7 0.6-2.9 2.3-7 3.6-9 1.4-2 2.5-4.2 2.5-5s1.9-1.9 4.3-2.7c2.3-0.6 7.1-2.5 10.7-4.2 5-2.2 6.1-3.1 5-3.8-2.5-1.6-12-1.2-46.6 2-37.5 3.5-49.3 4.9-71.9 8.5-28.1 4.4-43.5 4.3-43.5-0.3 0-2.9 13.9-15.2 26.9-24 10.2-6.9 12.5-8.1 13.8-7 1.2 1 1.8 0.8 3.4-1.2 2.3-3.1 2.4-4 0.1-4-4 0-27.1 15.3-37.3 24.7-3.5 3.3-5.9 4.9-5.9 4 0-0.8 0.9-5.9 2-11.2 2-9.9 2.7-22.5 1.1-22.5-0.4 0-1.1 3.5-1.4 7.7z"></path>
                            <path d="m165.1 40.7c-0.7 1.6-1.6 5.4-1.9 8.6-0.5 5.6-0.6 5.8-2.9 5.2-3.2-0.8-8.6 2.6-11.4 7.1-2.6 4.2-1.5 6.1 2.8 4.9 1.5-0.5 3.3-0.7 3.8-0.6 0.6 0.2 8.2 1.8 17 3.6 26.5 5.5 31.5 6.8 31.5 8 0 1.6-15.1 4-41 6.5-33.2 3.2-75.6 9.8-115.5 18-8.2 1.7-19.2 3.4-24.2 3.7-2.2066 0.132-5.0134 0.952-8.2618-0.36-1.2736-0.678-2.2382-1.25-0.5001-3.327 0.1923-0.577-0.7381-2.1132-2.0381-1.013-2 1.7-1.9 3.3 0.3 5.3 3 2.7 13.2 2.1 35.4-2.2 51.6-10 83.4-14.9 118.3-18.1 12.7-1.2 26.1-2.8 29.9-3.6 6.7-1.3 11.6-3.6 11.6-5.3 0-2.1-17.4-6.7-40.3-10.7-5.3-1-9.6-2.2-9.4-2.8 0.4-1.3 18.2-7.2 27.4-9.1 3.9-0.8 8.6-1.2 10.4-0.8 2.5 0.5 3.1 0.3 2.7-0.8-1-2.9-20.9 0-32 4.6-1.5 0.6-1.8 0.1-1.8-3.2 0-2.1 0.7-6.5 1.5-9.6 1.8-6.8 1.7-6.7 0.7-6.7-0.5 0-1.4 1.2-2.1 2.7zm-3.1 17.3c0 0.5-2 1.9-4.5 3.1s-4.8 2.5-5.1 3c-0.7 1.3-2.4 1.1-2.4-0.2 0-2.2 6.2-6.9 9.1-6.9 1.6 0 2.9 0.4 2.9 1z"></path>
                            <path d="m84.2 49.6c-2.4 1.6-3 5.4-0.9 5.4 2.4 0 10.7-3.2 10.7-4.1 0-1.2-0.1-1.2-4.3 0.6-4.3 1.8-4.7 1.8-4.7 0.5 0-0.6 1.1-1.5 2.5-2s2.5-1.2 2.5-1.5c0-1.1-3.7-0.4-5.8 1.1z"></path>
                            <path d="m27.6 54.4c-2.9 2.5-6.6 4.6-8 4.8-1.5 0.2-2.5 0.7-2.4 1.3 0.5 1.7 7.9 0.5 13.7-2.1 6.5-2.9 7.3-3 8.9-0.4 1.2 2 4.6 2.7 5.6 1.1 0.3-0.5-0.5-1.2-1.8-1.5s-2.6-1.5-2.9-2.7c-0.4-1.6-1.1-1.9-2.6-1.4-1.7 0.5-2.1 0.2-2.1-1.4 0-3.2-2.4-2.5-8.4 2.3zm5.1 0.3c-0.9 0.9-1.9 1.4-2.3 1.1-1-1 0.6-2.8 2.4-2.8 1.5 0 1.5 0.1-0.1 1.7z"></path>
                            <path d="m59.2 52.3c-2.5 2.7-3 7.7-0.8 7.7 0.9 0 1.6-1.2 1.8-2.7 0.2-1.9 1.2-3.2 3.1-4.1 1.5-0.7 2.5-1.7 2.2-2.3-1.1-1.6-4.1-1-6.3 1.4z"></path>
                            <path d="m116.1 57.6c-4.4 3.7-4.1 5.8 0.5 5.1 4.3-0.7 11.7-5.3 10.9-6.7-1.3-2.1-8.3-1.1-11.4 1.6zm6.9 0.2c0 0.9-4.4 3.2-6 3.2-2.3 0-0.7-2 2.3-2.9 1.7-0.5 3.3-1 3.5-1 0.1-0.1 0.2 0.3 0.2 0.7z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Middle Left: Contact & General -->
            <div class="footer-col-nav footer-col-contact">
                <div class="footer-nav-block">
                    <h4 class="footer-nav-heading"><?php esc_html_e('Contact', 'sarmadgardezi'); ?></h4>
                    <ul class="footer-nav-links">
                        <li><a href="mailto:sarmad@sarmadgardezi.com"><?php esc_html_e('Email Sarmad', 'sarmadgardezi'); ?></a></li>
                        <li><a href="<?php echo esc_url(home_url('/contact')); ?>" data-cal-trigger><?php esc_html_e('Call Sarmad', 'sarmadgardezi'); ?></a></li>
                        <li><a href="<?php echo esc_url(home_url('/contact')); ?>"><?php esc_html_e('Office hours', 'sarmadgardezi'); ?></a></li>
                    </ul>
                </div>

                <div class="footer-nav-block footer-nav-block-general">
                    <h4 class="footer-nav-heading"><?php esc_html_e('General', 'sarmadgardezi'); ?></h4>
                    <ul class="footer-nav-links">
                        <li><a href="<?php echo esc_url(home_url('/about')); ?>"><?php esc_html_e('My Mission', 'sarmadgardezi'); ?></a></li>
                        <li><a href="<?php echo esc_url(home_url('/privacy')); ?>"><?php esc_html_e('Privacy policy', 'sarmadgardezi'); ?></a></li>
                        <li><a href="<?php echo esc_url(home_url('/terms')); ?>"><?php esc_html_e('Terms of use', 'sarmadgardezi'); ?></a></li>
                        <li><a href="<?php echo esc_url(home_url('/privacy#conduct')); ?>"><?php esc_html_e('Code of conduct', 'sarmadgardezi'); ?></a></li>
                    </ul>
                </div>
            </div>

            <!-- Middle Right: Sitemap -->
            <div class="footer-col-nav footer-col-sitemap">
                <div class="footer-nav-block">
                    <h4 class="footer-nav-heading"><?php esc_html_e('Sitemap', 'sarmadgardezi'); ?></h4>
                    <ul class="footer-nav-links">
                        <li><a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Home', 'sarmadgardezi'); ?></a></li>
                        <li><a href="<?php echo esc_url(home_url('/blog')); ?>"><?php esc_html_e('Blog', 'sarmadgardezi'); ?></a></li>
                        <li><a href="<?php echo esc_url(home_url('/projects')); ?>"><?php esc_html_e('Projects', 'sarmadgardezi'); ?></a></li>
                        <li><a href="<?php echo esc_url(home_url('/case-study')); ?>"><?php esc_html_e('Case Studies', 'sarmadgardezi'); ?></a></li>
                        <li><a href="<?php echo esc_url(home_url('/events')); ?>"><?php esc_html_e('Talks & Events', 'sarmadgardezi'); ?></a></li>
                        <li><a href="<?php echo esc_url(home_url('/about')); ?>"><?php esc_html_e('About', 'sarmadgardezi'); ?></a></li>
                        <li><a href="<?php echo esc_url(home_url('/contact')); ?>"><?php esc_html_e('Contact', 'sarmadgardezi'); ?></a></li>
                        <li><a href="<?php echo esc_url(home_url('/sitemap.xml')); ?>"><?php esc_html_e('Sitemap.xml', 'sarmadgardezi'); ?></a></li>
                    </ul>
                </div>
            </div>

            <!-- Right Column: Stay up to date (Newsletter) -->
            <div class="footer-col-newsletter">
                <h4 class="footer-nav-heading"><?php esc_html_e('Stay up to date', 'sarmadgardezi'); ?></h4>
                
                <p class="footer-newsletter-desc">
                    <?php esc_html_e('Subscribe to the newsletter to stay up to date with articles, courses, engineering deep dives and much more!', 'sarmadgardezi'); ?>
                    <a href="<?php echo esc_url(home_url('/blog')); ?>" class="footer-newsletter-learn-more">
                        <?php esc_html_e('Learn more about the newsletter', 'sarmadgardezi'); ?>
                        <svg class="footer-diagonal-arrow" width="20" height="20" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M15.101 5.5V23.1094L9.40108 17.4095L8.14807 18.6619L15.9862 26.5L23.852 18.6342L22.5996 17.3817L16.8725 23.1094V5.5H15.101Z" fill="currentColor"></path>
                        </svg>
                    </a>
                </p>

                <form class="footer-newsletter-form" action="<?php echo esc_url(home_url('/contact')); ?>" method="get">
                    <!-- Honeypot -->
                    <div style="position: absolute; left: -9999px; opacity: 0;" aria-hidden="true">
                        <label for="footer_hp_url">Website</label>
                        <input type="text" id="footer_hp_url" name="url" tabindex="-1" autocomplete="off">
                    </div>

                    <div class="footer-form-group">
                        <label for="footer_fname" class="footer-field-label"><?php esc_html_e('First name', 'sarmadgardezi'); ?></label>
                        <input type="text" id="footer_fname" name="firstName" required autocomplete="given-name" class="footer-field-input" placeholder="">
                    </div>

                    <div class="footer-form-group">
                        <label for="footer_email" class="footer-field-label"><?php esc_html_e('Email', 'sarmadgardezi'); ?></label>
                        <input type="email" id="footer_email" name="email" required autocomplete="email" class="footer-field-input" placeholder="">
                    </div>

                    <button type="submit" class="footer-submit-btn">
                        <span class="footer-submit-text"><?php esc_html_e('Sign me up', 'sarmadgardezi'); ?></span>
                        <div class="footer-submit-circle">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </div>
                    </button>
                </form>
            </div>

            <!-- Full Width Bottom Copyright Line -->
            <div class="footer-col-copyright">
                <span class="footer-cr-text"><?php esc_html_e('All rights reserved', 'sarmadgardezi'); ?></span>
                <span class="footer-cr-text">&copy; <?php echo esc_html(get_bloginfo('name')); ?> <?php echo esc_html(date_i18n('Y')); ?></span>
            </div>

        </div>
    </div>

    <!-- Booking Modal Overlay (Preserved for site-wide appointment scheduling) -->
    <div id="cal-booking-modal-overlay" class="cal-booking-modal-overlay" style="display: none;" aria-hidden="true" role="dialog" aria-modal="true">
        <div class="cal-modal-dialog">
            <button type="button" id="cal-modal-close-btn" class="cal-modal-close-btn" aria-label="<?php esc_attr_e('Close booking modal', 'sarmadgardezi'); ?>">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
            <?php get_template_part('template-parts/contact/booking-widget'); ?>
        </div>
    </div>
</footer>
