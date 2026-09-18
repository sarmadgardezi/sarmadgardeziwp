<?php
/**
 * Template part for displaying the Sound Familiar / Problem Statement Narrative section
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;
?>

<section class="sound-familiar-section">
    <div class="sound-familiar-container">

        <!-- Top Pill Badge -->
        <div class="sound-familiar-badge-wrap">
            <span class="sound-familiar-badge">
                <?php esc_html_e('Sound familiar?', 'sarmadgardezi'); ?>
            </span>
        </div>

        <!-- Narrative Editorial Statement List -->
        <div class="sound-familiar-content">

            <!-- Paragraph 1 -->
            <p class="sound-familiar-paragraph">
                <?php esc_html_e('Your tech stack is', 'sarmadgardezi'); ?>
                <span class="inline-chip-yellow"><?php esc_html_e('working', 'sarmadgardezi'); ?></span>
                <?php esc_html_e('against you and the worst part is,', 'sarmadgardezi'); ?>
                <span class="inline-sticker-finger" aria-hidden="true">👈</span>
                <?php esc_html_e('you already know it.', 'sarmadgardezi'); ?>
            </p>

            <!-- Paragraph 2 -->
            <p class="sound-familiar-paragraph">
                <?php esc_html_e('You paid for generic AI wrappers and slow prototypes. Enterprise solutions don’t need buzzwords, they need systems that actually scale.', 'sarmadgardezi'); ?>
            </p>

            <!-- Paragraph 3 -->
            <p class="sound-familiar-paragraph">
                <?php esc_html_e('Building models every week, still', 'sarmadgardezi'); ?>
                <span class="inline-chip-red">
                    <span class="chip-ban-icon" aria-hidden="true">🚫</span><?php esc_html_e('no ROI.', 'sarmadgardezi'); ?>
                </span>
                <?php esc_html_e('Demos are not production revenue. If your systems look smart in dev but fail under load, that’s not a tooling issue. You need a', 'sarmadgardezi'); ?>
                <span class="inline-chip-blue"><?php esc_html_e('strategy gap', 'sarmadgardezi'); ?></span>
                <?php esc_html_e('not just a schedule.', 'sarmadgardezi'); ?>
            </p>

            <!-- Paragraph 4 -->
            <p class="sound-familiar-paragraph">
                <?php esc_html_e('No system design, no cloud resilience, deploying on hope. Your', 'sarmadgardezi'); ?>
                <span class="inline-avatar-stack" aria-hidden="true">
                    <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=60&h=60&fit=crop&crop=face" alt="Competitor" class="avatar-stack-item" width="26" height="26" loading="lazy" />
                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=60&h=60&fit=crop&crop=face" alt="Competitor" class="avatar-stack-item" width="26" height="26" loading="lazy" />
                    <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=60&h=60&fit=crop&crop=face" alt="Competitor" class="avatar-stack-item" width="26" height="26" loading="lazy" />
                    <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=60&h=60&fit=crop&crop=face" alt="Competitor" class="avatar-stack-item" width="26" height="26" loading="lazy" />
                </span>
                <?php esc_html_e('competitors have autonomous systems running while you’re still', 'sarmadgardezi'); ?>
                <span class="inline-wing-phrase">
                    <span class="wing-icon left" aria-hidden="true">🪽</span>
                    <span class="wing-text"><?php esc_html_e('winging', 'sarmadgardezi'); ?></span>
                    <span class="wing-icon right" aria-hidden="true">🪽</span>
                </span>
                <?php esc_html_e('it.', 'sarmadgardezi'); ?>
            </p>

        </div>

    </div>
</section>
