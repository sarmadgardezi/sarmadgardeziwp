<?php
/**
 * Template part for displaying the floating dark pill site header
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;
?>

<header id="masthead" class="site-header site-header-floating">
    <div class="header-pill">
        <div class="site-branding">
            <?php if (has_custom_logo()) : ?>
                <?php the_custom_logo(); ?>
            <?php else : ?>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="brand-monogram-link" rel="home">
                    <span class="brand-monogram">SG<span class="brand-accent">.</span></span>
                </a>
            <?php endif; ?>
        </div>

        <nav id="site-navigation" class="main-navigation" itemscope itemtype="https://schema.org/SiteNavigationElement" aria-label="<?php esc_attr_e('Primary Menu', 'sarmadgardezi'); ?>">
            <?php
            if (has_nav_menu('primary')) :
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'menu_id'        => 'primary-menu',
                    'menu_class'     => 'nav-menu',
                    'container'      => false,
                    'fallback_cb'    => false,
                ));
            else :
                ?>
                <ul id="primary-menu" class="nav-menu">
                    <li class="current-menu-item"><a href="<?php echo esc_url(home_url('/')); ?>" itemprop="url"><span itemprop="name"><?php esc_html_e('Home', 'sarmadgardezi'); ?></span></a></li>
                    <li><a href="<?php echo esc_url(home_url('/#work')); ?>" itemprop="url"><span itemprop="name"><?php esc_html_e('Work', 'sarmadgardezi'); ?></span></a></li>
                    <li><a href="<?php echo esc_url(home_url('/#about')); ?>" itemprop="url"><span itemprop="name"><?php esc_html_e('About me', 'sarmadgardezi'); ?></span></a></li>
                    <li><a href="<?php echo esc_url(home_url('/#contact')); ?>" itemprop="url"><span itemprop="name"><?php esc_html_e('Contact', 'sarmadgardezi'); ?></span></a></li>
                </ul>
            <?php endif; ?>
        </nav>

        <div class="header-actions">
            <a href="https://linkedin.com/in/sarmadgardezi" target="_blank" rel="noopener noreferrer" class="nav-pill-btn" aria-label="LinkedIn Profile">
                <svg class="nav-btn-icon" width="15" height="15" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                    <path d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14m-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-.85 0-1.84.52-2.28 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 0 1 1.4 1.4v4.93h2.75M6.46 10.9v8.37H9.2V10.9H6.46M7.83 6.45a1.64 1.64 0 0 0-1.66 1.63 1.65 1.65 0 0 0 1.66 1.64c.91 0 1.65-.73 1.65-1.64 0-.9-.74-1.63-1.65-1.63Z"/>
                </svg>
                <span>LinkedIn</span>
            </a>

            <button id="menu-toggle" class="menu-toggle" aria-controls="site-navigation" aria-expanded="false" aria-label="<?php esc_attr_e('Toggle navigation', 'sarmadgardezi'); ?>">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>
</header>
