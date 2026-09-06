<?php
/**
 * Related Posts Template Part
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;

$current_id = get_the_ID();
$categories = wp_get_post_categories($current_id);

if (empty($categories)) {
    return;
}

$related_args = array(
    'category__in'        => $categories,
    'post__not_in'        => array($current_id),
    'posts_per_page'      => 2,
    'ignore_sticky_posts' => 1,
    'no_found_rows'       => true,
);

$related_query = new WP_Query($related_args);

if ($related_query->have_posts()) :
?>
<section class="related-posts-section" aria-labelledby="related-posts-heading">
    <div class="related-posts-header">
        <span class="section-tag"><?php esc_html_e('Continue Reading', 'sarmadgardezi'); ?></span>
        <h2 id="related-posts-heading" class="section-title"><?php esc_html_e('Related Articles', 'sarmadgardezi'); ?></h2>
    </div>

    <div class="posts-grid related-posts-grid">
        <?php
        while ($related_query->have_posts()) :
            $related_query->the_post();
            get_template_part('template-parts/blog/post-card');
        endwhile;
        wp_reset_postdata();
        ?>
    </div>
</section>
<?php endif; ?>
