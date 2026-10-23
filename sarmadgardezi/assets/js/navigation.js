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
    // 3. Desktop Dropdown Menu Accessibility & Click Interactions
    // ----------------------------------------------------------------------
    var dropdownItems = document.querySelectorAll('.header-nav-item.has-dropdown');

    dropdownItems.forEach(function (item) {
      var toggle = item.querySelector('.dropdown-toggle');
      if (!toggle) return;

      toggle.addEventListener('click', function (e) {
        e.preventDefault();
        e.stopPropagation();

        var isOpen = item.classList.contains('is-open');

        // Close other dropdowns
        dropdownItems.forEach(function (other) {
          if (other !== item) {
            other.classList.remove('is-open');
            var otherToggle = other.querySelector('.dropdown-toggle');
            if (otherToggle) otherToggle.setAttribute('aria-expanded', 'false');
          }
        });

        if (isOpen) {
          item.classList.remove('is-open');
          toggle.setAttribute('aria-expanded', 'false');
        } else {
          item.classList.add('is-open');
          toggle.setAttribute('aria-expanded', 'true');
        }
      });
    });

    // Close desktop dropdowns on click outside
    document.addEventListener('click', function (e) {
      if (!e.target.closest('.header-nav-item.has-dropdown')) {
        dropdownItems.forEach(function (item) {
          item.classList.remove('is-open');
          var toggle = item.querySelector('.dropdown-toggle');
          if (toggle) toggle.setAttribute('aria-expanded', 'false');
        });
      }
    });

    // Close desktop dropdowns on Escape key
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape') {
        dropdownItems.forEach(function (item) {
          item.classList.remove('is-open');
          var toggle = item.querySelector('.dropdown-toggle');
          if (toggle) toggle.setAttribute('aria-expanded', 'false');
        });
      }
    });

    // ----------------------------------------------------------------------
    // 4. Mobile Dropdown Accordion Interactions
    // ----------------------------------------------------------------------
    var mobileDropdownToggles = document.querySelectorAll('.mobile-dropdown-toggle');

    mobileDropdownToggles.forEach(function (btn) {
      btn.addEventListener('click', function (e) {
        e.preventDefault();
        e.stopPropagation();

        var parentItem = btn.closest('.mobile-nav-item.mobile-has-dropdown');
        if (!parentItem) return;

        var submenu = parentItem.querySelector('.mobile-submenu-list');
        if (!submenu) return;

        var isExpanded = btn.getAttribute('aria-expanded') === 'true';
        if (isExpanded) {
          btn.setAttribute('aria-expanded', 'false');
          submenu.setAttribute('hidden', '');
        } else {
          btn.setAttribute('aria-expanded', 'true');
          submenu.removeAttribute('hidden');
        }
      });
    });

    // ----------------------------------------------------------------------
    // 5. Header On-Scroll Background Effect
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

