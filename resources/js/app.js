import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {
    // Mobile navigation
    const toggle = document.querySelector('[data-nav-toggle]');
    const menu = document.querySelector('[data-nav-menu]');

    if (toggle && menu) {
        toggle.addEventListener('click', () => {
            const open = toggle.getAttribute('aria-expanded') === 'true';
            toggle.setAttribute('aria-expanded', String(!open));
            menu.classList.toggle('hidden', open);
        });

        menu.querySelectorAll('a').forEach((link) =>
            link.addEventListener('click', () => {
                toggle.setAttribute('aria-expanded', 'false');
                menu.classList.add('hidden');
            }),
        );
    }

    // Header shadow on scroll
    const header = document.querySelector('[data-header]');
    const onScroll = () => header?.classList.toggle('shadow-sm', window.scrollY > 8);
    onScroll();
    window.addEventListener('scroll', onScroll, { passive: true });

    // Preparedness tabs
    const tabs = document.querySelectorAll('[role="tab"]');
    tabs.forEach((tab) =>
        tab.addEventListener('click', () => {
            tabs.forEach((t) => {
                const selected = t === tab;
                t.setAttribute('aria-selected', String(selected));
                t.tabIndex = selected ? 0 : -1;
                document.getElementById(t.getAttribute('aria-controls'))?.toggleAttribute('hidden', !selected);
            });
        }),
    );

    // Footer year
    const year = document.querySelector('[data-year]');
    if (year) year.textContent = new Date().getFullYear();
});
