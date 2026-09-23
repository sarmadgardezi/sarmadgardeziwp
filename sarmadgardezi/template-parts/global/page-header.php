<?php
/**
 * Global Page Header Template Part
 *
 * Reusable header for standard pages, archives, and custom post types.
 *
 * @package SarmadGardezi
 *
 * Expected Args:
 * - title: The main H1 title.
 * - description: The subtitle / excerpt.
 * - align: Text alignment (left, center, right). Default 'center'.
 */

$title = isset($args['title']) ? $args['title'] : get_the_title();
$description = isset($args['description']) ? $args['description'] : '';

// For standard pages, try to get excerpt if description is empty
if (empty($description) && is_page() && has_excerpt()) {
    $description = get_the_excerpt();
}

$align = isset($args['align']) ? $args['align'] : 'center';
?>

<header class="global-page-header" style="text-align: <?php echo esc_attr($align); ?>; padding: 2rem 0 3rem; margin-bottom: 2rem;">
    <?php 
    // Output breadcrumbs above the title
    get_template_part('template-parts/global/breadcrumbs'); 
    ?>
    
    <h1 class="page-title" style="font-family: var(--framer-font-family-bold, 'Google Sans Flex', -apple-system, sans-serif); font-size: clamp(2.5rem, 6vw, 4.5rem); font-weight: 900; letter-spacing: -0.04em; margin-bottom: 1.35rem; color: #111827; line-height: 1.05;">
        <?php echo wp_kses_post($title); ?>
    </h1>
    
    <?php if (!empty($description)) : ?>
        <p class="page-description" style="font-family: var(--framer-font-family, 'Google Sans Flex', sans-serif); max-width: 640px; margin: 0 <?php echo $align === 'center' ? 'auto' : '0'; ?>; font-size: clamp(1.05rem, 1.5vw, 1.1875rem); font-weight: 500; color: #4b5563; line-height: 1.6; letter-spacing: -0.015em;">
            <?php echo wp_kses_post($description); ?>
        </p>
    <?php endif; ?>
</header>
