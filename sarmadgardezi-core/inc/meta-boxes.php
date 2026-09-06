<?php
/**
 * Custom Fields & Admin Meta Boxes with ACF Interoperability Bridge
 *
 * Provides native custom field panels in WP Admin, with an ACF-compatible accessor function
 * so templates work identically whether using native fields or ACF Pro.
 *
 * @package SarmadGardeziCore
 */

defined('ABSPATH') || exit;

if (!function_exists('sarmad_get_field')) {
    /**
     * Universal field accessor with ACF fallback.
     *
     * @param string   $field_name Key of the field (e.g., 'project_live_url').
     * @param int|null $post_id    Post ID or current post if null.
     * @return mixed
     */
    function sarmad_get_field($field_name, $post_id = null) {
        if (!$post_id) {
            $post_id = get_the_ID();
        }
        if (!$post_id) {
            return '';
        }

        // 1. If ACF is active and field returns a value, use it.
        if (function_exists('get_field')) {
            $acf_val = get_field($field_name, $post_id);
            if ($acf_val !== null && $acf_val !== '' && $acf_val !== false) {
                return $acf_val;
            }
        }

        // 2. Fall back to standard post meta with underscore prefix or direct key.
        $meta_val = get_post_meta($post_id, '_' . $field_name, true);
        if ($meta_val !== '') {
            return $meta_val;
        }

        return get_post_meta($post_id, $field_name, true);
    }
}

/**
 * Register meta boxes for Project, Talk, and Case Study.
 */
function sarmadgardezi_core_add_meta_boxes() {
    add_meta_box(
        'sarmad_project_meta',
        __('Project Details', 'sarmadgardezi-core'),
        'sarmadgardezi_core_project_meta_callback',
        'project',
        'normal',
        'high'
    );

    add_meta_box(
        'sarmad_talk_meta',
        __('Talk / Presentation Details', 'sarmadgardezi-core'),
        'sarmadgardezi_core_talk_meta_callback',
        'talk',
        'normal',
        'high'
    );

    add_meta_box(
        'sarmad_case_meta',
        __('Case Study Details & Metrics', 'sarmadgardezi-core'),
        'sarmadgardezi_core_case_meta_callback',
        'case-study',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'sarmadgardezi_core_add_meta_boxes');

/**
 * Project meta box HTML markup.
 */
function sarmadgardezi_core_project_meta_callback($post) {
    wp_nonce_field('sarmad_project_meta_save', 'sarmad_project_meta_nonce');

    $live_url   = get_post_meta($post->ID, '_project_live_url', true);
    $github_url = get_post_meta($post->ID, '_project_github_url', true);
    $role       = get_post_meta($post->ID, '_project_role', true);
    $timeline   = get_post_meta($post->ID, '_project_timeline', true);
    $featured   = get_post_meta($post->ID, '_project_featured', true);
    ?>
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; padding: 10px 0;">
        <div>
            <label style="display:block; font-weight:600; margin-bottom:4px;" for="project_live_url"><?php esc_html_e('Live Project URL', 'sarmadgardezi-core'); ?></label>
            <input type="url" id="project_live_url" name="project_live_url" value="<?php echo esc_url($live_url); ?>" style="width: 100%;" placeholder="https://example.com" />
            <p class="description"><?php esc_html_e('Link to the production website or application.', 'sarmadgardezi-core'); ?></p>
        </div>
        <div>
            <label style="display:block; font-weight:600; margin-bottom:4px;" for="project_github_url"><?php esc_html_e('GitHub Repository URL', 'sarmadgardezi-core'); ?></label>
            <input type="url" id="project_github_url" name="project_github_url" value="<?php echo esc_url($github_url); ?>" style="width: 100%;" placeholder="https://github.com/username/repo" />
            <p class="description"><?php esc_html_e('Link to source code repository (if public).', 'sarmadgardezi-core'); ?></p>
        </div>
        <div>
            <label style="display:block; font-weight:600; margin-bottom:4px;" for="project_role"><?php esc_html_e('Your Role', 'sarmadgardezi-core'); ?></label>
            <input type="text" id="project_role" name="project_role" value="<?php echo esc_attr($role); ?>" style="width: 100%;" placeholder="e.g. Lead Software Engineer / Architect" />
        </div>
        <div>
            <label style="display:block; font-weight:600; margin-bottom:4px;" for="project_timeline"><?php esc_html_e('Timeline / Year', 'sarmadgardezi-core'); ?></label>
            <input type="text" id="project_timeline" name="project_timeline" value="<?php echo esc_attr($timeline); ?>" style="width: 100%;" placeholder="e.g. 2024 - 2025" />
        </div>
    </div>
    <div style="margin-top: 12px; padding-top: 12px; border-top: 1px solid #ddd;">
        <label style="font-weight:600;">
            <input type="checkbox" name="project_featured" value="1" <?php checked($featured, '1'); ?> />
            <?php esc_html_e('Feature this project on the homepage', 'sarmadgardezi-core'); ?>
        </label>
    </div>
    <?php
}

/**
 * Talk meta box HTML markup.
 */
function sarmadgardezi_core_talk_meta_callback($post) {
    wp_nonce_field('sarmad_talk_meta_save', 'sarmad_talk_meta_nonce');

    $event         = get_post_meta($post->ID, '_talk_event', true);
    $date          = get_post_meta($post->ID, '_talk_date', true);
    $slides_url    = get_post_meta($post->ID, '_talk_slides_url', true);
    $recording_url = get_post_meta($post->ID, '_talk_recording_url', true);
    $location      = get_post_meta($post->ID, '_talk_location', true);
    ?>
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; padding: 10px 0;">
        <div>
            <label style="display:block; font-weight:600; margin-bottom:4px;" for="talk_event"><?php esc_html_e('Event / Conference Name', 'sarmadgardezi-core'); ?></label>
            <input type="text" id="talk_event" name="talk_event" value="<?php echo esc_attr($event); ?>" style="width: 100%;" placeholder="e.g. GDG Cloud DevFest 2024" />
        </div>
        <div>
            <label style="display:block; font-weight:600; margin-bottom:4px;" for="talk_date"><?php esc_html_e('Date Presented', 'sarmadgardezi-core'); ?></label>
            <input type="date" id="talk_date" name="talk_date" value="<?php echo esc_attr($date); ?>" style="width: 100%;" />
        </div>
        <div>
            <label style="display:block; font-weight:600; margin-bottom:4px;" for="talk_location"><?php esc_html_e('Location / Format', 'sarmadgardezi-core'); ?></label>
            <input type="text" id="talk_location" name="talk_location" value="<?php echo esc_attr($location); ?>" style="width: 100%;" placeholder="e.g. Islamabad, Pakistan (In-Person / Virtual)" />
        </div>
        <div>
            <label style="display:block; font-weight:600; margin-bottom:4px;" for="talk_slides_url"><?php esc_html_e('Slide Deck URL', 'sarmadgardezi-core'); ?></label>
            <input type="url" id="talk_slides_url" name="talk_slides_url" value="<?php echo esc_url($slides_url); ?>" style="width: 100%;" placeholder="https://speakerdeck.com/..." />
        </div>
        <div style="grid-column: 1 / -1;">
            <label style="display:block; font-weight:600; margin-bottom:4px;" for="talk_recording_url"><?php esc_html_e('Recording / Video URL (YouTube or Vimeo)', 'sarmadgardezi-core'); ?></label>
            <input type="url" id="talk_recording_url" name="talk_recording_url" value="<?php echo esc_url($recording_url); ?>" style="width: 100%;" placeholder="https://www.youtube.com/watch?v=..." />
        </div>
    </div>
    <?php
}

/**
 * Case Study meta box HTML markup.
 */
function sarmadgardezi_core_case_meta_callback($post) {
    wp_nonce_field('sarmad_case_meta_save', 'sarmad_case_meta_nonce');

    $client    = get_post_meta($post->ID, '_case_client', true);
    $timeline  = get_post_meta($post->ID, '_case_timeline', true);
    $metrics_1_val = get_post_meta($post->ID, '_case_metric_1_val', true);
    $metrics_1_lbl = get_post_meta($post->ID, '_case_metric_1_lbl', true);
    $metrics_2_val = get_post_meta($post->ID, '_case_metric_2_val', true);
    $metrics_2_lbl = get_post_meta($post->ID, '_case_metric_2_lbl', true);
    $metrics_3_val = get_post_meta($post->ID, '_case_metric_3_val', true);
    $metrics_3_lbl = get_post_meta($post->ID, '_case_metric_3_lbl', true);
    ?>
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; padding: 10px 0;">
        <div>
            <label style="display:block; font-weight:600; margin-bottom:4px;" for="case_client"><?php esc_html_e('Client / Organization', 'sarmadgardezi-core'); ?></label>
            <input type="text" id="case_client" name="case_client" value="<?php echo esc_attr($client); ?>" style="width: 100%;" />
        </div>
        <div>
            <label style="display:block; font-weight:600; margin-bottom:4px;" for="case_timeline"><?php esc_html_e('Project Duration', 'sarmadgardezi-core'); ?></label>
            <input type="text" id="case_timeline" name="case_timeline" value="<?php echo esc_attr($timeline); ?>" style="width: 100%;" placeholder="e.g. 6 Months" />
        </div>
    </div>
    <h4><?php esc_html_e('Key Quantifiable Metrics / Results', 'sarmadgardezi-core'); ?></h4>
    <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 16px; padding-bottom: 10px;">
        <div>
            <label style="display:block; font-weight:600; margin-bottom:4px;"><?php esc_html_e('Metric 1 (Value / Label)', 'sarmadgardezi-core'); ?></label>
            <input type="text" name="case_metric_1_val" value="<?php echo esc_attr($metrics_1_val); ?>" placeholder="+140%" style="width: 100%; margin-bottom: 6px;" />
            <input type="text" name="case_metric_1_lbl" value="<?php echo esc_attr($metrics_1_lbl); ?>" placeholder="Traffic Growth" style="width: 100%;" />
        </div>
        <div>
            <label style="display:block; font-weight:600; margin-bottom:4px;"><?php esc_html_e('Metric 2 (Value / Label)', 'sarmadgardezi-core'); ?></label>
            <input type="text" name="case_metric_2_val" value="<?php echo esc_attr($metrics_2_val); ?>" placeholder="4.2x" style="width: 100%; margin-bottom: 6px;" />
            <input type="text" name="case_metric_2_lbl" value="<?php echo esc_attr($metrics_2_lbl); ?>" placeholder="Lead Conversion" style="width: 100%;" />
        </div>
        <div>
            <label style="display:block; font-weight:600; margin-bottom:4px;"><?php esc_html_e('Metric 3 (Value / Label)', 'sarmadgardezi-core'); ?></label>
            <input type="text" name="case_metric_3_val" value="<?php echo esc_attr($metrics_3_val); ?>" placeholder="99.99%" style="width: 100%; margin-bottom: 6px;" />
            <input type="text" name="case_metric_3_lbl" value="<?php echo esc_attr($metrics_3_lbl); ?>" placeholder="Uptime / Reliability" style="width: 100%;" />
        </div>
    </div>
    <?php
}

/**
 * Save meta box data securely.
 */
function sarmadgardezi_core_save_meta_boxes($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Save Project meta
    if (isset($_POST['sarmad_project_meta_nonce']) && wp_verify_nonce($_POST['sarmad_project_meta_nonce'], 'sarmad_project_meta_save')) {
        update_post_meta($post_id, '_project_live_url', esc_url_raw($_POST['project_live_url'] ?? ''));
        update_post_meta($post_id, '_project_github_url', esc_url_raw($_POST['project_github_url'] ?? ''));
        update_post_meta($post_id, '_project_role', sanitize_text_field($_POST['project_role'] ?? ''));
        update_post_meta($post_id, '_project_timeline', sanitize_text_field($_POST['project_timeline'] ?? ''));
        update_post_meta($post_id, '_project_featured', !empty($_POST['project_featured']) ? '1' : '0');
    }

    // Save Talk meta
    if (isset($_POST['sarmad_talk_meta_nonce']) && wp_verify_nonce($_POST['sarmad_talk_meta_nonce'], 'sarmad_talk_meta_save')) {
        update_post_meta($post_id, '_talk_event', sanitize_text_field($_POST['talk_event'] ?? ''));
        update_post_meta($post_id, '_talk_date', sanitize_text_field($_POST['talk_date'] ?? ''));
        update_post_meta($post_id, '_talk_location', sanitize_text_field($_POST['talk_location'] ?? ''));
        update_post_meta($post_id, '_talk_slides_url', esc_url_raw($_POST['talk_slides_url'] ?? ''));
        update_post_meta($post_id, '_talk_recording_url', esc_url_raw($_POST['talk_recording_url'] ?? ''));
    }

    // Save Case Study meta
    if (isset($_POST['sarmad_case_meta_nonce']) && wp_verify_nonce($_POST['sarmad_case_meta_nonce'], 'sarmad_case_meta_save')) {
        update_post_meta($post_id, '_case_client', sanitize_text_field($_POST['case_client'] ?? ''));
        update_post_meta($post_id, '_case_timeline', sanitize_text_field($_POST['case_timeline'] ?? ''));
        update_post_meta($post_id, '_case_metric_1_val', sanitize_text_field($_POST['case_metric_1_val'] ?? ''));
        update_post_meta($post_id, '_case_metric_1_lbl', sanitize_text_field($_POST['case_metric_1_lbl'] ?? ''));
        update_post_meta($post_id, '_case_metric_2_val', sanitize_text_field($_POST['case_metric_2_val'] ?? ''));
        update_post_meta($post_id, '_case_metric_2_lbl', sanitize_text_field($_POST['case_metric_2_lbl'] ?? ''));
        update_post_meta($post_id, '_case_metric_3_val', sanitize_text_field($_POST['case_metric_3_val'] ?? ''));
        update_post_meta($post_id, '_case_metric_3_lbl', sanitize_text_field($_POST['case_metric_3_lbl'] ?? ''));
    }
}
add_action('save_post', 'sarmadgardezi_core_save_meta_boxes');
