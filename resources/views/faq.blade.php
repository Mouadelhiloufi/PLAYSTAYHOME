<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ - playstayhome</title>
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

        .border-primary {
            border-color: #1978e5;
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

        summary {
            list-style: none;
        }

        summary::-webkit-details-marker {
            display: none;
        }

        details .faq-chevron {
            transition: transform 0.25s ease;
        }

        details[open] .faq-chevron {
            transform: rotate(180deg);
        }
    </style>
</head>
<body class="min-h-screen">
    <div class="flex min-h-screen flex-col">
        @include('partials.navbar-main')

        <main class="mx-auto w-full max-w-4xl flex-1 px-4 py-10 lg:px-0">
            <section class="mb-10">
                <div class="flex flex-col gap-3">
                    <h1 class="text-4xl font-black tracking-tight text-gray-900 lg:text-5xl" data-i18n="faqPage.title">Foire Aux Questions</h1>
                    <p class="max-w-2xl text-lg text-gray-600" data-i18n="faqPage.subtitle" data-i18n-html="true">
                        Tout ce que vous devez savoir sur les produits et services <strong>PLAYSTAYHOME</strong>. Vous ne trouvez pas ce que vous cherchez ? Contactez notre équipe.
                    </p>
                </div>
            </section>

            <section class="mb-12">
                <div class="mb-6 flex items-center gap-3">
                    <i class="fa-solid fa-truck text-primary"></i>
                    <h2 class="text-2xl font-bold text-gray-900" data-i18n="faqPage.sections.delivery">Livraison et Installation</h2>
                </div>

                <div class="space-y-4">
                    <details open class="overflow-hidden rounded-xl border border-gray-200 bg-white">
                        <summary class="flex cursor-pointer items-center justify-between gap-6 p-5">
                            <p class="font-semibold text-gray-900" data-i18n="faqPage.q.deliveryTime">Combien de temps prend la livraison?</p>
                            <i class="fa-solid fa-chevron-down faq-chevron text-gray-500"></i>
                        </summary>
                        <div class="border-t border-gray-100 px-5 pb-5 pt-4 text-gray-600">
                            <span data-i18n="faqPage.a.deliveryTime">La livraison standard prend généralement 3 à 5 jours ouvrés selon votre localisation. Des options de livraison express sont disponibles lors du paiement pour une livraison en 1 à 2 jours.</span>
                        </div>
                    </details>

                    <details class="overflow-hidden rounded-xl border border-gray-200 bg-white">
                        <summary class="flex cursor-pointer items-center justify-between gap-6 p-5">
                            <p class="font-semibold text-gray-900" data-i18n="faqPage.q.proInstallation">Proposez-vous une installation professionnelle?</p>
                            <i class="fa-solid fa-chevron-down faq-chevron text-gray-500"></i>
                        </summary>
                        <div class="border-t border-gray-100 px-5 pb-5 pt-4 text-gray-600">
                            <span data-i18n="faqPage.a.proInstallation">Oui ! Nous proposons des services d'installation professionnelle dans la plupart des grandes villes. Vous pouvez sélectionner "Installation professionnelle" lors du processus de commande.</span>
                        </div>
                    </details>

                    <details class="overflow-hidden rounded-xl border border-gray-200 bg-white">
                        <summary class="flex cursor-pointer items-center justify-between gap-6 p-5">
                            <p class="font-semibold text-gray-900" data-i18n="faqPage.q.damaged">Que se passe-t-il si mon appareil arrive endommagé?</p>
                            <i class="fa-solid fa-chevron-down faq-chevron text-gray-500"></i>
                        </summary>
                        <div class="border-t border-gray-100 px-5 pb-5 pt-4 text-gray-600">
                            <span data-i18n="faqPage.a.damaged">Nous offrons une garantie de remplacement à 100% pour les articles endommagés à la livraison. Veuillez signaler tout dommage dans les 48 heures suivant la réception en contactant notre support avec des photos de l'emballage et du produit.</span>
                        </div>
                    </details>
                </div>
            </section>

            <section class="mb-12">
                <div class="mb-6 flex items-center gap-3">
                    <i class="fa-solid fa-credit-card text-primary"></i>
                    <h2 class="text-2xl font-bold text-gray-900" data-i18n="faqPage.sections.pricing">Tarifs et Paiements</h2>
                </div>

                <div class="space-y-4">
                    <details class="overflow-hidden rounded-xl border border-gray-200 bg-white">
                        <summary class="flex cursor-pointer items-center justify-between gap-6 p-5">
                            <p class="font-semibold text-gray-900" data-i18n="faqPage.q.payments">Quels moyens de paiement acceptez-vous?</p>
                            <i class="fa-solid fa-chevron-down faq-chevron text-gray-500"></i>
                        </summary>
                        <div class="border-t border-gray-100 px-5 pb-5 pt-4 text-gray-600">
                            <span data-i18n="faqPage.a.payments">Nous acceptons toutes les principales cartes bancaires (Visa, Mastercard, Amex), PayPal, et proposons des options de financement via Affirm pour les achats éligibles.</span>
                        </div>
                    </details>

                    <details class="overflow-hidden rounded-xl border border-gray-200 bg-white">
                        <summary class="flex cursor-pointer items-center justify-between gap-6 p-5">
                            <p class="font-semibold text-gray-900" data-i18n="faqPage.q.subscription">Y a-t-il des frais d'abonnement mensuels?</p>
                            <i class="fa-solid fa-chevron-down faq-chevron text-gray-500"></i>
                        </summary>
                        <div class="border-t border-gray-100 px-5 pb-5 pt-4 text-gray-600">
                            <span data-i18n="faqPage.a.subscription">Les fonctionnalités de base ne nécessitent pas d'abonnement, mais notre stockage cloud "Pro Home" et les fonctions avancées d'automatisation sont disponibles via un abonnement mensuel ou annuel.</span>
                        </div>
                    </details>
                </div>
            </section>

            <section class="mb-16">
                <div class="mb-6 flex items-center gap-3">
                    <i class="fa-solid fa-user-gear text-primary"></i>
                    <h2 class="text-2xl font-bold text-gray-900" data-i18n="faqPage.sections.account">Gestion du Compte</h2>
                </div>

                <div class="space-y-4">
                    <details class="overflow-hidden rounded-xl border border-gray-200 bg-white">
                        <summary class="flex cursor-pointer items-center justify-between gap-6 p-5">
                            <p class="font-semibold text-gray-900" data-i18n="faqPage.q.resetPassword">Comment réinitialiser mon mot de passe?</p>
                            <i class="fa-solid fa-chevron-down faq-chevron text-gray-500"></i>
                        </summary>
                        <div class="border-t border-gray-100 px-5 pb-5 pt-4 text-gray-600">
                            <span data-i18n="faqPage.a.resetPassword">Rendez-vous sur la page de connexion et cliquez sur "Mot de passe oublié". Nous vous enverrons un lien d'authentification à votre adresse e-mail pour définir un nouveau mot de passe.</span>
                        </div>
                    </details>

                    <details class="overflow-hidden rounded-xl border border-gray-200 bg-white">
                        <summary class="flex cursor-pointer items-center justify-between gap-6 p-5">
                            <p class="font-semibold text-gray-900" data-i18n="faqPage.q.multiUsers">Puis-je ajouter plusieurs utilisateurs à mon compte?</p>
                            <i class="fa-solid fa-chevron-down faq-chevron text-gray-500"></i>
                        </summary>
                        <div class="border-t border-gray-100 px-5 pb-5 pt-4 text-gray-600">
                            <span data-i18n="faqPage.a.multiUsers" data-i18n-html="true">Absolument. Dans les paramètres de l'application <strong>PLAYSTAYHOME</strong>, allez dans "Gérer le foyer" pour inviter des membres de la famille via leur adresse e-mail.</span>
                        </div>
                    </details>
                </div>
            </section>

            <section class="rounded-2xl border px-8 py-10 text-center" style="background-color: rgba(25, 120, 229, 0.08); border-color: rgba(25, 120, 229, 0.18);">
                <div class="mx-auto flex max-w-2xl flex-col items-center gap-6">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900 lg:text-3xl" data-i18n="faqPage.cta.title">Vous avez encore des questions?</h3>
                        <p class="mt-2 text-gray-600" data-i18n="faqPage.cta.subtitle">Notre équipe de support est disponible 24h/24 et 7j/7 pour vous aider.</p>
                    </div>

                    <div class="flex flex-wrap justify-center gap-4">
                        <button class="flex items-center gap-2 rounded-lg px-8 py-3 font-bold text-white bg-primary">
                            <i class="fa-regular fa-comment-dots"></i>
                            <span data-i18n="faqPage.cta.liveChat">Chat en direct</span>
                        </button>
                        <button class="flex items-center gap-2 rounded-lg border border-gray-200 bg-white px-8 py-3 font-bold text-gray-900">
                            <i class="fa-regular fa-envelope"></i>
                            <span data-i18n="faqPage.cta.emailSupport">Support par e-mail</span>
                        </button>
                    </div>
                </div>
            </section>
        </main>

        @include('partials.footer-main')
    </div>
</body>
</html>
