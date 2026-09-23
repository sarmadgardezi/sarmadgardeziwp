<?php
/**
 * Template part for displaying the Numbered Related Posts List on single posts
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
    'posts_per_page'      => 5,
    'ignore_sticky_posts' => 1,
    'no_found_rows'       => true,
);

$related_query = new WP_Query($related_args);

if ($related_query->have_posts()) :
?>

<div class="post-related-list-widget">
    <div class="related-badge">
        <span class="serif">Related</span> Posts
    </div>

    <ul class="related-numbered-list">
        <?php
        $count = 1;
        while ($related_query->have_posts()) :
            $related_query->the_post();
        ?>
            <li class="related-list-item">
                <span class="list-rank"><?php echo esc_html($count); ?></span>
                <a href="<?php the_permalink(); ?>" class="list-title">
                    <?php the_title(); ?>
                </a>
            </li>
        <?php
            $count++;
        endwhile;
        wp_reset_postdata();
        ?>
    </ul>
</div>

<?php endif; ?>
