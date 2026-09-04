/**
 * Navigation and Header Interactions
 *
 * @package SarmadGardezi
 */

(function () {
  'use strict';

  document.addEventListener('DOMContentLoaded', function () {
    var menuToggle = document.getElementById('menu-toggle');
    var mobileMenu = document.getElementById('mobile-menu');

    // Mobile menu toggle
    if (menuToggle && mobileMenu) {
      menuToggle.addEventListener('click', function (e) {
        e.stopPropagation();
        var isExpanded = menuToggle.getAttribute('aria-expanded') === 'true';
        menuToggle.setAttribute('aria-expanded', !isExpanded);
        mobileMenu.classList.toggle('hidden');
        mobileMenu.classList.toggle('is-active');
      });

      // Close menu when clicking outside
      document.addEventListener('click', function (e) {
        if (
          !mobileMenu.classList.contains('hidden') &&
          !mobileMenu.contains(e.target) &&
          !menuToggle.contains(e.target)
        ) {
          menuToggle.setAttribute('aria-expanded', 'false');
          mobileMenu.classList.add('hidden');
          mobileMenu.classList.remove('is-active');
        }
      });
    }

    // Dynamic active state handler for nav links
    var allNavLinks = document.querySelectorAll('#site-navigation a, #mobile-menu a:not(.btn-talk-mobile)');
    if (allNavLinks.length > 0) {
      allNavLinks.forEach(function (link) {
        link.addEventListener('click', function () {
          // If in-page anchor, update active state smoothly
          var href = this.getAttribute('href') || '';
          if (href.indexOf('#') !== -1) {
            // Remove active classes
            allNavLinks.forEach(function (other) {
              other.classList.remove('text-white', 'active', 'current-menu-item', 'bg-[#a3e635]/20');
              other.classList.add('text-zinc-400');
              var bar = other.querySelector('.active-bar');
              if (bar) bar.remove();
            });

            // Add active state to clicked item
            this.classList.remove('text-zinc-400');
            this.classList.add('text-white', 'active', 'current-menu-item');
            if (this.closest('#mobile-menu')) {
              this.classList.add('bg-[#a3e635]/20');
            } else {
              if (!this.querySelector('.active-bar')) {
                var bar = document.createElement('span');
                bar.className = 'absolute bottom-0 left-0 w-full h-[2px] bg-[#a3e635] rounded-full active-bar';
                bar.setAttribute('aria-hidden', 'true');
                this.appendChild(bar);
              }
            }
          }

          // Close mobile menu if open
          if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
            if (menuToggle) menuToggle.setAttribute('aria-expanded', 'false');
            mobileMenu.classList.add('hidden');
            mobileMenu.classList.remove('is-active');
          }
        });
      });
    }
  });
})();
