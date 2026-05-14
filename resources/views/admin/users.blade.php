<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Utilisateurs - Admin playstayhome</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#1978e5',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Inter', sans-serif; background: #f8fafc; color: #111827; }
    </style>
</head>
<body class="flex min-h-screen">

    <!-- Sidebar / Menu Latéral -->
    <aside class="w-[260px] bg-white border-r border-gray-100 flex flex-col justify-between py-8 px-6 shrink-0 fixed h-full z-10">
        <div>
            <!-- Logo -->
            <div class="flex items-center gap-4 text-primary mb-9">
            <a href="/" class="flex items-center gap-3 text-primary" aria-label="PLAYSTAYHOME">
                <span class="h-12 flex items-center overflow-visible">
                    <img src="{{ asset('images/site-logo-navbar.png') }}" alt="PLAYSTAYHOME" class="h-16 w-auto object-contain -my-2">
                </span>
                <span class="font-black text-xl tracking-tight">PLAYSTAYHOME</span>
            </a>
        </div>
            
            <!-- Navigation -->
            <nav class="flex flex-col gap-2">
                <a href="/admin/dashboard" class="text-gray-500 hover:text-gray-900 hover:bg-gray-50 px-5 py-3.5 rounded-xl font-bold text-sm transition-colors">
                    <span data-i18n="admin.dashboard">Dashboard</span>
                </a>
                <a href="/admin/reservations" class="text-gray-500 hover:text-gray-900 hover:bg-gray-50 px-5 py-3.5 rounded-xl font-bold text-sm transition-colors">
                    <span data-i18n="admin.reservations">Réservations</span>
                </a>
                <a href="/admin/users" class="bg-primary text-white px-5 py-3.5 rounded-xl font-bold text-sm flex items-center shadow-[0_4px_15px_rgba(25,120,229,0.2)]">
                    <span data-i18n="admin.users">Utilisateurs</span>
                </a>
                <a href="/admin/consoles-games" class="text-gray-500 hover:text-gray-900 hover:bg-gray-50 px-5 py-3.5 rounded-xl font-bold text-sm transition-colors">
                    <span data-i18n="admin.consolesGames">Consoles & Jeux</span>
                </a>
                <a href="/admin/chat" class="text-gray-500 hover:text-gray-900 hover:bg-gray-50 px-5 py-3.5 rounded-xl font-bold text-sm transition-colors">
                    <span data-i18n="admin.supportChat">Support Chat</span>
                </a>
            </nav>

        </div>
        
        <!-- Déconnexion -->
        <div class="border-t border-gray-100 pt-6 mt-10">
            <button id="logoutBtn" class="text-red-500 hover:text-red-600 hover:bg-red-50 px-5 py-3.5 rounded-xl font-black text-sm transition-colors flex items-center">
                <span data-i18n="admin.logout">Déconnexion</span>
            </button>
        </div>
    </aside>

    <!-- Contenu Principal -->
    <main class="flex-1 ml-[260px] flex flex-col min-h-screen">
        
        <div class="p-10 flex-1 max-w-6xl mx-auto w-full">
            
            <!-- Top Header -->
            <div class="flex justify-between items-start mb-10">
                <div>
                    <h1 class="text-3xl md:text-4xl font-black text-gray-900 tracking-tight">Gestion des Utilisateurs</h1>
                    <p class="text-gray-500 font-medium mt-3">Consultez tous vos membres, leurs statuts et contactez-les directement.</p>
                </div>
                <div class="relative">
                    <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    <input type="text" id="searchInput" placeholder="Rechercher un utilisateur..." class="w-64 bg-white border border-gray-200 text-gray-900 rounded-full pl-10 pr-4 py-2.5 text-sm font-medium focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary shadow-sm">
                </div>
            </div>

            <!-- Tableau des utilisateurs -->
            <div class="bg-white rounded-3xl shadow-[0_4px_20px_rgba(15,23,42,0.03)] border border-gray-100 overflow-hidden mb-16">
                
                <div class="p-7 border-b border-gray-100 flex justify-between items-center bg-white">
                    <h2 class="text-xl font-black text-gray-900">Liste des membres (<span id="userCount">0</span>)</h2>
                    <button class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-xl text-sm font-bold transition-colors">
                        <i class="fa-solid fa-filter mr-2"></i> Filtrer
                    </button>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse whitespace-nowrap" id="usersTable">
                        <thead>
                            <tr class="bg-gray-50/50 text-[10px] uppercase tracking-widest text-gray-400 font-black">
                                <th class="py-5 px-7">Utilisateur</th>
                                <th class="py-5 px-4">Contact</th>
                                <th class="py-5 px-4">Rôle</th>
                                <th class="py-5 px-4">Inscription</th>
                                <th class="py-5 px-7 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="usersTbody" class="text-sm font-semibold text-gray-700">
                            <!-- Les utilisateurs seront injectés ici par JS -->
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </main>

    <script>
        document.addEventListener('DOMContentLoaded', async () => {
            const token = localStorage.getItem('token');
            if(!token) window.location.href = '/login';

            // Logique de déconnexion identique au dashboard
            let logoutBtn = document.getElementById("logoutBtn");
            logoutBtn.addEventListener('click', async () => {
                try {
                    await fetch('/api/logout', {
                        method: 'POST',
                        headers: { 'Authorization': 'Bearer ' + token, 'Accept': 'application/json' }
                    });
                } catch (e) {}
                localStorage.removeItem('token');
                window.location.href = '/login';
            });

            async function fetchUsers() {
                try {
                    let response = await fetch('/api/users', {
                        headers: {
                            'Accept': 'application/json',
                            'Authorization': 'Bearer ' + token
                        }
                    });

                    if (response.ok) {
                        let users = await response.json();
                        
                        document.getElementById('userCount').textContent = users.length;
                        let usersHtml = '';

                        users.forEach(user => {
                            // Déterminer la puce (badge) en fonction du rôle
                            let roleBadge = '';
                            if (user.role === 'admin') {
                                roleBadge = '<span class="bg-green-50 text-green-600 px-3 py-1 rounded-full text-xs font-bold border border-green-100"><i class="fa-solid fa-shield-halved mr-1 text-[10px]"></i> Admin</span>';
                            } else {
                                roleBadge = '<span class="bg-gray-100 text-gray-600 px-3 py-1 rounded-full text-xs font-bold border border-gray-200">Client</span>';
                            }

                            // Gérer la photo de profil (Avatar UI ou vraie photo)
                            let avatarUrl = user.photo_url 
                                ? user.photo_url 
                                : `https://ui-avatars.com/api/?name=${encodeURIComponent(user.name)}&background=f3f4f6&color=4b5563`;

                            // Formater la date d'inscription
                            let dateObj = new Date(user.created_at);
                            let joinDate = dateObj.toLocaleDateString('fr-FR', { day: '2-digit', month: 'long', year: 'numeric' });

                            // Boutons d'action (Si admin, on n'affiche pas l'icône de chat)
                            let actionsHtml = '';
                            if (user.role === 'admin') {
                                actionsHtml = '<span class="text-xs font-bold text-gray-300 italic">Compte Admin</span>';
                            } else {
                                actionsHtml = `
                                    <div class="flex items-center justify-end gap-2">
                                        <button title="Voir profil" class="w-9 h-9 rounded-xl bg-gray-50 hover:bg-gray-100 text-gray-500 hover:text-gray-900 flex items-center justify-center transition-colors">
                                            <i class="fa-solid fa-eye"></i>
                                        </button>
                                        <a href="/admin/chat?user=${user.id}" title="Discuter" class="w-9 h-9 rounded-xl bg-blue-50 hover:bg-primary text-primary hover:text-white flex items-center justify-center transition-colors shadow-sm">
                                            <i class="fa-solid fa-comment-dots"></i>
                                        </a>
                                    </div>`;
                            }

                            usersHtml += `
                            <tr class="border-b border-gray-50 hover:bg-gray-50/30 transition-colors">
                                <td class="py-5 px-7">
                                    <div class="flex items-center gap-3">
                                        <img src="${avatarUrl}" class="w-10 h-10 rounded-full object-cover shrink-0 border border-gray-100 shadow-sm" alt="Avatar">
                                        <div>
                                            <p class="text-gray-900 font-bold">${user.name}</p>
                                            <p class="text-xs text-gray-400 font-medium">#USR-${String(user.id).padStart(4, '0')}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-5 px-4">
                                    <p class="text-gray-700">${user.email}</p>
                                </td>
                                <td class="py-5 px-4 text-gray-500">
                                    ${roleBadge}
                                </td>
                                <td class="py-5 px-4 text-gray-500 text-sm">
                                    ${joinDate}
                                </td>
                                <td class="py-5 px-7 text-right">
                                    ${actionsHtml}
                                </td>
                            </tr>`;
                        });

                        document.getElementById('usersTbody').innerHTML = usersHtml;
                    }
                } catch (error) {
                    console.error("Erreur chargement utilisateurs:", error);
                }
            }

            fetchUsers();
        });
    </script>
</body>
</html>
