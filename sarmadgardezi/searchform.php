<?php
/**
 * The template for displaying search forms
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
    <label class="search-label" for="search-input-<?php echo esc_attr(uniqid()); ?>">
        <span class="screen-reader-text"><?php esc_html_e('Search for:', 'sarmadgardezi'); ?></span>
    </label>
    <div class="search-input-wrap">
        <input
            type="search"
            id="search-input-<?php echo esc_attr(uniqid()); ?>"
            class="search-field"
            placeholder="<?php echo esc_attr_x('Search articles, projects, talks…', 'placeholder', 'sarmadgardezi'); ?>"
            value="<?php echo get_search_query(); ?>"
            name="s"
            required
        />
        <button type="submit" class="search-submit btn btn-primary" aria-label="<?php echo esc_attr_x('Submit Search', 'submit button', 'sarmadgardezi'); ?>">
            <span><?php esc_html_e('Search', 'sarmadgardezi'); ?></span>
            <?php echo sarmadgardezi_get_icon('arrow-right'); ?>
        </button>
    </div>
</form>
