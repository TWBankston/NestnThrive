/**
 * Nest N Thrive - V2 Aura Main JavaScript
 */

(function() {
    'use strict';

    // Initialize Lucide icons
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }

    // Reveal Animation Observer
    const revealObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('active');
                observer.unobserve(entry.target);
            }
        });
    }, {
        root: null,
        rootMargin: '0px',
        threshold: 0.1
    });

    // Observe all reveal elements
    document.querySelectorAll('.nnt-reveal, .reveal').forEach(el => {
        revealObserver.observe(el);
    });

    // Header scroll behavior
    const header = document.querySelector('.nnt-header');
    if (header) {
        let lastScroll = 0;
        window.addEventListener('scroll', () => {
            const currentScroll = window.pageYOffset;
            if (currentScroll > 100) {
                header.classList.add('nnt-header--scrolled');
            } else {
                header.classList.remove('nnt-header--scrolled');
            }
            lastScroll = currentScroll;
        });
    }

    // Mobile menu toggle
    const menuToggle = document.querySelector('.nnt-header__menu-toggle');
    const mobileMenu = document.querySelector('.nnt-header__mobile-menu');
    if (menuToggle && mobileMenu) {
        menuToggle.addEventListener('click', () => {
            mobileMenu.classList.toggle('active');
            menuToggle.classList.toggle('active');
        });
    }

})();

