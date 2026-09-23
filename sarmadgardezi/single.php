<?php
/**
 * The template for displaying all single blog posts
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="main-content" class="site-main site-single-post-main">
    <div class="site-container">
        <?php get_template_part('template-parts/global/breadcrumbs'); ?>

        <?php
        while (have_posts()) :
            the_post();
            $author_id = get_the_author_meta('ID');
            $categories = get_the_category();
        ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('single-article'); ?>>
                <header class="article-header">
                    <?php if (!empty($categories)) : ?>
                        <div class="article-categories">
                            <?php foreach ($categories as $cat) : ?>
                                <a href="<?php echo esc_url(get_category_link($cat->term_id)); ?>" class="category-badge">
                                    <?php echo esc_html($cat->name); ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <h1 class="article-title"><?php the_title(); ?></h1>

                    <div class="article-meta">
                        <div class="article-author-info">
                            <?php echo get_avatar($author_id, 48, '', esc_attr(get_the_author()), array('class' => 'author-thumb')); ?>
                            <div class="author-details">
                                <span class="author-name"><?php the_author_posts_link(); ?></span>
                                <span class="author-title"><?php esc_html_e('Software Engineer', 'sarmadgardezi'); ?></span>
                            </div>
                        </div>

                        <div class="article-time-info">
                            <span class="meta-separator" aria-hidden="true">&bull;</span>
                            <div class="time-block">
                                <time class="published-date" datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                                    <span class="meta-icon">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                                    </span>
                                    <?php echo esc_html(get_the_date('M j, Y')); ?> at <?php echo esc_html(get_the_time('g:i a')); ?>
                                </time>
                                <?php if (get_the_modified_time('U') !== get_the_time('U')) : ?>
                                    <span class="updated-date">
                                        (Updated: <?php echo esc_html(get_the_modified_date('M j, Y')); ?>)
                                    </span>
                                <?php endif; ?>
                            </div>
                            <span class="meta-separator" aria-hidden="true">&bull;</span>
                            <span class="article-read-time">
                                <span class="meta-icon">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                                </span>
                                <?php echo esc_html(sarmadgardezi_reading_time(get_the_ID())); ?>
                            </span>
                        </div>
                    </div>
                </header>

                <?php if (has_post_thumbnail()) : ?>
                    <figure class="article-featured-image">
                        <?php
                        // Eager load with high fetch priority for optimal Core Web Vitals (LCP)
                        the_post_thumbnail('full', array(
                            'loading'       => 'eager',
                            'fetchpriority' => 'high',
                            'class'         => 'lcp-image',
                            'alt'           => get_the_title(),
                        ));
                        ?>
                        <?php if ($caption = get_the_post_thumbnail_caption()) : ?>
                            <figcaption class="image-caption"><?php echo esc_html($caption); ?></figcaption>
                        <?php endif; ?>
                    </figure>
                <?php endif; ?>

                <div class="article-content entry-content prose">
                    <?php
                    the_content();

                    wp_link_pages(array(
                        'before' => '<div class="page-links">' . esc_html__('Pages:', 'sarmadgardezi'),
                        'after'  => '</div>',
                    ));
                    ?>
                </div>

                <footer class="article-footer">
                    <?php
                    $tags = get_the_tags();
                    if (!empty($tags)) :
                    ?>
                        <div class="article-tags" aria-label="<?php esc_attr_e('Tags', 'sarmadgardezi'); ?>">
                            <span class="tags-label"><?php esc_html_e('Tagged with:', 'sarmadgardezi'); ?></span>
                            <?php foreach ($tags as $tag) : ?>
                                <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>" class="tag-chip">
                                    #<?php echo esc_html($tag->name); ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <?php 
                    // New Share Widget
                    get_template_part('template-parts/blog/share-widget'); 
                    
                    // New Related Posts List
                    get_template_part('template-parts/blog/related-posts-list');
                    
                    // Author Box
                    get_template_part('template-parts/blog/author-box'); 
                    ?>

                    <nav class="article-navigation" aria-label="<?php esc_attr_e('Adjacent posts', 'sarmadgardezi'); ?>">
                        <div class="nav-links">
                            <?php
                            $prev_post = get_previous_post();
                            if ($prev_post) :
                            ?>
                                <a href="<?php echo esc_url(get_permalink($prev_post->ID)); ?>" class="nav-previous glass-card">
                                    <span class="nav-subtitle">&larr; <?php esc_html_e('Previous Article', 'sarmadgardezi'); ?></span>
                                    <span class="nav-title"><?php echo esc_html(get_the_title($prev_post->ID)); ?></span>
                                </a>
                            <?php endif; ?>

                            <?php
                            $next_post = get_next_post();
                            if ($next_post) :
                            ?>
                                <a href="<?php echo esc_url(get_permalink($next_post->ID)); ?>" class="nav-next glass-card">
                                    <span class="nav-subtitle"><?php esc_html_e('Next Article', 'sarmadgardezi'); ?> &rarr;</span>
                                    <span class="nav-title"><?php echo esc_html(get_the_title($next_post->ID)); ?></span>
                                </a>
                            <?php endif; ?>
                        </div>
                    </nav>
                </footer>

                <!-- Old related posts removed in favor of new numbered list design -->

                <?php
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif;
                ?>
            </article>
        <?php endwhile; ?>
    </div>
</main>

<?php
get_footer();
