<?php
/**
 * Interactive Cal.com-Style Meeting Booker & Reservation Form
 *
 * Matching exact Cal.com layout with dynamic calendar, time slots,
 * guest details, phone/WhatsApp field, and WhatsApp instant routing.
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;

// Host details
$host_name     = 'Sarmad Gardezi';
$host_avatar   = get_template_directory_uri() . '/assets/images/sarmad.png';
$custom_photo  = function_exists('get_field') ? get_field('hero_profile_photo') : '';
if (!empty($custom_photo)) {
    if (is_array($custom_photo) && !empty($custom_photo['url'])) {
        $host_avatar = $custom_photo['url'];
    } elseif (is_string($custom_photo)) {
        $host_avatar = $custom_photo;
    }
}
$event_title   = 'Chat';
$location_type = 'Google Meet';
$timezone_name = 'Asia/Karachi';
$booking_nonce = wp_create_nonce('sarmad_booking_nonce_action');
?>

<div id="cal-booker-widget" class="cal-booker-widget" data-nonce="<?php echo esc_attr($booking_nonce); ?>" data-ajaxurl="<?php echo esc_url(admin_url('admin-ajax.php')); ?>">
    <div class="cal-booker-frame">
        
        <!-- ================================================================ -->
        <!-- STEP 1: CALENDAR & TIMESLOTS VIEW                                -->
        <!-- ================================================================ -->
        <div id="cal-step-1" class="cal-step cal-step-active">
            <div class="cal-grid-layout">
                
                <!-- 1. Left Sidebar: Event Meta -->
                <aside class="cal-meta-sidebar">
                    <div class="cal-host-meta">
                        <div class="cal-host-avatar-wrap">
                            <img src="<?php echo esc_url($host_avatar); ?>" alt="<?php echo esc_attr($host_name); ?>" class="cal-host-avatar" />
                        </div>
                        <span class="cal-host-name"><?php echo esc_html($host_name); ?></span>
                        <h2 class="cal-event-title"><?php echo esc_html($event_title); ?></h2>
                    </div>

                    <div class="cal-meta-details-list">
                        
                        <!-- Duration Pill Selector (30m / 50m) -->
                        <div class="cal-meta-item cal-duration-selector">
                            <svg class="cal-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                            <div class="cal-duration-pills">
                                <button type="button" class="cal-pill-btn is-active" data-duration="30m">30m</button>
                                <button type="button" class="cal-pill-btn" data-duration="50m">50m</button>
                            </div>
                        </div>

                        <!-- Location / Meeting Mode -->
                        <div class="cal-meta-item">
                            <span class="cal-meet-icon-wrap" aria-hidden="true">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#2563eb" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polygon points="23 7 16 12 23 17 23 7"></polygon>
                                    <rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect>
                                </svg>
                            </span>
                            <span class="cal-meta-label"><?php echo esc_html($location_type); ?></span>
                        </div>

                        <!-- Timezone Selector -->
                        <div class="cal-meta-item cal-timezone-item">
                            <svg class="cal-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <circle cx="12" cy="12" r="10"></circle>
                                <path d="M12 2a14.5 14.5 0 0 0 0 20 14.5 14.5 0 0 0 0-20"></path>
                                <path d="M2 12h20"></path>
                            </svg>
                            <span id="cal-current-timezone" class="cal-meta-label"><?php echo esc_html($timezone_name); ?></span>
                        </div>

                    </div>
                </aside>

                <!-- 2. Middle: Calendar Picker Grid -->
                <section class="cal-calendar-section">
                    
                    <!-- Month Header & Navigation -->
                    <div class="cal-month-nav-header">
                        <span id="cal-month-display" class="cal-month-title">October 2026</span>
                        <div class="cal-nav-arrows">
                            <button type="button" id="cal-prev-month-btn" class="cal-arrow-btn" aria-label="<?php esc_attr_e('Previous month', 'sarmadgardezi'); ?>">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m15 18-6-6 6-6"></path>
                                </svg>
                            </button>
                            <button type="button" id="cal-next-month-btn" class="cal-arrow-btn" aria-label="<?php esc_attr_e('Next month', 'sarmadgardezi'); ?>">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m9 18 6-6-6-6"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Weekdays Header Row -->
                    <div class="cal-weekdays-row">
                        <span>MON</span>
                        <span>TUE</span>
                        <span>WED</span>
                        <span>THU</span>
                        <span>FRI</span>
                        <span>SAT</span>
                        <span>SUN</span>
                    </div>

                    <!-- Days Matrix Container -->
                    <div id="cal-days-grid" class="cal-days-grid">
                        <!-- Populated by JS -->
                    </div>

                </section>

                <!-- 3. Right: Timeslots Column -->
                <section class="cal-timeslots-section">
                    
                    <div class="cal-timeslots-header">
                        <span id="cal-selected-day-label" class="cal-selected-day-title">Mon 5th</span>
                        
                        <!-- 12h / 24h Switcher -->
                        <div class="cal-format-toggle">
                            <button type="button" class="cal-toggle-btn is-active" data-format="12h">12h</button>
                            <button type="button" class="cal-toggle-btn" data-format="24h">24h</button>
                        </div>
                    </div>

                    <!-- Slots List Container -->
                    <div id="cal-slots-list" class="cal-slots-list">
                        <!-- Populated by JS -->
                    </div>

                </section>

            </div>
        </div>

        <!-- ================================================================ -->
        <!-- STEP 2: CONFIRMATION / CONTACT FORM VIEW                         -->
        <!-- ================================================================ -->
        <div id="cal-step-2" class="cal-step" style="display: none;">
            <div class="cal-form-grid-layout">
                
                <!-- Left Sidebar: Selected Meeting Summary -->
                <aside class="cal-meta-sidebar">
                    <div class="cal-host-meta">
                        <div class="cal-host-avatar-wrap">
                            <img src="<?php echo esc_url($host_avatar); ?>" alt="<?php echo esc_attr($host_name); ?>" class="cal-host-avatar" />
                        </div>
                        <span class="cal-host-name"><?php echo esc_html($host_name); ?></span>
                        <h2 class="cal-event-title"><?php echo esc_html($event_title); ?></h2>
                    </div>

                    <div class="cal-meta-details-list">
                        
                        <!-- Chosen Date & Time -->
                        <div class="cal-meta-item">
                            <svg class="cal-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M8 2v4"></path>
                                <path d="M16 2v4"></path>
                                <rect width="18" height="18" x="3" y="4" rx="2"></rect>
                                <path d="M3 10h18"></path>
                            </svg>
                            <div class="cal-meta-time-text">
                                <strong id="summary-date-display">Monday, October 5, 2026</strong>
                                <span id="summary-time-display">6:30 – 7:00 pm</span>
                            </div>
                        </div>

                        <!-- Duration -->
                        <div class="cal-meta-item">
                            <svg class="cal-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                            <span id="summary-duration-display" class="cal-meta-label">30m</span>
                        </div>

                        <!-- Location -->
                        <div class="cal-meta-item">
                            <span class="cal-meet-icon-wrap" aria-hidden="true">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#2563eb" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polygon points="23 7 16 12 23 17 23 7"></polygon>
                                    <rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect>
                                </svg>
                            </span>
                            <span class="cal-meta-label"><?php echo esc_html($location_type); ?></span>
                        </div>

                        <!-- Timezone -->
                        <div class="cal-meta-item">
                            <svg class="cal-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <circle cx="12" cy="12" r="10"></circle>
                                <path d="M12 2a14.5 14.5 0 0 0 0 20 14.5 14.5 0 0 0 0-20"></path>
                                <path d="M2 12h20"></path>
                            </svg>
                            <span id="summary-timezone-display" class="cal-meta-label"><?php echo esc_html($timezone_name); ?></span>
                        </div>

                    </div>
                </aside>

                <!-- Right Form: User Details -->
                <section class="cal-form-section">
                    <form id="cal-booking-form" class="cal-booking-form" novalidate>
                        
                        <!-- 1. Name Field -->
                        <div class="cal-form-group">
                            <label for="booker_name" class="cal-field-label">
                                <?php esc_html_e('Your name', 'sarmadgardezi'); ?> <span class="req-star">*</span>
                            </label>
                            <input 
                                type="text" 
                                id="booker_name" 
                                name="booker_name" 
                                class="cal-input-field" 
                                placeholder="Jane Doe" 
                                required 
                                autocomplete="name"
                            />
                        </div>

                        <!-- 2. Email Address Field -->
                        <div class="cal-form-group">
                            <label for="booker_email" class="cal-field-label">
                                <?php esc_html_e('Email address', 'sarmadgardezi'); ?> <span class="req-star">*</span>
                            </label>
                            <input 
                                type="email" 
                                id="booker_email" 
                                name="booker_email" 
                                class="cal-input-field" 
                                placeholder="jane@company.com" 
                                required 
                                autocomplete="email"
                            />
                        </div>

                        <!-- 3. WhatsApp / Phone Number Field with Country Selector -->
                        <div class="cal-form-group">
                            <label for="booker_phone" class="cal-field-label">
                                <span><?php esc_html_e('WhatsApp / Phone number', 'sarmadgardezi'); ?> <span class="req-star">*</span></span>
                                <span class="cal-field-hint" title="<?php esc_attr_e('Please enter number for quick WhatsApp confirmation', 'sarmadgardezi'); ?>">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <path d="M12 16v-4"></path>
                                        <path d="M12 8h.01"></path>
                                    </svg>
                                </span>
                            </label>
                            <div class="cal-phone-input-group">
                                <div class="cal-country-prefix">
                                    <span class="flag-icon" aria-hidden="true">🇵🇰</span>
                                    <span class="prefix-code">+92</span>
                                </div>
                                <input 
                                    type="tel" 
                                    id="booker_phone" 
                                    name="booker_phone" 
                                    class="cal-input-field cal-phone-field" 
                                    placeholder="300 1234567" 
                                    required 
                                    autocomplete="tel"
                                />
                            </div>
                        </div>

                        <!-- 4. Additional Notes Textarea -->
                        <div class="cal-form-group">
                            <label for="booker_notes" class="cal-field-label">
                                <?php esc_html_e('Additional notes', 'sarmadgardezi'); ?>
                            </label>
                            <textarea 
                                id="booker_notes" 
                                name="booker_notes" 
                                class="cal-textarea-field" 
                                rows="3" 
                                placeholder="<?php esc_attr_e('Please share anything that will help prepare for our meeting.', 'sarmadgardezi'); ?>"
                            ></textarea>
                        </div>

                        <!-- 5. Optional Add Guests Trigger -->
                        <div class="cal-form-group cal-guests-group">
                            <button type="button" id="cal-toggle-guests-btn" class="cal-add-guests-btn">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                    <line x1="19" y1="8" x2="19" y2="14"></line>
                                    <line x1="22" y1="11" x2="16" y2="11"></line>
                                </svg>
                                <span><?php esc_html_e('Add guests', 'sarmadgardezi'); ?></span>
                            </button>
                            <div id="cal-guests-input-wrap" class="cal-guests-input-wrap" style="display:none; margin-top:8px;">
                                <input 
                                    type="email" 
                                    id="booker_guests" 
                                    name="booker_guests" 
                                    class="cal-input-field" 
                                    placeholder="<?php esc_attr_e('colleague@company.com', 'sarmadgardezi'); ?>"
                                />
                            </div>
                        </div>

                        <!-- Terms & Privacy Text -->
                        <div class="cal-terms-notice">
                            <?php 
                            printf(
                                /* translators: 1: terms url, 2: privacy url */
                                esc_html__('By proceeding, you agree to our %1$sTerms%3$s and %2$sPrivacy Policy%3$s.', 'sarmadgardezi'),
                                '<a href="' . esc_url(home_url('/terms')) . '" target="_blank" rel="noopener noreferrer">',
                                '<a href="' . esc_url(home_url('/privacy')) . '" target="_blank" rel="noopener noreferrer">',
                                '</a>'
                            );
                            ?>
                        </div>

                        <!-- Error Banner (Hidden by default) -->
                        <div id="cal-form-error-msg" class="cal-form-error" style="display:none;"></div>

                        <!-- Bottom Button Actions: Back & Confirm -->
                        <div class="cal-form-actions-row">
                            <button type="button" id="cal-back-to-step1-btn" class="cal-btn-back">
                                <?php esc_html_e('Back', 'sarmadgardezi'); ?>
                            </button>
                            <button type="submit" id="cal-confirm-btn" class="cal-btn-confirm">
                                <span class="btn-text"><?php esc_html_e('Confirm', 'sarmadgardezi'); ?></span>
                                <span class="btn-spinner" style="display:none;">
                                    <svg class="animate-spin" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                        <circle cx="12" cy="12" r="10" stroke-opacity="0.25"></circle>
                                        <path d="M12 2a10 10 0 0 1 10 10" stroke-linecap="round"></path>
                                    </svg>
                                </span>
                            </button>
                        </div>

                    </form>
                </section>

            </div>
        </div>

        <!-- ================================================================ -->
        <!-- STEP 3: SUCCESS CONFIRMATION STATE                               -->
        <!-- ================================================================ -->
        <div id="cal-step-3" class="cal-step" style="display: none;">
            <div class="cal-success-wrap">
                
                <div class="cal-success-icon-badge">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#2563eb" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                    </svg>
                </div>

                <h3 class="cal-success-heading"><?php esc_html_e('Meeting Scheduled!', 'sarmadgardezi'); ?></h3>
                
                <!-- Explicit User Specified Confirmation Notice -->
                <div class="cal-success-whatsapp-notice">
                    <span class="whatsapp-badge-icon" aria-hidden="true">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14m-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-.85 0-1.84.52-2.28 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 0 1 1.4 1.4v4.93h2.75M6.46 10.9v7.6h2.76v-7.6H6.46M7.84 6.2a1.6 1.6 0 0 0-1.6 1.6 1.6 1.6 0 0 0 1.6 1.6 1.6 1.6 0 0 0 1.6-1.6 1.6 1.6 0 0 0-1.6-1.6Z"/>
                        </svg>
                    </span>
                    <p class="cal-success-highlight">
                        <?php esc_html_e('Sarmad will contact you within hour via whatsapp on this query', 'sarmadgardezi'); ?>
                    </p>
                </div>

                <div class="cal-success-card-details">
                    <div class="detail-row">
                        <span class="label"><?php esc_html_e('When', 'sarmadgardezi'); ?>:</span>
                        <strong id="success-datetime-label" class="val">Monday, October 5, 2026 &middot; 6:30 pm</strong>
                    </div>
                    <div class="detail-row">
                        <span class="label"><?php esc_html_e('Where', 'sarmadgardezi'); ?>:</span>
                        <span class="val"><?php echo esc_html($location_type); ?></span>
                    </div>
                    <div class="detail-row">
                        <span class="label"><?php esc_html_e('Contact', 'sarmadgardezi'); ?>:</span>
                        <strong id="success-phone-label" class="val">WhatsApp</strong>
                    </div>
                </div>

                <div class="cal-success-actions">
                    <a id="cal-direct-wa-btn" href="#" target="_blank" rel="noopener noreferrer" class="cal-btn-whatsapp">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2C6.477 2 2 6.477 2 12c0 1.89.525 3.66 1.438 5.168L2 22l4.98-1.408A9.948 9.948 0 0 0 12 22c5.523 0 10-4.477 10-10S17.523 2 12 2zm4.98 14.17c-.21.59-1.22 1.15-1.7 1.18-.46.03-1.04.14-3.37-.82-2.8-1.15-4.58-4.01-4.72-4.2-.14-.19-1.13-1.5-1.13-2.86 0-1.36.71-2.03.96-2.31.25-.28.55-.35.73-.35.18 0 .37 0 .53.01.17.01.4.06.6.53.21.49.71 1.73.77 1.86.06.13.1.28.02.45-.09.17-.13.28-.26.43-.13.15-.27.34-.39.46-.13.13-.26.27-.11.53.15.26.67 1.1 1.44 1.79.99.88 1.83 1.15 2.09 1.28.26.13.41.11.56-.06.15-.17.65-.75.82-1.01.17-.26.35-.22.59-.13.24.09 1.53.72 1.79.85.26.13.43.19.49.3.06.11.06.66-.15 1.25z"/>
                        </svg>
                        <span><?php esc_html_e('Chat with Sarmad on WhatsApp', 'sarmadgardezi'); ?></span>
                    </a>
                    <button type="button" id="cal-book-another-btn" class="cal-btn-secondary">
                        <?php esc_html_e('Book another time', 'sarmadgardezi'); ?>
                    </button>
                </div>

            </div>
        </div>

    </div>
</div>
