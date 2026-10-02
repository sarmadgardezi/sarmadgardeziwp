/**
 * Cal.com Style Meeting Booking & Reservation Widget
 * 
 * @package SarmadGardezi
 */

(function() {
    'use strict';

    document.addEventListener('DOMContentLoaded', function() {
        var widget = document.getElementById('cal-booker-widget');
        if (!widget) return;

        var ajaxUrl = widget.getAttribute('data-ajaxurl') || '/wp-admin/admin-ajax.php';
        var nonce = widget.getAttribute('data-nonce') || '';

        // Steps
        var step1 = document.getElementById('cal-step-1');
        var step2 = document.getElementById('cal-step-2');
        var step3 = document.getElementById('cal-step-3');

        // State variables
        var currentDate = new Date();
        var selectedDate = new Date(currentDate);
        // Default to today or next weekday
        if (selectedDate.getDay() === 0) selectedDate.setDate(selectedDate.getDate() + 1);
        if (selectedDate.getDay() === 6) selectedDate.setDate(selectedDate.getDate() + 2);

        var viewMonth = selectedDate.getMonth();
        var viewYear = selectedDate.getFullYear();
        var selectedDuration = '30m';
        var selectedFormat = '12h';
        var selectedTimeSlot = '6:30pm';
        var userTimezone = 'Asia/Karachi';

        try {
            var tz = Intl.DateTimeFormat().resolvedOptions().timeZone;
            if (tz) userTimezone = tz;
        } catch(e) {}

        var tzEl = document.getElementById('cal-current-timezone');
        var summaryTzEl = document.getElementById('summary-timezone-display');
        if (tzEl) tzEl.textContent = userTimezone;
        if (summaryTzEl) summaryTzEl.textContent = userTimezone;

        // Elements
        var monthDisplay = document.getElementById('cal-month-display');
        var prevMonthBtn = document.getElementById('cal-prev-month-btn');
        var nextMonthBtn = document.getElementById('cal-next-month-btn');
        var daysGrid = document.getElementById('cal-days-grid');
        var slotsList = document.getElementById('cal-slots-list');
        var selectedDayLabel = document.getElementById('cal-selected-day-label');

        var durationBtns = document.querySelectorAll('.cal-duration-pills .cal-pill-btn');
        var formatBtns = document.querySelectorAll('.cal-format-toggle .cal-toggle-btn');

        var summaryDateDisplay = document.getElementById('summary-date-display');
        var summaryTimeDisplay = document.getElementById('summary-time-display');
        var summaryDurationDisplay = document.getElementById('summary-duration-display');

        var bookingForm = document.getElementById('cal-booking-form');
        var backToStep1Btn = document.getElementById('cal-back-to-step1-btn');
        var toggleGuestsBtn = document.getElementById('cal-toggle-guests-btn');
        var guestsInputWrap = document.getElementById('cal-guests-input-wrap');
        var formErrorMsg = document.getElementById('cal-form-error-msg');
        var confirmBtn = document.getElementById('cal-confirm-btn');

        var successDatetimeLabel = document.getElementById('success-datetime-label');
        var successPhoneLabel = document.getElementById('success-phone-label');
        var directWaBtn = document.getElementById('cal-direct-wa-btn');
        var bookAnotherBtn = document.getElementById('cal-book-another-btn');

        var monthNames = [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ];

        var dayNamesShort = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
        var dayNamesFull = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

        // Available Daily Slots (30m base)
        var defaultSlots12 = ['11:00am', '11:30am', '6:00pm', '6:30pm', '7:00pm', '7:30pm', '8:00pm', '9:30pm'];
        var defaultSlots24 = ['11:00', '11:30', '18:00', '18:30', '19:00', '19:30', '20:00', '21:30'];

        // Helper: Convert 12h to 24h
        function to24h(slot12) {
            var isPm = slot12.indexOf('pm') !== -1;
            var parts = slot12.replace(/(am|pm)/i, '').split(':');
            var h = parseInt(parts[0], 10);
            var m = parts[1];
            if (isPm && h < 12) h += 12;
            if (!isPm && h === 12) h = 0;
            return (h < 10 ? '0' + h : h) + ':' + m;
        }

        // Helper: Calculate end time
        function getEndTime(startTimeStr, durStr) {
            var isPm = startTimeStr.indexOf('pm') !== -1;
            var clean = startTimeStr.replace(/(am|pm)/i, '').trim();
            var parts = clean.split(':');
            var h = parseInt(parts[0], 10);
            var m = parseInt(parts[1], 10);
            var durMin = durStr === '50m' ? 50 : 30;

            var totalMin = (isPm && h !== 12 ? h + 12 : (h === 12 && !isPm ? 0 : h)) * 60 + m + durMin;
            var endH = Math.floor(totalMin / 60) % 24;
            var endM = totalMin % 60;
            var endPm = endH >= 12;
            var dispH = endH % 12;
            if (dispH === 0) dispH = 12;
            var dispM = endM < 10 ? '0' + endM : endM;
            return dispH + ':' + dispM + (endPm ? ' pm' : ' am');
        }

        // Render Calendar Days
        function renderCalendar() {
            if (!daysGrid || !monthDisplay) return;

            monthDisplay.textContent = monthNames[viewMonth] + ' ' + viewYear;

            // Clear days
            daysGrid.innerHTML = '';

            var firstDayIndex = new Date(viewYear, viewMonth, 1).getDay(); // 0 is Sun
            // Adjust so 0 is Mon (Mon=0, Tue=1 ... Sun=6)
            var startCol = (firstDayIndex + 6) % 7;

            var daysInMonth = new Date(viewYear, viewMonth + 1, 0).getDate();
            var today = new Date();
            today.setHours(0, 0, 0, 0);

            // Empty placeholder cells
            for (var p = 0; p < startCol; p++) {
                var emptyCell = document.createElement('div');
                emptyCell.className = 'cal-day-cell is-empty';
                daysGrid.appendChild(emptyCell);
            }

            // Day cells
            for (var d = 1; d <= daysInMonth; d++) {
                var cellDate = new Date(viewYear, viewMonth, d);
                cellDate.setHours(0, 0, 0, 0);

                var isPast = cellDate < today;
                var isSelected = (
                    selectedDate.getFullYear() === viewYear &&
                    selectedDate.getMonth() === viewMonth &&
                    selectedDate.getDate() === d
                );
                var isToday = cellDate.getTime() === today.getTime();

                var btn = document.createElement('button');
                btn.type = 'button';
                btn.className = 'cal-day-btn';
                btn.setAttribute('data-day', d);

                if (isPast) {
                    btn.classList.add('is-past');
                    btn.disabled = true;
                } else {
                    btn.classList.add('is-available');
                }

                if (isSelected) {
                    btn.classList.add('is-selected');
                }

                if (isToday) {
                    btn.classList.add('is-today');
                }

                var numSpan = document.createElement('span');
                numSpan.textContent = d;
                btn.appendChild(numSpan);

                (function(dayNum, cDate) {
                    btn.addEventListener('click', function() {
                        selectedDate = new Date(cDate);
                        renderCalendar();
                        renderTimeslots();
                    });
                })(d, cellDate);

                daysGrid.appendChild(btn);
            }
        }

        // Render Timeslots
        function renderTimeslots() {
            if (!slotsList || !selectedDayLabel) return;

            var dName = dayNamesShort[selectedDate.getDay()];
            var dNum = selectedDate.getDate();
            var suffix = 'th';
            if (dNum === 1 || dNum === 21 || dNum === 31) suffix = 'st';
            else if (dNum === 2 || dNum === 22) suffix = 'nd';
            else if (dNum === 3 || dNum === 23) suffix = 'rd';

            selectedDayLabel.textContent = dName + ' ' + dNum + suffix;

            slotsList.innerHTML = '';

            var activeSlots = (selectedFormat === '24h') ? defaultSlots24 : defaultSlots12;

            activeSlots.forEach(function(slotText, idx) {
                var slotBtn = document.createElement('button');
                slotBtn.type = 'button';
                slotBtn.className = 'cal-slot-btn';
                slotBtn.textContent = slotText;

                slotBtn.addEventListener('click', function() {
                    selectedTimeSlot = slotText;
                    goToStep2();
                });

                slotsList.appendChild(slotBtn);
            });
        }

        // Navigation for Month
        if (prevMonthBtn) {
            prevMonthBtn.addEventListener('click', function() {
                viewMonth--;
                if (viewMonth < 0) {
                    viewMonth = 11;
                    viewYear--;
                }
                renderCalendar();
            });
        }

        if (nextMonthBtn) {
            nextMonthBtn.addEventListener('click', function() {
                viewMonth++;
                if (viewMonth > 11) {
                    viewMonth = 0;
                    viewYear++;
                }
                renderCalendar();
            });
        }

        // Duration Pills (30m vs 50m)
        durationBtns.forEach(function(btn) {
            btn.addEventListener('click', function() {
                durationBtns.forEach(function(b) { b.classList.remove('is-active'); });
                btn.classList.add('is-active');
                selectedDuration = btn.getAttribute('data-duration') || '30m';
                if (summaryDurationDisplay) summaryDurationDisplay.textContent = selectedDuration;
            });
        });

        // 12h / 24h Toggle
        formatBtns.forEach(function(btn) {
            btn.addEventListener('click', function() {
                formatBtns.forEach(function(b) { b.classList.remove('is-active'); });
                btn.classList.add('is-active');
                selectedFormat = btn.getAttribute('data-format') || '12h';
                renderTimeslots();
            });
        });

        // Transition: Step 1 -> Step 2
        function goToStep2() {
            var fullDayName = dayNamesFull[selectedDate.getDay()];
            var mName = monthNames[selectedDate.getMonth()];
            var dNum = selectedDate.getDate();
            var yNum = selectedDate.getFullYear();

            var fullDateString = fullDayName + ', ' + mName + ' ' + dNum + ', ' + yNum;
            var endTimeStr = getEndTime(selectedTimeSlot, selectedDuration);
            var timeRangeString = selectedTimeSlot + ' – ' + endTimeStr;

            if (summaryDateDisplay) summaryDateDisplay.textContent = fullDateString;
            if (summaryTimeDisplay) summaryTimeDisplay.textContent = timeRangeString;
            if (summaryDurationDisplay) summaryDurationDisplay.textContent = selectedDuration;

            step1.style.display = 'none';
            step2.style.display = 'block';
            step3.style.display = 'none';

            // Scroll widget into view smoothly if needed
            widget.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }

        // Back to Step 1
        if (backToStep1Btn) {
            backToStep1Btn.addEventListener('click', function() {
                step2.style.display = 'none';
                step1.style.display = 'block';
                step3.style.display = 'none';
            });
        }

        // Toggle Add Guests input
        if (toggleGuestsBtn && guestsInputWrap) {
            toggleGuestsBtn.addEventListener('click', function() {
                if (guestsInputWrap.style.display === 'none' || guestsInputWrap.style.display === '') {
                    guestsInputWrap.style.display = 'block';
                    var gInput = guestsInputWrap.querySelector('input');
                    if (gInput) gInput.focus();
                } else {
                    guestsInputWrap.style.display = 'none';
                }
            });
        }

        // Form Submit
        if (bookingForm) {
            bookingForm.addEventListener('submit', function(e) {
                e.preventDefault();

                if (formErrorMsg) {
                    formErrorMsg.style.display = 'none';
                    formErrorMsg.textContent = '';
                }

                var nameVal = (document.getElementById('booker_name') || {}).value || '';
                var emailVal = (document.getElementById('booker_email') || {}).value || '';
                var phoneVal = (document.getElementById('booker_phone') || {}).value || '';
                var notesVal = (document.getElementById('booker_notes') || {}).value || '';
                var guestsVal = (document.getElementById('booker_guests') || {}).value || '';

                if (!nameVal.trim() || !emailVal.trim() || !phoneVal.trim()) {
                    if (formErrorMsg) {
                        formErrorMsg.textContent = 'Please provide your Name, Email, and Phone number.';
                        formErrorMsg.style.display = 'block';
                    }
                    return;
                }

                // Append +92 if local number
                var fullPhone = phoneVal.trim();
                if (!fullPhone.startsWith('+')) {
                    fullPhone = '+92 ' + fullPhone.replace(/^0+/, '');
                }

                var fullDayName = dayNamesFull[selectedDate.getDay()];
                var mName = monthNames[selectedDate.getMonth()];
                var dNum = selectedDate.getDate();
                var yNum = selectedDate.getFullYear();
                var formattedDate = fullDayName + ', ' + mName + ' ' + dNum + ', ' + yNum;
                var formattedTime = selectedTimeSlot + ' – ' + getEndTime(selectedTimeSlot, selectedDuration);

                // Disable submit button & show spinner
                if (confirmBtn) {
                    confirmBtn.disabled = true;
                    var spinner = confirmBtn.querySelector('.btn-spinner');
                    var bText = confirmBtn.querySelector('.btn-text');
                    if (spinner) spinner.style.display = 'inline-block';
                    if (bText) bText.style.opacity = '0.4';
                }

                // Construct FormData
                var formData = new FormData();
                formData.append('action', 'sarmad_submit_reservation');
                formData.append('nonce', nonce);
                formData.append('name', nameVal);
                formData.append('email', emailVal);
                formData.append('phone', fullPhone);
                formData.append('date', formattedDate);
                formData.append('time', formattedTime);
                formData.append('duration', selectedDuration);
                formData.append('notes', notesVal);
                formData.append('guests', guestsVal);
                formData.append('timezone', userTimezone);

                fetch(ajaxUrl, {
                    method: 'POST',
                    body: formData
                })
                .then(function(response) {
                    return response.json();
                })
                .then(function(data) {
                    if (confirmBtn) {
                        confirmBtn.disabled = false;
                        var spinner = confirmBtn.querySelector('.btn-spinner');
                        var bText = confirmBtn.querySelector('.btn-text');
                        if (spinner) spinner.style.display = 'none';
                        if (bText) bText.style.opacity = '1';
                    }

                    if (data && data.success) {
                        // Setup Step 3
                        if (successDatetimeLabel) {
                            successDatetimeLabel.textContent = formattedDate + ' · ' + selectedTimeSlot;
                        }
                        if (successPhoneLabel) {
                            successPhoneLabel.textContent = fullPhone;
                        }

                        // WhatsApp Direct Link
                        var cleanPhone = fullPhone.replace(/[^0-9]/g, '');
                        var waMsg = encodeURIComponent(
                            "Hi Sarmad, I have booked a meeting (" + formattedDate + " at " + selectedTimeSlot + ") regarding my product."
                        );
                        if (directWaBtn) {
                            directWaBtn.href = "https://wa.me/923000000000?text=" + waMsg; // Sarmad's WhatsApp routing
                        }

                        // Switch to Step 3
                        step1.style.display = 'none';
                        step2.style.display = 'none';
                        step3.style.display = 'block';

                        widget.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                    } else {
                        if (formErrorMsg) {
                            formErrorMsg.textContent = (data && data.data && data.data.message) ? data.data.message : 'An error occurred. Please try again.';
                            formErrorMsg.style.display = 'block';
                        }
                    }
                })
                .catch(function(err) {
                    if (confirmBtn) {
                        confirmBtn.disabled = false;
                        var spinner = confirmBtn.querySelector('.btn-spinner');
                        var bText = confirmBtn.querySelector('.btn-text');
                        if (spinner) spinner.style.display = 'none';
                        if (bText) bText.style.opacity = '1';
                    }
                    if (formErrorMsg) {
                        formErrorMsg.textContent = 'Server connection error. Please try again.';
                        formErrorMsg.style.display = 'block';
                    }
                });

            });
        }

        // Reset / Book another time
        if (bookAnotherBtn) {
            bookAnotherBtn.addEventListener('click', function() {
                if (bookingForm) bookingForm.reset();
                step3.style.display = 'none';
                step2.style.display = 'none';
                step1.style.display = 'block';
                renderCalendar();
                renderTimeslots();
            });
        }

        // Modal Overlay Triggers
        var modalTriggers = document.querySelectorAll('.booking-submit-btn, [data-open-booking-modal]');
        var modalOverlay = document.getElementById('cal-booking-modal-overlay');
        var modalCloseBtn = document.getElementById('cal-modal-close-btn');

        if (modalOverlay) {
            modalTriggers.forEach(function(btn) {
                btn.addEventListener('click', function(e) {
                    // Only intercept if we are on a page where modal overlay exists and not navigating away
                    if (window.location.pathname !== '/contact/' && window.location.pathname !== '/contact') {
                        e.preventDefault();
                        modalOverlay.style.display = 'flex';
                        document.body.style.overflow = 'hidden';
                        renderCalendar();
                        renderTimeslots();
                    }
                });
            });

            if (modalCloseBtn) {
                modalCloseBtn.addEventListener('click', function() {
                    modalOverlay.style.display = 'none';
                    document.body.style.overflow = '';
                });
            }

            modalOverlay.addEventListener('click', function(e) {
                if (e.target === modalOverlay) {
                    modalOverlay.style.display = 'none';
                    document.body.style.overflow = '';
                }
            });

            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && modalOverlay.style.display !== 'none') {
                    modalOverlay.style.display = 'none';
                    document.body.style.overflow = '';
                }
            });
        }

        // Initialize view
        renderCalendar();
        renderTimeslots();
    });
})();
