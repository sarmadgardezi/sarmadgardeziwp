/**
 * Navigation and Header Interactions
 *
 * @package SarmadGardezi
 */

(function () {
  'use strict';

  document.addEventListener('DOMContentLoaded', function () {
    var menuToggle = document.getElementById('menu-toggle');
    var menuPanel = document.getElementById('header-menu-panel');
    var menuBackdrop = document.getElementById('header-menu-backdrop');

    function openMenu() {
      if (!menuToggle || !menuPanel) return;
      menuToggle.setAttribute('aria-expanded', 'true');
      menuPanel.classList.remove('hidden');
      document.body.style.overflow = 'hidden';
    }

    function closeMenu() {
      if (!menuToggle || !menuPanel) return;
      menuToggle.setAttribute('aria-expanded', 'false');
      menuPanel.classList.add('hidden');
      document.body.style.overflow = '';
    }

    function toggleMenu(e) {
      if (e) e.stopPropagation();
      var isExpanded = menuToggle.getAttribute('aria-expanded') === 'true';
      if (isExpanded) {
        closeMenu();
      } else {
        openMenu();
      }
    }

    if (menuToggle && menuPanel) {
      menuToggle.addEventListener('click', toggleMenu);

      if (menuBackdrop) {
        menuBackdrop.addEventListener('click', closeMenu);
      }

      // Close on clicking outside the dropdown container
      document.addEventListener('click', function (e) {
        if (
          !menuPanel.classList.contains('hidden') &&
          !menuPanel.querySelector('.header-menu-dropdown-inner').contains(e.target) &&
          !menuToggle.contains(e.target)
        ) {
          closeMenu();
        }
      });

      // Close on Escape key press
      document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && !menuPanel.classList.contains('hidden')) {
          closeMenu();
          menuToggle.focus();
        }
      });
    }

    // Dynamic active state handler for nav links
    var allNavLinks = document.querySelectorAll('.header-nav-item');
    if (allNavLinks.length > 0) {
      allNavLinks.forEach(function (link) {
        link.addEventListener('click', function () {
          var href = this.getAttribute('href') || '';
          if (href.indexOf('#') !== -1) {
            allNavLinks.forEach(function (other) {
              other.classList.remove('active', 'current-menu-item');
              var dot = other.querySelector('.nav-active-dot');
              if (dot) dot.remove();
            });

            this.classList.add('active', 'current-menu-item');
            if (!this.querySelector('.nav-active-dot')) {
              var dot = document.createElement('span');
              dot.className = 'nav-active-dot';
              dot.setAttribute('aria-hidden', 'true');
              this.appendChild(dot);
            }
          }

          closeMenu();
        });
      });
    }
  });
})();
