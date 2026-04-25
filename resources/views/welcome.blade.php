<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>playstayhome</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>
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

        .hero-console {
            position: relative;
            width: 260px;
            height: 300px;
        }

        .hero-console-main {
            position: absolute;
            right: 34px;
            top: 10px;
            width: 116px;
            height: 240px;
            border-radius: 24px;
            background: linear-gradient(180deg, #ffffff 0%, #f5f7fb 100%);
            box-shadow: 0 30px 60px rgba(31, 41, 55, 0.14);
        }

        .hero-console-main::before {
            content: "";
            position: absolute;
            left: 38px;
            top: 0;
            width: 40px;
            height: 240px;
            border-radius: 16px;
            background: linear-gradient(180deg, #161c2d 0%, #090b11 100%);
        }

        .hero-console-left,
        .hero-console-right {
            position: absolute;
            top: 2px;
            width: 54px;
            height: 250px;
            border-radius: 60px;
            background: linear-gradient(180deg, #ffffff 0%, #edf2ff 100%);
        }

        .hero-console-left {
            left: 68px;
            transform: rotate(11deg);
            box-shadow: -12px 20px 34px rgba(47, 107, 255, 0.10);
        }

        .hero-console-right {
            right: 10px;
            transform: rotate(-9deg);
            box-shadow: 14px 20px 34px rgba(47, 107, 255, 0.10);
        }

        .hero-console-shadow {
            position: absolute;
            bottom: 18px;
            right: 12px;
            width: 190px;
            height: 24px;
            border-radius: 999px;
            background: radial-gradient(circle, rgba(15, 23, 42, 0.18) 0%, rgba(15, 23, 42, 0) 70%);
        }

        .hero-controller {
            position: absolute;
            left: 34px;
            bottom: 8px;
            width: 108px;
            height: 54px;
            border-radius: 28px 28px 22px 22px;
            background: linear-gradient(180deg, #ffffff 0%, #eef2ff 100%);
            box-shadow: 0 18px 28px rgba(15, 23, 42, 0.12);
        }

        .hero-controller::before,
        .hero-controller::after {
            content: "";
            position: absolute;
            bottom: 7px;
            width: 22px;
            height: 22px;
            border-radius: 50%;
            background: #101826;
        }

        .hero-controller::before {
            left: 18px;
        }

        .hero-controller::after {
            right: 18px;
        }

        .console-card {
            min-height: 256px;
            border: 1px solid #e8edf5;
            background: #ffffff;
            box-shadow: 0 8px 24px rgba(15, 23, 42, 0.04);
        }

        .console-card.locked {
            opacity: 0.6;
            filter: grayscale(0.2);
        }

        .console-figure {
            position: relative;
            height: 140px;
            border-radius: 18px;
            background: linear-gradient(180deg, #f8fbff 0%, #f1f5fb 100%);
            overflow: hidden;
        }

        .mini-ps5 {
            position: absolute;
            left: 50%;
            top: 16px;
            width: 84px;
            height: 104px;
            transform: translateX(-50%);
        }

        .mini-ps5::before,
        .mini-ps5::after {
            content: "";
            position: absolute;
            top: 0;
            width: 22px;
            height: 104px;
            border-radius: 999px;
            background: linear-gradient(180deg, #ffffff 0%, #eef2ff 100%);
        }

        .mini-ps5::before {
            left: 8px;
            transform: rotate(10deg);
        }

        .mini-ps5::after {
            right: 8px;
            transform: rotate(-10deg);
        }

        .mini-ps5 span {
            position: absolute;
            left: 50%;
            top: 4px;
            width: 26px;
            height: 98px;
            transform: translateX(-50%);
            border-radius: 12px;
            background: #101826;
        }

        .mini-xbox {
            position: absolute;
            left: 50%;
            top: 24px;
            width: 74px;
            height: 90px;
            transform: translateX(-50%);
            border-radius: 18px;
            background: linear-gradient(180deg, #1f2937 0%, #111827 100%);
            box-shadow: 0 18px 30px rgba(15, 23, 42, 0.18);
        }

        .mini-xbox::before {
            content: "";
            position: absolute;
            left: 50%;
            top: 14px;
            width: 18px;
            height: 18px;
            transform: translateX(-50%);
            border-radius: 50%;
            border: 2px solid #93c5fd;
        }

        .mini-pro {
            position: absolute;
            left: 50%;
            top: 30px;
            width: 86px;
            height: 62px;
            transform: translateX(-50%);
            border-radius: 10px;
            background: linear-gradient(180deg, #525b6d 0%, #2f3542 100%);
            box-shadow: 0 18px 30px rgba(15, 23, 42, 0.18);
        }

        .mini-pro::before {
            content: "RENT?";
            position: absolute;
            left: 50%;
            top: 17px;
            transform: translateX(-50%) rotate(-10deg);
            color: rgba(255,255,255,0.8);
            font-size: 12px;
            font-weight: 800;
            letter-spacing: .08em;
        }

        .mini-controller {
            position: absolute;
            right: 20px;
            bottom: 16px;
            width: 42px;
            height: 24px;
            border-radius: 16px;
            background: #1f2937;
        }
        .ps5-viewer-wrap {
  position: relative;
  width: 100%;
  max-width: 560px;
}

.ps5-viewer-wrap::after {
  content: "";
  position: absolute;
  left: 50%;
  bottom: 18px;
  transform: translateX(-50%);
  width: 65%;
  height: 45px;
  background: rgba(59, 130, 246, 0.45);
  filter: blur(28px);
  border-radius: 999px;
  z-index: 0;
}

.ps5-viewer-wrap model-viewer {
  position: relative;
  z-index: 1;
}
    </style>
</head>
<body>
    <div class="min-h-screen">
        @include('partials.navbar-main')

        <main>
            <section class=" mx-auto grid max-w-6xl grid-cols-1 items-center gap-12 px-6 py-16 md:grid-cols-2 md:py-10">
                <div class="max-w-xl">
                    <p class="mb-6 text-xs font-extrabold uppercase tracking-widest text-primary">Nouveau : PS5 Slim disponible</p>
                    <h1 class="max-w-md text-5xl font-black leading-none tracking-tight text-gray-900 md:text-6xl">
                        Jouez au
                        <br>
                        dernière
                        <br>
                        consoles,<span class="text-primary">chez vous</span>
                    </h1>
                    <p class="mt-6 max-w-md text-base leading-7 text-gray-500">
                        Louez votre console préférée à partir de 100 DH/jour. Livraison rapide, jeux inclus et plaisir garanti sans engagement
                    </p>

                    <div class="mt-8 flex flex-wrap gap-4">
                        <a href="/catalogue" class="rounded-xl bg-primary px-6 py-3 text-sm font-bold text-white shadow-lg shadow-blue-200">
                            Voir le catalogue
                        </a>
                        <a href="#" class="rounded-xl border border-gray-200 bg-white px-6 py-3 text-sm font-bold text-gray-700">
                            Comment ça marche ?
                        </a>
                    </div>
                </div>

                <div class="flex justify-center md:justify-end">
                    <div class="ps5-viewer-wrap ">
                    <model-viewer
                        src="/models/ps5.glb"
                        alt="PlayStation 5"
                        auto-rotate
                        camera-orbit="270deg 75deg auto"
                        rotation-per-second="25deg"
                        interaction-prompt="none"
                        reveal="auto"
                        shadow-intensity="1.5"
                        shadow-blur="1" shadow-softness="1.5"
                        class="overflow-visible"
                        style="width: 100%; max-width: 560px; height: 380px; background: transparent;"
                    ></model-viewer>
                    </div>
                </div>
            </section>

            <section class="border-t border-gray-100 bg-white/60">
                <div class="mx-auto max-w-6xl px-6 py-16">
                    <h2 class="text-center text-3xl font-extrabold tracking-tight text-gray-900">Pourquoi choisir PLAYSTAYHOME ?</h2>

                    <div class="mt-12 grid grid-cols-1 gap-6 md:grid-cols-3">
                        <article class="rounded-2xl border border-gray-100 bg-white p-8 shadow-sm">
                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 text-primary">
                                <i class="fa-solid fa-bolt"></i>
                            </div>
                            <h3 class="mt-6 text-lg font-bold text-gray-900">Tarification Dynamique</h3>
                            <p class="mt-3 text-sm leading-6 text-gray-500">
                                Des tarifs adaptés : 100 DH en semaine et une légère majoration le week-end pour plus de flexibilité.
                            </p>
                        </article>

                        <article class="rounded-2xl border border-gray-100 bg-white p-8 shadow-sm">
                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 text-primary">
                                <i class="fa-solid fa-tag"></i>
                            </div>
                            <h3 class="mt-6 text-lg font-bold text-gray-900">Coupons de Réduction</h3>
                            <p class="mt-3 text-sm leading-6 text-gray-500">
                                Utilisez vos codes promos directement lors de la réservation pour économiser sur vos sessions de jeu.
                            </p>
                        </article>

                        <article class="rounded-2xl border border-gray-100 bg-white p-8 shadow-sm">
                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 text-primary">
                                <i class="fa-solid fa-calendar-check"></i>
                            </div>
                            <h3 class="mt-6 text-lg font-bold text-gray-900">Réservation Simple</h3>
                            <p class="mt-3 text-sm leading-6 text-gray-500">
                                Choisissez vos dates sur notre calendrier intuitif et validez votre commande en quelques clics.
                            </p>
                        </article>
                    </div>
                </div>
            </section>

            <section class="mx-auto max-w-6xl px-6 py-16">
                <div class="flex flex-col gap-3 md:flex-row md:items-end md:justify-between">
                    <div>
                        <h2 class="text-3xl font-extrabold tracking-tight text-gray-900">Nos Consoles Disponible</h2>
                        <p class="mt-2 text-sm text-gray-500">Sélectionnez la plateforme de votre choix</p>
                    </div>
                    <a href="/catalogue" class="text-sm font-bold text-primary">Voir tout le catalogue <i class="fa-solid fa-arrow-right ml-1"></i></a>
                </div>

                <div id="containerConsoles" class="mt-10 grid grid-cols-1 gap-6 md:grid-cols-3">
                    <article class="console-card rounded-3xl p-4">
                        <div class="console-figure flex items-center justify-center">
                            <img src="https://gmedia.playstation.com/is/image/SIEPDC/ps5-product-thumbnail-01-en-14sep21?$native$" alt="PS5" class="h-32 object-contain">
                        </div>
                        <div class="mt-5">
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <h3 class="text-base font-bold text-gray-900">PlayStation 5 Slim</h3>
                                    <p class="mt-1 text-xs text-gray-400">Etat : Neuf</p>
                                </div>
                                <span class="rounded-full bg-green-100 px-2 py-1 text-[10px] font-bold uppercase tracking-wide text-green-600">Disponible</span>
                            </div>
                            <div class="mt-5 flex items-end justify-between">
                                <p class="text-3xl font-black text-primary">100 <span class="text-lg">DH</span><span class="ml-1 text-xs font-medium text-gray-400">/ jour</span></p>
                                <button class="flex h-8 w-8 items-center justify-center rounded-lg bg-gray-900 text-white">
                                    <i class="fa-solid fa-ellipsis-vertical text-xs"></i>
                                </button>
                            </div>
                        </div>
                    </article>

                    
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
                            Votre destination de référence pour la location de consoles haut de gamme et les dernières aventures vidéoludiques.
                        </p>
                    </div>

                    <div>
                        <h3 class="text-lg font-bold text-gray-900">Catalogue</h3>
                        <ul class="mt-5 space-y-3 text-sm text-gray-400">
                            <li><a href="#" class="hover:text-primary">Jeux PlayStation</a></li>
                            <li><a href="#" class="hover:text-primary">Consoles Xbox</a></li>
                            <li><a href="#" class="hover:text-primary">Exclusivités Nintendo</a></li>
                            <li><a href="#" class="hover:text-primary">Accessoires PC</a></li>
                        </ul>
                    </div>

                    <div>
                        <h3 class="text-lg font-bold text-gray-900">Support</h3>
                        <ul class="mt-5 space-y-3 text-sm text-gray-400">
                            <li><a href="#" class="hover:text-primary">Mon Compte</a></li>
                            <li><a href="#" class="hover:text-primary">Infos Livraison</a></li>
                            <li><a href="#" class="hover:text-primary">Suivi de Commande</a></li>
                            <li><a href="#" class="hover:text-primary">Politique de Confidentialité</a></li>
                        </ul>
                    </div>

                    <div>
                        <h3 class="text-lg font-bold text-gray-900">Restez informé</h3>
                        <form class="mt-5 flex items-center gap-3">
                            <input type="email" placeholder="E-mail" class="h-11 w-full rounded-xl border border-gray-200 bg-white px-4 text-sm text-gray-700 outline-none">
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
                    <p>© 2026 <strong>PLAYSTAYHOME</strong>. Tous droits réservés.</p>
                    <div class="flex items-center gap-6">
                        <span>Français (FR)</span>
                        <span>DH</span>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <script>
        window.addEventListener('load', function () {
        const viewer = document.getElementById('ps5Viewer');

        viewer.addEventListener('load', () => {
            viewer.autoRotate = true;
        });
    });

    let count=0;
    let container=document.getElementById("containerConsoles");
    
    
    getConsoles();
    async function getConsoles(){
    let res=await fetch("http://playstayhome.test/api/consoles",{
        "headers":{'Accept' : 'application/json' }
    });
    let consoles=await res.json();
    console.log(consoles);
    container.innerHTML="";
    consoles.forEach(console=>{
        if(count>=6) return;
        
        let gamesHtml = '';
        if (console.games && console.games.length > 0) {
            console.games.forEach(game => {
                gamesHtml += `
                    <div class="px-3 py-2 text-sm text-gray-700 font-medium hover:bg-blue-50 hover:text-primary cursor-default rounded-lg transition-colors truncate">
                        • ${game.title}
                    </div>
                `;
            });
        } else {
            gamesHtml = `<div class="px-3 py-3 text-xs text-gray-400 italic text-center">Aucun jeu inclus</div>`;
        }

        const isAvailable = !!console.ability;
        const statusLabel = isAvailable ? 'Disponible' : 'Non disponible';
        const statusClass = isAvailable ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600';
        const cardClass = isAvailable ? '' : ' locked';
        const lockBadge = isAvailable
            ? ''
            : '<span class="absolute top-3 right-3 z-20 inline-flex h-10 w-10 items-center justify-center rounded-full bg-red-100 text-red-600 shadow-md pointer-events-none"><i class="fa-solid fa-lock text-base"></i></span>';
        
        container.innerHTML += `<article class="console-card rounded-3xl p-4 relative${cardClass}">
                        ${lockBadge}
                        <div class="console-figure flex items-center justify-center">
                            <img src="${console.image}" alt="${console.name}" class="h-32 object-contain">
                        </div>
                        <div class="mt-5">
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <h3 class="text-base font-bold text-gray-900">${console.name}</h3>
                                    <p class="mt-1 text-xs text-gray-400">Brand : ${console.brand}</p>
                                </div>
                                <span class="rounded-full px-2 py-1 text-[10px] font-bold uppercase tracking-wide ${statusClass}">${statusLabel}</span>
                            </div>
                            <div class="mt-5 flex items-end justify-between relative">
                                <p class="text-3xl font-black text-primary">${console.daily_price} <span class="text-lg">DH</span><span class="ml-1 text-xs font-medium text-gray-400">/ jour</span></p>
                                
                                <div class="relative">
                                    <button onclick="toggleConsoleMenu(${console.id}); event.stopPropagation();" class="flex h-8 w-8 items-center justify-center rounded-lg bg-gray-900 text-white hover:bg-gray-800 transition-colors">
                                        <i class="fa-solid fa-ellipsis-vertical text-xs"></i>
                                    </button>
                                    
                                    <!-- Menu Déroulant -->
                                    <div id="console-menu-${console.id}" class="hidden absolute right-0 bottom-10 w-56 rounded-xl bg-white shadow-xl border border-gray-100 z-50 overflow-hidden transform origin-bottom-right transition-all">
                                        <div class="p-3 bg-gray-50 border-b border-gray-100">
                                            <p class="text-[10px] font-black text-gray-500 uppercase tracking-widest"><i class="fa-solid fa-gamepad mr-1"></i> Jeux Inclus</p>
                                        </div>
                                        <div class="p-2 max-h-40 overflow-y-auto" onclick="event.stopPropagation();">
                                            ${gamesHtml}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>`
                    count++;
    })
    }

    function toggleConsoleMenu(id) {
        const menu = document.getElementById(`console-menu-${id}`);
        const isHidden = menu.classList.contains('hidden');
        
        // Cacher tous les autres menus d'abord
        document.querySelectorAll('[id^="console-menu-"]').forEach(el => {
            el.classList.add('hidden');
        });

        // Afficher ou cacher le menu cliqué
        if (isHidden) {
            menu.classList.remove('hidden');
        }
    }

    // Fermer le menu lors d'un clic en dehors
    document.addEventListener('click', function(event) {
        document.querySelectorAll('[id^="console-menu-"]').forEach(el => {
            el.classList.add('hidden');
        });
    });
    
    </script>
</body>
</html>
