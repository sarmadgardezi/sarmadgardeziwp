<?php
/**
 * Template part for displaying the site header
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;
?>

<header id="masthead" class="site-header">
    <div class="site-container header-inner">
        <div class="site-branding">
            <?php if (has_custom_logo()) : ?>
                <?php the_custom_logo(); ?>
            <?php else : ?>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="brand-link" rel="home">
                    <span class="brand-dot"></span>
                    <span class="brand-name"><?php bloginfo('name'); ?></span>
                    <span class="brand-tag"><?php esc_html_e('Dev & Architect', 'sarmadgardezi'); ?></span>
                </a>
            <?php endif; ?>
        </div><!-- .site-branding -->

        <nav id="site-navigation" class="main-navigation" aria-label="<?php esc_attr_e('Primary Menu', 'sarmadgardezi'); ?>">
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
                    <li><a href="<?php echo esc_url(home_url('/#about')); ?>"><?php esc_html_e('About', 'sarmadgardezi'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/#expertise')); ?>"><?php esc_html_e('Expertise', 'sarmadgardezi'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/#projects')); ?>"><?php esc_html_e('Projects', 'sarmadgardezi'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/#case-studies')); ?>"><?php esc_html_e('Case Studies', 'sarmadgardezi'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/#posts')); ?>"><?php esc_html_e('Blog', 'sarmadgardezi'); ?></a></li>
                </ul>
            <?php endif; ?>
        </nav><!-- #site-navigation -->

        <div class="header-actions">
            <a href="<?php echo esc_url(home_url('/#contact')); ?>" class="btn btn-primary btn-sm header-cta">
                <span><?php esc_html_e("Let's Talk", 'sarmadgardezi'); ?></span>
                <?php echo sarmadgardezi_get_icon('arrow-right', 'btn-icon'); ?>
            </a>

            <button id="menu-toggle" class="menu-toggle" aria-controls="site-navigation" aria-expanded="false" aria-label="<?php esc_attr_e('Toggle navigation', 'sarmadgardezi'); ?>">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div><!-- .header-inner -->
</header><!-- #masthead -->
