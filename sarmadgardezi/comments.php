<?php
/**
 * The template for displaying comments
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;

if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area glass-card">
    <?php if (have_comments()) : ?>
        <h2 class="comments-title">
            <?php
            $comment_count = get_comments_number();
            if ('1' === $comment_count) {
                printf(
                    /* translators: 1: title. */
                    esc_html__('One thought on &ldquo;%1$s&rdquo;', 'sarmadgardezi'),
                    '<span>' . wp_kses_post(get_the_title()) . '</span>'
                );
            } else {
                printf(
                    /* translators: 1: comment count number, 2: title. */
                    esc_html(_nx('%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $comment_count, 'comments title', 'sarmadgardezi')),
                    number_format_i18n($comment_count),
                    '<span>' . wp_kses_post(get_the_title()) . '</span>'
                );
            }
            ?>
        </h2>

        <?php the_comments_navigation(); ?>

        <ol class="comment-list">
            <?php
            wp_list_comments(array(
                'style'       => 'ol',
                'short_ping'  => true,
                'avatar_size' => 48,
            ));
            ?>
        </ol>

        <?php
        the_comments_navigation();

        if (!comments_open()) :
        ?>
            <p class="no-comments"><?php esc_html_e('Comments are closed.', 'sarmadgardezi'); ?></p>
        <?php
        endif;

    endif; // have_comments()

    comment_form(array(
        'class_form'           => 'comment-form glass-card-nested',
        'title_reply_before'   => '<h3 id="reply-title" class="comment-reply-title">',
        'title_reply_after'    => '</h3>',
        'title_reply'          => esc_html__('Leave a Discussion Reply', 'sarmadgardezi'),
        'comment_notes_before' => '<p class="comment-notes"><span id="email-notes">' . esc_html__('Your email address will not be published. Required fields are marked *', 'sarmadgardezi') . '</span></p>',
        'submit_button'        => '<button name="%1$s" type="submit" id="%2$s" class="%3$s btn btn-primary"><span>' . esc_html__('Post Comment', 'sarmadgardezi') . '</span></button>',
    ));
    ?>
</div>
