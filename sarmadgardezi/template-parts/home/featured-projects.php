<?php
/**
 * Template part for displaying the homepage featured projects section
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;

// Query custom post type 'project' if registered, or provide initial fallback data.
$projects_query = new WP_Query(array(
    'post_type'      => 'project',
    'posts_per_page' => 4,
    'post_status'    => 'publish',
));
?>

<section id="projects" class="home-section projects-section">
    <div class="site-container">
        <div class="section-header-flex">
            <div>
                <span class="section-subtitle"><?php esc_html_e('Selected Works', 'sarmadgardezi'); ?></span>
                <h2 class="section-title"><?php esc_html_e('Featured Projects & Applications', 'sarmadgardezi'); ?></h2>
            </div>
            <a href="<?php echo esc_url(get_post_type_archive_link('project') ?: '#'); ?>" class="link-arrow">
                <span><?php esc_html_e('View All Projects', 'sarmadgardezi'); ?></span>
                <?php echo sarmadgardezi_get_icon('arrow-right'); ?>
            </a>
        </div>

        <div class="projects-grid">
            <?php
            if ($projects_query->have_posts()) :
                while ($projects_query->have_posts()) :
                    $projects_query->the_post();
                    ?>
                    <article class="glass-card project-card">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="project-thumb">
                                <?php the_post_thumbnail('sarmadgardezi-card'); ?>
                            </div>
                        <?php endif; ?>
                        <div class="project-info">
                            <h3 class="project-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <div class="project-excerpt"><?php the_excerpt(); ?></div>
                        </div>
                    </article>
                    <?php
                endwhile;
                wp_reset_postdata();
            else :
                // Fallback demonstration projects before CPT entries are published
                $default_projects = array(
                    array(
                        'title' => __('Next-Gen Enterprise Portal', 'sarmadgardezi'),
                        'desc'  => __('Full-stack headless web app featuring real-time analytics and custom REST synchronization.', 'sarmadgardezi'),
                        'tags'  => array('WordPress REST', 'React', 'Tailwind', 'Redis'),
                    ),
                    array(
                        'title' => __('High-Throughput E-Commerce Engine', 'sarmadgardezi'),
                        'desc'  => __('Bespoke WooCommerce checkout architecture handling 50k+ transactions per day seamlessly.', 'sarmadgardezi'),
                        'tags'  => array('WooCommerce', 'PHP 8.2', 'Stripe API', 'PostgreSQL'),
                    ),
                    array(
                        'title' => __('Developer Experience Toolkit', 'sarmadgardezi'),
                        'desc'  => __('Command-line and scaffold workflow suite reducing theme development onboarding by 70%.', 'sarmadgardezi'),
                        'tags'  => array('Node.js', 'WP-CLI', 'Docker', 'SCSS'),
                    ),
                );

                foreach ($default_projects as $proj) :
                    ?>
                    <article class="glass-card project-card">
                        <div class="project-card-header">
                            <div class="project-icon-badge">
                                <?php echo sarmadgardezi_get_icon('terminal'); ?>
                            </div>
                            <span class="project-badge"><?php esc_html_e('Featured', 'sarmadgardezi'); ?></span>
                        </div>
                        <h3 class="project-title"><?php echo esc_html($proj['title']); ?></h3>
                        <p class="project-excerpt"><?php echo esc_html($proj['desc']); ?></p>
                        <div class="project-tags">
                            <?php foreach ($proj['tags'] as $tag) : ?>
                                <span class="badge badge-pill"><?php echo esc_html($tag); ?></span>
                            <?php endforeach; ?>
                        </div>
                    </article>
                    <?php
                endforeach;
            endif;
            ?>
        </div>
    </div>
</section>
