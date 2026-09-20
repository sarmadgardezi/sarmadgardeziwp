<?php
/**
 * Admin Managers & ACF Field Groups Registration
 *
 * Provides dedicated native WordPress Admin Settings pages for:
 * 1. "Brands Marquee"
 * 2. "Portfolio Cards" (Stacking Google-colored Cards)
 * Plus native Front Page Meta Boxes and ACF Pro / Free interoperability.
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;

/**
 * 1. Register Native Top-Level WP Admin Menus: "Brands Marquee" & "Portfolio Cards"
 */
add_action('admin_menu', 'sarmadgardezi_register_custom_admin_menus');
function sarmadgardezi_register_custom_admin_menus() {
    // Brands Marquee Menu
    add_menu_page(
        __('Brands Marquee Settings', 'sarmadgardezi'),
        __('Brands Marquee', 'sarmadgardezi'),
        'edit_theme_options',
        'sarmadgardezi-brands',
        'sarmadgardezi_render_brands_admin_page',
        'dashicons-images-alt2',
        23
    );

    // Portfolio Stacking Cards Menu
    add_menu_page(
        __('Portfolio Stacking Cards', 'sarmadgardezi'),
        __('Portfolio Cards', 'sarmadgardezi'),
        'edit_theme_options',
        'sarmadgardezi-portfolio',
        'sarmadgardezi_render_portfolio_admin_page',
        'dashicons-welcome-widgets-menus',
        24
    );
}

/**
 * 2. Enqueue Media Scripts on Custom Admin Pages
 */
add_action('admin_enqueue_scripts', 'sarmadgardezi_custom_admin_scripts');
function sarmadgardezi_custom_admin_scripts($hook) {
    if (
        $hook === 'toplevel_page_sarmadgardezi-brands' || 
        $hook === 'toplevel_page_sarmadgardezi-portfolio' || 
        $hook === 'post.php' || 
        $hook === 'post-new.php'
    ) {
        wp_enqueue_media();
    }
}

/**
 * --------------------------------------------------------------------------
 * BRANDS MARQUEE MANAGER
 * --------------------------------------------------------------------------
 */

add_action('admin_post_sarmadgardezi_save_brands', 'sarmadgardezi_save_brands_settings');
function sarmadgardezi_save_brands_settings() {
    if (!current_user_can('edit_theme_options')) {
        wp_die(__('Unauthorized action.', 'sarmadgardezi'));
    }

    check_admin_referer('sarmadgardezi_brands_nonce_action', 'sarmadgardezi_brands_nonce');

    $section_title = isset($_POST['brands_section_title']) ? sanitize_text_field($_POST['brands_section_title']) : '';
    $raw_logos     = isset($_POST['brand_logos']) && is_array($_POST['brand_logos']) ? $_POST['brand_logos'] : array();

    $clean_logos = array();
    foreach ($raw_logos as $item) {
        $url  = !empty($item['url']) ? esc_url_raw($item['url']) : '';
        $name = !empty($item['name']) ? sanitize_text_field($item['name']) : '';
        $link = !empty($item['link']) ? esc_url_raw($item['link']) : '';

        if (!empty($url)) {
            $clean_logos[] = array(
                'brand_logo' => $url,
                'brand_name' => $name,
                'brand_url'  => $link,
                'url'        => $url,
                'name'       => $name,
                'link'       => $link,
            );
        }
    }

    update_option('brands_section_title', $section_title);
    update_option('brand_logos', $clean_logos);
    update_option('sarmadgardezi_brands_settings', array(
        'title' => $section_title,
        'logos' => $clean_logos,
    ));

    $front_id = get_option('page_on_front');
    if ($front_id) {
        update_post_meta($front_id, '_brands_section_title', $section_title);
        update_post_meta($front_id, '_brand_logos', $clean_logos);
    }

    wp_safe_redirect(add_query_arg(array('page' => 'sarmadgardezi-brands', 'saved' => '1'), admin_url('admin.php')));
    exit;
}

function sarmadgardezi_render_brands_admin_page() {
    $section_title = get_option('brands_section_title', '');
    if (empty($section_title)) {
        $section_title = __('Trusted by these amazing companies', 'sarmadgardezi');
    }

    $brand_logos = get_option('brand_logos', array());
    if (!is_array($brand_logos)) {
        $brand_logos = array();
    }
    ?>
    <div class="wrap" style="max-width: 900px; margin-top: 24px;">
        <h1 style="display:flex; align-items:center; gap: 10px; font-size: 24px; margin-bottom: 8px;">
            <span class="dashicons dashicons-images-alt2" style="font-size:28px; width:28px; height:28px;"></span>
            <?php esc_html_e('Brands & Companies Marquee', 'sarmadgardezi'); ?>
        </h1>
        <p style="color: #64748b; font-size: 14px; margin-bottom: 24px;">
            <?php esc_html_e('Manage the company logos displayed in the scrolling marquee after the reels section.', 'sarmadgardezi'); ?>
        </p>

        <?php if (isset($_GET['saved']) && $_GET['saved'] === '1') : ?>
            <div class="notice notice-success is-dismissible" style="margin-bottom: 20px;">
                <p><strong><?php esc_html_e('Brands Marquee settings saved successfully!', 'sarmadgardezi'); ?></strong></p>
            </div>
        <?php endif; ?>

        <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" style="background: #ffffff; padding: 24px; border-radius: 12px; border: 1px solid #e2e8f0; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
            <input type="hidden" name="action" value="sarmadgardezi_save_brands" />
            <?php wp_nonce_field('sarmadgardezi_brands_nonce_action', 'sarmadgardezi_brands_nonce'); ?>

            <div style="margin-bottom: 28px;">
                <label for="brands_section_title" style="display: block; font-weight: 700; font-size: 14px; color: #0f172a; margin-bottom: 6px;">
                    <?php esc_html_e('Section Heading Title', 'sarmadgardezi'); ?>
                </label>
                <input 
                    type="text" 
                    id="brands_section_title" 
                    name="brands_section_title" 
                    value="<?php echo esc_attr($section_title); ?>" 
                    style="width: 100%; max-width: 500px; padding: 8px 12px; border-radius: 6px; border: 1px solid #cbd5e1; font-size: 14px;"
                    placeholder="<?php esc_attr_e('Trusted by these amazing companies', 'sarmadgardezi'); ?>"
                />
            </div>

            <hr style="border: 0; border-top: 1px solid #e2e8f0; margin: 24px 0;" />

            <div>
                <label style="display: block; font-weight: 700; font-size: 15px; color: #0f172a; margin-bottom: 6px;">
                    <?php esc_html_e('Brand Logos List', 'sarmadgardezi'); ?>
                </label>
                <p class="description" style="margin-bottom: 16px; color: #64748b;">
                    <?php esc_html_e('Add company logos below (SVGs or transparent PNGs look best).', 'sarmadgardezi'); ?>
                </p>

                <div id="brands-repeater-container" style="display: flex; flex-direction: column; gap: 14px;">
                    <?php 
                    if (!empty($brand_logos)) :
                        foreach ($brand_logos as $idx => $item) :
                            $img_url  = is_array($item) ? ($item['url'] ?? $item['brand_logo'] ?? '') : '';
                            if (is_array($img_url) && !empty($img_url['url'])) {
                                $img_url = $img_url['url'];
                            }
                            $b_name   = is_array($item) ? ($item['name'] ?? $item['brand_name'] ?? '') : '';
                            $b_link   = is_array($item) ? ($item['link'] ?? $item['brand_url'] ?? '') : '';
                    ?>
                        <div class="brand-item-row" style="display: flex; flex-wrap: wrap; align-items: center; gap: 14px; background: #f8fafc; padding: 14px; border-radius: 8px; border: 1px solid #e2e8f0;">
                            <div class="brand-preview-wrap" style="width: 80px; height: 50px; background: #ffffff; border: 1px dashed #cbd5e1; border-radius: 6px; display: flex; align-items: center; justify-content: center; overflow: hidden; flex-shrink: 0;">
                                <?php if (!empty($img_url)) : ?>
                                    <img src="<?php echo esc_url($img_url); ?>" style="max-width: 100%; max-height: 100%; object-fit: contain;" />
                                <?php else : ?>
                                    <span style="font-size: 11px; color: #94a3b8;"><?php esc_html_e('No Logo', 'sarmadgardezi'); ?></span>
                                <?php endif; ?>
                            </div>

                            <input type="hidden" name="brand_logos[<?php echo esc_attr($idx); ?>][url]" class="brand-logo-url-input" value="<?php echo esc_attr($img_url); ?>" />

                            <button type="button" class="button button-secondary upload-brand-logo-btn" style="height: 36px;">
                                <?php esc_html_e('Upload / Select Logo', 'sarmadgardezi'); ?>
                            </button>

                            <div style="flex: 1; min-width: 160px;">
                                <input 
                                    type="text" 
                                    name="brand_logos[<?php echo esc_attr($idx); ?>][name]" 
                                    value="<?php echo esc_attr($b_name); ?>" 
                                    placeholder="<?php esc_attr_e('Brand Name', 'sarmadgardezi'); ?>"
                                    style="width: 100%; padding: 6px 10px; border-radius: 4px; border: 1px solid #cbd5e1;"
                                />
                            </div>

                            <div style="flex: 1; min-width: 180px;">
                                <input 
                                    type="url" 
                                    name="brand_logos[<?php echo esc_attr($idx); ?>][link]" 
                                    value="<?php echo esc_attr($b_link); ?>" 
                                    placeholder="<?php esc_attr_e('Website URL (Optional)', 'sarmadgardezi'); ?>"
                                    style="width: 100%; padding: 6px 10px; border-radius: 4px; border: 1px solid #cbd5e1;"
                                />
                            </div>

                            <button type="button" class="button button-link-delete remove-brand-row-btn" style="color: #ef4444; text-decoration: none; padding: 4px 8px;">
                                <?php esc_html_e('Remove', 'sarmadgardezi'); ?>
                            </button>
                        </div>
                    <?php 
                        endforeach;
                    endif;
                    ?>
                </div>

                <div style="margin-top: 16px;">
                    <button type="button" id="add-brand-row-btn" class="button button-secondary" style="height: 36px; display: inline-flex; align-items: center; gap: 6px; font-weight: 600;">
                        <span class="dashicons dashicons-plus-alt2"></span>
                        <?php esc_html_e('+ Add Brand Logo', 'sarmadgardezi'); ?>
                    </button>
                </div>
            </div>

            <div style="margin-top: 32px; padding-top: 20px; border-top: 1px solid #e2e8f0;">
                <button type="submit" class="button button-primary button-large" style="padding: 0 24px; height: 42px; font-size: 15px; font-weight: 600;">
                    <?php esc_html_e('Save Changes', 'sarmadgardezi'); ?>
                </button>
            </div>
        </form>
    </div>

    <template id="brand-row-template">
        <div class="brand-item-row" style="display: flex; flex-wrap: wrap; align-items: center; gap: 14px; background: #f8fafc; padding: 14px; border-radius: 8px; border: 1px solid #e2e8f0;">
            <div class="brand-preview-wrap" style="width: 80px; height: 50px; background: #ffffff; border: 1px dashed #cbd5e1; border-radius: 6px; display: flex; align-items: center; justify-content: center; overflow: hidden; flex-shrink: 0;">
                <span style="font-size: 11px; color: #94a3b8;"><?php esc_html_e('No Logo', 'sarmadgardezi'); ?></span>
            </div>

            <input type="hidden" name="brand_logos[{{INDEX}}][url]" class="brand-logo-url-input" value="" />

            <button type="button" class="button button-secondary upload-brand-logo-btn" style="height: 36px;">
                <?php esc_html_e('Upload / Select Logo', 'sarmadgardezi'); ?>
            </button>

            <div style="flex: 1; min-width: 160px;">
                <input 
                    type="text" 
                    name="brand_logos[{{INDEX}}][name]" 
                    value="" 
                    placeholder="<?php esc_attr_e('Brand Name', 'sarmadgardezi'); ?>"
                    style="width: 100%; padding: 6px 10px; border-radius: 4px; border: 1px solid #cbd5e1;"
                />
            </div>

            <div style="flex: 1; min-width: 180px;">
                <input 
                    type="url" 
                    name="brand_logos[{{INDEX}}][link]" 
                    value="" 
                    placeholder="<?php esc_attr_e('Website URL (Optional)', 'sarmadgardezi'); ?>"
                    style="width: 100%; padding: 6px 10px; border-radius: 4px; border: 1px solid #cbd5e1;"
                />
            </div>

            <button type="button" class="button button-link-delete remove-brand-row-btn" style="color: #ef4444; text-decoration: none; padding: 4px 8px;">
                <?php esc_html_e('Remove', 'sarmadgardezi'); ?>
            </button>
        </div>
    </template>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var container = document.getElementById('brands-repeater-container');
        var addBtn    = document.getElementById('add-brand-row-btn');
        var template  = document.getElementById('brand-row-template');

        if (!container || !addBtn || !template) return;

        var rowCount = container.querySelectorAll('.brand-item-row').length;

        addBtn.addEventListener('click', function() {
            var html = template.innerHTML.replace(/{{INDEX}}/g, rowCount++);
            var tempDiv = document.createElement('div');
            tempDiv.innerHTML = html.trim();
            container.appendChild(tempDiv.firstChild);
        });

        container.addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('remove-brand-row-btn')) {
                e.preventDefault();
                var row = e.target.closest('.brand-item-row');
                if (row) row.remove();
            }

            if (e.target && e.target.classList.contains('upload-brand-logo-btn')) {
                e.preventDefault();
                var row = e.target.closest('.brand-item-row');
                if (!row) return;

                var hiddenInput = row.querySelector('.brand-logo-url-input');
                var previewWrap = row.querySelector('.brand-preview-wrap');
                var nameInput   = row.querySelector('input[type="text"]');

                var mediaFrame = wp.media({
                    title: '<?php echo esc_js(__('Select or Upload Brand Logo', 'sarmadgardezi')); ?>',
                    button: { text: '<?php echo esc_js(__('Use This Logo', 'sarmadgardezi')); ?>' },
                    multiple: false
                });

                mediaFrame.on('select', function() {
                    var attachment = mediaFrame.state().get('selection').first().toJSON();
                    if (attachment && attachment.url) {
                        hiddenInput.value = attachment.url;
                        previewWrap.innerHTML = '<img src="' + attachment.url + '" style="max-width: 100%; max-height: 100%; object-fit: contain;" />';
                        if (nameInput && !nameInput.value && attachment.title) {
                            nameInput.value = attachment.title;
                        }
                    }
                });

                mediaFrame.open();
            }
        });
    });
    </script>
    <?php
}

/**
 * --------------------------------------------------------------------------
 * PORTFOLIO STACKING CARDS MANAGER ("HOW WE GROW YOU")
 * --------------------------------------------------------------------------
 */

add_action('admin_post_sarmadgardezi_save_portfolio', 'sarmadgardezi_save_portfolio_settings');
function sarmadgardezi_save_portfolio_settings() {
    if (!current_user_can('edit_theme_options')) {
        wp_die(__('Unauthorized action.', 'sarmadgardezi'));
    }

    check_admin_referer('sarmadgardezi_portfolio_nonce_action', 'sarmadgardezi_portfolio_nonce');

    $section_title = isset($_POST['portfolio_section_title']) ? sanitize_text_field($_POST['portfolio_section_title']) : '';
    $raw_cards     = isset($_POST['portfolio_cards']) && is_array($_POST['portfolio_cards']) ? $_POST['portfolio_cards'] : array();

    $clean_cards = array();
    foreach ($raw_cards as $c) {
        $title      = !empty($c['title']) ? sanitize_text_field($c['title']) : '';
        $desc       = !empty($c['desc']) ? sanitize_textarea_field($c['desc']) : '';
        $color      = !empty($c['color']) ? sanitize_text_field($c['color']) : 'blue';
        $icon       = !empty($c['icon']) ? sanitize_text_field($c['icon']) : 'video';
        $pills      = !empty($c['pills']) ? sanitize_textarea_field($c['pills']) : '';
        $metric_val = !empty($c['metric_val']) ? sanitize_text_field($c['metric_val']) : '';
        $metric_lbl = !empty($c['metric_lbl']) ? sanitize_text_field($c['metric_lbl']) : '';
        $image      = !empty($c['image']) ? esc_url_raw($c['image']) : '';
        $link       = !empty($c['link']) ? esc_url_raw($c['link']) : '';

        if (!empty($title) || !empty($desc) || !empty($image)) {
            $clean_cards[] = array(
                'title'      => $title,
                'desc'       => $desc,
                'color'      => $color,
                'icon'       => $icon,
                'pills'      => $pills,
                'metric_val' => $metric_val,
                'metric_lbl' => $metric_lbl,
                'image'      => $image,
                'link'       => $link,
            );
        }
    }

    update_option('portfolio_section_title', $section_title);
    update_option('portfolio_cards', $clean_cards);
    update_option('sarmadgardezi_portfolio_settings', array(
        'title' => $section_title,
        'cards' => $clean_cards,
    ));

    $front_id = get_option('page_on_front');
    if ($front_id) {
        update_post_meta($front_id, '_portfolio_section_title', $section_title);
        update_post_meta($front_id, '_portfolio_cards', $clean_cards);
    }

    wp_safe_redirect(add_query_arg(array('page' => 'sarmadgardezi-portfolio', 'saved' => '1'), admin_url('admin.php')));
    exit;
}

function sarmadgardezi_render_portfolio_admin_page() {
    $section_title = get_option('portfolio_section_title', 'HOW WE GROW YOU');
    $portfolio_cards = get_option('portfolio_cards', array());
    if (!is_array($portfolio_cards)) {
        $portfolio_cards = array();
    }
    ?>
    <div class="wrap" style="max-width: 980px; margin-top: 24px;">
        <h1 style="display:flex; align-items:center; gap: 10px; font-size: 24px; margin-bottom: 8px;">
            <span class="dashicons dashicons-welcome-widgets-menus" style="font-size:28px; width:28px; height:28px;"></span>
            <?php esc_html_e('Portfolio Stacking Cards ("HOW WE GROW YOU")', 'sarmadgardezi'); ?>
        </h1>
        <p style="color: #64748b; font-size: 14px; margin-bottom: 24px;">
            <?php esc_html_e('Manage the 3 Google-colored cards that stack on top of each other as the user scrolls. If empty, default showcase cards will be displayed.', 'sarmadgardezi'); ?>
        </p>

        <?php if (isset($_GET['saved']) && $_GET['saved'] === '1') : ?>
            <div class="notice notice-success is-dismissible" style="margin-bottom: 20px;">
                <p><strong><?php esc_html_e('Portfolio Cards settings saved successfully!', 'sarmadgardezi'); ?></strong></p>
            </div>
        <?php endif; ?>

        <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" style="background: #ffffff; padding: 24px; border-radius: 12px; border: 1px solid #e2e8f0; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
            <input type="hidden" name="action" value="sarmadgardezi_save_portfolio" />
            <?php wp_nonce_field('sarmadgardezi_portfolio_nonce_action', 'sarmadgardezi_portfolio_nonce'); ?>

            <div style="margin-bottom: 28px;">
                <label for="portfolio_section_title" style="display: block; font-weight: 700; font-size: 14px; color: #0f172a; margin-bottom: 6px;">
                    <?php esc_html_e('Section Heading Title', 'sarmadgardezi'); ?>
                </label>
                <input 
                    type="text" 
                    id="portfolio_section_title" 
                    name="portfolio_section_title" 
                    value="<?php echo esc_attr($section_title); ?>" 
                    style="width: 100%; max-width: 500px; padding: 8px 12px; border-radius: 6px; border: 1px solid #cbd5e1; font-size: 14px; font-weight: 600;"
                    placeholder="HOW WE GROW YOU"
                />
            </div>

            <hr style="border: 0; border-top: 1px solid #e2e8f0; margin: 24px 0;" />

            <div>
                <label style="display: block; font-weight: 700; font-size: 16px; color: #0f172a; margin-bottom: 6px;">
                    <?php esc_html_e('Stacking Cards List (Max 3 Recommended)', 'sarmadgardezi'); ?>
                </label>
                <p class="description" style="margin-bottom: 20px; color: #64748b;">
                    <?php esc_html_e('Each card stacks sticky on scroll with customizable Google background colors, feature pills, metrics, and visual images.', 'sarmadgardezi'); ?>
                </p>

                <div id="portfolio-cards-container" style="display: flex; flex-direction: column; gap: 20px;">
                    <?php 
                    if (!empty($portfolio_cards)) :
                        foreach ($portfolio_cards as $idx => $card) :
                            $c_title  = $card['title'] ?? '';
                            $c_desc   = $card['desc'] ?? '';
                            $c_color  = $card['color'] ?? 'blue';
                            $c_icon   = $card['icon'] ?? 'video';
                            $c_pills  = $card['pills'] ?? '';
                            $c_mval   = $card['metric_val'] ?? '';
                            $c_mlbl   = $card['metric_lbl'] ?? '';
                            $c_img    = $card['image'] ?? '';
                            $c_link   = $card['link'] ?? '';
                    ?>
                        <div class="portfolio-card-item" style="background: #f8fafc; padding: 20px; border-radius: 10px; border: 1px solid #cbd5e1;">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 14px;">
                                <strong style="font-size: 15px; color: #0f172a;"><?php echo esc_html(sprintf(__('Card #%d: %s', 'sarmadgardezi'), $idx + 1, !empty($c_title) ? $c_title : __('Untitled Card', 'sarmadgardezi'))); ?></strong>
                                <button type="button" class="button button-link-delete remove-portfolio-card-btn" style="color: #ef4444; text-decoration: none;">
                                    <?php esc_html_e('Remove Card', 'sarmadgardezi'); ?>
                                </button>
                            </div>

                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
                                <div>
                                    <label style="display:block; font-weight:600; margin-bottom:4px; font-size:13px;"><?php esc_html_e('Card Title', 'sarmadgardezi'); ?></label>
                                    <input type="text" name="portfolio_cards[<?php echo esc_attr($idx); ?>][title]" value="<?php echo esc_attr($c_title); ?>" placeholder="e.g. UGC video production" style="width: 100%;" />
                                </div>
                                <div>
                                    <label style="display:block; font-weight:600; margin-bottom:4px; font-size:13px;"><?php esc_html_e('Google Color Theme', 'sarmadgardezi'); ?></label>
                                    <select name="portfolio_cards[<?php echo esc_attr($idx); ?>][color]" style="width: 100%;">
                                        <option value="blue" <?php selected($c_color, 'blue'); ?>><?php esc_html_e('Google Blue (#549dfb)', 'sarmadgardezi'); ?></option>
                                        <option value="pink" <?php selected($c_color, 'pink'); ?>><?php esc_html_e('Google Pink / Coral (#ff85a2)', 'sarmadgardezi'); ?></option>
                                        <option value="green" <?php selected($c_color, 'green'); ?>><?php esc_html_e('Google Green (#4ade80)', 'sarmadgardezi'); ?></option>
                                        <option value="yellow" <?php selected($c_color, 'yellow'); ?>><?php esc_html_e('Google Yellow / Amber (#fcd34d)', 'sarmadgardezi'); ?></option>
                                        <option value="purple" <?php selected($c_color, 'purple'); ?>><?php esc_html_e('Google Purple (#a78bfa)', 'sarmadgardezi'); ?></option>
                                        <option value="dark" <?php selected($c_color, 'dark'); ?>><?php esc_html_e('Dark Obsidian (#111827)', 'sarmadgardezi'); ?></option>
                                    </select>
                                </div>
                                <div style="grid-column: 1 / -1;">
                                    <label style="display:block; font-weight:600; margin-bottom:4px; font-size:13px;"><?php esc_html_e('Card Description', 'sarmadgardezi'); ?></label>
                                    <textarea name="portfolio_cards[<?php echo esc_attr($idx); ?>][desc]" rows="2" style="width: 100%;"><?php echo esc_textarea($c_desc); ?></textarea>
                                </div>
                                <div>
                                    <label style="display:block; font-weight:600; margin-bottom:4px; font-size:13px;"><?php esc_html_e('Top Corner Icon', 'sarmadgardezi'); ?></label>
                                    <select name="portfolio_cards[<?php echo esc_attr($idx); ?>][icon]" style="width: 100%;">
                                        <option value="video" <?php selected($c_icon, 'video'); ?>><?php esc_html_e('Video Camera (UGC / Media)', 'sarmadgardezi'); ?></option>
                                        <option value="user" <?php selected($c_icon, 'user'); ?>><?php esc_html_e('User / Community (Strategy)', 'sarmadgardezi'); ?></option>
                                        <option value="chart" <?php selected($c_icon, 'chart'); ?>><?php esc_html_e('Chart / Analytics (Scaling)', 'sarmadgardezi'); ?></option>
                                        <option value="cloud" <?php selected($c_icon, 'cloud'); ?>><?php esc_html_e('Cloud / Architecture', 'sarmadgardezi'); ?></option>
                                        <option value="spark" <?php selected($c_icon, 'spark'); ?>><?php esc_html_e('Sparkle / AI Multimodal', 'sarmadgardezi'); ?></option>
                                        <option value="code" <?php selected($c_icon, 'code'); ?>><?php esc_html_e('Code / Terminal', 'sarmadgardezi'); ?></option>
                                    </select>
                                </div>
                                <div>
                                    <label style="display:block; font-weight:600; margin-bottom:4px; font-size:13px;"><?php esc_html_e('Feature Checkmark Pills (comma separated)', 'sarmadgardezi'); ?></label>
                                    <input type="text" name="portfolio_cards[<?php echo esc_attr($idx); ?>][pills]" value="<?php echo esc_attr($c_pills); ?>" placeholder="Creator sourcing, Full brief included, Unlimited revisions" style="width: 100%;" />
                                </div>
                                <div>
                                    <label style="display:block; font-weight:600; margin-bottom:4px; font-size:13px;"><?php esc_html_e('Big Metric Number (e.g. 1,200+)', 'sarmadgardezi'); ?></label>
                                    <input type="text" name="portfolio_cards[<?php echo esc_attr($idx); ?>][metric_val]" value="<?php echo esc_attr($c_mval); ?>" placeholder="1,200+" style="width: 100%;" />
                                </div>
                                <div>
                                    <label style="display:block; font-weight:600; margin-bottom:4px; font-size:13px;"><?php esc_html_e('Metric Label (e.g. Videos delivered)', 'sarmadgardezi'); ?></label>
                                    <input type="text" name="portfolio_cards[<?php echo esc_attr($idx); ?>][metric_lbl]" value="<?php echo esc_attr($c_mlbl); ?>" placeholder="Videos delivered" style="width: 100%;" />
                                </div>
                                <div>
                                    <label style="display:block; font-weight:600; margin-bottom:4px; font-size:13px;"><?php esc_html_e('Card Image / Screenshot', 'sarmadgardezi'); ?></label>
                                    <div style="display:flex; align-items:center; gap: 10px;">
                                        <div class="card-preview-thumb" style="width: 60px; height: 45px; background: #fff; border: 1px dashed #cbd5e1; border-radius: 4px; overflow: hidden; display: flex; align-items: center; justify-content: center;">
                                            <?php if (!empty($c_img)) : ?>
                                                <img src="<?php echo esc_url($c_img); ?>" style="max-width:100%; max-height:100%; object-fit:cover;" />
                                            <?php else : ?>
                                                <span style="font-size:10px; color:#94a3b8;"><?php esc_html_e('No Img', 'sarmadgardezi'); ?></span>
                                            <?php endif; ?>
                                        </div>
                                        <input type="hidden" name="portfolio_cards[<?php echo esc_attr($idx); ?>][image]" class="portfolio-card-img-input" value="<?php echo esc_attr($c_img); ?>" />
                                        <button type="button" class="button button-secondary upload-card-img-btn"><?php esc_html_e('Upload Image', 'sarmadgardezi'); ?></button>
                                    </div>
                                </div>
                                <div>
                                    <label style="display:block; font-weight:600; margin-bottom:4px; font-size:13px;"><?php esc_html_e('Project Link URL', 'sarmadgardezi'); ?></label>
                                    <input type="url" name="portfolio_cards[<?php echo esc_attr($idx); ?>][link]" value="<?php echo esc_attr($c_link); ?>" placeholder="https://..." style="width: 100%;" />
                                </div>
                            </div>
                        </div>
                    <?php 
                        endforeach;
                    endif;
                    ?>
                </div>

                <div style="margin-top: 18px;">
                    <button type="button" id="add-portfolio-card-btn" class="button button-secondary" style="height: 38px; display: inline-flex; align-items: center; gap: 6px; font-weight: 600;">
                        <span class="dashicons dashicons-plus-alt2"></span>
                        <?php esc_html_e('+ Add Stacking Card', 'sarmadgardezi'); ?>
                    </button>
                </div>
            </div>

            <div style="margin-top: 32px; padding-top: 20px; border-top: 1px solid #e2e8f0;">
                <button type="submit" class="button button-primary button-large" style="padding: 0 24px; height: 42px; font-size: 15px; font-weight: 600;">
                    <?php esc_html_e('Save Changes', 'sarmadgardezi'); ?>
                </button>
            </div>
        </form>
    </div>

    <template id="portfolio-card-template">
        <div class="portfolio-card-item" style="background: #f8fafc; padding: 20px; border-radius: 10px; border: 1px solid #cbd5e1;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 14px;">
                <strong style="font-size: 15px; color: #0f172a;"><?php esc_html_e('New Stacking Card', 'sarmadgardezi'); ?></strong>
                <button type="button" class="button button-link-delete remove-portfolio-card-btn" style="color: #ef4444; text-decoration: none;">
                    <?php esc_html_e('Remove Card', 'sarmadgardezi'); ?>
                </button>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
                <div>
                    <label style="display:block; font-weight:600; margin-bottom:4px; font-size:13px;"><?php esc_html_e('Card Title', 'sarmadgardezi'); ?></label>
                    <input type="text" name="portfolio_cards[{{INDEX}}][title]" value="" placeholder="e.g. UGC video production" style="width: 100%;" />
                </div>
                <div>
                    <label style="display:block; font-weight:600; margin-bottom:4px; font-size:13px;"><?php esc_html_e('Google Color Theme', 'sarmadgardezi'); ?></label>
                    <select name="portfolio_cards[{{INDEX}}][color]" style="width: 100%;">
                        <option value="blue"><?php esc_html_e('Google Blue (#549dfb)', 'sarmadgardezi'); ?></option>
                        <option value="pink"><?php esc_html_e('Google Pink / Coral (#ff85a2)', 'sarmadgardezi'); ?></option>
                        <option value="green"><?php esc_html_e('Google Green (#4ade80)', 'sarmadgardezi'); ?></option>
                        <option value="yellow"><?php esc_html_e('Google Yellow / Amber (#fcd34d)', 'sarmadgardezi'); ?></option>
                        <option value="purple"><?php esc_html_e('Google Purple (#a78bfa)', 'sarmadgardezi'); ?></option>
                        <option value="dark"><?php esc_html_e('Dark Obsidian (#111827)', 'sarmadgardezi'); ?></option>
                    </select>
                </div>
                <div style="grid-column: 1 / -1;">
                    <label style="display:block; font-weight:600; margin-bottom:4px; font-size:13px;"><?php esc_html_e('Card Description', 'sarmadgardezi'); ?></label>
                    <textarea name="portfolio_cards[{{INDEX}}][desc]" rows="2" style="width: 100%;"></textarea>
                </div>
                <div>
                    <label style="display:block; font-weight:600; margin-bottom:4px; font-size:13px;"><?php esc_html_e('Top Corner Icon', 'sarmadgardezi'); ?></label>
                    <select name="portfolio_cards[{{INDEX}}][icon]" style="width: 100%;">
                        <option value="video"><?php esc_html_e('Video Camera (UGC / Media)', 'sarmadgardezi'); ?></option>
                        <option value="user"><?php esc_html_e('User / Community (Strategy)', 'sarmadgardezi'); ?></option>
                        <option value="chart"><?php esc_html_e('Chart / Analytics (Scaling)', 'sarmadgardezi'); ?></option>
                        <option value="cloud"><?php esc_html_e('Cloud / Architecture', 'sarmadgardezi'); ?></option>
                        <option value="spark"><?php esc_html_e('Sparkle / AI Multimodal', 'sarmadgardezi'); ?></option>
                        <option value="code"><?php esc_html_e('Code / Terminal', 'sarmadgardezi'); ?></option>
                    </select>
                </div>
                <div>
                    <label style="display:block; font-weight:600; margin-bottom:4px; font-size:13px;"><?php esc_html_e('Feature Checkmark Pills (comma separated)', 'sarmadgardezi'); ?></label>
                    <input type="text" name="portfolio_cards[{{INDEX}}][pills]" value="" placeholder="Creator sourcing, Full brief included, Unlimited revisions" style="width: 100%;" />
                </div>
                <div>
                    <label style="display:block; font-weight:600; margin-bottom:4px; font-size:13px;"><?php esc_html_e('Big Metric Number (e.g. 1,200+)', 'sarmadgardezi'); ?></label>
                    <input type="text" name="portfolio_cards[{{INDEX}}][metric_val]" value="" placeholder="1,200+" style="width: 100%;" />
                </div>
                <div>
                    <label style="display:block; font-weight:600; margin-bottom:4px; font-size:13px;"><?php esc_html_e('Metric Label (e.g. Videos delivered)', 'sarmadgardezi'); ?></label>
                    <input type="text" name="portfolio_cards[{{INDEX}}][metric_lbl]" value="" placeholder="Videos delivered" style="width: 100%;" />
                </div>
                <div>
                    <label style="display:block; font-weight:600; margin-bottom:4px; font-size:13px;"><?php esc_html_e('Card Image / Screenshot', 'sarmadgardezi'); ?></label>
                    <div style="display:flex; align-items:center; gap: 10px;">
                        <div class="card-preview-thumb" style="width: 60px; height: 45px; background: #fff; border: 1px dashed #cbd5e1; border-radius: 4px; overflow: hidden; display: flex; align-items: center; justify-content: center;">
                            <span style="font-size:10px; color:#94a3b8;"><?php esc_html_e('No Img', 'sarmadgardezi'); ?></span>
                        </div>
                        <input type="hidden" name="portfolio_cards[{{INDEX}}][image]" class="portfolio-card-img-input" value="" />
                        <button type="button" class="button button-secondary upload-card-img-btn"><?php esc_html_e('Upload Image', 'sarmadgardezi'); ?></button>
                    </div>
                </div>
                <div>
                    <label style="display:block; font-weight:600; margin-bottom:4px; font-size:13px;"><?php esc_html_e('Project Link URL', 'sarmadgardezi'); ?></label>
                    <input type="url" name="portfolio_cards[{{INDEX}}][link]" value="" placeholder="https://..." style="width: 100%;" />
                </div>
            </div>
        </div>
    </template>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var container = document.getElementById('portfolio-cards-container');
        var addBtn    = document.getElementById('add-portfolio-card-btn');
        var template  = document.getElementById('portfolio-card-template');

        if (!container || !addBtn || !template) return;

        var cardCount = container.querySelectorAll('.portfolio-card-item').length;

        addBtn.addEventListener('click', function() {
            var html = template.innerHTML.replace(/{{INDEX}}/g, cardCount++);
            var tempDiv = document.createElement('div');
            tempDiv.innerHTML = html.trim();
            container.appendChild(tempDiv.firstChild);
        });

        container.addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('remove-portfolio-card-btn')) {
                e.preventDefault();
                var card = e.target.closest('.portfolio-card-item');
                if (card) card.remove();
            }

            if (e.target && e.target.classList.contains('upload-card-img-btn')) {
                e.preventDefault();
                var card = e.target.closest('.portfolio-card-item');
                if (!card) return;

                var hiddenInput = card.querySelector('.portfolio-card-img-input');
                var previewWrap = card.querySelector('.card-preview-thumb');

                var mediaFrame = wp.media({
                    title: '<?php echo esc_js(__('Select or Upload Project Image', 'sarmadgardezi')); ?>',
                    button: { text: '<?php echo esc_js(__('Use This Image', 'sarmadgardezi')); ?>' },
                    multiple: false
                });

                mediaFrame.on('select', function() {
                    var attachment = mediaFrame.state().get('selection').first().toJSON();
                    if (attachment && attachment.url) {
                        hiddenInput.value = attachment.url;
                        previewWrap.innerHTML = '<img src="' + attachment.url + '" style="max-width: 100%; max-height: 100%; object-fit: cover;" />';
                    }
                });

                mediaFrame.open();
            }
        });
    });
    </script>
    <?php
}

/**
 * --------------------------------------------------------------------------
 * FRONT PAGE NATIVE META BOXES
 * --------------------------------------------------------------------------
 */

add_action('add_meta_boxes', 'sarmadgardezi_register_frontpage_meta_boxes');
function sarmadgardezi_register_frontpage_meta_boxes() {
    global $post;
    if (!$post) return;

    $front_id = get_option('page_on_front');
    if ((int)$post->ID === (int)$front_id || get_page_template_slug($post->ID) === 'front-page.php') {
        add_meta_box(
            'sarmadgardezi_portfolio_quick_meta',
            __('Portfolio Stacking Cards ("HOW WE GROW YOU")', 'sarmadgardezi'),
            'sarmadgardezi_render_frontpage_portfolio_meta_box',
            'page',
            'normal',
            'high'
        );

        add_meta_box(
            'sarmadgardezi_brands_quick_meta',
            __('Brands & Companies Marquee', 'sarmadgardezi'),
            'sarmadgardezi_render_frontpage_brands_meta_box',
            'page',
            'normal',
            'high'
        );
    }
}

function sarmadgardezi_render_frontpage_portfolio_meta_box($post) {
    ?>
    <div style="padding: 12px 0;">
        <p style="font-size: 14px; margin-bottom: 14px; color: #475569;">
            <?php esc_html_e('Manage the 3 Google-colored cards that stack on top of each other as the user scrolls.', 'sarmadgardezi'); ?>
        </p>
        <a href="<?php echo esc_url(admin_url('admin.php?page=sarmadgardezi-portfolio')); ?>" class="button button-primary button-large" style="display:inline-flex; align-items:center; gap:6px;">
            <span class="dashicons dashicons-welcome-widgets-menus"></span>
            <?php esc_html_e('Open Portfolio Cards Manager', 'sarmadgardezi'); ?>
        </a>
    </div>
    <?php
}

function sarmadgardezi_render_frontpage_brands_meta_box($post) {
    ?>
    <div style="padding: 12px 0;">
        <p style="font-size: 14px; margin-bottom: 14px; color: #475569;">
            <?php esc_html_e('Manage and upload client logos directly from the dedicated Brands Marquee tab.', 'sarmadgardezi'); ?>
        </p>
        <a href="<?php echo esc_url(admin_url('admin.php?page=sarmadgardezi-brands')); ?>" class="button button-primary button-large" style="display:inline-flex; align-items:center; gap:6px;">
            <span class="dashicons dashicons-images-alt2"></span>
            <?php esc_html_e('Open Brands Marquee Manager', 'sarmadgardezi'); ?>
        </a>
    </div>
    <?php
}

/**
 * --------------------------------------------------------------------------
 * ACF PRO / FREE FIELD GROUPS REGISTRATION
 * --------------------------------------------------------------------------
 */

add_action('acf/init', 'sarmadgardezi_register_all_acf_field_groups');
function sarmadgardezi_register_all_acf_field_groups() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    static $registered = false;
    if ($registered) return;
    $registered = true;

    $front_page_id = get_option('page_on_front');

    $front_page_location = array(
        array(
            array(
                'param' => 'page_type',
                'operator' => '==',
                'value' => 'front_page',
            ),
        ),
        array(
            array(
                'param' => 'page_template',
                'operator' => '==',
                'value' => 'front-page.php',
            ),
        ),
    );

    if ($front_page_id) {
        $front_page_location[] = array(
            array(
                'param' => 'post',
                'operator' => '==',
                'value' => (string) $front_page_id,
            ),
        );
    }

    // 1. Brands Marquee ACF Field Group
    acf_add_local_field_group(array(
        'key' => 'group_sarmadgardezi_brands_marquee',
        'title' => __('Brands & Companies Marquee', 'sarmadgardezi'),
        'fields' => array(
            array(
                'key' => 'field_brands_section_title',
                'label' => __('Section Title / Heading', 'sarmadgardezi'),
                'name' => 'brands_section_title',
                'type' => 'text',
                'default_value' => 'Trusted by these amazing companies',
                'placeholder' => 'Trusted by these amazing companies',
            ),
            array(
                'key' => 'field_brand_logos',
                'label' => __('Brand Logos', 'sarmadgardezi'),
                'name' => 'brand_logos',
                'type' => 'repeater',
                'layout' => 'table',
                'button_label' => __('+ Add Brand Logo', 'sarmadgardezi'),
                'sub_fields' => array(
                    array(
                        'key' => 'field_brand_logo',
                        'label' => __('Logo Image', 'sarmadgardezi'),
                        'name' => 'brand_logo',
                        'type' => 'image',
                        'required' => 1,
                        'return_format' => 'array',
                        'preview_size' => 'medium',
                    ),
                    array(
                        'key' => 'field_brand_name',
                        'label' => __('Brand Name', 'sarmadgardezi'),
                        'name' => 'brand_name',
                        'type' => 'text',
                    ),
                    array(
                        'key' => 'field_brand_url',
                        'label' => __('Website URL (Optional)', 'sarmadgardezi'),
                        'name' => 'brand_url',
                        'type' => 'url',
                    ),
                ),
            ),
        ),
        'location' => $front_page_location,
        'menu_order' => 5,
        'position' => 'normal',
        'style' => 'default',
    ));

    // 2. Portfolio Stacking Cards ACF Field Group on Front Page
    acf_add_local_field_group(array(
        'key' => 'group_sarmadgardezi_portfolio_stack',
        'title' => __('Front Page — Portfolio Stacking Cards (HOW WE GROW YOU)', 'sarmadgardezi'),
        'fields' => array(
            array(
                'key' => 'field_portfolio_section_title',
                'label' => __('Section Main Heading', 'sarmadgardezi'),
                'name' => 'portfolio_section_title',
                'type' => 'text',
                'default_value' => 'HOW WE GROW YOU',
                'placeholder' => 'HOW WE GROW YOU',
            ),
            array(
                'key' => 'field_portfolio_cards',
                'label' => __('Stacking Portfolio Cards (Max 3)', 'sarmadgardezi'),
                'name' => 'portfolio_cards',
                'type' => 'repeater',
                'layout' => 'block',
                'button_label' => __('+ Add Portfolio Card', 'sarmadgardezi'),
                'sub_fields' => array(
                    array(
                        'key' => 'field_card_title',
                        'label' => __('Card Title', 'sarmadgardezi'),
                        'name' => 'title',
                        'type' => 'text',
                        'placeholder' => 'e.g. UGC video production',
                        'required' => 1,
                    ),
                    array(
                        'key' => 'field_card_color',
                        'label' => __('Card Color Theme (Google Colors)', 'sarmadgardezi'),
                        'name' => 'color',
                        'type' => 'select',
                        'choices' => array(
                            'blue'   => 'Google Blue (#549dfb)',
                            'pink'   => 'Google Pink / Coral (#ff85a2)',
                            'green'  => 'Google Green (#4ade80)',
                            'yellow' => 'Google Yellow / Amber (#fcd34d)',
                            'purple' => 'Google Purple (#a78bfa)',
                            'dark'   => 'Dark Obsidian (#111827)',
                        ),
                        'default_value' => 'blue',
                    ),
                    array(
                        'key' => 'field_card_desc',
                        'label' => __('Card Description Narrative', 'sarmadgardezi'),
                        'name' => 'desc',
                        'type' => 'textarea',
                        'rows' => 3,
                    ),
                    array(
                        'key' => 'field_card_icon',
                        'label' => __('Top Corner Icon Badge', 'sarmadgardezi'),
                        'name' => 'icon',
                        'type' => 'select',
                        'choices' => array(
                            'video' => 'Video Camera (UGC / Media)',
                            'user'  => 'User / Community (Strategy)',
                            'chart' => 'Chart / Growth (Scaling)',
                            'cloud' => 'Cloud / Architecture',
                            'spark' => 'Sparkle / AI Multimodal',
                            'code'  => 'Code / Terminal',
                        ),
                        'default_value' => 'video',
                    ),
                    array(
                        'key' => 'field_card_pills',
                        'label' => __('Feature Checkmark Pills (comma separated)', 'sarmadgardezi'),
                        'name' => 'pills',
                        'type' => 'textarea',
                        'rows' => 2,
                        'placeholder' => 'Creator sourcing, Full brief included, Unlimited revisions',
                    ),
                    array(
                        'key' => 'field_card_metric_val',
                        'label' => __('Big Metric Callout Number (e.g. 1,200+)', 'sarmadgardezi'),
                        'name' => 'metric_val',
                        'type' => 'text',
                        'placeholder' => '1,200+',
                    ),
                    array(
                        'key' => 'field_card_metric_lbl',
                        'label' => __('Metric Label (e.g. Videos delivered)', 'sarmadgardezi'),
                        'name' => 'metric_lbl',
                        'type' => 'text',
                        'placeholder' => 'Videos delivered',
                    ),
                    array(
                        'key' => 'field_card_image',
                        'label' => __('Card Visual Showcase Image', 'sarmadgardezi'),
                        'name' => 'image',
                        'type' => 'image',
                        'return_format' => 'url',
                        'preview_size' => 'medium',
                    ),
                    array(
                        'key' => 'field_card_link',
                        'label' => __('Project Link URL (Optional)', 'sarmadgardezi'),
                        'name' => 'link',
                        'type' => 'url',
                    ),
                ),
            ),
        ),
        'location' => $front_page_location,
        'menu_order' => 6,
        'position' => 'normal',
        'style' => 'default',
    ));

    // 3. Individual Project Post Type ACF Field Group
    acf_add_local_field_group(array(
        'key' => 'group_sarmadgardezi_project_details',
        'title' => __('Portfolio Card & Project Details', 'sarmadgardezi'),
        'fields' => array(
            array(
                'key' => 'field_project_featured',
                'label' => __('Feature in Homepage Portfolio Stack (Max 3)', 'sarmadgardezi'),
                'name' => 'project_featured',
                'type' => 'true_false',
                'ui' => 1,
                'default_value' => 1,
            ),
            array(
                'key' => 'field_project_card_color',
                'label' => __('Card Color Theme (Google Colors)', 'sarmadgardezi'),
                'name' => 'project_card_color',
                'type' => 'select',
                'choices' => array(
                    'blue'   => 'Google Blue (#549dfb)',
                    'pink'   => 'Google Pink / Coral (#ff85a2)',
                    'green'  => 'Google Green (#4ade80)',
                    'yellow' => 'Google Yellow / Amber (#fcd34d)',
                    'purple' => 'Google Purple (#a78bfa)',
                    'dark'   => 'Dark Obsidian (#111827)',
                ),
                'default_value' => 'blue',
            ),
            array(
                'key' => 'field_project_icon',
                'label' => __('Top Corner Icon Badge', 'sarmadgardezi'),
                'name' => 'project_icon',
                'type' => 'select',
                'choices' => array(
                    'video' => 'Video Camera (UGC / Media)',
                    'user'  => 'User / Community (Strategy)',
                    'chart' => 'Chart / Growth (Scaling)',
                    'cloud' => 'Cloud / Architecture',
                    'spark' => 'Sparkle / AI Multimodal',
                    'code'  => 'Code / Terminal',
                ),
                'default_value' => 'video',
            ),
            array(
                'key' => 'field_project_metric_val',
                'label' => __('Big Metric Callout (e.g. 1,200+ or 50M+ or 4.8x)', 'sarmadgardezi'),
                'name' => 'project_metric_val',
                'type' => 'text',
                'placeholder' => '1,200+',
            ),
            array(
                'key' => 'field_project_metric_lbl',
                'label' => __('Metric Label (e.g. Videos delivered / Organic views)', 'sarmadgardezi'),
                'name' => 'project_metric_lbl',
                'type' => 'text',
                'placeholder' => 'Videos delivered',
            ),
            array(
                'key' => 'field_project_pills',
                'label' => __('Feature Checkmark Pills (comma separated)', 'sarmadgardezi'),
                'name' => 'project_pills',
                'type' => 'textarea',
                'rows' => 2,
                'placeholder' => 'Creator sourcing, Full brief included, Unlimited revisions',
            ),
            array(
                'key' => 'field_project_live_url',
                'label' => __('Live Project URL', 'sarmadgardezi'),
                'name' => 'project_live_url',
                'type' => 'url',
            ),
            array(
                'key' => 'field_project_github_url',
                'label' => __('GitHub URL', 'sarmadgardezi'),
                'name' => 'project_github_url',
                'type' => 'url',
            ),
            array(
                'key' => 'field_project_role',
                'label' => __('Role', 'sarmadgardezi'),
                'name' => 'project_role',
                'type' => 'text',
            ),
            array(
                'key' => 'field_project_timeline',
                'label' => __('Timeline', 'sarmadgardezi'),
                'name' => 'project_timeline',
                'type' => 'text',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'project',
                ),
            ),
        ),
        'menu_order' => 10,
        'position' => 'normal',
        'style' => 'default',
    ));
}
