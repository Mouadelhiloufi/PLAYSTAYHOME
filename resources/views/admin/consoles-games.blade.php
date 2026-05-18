<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consoles & Jeux - Admin playstayhome</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
        body { font-family: 'Inter', sans-serif; background: #f8fafc; color: #111827; visibility: hidden; }
    </style>
</head>
<body class="flex min-h-screen">

    <!-- Sidebar / Menu Lateral -->
    <aside class="bg-white border-r border-gray-100 flex flex-col justify-between py-8 px-6 shrink-0 fixed h-full z-10" style="width:260px;">
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
                <a href="/admin/users" class="text-gray-500 hover:text-gray-900 hover:bg-gray-50 px-5 py-3.5 rounded-xl font-bold text-sm transition-colors">
                    <span data-i18n="admin.users">Utilisateurs</span>
                </a>
                <a href="/admin/consoles-games" class="bg-primary text-white px-5 py-3.5 rounded-xl font-bold text-sm flex items-center shadow-[0_4px_15px_rgba(25,120,229,0.2)]">
                    <span data-i18n="admin.consolesGames">Consoles & Jeux</span>
                </a>
                <a href="/admin/chat" class="text-gray-500 hover:text-gray-900 hover:bg-gray-50 px-5 py-3.5 rounded-xl font-bold text-sm transition-colors">
                    <span data-i18n="admin.supportChat">Support Chat</span>
                </a>
            </nav>

        </div>

        <!-- Deconnexion -->
        <div class="border-t border-gray-100 pt-6 mt-10">
            <button id="logoutBtn" class="text-red-500 hover:text-red-600 hover:bg-red-50 px-5 py-3.5 rounded-xl font-black text-sm transition-colors flex items-center">
                <span data-i18n="admin.logout">Déconnexion</span>
            </button>
        </div>
    </aside>

    <!-- Contenu Principal -->
    <main class="flex-1 flex flex-col min-h-screen" style="margin-left:260px;">
        <div class="p-10 flex-1 max-w-6xl mx-auto w-full">

            <!-- Top Header -->
            <div class="flex flex-col gap-2 mb-10">
                <h1 class="text-3xl md:text-4xl font-black text-gray-900 tracking-tight">Consoles & Jeux</h1>
                <p class="text-gray-500 font-medium">Consultez la liste et gerez les consoles et jeux disponibles.</p>
            </div>

            <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
                <!-- Colonne gauche : listes -->
                <div class="xl:col-span-2 space-y-8">
                    <!-- Consoles disponibles -->
                    <section class="bg-white rounded-3xl shadow-[0_4px_20px_rgba(15,23,42,0.03)] border border-gray-100 p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-xl font-black text-gray-900">Consoles disponibles</h2>
                            <span id="consolesCount" class="text-xs font-bold text-gray-400">0 consoles</span>
                        </div>
                        <div id="consolesGrid" class="grid grid-cols-1 md:grid-cols-2 gap-4"></div>
                    </section>

                    <!-- Gestion des manettes -->
                    <section class="bg-white rounded-3xl shadow-[0_4px_20px_rgba(15,23,42,0.03)] border border-gray-100 p-6">
                        <h3 class="text-lg font-black text-gray-900 mb-4">Créer une manette</h3>
                        <form id="formCreateManette" class="space-y-3">
                            <input id="serialManette" type="text" placeholder="Numéro de série" class="w-full rounded-xl border border-gray-200 px-4 py-2 text-sm">
                            <select id="statusManette" class="w-full rounded-xl border border-gray-200 px-4 py-2 text-sm">
                                <option value="available">Disponible</option>
                                <option value="louer">Louée</option>
                                <option value="maintenance">Maintenance</option>
                            </select>
                            <button id="btnCreateManette" type="button" class="w-full bg-primary text-white font-bold py-2.5 rounded-xl">Créer la manette</button>
                        </form>
                    </section>
                    <section class="bg-white rounded-3xl shadow-[0_4px_20px_rgba(15,23,42,0.03)] border border-gray-100 p-6">
                        <h3 class="text-lg font-black text-gray-900 mb-4">Modifier le statut d'une manette</h3>
                        <form id="formUpdateManetteStatus" class="space-y-3">
                            <select id="selectManette" size="1" class="w-full rounded-xl border border-gray-200 px-3 py-2 text-sm bg-white">
                                <option value="">Choisir une manette</option>
                            </select>
                            <select id="updateStatusManette" class="w-full rounded-xl border border-gray-200 px-4 py-2 text-sm">
                                <option value="available">Disponible</option>
                                <option value="louer">Louée</option>
                                <option value="maintenance">Maintenance</option>
                            </select>
                            <button id="btnUpdateManetteStatus" type="button" class="w-full bg-gray-900 text-white font-bold py-2.5 rounded-xl">Mettre à jour le statut</button>
                        </form>
                    </section>

                    <!-- Jeux disponibles -->
                    <section class="bg-white rounded-3xl shadow-[0_4px_20px_rgba(15,23,42,0.03)] border border-gray-100 p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-xl font-black text-gray-900">Jeux disponibles</h2>
                            <span id="gamesCount" class="text-xs font-bold text-gray-400">0 jeux</span>
                        </div>
                        <div id="gamesGrid" class="grid grid-cols-1 md:grid-cols-2 gap-4"></div>
                    </section>
                </div>

                <!-- Colonne droite : formulaires admin -->
                <div class="space-y-6">
                    <section class="bg-white rounded-3xl shadow-[0_4px_20px_rgba(15,23,42,0.03)] border border-gray-100 p-6">
                        <h3 class="text-lg font-black text-gray-900 mb-4">Creer une console</h3>
                        <form class="space-y-3">
                            <input id="nomConsole" type="text" placeholder="Nom de la console" class="w-full rounded-xl border border-gray-200 px-4 py-2 text-sm">
                            <input id="brand" type="text" placeholder="Marque" class="w-full rounded-xl border border-gray-200 px-4 py-2 text-sm">
                            <input id="daily_price" type="number" placeholder="Prix / jour" class="w-full rounded-xl border border-gray-200 px-4 py-2 text-sm">
                            <input id="image" type="text" placeholder="Image (URL)" class="w-full rounded-xl border border-gray-200 px-4 py-2 text-sm">
                            <select id="ability" class="w-full rounded-xl border border-gray-200 px-4 py-2 text-sm">
                                <option>Disponible</option>
                                <option>Reservee</option>
                                <option>Maintenance</option>
                            </select>
                            <button id="btnCreateConsole" type="button" class="w-full bg-primary text-white font-bold py-2.5 rounded-xl">Creer la console</button>
                        </form>
                    </section>

                    <section class="bg-white rounded-3xl shadow-[0_4px_20px_rgba(15,23,42,0.03)] border border-gray-100 p-6">
                        <h3 class="text-lg font-black text-gray-900 mb-4">Modifier une console</h3>
                        <form class="space-y-3">
                            <select id="editConsoleSelect" class="w-full rounded-xl border border-gray-200 px-4 py-2 text-sm">
                                <option value="">Choisir une console</option>
                            </select>
                            <input id="prixUpdate" type="number" placeholder="Nouveau prix" class="w-full rounded-xl border border-gray-200 px-4 py-2 text-sm">
                            <input id="imageUpdate" type="text" placeholder="Image (URL)" class="w-full rounded-xl border border-gray-200 px-4 py-2 text-sm">
                            <select id="abilityUpdate" class="w-full rounded-xl border border-gray-200 px-4 py-2 text-sm">
                                <option>Disponible</option>
                                <option>Reservee</option>
                                <option>Maintenance</option>
                            </select>
                            <button id="btnUpdate" type="button" class="w-full bg-gray-900 text-white font-bold py-2.5 rounded-xl">Enregistrer</button>
                        </form>
                    </section>

                    <section class="bg-white rounded-3xl shadow-[0_4px_20px_rgba(15,23,42,0.03)] border border-gray-100 p-6">
                        <h3 class="text-lg font-black text-gray-900 mb-4">Promotions par console</h3>
                        <form class="space-y-3">
                            <select id="promoConsoleSelect" class="w-full rounded-xl border border-gray-200 px-4 py-2 text-sm">
                                <option value="">Choisir une console</option>
                            </select>
                            <input id="promoPrice" type="number" min="0" step="0.01" placeholder="Prix promo / jour" class="w-full rounded-xl border border-gray-200 px-4 py-2 text-sm">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                <input id="promoStartsAt" type="date" class="w-full rounded-xl border border-gray-200 px-4 py-2 text-sm">
                                <input id="promoEndsAt" type="date" class="w-full rounded-xl border border-gray-200 px-4 py-2 text-sm">
                            </div>
                            <label class="flex items-center gap-2 text-sm text-gray-700 font-medium">
                                <input id="promoActive" type="checkbox" class="rounded border-gray-300" checked>
                                Promo active
                            </label>
                            <p class="text-xs text-gray-400 leading-relaxed">Le prix promo remplace le prix journalier de base pendant la période indiquée.</p>
                            <button id="btnSavePromo" type="button" class="w-full bg-primary text-white font-bold py-2.5 rounded-xl">Enregistrer la promo</button>
                        </form>
                    </section>

                    <section class="bg-white rounded-3xl shadow-[0_4px_20px_rgba(15,23,42,0.03)] border border-gray-100 p-6">
                        <h3 class="text-lg font-black text-gray-900 mb-4">Supprimer une console</h3>
                        <form class="space-y-3">
                            <select id="deleteConsoleSelect" class="w-full rounded-xl border border-gray-200 px-4 py-2 text-sm">
                                <option value="">Choisir une console</option>
                            </select>
                            <button id="btnDeleteConsole" type="button" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-2.5 rounded-xl">Supprimer la console</button>
                        </form>
                    </section>

                    <section class="bg-white rounded-3xl shadow-[0_4px_20px_rgba(15,23,42,0.03)] border border-gray-100 p-6">
                        <h3 class="text-lg font-black text-gray-900 mb-4">Creer un jeu</h3>
                        <form class="space-y-3">
                            <input id="gameTitle" type="text" placeholder="Nom du jeu" class="w-full rounded-xl border border-gray-200 px-4 py-2 text-sm">
                            <select id="gameGenre" class="w-full rounded-xl border border-gray-200 px-4 py-2 text-sm">
                                <option value="">Genre de game</option>
                                <option value="Racing">Racing</option>
                                <option value="Sport">Sport</option>
                                <option value="Adventure">Adventure</option>
                                <option value="Action-Adventure">Action-Adventure</option>
                                <option value="FPS">FPS</option>
                                <option value="Plateformerchange la colonne en text et la validation en max:2048 pour accepter des URLs longues.">Plateformer</option>
                            </select>
                            <input id="gameImage" type="text" placeholder="Image (URL)" class="w-full rounded-xl border border-gray-200 px-4 py-2 text-sm">
                            <button id="btnCreateGame" type="button" class="w-full bg-primary text-white font-bold py-2.5 rounded-xl">Creer le jeu</button>
                        </form>
                    </section>

                    <section class="bg-white rounded-3xl shadow-[0_4px_20px_rgba(15,23,42,0.03)] border border-gray-100 p-6">
                        <h3 class="text-lg font-black text-gray-900 mb-4">Supprimer un jeu</h3>
                        <form class="space-y-3">
                            <select id="deleteGameSelect" class="w-full rounded-xl border border-gray-200 px-4 py-2 text-sm">
                                <option value="">Choisir un jeu</option>
                            </select>
                            <button id="btnDeleteGame" type="button" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-2.5 rounded-xl">Supprimer le jeu</button>
                        </form>
                    </section>

                    <section class="bg-white rounded-3xl shadow-[0_4px_20px_rgba(15,23,42,0.03)] border border-gray-100 p-6">
                        <h3 class="text-lg font-black text-gray-900 mb-4">Ajouter des jeux a une console</h3>
                        <form class="space-y-3">
                            <select id="addConsoleSelect" class="w-full rounded-xl border border-gray-200 px-4 py-2 text-sm">
                                <option value="">Choisir une console</option>
                            </select>
                            <div id="consoleGamesCheckboxes" class="space-y-2 text-sm text-gray-700"></div>
                            <button id="btnAttachGames" type="button" class="w-full bg-gray-900 text-white font-bold py-2.5 rounded-xl">Associer les jeux</button>
                        </form>
                    </section>

                    <section class="bg-white rounded-3xl shadow-[0_4px_20px_rgba(15,23,42,0.03)] border border-gray-100 p-6">
                        <h3 class="text-lg font-black text-gray-900 mb-4">Ajouter un coupon</h3>
                        <form id="formCreateCoupon" class="space-y-3">
                            <input id="couponCode" type="text" placeholder="Code coupon (ex: WELCOME10)" class="w-full rounded-xl border border-gray-200 px-4 py-2 text-sm">
                            <input id="couponValue" type="number" min="0" step="0.01" placeholder="Valeur réduction (ex: 10)" class="w-full rounded-xl border border-gray-200 px-4 py-2 text-sm">
                            <input id="couponExpirationDate" type="date" class="w-full rounded-xl border border-gray-200 px-4 py-2 text-sm">
                            <input id="couponLimit" type="number" min="1" step="1" placeholder="Limite d'utilisation (ex: 100)" class="w-full rounded-xl border border-gray-200 px-4 py-2 text-sm">
                            <label class="flex items-center gap-2 text-sm text-gray-700 font-medium">
                                <input id="couponIsActive" type="checkbox" class="rounded border-gray-300" checked>
                                Coupon actif
                            </label>
                            <button id="btnCreateCoupon" type="button" class="w-full bg-primary text-white font-bold py-2.5 rounded-xl">Créer le coupon</button>
                        </form>
                    </section>

                    <section class="bg-white rounded-3xl shadow-[0_4px_20px_rgba(15,23,42,0.03)] border border-gray-100 p-6">
                        <h3 class="text-lg font-black text-gray-900 mb-4">Supprimer un coupon</h3>
                        <form id="formDeleteCoupon" class="space-y-3">
                            <select id="deleteCouponSelect" class="w-full rounded-xl border border-gray-200 px-4 py-2 text-sm">
                                <option value="">Choisir un coupon</option>
                            </select>
                            <button id="btnDeleteCoupon" type="button" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-2.5 rounded-xl">Supprimer le coupon</button>
                        </form>
                    </section>

                </div>
            </div>
        </div>
    </main>

    <script>
        const token = localStorage.getItem('token');
        if (!token) {
            window.location.href = '/login';
        }

        (async () => {
            try {
                const meResponse = await fetch('/api/user', {
                    headers: { 'Authorization': 'Bearer ' + token, 'Accept': 'application/json' }
                });

                if (!meResponse.ok) {
                    throw new Error('Unauthorized');
                }

                const me = await meResponse.json();
                if (me?.role !== 'admin') {
                    window.location.href = '/mon-compte';
                    return;
                }

                document.body.style.visibility = 'visible';
            } catch (error) {
                window.location.href = '/login';
                return;
            }
        })();

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

        async function getConsoles() {
            try {
                const res = await fetch("/api/consoles", {
                    headers: {
                        "Accept": "application/json",
                        "Authorization": "Bearer " + token
                    }
                });
                const consoles = await res.json();

                const grid = document.getElementById('consolesGrid');
                const count = document.getElementById('consolesCount');
                const editSelect = document.getElementById('editConsoleSelect');
                const addSelect = document.getElementById('addConsoleSelect');
                const deleteSelect = document.getElementById('deleteConsoleSelect');
                const promoSelect = document.getElementById('promoConsoleSelect');

                if (count) {
                    count.textContent = `${consoles.length} consoles`;
                }
                

                if (!Array.isArray(consoles) || consoles.length === 0) {
                    grid.innerHTML = '<div class="text-xs text-gray-400">Aucune console disponible.</div>';
                    if (editSelect) {
                        editSelect.innerHTML = '<option value="">Choisir une console</option>';
                    }
                    if (addSelect) {
                        addSelect.innerHTML = '<option value="">Choisir une console</option>';
                    }
                    if (promoSelect) {
                        promoSelect.innerHTML = '<option value="">Choisir une console</option>';
                    }
                    return;
                }

                if (editSelect || addSelect) {
                    let options = '<option value="">Choisir une console</option>';
                    consoles.forEach((item) => {
                        const label = item.name || 'Console';
                        const id = item.id || 'id de console';
                        options += `<option value="${item.id}">#0${id} ${label}</option>`;
                    });
                    if (editSelect) {
                        editSelect.innerHTML = options;
                    }
                    if (addSelect) {
                        addSelect.innerHTML = options;
                    }
                    if (deleteSelect) {
                        deleteSelect.innerHTML = options;
                    }
                    if (promoSelect) {
                        promoSelect.innerHTML = options;
                    }
                }

                let html = '';
                consoles.forEach((item) => {
                    const ref = item.id ? String(item.id).padStart(3, '0') : '--';
                    const name = item.name || 'Console';
                    const brand = item.brand || '';
                    const basePrice = Number(item.daily_price || 0);
                    const effectivePrice = Number(item.effective_daily_price ?? item.daily_price ?? 0);
                    const promoActive = Boolean(item.has_active_promo);
                    const promoLine = promoActive && effectivePrice !== basePrice
                        ? `<p class="text-xs font-bold text-emerald-600 mt-1">Promo active: ${effectivePrice.toFixed(2)} DH / jour</p>`
                        : '';
                    const price = promoActive && effectivePrice !== basePrice
                        ? `<span class="line-through text-gray-400 mr-2">${basePrice.toFixed(2)} DH / jour</span><span>${effectivePrice.toFixed(2)} DH / jour</span>`
                        : `${basePrice.toFixed(2)} DH / jour`;
                    const statusLabel = item.ability ? 'Disponible' : 'Non disponible';
                    const statusClass = item.ability ? 'bg-green-100 text-green-600' : 'bg-yellow-100 text-yellow-700';
                    const games = Array.isArray(item.games) && item.games.length
                        ? item.games.map((game) => game.title).join(', ')
                        : 'Aucun jeu';

                    html += `
                        <div class="border border-gray-100 rounded-2xl p-4 bg-gray-50">
                            <div class="flex items-start justify-between">
                                <div>
                                    <p class="text-xs font-bold text-gray-400">Console #${ref}</p>
                                    <h3 class="text-lg font-black text-gray-900">${name}</h3>
                                    <p class="text-xs text-gray-500">${brand}</p>
                                </div>
                                <span class="text-[10px] font-black uppercase ${statusClass} px-3 py-1 rounded-full">${statusLabel}</span>
                            </div>
                            <div class="mt-4 flex items-center justify-between text-sm">
                                <div>
                                    <p class="font-bold text-primary">${price}</p>
                                    ${promoLine}
                                </div>
                                <button type="button" class="text-xs font-bold text-gray-500 hover:text-gray-900">Modifier</button>
                            </div>
                            <div class="mt-3 text-xs text-gray-500">Jeux : ${games}</div>
                        </div>
                    `;
                });
                grid.innerHTML = html;
            } catch (e) {
                console.error("erreur de chargement consoles", e);
            }
        }

        async function getGames() {
            try {
                const res = await fetch("/api/games", {
                    headers: {
                        "Accept": "application/json",
                        "Authorization": "Bearer " + token
                    }
                });
                const games = await res.json();

                const grid = document.getElementById('gamesGrid');
                const count = document.getElementById('gamesCount');
                const checkboxContainer = document.getElementById('consoleGamesCheckboxes');
                const deleteGameSelect = document.getElementById('deleteGameSelect');

                if (count) {
                    count.textContent = `${games.length} jeux`;
                }
                if (checkboxContainer) {
                    // Build the checkbox list from all available games.
                    if (!Array.isArray(games) || games.length === 0) {
                        checkboxContainer.innerHTML = '<div class="text-xs text-gray-400">Aucun jeu disponible.</div>';
                    } else {
                        let checkboxes = '';
                        games.forEach((game) => {
                            const label = game.title || 'Jeu';
                            checkboxes += `
                                <label class="flex items-center gap-2">
                                    <input type="checkbox" name="consoleGame" value="${game.id}"> ${label}
                                </label>
                            `;
                        });
                        checkboxContainer.innerHTML = checkboxes;
                    }
                }

                if (deleteGameSelect) {
                    let gameOptions = '<option value="">Choisir un jeu</option>';
                    if (Array.isArray(games) && games.length > 0) {
                        games.forEach((game) => {
                            const label = game.title || 'Jeu';
                            gameOptions += `<option value="${game.id}">${label}</option>`;
                        });
                    }
                    deleteGameSelect.innerHTML = gameOptions;
                }

                if (!grid) {
                    return;
                }

                if (!Array.isArray(games) || games.length === 0) {
                    grid.innerHTML = '<div class="text-xs text-gray-400">Aucun jeu disponible.</div>';
                    return;
                }

                let html = '';
                games.forEach((item) => {
                    const title = item.title || 'Jeu';
                    const genre = item.genre ? `Genre : ${item.genre}` : 'Genre : --';

                    html += `
                        <div class="border border-gray-100 rounded-2xl p-4">
                            <h3 class="text-sm font-black text-gray-900">${title}</h3>
                            <p class="text-xs text-gray-500 mt-1">${genre}</p>
                        </div>
                    `;
                });
                grid.innerHTML = html;
            } catch (e) {
                console.error("erreur de chargement games", e);
            }
        }

        async function getCoupons() {
            try {
                const res = await fetch("/api/coupons", {
                    headers: {
                        "Accept": "application/json",
                        "Authorization": "Bearer " + token
                    }
                });

                if (!res.ok) {
                    throw new Error('Erreur chargement coupons');
                }

                const coupons = await res.json();
                const select = document.getElementById('deleteCouponSelect');
                if (!select) return;

                let options = '<option value="">Choisir un coupon</option>';
                if (Array.isArray(coupons) && coupons.length > 0) {
                    coupons.forEach((coupon) => {
                        const code = coupon.code || 'CODE';
                        const value = coupon.value ?? 0;
                        options += `<option value="${coupon.id}">${code} (${value})</option>`;
                    });
                }
                select.innerHTML = options;
            } catch (e) {
                console.error("erreur de chargement coupons", e);
            }
        }

        async function loadConsoleGames(consoleId) {
            const container = document.getElementById('consoleGamesCheckboxes');
            if (!container) {
                return;
            }

            // Reset all checkboxes before applying selected games.
            const checkboxes = container.querySelectorAll('input[name="consoleGame"]');
            checkboxes.forEach((checkbox) => {
                checkbox.checked = false;
            });

            if (!consoleId) {
                return;
            }

            try {
                const res = await fetch(`/api/consoles/${consoleId}`, {
                    headers: {
                        "Accept": "application/json",
                        "Authorization": "Bearer " + token
                    }
                });

                if (!res.ok) {
                    return;
                }

                const data = await res.json();
// comparer les values de checkboxex avec tous les ids de de games dans ce console si il ya on coche
                const games = data.games || [];
                for (const checkbox of checkboxes) {
                    for (const game of games) {
                        if (String(game.id) === checkbox.value) {
                            checkbox.checked = true;
                            break;
                        }
                    }
                }
            } catch (err) {
                console.error("erreur selection jeux", err);
            }
        }

        getConsoles();
        getGames();
        getCoupons();


        let btnCreateConsole = document.getElementById("btnCreateConsole");
        if (btnCreateConsole) {
            btnCreateConsole.addEventListener('click', async (e) => {
                e.preventDefault();

                let name = document.getElementById("nomConsole");
                let brand = document.getElementById("brand");
                let daily_price = document.getElementById("daily_price");
                let ability = document.getElementById("ability");
                let image = document.getElementById("image");

                if (!name || !brand || !daily_price || !ability || !image) {
                    return;
                }

                const nameValue = name.value.trim();
                const brandValue = brand.value.trim();
                const priceValue = daily_price.value.trim();
                const abilityValue = ability.value === 'Disponible';
                const imageValue = image.value.trim();

                if (!nameValue || !brandValue || !priceValue) {
                    await Swal.fire({ icon: 'warning', title: 'Attention', text: "Remplissez tous les champs obligatoires." });
                    return;
                }

                try {
                    let res = await fetch("/api/consoles", {
                        method: "POST",
                        headers: {
                            "Accept": "application/json",
                            "Content-Type": "application/json",
                            "Authorization": "Bearer " + token
                        },
                        body: JSON.stringify({
                            name: nameValue,
                            brand: brandValue,
                            daily_price: priceValue,
                            ability: abilityValue,
                            image: imageValue || null
                        })
                    });

                    if (res.ok) {
                        name.value = '';
                        brand.value = '';
                        daily_price.value = '';
                        ability.value = 'Disponible';
                        image.value = '';
                        getConsoles();
                    } else {
                        const error = await res.json();
                        console.error("Erreur creation console", error);
                        await Swal.fire({ icon: 'error', title: 'Erreur', text: "Erreur creation console" });
                    }
                } catch (err) {
                    console.error("Erreur creation console", err);
                }
            });
        }

        let btnCreateGame = document.getElementById("btnCreateGame");
        if (btnCreateGame) {
            btnCreateGame.addEventListener('click', async (e) => {
                e.preventDefault();

                let title = document.getElementById("gameTitle");
                let genre = document.getElementById("gameGenre");
                let image = document.getElementById("gameImage");

                if (!title || !genre || !image) {
                    return;
                }
                const titleValue = title.value.trim();
                const genreValue = genre.value.trim();
                const imageValue = image.value.trim();

                if (!titleValue || !genreValue) {
                    await Swal.fire({ icon: 'warning', title: 'Attention', text: "Remplissez tous les champs obligatoires." });
                    return;
                }

                try {
                    let res = await fetch("/api/games", {
                        method: "POST",
                        headers: {
                            "Accept": "application/json",
                            "Content-Type": "application/json",
                            "Authorization": "Bearer " + token
                        },
                        body: JSON.stringify({
                            title: titleValue,
                            genre: genreValue,
                            image: imageValue || null
                        })
                    });

                    if (res.ok) {
                        title.value = '';
                        genre.value = '';
                        image.value = '';
                        getGames();
                    } else {
                        await Swal.fire({ icon: 'error', title: 'Erreur', text: "Erreur creation jeu" });
                    }
                } catch (err) {
                    console.error("Erreur creation jeu", err);
                }
            });
        }

        const btnDeleteGame = document.getElementById('btnDeleteGame');
        if (btnDeleteGame) {
            btnDeleteGame.addEventListener('click', async (e) => {
                e.preventDefault();

                const select = document.getElementById('deleteGameSelect');
                if (!select) {
                    return;
                }

                const gameId = select.value;
                if (!gameId) {
                    await Swal.fire({ icon: 'warning', title: 'Attention', text: 'Choisir un jeu.' });
                    return;
                }

                const confirmation = await Swal.fire({
                    icon: 'warning',
                    title: 'Supprimer le jeu ?',
                    text: 'Cette action supprimera aussi ses associations avec les consoles.',
                    showCancelButton: true,
                    confirmButtonText: 'Oui, supprimer',
                    cancelButtonText: 'Annuler',
                    confirmButtonColor: '#dc2626'
                });

                if (!confirmation.isConfirmed) {
                    return;
                }

                try {
                    const res = await fetch(`/api/games/${gameId}`, {
                        method: 'DELETE',
                        headers: {
                            'Accept': 'application/json',
                            'Authorization': 'Bearer ' + token
                        }
                    });

                    if (!res.ok) {
                        const error = await res.json().catch(() => null);
                        console.error('Erreur suppression jeu', error);
                        await Swal.fire({ icon: 'error', title: 'Erreur', text: 'Erreur suppression jeu' });
                        return;
                    }

                    select.value = '';
                    document.getElementById('consoleGamesCheckboxes').innerHTML = '';
                    await Swal.fire({ icon: 'success', title: 'Supprime', text: 'Jeu supprimé avec succès', timer: 1500, showConfirmButton: false });
                    getGames();
                    getConsoles();
                } catch (err) {
                    console.error('Erreur suppression jeu', err);
                    await Swal.fire({ icon: 'error', title: 'Erreur', text: 'Erreur suppression jeu' });
                }
            });
        }

        let btnUpdate = document.getElementById("btnUpdate");
        if (btnUpdate) {
            btnUpdate.addEventListener('click', async (e) => {
                e.preventDefault();

                const select = document.getElementById("editConsoleSelect");
                const abilityUpdate = document.getElementById("abilityUpdate");
                const prixUpdate = document.getElementById("prixUpdate");
                const imageUpdate = document.getElementById("imageUpdate");

                if (!select || !abilityUpdate || !prixUpdate || !imageUpdate) {
                    return;
                }

                const consoleId = select.value;
                const priceValue = prixUpdate.value.trim();
                const imageValue = imageUpdate.value.trim();
                const abilityValue = abilityUpdate.value === 'Disponible';

                if (!consoleId) {
                    await Swal.fire({ icon: 'warning', title: 'Attention', text: "Choisir une console." });
                    return;
                }
                try {
                    let res = await fetch(`/api/consoles/${consoleId}` ,{
                        method: "PUT",
                        headers: {
                            "Accept": "application/json",
                            "Content-Type": "application/json",
                            "Authorization": "Bearer " + token
                        },
                        body: JSON.stringify({
                            daily_price: priceValue || undefined,
                            ability: abilityValue,
                            image: imageValue || undefined
                        })
                    });

                    if (res.ok) {
                        prixUpdate.value = '';
                        abilityUpdate.value = 'Disponible';
                        imageUpdate.value = '';
                        getConsoles();
                    } else {
                        const error = await res.json().catch(() => null);
                        console.error("Erreur update console", error);
                        await Swal.fire({ icon: 'error', title: 'Erreur', text: "Erreur update console" });
                    }
                } catch (err) {
                    console.error("Erreur update console", err);
                }
            });
        }

        const btnSavePromo = document.getElementById('btnSavePromo');
        if (btnSavePromo) {
            btnSavePromo.addEventListener('click', async (e) => {
                e.preventDefault();

                const select = document.getElementById('promoConsoleSelect');
                const promoPrice = document.getElementById('promoPrice');
                const promoStartsAt = document.getElementById('promoStartsAt');
                const promoEndsAt = document.getElementById('promoEndsAt');
                const promoActive = document.getElementById('promoActive');

                if (!select || !promoPrice || !promoStartsAt || !promoEndsAt || !promoActive) {
                    return;
                }

                const consoleId = select.value;
                if (!consoleId) {
                    await Swal.fire({ icon: 'warning', title: 'Attention', text: 'Choisir une console.' });
                    return;
                }

                const promoPriceValue = promoPrice.value.trim();
                if (!promoPriceValue) {
                    await Swal.fire({ icon: 'warning', title: 'Attention', text: 'Indiquez un prix promo.' });
                    return;
                }

                try {
                    const res = await fetch(`/api/consoles/${consoleId}`, {
                        method: 'PUT',
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json',
                            'Authorization': 'Bearer ' + token
                        },
                        body: JSON.stringify({
                            promo_price: promoPriceValue,
                            promo_starts_at: promoStartsAt.value || null,
                            promo_ends_at: promoEndsAt.value || null,
                            promo_active: !!promoActive.checked
                        })
                    });

                    if (!res.ok) {
                        const error = await res.json().catch(() => null);
                        console.error('Erreur promo console', error);
                        await Swal.fire({ icon: 'error', title: 'Erreur', text: error?.message || 'Erreur enregistrement promo' });
                        return;
                    }

                    promoPrice.value = '';
                    promoStartsAt.value = '';
                    promoEndsAt.value = '';
                    promoActive.checked = true;
                    await Swal.fire({ icon: 'success', title: 'Succès', text: 'Promo enregistrée avec succès', timer: 1500, showConfirmButton: false });
                    await getConsoles();
                } catch (err) {
                    console.error('Erreur promo console', err);
                    await Swal.fire({ icon: 'error', title: 'Erreur', text: 'Erreur enregistrement promo' });
                }
            });
        }

        const btnDeleteConsole = document.getElementById('btnDeleteConsole');
        if (btnDeleteConsole) {
            btnDeleteConsole.addEventListener('click', async (e) => {
                e.preventDefault();

                const select = document.getElementById('deleteConsoleSelect');
                if (!select) {
                    return;
                }

                const consoleId = select.value;
                if (!consoleId) {
                    await Swal.fire({ icon: 'warning', title: 'Attention', text: 'Choisir une console.' });
                    return;
                }

                const confirmation = await Swal.fire({
                    icon: 'warning',
                    title: 'Supprimer la console ?',
                    text: 'Cette action supprimera aussi ses associations de jeux et est irreversible.',
                    showCancelButton: true,
                    confirmButtonText: 'Oui, supprimer',
                    cancelButtonText: 'Annuler',
                    confirmButtonColor: '#dc2626'
                });

                if (!confirmation.isConfirmed) {
                    return;
                }

                try {
                    const res = await fetch(`/api/consoles/${consoleId}`, {
                        method: 'DELETE',
                        headers: {
                            'Accept': 'application/json',
                            'Authorization': 'Bearer ' + token
                        }
                    });

                    if (!res.ok) {
                        const error = await res.json().catch(() => null);
                        console.error('Erreur suppression console', error);
                        await Swal.fire({ icon: 'error', title: 'Erreur', text: 'Erreur suppression console' });
                        return;
                    }

                    select.value = '';
                    document.getElementById('editConsoleSelect').value = '';
                    document.getElementById('addConsoleSelect').value = '';
                    document.getElementById('consoleGamesCheckboxes').innerHTML = '';
                    await Swal.fire({ icon: 'success', title: 'Supprimée', text: 'Console supprimée avec succès', timer: 1500, showConfirmButton: false });
                    getConsoles();
                } catch (err) {
                    console.error('Erreur suppression console', err);
                    await Swal.fire({ icon: 'error', title: 'Erreur', text: 'Erreur suppression console' });
                }
            });
        }

        const addConsoleSelect = document.getElementById('addConsoleSelect');

        // selection de console que je veux fetcher ces games pour le cocher
        if (addConsoleSelect) {
            addConsoleSelect.addEventListener('change', (e) => loadConsoleGames(e.target.value));
        }
        

        let btnAttachGames = document.getElementById("btnAttachGames");
        if (btnAttachGames) {
            btnAttachGames.addEventListener('click', async (e) => {
                e.preventDefault();

                const select = document.getElementById('addConsoleSelect');
                const container = document.getElementById('consoleGamesCheckboxes');

                if (!select || !container) {
                    return;
                }

                const consoleId = select.value;
                if (!consoleId) {
                    await Swal.fire({ icon: 'warning', title: 'Attention', text: "Choisir une console." });
                    return;
                }

                // Collect checked game IDs to sync with the console.
                const selectedIds = [];
                const checkedBoxes = container.querySelectorAll('input[name="consoleGame"]:checked');
                for (const checkbox of checkedBoxes) {
                    selectedIds.push(Number(checkbox.value));
                }

                try {
                    // Send the full selection to the API (add/remove in DB).
                    let res = await fetch(`/api/consoles/${consoleId}/games`, {
                        method: "PUT",
                        headers: {
                            "Accept": "application/json",
                            "Content-Type": "application/json",
                            "Authorization": "Bearer " + token
                        },
                        body: JSON.stringify({
                            game_ids: selectedIds
                        })
                    });

                    if (res.ok) {
                        await Swal.fire({ icon: 'success', title: 'Succès', text: 'Jeux associés avec succès', timer: 1400, showConfirmButton: false });
                        getConsoles();
                    } else {
                        const error = await res.json().catch(() => null);
                        console.error("Erreur association jeux", error);
                        await Swal.fire({ icon: 'error', title: 'Erreur', text: "Erreur association jeux" });
                    }
                } catch (err) {
                    console.error("Erreur association jeux", err);
                }
            });
        }

        const btnCreateCoupon = document.getElementById('btnCreateCoupon');
        if (btnCreateCoupon) {
            btnCreateCoupon.addEventListener('click', async (e) => {
                e.preventDefault();

                const code = document.getElementById('couponCode')?.value.trim();
                const value = document.getElementById('couponValue')?.value.trim();
                const expiration_date = document.getElementById('couponExpirationDate')?.value;
                const limit = document.getElementById('couponLimit')?.value.trim();
                const is_active = !!document.getElementById('couponIsActive')?.checked;

                if (!code || !value || !expiration_date || !limit) {
                    await Swal.fire({ icon: 'warning', title: 'Attention', text: "Remplissez tous les champs du coupon." });
                    return;
                }

                try {
                    const res = await fetch('/api/coupons', {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json',
                            'Authorization': 'Bearer ' + token
                        },
                        body: JSON.stringify({
                            code,
                            value: Number(value),
                            expiration_date,
                            limit: Number(limit),
                            is_active
                        })
                    });

                    if (!res.ok) {
                        const err = await res.json().catch(() => null);
                        throw new Error(err?.message || 'Erreur création coupon');
                    }

                    await Swal.fire({ icon: 'success', title: 'Succès', text: 'Coupon créé avec succès', timer: 1500, showConfirmButton: false });
                    document.getElementById('formCreateCoupon')?.reset();
                    const isActiveEl = document.getElementById('couponIsActive');
                    if (isActiveEl) isActiveEl.checked = true;
                    await getCoupons();
                } catch (err) {
                    await Swal.fire({ icon: 'error', title: 'Erreur', text: err.message || 'Erreur création coupon' });
                }
            });
        }

        const btnDeleteCoupon = document.getElementById('btnDeleteCoupon');
        if (btnDeleteCoupon) {
            btnDeleteCoupon.addEventListener('click', async (e) => {
                e.preventDefault();

                const couponId = document.getElementById('deleteCouponSelect')?.value;
                if (!couponId) {
                    await Swal.fire({ icon: 'warning', title: 'Attention', text: "Choisir un coupon à supprimer." });
                    return;
                }

                const confirmDelete = await Swal.fire({
                    icon: 'warning',
                    title: 'Confirmer',
                    text: 'Voulez-vous vraiment supprimer ce coupon ?',
                    showCancelButton: true,
                    confirmButtonText: 'Supprimer',
                    cancelButtonText: 'Annuler'
                });

                if (!confirmDelete.isConfirmed) return;

                try {
                    const res = await fetch(`/api/coupons/${couponId}`, {
                        method: 'DELETE',
                        headers: {
                            'Accept': 'application/json',
                            'Authorization': 'Bearer ' + token
                        }
                    });

                    if (!res.ok) {
                        const err = await res.json().catch(() => null);
                        throw new Error(err?.message || 'Erreur suppression coupon');
                    }

                    await Swal.fire({ icon: 'success', title: 'Succès', text: 'Coupon supprimé', timer: 1400, showConfirmButton: false });
                    await getCoupons();
                } catch (err) {
                    await Swal.fire({ icon: 'error', title: 'Erreur', text: err.message || 'Erreur suppression coupon' });
                }
            });
        }

        // --- MANETTES ---
        async function getManettes() {
            try {
                const res = await fetch("/api/manettes", {
                    headers: {
                        "Accept": "application/json",
                        "Authorization": "Bearer " + token
                    }
                });
                if (!res.ok) {
                    throw new Error('Impossible de charger les manettes');
                }
                const payload = await res.json();
                const manettes = Array.isArray(payload) ? payload : (payload.manettes || []);
                const select = document.getElementById('selectManette');
                if (select) {
                    let options = '<option value="">Choisir une manette</option>';
                    manettes.forEach((m) => {
                        options += `<option value="${m.id}" data-status="${m.status}">${m.serial_number} (${m.status})</option>`;
                    });
                    select.innerHTML = options;
                }
            } catch (e) {
                console.error("Erreur chargement manettes", e);
            }
        }

        document.getElementById('btnCreateManette').onclick = async function() {
            const serial = document.getElementById('serialManette').value.trim();
            const status = document.getElementById('statusManette').value;
            if (!serial) return Swal.fire({ icon: 'warning', title: 'Attention', text: 'Numéro de série obligatoire' });
            try {
                const res = await fetch('/api/manettes', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + token
                    },
                    body: JSON.stringify({ serial_number: serial, status })
                });
                if (!res.ok) throw new Error('failed');
                await Swal.fire({ icon: 'success', title: 'Succès', text: 'Manette créée !', timer: 1500, showConfirmButton: false });
                document.getElementById('serialManette').value = '';
                await getManettes();
            } catch (e) {
                await Swal.fire({ icon: 'error', title: 'Erreur', text: 'Erreur création manette' });
            }
        };

        document.getElementById('btnUpdateManetteStatus').onclick = async function() {
            const id = document.getElementById('selectManette').value;
            const status = document.getElementById('updateStatusManette').value;
            if (!id) return Swal.fire({ icon: 'warning', title: 'Attention', text: 'Sélectionnez une manette' });
            try {
                const res = await fetch(`/api/manettes/${id}/status`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + token
                    },
                    body: JSON.stringify({ status })
                });
                if (!res.ok) throw new Error('failed');
                await Swal.fire({ icon: 'success', title: 'Succès', text: 'Statut mis à jour !', timer: 1500, showConfirmButton: false });
                await getManettes();
            } catch (e) {
                await Swal.fire({ icon: 'error', title: 'Erreur', text: 'Erreur maj statut' });
            }
        };

        const selectManette = document.getElementById('selectManette');
        const updateStatusManette = document.getElementById('updateStatusManette');
        if (selectManette && updateStatusManette) {
            // Dropdown compact: au clic on ouvre une petite liste scrollable, puis on referme.
            selectManette.addEventListener('mousedown', (e) => {
                if (selectManette.size === 1) {
                    e.preventDefault();
                    selectManette.size = 6; // Toujours une petite partie visible
                    selectManette.focus();
                }
            });
            selectManette.addEventListener('blur', () => {
                selectManette.size = 1;
            });
            selectManette.addEventListener('change', () => {
                const selected = selectManette.options[selectManette.selectedIndex];
                const currentStatus = selected ? selected.getAttribute('data-status') : null;
                if (currentStatus) {
                    updateStatusManette.value = currentStatus;
                }
                selectManette.size = 1;
            });
        }

        getManettes();
    </script>
</body>
</html>
