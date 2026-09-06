<?php
/**
 * The template for displaying a single project
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="main-content" class="site-main site-single-project-main">
    <div class="site-container">
        <?php get_template_part('template-parts/global/breadcrumbs'); ?>

        <?php
        while (have_posts()) :
            the_post();
            $post_id    = get_the_ID();
            $live_url   = function_exists('sarmad_get_field') ? sarmad_get_field('project_live_url', $post_id) : get_post_meta($post_id, '_project_live_url', true);
            $github_url = function_exists('sarmad_get_field') ? sarmad_get_field('project_github_url', $post_id) : get_post_meta($post_id, '_project_github_url', true);
            $role       = function_exists('sarmad_get_field') ? sarmad_get_field('project_role', $post_id) : get_post_meta($post_id, '_project_role', true);
            $timeline   = function_exists('sarmad_get_field') ? sarmad_get_field('project_timeline', $post_id) : get_post_meta($post_id, '_project_timeline', true);
            $terms      = get_the_terms($post_id, 'technology');
        ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('single-project-article'); ?>>
                <header class="project-header">
                    <span class="section-tag"><?php esc_html_e('Project Case', 'sarmadgardezi'); ?></span>
                    <h1 class="project-title"><?php the_title(); ?></h1>

                    <?php if (has_excerpt()) : ?>
                        <p class="project-lead"><?php echo esc_html(get_the_excerpt()); ?></p>
                    <?php endif; ?>

                    <div class="project-meta-bar glass-card">
                        <?php if (!empty($role)) : ?>
                            <div class="meta-item">
                                <span class="meta-label"><?php esc_html_e('Role', 'sarmadgardezi'); ?></span>
                                <span class="meta-value"><?php echo esc_html($role); ?></span>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($timeline)) : ?>
                            <div class="meta-item">
                                <span class="meta-label"><?php esc_html_e('Timeline', 'sarmadgardezi'); ?></span>
                                <span class="meta-value"><?php echo esc_html($timeline); ?></span>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($terms) && !is_wp_error($terms)) : ?>
                            <div class="meta-item meta-item-tech">
                                <span class="meta-label"><?php esc_html_e('Tech Stack', 'sarmadgardezi'); ?></span>
                                <div class="tech-tags">
                                    <?php foreach ($terms as $term) : ?>
                                        <span class="tech-badge"><?php echo esc_html($term->name); ?></span>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="meta-item meta-actions">
                            <?php if (!empty($live_url)) : ?>
                                <a href="<?php echo esc_url($live_url); ?>" target="_blank" rel="noopener noreferrer" class="btn btn-primary btn-sm">
                                    <span><?php esc_html_e('Live Project', 'sarmadgardezi'); ?></span>
                                    <?php echo sarmadgardezi_get_icon('external-link'); ?>
                                </a>
                            <?php endif; ?>

                            <?php if (!empty($github_url)) : ?>
                                <a href="<?php echo esc_url($github_url); ?>" target="_blank" rel="noopener noreferrer" class="btn btn-outline btn-sm">
                                    <?php echo sarmadgardezi_get_icon('github'); ?>
                                    <span>GitHub</span>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </header>

                <?php if (has_post_thumbnail()) : ?>
                    <figure class="project-featured-visual">
                        <?php the_post_thumbnail('full', array('loading' => 'eager', 'fetchpriority' => 'high')); ?>
                    </figure>
                <?php endif; ?>

                <div class="project-content entry-content prose">
                    <?php the_content(); ?>
                </div>

                <footer class="project-footer">
                    <nav class="article-navigation" aria-label="<?php esc_attr_e('Adjacent projects', 'sarmadgardezi'); ?>">
                        <div class="nav-links">
                            <?php
                            $prev_project = get_previous_post(false, '', 'taxonomy');
                            if ($prev_project) :
                            ?>
                                <a href="<?php echo esc_url(get_permalink($prev_project->ID)); ?>" class="nav-previous glass-card">
                                    <span class="nav-subtitle">&larr; <?php esc_html_e('Previous Project', 'sarmadgardezi'); ?></span>
                                    <span class="nav-title"><?php echo esc_html(get_the_title($prev_project->ID)); ?></span>
                                </a>
                            <?php endif; ?>

                            <?php
                            $next_project = get_next_post(false, '', 'taxonomy');
                            if ($next_project) :
                            ?>
                                <a href="<?php echo esc_url(get_permalink($next_project->ID)); ?>" class="nav-next glass-card">
                                    <span class="nav-subtitle"><?php esc_html_e('Next Project', 'sarmadgardezi'); ?> &rarr;</span>
                                    <span class="nav-title"><?php echo esc_html(get_the_title($next_project->ID)); ?></span>
                                </a>
                            <?php endif; ?>
                        </div>
                    </nav>

                    <div class="project-cta glass-card">
                        <h3><?php esc_html_e('Have a similar project in mind?', 'sarmadgardezi'); ?></h3>
                        <p><?php esc_html_e('Let\'s build robust cloud systems, web apps, or AI-powered solutions together.', 'sarmadgardezi'); ?></p>
                        <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn-primary">
                            <span><?php esc_html_e('Get In Touch', 'sarmadgardezi'); ?></span>
                            <?php echo sarmadgardezi_get_icon('arrow-right'); ?>
                        </a>
                    </div>
                </footer>
            </article>
        <?php endwhile; ?>
    </div>
</main>

<?php
get_footer();
