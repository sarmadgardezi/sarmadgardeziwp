<?php
/**
 * Author Bio Box Template Part
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;

$author_id = get_the_author_meta('ID');
$author_name = get_the_author_meta('display_name');
$author_bio = get_the_author_meta('description');

if (empty($author_bio)) {
    $author_bio = __('Software Engineer and Associate Manager at Google Developer Groups Cloud Islamabad. Writing on full-stack web engineering, cloud infrastructure, Next.js, and Google AI.', 'sarmadgardezi');
}
?>

<div class="author-bio-box glass-card">
    <div class="author-bio-avatar">
        <?php echo get_avatar($author_id, 96, '', esc_attr($author_name), array('class' => 'author-img')); ?>
    </div>
    <div class="author-bio-content">
        <span class="author-bio-label"><?php esc_html_e('Written by', 'sarmadgardezi'); ?></span>
        <h3 class="author-bio-name">
            <a href="<?php echo esc_url(home_url('/about/')); ?>">
                <?php echo esc_html($author_name); ?>
            </a>
        </h3>
        <p class="author-bio-text"><?php echo esc_html($author_bio); ?></p>
        <div class="author-bio-links">
            <a href="https://github.com/sarmadgardezi" target="_blank" rel="noopener noreferrer" aria-label="GitHub">
                <?php echo sarmadgardezi_get_icon('github'); ?>
                <span>GitHub</span>
            </a>
            <a href="https://linkedin.com/in/sarmadgardezi" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn">
                <?php echo sarmadgardezi_get_icon('linkedin'); ?>
                <span>LinkedIn</span>
            </a>
            <a href="https://twitter.com/sarmadgardezi" target="_blank" rel="noopener noreferrer" aria-label="Twitter">
                <?php echo sarmadgardezi_get_icon('twitter'); ?>
                <span>Twitter / X</span>
            </a>
        </div>
    </div>
</div>
