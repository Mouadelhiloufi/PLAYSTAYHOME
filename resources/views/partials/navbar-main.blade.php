<header class="sticky top-0 z-50 border-b border-gray-200 bg-white">
    <div class="mx-auto flex w-full max-w-7xl items-center justify-between px-6 py-3 md:px-10">
        <div class="flex items-center gap-4 text-primary">
            <a href="/" class="flex items-center gap-4 text-primary">
                <i class="fab fa-playstation text-4xl"></i>
                <span class="text-xl font-bold tracking-tight text-gray-900">PLAYSTAYHOME</span>
            </a>
        </div>

        <div class="flex flex-1 items-center justify-end gap-8">
            <nav class="hidden items-center gap-9 md:flex">
                    <a href="/" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
                    <a href="/catalogue" class="nav-link {{ request()->routeIs('catalogue') ? 'active' : '' }}">Catalogue</a>
                    <a href="/contact" class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">Contact Us</a>
                    <a href="/faq" class="nav-link {{ request()->routeIs('faq') ? 'active' : '' }}">FAQ</a>
                <!-- <a href="/reservation" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">reservation</a>
                <a href="/profile" class="nav-link {{ request()->routeIs('catalogue') ? 'active' : '' }}">profile</a>
                <a href="/chat" class="nav-link {{ request()->routeIs('catalogue') ? 'active' : '' }}">Chat</a>
                 -->

                <!-- Liens visibles uniquement pour les invités (non connectés) -->
                <div id="nav-guest-links" class="flex items-center gap-9">
                    <a href="/register" class="nav-link {{ request()->routeIs('register') ? 'active' : '' }}">Sign Up</a>
                    <a href="/login" class="nav-link {{ request()->routeIs('login') ? 'active' : '' }}">Sign In</a>
                </div>

                  <!-- Liens visibles uniquement pour les utilisateurs connectés -->
                  <div id="nav-auth-links" class="hidden items-center gap-6">

                      <!-- Notifications -->
                      <div class="relative">
                          <button id="navNotificationsBtn" type="button" class="hidden md:flex items-center justify-center h-9 w-9 rounded-full bg-yellow-50 text-yellow-600 hover:bg-yellow-100 transition-colors border border-yellow-100 shadow-sm relative" title="Notifications">
                              <i class="fa-regular fa-bell"></i>
                          </button>
                          <div id="navNotificationsPanel" class="hidden absolute right-0 mt-3 w-72 bg-white border border-gray-200 rounded-xl shadow-lg overflow-hidden">
                              <div class="px-4 py-2 text-xs font-bold text-gray-500 uppercase tracking-wider">Notifications</div>
                              <div id="navNotificationsList" class="max-h-64 overflow-y-auto text-sm"></div>
                          </div>
                      </div>
                      
                      <!-- Bouton Chat (Client) -->
                      <a href="/chat" class="hidden md:flex items-center justify-center h-9 w-9 rounded-full bg-blue-50 text-primary hover:bg-primary hover:text-white transition-colors border border-blue-100 shadow-sm relative group" title="Support Client">
                          <i class="fa-regular fa-comment-dots"></i>
                          <!-- Notification badge (Optionnel visuellement) -->
                          <span class="absolute 0 top-0 right-0 h-2.5 w-2.5 bg-red-500 rounded-full border-2 border-white"></span>
                      </a>

                    <a href="/mon-compte" class="flex items-center gap-2 nav-link" id="navProfileLink">
                        <!-- L'image remplacera le texte si elle existe -->
                        <div id="navProfileAvatar" class="h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center text-primary font-bold overflow-hidden shadow-sm border border-blue-200">
                            <i class="fa-regular fa-user text-sm"></i>
                        </div>
                        <span id="navProfileName" class="text-sm font-medium">Profile</span>
                    </a>
                    
                </div>
            </nav>
        </div>
    </div>
</header>

<script>
    // Comme l'authentification se fait via API (token dans localStorage), 
    // on gère l'affichage de la navbar avec une fonction immédiate.
    function initNavbar() {
        const token = localStorage.getItem('token');
        const guestLinks = document.getElementById('nav-guest-links');
        const authLinks = document.getElementById('nav-auth-links');
        const logoutBtn = document.getElementById('navLogoutBtn');



        if (token) {
            // Utilisateur connecté
            guestLinks.style.display = 'none';
            authLinks.style.display = 'flex';

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
                            
                            // Si pas de diff_human, on formatte la date classiquement
                            if (!dateText && item.created_at) {
                                const createdAt = new Date(item.created_at);
                                if (!isNaN(createdAt)) {
                                    dateText = createdAt.toLocaleDateString('fr-FR', { day: '2-digit', month: 'short', year: 'numeric' });
                                }
                            }

                            const date = document.createElement('p');
                            date.className = 'text-[11px] text-primary font-medium mt-1.5 flex items-center gap-1';
                            // Affiche l'icône statique et le texte retourné par le backend
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

            // On peut chercher les infos user pour remplacer l'avatar
            fetch('/api/user', {
                headers: {
                    'Authorization': 'Bearer ' + token,
                    'Accept': 'application/json'
                }
            })
            .then(res => res.json())
            .then(user => {
                if(user && user.name) {
                    const avatar = document.getElementById('navProfileAvatar');
                    const name = document.getElementById('navProfileName');
                    
                    // Cacher le texte 'Profile'
                    name.classList.add('hidden');
                    
                    // Mettre la photo ou l'initiale
                    if (user.photo_url) {
                        avatar.innerHTML = `<img src="${user.photo_url}" alt="${user.name}" class="h-full w-full object-cover">`;
                    } else {
                        // S'il n'a pas de photo on affiche sa première lettre
                        avatar.innerHTML = `<span class="text-sm font-black uppercase text-primary">${user.name.charAt(0)}</span>`;
                    }
                }
            })
            .catch(err => console.error("Erreur chargement profile:", err));
            
        } else {
            // Utilisateur déconnecté
            guestLinks.style.display = 'flex';
            authLinks.style.display = 'none';
        }

        // Gérer la déconnexion
        if (logoutBtn) {
            logoutBtn.addEventListener('click', async (e) => {
                e.preventDefault();
                
                // Optionnel : appeler l'API de logout pour invalider le token côté serveur
                try {
                    await fetch('/api/logout', {
                        method: 'POST',
                        headers: {
                            'Authorization': 'Bearer ' + token,
                            'Accept': 'application/json'
                        }
                    });
                } catch(err) {
                    console.error('Erreur lors du logout API', err);
                }

                // Supprimer le token du navigateur
                localStorage.removeItem('token');
                
                // Rediriger vers l'accueil ou le login
                window.location.href = '/login';
            });
        }
    }

    // Exécuter la fonction de vérification tout de suite
    initNavbar();
</script>
