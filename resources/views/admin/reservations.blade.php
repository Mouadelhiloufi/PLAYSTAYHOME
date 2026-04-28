<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservations - Admin playstayhome</title>
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

    <aside class="w-[260px] bg-white border-r border-gray-100 flex flex-col justify-between py-8 px-6 shrink-0 fixed h-full z-10">
        <div>
            <div class="flex items-center gap-2 px-2 mb-12 text-primary">
            <a href="/" class="flex items-center gap-3 text-primary" aria-label="PLAYSTAYHOME">
                <span class="h-12 flex items-center overflow-visible">
                    <img src="{{ asset('images/site-logo-navbar.png') }}" alt="PLAYSTAYHOME" class="h-28 w-auto object-contain -my-2">
                </span>
                <span class="font-black text-xl tracking-tight">PLAYSTAYHOME</span>
            </a>
        </div>

            <nav class="flex flex-col gap-2">
                <a href="/admin/dashboard" class="text-gray-500 hover:text-gray-900 hover:bg-gray-50 px-5 py-3.5 rounded-xl font-bold text-sm transition-colors">
                    Dashboard
                </a>
                <a href="/admin/reservations" class="bg-primary text-white px-5 py-3.5 rounded-xl font-bold text-sm flex items-center shadow-[0_4px_15px_rgba(25,120,229,0.2)]">
                    Réservations
                </a>
                <a href="/admin/users" class="text-gray-500 hover:text-gray-900 hover:bg-gray-50 px-5 py-3.5 rounded-xl font-bold text-sm transition-colors">
                    Utilisateurs
                </a>
                <a href="/admin/consoles-games" class="text-gray-500 hover:text-gray-900 hover:bg-gray-50 px-5 py-3.5 rounded-xl font-bold text-sm transition-colors">
                    Consoles & Jeux
                </a>
                <a href="/admin/chat" class="text-gray-500 hover:text-gray-900 hover:bg-gray-50 px-5 py-3.5 rounded-xl font-bold text-sm transition-colors">
                    Support Chat
                </a>
            </nav>
        </div>

        <div class="border-t border-gray-100 pt-6 mt-10">
            <button id="logoutBtn" class="text-red-500 hover:text-red-600 hover:bg-red-50 px-5 py-3.5 rounded-xl font-black text-sm transition-colors flex items-center">
                Déconnexion
            </button>
        </div>
    </aside>

    <main class="flex-1 ml-[260px] flex flex-col min-h-screen">
        <div class="p-10 flex-1 max-w-6xl mx-auto w-full">
            <div class="flex justify-between items-start mb-10">
                <div>
                    <h1 class="text-3xl md:text-4xl font-black text-gray-900 tracking-tight">Gestion des Réservations</h1>
                    <p class="text-gray-500 font-medium mt-3">Liste simple des réservations de la plateforme.</p>
                </div>
            </div>

            <div class="bg-white rounded-3xl shadow-[0_4px_20px_rgba(15,23,42,0.03)] border border-gray-100 overflow-hidden">
                <div class="p-7 border-b border-gray-100 flex justify-between items-center bg-white">
                    <h2 class="text-xl font-black text-gray-900">Réservations (<span id="reservationCount">0</span>)</h2>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse whitespace-nowrap">
                        <thead>
                            <tr class="bg-gray-50/50 text-[10px] uppercase tracking-widest text-gray-400 font-black">
                                <th class="py-5 px-7">Client</th>
                                <th class="py-5 px-4">Console</th>
                                <th class="py-5 px-4">Période</th>
                                <th class="py-5 px-4">Prix total</th>
                                <th class="py-5 px-7 text-right">Statut</th>
                            </tr>
                        </thead>
                        <tbody id="reservationsTbody" class="text-sm font-semibold text-gray-700">
                            <tr>
                                <td colspan="5" class="py-8 px-7 text-center text-gray-400">Chargement...</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', async () => {
            const token = localStorage.getItem('token');
            if (!token) {
                window.location.href = '/login';
                return;
            }

            const logoutBtn = document.getElementById('logoutBtn');
            if (logoutBtn) {
                logoutBtn.addEventListener('click', async () => {
                    try {
                        await fetch('/api/logout', {
                            method: 'POST',
                            headers: {
                                'Authorization': 'Bearer ' + token,
                                'Accept': 'application/json'
                            }
                        });
                    } catch (e) {}

                    localStorage.removeItem('token');
                    window.location.href = '/login';
                });
            }

            function normalizeDate(dateString) {
                const date = new Date(dateString);
                if (Number.isNaN(date.getTime())) return null;
                date.setHours(0, 0, 0, 0);
                return date;
            }

            function getStatusBadgeFromDates(startDate, endDate) {
                const today = new Date();
                today.setHours(0, 0, 0, 0);

                const start = normalizeDate(startDate);
                const end = normalizeDate(endDate);

                if (!start || !end) {
                    return '<span class="bg-yellow-100/50 text-yellow-700 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider border border-yellow-200/50 inline-block">En attente</span>';
                }

                if (end < today) {
                    return '<span class="bg-gray-100 text-gray-500 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider border border-gray-200 inline-block">Terminée</span>';
                }

                if (today >= start && today <= end) {
                    return '<span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider border border-green-200 inline-block">En cours</span>';
                }

                return '<span class="bg-yellow-100/50 text-yellow-700 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider border border-yellow-200/50 inline-block">En attente</span>';
            }

            function formatDate(dateString) {
                if (!dateString) return '--';
                const date = new Date(dateString);
                if (Number.isNaN(date.getTime())) return '--';
                return date.toLocaleDateString('fr-FR', { day: '2-digit', month: 'short', year: 'numeric' });
            }

            async function fetchReservations() {
                const tbody = document.getElementById('reservationsTbody');
                const countEl = document.getElementById('reservationCount');

                try {
                    const response = await fetch('/api/reservations', {
                        headers: {
                            'Accept': 'application/json',
                            'Authorization': 'Bearer ' + token
                        }
                    });

                    if (!response.ok) {
                        throw new Error('Erreur API');
                    }

                    const payload = await response.json();
                    const reservations = Array.isArray(payload.data) ? payload.data : [];
                    countEl.textContent = reservations.length;

                    if (!reservations.length) {
                        tbody.innerHTML = '<tr><td colspan="5" class="py-8 px-7 text-center text-gray-400">Aucune réservation trouvée.</td></tr>';
                        return;
                    }

                    let rows = '';
                    reservations.forEach((reservation) => {
                        const clientName = reservation.user?.name || 'Client inconnu';
                        const consoleName = reservation.console?.name || 'Console inconnue';
                        const period = `${formatDate(reservation.start_date)} - ${formatDate(reservation.end_date)}`;
                        const total = reservation.total_price ? `${reservation.total_price} DH` : '0 DH';
                        const statusBadge = getStatusBadgeFromDates(reservation.start_date, reservation.end_date);

                        rows += `
                            <tr class="border-b border-gray-50 hover:bg-gray-50/30 transition-colors">
                                <td class="py-5 px-7">${clientName}</td>
                                <td class="py-5 px-4 text-gray-900 font-bold">${consoleName}</td>
                                <td class="py-5 px-4 text-gray-500">${period}</td>
                                <td class="py-5 px-4 font-black text-gray-900">${total}</td>
                                <td class="py-5 px-7 text-right">${statusBadge}</td>
                            </tr>
                        `;
                    });

                    tbody.innerHTML = rows;
                } catch (error) {
                    console.error('Erreur chargement reservations:', error);
                    tbody.innerHTML = '<tr><td colspan="5" class="py-8 px-7 text-center text-red-400">Impossible de charger les réservations.</td></tr>';
                }
            }

            fetchReservations();
        });
    </script>
</body>
</html>
