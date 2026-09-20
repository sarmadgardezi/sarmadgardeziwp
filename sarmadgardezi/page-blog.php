<?php
/**
 * Template Name: Blog Page
 * Description: Editorial Blog Index template (Digital Inspiration layout)
 *
 * Automatically handles:
 * 1. Any page slug named /blog/ (page-blog.php)
 * 2. Any page where "Blog Page" is selected in Page Attributes -> Template dropdown
 * 3. Settings -> Reading -> Posts page
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;

// Load the shared editorial blog template
require get_template_directory() . '/home.php';
