<?php
/**
 * Sarmad Gardezi Theme Bootstrap
 *
 * @package SarmadGardezi
 * @version 1.0.0
 */

defined('ABSPATH') || exit;

// Theme constants.
define('SARMADGARDEZI_VERSION', '1.0.0');
define('SARMADGARDEZI_DIR', get_template_directory());
define('SARMADGARDEZI_URI', get_template_directory_uri());

/**
 * Load core theme modules.
 */
require_once SARMADGARDEZI_DIR . '/inc/setup.php';
require_once SARMADGARDEZI_DIR . '/inc/enqueue.php';
require_once SARMADGARDEZI_DIR . '/inc/helpers.php';
require_once SARMADGARDEZI_DIR . '/inc/yoast.php';
require_once SARMADGARDEZI_DIR . '/inc/acf-fields.php';

// Optional modules loaded when created.
if (file_exists(SARMADGARDEZI_DIR . '/inc/security.php')) {
    require_once SARMADGARDEZI_DIR . '/inc/security.php';
}

if (file_exists(SARMADGARDEZI_DIR . '/inc/performance.php')) {
    require_once SARMADGARDEZI_DIR . '/inc/performance.php';
}


// Custom post types & taxonomies.
if (file_exists(SARMADGARDEZI_DIR . '/inc/post-types/projects.php')) {
    require_once SARMADGARDEZI_DIR . '/inc/post-types/projects.php';
}

if (file_exists(SARMADGARDEZI_DIR . '/inc/post-types/case-studies.php')) {
    require_once SARMADGARDEZI_DIR . '/inc/post-types/case-studies.php';
}

if (file_exists(SARMADGARDEZI_DIR . '/inc/taxonomies/technologies.php')) {
    require_once SARMADGARDEZI_DIR . '/inc/taxonomies/technologies.php';
}

if (file_exists(SARMADGARDEZI_DIR . '/inc/taxonomies/project-categories.php')) {
    require_once SARMADGARDEZI_DIR . '/inc/taxonomies/project-categories.php';
}
