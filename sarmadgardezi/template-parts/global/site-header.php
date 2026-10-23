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

<header class="site-header-custom site-header-boxed" id="masthead">
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

            <!-- Center: Primary Navigation Menu with Dropdown Support -->
            <nav class="header-nav header-desktop-nav" aria-label="<?php esc_attr_e('Primary Navigation', 'sarmadgardezi'); ?>">
                <ul class="header-nav-list">
                    <?php foreach ($nav_items as $item) : 
                        $is_active = !empty($item['active']);
                        $has_children = !empty($item['children']);
                        $item_class = 'header-nav-item' . ($is_active ? ' is-active' : '') . ($has_children ? ' has-dropdown' : '');
                    ?>
                        <li class="<?php echo esc_attr($item_class); ?>">
                            <?php if ($has_children) : ?>
                                <a class="header-nav-link dropdown-toggle" href="<?php echo esc_url($item['url']); ?>" target="<?php echo esc_attr($item['target']); ?>" aria-expanded="false" aria-haspopup="true">
                                    <span><?php echo esc_html($item['title']); ?></span>
                                    <svg class="dropdown-caret" width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                        <polyline points="6 9 12 15 18 9"></polyline>
                                    </svg>
                                </a>
                                <div class="header-dropdown-menu" role="menu">
                                    <ul class="dropdown-menu-list">
                                        <?php foreach ($item['children'] as $child) : 
                                            $child_active = !empty($child['active']);
                                        ?>
                                            <li class="dropdown-item<?php echo $child_active ? ' is-active' : ''; ?>" role="none">
                                                <a class="dropdown-link" href="<?php echo esc_url($child['url']); ?>" target="<?php echo esc_attr(!empty($child['target']) ? $child['target'] : '_self'); ?>" role="menuitem">
                                                    <span class="dropdown-link-title"><?php echo esc_html($child['title']); ?></span>
                                                    <?php if (!empty($child['description'])) : ?>
                                                        <span class="dropdown-link-desc"><?php echo esc_html($child['description']); ?></span>
                                                    <?php endif; ?>
                                                </a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            <?php else : ?>
                                <a class="header-nav-link" href="<?php echo esc_url($item['url']); ?>" target="<?php echo esc_attr($item['target']); ?>">
                                    <span><?php echo esc_html($item['title']); ?></span>
                                </a>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </nav>

            <!-- Right: Log in Link and Color-filled Bold Sign up Button -->
            <div class="header-right">
                <div class="header-auth-actions">
                    <a class="header-auth-link" href="#">
                        <?php esc_html_e('Log in', 'sarmadgardezi'); ?>
                    </a>
                    <a class="header-auth-btn header-auth-btn-filled" href="#">
                        <?php esc_html_e('Sign up', 'sarmadgardezi'); ?>
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
                        $has_children = !empty($item['children']);
                        $item_class = 'mobile-nav-item' . ($is_active ? ' is-active' : '') . ($has_children ? ' mobile-has-dropdown' : '');
                    ?>
                        <li class="<?php echo esc_attr($item_class); ?>">
                            <?php if ($has_children) : ?>
                                <div class="mobile-dropdown-header">
                                    <a class="mobile-nav-link" href="<?php echo esc_url($item['url']); ?>" target="<?php echo esc_attr($item['target']); ?>">
                                        <?php echo esc_html($item['title']); ?>
                                    </a>
                                    <button type="button" class="mobile-dropdown-toggle" aria-expanded="false" aria-label="<?php esc_attr_e('Toggle submenu', 'sarmadgardezi'); ?>">
                                        <svg class="dropdown-caret" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                            <polyline points="6 9 12 15 18 9"></polyline>
                                        </svg>
                                    </button>
                                </div>
                                <ul class="mobile-submenu-list" hidden>
                                    <?php foreach ($item['children'] as $child) : 
                                        $child_active = !empty($child['active']);
                                    ?>
                                        <li class="mobile-submenu-item<?php echo $child_active ? ' is-active' : ''; ?>">
                                            <a class="mobile-submenu-link" href="<?php echo esc_url($child['url']); ?>" target="<?php echo esc_attr(!empty($child['target']) ? $child['target'] : '_self'); ?>">
                                                <span class="mobile-submenu-title"><?php echo esc_html($child['title']); ?></span>
                                                <?php if (!empty($child['description'])) : ?>
                                                    <span class="mobile-submenu-desc"><?php echo esc_html($child['description']); ?></span>
                                                <?php endif; ?>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php else : ?>
                                <a class="mobile-nav-link" href="<?php echo esc_url($item['url']); ?>" target="<?php echo esc_attr($item['target']); ?>">
                                    <?php echo esc_html($item['title']); ?>
                                </a>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </nav>
            <div class="mobile-drawer-actions">
                <a class="mobile-auth-link" href="#"><?php esc_html_e('Log in', 'sarmadgardezi'); ?></a>
                <a class="mobile-auth-btn mobile-auth-btn-filled" href="#"><?php esc_html_e('Sign up', 'sarmadgardezi'); ?></a>
            </div>
        </div>
    </div>
</header>
