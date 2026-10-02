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
                            <svg class="brand-badge-svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.75" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 6.5C18 4.5 15.5 3 12 3C8.5 3 6 4.5 6 7C6 11.8 18 10.8 18 16.8C18 19.2 15.5 21 12 21C8.5 21 6 19.2 6 17.2"></path>
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
