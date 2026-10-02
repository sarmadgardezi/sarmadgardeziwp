/**
 * Scroll Reveals and Interactive Animations
 *
 * @package SarmadGardezi
 */

(function () {
  'use strict';

  document.addEventListener('DOMContentLoaded', function () {
    // 1. General scroll reveal elements
    if ('IntersectionObserver' in window) {
      var generalAnimatedElements = document.querySelectorAll(
        '.glass-card, .section-header, .section-header-flex'
      );

      var generalObserver = new IntersectionObserver(
        function (entries) {
          entries.forEach(function (entry) {
            if (entry.isIntersecting) {
              entry.target.classList.add('is-revealed');
              generalObserver.unobserve(entry.target);
            }
          });
        },
        {
          threshold: 0.1,
          rootMargin: '0px 0px -40px 0px',
        }
      );

      generalAnimatedElements.forEach(function (el) {
        el.style.opacity = '0';
        el.style.transform = 'translateY(20px)';
        el.style.transition = 'opacity 0.6s cubic-bezier(0.16, 1, 0.3, 1), transform 0.6s cubic-bezier(0.16, 1, 0.3, 1)';
        generalObserver.observe(el);
      });

      // 2. Creator Reels Showcase specific on-scroll fan entrance
      var reelsSection = document.getElementById('creator-reels');
      var reelCards = document.querySelectorAll('.reel-card');

      if (reelsSection && reelCards.length > 0) {
        var reelsObserver = new IntersectionObserver(
          function (entries) {
            entries.forEach(function (entry) {
              if (entry.isIntersecting) {
                reelsSection.classList.add('is-revealed');
                reelCards.forEach(function (card) {
                  card.classList.add('is-in-view');
                });
                reelsObserver.unobserve(entry.target);
              }
            });
          },
          {
            threshold: 0.15,
            rootMargin: '0px 0px -30px 0px',
          }
        );

        reelsObserver.observe(reelsSection);
      }
    } else {
      // Fallback for older browsers
      var allCards = document.querySelectorAll('.reel-card');
      allCards.forEach(function (card) {
        card.classList.add('is-in-view');
      });
    }

    // 3. Dynamic Looping Logo Strip Swiper / Flipper
    var logoStrip = document.getElementById('dynamic-logo-strip');
    if (logoStrip) {
      var rawBrandsData = logoStrip.getAttribute('data-brands');
      var brandsPool = [];
      try {
        brandsPool = JSON.parse(rawBrandsData);
      } catch (err) {
        brandsPool = [];
      }

      if (brandsPool && brandsPool.length > 0) {
        var slots = logoStrip.querySelectorAll('.logo-slot');
        var slotCount = slots.length;

        // Track which brand index from brandsPool is currently in each slot
        var currentSlotBrands = [];
        slots.forEach(function (slot, i) {
          currentSlotBrands[i] = i % brandsPool.length;
        });

        var nextBrandPointer = slotCount % brandsPool.length;
        var currentSlotToAnimate = 0;
        var isPaused = false;

        logoStrip.addEventListener('mouseenter', function () {
          isPaused = true;
        });
        logoStrip.addEventListener('mouseleave', function () {
          isPaused = false;
        });

        function swapNextLogo() {
          if (isPaused || brandsPool.length <= slotCount) return;

          // Find a brand from brandsPool that is NOT currently displayed in any slot
          var candidateIndex = nextBrandPointer;
          var attempts = 0;
          while (currentSlotBrands.indexOf(candidateIndex) !== -1 && attempts < brandsPool.length) {
            candidateIndex = (candidateIndex + 1) % brandsPool.length;
            attempts++;
          }
          nextBrandPointer = (candidateIndex + 1) % brandsPool.length;

          var slotIndex = currentSlotToAnimate;
          currentSlotToAnimate = (currentSlotToAnimate + 1) % slotCount;

          var slot = slots[slotIndex];
          if (!slot) return;

          var newBrand = brandsPool[candidateIndex];
          currentSlotBrands[slotIndex] = candidateIndex;

          // Create new incoming logo element
          var newLogoDiv = document.createElement('div');
          newLogoDiv.className = 'logo-item incoming-logo';

          if (newBrand.link) {
            var a = document.createElement('a');
            a.href = newBrand.link;
            a.target = '_blank';
            a.rel = 'noopener noreferrer';
            a.title = newBrand.name || '';
            var img = document.createElement('img');
            img.src = newBrand.url;
            img.alt = newBrand.name || '';
            img.className = 'brand-img';
            img.loading = 'lazy';
            a.appendChild(img);
            newLogoDiv.appendChild(a);
          } else {
            var img = document.createElement('img');
            img.src = newBrand.url;
            img.alt = newBrand.name || '';
            img.className = 'brand-img';
            img.loading = 'lazy';
            newLogoDiv.appendChild(img);
          }

          slot.appendChild(newLogoDiv);

          var currentLogo = slot.querySelector('.current-logo');

          // Trigger the slide animation
          requestAnimationFrame(function () {
            if (currentLogo) {
              currentLogo.classList.add('slide-out');
            }
            newLogoDiv.classList.add('slide-in');
          });

          // Cleanup after transition finishes
          setTimeout(function () {
            if (currentLogo && currentLogo.parentNode === slot) {
              slot.removeChild(currentLogo);
            }
            newLogoDiv.className = 'logo-item current-logo';
          }, 650);
        }

        // Interval for continuous looping swipe
        setInterval(swapNextLogo, 2200);
      }
    }

    // Add global CSS helper for generic reveals
    var style = document.createElement('style');
    style.innerHTML = '.glass-card.is-revealed, .section-header.is-revealed, .section-header-flex.is-revealed { opacity: 1 !important; transform: translateY(0) !important; }';
    document.head.appendChild(style);
  });
})();
