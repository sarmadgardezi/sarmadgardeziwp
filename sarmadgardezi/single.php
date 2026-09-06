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
                            <?php echo get_avatar($author_id, 40, '', esc_attr(get_the_author()), array('class' => 'author-thumb')); ?>
                            <div class="author-details">
                                <span class="author-name"><?php the_author_posts_link(); ?></span>
                                <span class="author-title"><?php esc_html_e('Software Engineer', 'sarmadgardezi'); ?></span>
                            </div>
                        </div>

                        <div class="article-time-info">
                            <span class="meta-separator" aria-hidden="true">&bull;</span>
                            <time class="published-date" datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                                <?php echo esc_html(get_the_date('M j, Y')); ?>
                            </time>
                            <span class="meta-separator" aria-hidden="true">&bull;</span>
                            <span class="article-read-time"><?php echo esc_html(sarmadgardezi_reading_time(get_the_ID())); ?></span>
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

                    <?php get_template_part('template-parts/blog/author-box'); ?>

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

                <?php get_template_part('template-parts/blog/related-posts'); ?>

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
