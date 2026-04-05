<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogue - PLAYSTAIHOME</title>
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
                            <button class="flex w-full items-center justify-between rounded-xl border border-blue-100 bg-blue-50 px-3 py-2 text-sm font-semibold text-blue-700">
                                <span class="flex items-center gap-2"><i class="fab fa-playstation"></i> PlayStation</span>
                                <span class="h-3 w-3 rounded-full border border-blue-300"></span>
                            </button>
                            <button class="flex w-full items-center justify-between rounded-xl border border-green-100 bg-green-50 px-3 py-2 text-sm font-semibold text-green-700">
                                <span class="flex items-center gap-2"><i class="fa-brands fa-xbox"></i> Xbox</span>
                                <span class="h-3 w-3 rounded-full border border-green-300"></span>
                            </button>
                        </div>
                    </div>

                    <div class="panel p-5">
                        <div class="flex items-center justify-between">
                            <h3 class="text-xs font-bold uppercase tracking-widest text-gray-400">Prix max / jour</h3>
                            <span class="rounded-lg bg-blue-50 px-2 py-1 text-xs font-bold text-primary">300 DH</span>
                        </div>
                        <div class="mt-5 h-1 rounded-full bg-gray-200">
                            <div class="h-1 w-4/5 rounded-full bg-primary"></div>
                        </div>
                        <div class="mt-2 flex justify-between text-xs text-gray-400">
                            <span>50 DH</span>
                            <span>300 DH</span>
                        </div>
                    </div>

                    <div class="panel p-5">
                        <h3 class="text-xs font-bold uppercase tracking-widest text-gray-400">Etat</h3>
                        <div class="mt-4 flex flex-wrap gap-2">
                            <button class="rounded-full border border-gray-200 px-3 py-1 text-xs text-gray-500">Tous</button>
                            <button class="rounded-full border border-gray-200 px-3 py-1 text-xs text-gray-500">Neuf</button>
                            <button class="rounded-full border border-gray-200 px-3 py-1 text-xs text-gray-500">Excellent</button>
                            <button class="rounded-full border border-gray-200 px-3 py-1 text-xs text-gray-500">Reconditionne</button>
                        </div>
                    </div>

                    <button class="w-full rounded-xl bg-primary px-4 py-3 text-sm font-bold text-white shadow-md shadow-blue-200">
                        Appliquer
                    </button>
                    <button class="w-full text-sm font-semibold text-gray-300">
                        Reinitialiser les filtres
                    </button>
                </aside>

                <div class="catalog-content">
                    <div class="mb-3 flex items-center justify-between">
                        <h1 class="text-2xl font-black tracking-tight text-gray-900">Catalogue <span class="text-primary">(12)</span></h1>
                        <button class="rounded-xl border border-gray-200 bg-white px-4 py-2 text-sm font-semibold text-gray-500">
                            Trier par : Nouveautes
                        </button>
                    </div>

                    <div class="catalog-products">
                        <article class="panel catalog-card catalog-card-featured">
                            <div class="soft-box catalog-card-media">
                                <span class="inline-block rounded-full bg-blue-100 px-2 py-1 text-[9px] font-bold uppercase text-blue-700">PS5 Slim</span>
                                <div class="catalog-card-image">
                                    <img src="https://gmedia.playstation.com/is/image/SIEPDC/ps5-product-thumbnail-01-en-14sep21?$native$" alt="PS5" class="object-contain">
                                </div>
                            </div>
                            <div class="catalog-card-head">
                                <div class="w-full">
    <h3 class="catalog-card-title w-full text-lg">PlayStation 5 Slim</h3>
    <p class="mt-1 inline-block rounded bg-green-100 px-0.5 py-0 text-[8px] font-bold uppercase text-green-700">
        Etat : Neuf
    </p>
</div>
                                <div class="text-right">
                                    <p class="catalog-card-price">100 DH</p>
                                    <p class="text-[9px] text-gray-400">/ par jour</p>
                                </div>
                            </div>
                            <p class="catalog-card-note text-center text-[7px] font-bold uppercase tracking-wider text-gray-300">Jeux inclus avec la location</p>
                            <div class="catalog-card-games flex justify-center gap-4 text-center">
                                <div>
                                    <div class="mx-auto h-8 w-8 rounded-lg border border-gray-200 bg-gray-50"></div>
                                    <p class="mt-1 text-[7px] text-gray-300">FC 25</p>
                                </div>
                                <div>
                                    <div class="mx-auto h-8 w-8 rounded-lg border border-gray-200 bg-gray-50"></div>
                                    <p class="mt-1 text-[7px] text-gray-300">FC 24</p>
                                </div>
                            </div>
                            <button class="catalog-card-cta w-full rounded-xl bg-primary py-2 text-[10px] font-bold text-white">Reserver maintenant</button>
                        </article>

                        <article class="panel catalog-card catalog-card-featured">
                            <div class="soft-box catalog-card-media">
                                <span class="inline-block rounded-full bg-blue-100 px-2 py-1 text-[9px] font-bold uppercase text-blue-700">PS5 Slim</span>
                                <div class="catalog-card-image">
                                    <img src="https://gmedia.playstation.com/is/image/SIEPDC/ps5-product-thumbnail-01-en-14sep21?$native$" alt="PS5" class="object-contain">
                                </div>
                            </div>
                            <div class="catalog-card-head">
                                <div class="w-full">
    <h3 class="catalog-card-title w-full text-lg">PlayStation 5 Slim</h3>
    <p class="mt-1 inline-block rounded bg-green-100 px-0.5 py-0 text-[8px] font-bold uppercase text-green-700">
        Etat : Neuf
    </p>
</div>
                                <div class="text-right">
                                    <p class="catalog-card-price">100 DH</p>
                                    <p class="text-[9px] text-gray-400">/ par jour</p>
                                </div>
                            </div>
                            <p class="catalog-card-note text-center text-[7px] font-bold uppercase tracking-wider text-gray-300">Jeux inclus avec la location</p>
                            <div class="catalog-card-games flex justify-center gap-4 text-center">
                                <div>
                                    <div class="mx-auto h-8 w-8 rounded-lg border border-gray-200 bg-gray-50"></div>
                                    <p class="mt-1 text-[7px] text-gray-300">FC 25</p>
                                </div>
                                <div>
                                    <div class="mx-auto h-8 w-8 rounded-lg border border-gray-200 bg-gray-50"></div>
                                    <p class="mt-1 text-[7px] text-gray-300">FC 24</p>
                                </div>
                            </div>
                            <button class="catalog-card-cta w-full rounded-xl bg-primary py-2 text-[10px] font-bold text-white">Reserver maintenant</button>
                        </article>
                        
                    </div>
                </div>
            </section>
        </main>

        <footer class="border-t border-gray-200 bg-white">
            <div class="mx-auto max-w-6xl px-6 py-14">
                <div class="grid grid-cols-1 gap-12 md:grid-cols-4">
                    <div>
                        <div class="flex items-center gap-2 text-primary">
                            <i class="fab fa-playstation text-2xl opacity-50"></i>
                            <span class="text-2xl font-extrabold tracking-tight text-gray-900">PLAYSTAIHOME</span>
                        </div>
                        <p class="mt-5 max-w-xs text-sm leading-7 text-gray-400">
                            Your premier destination for high-end gaming equipment and the latest digital adventures.
                        </p>
                    </div>

                    <div>
                        <h3 class="text-lg font-bold text-gray-900">Catalog</h3>
                        <ul class="mt-5 space-y-3 text-sm text-gray-400">
                            <li><a href="#" class="hover:text-primary">PlayStation Games</a></li>
                            <li><a href="#" class="hover:text-primary">Xbox Consoles</a></li>
                            <li><a href="#" class="hover:text-primary">Nintendo Exclusives</a></li>
                            <li><a href="#" class="hover:text-primary">PC Peripherals</a></li>
                        </ul>
                    </div>

                    <div>
                        <h3 class="text-lg font-bold text-gray-900">Support</h3>
                        <ul class="mt-5 space-y-3 text-sm text-gray-400">
                            <li><a href="#" class="hover:text-primary">My Account</a></li>
                            <li><a href="#" class="hover:text-primary">Shipping Info</a></li>
                            <li><a href="#" class="hover:text-primary">Track Order</a></li>
                            <li><a href="#" class="hover:text-primary">Privacy Policy</a></li>
                        </ul>
                    </div>

                    <div>
                        <h3 class="text-lg font-bold text-gray-900">Stay Updated</h3>
                        <form class="mt-5 flex items-center gap-3">
                            <input type="email" placeholder="Email" class="h-11 w-full rounded-xl border border-gray-200 bg-white px-4 text-sm text-gray-700 outline-none">
                            <button type="submit" class="rounded-xl bg-primary px-5 py-3 text-sm font-bold text-white">
                                Join
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
                    <p>&copy; 2026 PLAYSTAIHOME. All rights reserved.</p>
                    <div class="flex items-center gap-6">
                        <span>English (US)</span>
                        <span>USD</span>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
