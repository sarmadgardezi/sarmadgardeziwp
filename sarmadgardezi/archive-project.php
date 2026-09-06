<?php
/**
 * The template for displaying the Projects archive catalog
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="main-content" class="site-main site-projects-main">
    <div class="site-container">
        <?php get_template_part('template-parts/global/breadcrumbs'); ?>

        <header class="page-header projects-header">
            <span class="section-tag"><?php esc_html_e('Portfolio & Software Works', 'sarmadgardezi'); ?></span>
            <h1 class="page-title"><?php esc_html_e('Featured Projects & Systems', 'sarmadgardezi'); ?></h1>
            <p class="page-description">
                <?php esc_html_e('Production software engineering, cloud architectures, AI integrations, and full-stack systems built by Sarmad Gardezi.', 'sarmadgardezi'); ?>
            </p>
        </header>

        <?php
        $tech_terms = get_terms(array(
            'taxonomy'   => 'technology',
            'hide_empty' => true,
        ));

        if (!empty($tech_terms) && !is_wp_error($tech_terms)) :
        ?>
            <nav class="category-filter-nav" aria-label="<?php esc_attr_e('Filter projects by technology', 'sarmadgardezi'); ?>">
                <ul class="category-filter-list">
                    <li>
                        <a href="<?php echo esc_url(get_post_type_archive_link('project')); ?>" class="filter-chip active">
                            <?php esc_html_e('All Projects', 'sarmadgardezi'); ?>
                        </a>
                    </li>
                    <?php foreach ($tech_terms as $term) : ?>
                        <li>
                            <a href="<?php echo esc_url(get_term_link($term)); ?>" class="filter-chip">
                                <?php echo esc_html($term->name); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </nav>
        <?php endif; ?>

        <?php if (have_posts()) : ?>
            <div class="projects-grid">
                <?php
                while (have_posts()) :
                    the_post();
                    get_template_part('template-parts/projects/card');
                endwhile;
                ?>
            </div>

            <?php get_template_part('template-parts/global/pagination'); ?>

        <?php else : ?>
            <div class="no-posts-found glass-card">
                <h2><?php esc_html_e('No projects found', 'sarmadgardezi'); ?></h2>
                <p><?php esc_html_e('Projects are currently being updated. Check back soon.', 'sarmadgardezi'); ?></p>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php
get_footer();
