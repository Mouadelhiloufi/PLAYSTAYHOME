<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - playstayhome</title>
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
                <a href="/admin/dashboard" class="bg-primary text-white px-5 py-3.5 rounded-xl font-bold text-sm flex items-center shadow-[0_4px_15px_rgba(25,120,229,0.2)]">
                    <span data-i18n="admin.dashboard">Dashboard</span>
                </a>
                <a href="/admin/reservations" class="text-gray-500 hover:text-gray-900 hover:bg-gray-50 px-5 py-3.5 rounded-xl font-bold text-sm transition-colors">
                    <span data-i18n="admin.reservations">Réservations</span>
                </a>
                <a href="/admin/users" class="text-gray-500 hover:text-gray-900 hover:bg-gray-50 px-5 py-3.5 rounded-xl font-bold text-sm transition-colors">
                    <span data-i18n="admin.users">Utilisateurs</span>
                </a>
                <a href="/admin/consoles-games" class="text-gray-500 hover:text-gray-900 hover:bg-gray-50 px-5 py-3.5 rounded-xl font-bold text-sm transition-colors">
                    <span data-i18n="admin.consolesGames">Consoles & Jeux</span>
                </a>
                <a href="/admin/chat" class="text-gray-500 hover:text-gray-900 hover:bg-gray-50 px-5 py-3.5 rounded-xl font-bold text-sm transition-colors">
                    <span data-i18n="admin.supportChat">Support Chat</span>
                </a>
            </nav>

            <div class="mt-7 relative">
                <button
                    type="button"
                    class="w-full inline-flex items-center justify-between gap-2 rounded-xl border border-gray-200 bg-white px-4 py-3 text-xs font-black text-gray-700 shadow-sm hover:bg-gray-50"
                    data-lang-btn
                    aria-controls="langPanelAdmin"
                    aria-expanded="false"
                    data-i18n-aria-label="lang.switch"
                >
                    <span data-i18n-lang-label>Français</span>
                    <span class="inline-flex items-center gap-2 text-gray-400">
                        <i class="fa-solid fa-globe"></i>
                        <span>▼</span>
                    </span>
                </button>
                <div id="langPanelAdmin" data-lang-panel class="hidden absolute left-0 right-0 mt-2 rounded-xl border border-gray-200 bg-white shadow-xl overflow-hidden">
                    <button type="button" class="w-full px-4 py-2.5 text-left text-sm font-semibold text-gray-700 hover:bg-gray-50" data-set-lang="fr" data-i18n="lang.fr">Français</button>
                    <button type="button" class="w-full px-4 py-2.5 text-left text-sm font-semibold text-gray-700 hover:bg-gray-50" data-set-lang="ar" data-i18n="lang.ar">العربية</button>
                </div>
            </div>
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
                    <h1 class="text-3xl md:text-5xl font-black text-gray-900 tracking-tight" data-i18n="admin.greeting">Bonjour, Admin !</h1>
                    <p class="text-gray-500 font-medium mt-3">Gérez l'ensemble des locations et le suivi de la plateforme ici.</p>
                </div>
                <div class="bg-white border border-gray-100 px-6 py-2.5 rounded-full shadow-sm text-sm font-bold text-primary flex items-center">
                    Niveau : <span class="text-gray-900 ml-1">Administrateur</span>
                </div>
            </div>

            <!-- Cartes de Statistiques -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                
                <div class="bg-white p-7 rounded-3xl shadow-[0_4px_20px_rgba(15,23,42,0.03)] border border-gray-100 transition-transform hover:-translate-y-1">
                    <h3 class="text-gray-400 text-sm font-bold mb-3">Locations en cours</h3>
                    <div class="text-3xl md:text-4xl font-black text-primary">12</div>
                </div>

                <div class="bg-white p-7 rounded-3xl shadow-[0_4px_20px_rgba(15,23,42,0.03)] border border-gray-100 transition-transform hover:-translate-y-1">
                    <h3 class="text-gray-400 text-sm font-bold mb-3">Revenus du mois</h3>
                    <div id="monthlyRevenue" class="text-3xl md:text-4xl font-black text-gray-900">0.00 <span class="text-lg ml-1 text-gray-400">DH</span></div>
                </div>

                <div class="bg-white p-7 rounded-3xl shadow-[0_4px_20px_rgba(15,23,42,0.03)] border border-gray-100 transition-transform hover:-translate-y-1">
                    <h3 class="text-gray-400 text-sm font-bold mb-3">Nouveaux Clients</h3>
                    <div class="text-3xl md:text-4xl font-black text-green-500">28</div>
                </div>

            </div>

            <!-- Tableau d'historique -->
            <div class="bg-white rounded-3xl shadow-[0_4px_20px_rgba(15,23,42,0.03)] border border-gray-100 overflow-hidden mb-16">
                
                <div class="p-7 border-b border-gray-100 flex justify-between items-center bg-white">
                    <h2 class="text-xl font-black text-gray-900">Historique des locations</h2>
                    <a href="/admin/reservations" class="text-primary text-sm font-bold hover:underline">Voir tout</a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse whitespace-nowrap">
                        <thead>
                            <tr class="bg-gray-50/50 text-[10px] uppercase tracking-widest text-gray-400 font-black">
                                <th class="py-5 px-7">Client</th>
                                <th class="py-5 px-4">Article</th>
                                <th class="py-5 px-4">Dates</th>
                                <th class="py-5 px-4">Montant</th>
                                <th class="py-5 px-7 text-right">Statut</th>
                            </tr>
                        </thead>
                        <tbody id="historyTbody" class="text-sm font-semibold text-gray-700">
                            <tr>
                                <td colspan="5" class="py-8 px-7 text-center text-gray-400">Chargement...</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <!-- Footer -->
        <footer class="px-10 py-10 border-t border-gray-200 bg-white">
            <div class="max-w-6xl mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8 md:gap-4 lg:ml-20">
                    <div class="col-span-1">
                        <h4 class="font-black text-gray-900 mb-4">PLAYSTAYHOME</h4>
                        <p class="text-xs text-gray-500 leading-relaxed max-w-[200px]">Making homes smarter, safer, and more comfortable with cutting-edge technology.</p>
                    </div>
                    <div class="col-span-1">
                        <h4 class="font-bold text-gray-900 mb-4">Product</h4>
                        <ul class="text-xs text-gray-500 space-y-3 font-medium">
                            <li><a href="#" class="hover:text-primary transition-colors">Consoles</a></li>
                            <li><a href="#" class="hover:text-primary transition-colors">Accessoires</a></li>
                            <li><a href="#" class="hover:text-primary transition-colors">Jeux-vidéos</a></li>
                        </ul>
                    </div>
                    <div class="col-span-1">
                        <h4 class="font-bold text-gray-900 mb-4">Company</h4>
                        <ul class="text-xs text-gray-500 space-y-3 font-medium">
                            <li><a href="#" class="hover:text-primary transition-colors">About Us</a></li>
                            <li><a href="#" class="hover:text-primary transition-colors">Careers</a></li>
                            <li><a href="#" class="hover:text-primary transition-colors">Privacy Policy</a></li>
                        </ul>
                    </div>
                    <div class="col-span-1">
                        <h4 class="font-bold text-gray-900 mb-4">Follow Us</h4>
                        <div class="flex gap-3">
                            <a href="#" class="w-8 h-8 rounded-full bg-gray-50 flex items-center justify-center text-gray-500 hover:bg-primary hover:text-white transition-colors"><i class="fa-solid fa-share-nodes"></i></a>
                            <a href="#" class="w-8 h-8 rounded-full bg-gray-50 flex items-center justify-center text-gray-500 hover:bg-primary hover:text-white transition-colors"><i class="fa-solid fa-globe"></i></a>
                        </div>
                    </div>
                </div>
                <div class="text-center text-[10px] font-bold text-gray-300 mt-16 uppercase tracking-widest pt-8 border-t border-gray-100">
                    © 2026 <strong>PLAYSTAYHOME</strong>. All rights reserved.
                </div>
            </div>
        </footer>

    </main>

    <script>
        // Logique de base pour vérifier si l'admin est bien connecté (à adapter avec ton token)
        document.addEventListener('DOMContentLoaded', async () => {
            const token = localStorage.getItem('token');
            if(!token) {
                window.location.href = '/login';
            }

            let logoutBtn=document.getElementById("logoutBtn");
            logoutBtn.addEventListener('click',async()=>{
                try {
                        await fetch('/api/logout', {
                            method: 'POST',
                            headers: { 'Authorization': 'Bearer ' + token, 'Accept': 'application/json' }
                        });
                    } catch(e) {}
                    localStorage.removeItem('token');
                    window.location.href = '/login';
            })
            
            const historyTbody = document.getElementById('historyTbody');
            const monthlyRevenue = document.getElementById('monthlyRevenue');

            function normalizeStatus(reservation) {
                const rawStatus = String(reservation?.status || '').toLowerCase();
                if (rawStatus === 'active') return 'pending';
                if (rawStatus === 'completed') return 'accepted';
                if (rawStatus === 'cancelled') return 'refused';
                if (['pending', 'accepted', 'refused'].includes(rawStatus)) return rawStatus;
                return 'pending';
            }

            function getStatusBadge(status) {
                if (status === 'accepted') {
                    return '<span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider border border-green-200 inline-block">Réservation confirmée</span>';
                }

                if (status === 'refused') {
                    return '<span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider border border-red-200 inline-block">Réservation refusée</span>';
                }

                return '<span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider border border-yellow-200 inline-block">En attente de confirmation</span>';
            }

            try {
                const revenueResponse = await fetch('/api/admin/stats/monthly-revenue', {
                    headers: { 'Authorization': 'Bearer ' + token, 'Accept': 'application/json' }
                });

                if (revenueResponse.ok) {
                    const revenuePayload = await revenueResponse.json();
                    const revenue = Number(revenuePayload?.data?.monthly_revenue || 0);
                    monthlyRevenue.innerHTML = `${revenue.toFixed(2)} <span class="text-lg ml-1 text-gray-400">DH</span>`;
                }

                const response = await fetch('/api/reservations', {
                    headers: { 'Authorization': 'Bearer ' + token, 'Accept': 'application/json' }
                });

                if (!response.ok) throw new Error('Erreur API reservations');

                const payload = await response.json();
                const reservations = Array.isArray(payload.data) ? payload.data : [];
                const latest = reservations.slice(0, 6);
                if (!latest.length) {
                    historyTbody.innerHTML = '<tr><td colspan="5" class="py-8 px-7 text-center text-gray-400">Aucune reservation trouvee.</td></tr>';
                    return;
                }

                let rows = '';
                for (const r of latest) {
                    const clientName = r.user?.name || 'Client inconnu';
                    const firstLetter = clientName.charAt(0).toUpperCase();
                    const consoleName = r.console?.name || 'Console inconnue';

                    const start = new Date(r.start_date);
                    const end = new Date(r.end_date);
                    const startText = Number.isNaN(start.getTime()) ? '--' : start.toLocaleDateString('fr-FR', { day: '2-digit', month: 'short', year: 'numeric' });
                    const endText = Number.isNaN(end.getTime()) ? '--' : end.toLocaleDateString('fr-FR', { day: '2-digit', month: 'short', year: 'numeric' });
                    const statusBadge = getStatusBadge(normalizeStatus(r));

                    rows += `
                        <tr class="border-b border-gray-50 hover:bg-gray-50/30 transition-colors">
                            <td class="py-5 px-7">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-sm shrink-0">${firstLetter}</div>
                                    <span>${clientName}</span>
                                </div>
                            </td>
                            <td class="py-5 px-4 text-gray-900 font-bold">${consoleName}</td>
                            <td class="py-5 px-4 text-gray-500">${startText} - ${endText}</td>
                            <td class="py-5 px-4 font-black text-gray-900">${Number(r.total_price || 0).toFixed(2)} DH</td>
                            <td class="py-5 px-7 text-right">${statusBadge}</td>
                        </tr>
                    `;
                }

                historyTbody.innerHTML = rows;
            } catch (error) {
                console.error('Erreur chargement dashboard reservations:', error);
                historyTbody.innerHTML = '<tr><td colspan="5" class="py-8 px-7 text-center text-red-400">Impossible de charger l historique.</td></tr>';
            }
        });
    </script>
</body>
</html>
