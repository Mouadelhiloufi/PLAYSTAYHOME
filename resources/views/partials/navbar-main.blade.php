@include('partials.nav-burger-styles')
<header class="sticky top-0 z-50 border-b border-gray-200 bg-white">
    <div class="mx-auto flex w-full max-w-7xl items-center justify-between gap-3 px-4 py-3 sm:px-6 lg:px-10">
        <div class="flex min-w-0 flex-1 items-center gap-2 text-primary sm:gap-4">
            <a href="/" class="flex min-w-0 items-center gap-2 text-primary sm:gap-3" aria-label="PLAYSTAYHOME">
                <span class="flex h-12 shrink-0 items-center overflow-visible">
                    <img src="{{ asset('images/site-logo-navbar.png') }}" alt="" class="h-16 w-auto object-contain -my-2" width="120" height="48">
                </span>
                <span class="truncate text-lg font-bold tracking-tight text-gray-900 sm:text-xl">PLAYSTAYHOME</span>
            </a>
        </div>

        <div class="flex shrink-0 items-center justify-end gap-3 lg:gap-8">
            <nav class="hidden items-center gap-9 lg:flex" aria-label="Navigation principale">
                <a href="/" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Accueil</a>
                <a href="/catalogue" class="nav-link {{ request()->routeIs('catalogue') ? 'active' : '' }}">Catalogue</a>
                <a href="/contact" class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a>
                <a href="/faq" class="nav-link {{ request()->routeIs('faq') ? 'active' : '' }}">FAQ</a>

                <div id="nav-guest-links" class="flex items-center gap-9">
                    <a href="/register" class="nav-link {{ request()->routeIs('register') ? 'active' : '' }}">Créer un compte</a>
                    <a href="/login" class="nav-link {{ request()->routeIs('login') ? 'active' : '' }}">Connexion</a>
                </div>

                <div id="nav-auth-links" class="hidden items-center gap-6">
                    <div class="relative">
                        <button id="navNotificationsBtn" type="button" class="hidden lg:flex items-center justify-center h-9 w-9 rounded-full bg-yellow-50 text-yellow-600 hover:bg-yellow-100 transition-colors border border-yellow-100 shadow-sm relative" title="Notifications">
                            <i class="fa-regular fa-bell"></i>
                        </button>
                        <div id="navNotificationsPanel" class="hidden absolute right-0 mt-3 w-72 bg-white border border-gray-200 rounded-xl shadow-lg overflow-hidden">
                            <div class="px-4 py-2 text-xs font-bold text-gray-500 uppercase tracking-wider">Notifications</div>
                            <div id="navNotificationsList" class="max-h-64 overflow-y-auto text-sm"></div>
                        </div>
                    </div>

                    <a href="/chat" class="hidden lg:flex items-center justify-center h-9 w-9 rounded-full bg-blue-50 text-primary hover:bg-primary hover:text-white transition-colors border border-blue-100 shadow-sm relative group" title="Support Client">
                        <i class="fa-regular fa-comment-dots"></i>
                    </a>

                    <a href="/mon-compte" class="flex items-center gap-2 nav-link" id="navProfileLink">
                        <div id="navProfileAvatar" class="h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center text-primary font-bold overflow-hidden shadow-sm border border-blue-200">
                            <i class="fa-regular fa-user text-sm"></i>
                        </div>
                        <span id="navProfileName" class="text-sm font-medium">Profil</span>
                    </a>
                </div>
            </nav>

            <div class="relative lg:hidden">
                <button
                    id="mobileMenuBtn"
                    type="button"
                    class="auth-burger-toggle"
                    aria-expanded="false"
                    aria-controls="mobileMenuPanel"
                    aria-label="Ouvrir le menu"
                >
                    <span class="auth-burger-bar auth-burger-top" aria-hidden="true"></span>
                    <span class="auth-burger-bar auth-burger-mid" aria-hidden="true"></span>
                    <span class="auth-burger-bar auth-burger-bot" aria-hidden="true"></span>
                </button>
                <div
                    id="mobileMenuPanel"
                    class="absolute right-0 top-full z-50 mt-2 hidden min-w-[16.5rem] max-w-[calc(100vw-2rem)] rounded-xl border border-gray-200 bg-white py-2 shadow-xl ring-1 ring-black/5"
                    role="menu"
                    aria-label="Menu mobile"
                >
                    <a role="menuitem" href="/" class="block px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-primary {{ request()->routeIs('home') ? 'bg-blue-50 text-primary' : '' }}">Accueil</a>
                    <a role="menuitem" href="/catalogue" class="block px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-primary {{ request()->routeIs('catalogue') ? 'bg-blue-50 text-primary' : '' }}">Catalogue</a>
                    <a role="menuitem" href="/contact" class="block px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-primary {{ request()->routeIs('contact') ? 'bg-blue-50 text-primary' : '' }}">Contact</a>
                    <a role="menuitem" href="/faq" class="block px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-primary {{ request()->routeIs('faq') ? 'bg-blue-50 text-primary' : '' }}">FAQ</a>

                    <div id="mobile-guest-links" class="flex flex-col border-t border-gray-100">
                        <a role="menuitem" href="/register" class="block px-4 py-2.5 text-sm font-semibold text-primary hover:bg-blue-50">Créer un compte</a>
                        <a role="menuitem" href="/login" class="block px-4 py-2.5 text-sm font-semibold text-primary hover:bg-blue-50">Connexion</a>
                    </div>

                    <div id="mobile-auth-links" class="hidden flex-col border-t border-gray-100">
                        <a role="menuitem" href="/chat" class="block px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-primary">Support Chat</a>
                        <a role="menuitem" href="/mon-compte" class="block px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-primary">Mon Compte</a>
                        <button id="mobileLogoutBtn" type="button" role="menuitem" class="w-full text-left block px-4 py-2.5 text-sm font-semibold text-red-600 hover:bg-red-50">Déconnexion</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<script>
    function initNavbar() {
        const token = localStorage.getItem('token');

        if (token && localStorage.getItem('role') === 'admin') {
            window.location.replace('/admin/dashboard');
            return;
        }
        const guestLinks = document.getElementById('nav-guest-links');
        const authLinks = document.getElementById('nav-auth-links');
        const logoutBtn = document.getElementById('navLogoutBtn');
        const mobileGuestLinks = document.getElementById('mobile-guest-links');
        const mobileAuthLinks = document.getElementById('mobile-auth-links');
        const mobileLogoutBtn = document.getElementById('mobileLogoutBtn');
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const mobileMenuPanel = document.getElementById('mobileMenuPanel');

        if (mobileMenuBtn && mobileMenuPanel) {
            function setMobileMenuOpen(open) {
                mobileMenuBtn.setAttribute('aria-expanded', open ? 'true' : 'false');
                mobileMenuBtn.setAttribute('aria-label', open ? 'Fermer le menu' : 'Ouvrir le menu');
                mobileMenuBtn.classList.toggle('is-open', open);
                mobileMenuPanel.classList.toggle('hidden', !open);
            }

            mobileMenuBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                const open = mobileMenuBtn.getAttribute('aria-expanded') === 'true';
                setMobileMenuOpen(!open);
            });

            document.addEventListener('click', () => setMobileMenuOpen(false));
            mobileMenuPanel.addEventListener('click', (e) => e.stopPropagation());
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') setMobileMenuOpen(false);
            });
        }

        if (token) {
            guestLinks.style.display = 'none';
            authLinks.style.display = 'flex';
            if (mobileGuestLinks) mobileGuestLinks.style.display = 'none';
            if (mobileAuthLinks) mobileAuthLinks.style.display = 'flex';

            const notificationsBtn = document.getElementById('navNotificationsBtn');
            const notificationsPanel = document.getElementById('navNotificationsPanel');
            const notificationsList = document.getElementById('navNotificationsList');

            if (notificationsBtn && notificationsPanel && notificationsList) {
                notificationsBtn.addEventListener('click', async () => {
                    notificationsPanel.classList.toggle('hidden');
                    if (notificationsPanel.classList.contains('hidden')) {
                        return;
                    }

                    notificationsList.innerHTML = '';

                    try {
                        const res = await fetch('/api/notifications', {
                            headers: {
                                'Authorization': 'Bearer ' + token,
                                'Accept': 'application/json'
                            }
                        });

                        const payload = await res.json();
                        const items = Array.isArray(payload.data) ? payload.data : [];

                        if (!items.length) {
                            notificationsList.innerHTML = '<div class="px-4 py-3 text-xs text-gray-400">Aucune notification.</div>';
                            return;
                        }

                        items.forEach((item) => {
                            const wrapper = document.createElement('div');
                            wrapper.className = 'px-4 py-3 border-b border-gray-100';

                            const title = document.createElement('p');
                            title.className = 'text-sm font-bold text-gray-900';
                            title.textContent = item.data?.title || 'Notification';

                            const message = document.createElement('p');
                            message.className = 'text-xs text-gray-500 mt-1';
                            message.textContent = item.data?.message || '';

                            let dateText = item.diff_human || '';

                            if (!dateText && item.created_at) {
                                const createdAt = new Date(item.created_at);
                                if (!isNaN(createdAt)) {
                                    dateText = createdAt.toLocaleDateString('fr-FR', { day: '2-digit', month: 'short', year: 'numeric' });
                                }
                            }

                            const date = document.createElement('p');
                            date.className = 'text-[11px] text-primary font-medium mt-1.5 flex items-center gap-1';
                            date.innerHTML = dateText ? `<i class="fa-regular fa-clock"></i> ${dateText}` : '';

                            wrapper.appendChild(title);
                            wrapper.appendChild(message);
                            if (dateText) {
                                wrapper.appendChild(date);
                            }
                            notificationsList.appendChild(wrapper);
                        });
                    } catch (err) {
                        console.log('erreur notifications', err);
                    }
                });
            }

            fetch('/api/user', {
                headers: {
                    'Authorization': 'Bearer ' + token,
                    'Accept': 'application/json'
                }
            })
            .then(res => res.json())
            .then(user => {
                if (user && user.role) {
                    localStorage.setItem('role', user.role);
                    if (user.role === 'admin') {
                        window.location.replace('/admin/dashboard');
                        return;
                    }
                }

                if (user && user.name) {
                    const avatar = document.getElementById('navProfileAvatar');
                    const name = document.getElementById('navProfileName');

                    name.classList.add('hidden');

                    if (user.photo_url) {
                        avatar.innerHTML = `<img src="${user.photo_url}" alt="${user.name}" class="h-full w-full object-cover">`;
                    } else {
                        avatar.innerHTML = `<span class="text-sm font-black uppercase text-primary">${user.name.charAt(0)}</span>`;
                    }
                }
            })
            .catch(err => console.error("Erreur chargement profile:", err));

        } else {
            guestLinks.style.display = 'flex';
            authLinks.style.display = 'none';
            if (mobileGuestLinks) mobileGuestLinks.style.display = 'flex';
            if (mobileAuthLinks) mobileAuthLinks.style.display = 'none';
        }

        if (logoutBtn) {
            logoutBtn.addEventListener('click', async (e) => {
                e.preventDefault();

                try {
                    await fetch('/api/logout', {
                        method: 'POST',
                        headers: {
                            'Authorization': 'Bearer ' + token,
                            'Accept': 'application/json'
                        }
                    });
                } catch (err) {
                    console.error('Erreur lors du logout API', err);
                }

                localStorage.removeItem('token');
                localStorage.removeItem('role');

                window.location.href = '/login';
            });
        }

        if (mobileLogoutBtn) {
            mobileLogoutBtn.addEventListener('click', async () => {
                try {
                    await fetch('/api/logout', {
                        method: 'POST',
                        headers: {
                            'Authorization': 'Bearer ' + token,
                            'Accept': 'application/json'
                        }
                    });
                } catch (err) {}
                localStorage.removeItem('token');
                localStorage.removeItem('role');
                window.location.href = '/login';
            });
        }
    }

    initNavbar();
</script>
