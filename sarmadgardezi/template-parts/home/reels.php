<?php
/**
 * Template part for displaying the Interactive Creator Reels Showcase section
 *
 * Tilted interactive reels cards with video link support, creator pills, and 
 * hover straight transition.
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;

// Easy-to-edit configuration: place your custom video links, posters, and creator handles here!
$reels_data = array(
    'card_1' => array(
        'video_url' => '', // e.g. 'https://assets.mixkit.co/videos/preview/mixkit-girl-taking-a-selfie-with-a-smartphone-41480-large.mp4' or YouTube link
        'poster'    => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=800&q=85',
        'avatar'    => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=120&q=80',
        'handle'    => 'mila.creates',
        'verified'  => true,
    ),
    'card_2' => array(
        'video_url' => '', // e.g. your custom video link
        'poster'    => 'https://images.unsplash.com/photo-1517841905240-472988babdf9?auto=format&fit=crop&w=800&q=85',
        'avatar'    => 'https://images.unsplash.com/photo-1517841905240-472988babdf9?auto=format&fit=crop&w=120&q=80',
        'handle'    => 'nikoflips',
        'verified'  => true,
    ),
    'feature_card' => array(
        'title'        => __('Creators we work with', 'sarmadgardezi'),
        'count'        => '1250+',
        'top_avatars'  => array(
            'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=120&q=80',
            'https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=120&q=80',
            'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=120&q=80',
        ),
        'creator_tags' => array(
            array('handle' => 'yara.ugc', 'stat' => '2M', 'avatar' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=80&q=80', 'verified' => true),
            array('handle' => 'cade.reels', 'stat' => '5M', 'avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=80&q=80', 'verified' => true),
            array('handle' => 'koflips', 'stat' => '2.5M', 'avatar' => 'https://images.unsplash.com/photo-1524504388940-b1c1722653e1?auto=format&fit=crop&w=80&q=80', 'verified' => true),
            array('handle' => 'thorn_', 'stat' => '5M', 'avatar' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=80&q=80', 'verified' => true),
            array('handle' => 'zunoflips', 'stat' => '2M', 'avatar' => 'https://images.unsplash.com/photo-1539571696357-5a69c17a67c6?auto=format&fit=crop&w=80&q=80', 'verified' => true),
            array('handle' => 'sola.ugc', 'stat' => '1.8M', 'avatar' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=80&q=80', 'verified' => false),
        ),
    ),
    'card_4' => array(
        'video_url' => '', // e.g. your custom video link
        'poster'    => 'https://images.unsplash.com/photo-1520523839898-5071282543e2?auto=format&fit=crop&w=800&q=85',
        'avatar'    => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=120&q=80',
        'handle'    => 'theolund.co',
        'verified'  => true,
    ),
);
?>

<section id="creator-reels" class="creator-reels-section" aria-label="<?php esc_attr_e('Featured Creator Reels', 'sarmadgardezi'); ?>">
    <div class="creator-reels-container">
        <div class="creator-reels-grid" id="reels-deck">

            <!-- Card 1 (Leftmost Reel) -->
            <div class="reel-card reel-card-1" style="--card-index: 1;" data-tilt="-5.5">
                <div class="reel-card-inner">
                    <?php if (!empty($reels_data['card_1']['video_url']) && preg_match('/\.(mp4|webm|ogg)$/i', $reels_data['card_1']['video_url'])) : ?>
                        <video class="reel-media reel-video" src="<?php echo esc_url($reels_data['card_1']['video_url']); ?>" poster="<?php echo esc_url($reels_data['card_1']['poster']); ?>" autoplay loop muted playsinline></video>
                    <?php else : ?>
                        <img class="reel-media reel-poster" src="<?php echo esc_url($reels_data['card_1']['poster']); ?>" alt="<?php echo esc_attr($reels_data['card_1']['handle']); ?>" loading="lazy" />
                    <?php endif; ?>

                    <div class="reel-overlay-gradient"></div>

                    <!-- Bottom Bar -->
                    <div class="reel-card-bottom">
                        <div class="reel-creator-chip">
                            <img class="reel-creator-avatar" src="<?php echo esc_url($reels_data['card_1']['avatar']); ?>" alt="<?php echo esc_attr($reels_data['card_1']['handle']); ?>" width="26" height="26" loading="lazy" />
                            <span class="reel-creator-handle"><?php echo esc_html($reels_data['card_1']['handle']); ?></span>
                            <?php if (!empty($reels_data['card_1']['verified'])) : ?>
                                <span class="reel-verified-badge" aria-label="Verified">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="#38bdf8">
                                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                    </svg>
                                </span>
                            <?php endif; ?>
                        </div>
                        <div class="reel-action-btn" aria-hidden="true">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                                <rect x="6" y="4" width="3.5" height="16" rx="1"></rect>
                                <rect x="14.5" y="4" width="3.5" height="16" rx="1"></rect>
                            </svg>
                        </div>
                    </div>

                    <?php if (!empty($reels_data['card_1']['video_url'])) : ?>
                        <a href="<?php echo esc_url($reels_data['card_1']['video_url']); ?>" target="_blank" rel="noopener noreferrer" class="reel-clickable-cover" aria-label="<?php esc_attr_e('Watch Reel', 'sarmadgardezi'); ?>"></a>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Card 2 (Second Reel) -->
            <div class="reel-card reel-card-2" style="--card-index: 2;" data-tilt="-1.5">
                <div class="reel-card-inner">
                    <?php if (!empty($reels_data['card_2']['video_url']) && preg_match('/\.(mp4|webm|ogg)$/i', $reels_data['card_2']['video_url'])) : ?>
                        <video class="reel-media reel-video" src="<?php echo esc_url($reels_data['card_2']['video_url']); ?>" poster="<?php echo esc_url($reels_data['card_2']['poster']); ?>" autoplay loop muted playsinline></video>
                    <?php else : ?>
                        <img class="reel-media reel-poster" src="<?php echo esc_url($reels_data['card_2']['poster']); ?>" alt="<?php echo esc_attr($reels_data['card_2']['handle']); ?>" loading="lazy" />
                    <?php endif; ?>

                    <div class="reel-overlay-gradient"></div>

                    <!-- Bottom Bar -->
                    <div class="reel-card-bottom">
                        <div class="reel-creator-chip">
                            <img class="reel-creator-avatar" src="<?php echo esc_url($reels_data['card_2']['avatar']); ?>" alt="<?php echo esc_attr($reels_data['card_2']['handle']); ?>" width="26" height="26" loading="lazy" />
                            <span class="reel-creator-handle"><?php echo esc_html($reels_data['card_2']['handle']); ?></span>
                            <?php if (!empty($reels_data['card_2']['verified'])) : ?>
                                <span class="reel-verified-badge" aria-label="Verified">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="#38bdf8">
                                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                    </svg>
                                </span>
                            <?php endif; ?>
                        </div>
                        <div class="reel-action-btn" aria-hidden="true">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                                <rect x="6" y="4" width="3.5" height="16" rx="1"></rect>
                                <rect x="14.5" y="4" width="3.5" height="16" rx="1"></rect>
                            </svg>
                        </div>
                    </div>

                    <?php if (!empty($reels_data['card_2']['video_url'])) : ?>
                        <a href="<?php echo esc_url($reels_data['card_2']['video_url']); ?>" target="_blank" rel="noopener noreferrer" class="reel-clickable-cover" aria-label="<?php esc_attr_e('Watch Reel', 'sarmadgardezi'); ?>"></a>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Card 3 (Center Feature 1250+ Card) -->
            <div class="reel-card reel-card-3 reel-card-feature" style="--card-index: 3;" data-tilt="2">
                <div class="reel-card-inner feature-card-inner">
                    
                    <!-- Top Avatar Cluster & Title -->
                    <div class="feature-card-header">
                        <div class="feature-avatar-cluster">
                            <?php foreach ($reels_data['feature_card']['top_avatars'] as $av) : ?>
                                <img class="cluster-avatar" src="<?php echo esc_url($av); ?>" alt="<?php esc_attr_e('Creator Avatar', 'sarmadgardezi'); ?>" width="38" height="38" loading="lazy" />
                            <?php endforeach; ?>
                        </div>
                        <p class="feature-card-title"><?php echo esc_html($reels_data['feature_card']['title']); ?></p>
                    </div>

                    <!-- Center Huge Count -->
                    <div class="feature-card-count-wrap">
                        <span class="feature-card-count"><?php echo esc_html($reels_data['feature_card']['count']); ?></span>
                    </div>

                    <!-- Bottom Floating Creator Tags -->
                    <div class="feature-creator-tags">
                        <?php foreach ($reels_data['feature_card']['creator_tags'] as $tag) : ?>
                            <div class="feature-tag-chip">
                                <img class="tag-avatar" src="<?php echo esc_url($tag['avatar']); ?>" alt="<?php echo esc_attr($tag['handle']); ?>" width="20" height="20" loading="lazy" />
                                <span class="tag-handle"><?php echo esc_html($tag['handle']); ?></span>
                                <?php if (!empty($tag['verified'])) : ?>
                                    <span class="tag-verified">
                                        <svg width="11" height="11" viewBox="0 0 24 24" fill="#38bdf8">
                                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                        </svg>
                                    </span>
                                <?php endif; ?>
                                <span class="tag-dot">•</span>
                                <span class="tag-stat"><?php echo esc_html($tag['stat']); ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>

                </div>
            </div>

            <!-- Card 4 (Rightmost Reel) -->
            <div class="reel-card reel-card-4" style="--card-index: 4;" data-tilt="6">
                <div class="reel-card-inner">
                    <?php if (!empty($reels_data['card_4']['video_url']) && preg_match('/\.(mp4|webm|ogg)$/i', $reels_data['card_4']['video_url'])) : ?>
                        <video class="reel-media reel-video" src="<?php echo esc_url($reels_data['card_4']['video_url']); ?>" poster="<?php echo esc_url($reels_data['card_4']['poster']); ?>" autoplay loop muted playsinline></video>
                    <?php else : ?>
                        <img class="reel-media reel-poster" src="<?php echo esc_url($reels_data['card_4']['poster']); ?>" alt="<?php echo esc_attr($reels_data['card_4']['handle']); ?>" loading="lazy" />
                    <?php endif; ?>

                    <div class="reel-overlay-gradient"></div>

                    <!-- Bottom Bar -->
                    <div class="reel-card-bottom">
                        <div class="reel-creator-chip">
                            <img class="reel-creator-avatar" src="<?php echo esc_url($reels_data['card_4']['avatar']); ?>" alt="<?php echo esc_attr($reels_data['card_4']['handle']); ?>" width="26" height="26" loading="lazy" />
                            <span class="reel-creator-handle"><?php echo esc_html($reels_data['card_4']['handle']); ?></span>
                            <?php if (!empty($reels_data['card_4']['verified'])) : ?>
                                <span class="reel-verified-badge" aria-label="Verified">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="#38bdf8">
                                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                    </svg>
                                </span>
                            <?php endif; ?>
                        </div>
                        <div class="reel-action-btn" aria-hidden="true">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                                <rect x="6" y="4" width="3.5" height="16" rx="1"></rect>
                                <rect x="14.5" y="4" width="3.5" height="16" rx="1"></rect>
                            </svg>
                        </div>
                    </div>

                    <?php if (!empty($reels_data['card_4']['video_url'])) : ?>
                        <a href="<?php echo esc_url($reels_data['card_4']['video_url']); ?>" target="_blank" rel="noopener noreferrer" class="reel-clickable-cover" aria-label="<?php esc_attr_e('Watch Reel', 'sarmadgardezi'); ?>"></a>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </div>
</section>
