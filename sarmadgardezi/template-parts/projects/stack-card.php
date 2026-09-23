<?php
/**
 * Stack Card Template Part
 * Used in featured projects and project archive.
 */

if (empty($args['card'])) return;
$card = $args['card'];
$idx  = isset($args['idx']) ? $args['idx'] : 0;

// Build the outline string from pills or tech stack
$outline_texts = array();
if (!empty($card['pills'])) {
    foreach ($card['pills'] as $pill) {
        $outline_texts[] = is_array($pill) ? ($pill['text'] ?? '') : $pill;
    }
} elseif (!empty($card['tech_stack']) && !is_wp_error($card['tech_stack'])) {
    foreach ($card['tech_stack'] as $term) {
        $outline_texts[] = $term->name;
    }
}
$outline_string = !empty($outline_texts) ? implode(' &bull; ', array_filter($outline_texts)) : 'CASE STUDY';
?>

<article 
    class="portfolio-stack-card card-color-<?php echo esc_attr($card['color']); ?>"
    style="--card-index: <?php echo esc_attr($idx); ?>;"
>
    <!-- Floating Decorative Star -->
    <div class="decorative-star">✦</div>

    <div class="stack-card-inner">
        <!-- Card Content Grid -->
        <div class="stack-card-grid">
            
            <!-- Left Details Column -->
            <div class="stack-card-content">
                
                <div class="card-badges">
                    <span class="live-badge">
                        <span class="pulse-dot"></span> LIVE PROJECT
                    </span>
                    <span class="outline-badge">
                        <?php echo wp_kses_post($outline_string); ?>
                    </span>
                </div>

                <h3 class="stack-card-title serif-title">
                    <?php echo esc_html($card['title']); ?>
                </h3>

                <div class="stack-card-desc">
                    <p><?php echo esc_html($card['desc']); ?></p>
                </div>
                
                <?php if (!empty($card['link']) && $card['link'] !== '#') : ?>
                    <a href="<?php echo esc_url($card['link']); ?>" class="card-hidden-link" aria-label="<?php esc_attr_e('View Project', 'sarmadgardezi'); ?>"></a>
                <?php endif; ?>
            </div>

            <!-- Right Visual Column -->
            <div class="stack-card-visual-wrap">
                <div class="stack-card-visual-link">
                    <img 
                        src="<?php echo esc_url($card['image']); ?>" 
                        alt="<?php echo esc_attr($card['title']); ?>" 
                        class="stack-card-img"
                        loading="lazy"
                    />
                </div>
            </div>

        </div>
    </div>
</article>
