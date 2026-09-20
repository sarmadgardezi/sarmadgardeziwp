<?php
/**
 * Brands Marquee Admin Manager & ACF Field Groups Registration
 *
 * Provides a dedicated native WordPress Admin Settings page ("Brands Marquee")
 * with visual image upload via the WordPress Media Library, plus a native Front Page
 * Meta Box and ACF Pro / Free interoperability.
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;

/**
 * 1. Register Native Top-Level WP Admin Menu: "Brands Marquee"
 */
add_action('admin_menu', 'sarmadgardezi_register_brands_admin_menu');
function sarmadgardezi_register_brands_admin_menu() {
    add_menu_page(
        __('Brands Marquee Settings', 'sarmadgardezi'),
        __('Brands Marquee', 'sarmadgardezi'),
        'edit_theme_options',
        'sarmadgardezi-brands',
        'sarmadgardezi_render_brands_admin_page',
        'dashicons-images-alt2',
        23
    );
}

/**
 * 2. Enqueue Media Scripts on Brands Admin Page
 */
add_action('admin_enqueue_scripts', 'sarmadgardezi_brands_admin_scripts');
function sarmadgardezi_brands_admin_scripts($hook) {
    if ($hook === 'toplevel_page_sarmadgardezi-brands' || $hook === 'post.php' || $hook === 'post-new.php') {
        wp_enqueue_media();
    }
}

/**
 * 3. Handle Saving Settings from Native Brands Admin Page
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

    // Save to options
    update_option('brands_section_title', $section_title);
    update_option('brand_logos', $clean_logos);
    update_option('sarmadgardezi_brands_settings', array(
        'title' => $section_title,
        'logos' => $clean_logos,
    ));

    // If front page ID is set, also update front page meta
    $front_id = get_option('page_on_front');
    if ($front_id) {
        update_post_meta($front_id, '_brands_section_title', $section_title);
        update_post_meta($front_id, '_brand_logos', $clean_logos);
    }

    wp_safe_redirect(add_query_arg(array('page' => 'sarmadgardezi-brands', 'saved' => '1'), admin_url('admin.php')));
    exit;
}

/**
 * 4. Render Native Brands Admin Page
 */
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
            <?php esc_html_e('Manage the company logos displayed in the scrolling marquee after the reels section. If left empty, high-fidelity default logos will be displayed.', 'sarmadgardezi'); ?>
        </p>

        <?php if (isset($_GET['saved']) && $_GET['saved'] === '1') : ?>
            <div class="notice notice-success is-dismissible" style="margin-bottom: 20px;">
                <p><strong><?php esc_html_e('Brands Marquee settings saved successfully!', 'sarmadgardezi'); ?></strong></p>
            </div>
        <?php endif; ?>

        <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" style="background: #ffffff; padding: 24px; border-radius: 12px; border: 1px solid #e2e8f0; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
            <input type="hidden" name="action" value="sarmadgardezi_save_brands" />
            <?php wp_nonce_field('sarmadgardezi_brands_nonce_action', 'sarmadgardezi_brands_nonce'); ?>

            <!-- Section Title -->
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
                <p class="description" style="margin-top: 4px; color: #64748b;">
                    <?php esc_html_e('Displayed directly above the logos marquee.', 'sarmadgardezi'); ?>
                </p>
            </div>

            <hr style="border: 0; border-top: 1px solid #e2e8f0; margin: 24px 0;" />

            <!-- Brand Logos Repeater List -->
            <div>
                <label style="display: block; font-weight: 700; font-size: 15px; color: #0f172a; margin-bottom: 6px;">
                    <?php esc_html_e('Brand Logos List', 'sarmadgardezi'); ?>
                </label>
                <p class="description" style="margin-bottom: 16px; color: #64748b;">
                    <?php esc_html_e('Add your company logos below (SVGs or transparent PNGs look best).', 'sarmadgardezi'); ?>
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
                            <!-- Preview Box -->
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

                            <!-- Name -->
                            <div style="flex: 1; min-width: 160px;">
                                <input 
                                    type="text" 
                                    name="brand_logos[<?php echo esc_attr($idx); ?>][name]" 
                                    value="<?php echo esc_attr($b_name); ?>" 
                                    placeholder="<?php esc_attr_e('Brand Name (e.g. Clickl)', 'sarmadgardezi'); ?>"
                                    style="width: 100%; padding: 6px 10px; border-radius: 4px; border: 1px solid #cbd5e1;"
                                />
                            </div>

                            <!-- Website URL -->
                            <div style="flex: 1; min-width: 180px;">
                                <input 
                                    type="url" 
                                    name="brand_logos[<?php echo esc_attr($idx); ?>][link]" 
                                    value="<?php echo esc_attr($b_link); ?>" 
                                    placeholder="<?php esc_attr_e('Website URL (Optional)', 'sarmadgardezi'); ?>"
                                    style="width: 100%; padding: 6px 10px; border-radius: 4px; border: 1px solid #cbd5e1;"
                                />
                            </div>

                            <!-- Remove Button -->
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

            <div style="margin-top: 32px; padding-top: 20px; border-top: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: space-between;">
                <button type="submit" class="button button-primary button-large" style="padding: 0 24px; height: 42px; font-size: 15px; font-weight: 600;">
                    <?php esc_html_e('Save Changes', 'sarmadgardezi'); ?>
                </button>
            </div>
        </form>
    </div>

    <!-- Template for JS row clone -->
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
                    placeholder="<?php esc_attr_e('Brand Name (e.g. Clickl)', 'sarmadgardezi'); ?>"
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
            var newRow = tempDiv.firstChild;
            container.appendChild(newRow);
        });

        container.addEventListener('click', function(e) {
            // Remove button
            if (e.target && e.target.classList.contains('remove-brand-row-btn')) {
                e.preventDefault();
                var row = e.target.closest('.brand-item-row');
                if (row) row.remove();
            }

            // Upload button
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
 * 5. Register Native Meta Box on Front Page
 */
add_action('add_meta_boxes', 'sarmadgardezi_register_frontpage_brands_meta_box');
function sarmadgardezi_register_frontpage_brands_meta_box() {
    global $post;
    if (!$post) return;

    $front_id = get_option('page_on_front');
    if ((int)$post->ID === (int)$front_id || get_page_template_slug($post->ID) === 'front-page.php') {
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

function sarmadgardezi_render_frontpage_brands_meta_box($post) {
    ?>
    <div style="padding: 12px 0;">
        <p style="font-size: 14px; margin-bottom: 14px;">
            <?php esc_html_e('You can manage and upload the Brand Logos directly from the dedicated Brands Marquee tab.', 'sarmadgardezi'); ?>
        </p>
        <a href="<?php echo esc_url(admin_url('admin.php?page=sarmadgardezi-brands')); ?>" class="button button-primary button-large" style="display:inline-flex; align-items:center; gap:6px;">
            <span class="dashicons dashicons-images-alt2"></span>
            <?php esc_html_e('Open Brands Marquee Manager & Upload Logos', 'sarmadgardezi'); ?>
        </a>
    </div>
    <?php
}

/**
 * 6. Register ACF Field Group if ACF Pro / Free is installed
 */
add_action('acf/init', 'sarmadgardezi_register_brands_acf_fields');
function sarmadgardezi_register_brands_acf_fields() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    static $registered = false;
    if ($registered) return;
    $registered = true;

    $front_page_id = get_option('page_on_front');

    $location_rules = array(
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
        $location_rules[] = array(
            array(
                'param' => 'post',
                'operator' => '==',
                'value' => (string) $front_page_id,
            ),
        );
    }

    acf_add_local_field_group(array(
        'key' => 'group_sarmadgardezi_brands_marquee',
        'title' => __('Brands & Companies Marquee', 'sarmadgardezi'),
        'fields' => array(
            array(
                'key' => 'field_brands_section_title',
                'label' => __('Section Title / Heading', 'sarmadgardezi'),
                'name' => 'brands_section_title',
                'type' => 'text',
                'instructions' => __('Heading displayed above scrolling logos.', 'sarmadgardezi'),
                'required' => 0,
                'default_value' => 'Trusted by these amazing companies',
                'placeholder' => 'Trusted by these amazing companies',
            ),
            array(
                'key' => 'field_brand_logos',
                'label' => __('Brand Logos', 'sarmadgardezi'),
                'name' => 'brand_logos',
                'type' => 'repeater',
                'instructions' => __('Upload brand logos. If empty, default logos are displayed.', 'sarmadgardezi'),
                'required' => 0,
                'collapsed' => 'field_brand_name',
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
                        'required' => 0,
                        'placeholder' => 'e.g. Clickl',
                    ),
                    array(
                        'key' => 'field_brand_url',
                        'label' => __('Website URL (Optional)', 'sarmadgardezi'),
                        'name' => 'brand_url',
                        'type' => 'url',
                        'required' => 0,
                    ),
                ),
            ),
        ),
        'location' => $location_rules,
        'menu_order' => 5,
        'position' => 'normal',
        'style' => 'default',
    ));
}
