<?php
/**
 * The template for displaying a single event or product
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="main-content" class="site-main site-single-event-main">
    <div class="site-container single-event-container">
        
        <!-- Breadcrumb / Back Link -->
        <nav class="single-event-breadcrumbs" aria-label="<?php esc_attr_e('Breadcrumbs', 'sarmadgardezi'); ?>">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="event-back-link">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
                <span><?php esc_html_e('Back to Home', 'sarmadgardezi'); ?></span>
            </a>
        </nav>

        <?php
        while (have_posts()) :
            the_post();
            $post_id   = get_the_ID();
            $role      = get_post_meta($post_id, '_event_role', true);
            if (empty($role)) $role = get_post_meta($post_id, 'event_role', true);
            
            $timeline  = get_post_meta($post_id, '_event_timeline', true);
            if (empty($timeline)) $timeline = get_post_meta($post_id, 'event_timeline', true);
            if (empty($timeline)) $timeline = get_the_date('Y');

            $url       = get_post_meta($post_id, '_event_url', true);
            if (empty($url)) $url = get_post_meta($post_id, 'event_url', true);

            $location  = get_post_meta($post_id, '_event_location', true);
            if (empty($location)) $location = get_post_meta($post_id, 'event_location', true);

            $logo_url  = get_post_meta($post_id, '_event_logo', true);
            if (empty($logo_url)) $logo_url = get_post_meta($post_id, 'event_logo', true);
            if (empty($logo_url) && has_post_thumbnail()) {
                $logo_url = get_the_post_thumbnail_url($post_id, 'medium');
            }

            $raw_hl    = get_post_meta($post_id, '_event_highlights', true);
            if (empty($raw_hl)) $raw_hl = get_post_meta($post_id, 'event_highlights', true);
            $highlights = array();
            if (!empty($raw_hl)) {
                $hl_lines = preg_split('/[\r\n]+/', $raw_hl);
                foreach ($hl_lines as $hll) {
                    $c = trim($hll);
                    if (!empty($c)) $highlights[] = $c;
                }
            }

            $terms = get_the_terms($post_id, 'technology');
        ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('single-event-article'); ?>>
                
                <!-- Event Header Card -->
                <header class="single-event-header">
                    
                    <div class="event-header-top">
                        <?php if (!empty($logo_url)) : ?>
                            <div class="single-event-logo">
                                <img src="<?php echo esc_url($logo_url); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" />
                            </div>
                        <?php endif; ?>
                        
                        <div class="single-event-badges">
                            <?php if (!empty($timeline)) : ?>
                                <span class="event-timeline-badge"><?php echo esc_html($timeline); ?></span>
                            <?php endif; ?>
                            <?php if (!empty($location)) : ?>
                                <span class="event-location-badge"><?php echo esc_html($location); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <h1 class="single-event-title"><?php the_title(); ?></h1>

                    <?php if (!empty($role)) : ?>
                        <p class="single-event-role"><?php echo esc_html($role); ?></p>
                    <?php endif; ?>

                    <?php if (!empty($url)) : ?>
                        <div class="single-event-actions">
                            <a href="<?php echo esc_url($url); ?>" target="_blank" rel="noopener noreferrer" class="btn btn-primary event-visit-btn">
                                <span><?php esc_html_e('Visit Website / Live Product', 'sarmadgardezi'); ?></span>
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                                    <polyline points="15 3 21 3 21 9"></polyline>
                                    <line x1="10" y1="14" x2="21" y2="3"></line>
                                </svg>
                            </a>
                        </div>
                    <?php endif; ?>

                </header>

                <!-- Main Content Body -->
                <div class="single-event-body">
                    
                    <?php if (!empty($highlights)) : ?>
                        <div class="single-event-highlights-card">
                            <h3 class="highlights-heading"><?php esc_html_e('Key Highlights & Achievements', 'sarmadgardezi'); ?></h3>
                            <ul class="highlights-list">
                                <?php foreach ($highlights as $hl) : ?>
                                    <li class="highlight-item">
                                        <span class="hl-check" aria-hidden="true">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#0d9488" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                                <polyline points="20 6 9 17 4 12"></polyline>
                                            </svg>
                                        </span>
                                        <span class="hl-text"><?php echo esc_html($hl); ?></span>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <!-- Editorial Content -->
                    <div class="single-event-content prose">
                        <?php the_content(); ?>
                    </div>

                    <!-- Tech Stack Tags -->
                    <?php if (!empty($terms) && !is_wp_error($terms)) : ?>
                        <div class="single-event-tech-stack">
                            <h4 class="tech-stack-title"><?php esc_html_e('Core Technologies & Frameworks', 'sarmadgardezi'); ?></h4>
                            <div class="tech-stack-pills">
                                <?php foreach ($terms as $term) : ?>
                                    <span class="tech-pill"><?php echo esc_html($term->name); ?></span>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                </div>

                <!-- Next / Prev Event Nav -->
                <nav class="single-event-post-nav" aria-label="<?php esc_attr_e('Event Navigation', 'sarmadgardezi'); ?>">
                    <div class="nav-prev">
                        <?php previous_post_link('%link', '← %title'); ?>
                    </div>
                    <div class="nav-next">
                        <?php next_post_link('%link', '%title →'); ?>
                    </div>
                </nav>

            </article>
        <?php endwhile; ?>

    </div>

    <!-- Pre-footer CTA -->
    <?php get_template_part('template-parts/home/contact-cta'); ?>

</main>

<?php
get_footer();
