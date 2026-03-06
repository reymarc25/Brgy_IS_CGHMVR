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

    const syncArrow = () => {
        const isCollapsed = document.body.classList.contains('sidebar-collapsed');
        if (sidebarArrowIcon) {
            sidebarArrowIcon.style.transform = isCollapsed ? 'rotate(180deg)' : 'rotate(0deg)';
        }
    };

    window.toggleUserMenu = () => userDropdown?.classList.toggle('hidden');

    window.toggleSidebar = () => {
        const isDesktop = window.matchMedia('(min-width: 1024px)').matches;
        if (isDesktop) {
            document.body.classList.toggle('sidebar-collapsed');
            sidebarBackdrop?.classList.add('hidden');
            syncArrow();
            return;
        }

        sidebar?.classList.toggle('-translate-x-full');
        sidebarBackdrop?.classList.toggle('hidden');
    };

    document.addEventListener('click', (e) => {
        if (userMenu && userDropdown && !userMenu.contains(e.target)) {
            userDropdown.classList.add('hidden');
        }
    });

    sidebarBackdrop?.addEventListener('click', () => {
        sidebar?.classList.add('-translate-x-full');
        sidebarBackdrop?.classList.add('hidden');
    });

    syncArrow();
});
