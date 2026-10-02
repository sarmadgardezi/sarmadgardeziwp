<?php
/**
 * Template part for displaying the Minimalist Header aligned with Hero width
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;

$nav_items = sarmadgardezi_get_nav_items();
?>

<header class="site-header-custom" id="masthead">
    <div class="site-container site-header-container">
        <div class="site-header-inner">
            
            <!-- Left: Brand Logo (Squircle Lavender Badge) -->
            <div class="header-left">
                <a class="brand-link" href="<?php echo esc_url(home_url('/')); ?>" rel="home" aria-label="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>">
                    <?php if (has_custom_logo()) : ?>
                        <?php the_custom_logo(); ?>
                    <?php else : ?>
                        <span class="brand-badge" aria-hidden="true">
                            <svg class="brand-badge-svg" width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="2.5" y="14.5" width="4.5" height="4.5" rx="1" fill="#111827" />
                                <path d="M19 7 C19 4.8, 16 3.5, 13 3.5 C9 3.5, 7.5 6, 7.5 8.2 C7.5 12.2, 19 11.2, 19 15.8 C19 19, 16 20.5, 12 20.5 C8.5 20.5, 7.5 18.2, 7.5 18.2" stroke="#111827" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </span>
                    <?php endif; ?>
                </a>
            </div>

            <!-- Right: Direct Horizontal Navigation Links -->
            <nav class="header-nav" aria-label="<?php esc_attr_e('Primary Navigation', 'sarmadgardezi'); ?>">
                <ul class="header-nav-list">
                    <?php foreach ($nav_items as $item) : 
                        if (strtolower(trim($item['title'])) === 'home') {
                            continue;
                        }
                        $is_active = !empty($item['active']);
                        $item_class = 'header-nav-item' . ($is_active ? ' is-active' : '');
                    ?>
                        <li class="<?php echo esc_attr($item_class); ?>">
                            <a class="header-nav-link" href="<?php echo esc_url($item['url']); ?>" target="<?php echo esc_attr($item['target']); ?>">
                                <?php echo esc_html($item['title']); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </nav>

        </div>
    </div>
</header>
