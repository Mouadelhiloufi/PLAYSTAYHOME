<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>playstayhome</title>
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/site-logo-navbar.png') }}?v=5">
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/site-logo-navbar.png') }}?v=5">
    <link rel="apple-touch-icon" href="{{ asset('images/site-logo-navbar.png') }}?v=5">
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

        .reserve-modal-overlay {
            background: rgba(15, 23, 42, 0.55);
            backdrop-filter: blur(6px);
        }

        .reserve-modal-card {
            background: linear-gradient(180deg, #ffffff 0%, #f8fbff 100%);
            border: 1px solid #e7eef8;
            box-shadow: 0 30px 70px rgba(15, 23, 42, 0.16);
        }

        .reserve-nav-btn {
            width: 44px;
            height: 44px;
            border-radius: 999px;
            background: #ffffff;
            border: 1px solid #dbe5f3;
            color: #1978e5;
            box-shadow: 0 10px 24px rgba(15, 23, 42, 0.08);
            transition: transform .2s ease, box-shadow .2s ease, background .2s ease;
        }

        .reserve-nav-btn:hover {
            transform: translateY(-1px);
            background: #f8fbff;
            box-shadow: 0 14px 30px rgba(15, 23, 42, 0.12);
        }

        .reserve-game-pill {
            background: rgba(25, 120, 229, 0.08);
            color: #174ea6;
        }

        /* Scrollbar custom pour les jeux dans le modal */
        .games-scroll-container {
            display: flex;
            overflow-x: auto;
            gap: 1rem;
            padding-bottom: 0.5rem;
            scrollbar-width: thin;
            scrollbar-color: #cbd5e1 transparent;
            min-width: 0;
            -webkit-overflow-scrolling: touch;
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

        /* Afficher ~3 jeux max (le reste en scroll) */
        .games-scroll-3 {
            max-width: calc((50px * 3) + (1rem * 2));
        }
    </style>
</head>
<body>
    <div class="min-h-screen">
        @include('partials.navbar-main')

        <main>
            <section class=" mx-auto grid max-w-6xl grid-cols-1 items-center gap-12 px-6 py-16 md:grid-cols-2 md:py-10">
                <div class="max-w-xl">
                    <p class="mb-6 text-xs font-extrabold uppercase tracking-widest text-primary" data-i18n="home.hero.badge">Nouveau : PS5 Slim disponible</p>
                    <h1 class="max-w-md text-5xl font-black leading-none tracking-tight text-gray-900 md:text-6xl" data-i18n="home.hero.titleHtml" data-i18n-html="true">
                        Jouez au<br>dernière<br>consoles,<span class="text-primary">chez vous</span>
                    </h1>
                    <p class="mt-6 max-w-md text-base leading-7 text-gray-500" data-i18n="home.hero.subtitle">
                        Louez votre console préférée à partir de 100 DH/jour. Livraison rapide, jeux inclus et plaisir garanti sans engagement
                    </p>

                    <div class="mt-8 flex flex-wrap gap-4">
                        <button type="button" id="openQuickReserve" class="relative z-10 inline-flex items-center gap-2 rounded-xl bg-primary px-6 py-3 text-sm font-bold text-white shadow-lg shadow-blue-200 transition-transform hover:-translate-y-0.5 hover:bg-blue-700">
                            <i class="fa-solid fa-bolt text-sm" aria-hidden="true"></i>
                            <span data-i18n="home.hero.ctaReserveNow">Réserver maintenant</span>
                        </button>
                        <a href="/catalogue" class="rounded-xl border border-gray-200 bg-white px-6 py-3 text-sm font-bold text-gray-700 shadow-sm transition-colors hover:bg-gray-50 hover:text-gray-900">
                            <span data-i18n="home.hero.ctaCatalogue">Voir le catalogue</span>
                        </a>
                    </div>
                </div>

                <div class="flex justify-center md:justify-end">
                    <div class="ps5-viewer-wrap">
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

            <div id="quickReserveModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 reserve-modal-overlay" aria-hidden="true">
                <div class="reserve-modal-card w-full max-w-3xl rounded-3xl md:rounded-4xl p-5 md:p-6 max-h-[95vh] overflow-y-auto" role="dialog" aria-labelledby="quickReserveTitle">
                    <div class="flex items-start justify-between gap-4 border-b border-gray-100 pb-4 shrink-0">
                        <div class="min-w-0 flex-1">
                            <p class="text-[10px] font-black uppercase tracking-[0.28em] text-primary truncate" data-i18n="home.quickReserve.kicker">Réservation rapide</p>
                            <h2 id="quickReserveTitle" class="mt-2 text-lg sm:text-xl md:text-2xl font-black tracking-tight text-gray-900 leading-tight" data-i18n="home.quickReserve.title">Choisis une console et réserve en une minute</h2>
                            <p class="mt-1 text-xs md:text-sm text-gray-500 leading-relaxed truncate whitespace-normal" data-i18n="home.quickReserve.subtitle">Parcours les consoles avec les flèches puis clique sur réserver.</p>
                        </div>
                        <button type="button" id="quickReserveClose" class="shrink-0 inline-flex h-10 w-10 items-center justify-center rounded-full bg-gray-100 text-gray-600 hover:bg-gray-200 hover:text-gray-900 transition-colors" aria-label="Fermer">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>

                    <div class="mt-5 sm:mt-6 grid gap-6 md:gap-10 lg:grid-cols-2 lg:items-center flex-1 min-h-0">
                        <div class="rounded-3xl bg-gradient-to-b from-gray-50 to-white p-4 md:p-6 shadow-inner border border-gray-100 flex flex-col justify-between min-h-[200px] md:min-h-[300px]">
                            
                            <div class="flex justify-between items-start w-full mb-4 shrink-0">
                                <p id="quickReserveHint" class="text-[10px] md:text-xs font-semibold text-gray-500 bg-white/80 px-3 py-1 rounded-full shadow-sm backdrop-blur-sm border border-gray-100">Console 1 sur 1</p>
                                <p id="quickReserveStatus" class="inline-flex items-center rounded-full bg-green-100 px-3 py-1 text-[10px] font-black uppercase tracking-widest text-green-700" data-i18n="common.available">Disponible</p>
                            </div>

                            <div class="flex items-center justify-between gap-2 md:gap-4 w-full flex-1 min-h-0">
                                <button type="button" id="quickReservePrev" class="reserve-nav-btn shrink-0 inline-flex items-center justify-center z-10 shadow-sm" aria-label="Console précédente">
                                    <i class="fa-solid fa-chevron-left"></i>
                                </button>

                                <div class="flex-1 flex items-center justify-center min-w-0 px-2 h-full">
                                    <img id="quickReserveConsoleImage" src="{{ asset('images/site-logo-navbar.png') }}" alt="Console" class="h-32 sm:h-40 md:h-52 lg:h-60 max-w-full object-contain drop-shadow-xl transition-all duration-300">
                                </div>

                                <button type="button" id="quickReserveNext" class="reserve-nav-btn shrink-0 inline-flex items-center justify-center z-10 shadow-sm" aria-label="Console suivante">
                                    <i class="fa-solid fa-chevron-right"></i>
                                </button>
                            </div>
                        </div>

                        <div class="flex flex-col justify-center space-y-4 md:space-y-6 min-w-0">
                            <div class="min-w-0">
                                <p id="quickReserveConsoleBrand" class="text-xs md:text-sm font-bold uppercase tracking-[0.2em] text-primary truncate">Brand</p>
                                <h3 id="quickReserveConsoleName" class="mt-1 text-2xl sm:text-3xl md:text-4xl font-black tracking-tight text-gray-900 leading-none truncate whitespace-normal break-words">Console</h3>
                                <p id="quickReserveConsolePrice" class="mt-2 md:mt-3 text-xl sm:text-2xl md:text-3xl font-black text-gray-900">-- DH <span class="text-xs sm:text-sm md:text-lg font-medium text-gray-500" data-i18n="common.perDay">/ jour</span></p>
                            </div>

                            <div class="rounded-2xl bg-gray-50 p-3 md:p-4 border border-gray-100 min-w-0">
                                <p class="text-[10px] md:text-xs font-black uppercase tracking-widest text-gray-500 mb-2 flex items-center gap-2">
                                    <i class="fa-solid fa-gamepad text-gray-400"></i> <span data-i18n="common.gamesIncluded">Jeux inclus</span>
                                </p>
                                <div id="quickReserveConsoleGames" class="games-scroll-container mt-2"></div>
                            </div>

                            <button type="button" id="quickReserveReserve" class="w-full inline-flex items-center justify-center gap-2 md:gap-3 rounded-xl md:rounded-2xl bg-primary px-6 md:px-8 py-3 sm:py-4 text-sm sm:text-base font-black text-white shadow-xl shadow-blue-200/50 transition-all hover:-translate-y-1 hover:shadow-2xl hover:shadow-blue-200 hover:bg-blue-700 active:translate-y-0">
                                
                                <span data-i18n="common.reserveThisConsole">Réserver cette console</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <section class="border-t border-gray-100 bg-white/60">
                <div class="mx-auto max-w-6xl px-6 py-16">
                    <h2 class="text-center text-3xl font-extrabold tracking-tight text-gray-900" data-i18n="home.features.title">Pourquoi choisir PLAYSTAYHOME ?</h2>

                    <div class="mt-12 grid grid-cols-1 gap-6 md:grid-cols-3">
                        <article class="rounded-2xl border border-gray-100 bg-white p-8 shadow-sm">
                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 text-primary">
                                <i class="fa-solid fa-bolt"></i>
                            </div>
                            <h3 class="mt-6 text-lg font-bold text-gray-900" data-i18n="home.features.f1Title">Tarification Dynamique</h3>
                            <p class="mt-3 text-sm leading-6 text-gray-500" data-i18n="home.features.f1Desc">
                                Des tarifs adaptés : 100 DH en semaine et une légère majoration le week-end pour plus de flexibilité.
                            </p>
                        </article>

                        <article class="rounded-2xl border border-gray-100 bg-white p-8 shadow-sm">
                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 text-primary">
                                <i class="fa-solid fa-tag"></i>
                            </div>
                            <h3 class="mt-6 text-lg font-bold text-gray-900" data-i18n="home.features.f2Title">Coupons de Réduction</h3>
                            <p class="mt-3 text-sm leading-6 text-gray-500" data-i18n="home.features.f2Desc">
                                Utilisez vos codes promos directement lors de la réservation pour économiser sur vos sessions de jeu.
                            </p>
                        </article>

                        <article class="rounded-2xl border border-gray-100 bg-white p-8 shadow-sm">
                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 text-primary">
                                <i class="fa-solid fa-calendar-check"></i>
                            </div>
                            <h3 class="mt-6 text-lg font-bold text-gray-900" data-i18n="home.features.f3Title">Réservation Simple</h3>
                            <p class="mt-3 text-sm leading-6 text-gray-500" data-i18n="home.features.f3Desc">
                                Choisissez vos dates sur notre calendrier intuitif et validez votre commande en quelques clics.
                            </p>
                        </article>
                    </div>
                </div>
            </section>

            <section class="mx-auto max-w-6xl px-6 py-16">
                <div class="flex flex-col gap-3 md:flex-row md:items-end md:justify-between">
                    <div>
                        <h2 class="text-3xl font-extrabold tracking-tight text-gray-900" data-i18n="home.consoles.title">Nos Consoles Disponible</h2>
                        <p class="mt-2 text-sm text-gray-500" data-i18n="home.consoles.subtitle">Sélectionnez la plateforme de votre choix</p>
                    </div>
                    <a href="/catalogue" class="text-sm font-bold text-primary"><span data-i18n="home.consoles.viewAll">Voir tout le catalogue</span> <i class="fa-solid fa-arrow-right ml-1"></i></a>
                </div>

                <div id="containerConsoles" class="mt-10 grid grid-cols-1 gap-6 md:grid-cols-3"></div>
            </section>
        </main>

        @include('partials.footer-main')
    </div>
    <script>
        function t(key, fallback, options = {}) {
            try {
                if (window.PSH_I18N && typeof window.PSH_I18N.t === 'function') {
                    return window.PSH_I18N.t(key, { defaultValue: fallback, ...options });
                }
            } catch (e) {}
            return fallback;
        }

        const container = document.getElementById('containerConsoles');
        const quickReserveOpen = document.getElementById('openQuickReserve');
        const quickReserveModal = document.getElementById('quickReserveModal');
        const quickReserveClose = document.getElementById('quickReserveClose');
        const quickReservePrev = document.getElementById('quickReservePrev');
        const quickReserveNext = document.getElementById('quickReserveNext');
        const quickReserveReserve = document.getElementById('quickReserveReserve');
        const quickReserveConsoleImage = document.getElementById('quickReserveConsoleImage');
        const quickReserveConsoleBrand = document.getElementById('quickReserveConsoleBrand');
        const quickReserveConsoleName = document.getElementById('quickReserveConsoleName');
        const quickReserveConsolePrice = document.getElementById('quickReserveConsolePrice');
        const quickReserveConsoleGames = document.getElementById('quickReserveConsoleGames');
        const quickReserveStatus = document.getElementById('quickReserveStatus');
        const quickReserveHint = document.getElementById('quickReserveHint');
        const defaultConsoleImage = "{{ asset('images/site-logo-navbar.png') }}";

        let consoles = [];
        let quickReserveIndex = 0;

        function normalizeConsoleImage(image) {
            if (!image) {
                return defaultConsoleImage;
            }

            if (image.startsWith('http://') || image.startsWith('https://') || image.startsWith('/')) {
                return image;
            }

            return `/storage/${image}`;
        }

        function renderGamesList(consoleItem) {
            if (!consoleItem.games || consoleItem.games.length === 0) {
                return `<p class="w-full text-center text-[10px] text-gray-400 italic">${t('cataloguePage.noGames', 'Aucun jeu inclus')}</p>`;
            }

            return consoleItem.games.map(game => {
                const gameImage = game.image ? 
                    (game.image.startsWith('http://') || game.image.startsWith('https://') || game.image.startsWith('/') 
                        ? game.image 
                        : `/storage/${game.image}`)
                    : null;

                return `
                    <div class="flex flex-col items-center min-w-[50px] shrink-0">
                        <div class="h-12 w-12 rounded-lg border border-gray-200 bg-gray-50 flex items-center justify-center overflow-hidden shadow-sm">
                            ${gameImage 
                                ? `<img src="${gameImage}" alt="${game.title}" class="h-full w-full object-cover" loading="lazy" onerror="this.classList.add('hidden');this.nextElementSibling?.classList.remove('hidden')"><i class="fa-solid fa-gamepad text-gray-300 text-lg hidden"></i>` 
                                : `<i class="fa-solid fa-gamepad text-gray-300 text-lg"></i>`
                            }
                        </div>
                        <p class="mt-1.5 max-w-[4.5rem] text-center text-[9px] font-medium leading-tight text-gray-500 line-clamp-2" title="${game.title}">${game.title}</p>
                    </div>
                `;
            }).join('');
        }

        function openQuickReserveModal() {
            quickReserveModal.classList.remove('hidden');
            quickReserveModal.classList.add('flex');
            document.body.classList.add('overflow-hidden');
            if (consoles.length) {
                renderQuickReserve(quickReserveIndex);
            } else {
                quickReserveConsoleBrand.textContent = t('common.loading', 'Chargement...');
                quickReserveConsoleName.textContent = t('common.pleaseWait', 'Veuillez patienter');
                quickReserveConsolePrice.textContent = '-- DH / jour';
                quickReserveConsoleGames.innerHTML = `<span class="inline-flex items-center rounded-full bg-gray-100 px-3 py-2 text-xs font-medium text-gray-400">${t('common.loadingConsoles', 'Chargement des consoles...')}</span>`;
                quickReserveReserve.disabled = true;
                quickReserveReserve.classList.add('opacity-50', 'cursor-not-allowed');
            }
        }

        function closeQuickReserveModal() {
            quickReserveModal.classList.add('hidden');
            quickReserveModal.classList.remove('flex');
            document.body.classList.remove('overflow-hidden');
        }

        function renderQuickReserve(index) {
            if (!consoles.length) {
                return;
            }

            quickReserveIndex = (index + consoles.length) % consoles.length;
            const consoleItem = consoles[quickReserveIndex];
            const isAvailable = !!consoleItem.ability;
            const reserveUrl = `/reservation?console_id=${consoleItem.id}`;

            quickReserveConsoleImage.src = normalizeConsoleImage(consoleItem.image);
            quickReserveConsoleImage.alt = consoleItem.name || t('common.console', 'Console');
            quickReserveConsoleBrand.textContent = consoleItem.brand || t('common.unknownBrand', 'Marque inconnue');
            quickReserveConsoleName.textContent = consoleItem.name || t('common.console', 'Console');
            quickReserveConsolePrice.textContent = `${consoleItem.daily_price} DH ${t('common.perDay', '/ jour')}`;
            quickReserveConsoleGames.innerHTML = renderGamesList(consoleItem);

            quickReserveReserve.onclick = () => window.location.href = reserveUrl;
            quickReserveReserve.disabled = !isAvailable;
            quickReserveReserve.classList.toggle('opacity-50', !isAvailable);
            quickReserveReserve.classList.toggle('cursor-not-allowed', !isAvailable);

            quickReserveStatus.textContent = isAvailable ? t('common.available', 'Disponible') : t('common.unavailable', 'Non disponible');
            quickReserveStatus.className = isAvailable
                ? 'inline-flex items-center rounded-full bg-green-100 px-3 py-1 text-[10px] font-black uppercase tracking-widest text-green-700'
                : 'inline-flex items-center rounded-full bg-red-100 px-3 py-1 text-[10px] font-black uppercase tracking-widest text-red-700';

            quickReserveHint.textContent = t('home.quickReserve.hint', `Console ${quickReserveIndex + 1} sur ${consoles.length}`, { current: quickReserveIndex + 1, total: consoles.length });
        }

        function moveQuickReserve(step) {
            renderQuickReserve(quickReserveIndex + step);
        }

        if (quickReserveOpen) quickReserveOpen.addEventListener('click', openQuickReserveModal);
        if (quickReserveClose) quickReserveClose.addEventListener('click', closeQuickReserveModal);
        if (quickReservePrev) quickReservePrev.addEventListener('click', () => moveQuickReserve(-1));
        if (quickReserveNext) quickReserveNext.addEventListener('click', () => moveQuickReserve(1));

        if (quickReserveModal) {
            quickReserveModal.addEventListener('click', (event) => {
                if (event.target === quickReserveModal) {
                    closeQuickReserveModal();
                }
            });
        }

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') {
                closeQuickReserveModal();
            }
        });

        function renderHomeConsoleGrid() {
            if (!container) return;
            container.innerHTML = '';

            let count = 0;
            consoles.forEach(consoleItem => {
                if (count >= 6) return;

                let gamesHtml = '';
                if (consoleItem.games && consoleItem.games.length > 0) {
                    consoleItem.games.forEach(game => {
                        gamesHtml += `
                            <div class="px-3 py-2 text-sm text-gray-700 font-medium hover:bg-blue-50 hover:text-primary cursor-default rounded-lg transition-colors truncate">
                                • ${game.title}
                            </div>
                        `;
                    });
                } else {
                    gamesHtml = `<div class="px-3 py-3 text-xs text-gray-400 italic text-center">${t('cataloguePage.noGames', 'Aucun jeu inclus')}</div>`;
                }

                const isAvailable = !!consoleItem.ability;
                const statusLabel = isAvailable ? t('common.available', 'Disponible') : t('common.unavailable', 'Non disponible');
                const statusClass = isAvailable ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600';
                const cardClass = isAvailable ? '' : ' locked';
                const lockBadge = isAvailable
                    ? ''
                    : '<span class="absolute top-3 right-3 z-20 inline-flex h-10 w-10 items-center justify-center rounded-full bg-red-100 text-red-600 shadow-md pointer-events-none"><i class="fa-solid fa-lock text-base"></i></span>';

                const reserveUrl = `/reservation?console_id=${consoleItem.id}`;
                const openTag = isAvailable
                    ? `<a href="${reserveUrl}" class="block hover:-translate-y-0.5 transition-transform">`
                    : `<div class="block cursor-not-allowed">`;
                const closeTag = isAvailable ? `</a>` : `</div>`;

                container.innerHTML += `${openTag}<article class="console-card rounded-3xl p-4 relative${cardClass}">
                    ${lockBadge}
                    <div class="console-figure flex items-center justify-center">
                        <img src="${normalizeConsoleImage(consoleItem.image)}" alt="${consoleItem.name}" class="h-32 object-contain">
                    </div>
                    <div class="mt-5">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <h3 class="text-base font-bold text-gray-900">${consoleItem.name}</h3>
                                <p class="mt-1 text-xs text-gray-400">${t('common.brand', 'Marque')} : ${consoleItem.brand}</p>
                            </div>
                            <span class="rounded-full px-2 py-1 text-[10px] font-bold uppercase tracking-wide ${statusClass}">${statusLabel}</span>
                        </div>
                        <div class="mt-5 flex items-end justify-between relative">
                            <p class="text-3xl font-black text-primary">${consoleItem.daily_price} <span class="text-lg">DH</span><span class="ml-1 text-xs font-medium text-gray-400">${t('common.perDay', '/ jour')}</span></p>
                            
                            <div class="relative">
                                <button onclick="event.preventDefault(); event.stopPropagation(); toggleConsoleMenu(${consoleItem.id});" class="flex h-8 w-8 items-center justify-center rounded-lg bg-gray-900 text-white hover:bg-gray-800 transition-colors">
                                    <i class="fa-solid fa-ellipsis-vertical text-xs"></i>
                                </button>
                                
                                <div id="console-menu-${consoleItem.id}" class="hidden absolute right-0 bottom-10 w-56 rounded-xl bg-white shadow-xl border border-gray-100 z-50 overflow-hidden transform origin-bottom-right transition-all">
                                    <div class="p-3 bg-gray-50 border-b border-gray-100">
                                        <p class="text-[10px] font-black text-gray-500 uppercase tracking-widest"><i class="fa-solid fa-gamepad mr-1"></i> ${t('common.gamesIncluded', 'Jeux inclus')}</p>
                                    </div>
                                    <div class="p-2 max-h-40 overflow-y-auto" onclick="event.stopPropagation();">
                                        ${gamesHtml}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>${closeTag}`;
            });
        }

        async function getConsoles() {
            try {
                const res = await fetch('/api/consoles', {
                    headers: { 'Accept': 'application/json' }
                });

                consoles = await res.json();
                if (!Array.isArray(consoles)) {
                    consoles = [];
                }

                renderHomeConsoleGrid();

                if (consoles.length > 0) {
                    renderQuickReserve(0);
                }
            } catch (error) {
                console.error('Erreur chargement consoles :', error);
                if (quickReserveConsoleBrand) quickReserveConsoleBrand.textContent = t('common.error', 'Erreur');
                if (quickReserveConsoleName) quickReserveConsoleName.textContent = t('common.loadFailed', 'Chargement impossible');
                if (quickReserveConsolePrice) quickReserveConsolePrice.textContent = '-- DH';
                if (quickReserveConsoleGames) quickReserveConsoleGames.innerHTML = `<span class="inline-flex items-center rounded-full bg-gray-100 px-3 py-2 text-xs font-medium text-gray-400">${t('common.loadConsolesFailed', 'Impossible de charger les consoles')}</span>`;
            }
        }

        function toggleConsoleMenu(id) {
            const menu = document.getElementById(`console-menu-${id}`);
            if (!menu) return;

            const isHidden = menu.classList.contains('hidden');

            document.querySelectorAll('[id^="console-menu-"]').forEach(el => {
                el.classList.add('hidden');
            });

            if (isHidden) {
                menu.classList.remove('hidden');
            }
        }

        document.addEventListener('click', function () {
            document.querySelectorAll('[id^="console-menu-"]').forEach(el => {
                el.classList.add('hidden');
            });
        });

        getConsoles();

        window.addEventListener('psh:i18n:changed', () => {
            // Mettre à jour les textes injectés dynamiquement
            if (quickReserveModal && quickReserveModal.classList.contains('flex') && consoles.length) {
                renderQuickReserve(quickReserveIndex);
            }
            // Re-render la grille
            if (Array.isArray(consoles) && consoles.length) {
                renderHomeConsoleGrid();
            }
        });
    </script>
</body>
</html>
