<?php
/**
 * Stack Card Template Part
 * Used in featured projects and project archive.
 */

// We expect $args to contain the card data:
// $card = $args['card'];
// $idx  = $args['idx'];

if (empty($args['card'])) return;
$card = $args['card'];
$idx  = isset($args['idx']) ? $args['idx'] : 0;
?>

<article 
    class="portfolio-stack-card card-color-<?php echo esc_attr($card['color']); ?>"
    style="--card-index: <?php echo esc_attr($idx); ?>;"
>
    <!-- Top-Right Dark Icon Bubble -->
    <div class="stack-card-icon-badge" aria-hidden="true">
        <?php echo sarmadgardezi_render_card_icon($card['icon']); ?>
    </div>

    <!-- Card Content Grid -->
    <div class="stack-card-grid">
        <!-- Left Details Column -->
        <div class="stack-card-content">
            <h3 class="stack-card-title">
                <?php echo esc_html($card['title']); ?>
            </h3>

            <div class="stack-card-desc">
                <p><?php echo esc_html($card['desc']); ?></p>
            </div>
            
            <?php if (!empty($card['role']) || !empty($card['timeline'])) : ?>
                <div class="project-card-meta stack-card-meta" style="margin-bottom: 1.5rem;">
                    <?php if (!empty($card['role'])) : ?>
                        <span class="project-role" style="font-weight: 600;"><?php echo esc_html($card['role']); ?></span>
                    <?php endif; ?>
                    <?php if (!empty($card['role']) && !empty($card['timeline'])) : ?>
                        <span class="meta-dot" aria-hidden="true" style="margin: 0 8px;">&bull;</span>
                    <?php endif; ?>
                    <?php if (!empty($card['timeline'])) : ?>
                        <span class="project-timeline"><?php echo esc_html($card['timeline']); ?></span>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($card['tech_stack']) && !is_wp_error($card['tech_stack'])) : ?>
                <div class="project-tech-stack stack-card-tech" style="margin-bottom: 1.5rem;" aria-label="<?php esc_attr_e('Technologies used', 'sarmadgardezi'); ?>">
                    <?php foreach ($card['tech_stack'] as $term) : ?>
                        <span class="tech-badge stack-card-tech-badge" style="padding: 4px 10px; border-radius: 99px; font-size: 0.75rem; margin-right: 6px; display: inline-block; margin-bottom: 6px;"><?php echo esc_html($term->name); ?></span>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($card['pills'])) : ?>
                <div class="stack-card-pills">
                    <?php foreach ($card['pills'] as $pill) : 
                        $pill_text = is_array($pill) ? ($pill['text'] ?? '') : $pill;
                        $pill_icon = is_array($pill) ? ($pill['icon'] ?? '') : '';
                        if (empty($pill_text)) continue;
                    ?>
                        <span class="stack-pill">
                            <?php if (!empty($pill_icon)) : ?>
                                <img src="<?php echo esc_url($pill_icon); ?>" alt="icon" style="width: 16px; height: 16px; object-fit: contain;">
                            <?php else : ?>
                                <svg class="pill-check" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            <?php endif; ?>
                            <?php echo esc_html($pill_text); ?>
                        </span>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($card['metric_val'])) : ?>
                <div class="stack-card-metric">
                    <div class="metric-number"><?php echo esc_html($card['metric_val']); ?></div>
                    <?php if (!empty($card['metric_lbl'])) : ?>
                        <div class="metric-label"><?php echo esc_html($card['metric_lbl']); ?></div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($card['link']) && $card['link'] !== '#') : ?>
                <div class="stack-card-action" style="margin-top: 2rem;">
                    <a href="<?php echo esc_url($card['link']); ?>" target="_blank" rel="noopener noreferrer" class="stack-card-btn stack-card-btn-solid">
                        <?php esc_html_e('View Project', 'sarmadgardezi'); ?>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
                    </a>
                </div>
            <?php endif; ?>
        </div>

        <!-- Right Visual Column -->
        <div class="stack-card-visual-wrap">
            <div class="stack-card-visual-link" title="<?php echo esc_attr($card['title']); ?>">
                <img 
                    src="<?php echo esc_url($card['image']); ?>" 
                    alt="<?php echo esc_attr($card['title']); ?>" 
                    class="stack-card-img"
                    loading="lazy"
                />
            </div>
        </div>
    </div>
</article>
