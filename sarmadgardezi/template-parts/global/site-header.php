<?php
/**
 * Template part for displaying the custom top notch header with dropdown menu and booking CTA
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;

$nav_items = sarmadgardezi_get_nav_items();
$book_call_url = apply_filters('sarmadgardezi_book_a_call_url', home_url('/contact'));
?>

<header class="site-header-custom" id="masthead">
    <div class="site-header-inner">
        
        <!-- Left: Brand Logo -->
        <div class="header-left">
            <a class="brand-link" href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                <?php if (has_custom_logo()) : ?>
                    <?php the_custom_logo(); ?>
                <?php else : ?>
                    <span class="brand-logo-icon" aria-hidden="true">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M4 3h16a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2zm0 2v3h16V5H4zm0 5v9h16v-9H4zm5 1.5l7 3-7 3v-6z"/>
                        </svg>
                    </span>
                    <span class="brand-name">
                        <span class="brand-name-text"><?php echo esc_html(get_bloginfo('name') ?: 'sarmadgardezi'); ?></span>
                        <span class="brand-dot">.</span>
                    </span>
                <?php endif; ?>
            </a>
        </div>

        <!-- Center: Top Hanging Notch Menu Button -->
        <div class="header-center">
            <button id="menu-toggle" class="header-menu-notch" aria-controls="header-menu-panel" aria-expanded="false" aria-label="<?php esc_attr_e('Toggle Navigation Menu', 'sarmadgardezi'); ?>">
                <span class="menu-notch-content">
                    <svg class="menu-dots-icon" width="13" height="13" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true">
                        <circle cx="4.5" cy="3" r="1.6" />
                        <circle cx="11.5" cy="3" r="1.6" />
                        <circle cx="4.5" cy="8" r="1.6" />
                        <circle cx="11.5" cy="8" r="1.6" />
                        <circle cx="4.5" cy="13" r="1.6" />
                        <circle cx="11.5" cy="13" r="1.6" />
                    </svg>
                    <span class="menu-label"><?php esc_html_e('Menu', 'sarmadgardezi'); ?></span>
                    <svg class="menu-close-icon" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </span>
            </button>
        </div>

        <!-- Right: Book a call Pill Button -->
        <div class="header-right">
            <a class="btn-book-call" href="<?php echo esc_url($book_call_url); ?>">
                <span class="btn-book-call-icon" aria-hidden="true">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                        <line x1="16" y1="2" x2="16" y2="6"></line>
                        <line x1="8" y1="2" x2="8" y2="6"></line>
                        <line x1="3" y1="10" x2="21" y2="10"></line>
                        <circle cx="8" cy="14" r="0.9" fill="currentColor"></circle>
                        <circle cx="12" cy="14" r="0.9" fill="currentColor"></circle>
                        <circle cx="16" cy="14" r="0.9" fill="currentColor"></circle>
                        <circle cx="8" cy="18" r="0.9" fill="currentColor"></circle>
                        <circle cx="12" cy="18" r="0.9" fill="currentColor"></circle>
                        <circle cx="16" cy="18" r="0.9" fill="currentColor"></circle>
                    </svg>
                </span>
                <span class="btn-book-call-text"><?php esc_html_e('Book a call', 'sarmadgardezi'); ?></span>
            </a>
        </div>

    </div>

    <!-- Dropdown / Floating Menu Panel anchored directly below the center notch -->
    <div id="header-menu-panel" class="header-menu-dropdown hidden" role="region" aria-label="<?php esc_attr_e('Site Menu', 'sarmadgardezi'); ?>">
        <div class="header-menu-dropdown-backdrop" id="header-menu-backdrop"></div>
        <div class="header-menu-dropdown-inner">
            <nav id="site-navigation" class="header-nav-list" itemscope itemtype="https://schema.org/SiteNavigationElement" aria-label="<?php esc_attr_e('Primary Menu', 'sarmadgardezi'); ?>">
                <?php foreach ($nav_items as $index => $item) : 
                    $is_active = !empty($item['active']);
                    $item_class = 'header-nav-item' . ($is_active ? ' active current-menu-item' : '');
                ?>
                    <a class="<?php echo esc_attr($item_class); ?>" href="<?php echo esc_url($item['url']); ?>" target="<?php echo esc_attr($item['target']); ?>" itemprop="url">
                        <span class="nav-item-name" itemprop="name"><?php echo esc_html($item['title']); ?></span>
                        <?php if ($is_active) : ?>
                            <span class="nav-active-dot" aria-hidden="true"></span>
                        <?php endif; ?>
                    </a>
                <?php endforeach; ?>
            </nav>

            <div class="header-menu-dropdown-footer">
                <a class="header-dropdown-cta" href="<?php echo esc_url($book_call_url); ?>">
                    <span class="btn-book-call-icon" aria-hidden="true">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                    </span>
                    <span><?php esc_html_e('Book a call', 'sarmadgardezi'); ?></span>
                </a>
            </div>
        </div>
    </div>
</header>
