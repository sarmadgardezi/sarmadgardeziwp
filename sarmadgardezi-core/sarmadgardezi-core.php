<?php
/**
 * Plugin Name:       Sarmad Gardezi Core
 * Plugin URI:        https://sarmadgardezi.com/
 * Description:       Custom Post Types (Projects, Talks, Case Studies), Taxonomies, ACF and meta field bridges, and SEO URL rewrites for sarmadgardezi.com.
 * Version:           1.0.0
 * Author:            Sarmad Gardezi
 * Author URI:        https://sarmadgardezi.com/
 * Text Domain:       sarmadgardezi-core
 * Domain Path:       /languages
 * Requires at least: 6.0
 * Requires PHP:      7.4
 *
 * @package           SarmadGardeziCore
 */

defined('ABSPATH') || exit;

define('SARMADGARDEZI_CORE_VERSION', '1.0.0');
define('SARMADGARDEZI_CORE_DIR', plugin_dir_path(__FILE__));
define('SARMADGARDEZI_CORE_URI', plugin_dir_url(__FILE__));

/**
 * Load core plugin modules.
 */
require_once SARMADGARDEZI_CORE_DIR . 'inc/post-types.php';
require_once SARMADGARDEZI_CORE_DIR . 'inc/taxonomies.php';
require_once SARMADGARDEZI_CORE_DIR . 'inc/meta-boxes.php';
require_once SARMADGARDEZI_CORE_DIR . 'inc/redirects.php';

/**
 * Flush rewrite rules on plugin activation.
 */
function sarmadgardezi_core_activate() {
    sarmadgardezi_core_register_post_types();
    sarmadgardezi_core_register_taxonomies();
    flush_rewrite_rules();
}
register_activation_hook(__FILE__, 'sarmadgardezi_core_activate');

/**
 * Flush rewrite rules on plugin deactivation.
 */
function sarmadgardezi_core_deactivate() {
    flush_rewrite_rules();
}
register_deactivation_hook(__FILE__, 'sarmadgardezi_core_deactivate');
