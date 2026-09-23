<?php
/**
 * Template part for displaying the Share Widget on single posts
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;

$post_id = get_the_ID();
$post_url = urlencode(get_permalink());
$post_title = urlencode(get_the_title());

// Fetch current counts from DB, default to 25 if empty
$likes = get_post_meta($post_id, '_post_like_count', true);
$likes = ($likes === '') ? 25 : intval($likes);

$shares = get_post_meta($post_id, '_post_share_count', true);
$shares = ($shares === '') ? 25 : intval($shares);

// Format number (e.g. 1200 -> 1.2K)
function sarmadgardezi_format_count($num) {
    if ($num >= 1000) {
        return round($num / 1000, 1) . 'K';
    }
    return $num;
}
?>

<div class="post-share-widget" data-post-id="<?php echo esc_attr($post_id); ?>" data-nonce="<?php echo esc_attr(wp_create_nonce('sarmadgardezi_share_nonce')); ?>" data-ajaxurl="<?php echo esc_url(admin_url('admin-ajax.php')); ?>">
    <div class="share-widget-left">
        <button type="button" class="action-pill action-like" aria-label="Like post">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
            <span class="like-count-text"><?php echo esc_html(sarmadgardezi_format_count($likes)); ?> Likes</span>
        </button>
        <button type="button" class="action-pill action-share">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="18" cy="5" r="3"></circle><circle cx="6" cy="12" r="3"></circle><circle cx="18" cy="19" r="3"></circle><line x1="8.59" y1="13.51" x2="15.42" y2="17.49"></line><line x1="15.41" y1="6.51" x2="8.59" y2="10.49"></line></svg>
            <span class="share-count-text"><?php echo esc_html(sarmadgardezi_format_count($shares)); ?> Shares</span>
        </button>
    </div>

    <div class="share-widget-right">
        <span class="share-label">SHARE ON</span>
        <div class="social-share-links">
            <a href="https://twitter.com/intent/tweet?url=<?php echo $post_url; ?>&text=<?php echo $post_title; ?>" target="_blank" rel="noopener noreferrer" class="social-circle js-social-share" aria-label="Share on Twitter">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"></path></svg>
            </a>
            <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $post_url; ?>&title=<?php echo $post_title; ?>" target="_blank" rel="noopener noreferrer" class="social-circle js-social-share" aria-label="Share on LinkedIn">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path><rect x="2" y="9" width="4" height="12"></rect><circle cx="4" cy="4" r="2"></circle></svg>
            </a>
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $post_url; ?>" target="_blank" rel="noopener noreferrer" class="social-circle js-social-share" aria-label="Share on Facebook">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>
            </a>
            <button type="button" class="social-circle js-social-share copy-link-btn" aria-label="Copy link" data-url="<?php echo esc_url(get_permalink()); ?>">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path></svg>
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const widget = document.querySelector('.post-share-widget');
    if (!widget) return;

    const postId = widget.getAttribute('data-post-id');
    const nonce = widget.getAttribute('data-nonce');
    const ajaxurl = widget.getAttribute('data-ajaxurl');

    const likeBtn = widget.querySelector('.action-like');
    const likeText = widget.querySelector('.like-count-text');
    let hasLiked = localStorage.getItem(`sarmad_liked_${postId}`);

    if (hasLiked && likeBtn) {
        likeBtn.style.opacity = '0.7';
        likeBtn.style.pointerEvents = 'none';
        likeBtn.querySelector('svg').setAttribute('fill', 'currentColor');
    }

    if (likeBtn && !hasLiked) {
        likeBtn.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Optimistic update
            let currentText = likeText.innerText;
            let currentNum = parseFloat(currentText) || 0;
            // Basic increment logic (not perfect for 1.2K strings, but handles base numbers)
            if (!currentText.includes('K')) {
                likeText.innerText = (currentNum + 1) + ' Likes';
            }
            
            // UI state
            likeBtn.style.opacity = '0.7';
            likeBtn.style.pointerEvents = 'none';
            likeBtn.querySelector('svg').setAttribute('fill', 'currentColor');
            localStorage.setItem(`sarmad_liked_${postId}`, 'true');

            // AJAX Call
            const formData = new FormData();
            formData.append('action', 'sarmadgardezi_like_post');
            formData.append('post_id', postId);
            formData.append('nonce', nonce);

            fetch(ajaxurl, {
                method: 'POST',
                body: formData
            }).then(res => res.json()).then(data => {
                if (data.success && data.data.new_count) {
                    let num = data.data.new_count;
                    if (num >= 1000) num = (num/1000).toFixed(1) + 'K';
                    likeText.innerText = num + ' Likes';
                }
            });
        });
    }

    const shareBtns = widget.querySelectorAll('.js-social-share');
    const shareText = widget.querySelector('.share-count-text');
    let hasShared = localStorage.getItem(`sarmad_shared_${postId}`);

    shareBtns.forEach(btn => {
        btn.addEventListener('click', function(e) {
            if (this.classList.contains('copy-link-btn')) {
                e.preventDefault();
                const url = this.getAttribute('data-url');
                if (url) {
                    navigator.clipboard.writeText(url).then(() => {
                        alert('Link copied to clipboard!');
                    });
                }
            }

            if (!hasShared) {
                hasShared = true;
                localStorage.setItem(`sarmad_shared_${postId}`, 'true');

                // Optimistic update
                let currentText = shareText.innerText;
                let currentNum = parseFloat(currentText) || 0;
                if (!currentText.includes('K')) {
                    shareText.innerText = (currentNum + 1) + ' Shares';
                }

                // AJAX Call
                const formData = new FormData();
                formData.append('action', 'sarmadgardezi_share_post');
                formData.append('post_id', postId);
                formData.append('nonce', nonce);

                fetch(ajaxurl, {
                    method: 'POST',
                    body: formData
                }).then(res => res.json()).then(data => {
                    if (data.success && data.data.new_count) {
                        let num = data.data.new_count;
                        if (num >= 1000) num = (num/1000).toFixed(1) + 'K';
                        shareText.innerText = num + ' Shares';
                    }
                });
            }
        });
    });
});
</script>
