import './bootstrap';
import Alpine from 'alpinejs';
import Swiper from 'swiper';
import { Navigation, Pagination } from 'swiper/modules';

window.Alpine = Alpine;
window.Swiper = Swiper;

/**
 * Create a Swiper with the shared Navigation/Pagination modules.
 * Usage in Blade: <div x-data x-init="initSwiper($el, { ... })">
 */
window.initSwiper = (el, options = {}) => {
    const config = { modules: [], ...options };
    const pagination = el.querySelector('.swiper-pagination');
    const next = el.querySelector('.swiper-button-next');
    const prev = el.querySelector('.swiper-button-prev');

    // Only register a module when its markup exists; passing `undefined` params crashes Swiper.
    if (pagination) {
        config.modules.push(Pagination);
        config.pagination = { el: pagination, clickable: true, dynamicBullets: true };
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

Alpine.start();

/** Reveal sections as they enter the viewport. */
document.addEventListener('DOMContentLoaded', () => {
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
        { threshold: 0.05 },
    );
    sections.forEach((s) => observer.observe(s));
});
