<?php
/**
 * Template part for displaying the transparent boxed notch header and fullscreen blurred menu
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;

$nav_items = sarmadgardezi_get_nav_items();
$book_call_url = apply_filters('sarmadgardezi_book_a_call_url', home_url('/contact'));
?>

<header class="site-header-custom" id="masthead">
    <div class="site-header-inner">
        
        <!-- Left: Brand Logo (Sarmad) -->
        <div class="header-left">
            <a class="brand-link" href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                <?php if (has_custom_logo()) : ?>
                    <?php the_custom_logo(); ?>
                <?php else : ?>
                    <span class="brand-logo-text">
                        <span class="brand-name">Sarmad</span><span class="brand-dot">.</span>
                    </span>
                <?php endif; ?>
            </a>
        </div>

        <!-- Center (Desktop) / Right (Mobile): Top Hanging Notch Menu Button -->
        <div class="header-center">
            <button id="menu-toggle" class="header-menu-notch" aria-controls="header-menu-modal" aria-expanded="false" aria-label="<?php esc_attr_e('Toggle Menu', 'sarmadgardezi'); ?>">
                <!-- Closed state content -->
                <span class="menu-state-closed">
                    <svg class="menu-dots-icon" width="13" height="13" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true">
                        <circle cx="4.5" cy="3" r="1.6" />
                        <circle cx="11.5" cy="3" r="1.6" />
                        <circle cx="4.5" cy="8" r="1.6" />
                        <circle cx="11.5" cy="8" r="1.6" />
                        <circle cx="4.5" cy="13" r="1.6" />
                        <circle cx="11.5" cy="13" r="1.6" />
                    </svg>
                    <span class="menu-notch-text"><?php esc_html_e('Menu', 'sarmadgardezi'); ?></span>
                </span>

                <!-- Open state content -->
                <span class="menu-state-open">
                    <svg class="menu-sparkle-icon" width="14" height="14" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path d="M12 2L14.5 9.5L22 12L14.5 14.5L12 22L9.5 14.5L2 12L9.5 9.5L12 2Z"/>
                    </svg>
                    <span class="menu-notch-text"><?php esc_html_e('Close', 'sarmadgardezi'); ?></span>
                </span>
            </button>
        </div>

        <!-- Right: Book a call Pill Button (Desktop only) -->
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

    <!-- Fullscreen Blurred Modal Overlay with Large Boxed Card -->
    <div id="header-menu-modal" class="header-menu-overlay hidden" role="dialog" aria-modal="true" aria-label="<?php esc_attr_e('Navigation Menu', 'sarmadgardezi'); ?>">
        <!-- Background Blur Layer -->
        <div class="header-menu-backdrop" id="header-menu-backdrop"></div>

        <!-- Scrollable Modal Wrapper -->
        <div class="header-modal-content-wrap">
            
            <!-- Floating Top Notch inside modal (Anchored to top center of the boxed card) -->
            <button class="header-modal-close-notch" id="modal-close-trigger" aria-label="<?php esc_attr_e('Close Menu', 'sarmadgardezi'); ?>">
                <svg class="menu-sparkle-icon" width="14" height="14" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                    <path d="M12 2L14.5 9.5L22 12L14.5 14.5L12 22L9.5 14.5L2 12L9.5 9.5L12 2Z"/>
                </svg>
                <span class="menu-notch-text"><?php esc_html_e('Close', 'sarmadgardezi'); ?></span>
            </button>

            <!-- Large Boxed Dark Card -->
            <div class="header-boxed-card">
                
                <!-- Main Navigation Links (Clean & Small) -->
                <nav class="boxed-nav-list" itemscope itemtype="https://schema.org/SiteNavigationElement" aria-label="<?php esc_attr_e('Primary Menu', 'sarmadgardezi'); ?>">
                    <?php foreach ($nav_items as $index => $item) : 
                        $is_active = !empty($item['active']);
                        $item_class = 'boxed-nav-link' . ($is_active ? ' is-active' : '');
                    ?>
                        <a class="<?php echo esc_attr($item_class); ?>" href="<?php echo esc_url($item['url']); ?>" target="<?php echo esc_attr($item['target']); ?>" itemprop="url">
                            <span itemprop="name"><?php echo esc_html(strtoupper($item['title'])); ?></span>
                        </a>
                    <?php endforeach; ?>
                </nav>

            </div>
        </div>
    </div>
</header>
