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
    </div>

    <?php
    while (have_posts()) :
        the_post();
        $categories = get_the_category();
    ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class('single-article'); ?>>
            <header class="single-post-hero-section">
                <div class="site-container">
                    <?php if (!empty($categories)) : ?>
                        <div class="hero-category">
                            <?php echo esc_html($categories[0]->name); ?>
                        </div>
                    <?php endif; ?>

                    <h1 class="hero-title"><?php the_title(); ?></h1>
                    
                    <?php if (has_excerpt()) : ?>
                        <div class="hero-excerpt">
                            <?php echo get_the_excerpt(); ?>
                        </div>
                    <?php endif; ?>

                    <hr class="hero-separator" />

                    <div class="hero-date">
                        Posted on <?php echo esc_html(get_the_date('F j, Y')); ?>
                    </div>
                </div>
            </header>

            <div class="site-container">

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
            </div> <!-- /.site-container -->
        </article>
    <?php endwhile; ?>
</main>

<?php
get_footer();
