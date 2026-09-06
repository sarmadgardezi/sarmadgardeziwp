<?php
/**
 * Template part for displaying the site footer matching exact custom specification
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;
?>

<footer id="colophon" class="site-footer">
    <div class="site-container footer-inner-container">
        
        <!-- Top Bar: Brand Monogram & Action Buttons -->
        <div class="footer-top-bar">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="footer-brand" rel="home">
                <span class="footer-logo-brackets">&lt;&gt;</span>
                <span class="footer-logo-name">Sarmad</span>
                <span class="footer-logo-sub">/Codes!</span>
            </a>

            <div class="footer-top-actions">
                <a href="<?php echo esc_url(home_url('/talks')); ?>" class="footer-btn-talks">
                    <?php esc_html_e('VIEW MY TALKS', 'sarmadgardezi'); ?>
                </a>
                <a href="<?php echo esc_url(home_url('/contact')); ?>" class="footer-btn-consultation">
                    <?php esc_html_e('BOOK CONSULTATION', 'sarmadgardezi'); ?>
                </a>
            </div>
        </div>

        <!-- 5 Columns Navigation Grid -->
        <div class="footer-columns-grid">
            <!-- Column 1: Identity -->
            <div class="footer-nav-col">
                <h4 class="footer-col-title"><?php esc_html_e('IDENTITY', 'sarmadgardezi'); ?></h4>
                <ul class="footer-col-links">
                    <li><a href="<?php echo esc_url(home_url('/about')); ?>"><?php esc_html_e('About Me', 'sarmadgardezi'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/profile')); ?>"><?php esc_html_e('Profile', 'sarmadgardezi'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/work')); ?>"><?php esc_html_e('My Portfolio', 'sarmadgardezi'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/case-studies')); ?>"><?php esc_html_e('Case Studies', 'sarmadgardezi'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/contact')); ?>"><?php esc_html_e('Contact Me', 'sarmadgardezi'); ?></a></li>
                </ul>
            </div>

            <!-- Column 2: Solutions -->
            <div class="footer-nav-col">
                <h4 class="footer-col-title"><?php esc_html_e('SOLUTIONS', 'sarmadgardezi'); ?></h4>
                <ul class="footer-col-links">
                    <li><a href="<?php echo esc_url(home_url('/services#saas')); ?>"><?php esc_html_e('SAAS Development', 'sarmadgardezi'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/services#ai-ml')); ?>"><?php esc_html_e('AI & ML Software', 'sarmadgardezi'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/services#firebase')); ?>"><?php esc_html_e('Firebase Expert', 'sarmadgardezi'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/services#automation')); ?>"><?php esc_html_e('Tracking Automation', 'sarmadgardezi'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/services#seo')); ?>"><?php esc_html_e('SEO Strategy', 'sarmadgardezi'); ?></a></li>
                </ul>
            </div>

            <!-- Column 3: Academy -->
            <div class="footer-nav-col">
                <h4 class="footer-col-title"><?php esc_html_e('ACADEMY', 'sarmadgardezi'); ?></h4>
                <ul class="footer-col-links">
                    <li><a href="<?php echo esc_url(home_url('/courses')); ?>"><?php esc_html_e('All Courses', 'sarmadgardezi'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/tutorials')); ?>"><?php esc_html_e('Tutorials', 'sarmadgardezi'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/blog')); ?>"><?php esc_html_e('Engineering Blog', 'sarmadgardezi'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/sources')); ?>"><?php esc_html_e('Source Codes', 'sarmadgardezi'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/talks')); ?>"><?php esc_html_e('Technical Talks', 'sarmadgardezi'); ?></a></li>
                </ul>
            </div>

            <!-- Column 4: Development -->
            <div class="footer-nav-col">
                <h4 class="footer-col-title"><?php esc_html_e('DEVELOPMENT', 'sarmadgardezi'); ?></h4>
                <ul class="footer-col-links">
                    <li><a href="<?php echo esc_url(home_url('/services#web-development')); ?>"><?php esc_html_e('Web Development', 'sarmadgardezi'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/services#react-gatsby')); ?>"><?php esc_html_e('React & Gatsby', 'sarmadgardezi'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/services#ui-ux')); ?>"><?php esc_html_e('UI/UX Design', 'sarmadgardezi'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/services#seo-analysis')); ?>"><?php esc_html_e('SEO Analysis', 'sarmadgardezi'); ?></a></li>
                </ul>
            </div>

            <!-- Column 5: Legal -->
            <div class="footer-nav-col">
                <h4 class="footer-col-title"><?php esc_html_e('LEGAL', 'sarmadgardezi'); ?></h4>
                <ul class="footer-col-links">
                    <li><a href="<?php echo esc_url(home_url('/terms')); ?>"><?php esc_html_e('Terms Of Services', 'sarmadgardezi'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/privacy')); ?>"><?php esc_html_e('Privacy Policy', 'sarmadgardezi'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/disclaimer')); ?>"><?php esc_html_e('Legal Disclaimer', 'sarmadgardezi'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/faqs')); ?>"><?php esc_html_e('Support FAQs', 'sarmadgardezi'); ?></a></li>
                </ul>
            </div>
        </div>

        <!-- Lower Rounded Sub-bar: Policy Links & Social Icons -->
        <div class="footer-pill-bar">
            <div class="footer-legal-links">
                <a href="<?php echo esc_url(home_url('/terms')); ?>"><?php esc_html_e('Terms and Conditions', 'sarmadgardezi'); ?></a>
                <a href="<?php echo esc_url(home_url('/privacy')); ?>"><?php esc_html_e('Privacy Policy', 'sarmadgardezi'); ?></a>
                <a href="<?php echo esc_url(home_url('/disclaimer')); ?>"><?php esc_html_e('Disclaimer', 'sarmadgardezi'); ?></a>
            </div>

            <div class="footer-social-icons">
                <a href="https://instagram.com/sarmadgardezi" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
                </a>
                <a href="https://youtube.com/@sarmadgardezi" target="_blank" rel="noopener noreferrer" aria-label="YouTube">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.25 29 29 0 0 0-.46-5.33z"></path><polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02"></polygon></svg>
                </a>
                <a href="https://twitter.com/sarmadgardezi" target="_blank" rel="noopener noreferrer" aria-label="Twitter">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg>
                </a>
                <a href="https://facebook.com/sarmadgardezi" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>
                </a>
                <a href="https://linkedin.com/in/sarmadgardezi" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path><rect x="2" y="9" width="4" height="12"></rect><circle cx="4" cy="4" r="2"></circle></svg>
                </a>
                <a href="https://github.com/sarmadgardezi" target="_blank" rel="noopener noreferrer" aria-label="GitHub">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"></path></svg>
                </a>
            </div>
        </div>

        <!-- Technical Architecture Disclaimer Note -->
        <p class="footer-tech-note">
            <?php esc_html_e('Technical Architecture: Every cloud ecosystem and Agentic AI solution is architected with a focus on scalability and cost-efficiency using Google Cloud and Firebase. Implementation results may vary based on specific business logic, data processing requirements, and external API usage. As a Google Cloud Expert, I ensure the highest standards of security and performance in every deployment. Clients are encouraged to review full technical specifications for their specific project.', 'sarmadgardezi'); ?>
        </p>

        <!-- Copyright Line -->
        <p class="footer-copyright">
            &copy; 2012 - <?php echo esc_html(date_i18n('Y')); ?> <?php esc_html_e('Sarmad Gardezi. All Rights Reserved.', 'sarmadgardezi'); ?>
        </p>

    </div>
</footer>
