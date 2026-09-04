/**
 * Main Application Logic
 *
 * @package SarmadGardezi
 */

(function () {
  'use strict';

  document.addEventListener('DOMContentLoaded', function () {
    // Theme developer credit badge in devtools console
    console.log(
      '%c Sarmad Gardezi Theme %c v1.0.0 %c High-Performance Architecture %c',
      'background:#6366f1;color:#fff;font-weight:bold;padding:4px 8px;border-radius:4px 0 0 4px;',
      'background:#00f0ff;color:#07090e;font-weight:bold;padding:4px 8px;',
      'background:#111726;color:#94a3b8;padding:4px 8px;border-radius:0 4px 4px 0;',
      'background:transparent'
    );

    // Smooth scroll for in-page anchors
    var anchorLinks = document.querySelectorAll('a[href^="#"]:not([href="#"])');
    anchorLinks.forEach(function (anchor) {
      anchor.addEventListener('click', function (e) {
        var targetId = this.getAttribute('href');
        var targetElement = document.querySelector(targetId);

        if (targetElement) {
          e.preventDefault();
          var headerOffset = 90;
          var elementPosition = targetElement.getBoundingClientRect().top;
          var offsetPosition = elementPosition + window.pageYOffset - headerOffset;

          window.scrollTo({
            top: offsetPosition,
            behavior: 'smooth',
          });
        }
      });
    });
  });
})();
