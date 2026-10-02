<?php
/**
 * Reservation & Booking Management Module
 *
 * Handles Cal.com-style meeting reservations, custom post type,
 * dynamic unread badge counters in WP Admin, ACF field groups,
 * and AJAX submission handlers with WhatsApp routing.
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;

/**
 * 1. Count New / Unread Reservations
 */
function sarmadgardezi_get_new_reservations_count() {
    $args = array(
        'post_type'      => 'reservation',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'fields'         => 'ids',
        'meta_query'     => array(
            'relation' => 'OR',
            array(
                'key'     => '_reservation_status',
                'value'   => 'new',
                'compare' => '=',
            ),
            array(
                'key'     => '_reservation_status',
                'compare' => 'NOT EXISTS',
            ),
            array(
                'key'     => '_reservation_status',
                'value'   => '',
                'compare' => '=',
            ),
        ),
    );
    $query = new WP_Query($args);
    return intval($query->found_posts);
}

/**
 * 2. Register Reservation Custom Post Type with dynamic counter badge in menu title
 */
add_action('init', 'sarmadgardezi_register_reservation_cpt');
function sarmadgardezi_register_reservation_cpt() {
    $count = sarmadgardezi_get_new_reservations_count();
    $badge = '';
    if ($count > 0) {
        $badge = sprintf(' <span class="update-plugins count-%1$d" style="background-color: #2563eb; color:#fff; border-radius: 9999px; padding: 2px 7px; font-size: 11px; font-weight: 700; margin-left: 4px;"><span class="plugin-count">%1$d</span></span>', $count);
    }

    $labels = array(
        'name'               => __('Reservations', 'sarmadgardezi'),
        'singular_name'      => __('Reservation', 'sarmadgardezi'),
        'menu_name'          => sprintf(__('Reservations%s', 'sarmadgardezi'), $badge),
        'name_admin_bar'     => __('Reservation', 'sarmadgardezi'),
        'add_new'            => __('Add New', 'sarmadgardezi'),
        'add_new_item'       => __('Add New Reservation', 'sarmadgardezi'),
        'new_item'           => __('New Reservation', 'sarmadgardezi'),
        'edit_item'          => __('View / Edit Reservation', 'sarmadgardezi'),
        'view_item'          => __('View Reservation', 'sarmadgardezi'),
        'all_items'          => __('All Queries & Bookings', 'sarmadgardezi'),
        'search_items'       => __('Search Reservations', 'sarmadgardezi'),
        'not_found'          => __('No reservations found.', 'sarmadgardezi'),
        'not_found_in_trash' => __('No reservations in Trash.', 'sarmadgardezi'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => false,
        'publicly_queryable' => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'menu_position'      => 22,
        'menu_icon'          => 'dashicons-calendar-alt',
        'query_var'          => false,
        'rewrite'            => false,
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'supports'           => array('title', 'custom-fields'),
        'show_in_rest'       => true,
    );

    register_post_type('reservation', $args);
}

/**
 * 3. Custom Columns for Reservation Admin List Table
 */
add_filter('manage_reservation_posts_columns', 'sarmadgardezi_reservation_columns');
function sarmadgardezi_reservation_columns($columns) {
    $new_cols = array(
        'cb'                   => '<input type="checkbox" />',
        'title'                => __('Client / Title', 'sarmadgardezi'),
        'res_phone'            => __('Phone / WhatsApp', 'sarmadgardezi'),
        'res_email'            => __('Email Address', 'sarmadgardezi'),
        'res_datetime'         => __('Booking Date & Time', 'sarmadgardezi'),
        'res_duration'         => __('Duration', 'sarmadgardezi'),
        'res_status'           => __('Status', 'sarmadgardezi'),
        'res_whatsapp_action'  => __('Contact on WhatsApp', 'sarmadgardezi'),
        'date'                 => __('Submitted At', 'sarmadgardezi'),
    );
    return $new_cols;
}

add_action('manage_reservation_posts_custom_column', 'sarmadgardezi_reservation_custom_column', 10, 2);
function sarmadgardezi_reservation_custom_column($column, $post_id) {
    $phone    = get_post_meta($post_id, '_reservation_phone', true) ?: get_post_meta($post_id, 'reservation_phone', true);
    $email    = get_post_meta($post_id, '_reservation_email', true) ?: get_post_meta($post_id, 'reservation_email', true);
    $date_val = get_post_meta($post_id, '_reservation_date', true) ?: get_post_meta($post_id, 'reservation_date', true);
    $time_val = get_post_meta($post_id, '_reservation_time', true) ?: get_post_meta($post_id, 'reservation_time', true);
    $duration = get_post_meta($post_id, '_reservation_duration', true) ?: get_post_meta($post_id, 'reservation_duration', true) ?: '30m';
    $status   = get_post_meta($post_id, '_reservation_status', true) ?: get_post_meta($post_id, 'reservation_status', true) ?: 'new';
    $name     = get_post_meta($post_id, '_reservation_name', true) ?: get_post_meta($post_id, 'reservation_name', true) ?: get_the_title($post_id);

    // Clean phone for WhatsApp Link (remove spaces, dashes, parentheses)
    $clean_phone = preg_replace('/[^0-9]/', '', $phone);
    if (!empty($clean_phone) && substr($clean_phone, 0, 1) === '0') {
        $clean_phone = '92' . substr($clean_phone, 1);
    }

    $wa_msg = rawurlencode(sprintf(
        "Hi %s, this is Sarmad Gardezi. Thank you for booking a chat regarding your product on %s at %s. How can I help you?",
        $name,
        $date_val,
        $time_val
    ));
    $wa_url = !empty($clean_phone) ? "https://wa.me/{$clean_phone}?text={$wa_msg}" : '';

    switch ($column) {
        case 'res_phone':
            if (!empty($phone)) {
                echo '<strong style="color: #0f172a;">' . esc_html($phone) . '</strong>';
            } else {
                echo '<span style="color:#94a3b8;">—</span>';
            }
            break;

        case 'res_email':
            if (!empty($email)) {
                echo '<a href="mailto:' . esc_attr($email) . '" style="text-decoration:none; color: #2563eb;">' . esc_html($email) . '</a>';
            } else {
                echo '<span style="color:#94a3b8;">—</span>';
            }
            break;

        case 'res_datetime':
            echo '<div style="display:flex; flex-direction:column; gap:2px;">';
            echo '<span style="font-weight:600; color:#111827;">' . esc_html($date_val) . '</span>';
            echo '<span style="font-size:12px; color:#64748b;">' . esc_html($time_val) . '</span>';
            echo '</div>';
            break;

        case 'res_duration':
            echo '<span style="display:inline-block; padding: 2px 8px; border-radius: 9999px; background:#f1f5f9; font-size:12px; font-weight:600; color:#475569;">' . esc_html($duration) . '</span>';
            break;

        case 'res_status':
            if ($status === 'completed') {
                echo '<span style="display:inline-block; padding: 3px 9px; border-radius: 6px; background:#dcfce7; color:#15803d; font-size:12px; font-weight:600;">Completed</span>';
            } elseif ($status === 'contacted') {
                echo '<span style="display:inline-block; padding: 3px 9px; border-radius: 6px; background:#e0f2fe; color:#0369a1; font-size:12px; font-weight:600;">Contacted</span>';
            } else {
                echo '<span style="display:inline-block; padding: 3px 9px; border-radius: 6px; background:#fef3c7; color:#b45309; font-size:12px; font-weight:600;">New Query</span>';
            }
            break;

        case 'res_whatsapp_action':
            if (!empty($wa_url)) {
                echo '<a href="' . esc_url($wa_url) . '" target="_blank" rel="noopener noreferrer" class="button button-small" style="background:#22c55e; border-color:#16a34a; color:#fff; font-weight:600; display:inline-flex; align-items:center; gap:5px; border-radius:6px;">';
                echo '<span class="dashicons dashicons-whatsapp" style="font-size:16px; width:16px; height:16px; margin-top:2px;"></span> Open WhatsApp';
                echo '</a>';
            } else {
                echo '<span style="color:#94a3b8; font-size:12px;">No phone provided</span>';
            }
            break;
    }
}

/**
 * 4. Native Meta Box for Reservation in WordPress Admin
 */
add_action('add_meta_boxes', 'sarmadgardezi_add_reservation_meta_boxes');
function sarmadgardezi_add_reservation_meta_boxes() {
    add_meta_box(
        'sarmad_reservation_details_box',
        __('Reservation & Query Details', 'sarmadgardezi'),
        'sarmadgardezi_render_reservation_meta_box',
        'reservation',
        'normal',
        'high'
    );
}

function sarmadgardezi_render_reservation_meta_box($post) {
    wp_nonce_field('sarmad_res_meta_save_action', 'sarmad_res_meta_nonce');

    $name       = get_post_meta($post->ID, '_reservation_name', true) ?: get_post_meta($post->ID, 'reservation_name', true);
    $email      = get_post_meta($post->ID, '_reservation_email', true) ?: get_post_meta($post->ID, 'reservation_email', true);
    $phone      = get_post_meta($post->ID, '_reservation_phone', true) ?: get_post_meta($post->ID, 'reservation_phone', true);
    $date_val   = get_post_meta($post->ID, '_reservation_date', true) ?: get_post_meta($post->ID, 'reservation_date', true);
    $time_val   = get_post_meta($post->ID, '_reservation_time', true) ?: get_post_meta($post->ID, 'reservation_time', true);
    $duration   = get_post_meta($post->ID, '_reservation_duration', true) ?: get_post_meta($post->ID, 'reservation_duration', true) ?: '30m';
    $notes      = get_post_meta($post->ID, '_reservation_notes', true) ?: get_post_meta($post->ID, 'reservation_notes', true);
    $guests     = get_post_meta($post->ID, '_reservation_guests', true) ?: get_post_meta($post->ID, 'reservation_guests', true);
    $status     = get_post_meta($post->ID, '_reservation_status', true) ?: get_post_meta($post->ID, 'reservation_status', true) ?: 'new';
    $timezone   = get_post_meta($post->ID, '_reservation_timezone', true) ?: get_post_meta($post->ID, 'reservation_timezone', true) ?: 'Asia/Karachi';

    $clean_phone = preg_replace('/[^0-9]/', '', $phone);
    if (!empty($clean_phone) && substr($clean_phone, 0, 1) === '0') {
        $clean_phone = '92' . substr($clean_phone, 1);
    }
    $wa_msg = rawurlencode(sprintf("Hi %s, this is Sarmad Gardezi regarding your meeting request.", $name));
    $wa_url = !empty($clean_phone) ? "https://wa.me/{$clean_phone}?text={$wa_msg}" : '';
    ?>
    <div style="padding: 12px 0;">
        <?php if (!empty($wa_url)) : ?>
            <div style="margin-bottom: 20px; padding: 14px 18px; background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 8px; display:flex; align-items:center; justify-content:space-between;">
                <div>
                    <strong style="color: #166534; font-size:15px;"><?php esc_html_e('Quick WhatsApp Chat', 'sarmadgardezi'); ?></strong>
                    <p style="margin: 3px 0 0; color: #15803d; font-size:13px;"><?php printf(esc_html__('Click to message %s on WhatsApp at %s', 'sarmadgardezi'), esc_html($name), esc_html($phone)); ?></p>
                </div>
                <a href="<?php echo esc_url($wa_url); ?>" target="_blank" rel="noopener noreferrer" class="button button-primary" style="background:#22c55e; border-color:#16a34a; font-weight:700; height:36px; line-height:34px; padding:0 18px;">
                    <?php esc_html_e('Open WhatsApp', 'sarmadgardezi'); ?> &rarr;
                </a>
            </div>
        <?php endif; ?>

        <div style="display:grid; grid-template-columns: 1fr 1fr; gap: 18px; margin-bottom: 16px;">
            <div>
                <label style="font-weight:700; display:block; margin-bottom: 4px;"><?php esc_html_e('Client Full Name', 'sarmadgardezi'); ?></label>
                <input type="text" name="reservation_name" value="<?php echo esc_attr($name); ?>" style="width:100%; padding: 6px 10px;" />
            </div>

            <div>
                <label style="font-weight:700; display:block; margin-bottom: 4px;"><?php esc_html_e('WhatsApp / Phone Number', 'sarmadgardezi'); ?></label>
                <input type="text" name="reservation_phone" value="<?php echo esc_attr($phone); ?>" style="width:100%; padding: 6px 10px;" />
            </div>

            <div>
                <label style="font-weight:700; display:block; margin-bottom: 4px;"><?php esc_html_e('Email Address', 'sarmadgardezi'); ?></label>
                <input type="email" name="reservation_email" value="<?php echo esc_attr($email); ?>" style="width:100%; padding: 6px 10px;" />
            </div>

            <div>
                <label style="font-weight:700; display:block; margin-bottom: 4px;"><?php esc_html_e('Status', 'sarmadgardezi'); ?></label>
                <select name="reservation_status" style="width:100%; padding: 6px 10px;">
                    <option value="new" <?php selected($status, 'new'); ?>><?php esc_html_e('New Query (Uncontacted)', 'sarmadgardezi'); ?></option>
                    <option value="contacted" <?php selected($status, 'contacted'); ?>><?php esc_html_e('Contacted / Scheduled', 'sarmadgardezi'); ?></option>
                    <option value="completed" <?php selected($status, 'completed'); ?>><?php esc_html_e('Completed / Done', 'sarmadgardezi'); ?></option>
                </select>
            </div>

            <div>
                <label style="font-weight:700; display:block; margin-bottom: 4px;"><?php esc_html_e('Meeting Date', 'sarmadgardezi'); ?></label>
                <input type="text" name="reservation_date" value="<?php echo esc_attr($date_val); ?>" style="width:100%; padding: 6px 10px;" />
            </div>

            <div>
                <label style="font-weight:700; display:block; margin-bottom: 4px;"><?php esc_html_e('Time Slot & Duration', 'sarmadgardezi'); ?></label>
                <div style="display:flex; gap:10px;">
                    <input type="text" name="reservation_time" value="<?php echo esc_attr($time_val); ?>" placeholder="6:30 – 7:00 pm" style="flex:2; padding: 6px 10px;" />
                    <input type="text" name="reservation_duration" value="<?php echo esc_attr($duration); ?>" placeholder="30m" style="flex:1; padding: 6px 10px;" />
                </div>
            </div>
        </div>

        <div style="margin-bottom: 16px;">
            <label style="font-weight:700; display:block; margin-bottom: 4px;"><?php esc_html_e('Additional Notes / Query Details', 'sarmadgardezi'); ?></label>
            <textarea name="reservation_notes" rows="4" style="width:100%; padding: 8px 10px;"><?php echo esc_textarea($notes); ?></textarea>
        </div>

        <div style="margin-bottom: 16px;">
            <label style="font-weight:700; display:block; margin-bottom: 4px;"><?php esc_html_e('Additional Guests', 'sarmadgardezi'); ?></label>
            <input type="text" name="reservation_guests" value="<?php echo esc_attr($guests); ?>" placeholder="guest@example.com" style="width:100%; padding: 6px 10px;" />
        </div>

        <input type="hidden" name="reservation_timezone" value="<?php echo esc_attr($timezone); ?>" />
    </div>
    <?php
}

add_action('save_post_reservation', 'sarmadgardezi_save_reservation_meta');
function sarmadgardezi_save_reservation_meta($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;
    if (!isset($_POST['sarmad_res_meta_nonce']) || !wp_verify_nonce($_POST['sarmad_res_meta_nonce'], 'sarmad_res_meta_save_action')) return;

    $fields = array('reservation_name', 'reservation_phone', 'reservation_email', 'reservation_date', 'reservation_time', 'reservation_duration', 'reservation_status', 'reservation_notes', 'reservation_guests', 'reservation_timezone');
    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            $val = sanitize_text_field($_POST[$field]);
            update_post_meta($post_id, '_' . $field, $val);
            update_post_meta($post_id, $field, $val);
        }
    }
}

/**
 * 5. Dedicated Admin Dashboard Menu for Reservation Table / Overview
 */
add_action('admin_menu', 'sarmadgardezi_add_reservations_admin_subpage');
function sarmadgardezi_add_reservations_admin_subpage() {
    add_submenu_page(
        'edit.php?post_type=reservation',
        __('Reservations Dashboard', 'sarmadgardezi'),
        __('Live Table & Queries', 'sarmadgardezi'),
        'edit_posts',
        'sarmad-reservations-table',
        'sarmadgardezi_render_reservations_dashboard'
    );
}

function sarmadgardezi_render_reservations_dashboard() {
    // Handle Quick Status Update
    if (isset($_GET['action']) && $_GET['action'] === 'update_status' && isset($_GET['res_id']) && isset($_GET['new_status'])) {
        check_admin_referer('sarmad_update_res_status');
        $res_id = intval($_GET['res_id']);
        $new_st = sanitize_text_field($_GET['new_status']);
        update_post_meta($res_id, '_reservation_status', $new_st);
        update_post_meta($res_id, 'reservation_status', $new_st);
        wp_safe_redirect(remove_query_arg(array('action', 'res_id', 'new_status', '_wpnonce')));
        exit;
    }

    $all_reservations = get_posts(array(
        'post_type'      => 'reservation',
        'post_status'    => 'publish',
        'posts_per_page' => 50,
        'orderby'        => 'date',
        'order'          => 'DESC',
    ));
    ?>
    <div class="wrap" style="max-width: 1200px; margin-top: 20px;">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 20px;">
            <div>
                <h1 style="font-size:24px; font-weight:700; margin:0; display:flex; align-items:center; gap:8px;">
                    <span class="dashicons dashicons-calendar-alt" style="font-size:26px; width:26px; height:26px;"></span>
                    <?php esc_html_e('Meeting Reservations & WhatsApp Queries', 'sarmadgardezi'); ?>
                </h1>
                <p style="color:#64748b; margin:4px 0 0;"><?php esc_html_e('Review client booking submissions and contact them directly via WhatsApp or Email.', 'sarmadgardezi'); ?></p>
            </div>
            <div>
                <a href="<?php echo esc_url(admin_url('post-new.php?post_type=reservation')); ?>" class="button button-primary">
                    + <?php esc_html_e('Add Reservation', 'sarmadgardezi'); ?>
                </a>
            </div>
        </div>

        <div style="background:#ffffff; border-radius:12px; border:1px solid #e2e8f0; overflow:hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
            <table class="wp-list-table widefat fixed striped" style="border:none;">
                <thead>
                    <tr>
                        <th style="padding:12px 16px; font-weight:700; width:180px;"><?php esc_html_e('Client Name', 'sarmadgardezi'); ?></th>
                        <th style="padding:12px 16px; font-weight:700; width:160px;"><?php esc_html_e('Phone / WhatsApp', 'sarmadgardezi'); ?></th>
                        <th style="padding:12px 16px; font-weight:700; width:180px;"><?php esc_html_e('Email Address', 'sarmadgardezi'); ?></th>
                        <th style="padding:12px 16px; font-weight:700; width:160px;"><?php esc_html_e('Date & Time', 'sarmadgardezi'); ?></th>
                        <th style="padding:12px 16px; font-weight:700; width:110px;"><?php esc_html_e('Status', 'sarmadgardezi'); ?></th>
                        <th style="padding:12px 16px; font-weight:700;"><?php esc_html_e('Actions', 'sarmadgardezi'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($all_reservations)) : ?>
                        <?php foreach ($all_reservations as $res) : 
                            $r_id     = $res->ID;
                            $name     = get_post_meta($r_id, '_reservation_name', true) ?: get_the_title($r_id);
                            $phone    = get_post_meta($r_id, '_reservation_phone', true) ?: '—';
                            $email    = get_post_meta($r_id, '_reservation_email', true) ?: '—';
                            $date_val = get_post_meta($r_id, '_reservation_date', true) ?: '—';
                            $time_val = get_post_meta($r_id, '_reservation_time', true) ?: '';
                            $status   = get_post_meta($r_id, '_reservation_status', true) ?: 'new';
                            $notes    = get_post_meta($r_id, '_reservation_notes', true);

                            $clean_phone = preg_replace('/[^0-9]/', '', $phone);
                            if (!empty($clean_phone) && substr($clean_phone, 0, 1) === '0') {
                                $clean_phone = '92' . substr($clean_phone, 1);
                            }
                            $wa_msg = rawurlencode(sprintf("Hi %s, this is Sarmad Gardezi. I received your meeting reservation for %s at %s. How can I help you?", $name, $date_val, $time_val));
                            $wa_url = !empty($clean_phone) ? "https://wa.me/{$clean_phone}?text={$wa_msg}" : '';
                        ?>
                            <tr>
                                <td style="padding:12px 16px;">
                                    <strong><a href="<?php echo esc_url(get_edit_post_link($r_id)); ?>" style="color:#0f172a; text-decoration:none;"><?php echo esc_html($name); ?></a></strong>
                                    <?php if (!empty($notes)) : ?>
                                        <p style="margin:4px 0 0; font-size:12px; color:#64748b;"><?php echo esc_html(wp_trim_words($notes, 10)); ?></p>
                                    <?php endif; ?>
                                </td>
                                <td style="padding:12px 16px;">
                                    <strong style="color:#0f172a;"><?php echo esc_html($phone); ?></strong>
                                </td>
                                <td style="padding:12px 16px;">
                                    <a href="mailto:<?php echo esc_attr($email); ?>" style="color:#2563eb; text-decoration:none;"><?php echo esc_html($email); ?></a>
                                </td>
                                <td style="padding:12px 16px;">
                                    <span style="font-weight:600; color:#111827;"><?php echo esc_html($date_val); ?></span><br />
                                    <span style="font-size:12px; color:#64748b;"><?php echo esc_html($time_val); ?></span>
                                </td>
                                <td style="padding:12px 16px;">
                                    <?php if ($status === 'completed') : ?>
                                        <span style="display:inline-block; padding:3px 9px; border-radius:6px; background:#dcfce7; color:#15803d; font-size:12px; font-weight:700;">Completed</span>
                                    <?php elseif ($status === 'contacted') : ?>
                                        <span style="display:inline-block; padding:3px 9px; border-radius:6px; background:#e0f2fe; color:#0369a1; font-size:12px; font-weight:700;">Contacted</span>
                                    <?php else : ?>
                                        <span style="display:inline-block; padding:3px 9px; border-radius:6px; background:#fef3c7; color:#b45309; font-size:12px; font-weight:700;">New Query</span>
                                    <?php endif; ?>
                                </td>
                                <td style="padding:12px 16px;">
                                    <div style="display:flex; align-items:center; gap:8px; flex-wrap:wrap;">
                                        <?php if (!empty($wa_url)) : ?>
                                            <a href="<?php echo esc_url($wa_url); ?>" target="_blank" rel="noopener noreferrer" class="button" style="background:#22c55e; border-color:#16a34a; color:#ffffff; font-weight:700; display:inline-flex; align-items:center; gap:4px; border-radius:6px;">
                                                <span class="dashicons dashicons-whatsapp" style="font-size:15px; width:15px; height:15px; margin-top:2px;"></span> WhatsApp
                                            </a>
                                        <?php endif; ?>

                                        <?php if ($status === 'new') : ?>
                                            <a href="<?php echo esc_url(wp_nonce_url(add_query_arg(array('action' => 'update_status', 'res_id' => $r_id, 'new_status' => 'contacted')), 'sarmad_update_res_status')); ?>" class="button button-small" style="font-weight:600;">
                                                Mark Contacted
                                            </a>
                                        <?php elseif ($status === 'contacted') : ?>
                                            <a href="<?php echo esc_url(wp_nonce_url(add_query_arg(array('action' => 'update_status', 'res_id' => $r_id, 'new_status' => 'completed')), 'sarmad_update_res_status')); ?>" class="button button-small" style="font-weight:600;">
                                                Mark Completed
                                            </a>
                                        <?php endif; ?>

                                        <a href="<?php echo esc_url(get_edit_post_link($r_id)); ?>" class="button button-small">
                                            Edit
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="6" style="padding: 24px; text-align:center; color:#64748b;">
                                <?php esc_html_e('No reservations or queries submitted yet.', 'sarmadgardezi'); ?>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php
}

/**
 * 6. ACF Field Group Registration for Reservations (ACF Interoperability)
 */
add_action('acf/init', 'sarmadgardezi_register_reservation_acf_group');
function sarmadgardezi_register_reservation_acf_group() {
    if (!function_exists('acf_add_local_field_group')) return;

    $count = sarmadgardezi_get_new_reservations_count();
    $title = sprintf(__('Reservation Query Details (%d New)', 'sarmadgardezi'), $count);

    acf_add_local_field_group(array(
        'key'                   => 'group_reservation_details',
        'title'                 => $title,
        'fields'                => array(
            array(
                'key'           => 'field_res_name',
                'label'         => __('Client Name', 'sarmadgardezi'),
                'name'          => 'reservation_name',
                'type'          => 'text',
                'required'      => 1,
            ),
            array(
                'key'           => 'field_res_phone',
                'label'         => __('WhatsApp / Phone Number', 'sarmadgardezi'),
                'name'          => 'reservation_phone',
                'type'          => 'text',
                'required'      => 1,
            ),
            array(
                'key'           => 'field_res_email',
                'label'         => __('Email Address', 'sarmadgardezi'),
                'name'          => 'reservation_email',
                'type'          => 'email',
                'required'      => 1,
            ),
            array(
                'key'           => 'field_res_date',
                'label'         => __('Meeting Date', 'sarmadgardezi'),
                'name'          => 'reservation_date',
                'type'          => 'text',
                'required'      => 1,
            ),
            array(
                'key'           => 'field_res_time',
                'label'         => __('Time Slot', 'sarmadgardezi'),
                'name'          => 'reservation_time',
                'type'          => 'text',
                'required'      => 1,
            ),
            array(
                'key'           => 'field_res_duration',
                'label'         => __('Duration', 'sarmadgardezi'),
                'name'          => 'reservation_duration',
                'type'          => 'select',
                'choices'       => array(
                    '30m' => '30 Minutes',
                    '50m' => '50 Minutes',
                ),
                'default_value' => '30m',
            ),
            array(
                'key'           => 'field_res_status',
                'label'         => __('Status', 'sarmadgardezi'),
                'name'          => 'reservation_status',
                'type'          => 'select',
                'choices'       => array(
                    'new'       => 'New Query',
                    'contacted' => 'Contacted',
                    'completed' => 'Completed',
                ),
                'default_value' => 'new',
            ),
            array(
                'key'           => 'field_res_notes',
                'label'         => __('Additional Notes', 'sarmadgardezi'),
                'name'          => 'reservation_notes',
                'type'          => 'textarea',
                'rows'          => 3,
            ),
            array(
                'key'           => 'field_res_guests',
                'label'         => __('Additional Guests', 'sarmadgardezi'),
                'name'          => 'reservation_guests',
                'type'          => 'text',
            ),
        ),
        'location'              => array(
            array(
                array(
                    'param'    => 'post_type',
                    'operator' => '==',
                    'value'    => 'reservation',
                ),
            ),
        ),
        'menu_order'            => 0,
        'position'              => 'normal',
        'style'                 => 'default',
        'label_placement'       => 'top',
        'instruction_placement' => 'label',
    ));
}

/**
 * 7. AJAX Submission Handler for Cal.com-Style Booking Widget
 */
add_action('wp_ajax_sarmad_submit_reservation', 'sarmadgardezi_handle_ajax_reservation');
add_action('wp_ajax_nopriv_sarmad_submit_reservation', 'sarmadgardezi_handle_ajax_reservation');

function sarmadgardezi_handle_ajax_reservation() {
    check_ajax_referer('sarmad_booking_nonce_action', 'nonce');

    $name     = isset($_POST['name']) ? sanitize_text_field($_POST['name']) : '';
    $email    = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
    $phone    = isset($_POST['phone']) ? sanitize_text_field($_POST['phone']) : '';
    $date     = isset($_POST['date']) ? sanitize_text_field($_POST['date']) : '';
    $time     = isset($_POST['time']) ? sanitize_text_field($_POST['time']) : '';
    $duration = isset($_POST['duration']) ? sanitize_text_field($_POST['duration']) : '30m';
    $notes    = isset($_POST['notes']) ? sanitize_textarea_field($_POST['notes']) : '';
    $guests   = isset($_POST['guests']) ? sanitize_text_field($_POST['guests']) : '';
    $timezone = isset($_POST['timezone']) ? sanitize_text_field($_POST['timezone']) : 'Asia/Karachi';

    if (empty($name) || empty($email) || empty($date) || empty($time)) {
        wp_send_json_error(array(
            'message' => __('Please fill in all required fields (Name, Email, Date, Time).', 'sarmadgardezi')
        ));
    }

    // Create reservation post
    $post_title = sprintf('Booking: %s (%s, %s)', $name, $date, $time);
    $post_data  = array(
        'post_title'   => $post_title,
        'post_content' => $notes,
        'post_status'  => 'publish',
        'post_type'    => 'reservation',
        'post_author'  => 1,
    );

    $post_id = wp_insert_post($post_data);

    if (is_wp_error($post_id) || !$post_id) {
        wp_send_json_error(array(
            'message' => __('Could not save reservation. Please try again.', 'sarmadgardezi')
        ));
    }

    // Save metadata
    update_post_meta($post_id, '_reservation_name', $name);
    update_post_meta($post_id, 'reservation_name', $name);

    update_post_meta($post_id, '_reservation_email', $email);
    update_post_meta($post_id, 'reservation_email', $email);

    update_post_meta($post_id, '_reservation_phone', $phone);
    update_post_meta($post_id, 'reservation_phone', $phone);

    update_post_meta($post_id, '_reservation_date', $date);
    update_post_meta($post_id, 'reservation_date', $date);

    update_post_meta($post_id, '_reservation_time', $time);
    update_post_meta($post_id, 'reservation_time', $time);

    update_post_meta($post_id, '_reservation_duration', $duration);
    update_post_meta($post_id, 'reservation_duration', $duration);

    update_post_meta($post_id, '_reservation_notes', $notes);
    update_post_meta($post_id, 'reservation_notes', $notes);

    update_post_meta($post_id, '_reservation_guests', $guests);
    update_post_meta($post_id, 'reservation_guests', $guests);

    update_post_meta($post_id, '_reservation_status', 'new');
    update_post_meta($post_id, 'reservation_status', 'new');

    update_post_meta($post_id, '_reservation_timezone', $timezone);
    update_post_meta($post_id, 'reservation_timezone', $timezone);

    // Send admin notification email
    $admin_email = get_option('admin_email');
    $subject     = sprintf('[New Booking Query] %s booked a %s session', $name, $duration);
    $body        = sprintf(
        "New meeting reservation submitted:\n\n" .
        "Name: %s\n" .
        "Phone / WhatsApp: %s\n" .
        "Email: %s\n" .
        "Date: %s\n" .
        "Time Slot: %s\n" .
        "Duration: %s\n" .
        "Timezone: %s\n" .
        "Guests: %s\n\n" .
        "Notes:\n%s\n\n" .
        "View in WP Admin: %s\n",
        $name,
        $phone,
        $email,
        $date,
        $time,
        $duration,
        $timezone,
        $guests,
        $notes,
        admin_url('post.php?post=' . $post_id . '&action=edit')
    );
    @wp_mail($admin_email, $subject, $body);

    // Response message exact specification
    $success_message = __('Sarmad will contact you within hour via whatsapp on this query', 'sarmadgardezi');

    wp_send_json_success(array(
        'message'     => $success_message,
        'booking_id'  => $post_id,
        'name'        => $name,
        'phone'       => $phone,
        'date'        => $date,
        'time'        => $time,
        'duration'    => $duration,
    ));
}
