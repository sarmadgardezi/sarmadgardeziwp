/**
 * Navigation and Header Modal Interactions
 *
 * @package SarmadGardezi
 */

(function () {
  'use strict';

  document.addEventListener('DOMContentLoaded', function () {
    var menuToggle = document.getElementById('menu-toggle');
    var menuModal = document.getElementById('header-menu-modal');
    var menuBackdrop = document.getElementById('header-menu-backdrop');
    var modalCloseTrigger = document.getElementById('modal-close-trigger');

    function openMenu() {
      if (!menuModal) return;
      if (menuToggle) menuToggle.setAttribute('aria-expanded', 'true');
      menuModal.classList.remove('hidden');
      document.body.style.overflow = 'hidden';
      
      // Focus first link or close button for accessibility
      var firstLink = menuModal.querySelector('.boxed-nav-link');
      if (firstLink) {
        firstLink.focus();
      }
    }

    function closeMenu() {
      if (!menuModal) return;
      if (menuToggle) {
        menuToggle.setAttribute('aria-expanded', 'false');
        menuToggle.focus();
      }
      menuModal.classList.add('hidden');
      document.body.style.overflow = '';
    }

    function toggleMenu(e) {
      if (e) e.stopPropagation();
      var isExpanded = menuToggle && menuToggle.getAttribute('aria-expanded') === 'true';
      if (isExpanded) {
        closeMenu();
      } else {
        openMenu();
      }
    }

    if (menuToggle && menuModal) {
      menuToggle.addEventListener('click', toggleMenu);

      if (menuBackdrop) {
        menuBackdrop.addEventListener('click', closeMenu);
      }

      if (modalCloseTrigger) {
        modalCloseTrigger.addEventListener('click', closeMenu);
      }

      // Close on clicking outside card
      menuModal.addEventListener('click', function (e) {
        var card = menuModal.querySelector('.header-boxed-card');
        var closeNotch = menuModal.querySelector('.header-modal-close-notch');
        if (card && !card.contains(e.target) && (!closeNotch || !closeNotch.contains(e.target))) {
          closeMenu();
        }
      });

      // Close on Escape key press
      document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && !menuModal.classList.contains('hidden')) {
          closeMenu();
        }
      });
    }

    // Nav link click handling
    var boxedNavLinks = document.querySelectorAll('.boxed-nav-link');
    if (boxedNavLinks.length > 0) {
      boxedNavLinks.forEach(function (link) {
        link.addEventListener('click', function () {
          var href = this.getAttribute('href') || '';
          if (href.indexOf('#') !== -1) {
            boxedNavLinks.forEach(function (other) {
              other.classList.remove('is-active', 'active', 'current-menu-item');
            });
            this.classList.add('is-active', 'active', 'current-menu-item');
          }
          closeMenu();
        });
      });
    }
  });
})();
