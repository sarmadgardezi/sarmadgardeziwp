<?php
/**
 * Template part for displaying the Minimalist White Header with Centered Menu and Auth Actions
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;

$nav_items = sarmadgardezi_get_nav_items();

// Theme Customizer branding options
$brand_display = get_theme_mod('sarmadgardezi_brand_display', 'title_only');
$brand_text_override = get_theme_mod('sarmadgardezi_brand_text', '');
$brand_title = !empty($brand_text_override) ? $brand_text_override : get_bloginfo('name');
?>

<header class="site-header-custom" id="masthead">
    <div class="site-header-container">
        <div class="site-header-inner">
            
            <!-- Left: Brand Logo / Title -->
            <div class="header-left">
                <a class="brand-link" href="<?php echo esc_url(home_url('/')); ?>" rel="home" aria-label="<?php echo esc_attr($brand_title); ?>">
                    <?php if (has_custom_logo()) : ?>
                        <?php if ($brand_display === 'logo_only') : ?>
                            <?php the_custom_logo(); ?>
                        <?php elseif ($brand_display === 'both') : ?>
                            <span class="brand-logo-wrap"><?php the_custom_logo(); ?></span>
                            <span class="brand-name-text"><?php echo esc_html($brand_title); ?></span>
                        <?php else : ?>
                            <span class="brand-name-text"><?php echo esc_html($brand_title); ?></span>
                        <?php endif; ?>
                    <?php else : ?>
                        <span class="brand-name-text"><?php echo esc_html($brand_title); ?></span>
                    <?php endif; ?>
                </a>
            </div>

            <!-- Center: Primary Navigation Menu -->
            <nav class="header-nav header-desktop-nav" aria-label="<?php esc_attr_e('Primary Navigation', 'sarmadgardezi'); ?>">
                <ul class="header-nav-list">
                    <?php foreach ($nav_items as $item) : 
                        $is_active = !empty($item['active']);
                        $item_class = 'header-nav-item' . ($is_active ? ' is-active' : '');
                    ?>
                        <li class="<?php echo esc_attr($item_class); ?>">
                            <a class="header-nav-link" href="<?php echo esc_url($item['url']); ?>" target="<?php echo esc_attr($item['target']); ?>">
                                <span><?php echo esc_html($item['title']); ?></span>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </nav>

            <!-- Right: Sign up Link and Pill Outline Button -->
            <div class="header-right">
                <div class="header-auth-actions">
                    <a class="header-auth-link" href="#">
                        <?php esc_html_e('Sign up', 'sarmadgardezi'); ?>
                    </a>
                    <a class="header-auth-btn" href="#">
                        <?php esc_html_e('Log in', 'sarmadgardezi'); ?>
                    </a>
                </div>

                <!-- Mobile Hamburger Toggle Button -->
                <button type="button" class="header-mobile-toggle" id="mobile-menu-toggle" aria-expanded="false" aria-controls="header-mobile-drawer" aria-label="<?php esc_attr_e('Toggle navigation menu', 'sarmadgardezi'); ?>">
                    <span class="hamburger-box">
                        <span class="hamburger-bar bar-1"></span>
                        <span class="hamburger-bar bar-2"></span>
                        <span class="hamburger-bar bar-3"></span>
                    </span>
                </button>
            </div>

        </div>
    </div>

    <!-- Mobile Navigation Drawer Overlay -->
    <div class="header-mobile-drawer" id="header-mobile-drawer" aria-hidden="true">
        <div class="mobile-drawer-backdrop" id="mobile-drawer-backdrop"></div>
        <div class="mobile-drawer-card">
            <nav class="mobile-drawer-nav" aria-label="<?php esc_attr_e('Mobile Navigation', 'sarmadgardezi'); ?>">
                <ul class="mobile-nav-list">
                    <?php foreach ($nav_items as $item) : 
                        $is_active = !empty($item['active']);
                        $item_class = 'mobile-nav-item' . ($is_active ? ' is-active' : '');
                    ?>
                        <li class="<?php echo esc_attr($item_class); ?>">
                            <a class="mobile-nav-link" href="<?php echo esc_url($item['url']); ?>" target="<?php echo esc_attr($item['target']); ?>">
                                <?php echo esc_html($item['title']); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </nav>
            <div class="mobile-drawer-actions">
                <a class="mobile-auth-link" href="#"><?php esc_html_e('Sign up', 'sarmadgardezi'); ?></a>
                <a class="mobile-auth-btn" href="#"><?php esc_html_e('Log in', 'sarmadgardezi'); ?></a>
            </div>
        </div>
    </div>
</header>
