<?php
/**
 * Template part for displaying the pill navbar matching user's custom design
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;

$nav_items = sarmadgardezi_get_nav_items();
?>

<header class="relative z-50 w-full transition-all duration-300 px-4 sm:px-6 md:px-8 pt-4 pb-2 site-header-pill-wrapper" id="masthead">
    <div class="mx-auto max-w-5xl header-inner-container">
        <div class="flex items-center justify-between bg-[#181818] text-white rounded-full pl-6 pr-2 py-2 shadow-xl hover:shadow-2xl drop-shadow transition-all duration-300 border border-white/5 header-pill-nav">
            
            <!-- Brand Monogram -->
            <a class="flex items-center group brand-link" href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                <span class="font-semibold text-lg sm:text-xl tracking-tight text-white transition-colors duration-200 brand-name"><?php echo esc_html(get_bloginfo('name') ?: 'sarmadgardezi'); ?></span>
                <span class="text-[#a3e635] font-bold text-xl sm:text-2xl ml-[1px] group-hover:scale-125 transition-transform duration-300 brand-dot">.</span>
            </a>

            <!-- Desktop Navigation Menu (Dynamic from WordPress with Sitelinks Schema) -->
            <nav id="site-navigation" class="hidden md:flex items-center gap-8 lg:gap-10 main-navigation" itemscope itemtype="https://schema.org/SiteNavigationElement" aria-label="<?php esc_attr_e('Primary Menu', 'sarmadgardezi'); ?>">
                <?php foreach ($nav_items as $item) : 
                    $is_active = !empty($item['active']);
                    $link_class = $is_active 
                        ? 'text-sm font-medium transition-all duration-200 hover:text-white relative py-1 text-white active current-menu-item' 
                        : 'text-sm font-medium transition-all duration-200 hover:text-white relative py-1 text-zinc-400';
                ?>
                    <a class="<?php echo esc_attr($link_class); ?>" href="<?php echo esc_url($item['url']); ?>" target="<?php echo esc_attr($item['target']); ?>" itemprop="url">
                        <span itemprop="name"><?php echo esc_html($item['title']); ?></span>
                        <?php if ($is_active) : ?>
                            <span class="absolute bottom-0 left-0 w-full h-[2px] bg-[#a3e635] rounded-full active-bar" aria-hidden="true"></span>
                        <?php endif; ?>
                    </a>
                <?php endforeach; ?>
            </nav>

            <!-- Call to Action Button (Desktop) -->
            <div class="hidden md:block header-cta-wrapper">
                <a class="inline-flex items-center justify-center bg-white text-black font-semibold text-sm px-6 py-2.5 rounded-full border border-transparent hover:bg-transparent hover:text-white hover:border-white transition-all duration-300 active:scale-95 btn-talk" href="<?php echo esc_url(home_url('/contact')); ?>">
                    <?php esc_html_e("Let's talk", 'sarmadgardezi'); ?>
                </a>
            </div>

            <!-- Mobile Menu Toggle Button -->
            <button id="menu-toggle" class="p-2 md:hidden menu-toggle" aria-controls="mobile-menu" aria-expanded="false" aria-label="<?php esc_attr_e('Toggle menu', 'sarmadgardezi'); ?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-menu" aria-hidden="true">
                    <path d="M4 5h16"></path>
                    <path d="M4 12h16"></path>
                    <path d="M4 19h16"></path>
                </svg>
            </button>

            <!-- Mobile Navigation Drawer -->
            <div id="mobile-menu" class="md:hidden w-full absolute left-0 top-full mt-2 rounded-2xl bg-[#181818] border border-white/10 hidden mobile-menu-drawer">
                <nav class="flex flex-col p-4 gap-4 mobile-nav" itemscope itemtype="https://schema.org/SiteNavigationElement">
                    <?php foreach ($nav_items as $item) : 
                        $is_active = !empty($item['active']);
                        $mobile_class = $is_active 
                            ? 'text-sm font-medium transition-all duration-200 hover:text-white relative py-2 px-4 rounded-full bg-[#a3e635]/20 text-white active current-menu-item' 
                            : 'text-sm font-medium transition-all duration-200 hover:text-white relative py-2 px-4 rounded-full text-zinc-400';
                    ?>
                        <a class="<?php echo esc_attr($mobile_class); ?>" href="<?php echo esc_url($item['url']); ?>" target="<?php echo esc_attr($item['target']); ?>" itemprop="url">
                            <span itemprop="name"><?php echo esc_html($item['title']); ?></span>
                        </a>
                    <?php endforeach; ?>
                    <a class="inline-flex items-center justify-center bg-white text-black font-semibold text-sm px-6 py-2.5 rounded-full border border-transparent hover:bg-transparent hover:text-white hover:border-white transition-all duration-300 active:scale-95 mt-2 btn-talk btn-talk-mobile" href="<?php echo esc_url(home_url('/contact')); ?>">
                        <?php esc_html_e("Let's talk", 'sarmadgardezi'); ?>
                    </a>
                </nav>
            </div>

        </div>
    </div>
</header>
