<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogue - playstayhome</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #f5f7fb;
            color: #111827;
        }

        .text-primary {
            color: #2f6bff;
        }

        .bg-primary {
            background: #2f6bff;
        }

        .nav-link {
            position: relative;
            display: inline-flex;
            align-items: center;
            height: 40px;
            font-size: 0.875rem;
            font-weight: 600;
            color: #4b5563;
            transition: color .2s ease;
        }

        .nav-link::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: -1px;
            width: 100%;
            height: 2px;
            background: #2f6bff;
            transform: scaleX(0);
            transform-origin: center;
            transition: transform .2s ease;
        }

        .nav-link:hover,
        .nav-link.active {
            color: #2f6bff;
        }

        .nav-link:hover::after,
        .nav-link.active::after {
            transform: scaleX(1);
        }

        .panel {
            border: 1px solid #e7ecf4;
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 8px 24px rgba(15, 23, 42, 0.04);
        }

        .soft-box {
            border: 1px solid #edf1f8;
            border-radius: 14px;
            background: #f8fbff;
        }

        .catalog-layout {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.75rem;
            align-items: start;
        }

        .catalog-content {
            min-width: 0;
        }

        .catalog-products {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        .catalog-card {
            padding: 0.8rem;
        }

        .catalog-card.locked {
            opacity: 0.6;
            filter: grayscale(0.2);
        }

        .catalog-card-media {
            padding: 0.7rem;
        }

        .catalog-card-image {
            margin-top: 0.45rem;
            height: 7.2rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .catalog-card-image img {
            height: 6.6rem;
            object-fit: contain;
        }

        .catalog-card-head {
            margin-top: 0.65rem;
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 0.7rem;
        }

        .catalog-card-title {
            font-size: 0.78rem;
            line-height: 1.35;
            font-weight: 700;
            color: #111827;
        }

        .catalog-card-price {
            font-size: 1.05rem;
            line-height: 1;
            font-weight: 700;
            color: #2f6bff;
            white-space: nowrap;
        }

        .catalog-card-note {
            margin-top: 0.75rem;
        }

        .catalog-card-games {
            margin-top: 0.55rem;
        }

        .catalog-card-cta {
            margin-top: 0.75rem;
        }

        @media (min-width: 1024px) {
            .catalog-layout {
                grid-template-columns: 240px minmax(0, 1fr);
                justify-content: space-between;
            }

            .catalog-sidebar {
                position: sticky;
                top: 88px;
            }
        }

        @media (min-width: 768px) {
            .catalog-products {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 1rem;
            }

            .catalog-card-featured {
                padding: 0.85rem;
            }

            .catalog-card-featured .catalog-card-image {
                height: 8.4rem;
            }

            .catalog-card-featured .catalog-card-image img {
                height: 7.8rem;
            }

            .catalog-card-featured .catalog-card-title {
                font-size: 0.9rem;
            }

            .catalog-card-featured .catalog-card-price {
                font-size: 1.24rem;
            }
        }

        /* Scrollbar custom personnalisée pour les jeux (scrollbar X) */
        .games-scroll-container {
            display: flex;
            overflow-x: auto;
            gap: 1rem;
            padding-bottom: 0.5rem;
            scrollbar-width: thin;
            scrollbar-color: #cbd5e1 transparent;
        }

        .games-scroll-container::-webkit-scrollbar {
            height: 4px;
        }

        .games-scroll-container::-webkit-scrollbar-track {
            background: transparent;
        }

        .games-scroll-container::-webkit-scrollbar-thumb {
            background-color: #cbd5e1;
            border-radius: 20px;
        }

    </style>
</head>
<body>
    <div class="min-h-screen">
        @include('partials.navbar-main')

        <main class="mx-auto max-w-6xl px-6 py-6 md:py-8">
            <section class="catalog-layout">
                <aside class="catalog-sidebar space-y-4">
                    <div class="panel p-5">
                        <h3 class="text-xs font-bold uppercase tracking-widest text-gray-400">Plateforme</h3>
                        <div class="mt-4 space-y-3">
                            <button id="btnTous" class="flex w-full items-center justify-between rounded-xl border border-gray-200 bg-white px-3 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition-colors">
                                <span class="flex items-center gap-2"><i class="fa-solid fa-gamepad"></i> Tous</span>
                                
                            </button>
                            <button id="btnPlayStation" class="flex w-full items-center justify-between rounded-xl border border-blue-100 bg-blue-50 px-3 py-2 text-sm font-semibold text-blue-700">
                                <span class="flex items-center gap-2"><i class="fab fa-playstation"></i> PlayStation</span>
                                
                            </button>
                            <button id="btnXbox" class="flex w-full items-center justify-between rounded-xl border border-green-100 bg-green-50 px-3 py-2 text-sm font-semibold text-green-700">
                                <span class="flex items-center gap-2"><i class="fa-brands fa-xbox"></i> Xbox</span>
                            </button>
                        </div>
                    </div>

                    <div class="panel p-5">
                        <div class="flex items-center justify-between">
                            <h3 class="text-xs font-bold uppercase tracking-widest text-gray-400">Prix max / jour</h3>
                            <span id="priceDisplay" class="rounded-lg bg-blue-50 px-2 py-1 text-xs font-bold text-primary">300 DH</span>
                        </div>
                        <div class="mt-5">
                            <input type="range" id="priceRange" min="50" max="300" value="300" class="w-full h-1 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-primary">
                        </div>
                        <div class="mt-2 flex justify-between text-xs text-gray-400">
                            <span>50 DH</span>
                            <span>300 DH</span>
                        </div>
                    </div>

                    <div class="panel p-5">
                        <h3 class="text-xs font-bold uppercase tracking-widest text-gray-400">Jeux inclus</h3>
                        <div class="mt-4">
                            <div class="relative">
                                <i class="fa-solid fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                                <input type="text" id="searchGameInput" placeholder="Rechercher un jeu (ex: FIFA)..." class="w-full rounded-xl border border-gray-200 bg-gray-50 py-2.5 pl-9 pr-3 text-sm text-gray-700 outline-none focus:border-primary focus:bg-white transition-colors">
                            </div>
                        </div>
                    </div>

                    
                </aside>

                <div class="catalog-content">
                    <div class="mb-3 flex items-center justify-between">
                        <h1 class="text-2xl font-black tracking-tight text-gray-900">Catalogue <span class="text-primary" id="catalog-count">(0)</span></h1>
                        <button class="rounded-xl border border-gray-200 bg-white px-4 py-2 text-sm font-semibold text-gray-500">
                            Trier par : Nouveautes
                        </button>
                    </div>

                    <div id="catalog-products-container" class="catalog-products">
                        <!-- Résultat dynamique injecté ici -->
                    </div>
                </div>
            </section>
        </main>

        <footer class="border-t border-gray-200 bg-white">
            <div class="mx-auto max-w-6xl px-6 py-14">
                <div class="grid grid-cols-1 gap-12 md:grid-cols-4">
                    <div>
                        <div class="flex items-center gap-4 text-primary">
                            <img src="{{ asset('images/footer-logo-icon.png') }}" alt="PLAYSTAYHOME" class="h-8 w-auto object-contain opacity-50">
                            <span class="text-2xl font-extrabold tracking-tight text-gray-900">PLAYSTAYHOME</span>
                        </div>
                        <p class="mt-5 max-w-xs text-sm leading-7 text-gray-400">
                            Votre destination de choix pour du matériel de jeu haut de gamme et les dernières aventures numériques.
                        </p>
                    </div>

                    <div>
                        <h3 class="text-lg font-bold text-gray-900">Catalogue</h3>
                        <ul class="mt-5 space-y-3 text-sm text-gray-400">
                            <li><a href="#" class="hover:text-primary">Jeux PlayStation</a></li>
                            <li><a href="#" class="hover:text-primary">Consoles Xbox</a></li>
                            <li><a href="#" class="hover:text-primary">Exclusivités Nintendo</a></li>
                            <li><a href="#" class="hover:text-primary">Périphériques PC</a></li>
                        </ul>
                    </div>

                    <div>
                        <h3 class="text-lg font-bold text-gray-900">Support</h3>
                        <ul class="mt-5 space-y-3 text-sm text-gray-400">
                            <li><a href="#" class="hover:text-primary">Mon Compte</a></li>
                            <li><a href="#" class="hover:text-primary">Infos Livraison</a></li>
                            <li><a href="#" class="hover:text-primary">Suivre ma commande</a></li>
                            <li><a href="#" class="hover:text-primary">Politique de confidentialité</a></li>
                        </ul>
                    </div>

                    <div>
                        <h3 class="text-lg font-bold text-gray-900">Restez informé</h3>
                        <form class="mt-5 flex items-center gap-3">
                            <input type="email" placeholder="Email" class="h-11 w-full rounded-xl border border-gray-200 bg-white px-4 text-sm text-gray-700 outline-none">
                            <button type="submit" class="rounded-xl bg-primary px-5 py-3 text-sm font-bold text-white">
                                S'inscrire
                            </button>
                        </form>
                        <div class="mt-6 flex items-center gap-5 text-gray-400">
                            <a href="#" class="hover:text-primary"><i class="fa-solid fa-globe"></i></a>
                            <a href="#" class="hover:text-primary"><i class="fa-solid fa-at"></i></a>
                            <a href="#" class="hover:text-primary"><i class="fa-solid fa-share-nodes"></i></a>
                        </div>
                    </div>
                </div>

                <div class="mt-14 flex flex-col gap-4 border-t border-gray-100 pt-8 text-xs text-gray-300 md:flex-row md:items-center md:justify-between">
                    <p>&copy; 2026 <strong>PLAYSTAYHOME</strong>. Tous droits réservés.</p>
                    <div class="flex items-center gap-6">
                        <span>Français (FR)</span>
                        <span>MAD</span>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <script>
        let container = document.getElementById("catalog-products-container");
        let countSpan = document.getElementById("catalog-count");
        let btnTous = document.getElementById("btnTous");
        let btnPlayStation=document.getElementById("btnPlayStation");
        let btnXbox=document.getElementById("btnXbox");
        let searchGameInput = document.getElementById("searchGameInput");
        let priceRange = document.getElementById("priceRange");
        let priceDisplay = document.getElementById("priceDisplay");

        getConsoles();
        let consoles = [];

        async function getConsoles() {
            try {
                let res = await fetch("http://playstayhome.test/api/consoles", {
                    "headers": { 'Accept': 'application/json' }
                });
                consoles = await res.json();
                displayConsoles(consoles);
            } catch (error) {
                console.error("Erreur lors de la récupération des consoles :", error);
            }
        }
               function displayConsoles(consoles){
                container.innerHTML = "";
                countSpan.innerText = `(${consoles.length})`; // Mise a jour du compteur en haut "Catalogue (X)"

                consoles.forEach(console => {
                    
                    let gamesHtml = '';
                    if (console.games && console.games.length > 0) {
                        console.games.forEach(game => {
                            gamesHtml += `
                                <div class="flex flex-col items-center min-w-[50px]">
                                    <div class="h-12 w-12 rounded-lg border border-gray-200 bg-gray-50 flex items-center justify-center overflow-hidden shadow-sm">
                                        ${game.image 
                                            ? `<img src="${game.image}" alt="${game.title}" class="h-full w-full object-cover">` 
                                            : `<i class="fa-solid fa-gamepad text-gray-300 text-lg"></i>`
                                        }
                                    </div>
                                    <p class="mt-1.5 w-12 text-center text-[8px] font-medium text-gray-500 truncate" title="${game.title}">${game.title}</p>
                                </div>
                            `;
                        });
                    } else {
                        gamesHtml = `<p class="w-full text-center text-[10px] text-gray-400 italic">Aucun jeu inclus pour le moment</p>`;
                    }

                    const isAvailable = !!console.ability;
                    const statusLabel = isAvailable ? 'Disponible' : 'Non disponible';
                    const statusClass = isAvailable ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700';
                    const cardClass = isAvailable ? '' : ' locked';
                    const lockBadge = isAvailable
                        ? ''
                        : '<span class="absolute top-3 right-3 z-20 inline-flex h-10 w-10 items-center justify-center rounded-full bg-red-100 text-red-600 shadow-md pointer-events-none"><i class="fa-solid fa-lock text-base"></i></span>';
                    const buttonClass = isAvailable
                        ? 'mt-5 w-full rounded-xl bg-primary hover:bg-blue-700 transition-colors duration-300 py-3 text-xs font-bold text-white shadow-lg'
                        : 'mt-5 w-full rounded-xl bg-gray-200 py-3 text-xs font-bold text-gray-500 cursor-not-allowed';
                    const buttonLabel = isAvailable ? `Reserver la ${console.brand}` : 'Indisponible';
                    const buttonAction = isAvailable
                        ? `onclick="window.location.href='/reservation?console_id=${console.id}'"`
                        : 'disabled';

                    // Construction de la carte complete
                    container.innerHTML += `
                        <article class="panel catalog-card catalog-card-featured flex flex-col justify-between relative${cardClass}">
                            ${lockBadge}
                            <div>
                                <div class="soft-box catalog-card-media relative">
                                    <span class="absolute top-3 left-3 inline-block rounded-full bg-blue-100 px-2.5 py-1 text-[9px] font-bold uppercase text-blue-700">${console.brand}</span>
                                    <div class="catalog-card-image">
                                        <img src="${console.image}" alt="${console.name}" class="object-contain drop-shadow-lg">
                                    </div>
                                </div>
                                <div class="catalog-card-head mt-4">
                                    <div class="w-full flex flex-col">
                                        <h3 class="catalog-card-title text-lg text-gray-900">${console.name}</h3>
                                        <div class="mt-1.5 flex items-center gap-2">
                                            <span class="inline-block rounded px-1.5 py-0.5 text-[9px] font-bold uppercase tracking-wide ${statusClass}">${statusLabel}</span>
                                        </div>
                                    </div>
                                    <div class="text-right flex-shrink-0 ml-3">
                                        <p class="catalog-card-price text-2xl font-black text-primary">${console.daily_price} DH</p>
                                        <p class="text-[9px] font-medium text-gray-400 mt-1 uppercase tracking-wide">/ par jour</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mt-5 border-t border-gray-100 pt-4">
                                <p class="text-[9px] font-bold uppercase tracking-widest text-gray-400 mb-3"><i class="fa-solid fa-gamepad mr-1"></i> Jeux inclus :</p>
                                
                                <!-- LE CONTENEUR DES JEUX AVEC LE SCROLL HORIZONTAL (scroll-x) -->
                                <div class="games-scroll-container">
                                    ${gamesHtml}
                                </div>

                                <button ${buttonAction} class="${buttonClass}">
                                    ${buttonLabel}
                                </button>
                            </div>
                        </article>
                    `;
                });
            }

                btnTous.addEventListener('click', () => {
                    displayConsoles(consoles);
                    window.scrollTo({top: 0, behavior: 'smooth'});
                });

                btnPlayStation.addEventListener('click',()=>{
                    let playConsoles=consoles.filter(c=>c.name.toLowerCase().includes("playstation") || c.brand.toLowerCase().includes("sony"));
                    displayConsoles(playConsoles);
                    window.scrollTo({top: 0, behavior: 'smooth'});
                });

                btnXbox.addEventListener('click', () => {
                    let xboxConsoles = consoles.filter(c => c.name.toLowerCase().includes("xbox") || c.brand.toLowerCase().includes("microsoft"));
                    displayConsoles(xboxConsoles);
                    window.scrollTo({top: 0, behavior: 'smooth'});
                });

                searchGameInput.addEventListener('input', (e) => {
                    let searchTerm = e.target.value.toLowerCase();
                    
                    let filteredConsoles = consoles.filter(console => {
                        // On verifie si la console a des jeux
                        if (!console.games || console.games.length === 0) return false;
                        
                        // On regarde si au moins un des jeux continent le texte recherche
                        return console.games.some(game => game.title.toLowerCase().includes(searchTerm));
                    });
                    
                    displayConsoles(filteredConsoles);
                    window.scrollTo({top: 0, behavior: 'smooth'});
                });

                priceRange.addEventListener('input', (e) => {
                    let maxPrice = parseInt(e.target.value);
                    priceDisplay.innerText = maxPrice + " DH";
                    
                    let filteredConsoles = consoles.filter(console => {
                        return parseFloat(console.daily_price) <= maxPrice;
                    });
                    
                    displayConsoles(filteredConsoles);
                    window.scrollTo({top: 0, behavior: 'smooth'});
                });

            


        
    </script>
</body>

</html>
