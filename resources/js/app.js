import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {
    const loginForm = document.getElementById('login-form');
    if (loginForm) {
        const submitBtn = loginForm.querySelector('button[type="submit"]');
        const btnText = submitBtn?.querySelector('[data-label]');

        loginForm.addEventListener('submit', () => {
            if (btnText) {
                btnText.textContent = 'Signing in...';
            }
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.classList.add('opacity-75', 'cursor-not-allowed');
            }
        });
    }

    const userMenu = document.getElementById('user-menu');
    const userDropdown = document.getElementById('user-dropdown');
    const sidebar = document.getElementById('sidebar');
    const sidebarBackdrop = document.getElementById('sidebar-backdrop');
    const sidebarArrowIcon = document.getElementById('sidebar-arrow-icon');
    const mobileSidebarLinks = document.querySelectorAll('#sidebar a');
    const desktopMedia = window.matchMedia('(min-width: 1024px)');

    const isDesktop = () => desktopMedia.matches;
    const isSidebarOpenMobile = () => sidebar && !sidebar.classList.contains('-translate-x-full');

    const closeMobileSidebar = () => {
        sidebar?.classList.add('-translate-x-full');
        sidebarBackdrop?.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    };

    const openMobileSidebar = () => {
        sidebar?.classList.remove('-translate-x-full');
        sidebarBackdrop?.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    };

    const syncArrow = () => {
        const isCollapsed = document.body.classList.contains('sidebar-collapsed');
        if (sidebarArrowIcon) {
            sidebarArrowIcon.style.transform = isCollapsed ? 'rotate(180deg)' : 'rotate(0deg)';
        }
    };

    window.toggleUserMenu = () => userDropdown?.classList.toggle('hidden');

    window.toggleSidebar = () => {
        if (isDesktop()) {
            document.body.classList.toggle('sidebar-collapsed');
            closeMobileSidebar();
            syncArrow();
            return;
        }

        if (isSidebarOpenMobile()) {
            closeMobileSidebar();
            return;
        }

        openMobileSidebar();
    };

    document.addEventListener('click', (e) => {
        if (userMenu && userDropdown && !userMenu.contains(e.target)) {
            userDropdown.classList.add('hidden');
        }
    });

    sidebarBackdrop?.addEventListener('click', closeMobileSidebar);
    mobileSidebarLinks.forEach((link) => link.addEventListener('click', closeMobileSidebar));
    desktopMedia.addEventListener('change', () => {
        if (isDesktop()) {
            closeMobileSidebar();
        }
    });

    syncArrow();
});
