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
    
    <h1 class="page-title" style="font-size: clamp(2.5rem, 6vw, 4.5rem); font-weight: 800; text-transform: uppercase; letter-spacing: -0.02em; margin-bottom: 1rem; color: #000; line-height: 1.1;">
        <?php echo wp_kses_post($title); ?>
    </h1>
    
    <?php if (!empty($description)) : ?>
        <p class="page-description" style="max-width: 800px; margin: 0 <?php echo $align === 'center' ? 'auto' : '0'; ?>; font-size: 1.125rem; color: #666; line-height: 1.6;">
            <?php echo wp_kses_post($description); ?>
        </p>
    <?php endif; ?>
</header>
