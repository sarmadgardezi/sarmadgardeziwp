/**
 * Navigation and Mobile Drawer Interactions
 *
 * @package SarmadGardezi
 */

(function () {
  'use strict';

  document.addEventListener('DOMContentLoaded', function () {
    // ----------------------------------------------------------------------
    // 1. Mobile Menu Drawer
    // ----------------------------------------------------------------------
    var mobileToggle = document.getElementById('mobile-menu-toggle');
    var mobileDrawer = document.getElementById('header-mobile-drawer');
    var mobileBackdrop = document.getElementById('mobile-drawer-backdrop');
    var mobileLinks = document.querySelectorAll('.mobile-nav-link');

    function openMobileMenu() {
      if (!mobileDrawer) return;
      if (mobileToggle) mobileToggle.setAttribute('aria-expanded', 'true');
      mobileDrawer.classList.add('is-open');
      mobileDrawer.setAttribute('aria-hidden', 'false');
      document.body.style.overflow = 'hidden';

      // Focus first link for keyboard accessibility
      var firstLink = mobileDrawer.querySelector('.mobile-nav-link');
      if (firstLink) {
        firstLink.focus();
      }
    }

    function closeMobileMenu() {
      if (!mobileDrawer) return;
      if (mobileToggle) {
        mobileToggle.setAttribute('aria-expanded', 'false');
        mobileToggle.focus();
      }
      mobileDrawer.classList.remove('is-open');
      mobileDrawer.setAttribute('aria-hidden', 'true');
      document.body.style.overflow = '';
    }

    function toggleMobileMenu(e) {
      if (e) e.stopPropagation();
      var isExpanded = mobileToggle && mobileToggle.getAttribute('aria-expanded') === 'true';
      if (isExpanded) {
        closeMobileMenu();
      } else {
        openMobileMenu();
      }
    }

    if (mobileToggle && mobileDrawer) {
      mobileToggle.addEventListener('click', toggleMobileMenu);

      if (mobileBackdrop) {
        mobileBackdrop.addEventListener('click', closeMobileMenu);
      }

      if (mobileLinks.length > 0) {
        mobileLinks.forEach(function (link) {
          link.addEventListener('click', function () {
            closeMobileMenu();
          });
        });
      }

      // Close mobile menu on Escape key press
      document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && mobileDrawer.classList.contains('is-open')) {
          closeMobileMenu();
        }
      });
    }

    // ----------------------------------------------------------------------
    // 2. Legacy Boxed Modal Navigation (if present)
    // ----------------------------------------------------------------------
    var menuToggle = document.getElementById('menu-toggle');
    var menuModal = document.getElementById('header-menu-modal');
    var menuBackdrop = document.getElementById('header-menu-backdrop');
    var modalCloseTrigger = document.getElementById('modal-close-trigger');

    if (menuToggle && menuModal) {
      menuToggle.addEventListener('click', function (e) {
        if (e) e.stopPropagation();
        var isExpanded = menuToggle.getAttribute('aria-expanded') === 'true';
        if (isExpanded) {
          menuToggle.setAttribute('aria-expanded', 'false');
          menuModal.classList.add('hidden');
          document.body.style.overflow = '';
        } else {
          menuToggle.setAttribute('aria-expanded', 'true');
          menuModal.classList.remove('hidden');
          document.body.style.overflow = 'hidden';
        }
      });

      if (menuBackdrop) {
        menuBackdrop.addEventListener('click', function () {
          menuModal.classList.add('hidden');
          document.body.style.overflow = '';
        });
      }

      if (modalCloseTrigger) {
        modalCloseTrigger.addEventListener('click', function () {
          menuModal.classList.add('hidden');
          document.body.style.overflow = '';
        });
      }
    }

    // ----------------------------------------------------------------------
    // 3. Header On-Scroll Background Effect
    // ----------------------------------------------------------------------
    var masthead = document.getElementById('masthead');
    if (masthead) {
      var ticking = false;
      function updateHeaderScroll() {
        if (window.scrollY > 20) {
          masthead.classList.add('is-scrolled');
        } else {
          masthead.classList.remove('is-scrolled');
        }
        ticking = false;
      }

      window.addEventListener('scroll', function () {
        if (!ticking) {
          window.requestAnimationFrame(updateHeaderScroll);
          ticking = true;
        }
      }, { passive: true });

      updateHeaderScroll();
    }
  });
})();

