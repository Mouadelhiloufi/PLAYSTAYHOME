<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title data-i18n="contactPage.meta.title">Contactez-nous - playstayhome</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f6f7f8;
            color: #0f172a;
        }

        .text-primary {
            color: #2f6bff;
        }

        .bg-primary {
            background-color: #2f6bff;
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
    </style>
</head>
<body class="min-h-screen">
    <div class="flex min-h-screen flex-col">
        @include('partials.navbar-main')

        <main class="flex-1">
            <section class="mx-auto max-w-6xl px-6 py-12 md:py-20">
                <div class="mb-12">
                    <h1 class="mb-4 text-4xl font-black tracking-tight text-gray-900 md:text-5xl" data-i18n="contactPage.title">Contactez-nous</h1>
                    <p class="max-w-2xl text-lg text-gray-600" data-i18n="contactPage.subtitle">
                        Nous sommes là pour vous aider à trouver la console idéale ou répondre à toutes vos questions sur nos services.
                    </p>
                </div>

                <div class="grid grid-cols-1 gap-12 lg:grid-cols-2">
                    <div class="rounded-xl border border-gray-200 bg-white p-8 shadow-sm">
                        <form class="flex flex-col gap-6">
                            <div class="flex flex-col gap-2">
                                <label class="text-sm font-semibold text-gray-900" data-i18n="contactPage.form.fullName">Nom complet</label>
                                <input type="text" placeholder="Jean Dupont" data-i18n-placeholder="contactPage.form.fullNamePlaceholder" class="h-12 w-full rounded-lg border border-gray-300 bg-white px-4 text-gray-900 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                            </div>

                            <div class="flex flex-col gap-2">
                                <label class="text-sm font-semibold text-gray-900" data-i18n="contactPage.form.email">E-mail</label>
                                <input type="email" placeholder="jean@example.com" data-i18n-placeholder="contactPage.form.emailPlaceholder" class="h-12 w-full rounded-lg border border-gray-300 bg-white px-4 text-gray-900 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                            </div>

                            <div class="flex flex-col gap-2">
                                <label class="text-sm font-semibold text-gray-900" data-i18n="contactPage.form.subject">Sujet</label>
                                <input type="text" placeholder="Comment pouvons-nous vous aider ?" data-i18n-placeholder="contactPage.form.subjectPlaceholder" class="h-12 w-full rounded-lg border border-gray-300 bg-white px-4 text-gray-900 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                            </div>

                            <div class="flex flex-col gap-2">
                                <label class="text-sm font-semibold text-gray-900" data-i18n="contactPage.form.message">Message</label>
                                <textarea rows="4" placeholder="Votre message ici..." data-i18n-placeholder="contactPage.form.messagePlaceholder" class="w-full rounded-lg border border-gray-300 bg-white p-4 text-gray-900 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100"></textarea>
                            </div>

                            <button class="flex w-full items-center justify-center gap-2 rounded-lg py-4 font-bold text-white shadow-lg" style="background-color: #1978e5;">
                                <i class="fa-regular fa-paper-plane"></i>
                                <span data-i18n="contactPage.form.submit">Envoyer le message</span>
                            </button>
                        </form>
                    </div>

                    <div class="flex flex-col gap-6">
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <div class="flex flex-col gap-3 rounded-xl border border-gray-200 bg-white p-6">
                                <div class="flex h-10 w-10 items-center justify-center rounded-full text-primary" style="background-color: rgba(25, 120, 229, 0.1);">
                                    <i class="fa-solid fa-phone"></i>
                                </div>
                                <h3 class="font-bold text-gray-900" data-i18n="contactPage.cards.callUs">Appelez-nous</h3>
                                <p class="text-sm text-gray-600">+212 (0) 600-000000</p>
                                <p class="text-xs text-gray-500" data-i18n="contactPage.cards.callHours">Lun-Ven : 9h - 18h</p>
                            </div>

                            <div class="flex flex-col gap-3 rounded-xl border border-gray-200 bg-white p-6">
                                <div class="flex h-10 w-10 items-center justify-center rounded-full text-primary" style="background-color: rgba(25, 120, 229, 0.1);">
                                    <i class="fa-regular fa-envelope"></i>
                                </div>
                                <h3 class="font-bold text-gray-900" data-i18n="contactPage.cards.email">E-mail</h3>
                                <p class="text-sm text-gray-600">support@playstayhome.com</p>
                                <p class="text-xs text-gray-500" data-i18n="contactPage.cards.emailHint">Réponse rapide sous 24h</p>
                            </div>

                            <div class="flex flex-col gap-3 rounded-xl border border-gray-200 bg-white p-6">
                                <div class="flex h-10 w-10 items-center justify-center rounded-full text-primary" style="background-color: rgba(25, 120, 229, 0.1);">
                                    <i class="fa-solid fa-location-dot"></i>
                                </div>
                                <h3 class="font-bold text-gray-900" data-i18n="contactPage.cards.visit">Visitez-nous</h3>
                                <p class="text-sm leading-relaxed text-gray-600">123 Rue Principale,<br>Casablanca, Maroc</p>
                            </div>

                            <div class="flex flex-col gap-3 rounded-xl border border-gray-200 bg-white p-6">
                                <div class="flex h-10 w-10 items-center justify-center rounded-full text-primary" style="background-color: rgba(25, 120, 229, 0.1);">
                                    <i class="fa-solid fa-share-nodes"></i>
                                </div>
                                <h3 class="font-bold text-gray-900" data-i18n="contactPage.cards.social">Réseaux sociaux</h3>
                                <div class="flex gap-4 text-gray-500">
                                    <a href="#" class="hover:text-blue-600"><i class="fa-solid fa-globe"></i></a>
                                    <a href="#" class="hover:text-blue-600"><i class="fa-solid fa-users"></i></a>
                                    <a href="#" class="hover:text-blue-600"><i class="fa-solid fa-camera"></i></a>
                                </div>
                            </div>
                        </div>

                        <div class="relative min-h-80 overflow-hidden rounded-xl border border-gray-200 shadow-inner">
                            <div
                                class="absolute inset-0 bg-cover bg-center"
                                style="background-image: linear-gradient(rgba(15, 23, 42, 0.24), rgba(15, 23, 42, 0.24)), url('https://lh3.googleusercontent.com/aida-public/AB6AXuA3sA8GXsoYaa-tEk9ZoOTIQwoo5hgPs3KJ6Tz9PRe_dpoDQ9pvQDQt4i0ZZM8b5PIuoDsifd_6U5-ArympLBqoIYX-qLBp2L7NqLU0UGAPepQ278uiLQ_nXtIzlINqOB7M20wOi7DtsKbNDV8LPOLT8q8yKBYocMXccloASNnkh3XPPvI_GiXtKmd7fQQOIkkMbF9q6MynIyaNyIjSguI0kOX0sfgYC83nnwbtShCtPC1bOVjiAjKshOxg5y2TuyEfsj4RRwZem4Sl');"
                            ></div>
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="flex h-14 w-14 items-center justify-center rounded-full text-white shadow-xl" style="background-color: #1978e5;">
                                    <i class="fa-solid fa-location-dot text-lg"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        @include('partials.footer-main')
    </div>
</body>
</html>
