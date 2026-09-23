<?php
/**
 * AJAX Handlers
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;

/**
 * Handle Like increment
 */
function sarmadgardezi_ajax_like_post() {
    check_ajax_referer('sarmadgardezi_share_nonce', 'nonce');

    $post_id = isset($_POST['post_id']) ? intval($_POST['post_id']) : 0;
    if (!$post_id) {
        wp_send_json_error(array('message' => 'Invalid post ID'));
    }

    $current_likes = get_post_meta($post_id, '_post_like_count', true);
    if ($current_likes === '') {
        $current_likes = 25; // Default starting point if missing
    } else {
        $current_likes = intval($current_likes);
    }

    $new_likes = $current_likes + 1;
    update_post_meta($post_id, '_post_like_count', $new_likes);

    wp_send_json_success(array('new_count' => $new_likes));
}
add_action('wp_ajax_sarmadgardezi_like_post', 'sarmadgardezi_ajax_like_post');
add_action('wp_ajax_nopriv_sarmadgardezi_like_post', 'sarmadgardezi_ajax_like_post');

/**
 * Handle Share increment
 */
function sarmadgardezi_ajax_share_post() {
    check_ajax_referer('sarmadgardezi_share_nonce', 'nonce');

    $post_id = isset($_POST['post_id']) ? intval($_POST['post_id']) : 0;
    if (!$post_id) {
        wp_send_json_error(array('message' => 'Invalid post ID'));
    }

    $current_shares = get_post_meta($post_id, '_post_share_count', true);
    if ($current_shares === '') {
        $current_shares = 25; // Default starting point if missing
    } else {
        $current_shares = intval($current_shares);
    }

    $new_shares = $current_shares + 1;
    update_post_meta($post_id, '_post_share_count', $new_shares);

    wp_send_json_success(array('new_count' => $new_shares));
}
add_action('wp_ajax_sarmadgardezi_share_post', 'sarmadgardezi_ajax_share_post');
add_action('wp_ajax_nopriv_sarmadgardezi_share_post', 'sarmadgardezi_ajax_share_post');
