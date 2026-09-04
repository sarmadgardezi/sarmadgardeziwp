/**
 * Navigation and Header Interactions
 *
 * @package SarmadGardezi
 */

(function () {
  'use strict';

  document.addEventListener('DOMContentLoaded', function () {
    var menuToggle = document.getElementById('menu-toggle');
    var siteNav = document.getElementById('site-navigation');

    // Mobile menu toggle
    if (menuToggle && siteNav) {
      menuToggle.addEventListener('click', function (e) {
        e.stopPropagation();
        var isExpanded = menuToggle.getAttribute('aria-expanded') === 'true';
        menuToggle.setAttribute('aria-expanded', !isExpanded);
        siteNav.classList.toggle('is-active');
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

    // Dynamic active state handler for nav links
    var navLinks = document.querySelectorAll('#primary-menu li a');
    if (navLinks.length > 0) {
      navLinks.forEach(function (link) {
        link.addEventListener('click', function () {
          // Remove active classes from all items
          document.querySelectorAll('#primary-menu li').forEach(function (item) {
            item.classList.remove('current-menu-item', 'active');
          });

          // Set active on clicked item
          var parentLi = link.closest('li');
          if (parentLi) {
            parentLi.classList.add('current-menu-item', 'active');
          }

          // Close mobile menu if open
          if (siteNav && siteNav.classList.contains('is-active')) {
            menuToggle.setAttribute('aria-expanded', 'false');
            siteNav.classList.remove('is-active');
          }
        });
      });
    }
  });
})();
