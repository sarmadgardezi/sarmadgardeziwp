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
$sarmad_avatar = function_exists('sarmadgardezi_asset') 
    ? sarmadgardezi_asset('images/sarmad.png') 
    : get_template_directory_uri() . '/assets/images/sarmad.png';

$reels_data = array(
    'card_1' => array(
        'video_url' => '',
        'link_url'  => 'https://www.instagram.com/reel/DX8lLExilGn/',
        'poster'    => '/wp-content/uploads/2026/09/sarmadgardezi_summit4.png',
        'avatar'    => $sarmad_avatar,
        'handle'    => 'sarmadgardezi',
        'verified'  => true,
    ),
    'card_2' => array(
        'video_url' => '', // e.g. your custom video link
        'link_url'  => 'https://instagram.com/sarmadgardezi',
        'poster'    => '/wp-content/uploads/2026/09/sarmadgardezi-summit26.png',
        'avatar'    => '/wp-content/uploads/2026/09/gdscp1-scaled.png',
        'handle'    => 'sarmadgardezi',
        'verified'  => true,
    ),
    'feature_card' => array(
        'title'        => __('YouTube Views', 'sarmadgardezi'),
        'count'        => '2M+',
        'top_avatars'  => array(
            'https://ui-avatars.com/api/?name=Y&background=FF0000&color=fff',
            'https://ui-avatars.com/api/?name=I&background=E1306C&color=fff',
            'https://ui-avatars.com/api/?name=W&background=4CAF50&color=fff',
        ),
        'creator_tags' => array(
            array('handle' => 'Facebook', 'stat' => '26.2K', 'avatar' => 'https://ui-avatars.com/api/?name=F&background=1877F2&color=fff', 'verified' => true, 'url' => 'https://facebook.com/sarmadgardezi'),
            array('handle' => 'Instagram', 'stat' => '24.8K', 'avatar' => 'https://ui-avatars.com/api/?name=I&background=E1306C&color=fff', 'verified' => true, 'url' => 'https://instagram.com/sarmadgardezi'),
            array('handle' => 'GitHub', 'stat' => '389', 'avatar' => 'https://ui-avatars.com/api/?name=G&background=333333&color=fff', 'verified' => false, 'url' => 'https://github.com/sarmadgardezi'),
            array('handle' => 'YouTube', 'stat' => '3.9K', 'avatar' => 'https://ui-avatars.com/api/?name=Y&background=FF0000&color=fff', 'verified' => true, 'url' => 'https://youtube.com/sarmadgardezi'),
            array('handle' => 'Twitter', 'stat' => '8K', 'avatar' => 'https://ui-avatars.com/api/?name=X&background=000000&color=fff', 'verified' => true, 'url' => 'https://twitter.com/sarmadgardezi'),
            array('handle' => 'Website', 'stat' => '1.2K/mo', 'avatar' => 'https://ui-avatars.com/api/?name=W&background=4CAF50&color=fff', 'verified' => false, 'url' => home_url('/')),
        ),
    ),
    'card_4' => array(
        'video_url' => '', // e.g. your custom video link
        'poster'    => '/wp-content/uploads/2026/09/sarmadgardezi_summit_2.png',
        'verified'  => true,
    ),
);
?>

<section id="creator-reels" class="creator-reels-section" aria-label="<?php esc_attr_e('Featured Creator Reels', 'sarmadgardezi'); ?>">
    <div class="creator-reels-container">
        <div class="creator-reels-grid" id="reels-deck">

            <!-- Card 1 (Leftmost Reel - Sarmad Gardezi) -->
            <div class="reel-card reel-card-1" style="--card-index: 1;" data-tilt="-5.5">
                <div class="reel-card-inner">
                    <?php 
                    $c1_url = !empty($reels_data['card_1']['video_url']) ? $reels_data['card_1']['video_url'] : '';
                    if (!empty($c1_url) && preg_match('/\.(mp4|webm|ogg)$/i', $c1_url)) : ?>
                        <video class="reel-media reel-video" src="<?php echo esc_url($c1_url); ?>" poster="<?php echo esc_url($reels_data['card_1']['poster']); ?>" autoplay loop muted playsinline></video>
                    <?php elseif (!empty($c1_url) && strpos($c1_url, 'instagram.com') !== false) : 
                        $c1_embed = rtrim(preg_replace('/\?.*/', '', $c1_url), '/') . '/embed/';
                    ?>
                        <iframe class="reel-media reel-iframe" src="<?php echo esc_url($c1_embed); ?>" frameborder="0" scrolling="no" allowtransparency="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share" loading="lazy"></iframe>
                    <?php else : ?>
                        <img class="reel-media reel-poster" src="<?php echo esc_url($reels_data['card_1']['poster']); ?>" alt="<?php echo esc_attr($reels_data['card_1']['handle']); ?>" loading="lazy" />
                    <?php endif; ?>

                    <div class="reel-overlay-gradient"></div>



                    <?php 
                    $c1_click = !empty($reels_data['card_1']['link_url']) ? $reels_data['card_1']['link_url'] : $reels_data['card_1']['video_url'];
                    if (!empty($c1_click)) : ?>
                        <a href="<?php echo esc_url($c1_click); ?>" target="_blank" rel="noopener noreferrer" class="reel-clickable-cover" aria-label="<?php esc_attr_e('Watch Reel', 'sarmadgardezi'); ?>"></a>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Card 2 (Second Reel) -->
            <div class="reel-card reel-card-2" style="--card-index: 2;" data-tilt="-1.5">
                <div class="reel-card-inner">
                    <?php 
                    $c2_url = !empty($reels_data['card_2']['video_url']) ? $reels_data['card_2']['video_url'] : '';
                    if (!empty($c2_url) && preg_match('/\.(mp4|webm|ogg)$/i', $c2_url)) : ?>
                        <video class="reel-media reel-video" src="<?php echo esc_url($c2_url); ?>" poster="<?php echo esc_url($reels_data['card_2']['poster']); ?>" autoplay loop muted playsinline></video>
                    <?php elseif (!empty($c2_url) && strpos($c2_url, 'instagram.com') !== false) : 
                        $c2_embed = rtrim(preg_replace('/\?.*/', '', $c2_url), '/') . '/embed/';
                    ?>
                        <iframe class="reel-media reel-iframe" src="<?php echo esc_url($c2_embed); ?>" frameborder="0" scrolling="no" allowtransparency="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share" loading="lazy"></iframe>
                    <?php else : ?>
                        <img class="reel-media reel-poster" src="<?php echo esc_url($reels_data['card_2']['poster']); ?>" alt="<?php echo esc_attr($reels_data['card_2']['handle']); ?>" loading="lazy" />
                    <?php endif; ?>

                    <div class="reel-overlay-gradient"></div>



                    <?php 
                    $c2_click = !empty($reels_data['card_2']['link_url']) ? $reels_data['card_2']['link_url'] : $reels_data['card_2']['video_url'];
                    if (!empty($c2_click)) : ?>
                        <a href="<?php echo esc_url($c2_click); ?>" target="_blank" rel="noopener noreferrer" class="reel-clickable-cover" aria-label="<?php esc_attr_e('Watch Reel', 'sarmadgardezi'); ?>"></a>
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
                            <?php $tag_url = !empty($tag['url']) ? esc_url($tag['url']) : '#'; ?>
                            <a href="<?php echo $tag_url; ?>" target="_blank" rel="noopener noreferrer" class="feature-tag-chip" style="text-decoration: none; color: inherit; cursor: pointer;">
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
                            </a>
                        <?php endforeach; ?>
                    </div>

                </div>
            </div>

            <!-- Card 4 (Rightmost Reel) -->
            <div class="reel-card reel-card-4" style="--card-index: 4;" data-tilt="6">
                <div class="reel-card-inner">
                    <?php 
                    $c4_url = !empty($reels_data['card_4']['video_url']) ? $reels_data['card_4']['video_url'] : '';
                    if (!empty($c4_url) && preg_match('/\.(mp4|webm|ogg)$/i', $c4_url)) : ?>
                        <video class="reel-media reel-video" src="<?php echo esc_url($c4_url); ?>" poster="<?php echo esc_url($reels_data['card_4']['poster']); ?>" autoplay loop muted playsinline></video>
                    <?php elseif (!empty($c4_url) && strpos($c4_url, 'instagram.com') !== false) : 
                        $c4_embed = rtrim(preg_replace('/\?.*/', '', $c4_url), '/') . '/embed/';
                    ?>
                        <iframe class="reel-media reel-iframe" src="<?php echo esc_url($c4_embed); ?>" frameborder="0" scrolling="no" allowtransparency="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share" loading="lazy"></iframe>
                    <?php else : ?>
                        <img class="reel-media reel-poster" src="<?php echo esc_url($reels_data['card_4']['poster']); ?>" alt="<?php echo esc_attr($reels_data['card_4']['handle']); ?>" loading="lazy" />
                    <?php endif; ?>

                    <div class="reel-overlay-gradient"></div>



                    <?php if (!empty($reels_data['card_4']['video_url'])) : ?>
                        <a href="<?php echo esc_url($reels_data['card_4']['video_url']); ?>" target="_blank" rel="noopener noreferrer" class="reel-clickable-cover" aria-label="<?php esc_attr_e('Watch Reel', 'sarmadgardezi'); ?>"></a>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </div>
</section>
