<?php
/**
 * Project Card Template Part
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;

$post_id    = get_the_ID();
$live_url   = function_exists('sarmad_get_field') ? sarmad_get_field('project_live_url', $post_id) : get_post_meta($post_id, '_project_live_url', true);
$github_url = function_exists('sarmad_get_field') ? sarmad_get_field('project_github_url', $post_id) : get_post_meta($post_id, '_project_github_url', true);
$role       = function_exists('sarmad_get_field') ? sarmad_get_field('project_role', $post_id) : get_post_meta($post_id, '_project_role', true);
$timeline   = function_exists('sarmad_get_field') ? sarmad_get_field('project_timeline', $post_id) : get_post_meta($post_id, '_project_timeline', true);
$terms      = get_the_terms($post_id, 'technology');
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('glass-card project-card'); ?>>
    <?php if (has_post_thumbnail()) : ?>
        <div class="project-card-thumb">
            <a href="<?php the_permalink(); ?>" aria-label="<?php echo esc_attr(sprintf(__('View %s project details', 'sarmadgardezi'), get_the_title())); ?>">
                <?php the_post_thumbnail('sarmadgardezi-card', array('loading' => 'lazy')); ?>
            </a>
        </div>
    <?php endif; ?>

    <div class="project-card-body">
        <div class="project-card-meta">
            <?php if (!empty($role)) : ?>
                <span class="project-role"><?php echo esc_html($role); ?></span>
            <?php endif; ?>
            <?php if (!empty($role) && !empty($timeline)) : ?>
                <span class="meta-dot" aria-hidden="true">&bull;</span>
            <?php endif; ?>
            <?php if (!empty($timeline)) : ?>
                <span class="project-timeline"><?php echo esc_html($timeline); ?></span>
            <?php endif; ?>
        </div>

        <h3 class="project-card-title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h3>

        <div class="project-card-excerpt">
            <?php the_excerpt(); ?>
        </div>

        <?php if (!empty($terms) && !is_wp_error($terms)) : ?>
            <div class="project-tech-stack" aria-label="<?php esc_attr_e('Technologies used', 'sarmadgardezi'); ?>">
                <?php foreach ($terms as $term) : ?>
                    <span class="tech-badge"><?php echo esc_html($term->name); ?></span>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <div class="project-card-actions">
            <a href="<?php the_permalink(); ?>" class="btn btn-secondary btn-sm">
                <span><?php esc_html_e('Case / Details', 'sarmadgardezi'); ?></span>
                <?php echo sarmadgardezi_get_icon('arrow-right'); ?>
            </a>

            <?php if (!empty($live_url)) : ?>
                <a href="<?php echo esc_url($live_url); ?>" target="_blank" rel="noopener noreferrer" class="btn btn-outline btn-sm" aria-label="<?php echo esc_attr(sprintf(__('Visit %s live website', 'sarmadgardezi'), get_the_title())); ?>">
                    <span><?php esc_html_e('Live Demo', 'sarmadgardezi'); ?></span>
                    <?php echo sarmadgardezi_get_icon('external-link'); ?>
                </a>
            <?php endif; ?>

            <?php if (!empty($github_url)) : ?>
                <a href="<?php echo esc_url($github_url); ?>" target="_blank" rel="noopener noreferrer" class="btn btn-ghost btn-sm" aria-label="<?php echo esc_attr(sprintf(__('View %s source on GitHub', 'sarmadgardezi'), get_the_title())); ?>">
                    <?php echo sarmadgardezi_get_icon('github'); ?>
                </a>
            <?php endif; ?>
        </div>
    </div>
</article>
