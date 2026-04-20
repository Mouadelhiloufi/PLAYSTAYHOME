<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consoles & Jeux - Admin playstayhome</title>
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

    <!-- Sidebar / Menu Lateral -->
    <aside class="w-[260px] bg-white border-r border-gray-100 flex flex-col justify-between py-8 px-6 shrink-0 fixed h-full z-10">
        <div>
            <!-- Logo -->
            <div class="flex items-center gap-2 px-2 mb-12">
                <i class="fa-solid fa-gamepad text-primary text-2xl"></i>
                <span class="font-black text-xl tracking-tight">PLAYSTAYHOME</span>
            </div>

            <!-- Navigation -->
            <nav class="flex flex-col gap-2">
                <a href="/admin/dashboard" class="text-gray-500 hover:text-gray-900 hover:bg-gray-50 px-5 py-3.5 rounded-xl font-bold text-sm transition-colors">
                    Dashboard
                </a>
                <a href="/admin/reservations" class="text-gray-500 hover:text-gray-900 hover:bg-gray-50 px-5 py-3.5 rounded-xl font-bold text-sm transition-colors">
                    Reservations
                </a>
                <a href="/admin/users" class="text-gray-500 hover:text-gray-900 hover:bg-gray-50 px-5 py-3.5 rounded-xl font-bold text-sm transition-colors">
                    Utilisateurs
                </a>
                <a href="/admin/consoles-games" class="bg-primary text-white px-5 py-3.5 rounded-xl font-bold text-sm flex items-center shadow-[0_4px_15px_rgba(25,120,229,0.2)]">
                    Consoles & Jeux
                </a>
                <a href="/admin/chat" class="text-gray-500 hover:text-gray-900 hover:bg-gray-50 px-5 py-3.5 rounded-xl font-bold text-sm transition-colors">
                    Support Chat
                </a>
            </nav>
        </div>

        <!-- Deconnexion -->
        <div class="border-t border-gray-100 pt-6 mt-10">
            <a href="#" class="text-red-500 hover:text-red-600 hover:bg-red-50 px-5 py-3.5 rounded-xl font-black text-sm transition-colors flex items-center">
                Deconnexion
            </a>
        </div>
    </aside>

    <!-- Contenu Principal -->
    <main class="flex-1 ml-[260px] flex flex-col min-h-screen">
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
                            <select id="selectManette" class="w-full rounded-xl border border-gray-200 px-4 py-2 text-sm">
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
                        <h3 class="text-lg font-black text-gray-900 mb-4">Ajouter des jeux a une console</h3>
                        <form class="space-y-3">
                            <select id="addConsoleSelect" class="w-full rounded-xl border border-gray-200 px-4 py-2 text-sm">
                                <option value="">Choisir une console</option>
                            </select>
                            <div id="consoleGamesCheckboxes" class="space-y-2 text-sm text-gray-700"></div>
                            <button id="btnAttachGames" type="button" class="w-full bg-gray-900 text-white font-bold py-2.5 rounded-xl">Associer les jeux</button>
                        </form>
                    </section>

                </div>
            </div>
        </div>
    </main>

    <script>
        const token = localStorage.getItem('token');


            

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
                }

                let html = '';
                consoles.forEach((item) => {
                    const ref = item.id ? String(item.id).padStart(3, '0') : '--';
                    const name = item.name || 'Console';
                    const brand = item.brand || '';
                    const price = item.daily_price ? `${item.daily_price} DH / jour` : '0 DH / jour';
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
                                <p class="font-bold text-primary">${price}</p>
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
                    alert("Remplissez tous les champs obligatoires.");
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
                        alert("Erreur creation console");
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
                    alert("Remplissez tous les champs obligatoires.");
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
                        alert("Erreur creation jeu");
                    }
                } catch (err) {
                    console.error("Erreur creation jeu", err);
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
                    alert("Choisir une console.");
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
                        alert("Erreur update console");
                    }
                } catch (err) {
                    console.error("Erreur update console", err);
                }
            });
        }

        const addConsoleSelect = document.getElementById('addConsoleSelect');
        
        //selection de console que je veux fetcher ces games pour le cocher
            addConsoleSelect.addEventListener('change', (e) => loadConsoleGames(e.target.value));
        

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
                    alert("Choisir une console.");
                    return;
                }

                // Collect checked game IDs to sync with the console.
                const selectedIds = [];
                const checkedBoxes = container.querySelectorAll('input[name="consoleGame"]:checked');
                for (const checkbox of checkedBoxes) {
                    selectedIds.push(checkbox.value);
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
                        getConsoles();
                    } else {
                        const error = await res.json().catch(() => null);
                        console.error("Erreur association jeux", error);
                        alert("Erreur association jeux");
                    }
                } catch (err) {
                    console.error("Erreur association jeux", err);
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
                const manettes = await res.json();
                const select = document.getElementById('selectManette');
                if (select) {
                    let options = '<option value="">Choisir une manette</option>';
                    (Array.isArray(manettes) ? manettes : manettes.data).forEach((m) => {
                        options += `<option value="${m.id}">${m.serial_number} (${m.status})</option>`;
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
            if (!serial) return alert('Numéro de série obligatoire');
            try {
                await fetch('/api/manettes', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + token
                    },
                    body: JSON.stringify({ serial_number: serial, status })
                });
                alert('Manette créée !');
                document.getElementById('serialManette').value = '';
                getManettes();
            } catch (e) {
                alert('Erreur création manette');
            }
        };

        document.getElementById('btnUpdateManetteStatus').onclick = async function() {
            const id = document.getElementById('selectManette').value;
            const status = document.getElementById('updateStatusManette').value;
            if (!id) return alert('Sélectionnez une manette');
            try {
                await fetch(`/api/manettes/${id}/status`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + token
                    },
                    body: JSON.stringify({ status })
                });
                alert('Statut mis à jour !');
                getManettes();
            } catch (e) {
                alert('Erreur maj statut');
            }
        };

        getManettes();
    </script>
</body>
</html>
