<?php
/**
 * Native SEO Framework
 *
 * Handles metadata, schema, and breadcrumbs without third-party plugins.
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;

/* ------------------------------------------------------------------------- *
 * 1. NATIVE META BOXES FOR SEO
 * ------------------------------------------------------------------------- */

function sarmadgardezi_add_seo_meta_boxes() {
    $screens = array('post', 'page', 'project', 'talk', 'case-study');
    foreach ($screens as $screen) {
        add_meta_box(
            'sarmadgardezi_seo_meta_box',
            __('SEO Settings', 'sarmadgardezi'),
            'sarmadgardezi_render_seo_meta_box',
            $screen,
            'normal',
            'high'
        );
    }
}
add_action('add_meta_boxes', 'sarmadgardezi_add_seo_meta_boxes');

function sarmadgardezi_render_seo_meta_box($post) {
    wp_nonce_field('sarmadgardezi_seo_nonce_action', 'sarmadgardezi_seo_nonce');
    $seo_title = get_post_meta($post->ID, '_sarmadgardezi_seo_title', true);
    $seo_desc  = get_post_meta($post->ID, '_sarmadgardezi_seo_desc', true);
    ?>
    <p>
        <label for="sarmadgardezi_seo_title"><strong><?php _e('SEO Title', 'sarmadgardezi'); ?></strong></label><br>
        <input type="text" id="sarmadgardezi_seo_title" name="sarmadgardezi_seo_title" value="<?php echo esc_attr($seo_title); ?>" style="width:100%;" placeholder="Overrides default title...">
    </p>
    <p>
        <label for="sarmadgardezi_seo_desc"><strong><?php _e('SEO Description', 'sarmadgardezi'); ?></strong></label><br>
        <textarea id="sarmadgardezi_seo_desc" name="sarmadgardezi_seo_desc" rows="3" style="width:100%;" placeholder="Custom meta description..."><?php echo esc_textarea($seo_desc); ?></textarea>
    </p>
    <?php
}

function sarmadgardezi_save_seo_meta_box($post_id) {
    if (!isset($_POST['sarmadgardezi_seo_nonce']) || !wp_verify_nonce($_POST['sarmadgardezi_seo_nonce'], 'sarmadgardezi_seo_nonce_action')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    if (isset($_POST['sarmadgardezi_seo_title'])) {
        update_post_meta($post_id, '_sarmadgardezi_seo_title', sanitize_text_field($_POST['sarmadgardezi_seo_title']));
    }
    if (isset($_POST['sarmadgardezi_seo_desc'])) {
        update_post_meta($post_id, '_sarmadgardezi_seo_desc', sanitize_textarea_field($_POST['sarmadgardezi_seo_desc']));
    }
}
add_action('save_post', 'sarmadgardezi_save_seo_meta_box');


/* ------------------------------------------------------------------------- *
 * 2. METADATA GENERATION
 * ------------------------------------------------------------------------- */

/**
 * Filter the document title based on custom SEO title.
 */
function sarmadgardezi_filter_document_title($title_parts) {
    if (is_singular()) {
        $custom_title = get_post_meta(get_the_ID(), '_sarmadgardezi_seo_title', true);
        if (!empty($custom_title)) {
            $title_parts['title'] = $custom_title;
        }
    }
    return $title_parts;
}
add_filter('document_title_parts', 'sarmadgardezi_filter_document_title', 10, 1);

/**
 * Output SEO tags to <head>.
 */
function sarmadgardezi_output_seo_tags() {
    $site_name = get_bloginfo('name');
    $url       = home_url(add_query_arg(null, null));
    $type      = 'website';
    $title     = wp_get_document_title();
    $desc      = get_bloginfo('description');
    $image     = '';

    // If singular, override with post data
    if (is_singular()) {
        $post_id = get_the_ID();
        $type    = 'article';
        
        $custom_desc = get_post_meta($post_id, '_sarmadgardezi_seo_desc', true);
        if (!empty($custom_desc)) {
            $desc = $custom_desc;
        } elseif (has_excerpt()) {
            $desc = get_the_excerpt();
        } else {
            $desc = wp_trim_words(get_post_field('post_content', $post_id), 25);
        }

        if (has_post_thumbnail()) {
            $image = get_the_post_thumbnail_url($post_id, 'large');
        }
    }

    $desc = strip_tags(strip_shortcodes($desc));
    $desc = str_replace(array("\n", "\r", "\t"), ' ', $desc);
    $desc = esc_attr($desc);

    echo "<!-- Native SEO Framework -->\n";
    echo "<meta name=\"description\" content=\"{$desc}\" />\n";

    // Canonical URL (WordPress outputs one by default on singular, but we ensure it's exact)
    if (!has_action('wp_head', 'rel_canonical')) {
        echo "<link rel=\"canonical\" href=\"" . esc_url($url) . "\" />\n";
    }

    // Open Graph
    echo "<meta property=\"og:title\" content=\"" . esc_attr($title) . "\" />\n";
    echo "<meta property=\"og:description\" content=\"{$desc}\" />\n";
    echo "<meta property=\"og:url\" content=\"" . esc_url($url) . "\" />\n";
    echo "<meta property=\"og:type\" content=\"{$type}\" />\n";
    echo "<meta property=\"og:site_name\" content=\"" . esc_attr($site_name) . "\" />\n";
    
    if (!empty($image)) {
        echo "<meta property=\"og:image\" content=\"" . esc_url($image) . "\" />\n";
    }

    // Twitter Cards
    echo "<meta name=\"twitter:card\" content=\"summary_large_image\" />\n";
    echo "<meta name=\"twitter:title\" content=\"" . esc_attr($title) . "\" />\n";
    echo "<meta name=\"twitter:description\" content=\"{$desc}\" />\n";
    if (!empty($image)) {
        echo "<meta name=\"twitter:image\" content=\"" . esc_url($image) . "\" />\n";
    }

    // Robots directives for non-indexable pages
    if (is_search() || is_404()) {
        echo "<meta name=\"robots\" content=\"noindex, nofollow\" />\n";
    } else {
        echo "<meta name=\"robots\" content=\"index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1\" />\n";
    }
}
add_action('wp_head', 'sarmadgardezi_output_seo_tags', 1);


/* ------------------------------------------------------------------------- *
 * 3. SCHEMA.ORG JSON-LD GENERATION
 * ------------------------------------------------------------------------- */

function sarmadgardezi_output_json_ld() {
    $schema = array(
        '@context' => 'https://schema.org',
        '@graph'   => array()
    );

    $site_url = home_url('/');
    
    // 1. WebSite Schema
    $schema['@graph'][] = array(
        '@type' => 'WebSite',
        '@id'   => $site_url . '#website',
        'url'   => $site_url,
        'name'  => get_bloginfo('name'),
        'description' => get_bloginfo('description'),
        'publisher' => array('@id' => $site_url . '#person')
    );

    // 2. Person Schema (Sarmad Gardezi)
    $schema['@graph'][] = array(
        '@type' => 'Person',
        '@id'   => $site_url . '#person',
        'name'  => 'Sarmad Gardezi',
        'url'   => $site_url,
        'jobTitle' => 'Software Engineer',
        'affiliation' => array(
            '@type' => 'Organization',
            'name'  => 'Google Developer Groups Cloud Islamabad'
        ),
        'sameAs' => array(
            'https://github.com/sarmadgardezi',
            'https://linkedin.com/in/sarmadgardezi',
            'https://twitter.com/sarmadgardezi'
        )
    );

    // 3. Page/Article specific schema
    if (is_singular()) {
        $post_id = get_the_ID();
        $type = 'WebPage';
        
        if (is_singular('post')) {
            $type = 'Article';
        } elseif (is_singular('project')) {
            $type = 'SoftwareApplication';
        }

        $item_schema = array(
            '@type' => $type,
            '@id'   => get_permalink() . '#webpage',
            'url'   => get_permalink(),
            'name'  => get_the_title(),
            'datePublished' => get_the_date('c'),
            'dateModified'  => get_the_modified_date('c'),
            'isPartOf' => array('@id' => $site_url . '#website'),
            'author'   => array('@id' => $site_url . '#person')
        );

        if (has_post_thumbnail()) {
            $item_schema['image'] = get_the_post_thumbnail_url($post_id, 'full');
        }
        
        if ($type === 'Article') {
            $item_schema['headline'] = get_the_title();
            $item_schema['publisher'] = array('@id' => $site_url . '#person');
        }

        if ($type === 'SoftwareApplication') {
            $item_schema['applicationCategory'] = 'DeveloperApplication';
            $item_schema['operatingSystem'] = 'Any';
        }

        $schema['@graph'][] = $item_schema;
    }

    echo "\n<script type=\"application/ld+json\">\n";
    echo wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    echo "\n</script>\n";
}
add_action('wp_head', 'sarmadgardezi_output_json_ld', 10);


/* ------------------------------------------------------------------------- *
 * 4. BREADCRUMBS
 * ------------------------------------------------------------------------- */

/**
 * Render Breadcrumbs with semantic HTML5 wrapper and schema.org markup.
 *
 * @param string $class Additional CSS classes for the nav element.
 */
function sarmadgardezi_breadcrumbs($class = '') {
    if (is_front_page()) {
        return;
    }

    $nav_class = 'site-breadcrumbs' . ($class ? ' ' . esc_attr($class) : '');

    echo '<nav class="' . esc_attr($nav_class) . '" aria-label="' . esc_attr__('Breadcrumb navigation', 'sarmadgardezi') . '">';
    echo '<ol class="breadcrumbs-list" itemscope itemtype="https://schema.org/BreadcrumbList">';
    
    // Home item
    echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
    echo '<a itemprop="item" href="' . esc_url(home_url('/')) . '"><span itemprop="name">' . esc_html__('Home', 'sarmadgardezi') . '</span></a>';
    echo '<meta itemprop="position" content="1" />';
    echo '<span class="breadcrumb-separator" aria-hidden="true">/</span>';
    echo '</li>';

    $position = 2;

    if (is_home()) {
        echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
        echo '<span itemprop="name" aria-current="page">' . esc_html__('Blog', 'sarmadgardezi') . '</span>';
        echo '<meta itemprop="position" content="' . $position . '" />';
        echo '</li>';
    } elseif (is_singular('post')) {
        $blog_page_id = get_option('page_for_posts');
        $blog_url = $blog_page_id ? get_permalink($blog_page_id) : home_url('/blog/');
        echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
        echo '<a itemprop="item" href="' . esc_url($blog_url) . '"><span itemprop="name">' . esc_html__('Blog', 'sarmadgardezi') . '</span></a>';
        echo '<meta itemprop="position" content="' . $position++ . '" />';
        echo '<span class="breadcrumb-separator" aria-hidden="true">/</span>';
        echo '</li>';
        echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
        echo '<span itemprop="name" aria-current="page">' . esc_html(get_the_title()) . '</span>';
        echo '<meta itemprop="position" content="' . $position . '" />';
        echo '</li>';
    } elseif (is_singular('project')) {
        echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
        echo '<a itemprop="item" href="' . esc_url(home_url('/projects/')) . '"><span itemprop="name">' . esc_html__('Projects', 'sarmadgardezi') . '</span></a>';
        echo '<meta itemprop="position" content="' . $position++ . '" />';
        echo '<span class="breadcrumb-separator" aria-hidden="true">/</span>';
        echo '</li>';
        echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
        echo '<span itemprop="name" aria-current="page">' . esc_html(get_the_title()) . '</span>';
        echo '<meta itemprop="position" content="' . $position . '" />';
        echo '</li>';
    } elseif (is_singular('talk')) {
        echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
        echo '<a itemprop="item" href="' . esc_url(home_url('/talks/')) . '"><span itemprop="name">' . esc_html__('Talks', 'sarmadgardezi') . '</span></a>';
        echo '<meta itemprop="position" content="' . $position++ . '" />';
        echo '<span class="breadcrumb-separator" aria-hidden="true">/</span>';
        echo '</li>';
        echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
        echo '<span itemprop="name" aria-current="page">' . esc_html(get_the_title()) . '</span>';
        echo '<meta itemprop="position" content="' . $position . '" />';
        echo '</li>';
    } elseif (is_singular('case-study')) {
        echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
        echo '<a itemprop="item" href="' . esc_url(home_url('/case-studies/')) . '"><span itemprop="name">' . esc_html__('Case Studies', 'sarmadgardezi') . '</span></a>';
        echo '<meta itemprop="position" content="' . $position++ . '" />';
        echo '<span class="breadcrumb-separator" aria-hidden="true">/</span>';
        echo '</li>';
        echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
        echo '<span itemprop="name" aria-current="page">' . esc_html(get_the_title()) . '</span>';
        echo '<meta itemprop="position" content="' . $position . '" />';
        echo '</li>';
    } elseif (is_post_type_archive('project')) {
        echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
        echo '<span itemprop="name" aria-current="page">' . esc_html__('Projects', 'sarmadgardezi') . '</span>';
        echo '<meta itemprop="position" content="' . $position . '" />';
        echo '</li>';
    } elseif (is_post_type_archive('talk')) {
        echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
        echo '<span itemprop="name" aria-current="page">' . esc_html__('Talks', 'sarmadgardezi') . '</span>';
        echo '<meta itemprop="position" content="' . $position . '" />';
        echo '</li>';
    } elseif (is_post_type_archive('case-study')) {
        echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
        echo '<span itemprop="name" aria-current="page">' . esc_html__('Case Studies', 'sarmadgardezi') . '</span>';
        echo '<meta itemprop="position" content="' . $position . '" />';
        echo '</li>';
    } elseif (is_page()) {
        echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
        echo '<span itemprop="name" aria-current="page">' . esc_html(get_the_title()) . '</span>';
        echo '<meta itemprop="position" content="' . $position . '" />';
        echo '</li>';
    } elseif (is_archive()) {
        echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
        echo '<span itemprop="name" aria-current="page">' . esc_html(get_the_archive_title()) . '</span>';
        echo '<meta itemprop="position" content="' . $position . '" />';
        echo '</li>';
    } elseif (is_search()) {
        echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
        echo '<span itemprop="name" aria-current="page">' . sprintf(esc_html__('Search: "%s"', 'sarmadgardezi'), get_search_query()) . '</span>';
        echo '<meta itemprop="position" content="' . $position . '" />';
        echo '</li>';
    } elseif (is_404()) {
        echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
        echo '<span itemprop="name" aria-current="page">' . esc_html__('404 Not Found', 'sarmadgardezi') . '</span>';
        echo '<meta itemprop="position" content="' . $position . '" />';
        echo '</li>';
    }

    echo '</ol>';
    echo '</nav>';
}
