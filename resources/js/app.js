import Alpine from 'alpinejs';
import Swiper from 'swiper';
import { Navigation, Pagination } from 'swiper/modules';
// Lightweight YouTube facade: shows the thumbnail and only loads the real player on click.
import 'lite-youtube-embed';

window.Alpine = Alpine;
window.Swiper = Swiper;

/**
 * Create a Swiper with the shared Navigation/Pagination modules.
 * Usage in Blade: <div x-data x-init="initSwiper($el, { ... })">
 *
 * Defaults keep any number of slides tidy: with fewer slides than fit on screen the slides are
 * centered and navigation/pagination hide themselves (watchOverflow).
 */
window.initSwiper = (el, options = {}) => {
    const config = {
        modules: [],
        watchOverflow: true,
        centerInsufficientSlides: true,
        ...options,
    };
    const pagination = el.querySelector('.swiper-pagination');
    const next = el.querySelector('.swiper-button-next');
    const prev = el.querySelector('.swiper-button-prev');

    // Only register a module when its markup exists; passing `undefined` params crashes Swiper.
    if (pagination) {
        config.modules.push(Pagination);
        config.pagination = { el: pagination, clickable: true };
    }
    if (next && prev) {
        config.modules.push(Navigation);
        config.navigation = { nextEl: next, prevEl: prev };
    }

    return new Swiper(el, config);
};

/**
 * "Load more" list: reveals `step` more items each click.
 * Usage: x-data="loadMore({ initial: 6, step: 3, total: {{ $n }} })"
 */
Alpine.data('loadMore', ({ initial = 6, step = 3, total = 0 } = {}) => ({
    visible: initial,
    total,
    more() {
        this.visible = Math.min(this.visible + step, this.total);
    },
    get hasMore() {
        return this.visible < this.total;
    },
}));

/**
 * Promo popup (resources/views/UserPage/Layouts/popups.blade.php).
 * Opens after `delay` ms unless this browser session already dismissed it (sessionStorage `key`),
 * locks page scroll while open, traps keyboard focus inside the dialog and restores focus on close.
 */
Alpine.data('promoPopup', ({ key = 'promo-popup', delay = 900 } = {}) => ({
    open: false,
    previousFocus: null,

    init() {
        let dismissed = false;
        try {
            dismissed = window.sessionStorage.getItem(key) === '1';
        } catch (e) {
            // Storage blocked (private mode): the popup simply shows on every page view.
        }
        if (!dismissed) {
            setTimeout(() => this.show(), delay);
        }
    },

    show() {
        this.previousFocus = document.activeElement;
        this.open = true;
        document.documentElement.classList.add('overflow-hidden');
        this.$nextTick(() => this.$refs.close && this.$refs.close.focus());
    },

    /** Remember the dismissal for this session. */
    dismiss() {
        try {
            window.sessionStorage.setItem(key, '1');
        } catch (e) {
            // ignore
        }
    },

    close() {
        if (!this.open) {
            return;
        }
        this.open = false;
        this.dismiss();
        document.documentElement.classList.remove('overflow-hidden');
        if (this.previousFocus && this.previousFocus.focus) {
            this.previousFocus.focus();
        }
    },

    /** Keep Tab / Shift+Tab inside the dialog while it is open. */
    trap(event) {
        if (!this.open) {
            return;
        }
        const focusable = Array.from(this.$refs.panel.querySelectorAll('a[href], button:not([disabled])'));
        if (!focusable.length) {
            return;
        }
        const first = focusable[0];
        const last = focusable[focusable.length - 1];
        if (event.shiftKey && document.activeElement === first) {
            event.preventDefault();
            last.focus();
        } else if (!event.shiftKey && document.activeElement === last) {
            event.preventDefault();
            first.focus();
        } else if (!this.$refs.panel.contains(document.activeElement)) {
            event.preventDefault();
            first.focus();
        }
    },
}));
Alpine.start();

/** Reveal sections as they enter the viewport. */
const revealSections = () => {
    const sections = document.querySelectorAll('.reveal');
    if (!('IntersectionObserver' in window)) {
        sections.forEach((s) => s.classList.add('is-visible'));
        return;
    }
    const observer = new IntersectionObserver(
        (entries) =>
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target);
                }
            }),
        { threshold: 0.05, rootMargin: '0px 0px 10% 0px' },
    );
    sections.forEach((s) => observer.observe(s));
};

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', revealSections);
} else {
    revealSections();
}
