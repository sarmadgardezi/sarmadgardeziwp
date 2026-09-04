<?php
/**
 * Main template file.
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

<main style="max-width: 1200px; margin: 100px auto; padding: 40px;">
    <h1>Sarmad Gardezi</h1>
    <p>My custom WordPress theme is working.</p>
</main>

<?php wp_footer(); ?>

</body>
</html>