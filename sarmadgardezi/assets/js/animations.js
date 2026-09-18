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

    // Add global CSS helper for generic reveals
    var style = document.createElement('style');
    style.innerHTML = '.glass-card.is-revealed, .section-header.is-revealed, .section-header-flex.is-revealed { opacity: 1 !important; transform: translateY(0) !important; }';
    document.head.appendChild(style);
  });
})();
