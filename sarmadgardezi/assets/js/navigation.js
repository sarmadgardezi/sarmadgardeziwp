/**
 * Navigation and Header Scroll Interactions
 *
 * @package SarmadGardezi
 */

(function () {
  'use strict';

  document.addEventListener('DOMContentLoaded', function () {
    var header = document.getElementById('masthead');
    var menuToggle = document.getElementById('menu-toggle');
    var siteNav = document.getElementById('site-navigation');

    // Sticky header scroll elevation
    if (header) {
      var checkScroll = function () {
        if (window.scrollY > 30) {
          header.classList.add('is-scrolled');
        } else {
          header.classList.remove('is-scrolled');
        }
      };

      window.addEventListener('scroll', checkScroll, { passive: true });
      checkScroll();
    }

    // Mobile menu drawer toggle
    if (menuToggle && siteNav) {
      menuToggle.addEventListener('click', function () {
        var isExpanded = menuToggle.getAttribute('aria-expanded') === 'true';
        menuToggle.setAttribute('aria-expanded', !isExpanded);
        siteNav.classList.toggle('is-active');
      });

      // Close menu when clicking nav links on mobile
      var navLinks = siteNav.querySelectorAll('a');
      navLinks.forEach(function (link) {
        link.addEventListener('click', function () {
          if (window.innerWidth < 768) {
            menuToggle.setAttribute('aria-expanded', 'false');
            siteNav.classList.remove('is-active');
          }
        });
      });

      // Close menu when clicking outside
      document.addEventListener('click', function (e) {
        if (
          siteNav.classList.contains('is-active') &&
          !siteNav.contains(e.target) &&
          !menuToggle.contains(e.target)
        ) {
          menuToggle.setAttribute('aria-expanded', 'false');
          siteNav.classList.remove('is-active');
        }
      });
    }
  });
})();
