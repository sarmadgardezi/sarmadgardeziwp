<?php
/**
 * Global Pagination Template Part
 *
 * Accessible numeric pagination with screen reader labels.
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;

the_posts_pagination(array(
    'mid_size'           => 2,
    'prev_text'          => '<span class="pagination-arrow" aria-hidden="true">&larr;</span> ' . esc_html__('Previous', 'sarmadgardezi'),
    'next_text'          => esc_html__('Next', 'sarmadgardezi') . ' <span class="pagination-arrow" aria-hidden="true">&rarr;</span>',
    'screen_reader_text' => esc_html__('Posts navigation', 'sarmadgardezi'),
    'class'              => 'site-pagination',
));
