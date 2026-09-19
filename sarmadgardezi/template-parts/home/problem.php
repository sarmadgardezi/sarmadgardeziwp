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
                <svg class="google-mini-icon" width="14" height="14" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                    <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                    <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z" fill="#FBBC05"/>
                    <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z" fill="#EA4335"/>
                </svg>
                <?php esc_html_e('Google Speaker & Cloud Architect', 'sarmadgardezi'); ?>
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
                <?php esc_html_e('you already know it. Generic AI wrappers and slow prototypes fail the moment they face real-world enterprise traffic.', 'sarmadgardezi'); ?>
            </p>

            <!-- Paragraph 2 (Google Speaker since 2017 & Architecture) -->
            <p class="sound-familiar-paragraph">
                <?php esc_html_e('Since', 'sarmadgardezi'); ?>
                <span class="inline-google-chip">
                    <svg class="google-g-icon" width="14" height="14" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                        <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                        <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z" fill="#FBBC05"/>
                        <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z" fill="#EA4335"/>
                    </svg>
                    <span>2017</span>
                </span>
                <?php esc_html_e("I've been speaking at Google Developer Groups (GDG) and architecting high-performance Cloud and", 'sarmadgardezi'); ?>
                <span class="inline-chip-blue"><?php esc_html_e('Agentic AI', 'sarmadgardezi'); ?></span>
                <?php esc_html_e('systems that turn complex workflows into scalable business revenue.', 'sarmadgardezi'); ?>
            </p>

            <!-- Paragraph 3 (ROI & System Design) -->
            <p class="sound-familiar-paragraph">
                <?php esc_html_e('Building models every week, still', 'sarmadgardezi'); ?>
                <span class="inline-chip-red">
                    <span class="chip-ban-icon" aria-hidden="true">🚫</span><?php esc_html_e('no ROI.', 'sarmadgardezi'); ?>
                </span>
                <?php esc_html_e('Demos are not production revenue. If your cloud systems look smart in dev but crash under load, you need a', 'sarmadgardezi'); ?>
                <span class="inline-chip-green"><?php esc_html_e('resilient system design', 'sarmadgardezi'); ?></span>
                <?php esc_html_e('not another quick-fix demo.', 'sarmadgardezi'); ?>
            </p>

            <!-- Paragraph 4 (Socials / YouTube / GitHub) -->
            <p class="sound-familiar-paragraph">
                <?php esc_html_e('While your', 'sarmadgardezi'); ?>
                <span class="inline-avatar-stack" aria-hidden="true">
                    <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=60&h=60&fit=crop&crop=face" alt="Competitor" class="avatar-stack-item" width="26" height="26" loading="lazy" />
                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=60&h=60&fit=crop&crop=face" alt="Competitor" class="avatar-stack-item" width="26" height="26" loading="lazy" />
                    <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=60&h=60&fit=crop&crop=face" alt="Competitor" class="avatar-stack-item" width="26" height="26" loading="lazy" />
                </span>
                <?php esc_html_e('competitors are still', 'sarmadgardezi'); ?>
                <span class="inline-wing-phrase">
                    <span class="wing-icon left" aria-hidden="true">🪽</span>
                    <span class="wing-text"><?php esc_html_e('winging', 'sarmadgardezi'); ?></span>
                    <span class="wing-icon right" aria-hidden="true">🪽</span>
                </span>
                <?php esc_html_e('it, explore my open-source code on', 'sarmadgardezi'); ?>
                <a href="https://github.com/sarmadgardezi" target="_blank" rel="noopener noreferrer" class="inline-link-chip chip-github">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.53 1.032 1.53 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"/>
                    </svg>
                    <span>GitHub</span>
                </a>
                <?php esc_html_e('and technical talks on', 'sarmadgardezi'); ?>
                <a href="https://youtube.com/@sarmadgardezi" target="_blank" rel="noopener noreferrer" class="inline-link-chip chip-youtube">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="#E24A4A" aria-hidden="true">
                        <path d="M21.582,6.186c-0.23-0.86-0.908-1.538-1.768-1.768C18.254,4,12,4,12,4S5.746,4,4.186,4.418 c-0.86,0.23-1.538,0.908-1.768,1.768C2,7.746,2,12,2,12s0,4.254,0.418,5.814c0.23,0.86,0.908,1.538,1.768,1.768 C5.746,20,12,20,12,20s6.254,0,7.814-0.418c0.86-0.23,1.538-0.908,1.768-1.768C22,16.254,22,12,22,12S22,7.746,21.582,6.186z M10,15.464V8.536L16,12L10,15.464z"></path>
                    </svg>
                    <span>YouTube</span>
                </a>.
            </p>

        </div>

    </div>
</section>
