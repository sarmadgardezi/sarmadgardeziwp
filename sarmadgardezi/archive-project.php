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
        <?php
        get_template_part('template-parts/global/page-header', null, array(
            'title'       => __('Featured Projects & Systems', 'sarmadgardezi'),
            'description' => __('Production software engineering, cloud architectures, AI integrations, and full-stack systems built by Sarmad Gardezi.', 'sarmadgardezi')
        ));
        ?>

        <?php
        $cat_terms = get_terms(array(
            'taxonomy'   => 'project-category',
            'hide_empty' => true,
        ));

        if (!empty($cat_terms) && !is_wp_error($cat_terms)) :
        ?>
            <nav class="category-filter-nav" aria-label="<?php esc_attr_e('Filter projects by category', 'sarmadgardezi'); ?>">
                <ul class="category-filter-list">
                    <li>
                        <a href="<?php echo esc_url(get_post_type_archive_link('project')); ?>" class="filter-chip active">
                            <?php esc_html_e('All Projects', 'sarmadgardezi'); ?>
                        </a>
                    </li>
                    <?php foreach ($cat_terms as $term) : ?>
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
            <div class="portfolio-cards-stack">
                <?php
                $idx = 0;
                $default_colors = array('blue', 'pink', 'green', 'yellow', 'purple');
                while (have_posts()) :
                    the_post();
                    $pid = get_the_ID();
                    $color = get_post_meta($pid, '_project_card_color', true);
                    if (empty($color)) $color = $default_colors[$idx % 5];
                    $icon = get_post_meta($pid, '_project_icon', true);
                    if (empty($icon)) $icon = 'video';
                    
                    $raw_pills = function_exists('get_field') ? get_field('project_pills', $pid) : get_post_meta($pid, '_project_pills', true);
                    $pills_arr = array();
                    if (is_array($raw_pills)) {
                        $pills_arr = $raw_pills;
                    } elseif (!empty($raw_pills)) {
                        $lines = preg_split('/[\r\n,]+/', $raw_pills);
                        foreach ($lines as $l) {
                            $clean = trim($l);
                            if (!empty($clean)) $pills_arr[] = array('text' => $clean, 'icon' => '');
                        }
                    }
                    $img = get_the_post_thumbnail_url($pid, 'large');
                    if (empty($img)) {
                        $img = 'https://images.unsplash.com/photo-1574717024653-61fd2cf4d44d?w=900&h=700&fit=crop';
                    }

                    $desc = has_excerpt() ? get_the_excerpt() : wp_trim_words(get_the_content(), 28);

                    $card = array(
                        'title'      => get_the_title(),
                        'desc'       => $desc,
                        'color'      => $color,
                        'icon'       => $icon,
                        'pills'      => $pills_arr,
                        'metric_val' => get_post_meta($pid, '_project_metric_val', true),
                        'metric_lbl' => get_post_meta($pid, '_project_metric_lbl', true),
                        'image'      => $img,
                        'link'       => get_permalink(),
                        'role'       => function_exists('sarmad_get_field') ? sarmad_get_field('project_role', $pid) : get_post_meta($pid, '_project_role', true),
                        'timeline'   => function_exists('sarmad_get_field') ? sarmad_get_field('project_timeline', $pid) : get_post_meta($pid, '_project_timeline', true),
                        'tech_stack' => get_the_terms($pid, 'technology')
                    );
                    
                    get_template_part('template-parts/projects/stack-card', null, array(
                        'card' => $card,
                        'idx'  => $idx,
                    ));
                    $idx++;
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
