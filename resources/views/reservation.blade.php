<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation - playstayhome</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    
    <!-- Flatpickr pour le calendrier -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    
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
        body {
            font-family: 'Inter', sans-serif;
            background: #f8fafc;
            color: #111827;
        }

        .panel {
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(15, 23, 42, 0.03);
            border: 1px solid #f1f5f9;
        }

        /* Styles de la navigation */
        .nav-link {
            position: relative;
            display: inline-flex;
            align-items: center;
            height: 40px;
            font-size: 0.875rem; /* Réduit la taille générale de la police */
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
            background: #1978e5;
            transform: scaleX(0);
            transform-origin: center;
            transition: transform .2s ease;
        }

        .nav-link:hover,
        .nav-link.active {
            color: #1978e5;
        }

        .nav-link:hover::after,
        .nav-link.active::after {
            transform: scaleX(1);
        }

        /* Customizing Flatpickr to match the design */
        .flatpickr-calendar.inline {
            border: none;
            box-shadow: none;
            width: 100%;
            max-width: 320px;
            padding: 0;
            background: transparent;
        }
        .flatpickr-innerContainer {
            overflow: visible;
            display: block;
            width: 100%;
        }
        .flatpickr-rContainer {
            width: 100%;
        }
        .flatpickr-days {
            width: 100%;
        }
        .dayContainer {
            width: 100%;
            min-width: auto;
            max-width: 100%;
        }
        .flatpickr-day.selected, .flatpickr-day.startRange, .flatpickr-day.endRange, .flatpickr-day.selected.inRange, .flatpickr-day.startRange.inRange, .flatpickr-day.endRange.inRange, .flatpickr-day.selected:focus, .flatpickr-day.startRange:focus, .flatpickr-day.endRange:focus, .flatpickr-day.selected:hover, .flatpickr-day.startRange:hover, .flatpickr-day.endRange:hover, .flatpickr-day.selected.prevMonthDay, .flatpickr-day.startRange.prevMonthDay, .flatpickr-day.endRange.prevMonthDay, .flatpickr-day.selected.nextMonthDay, .flatpickr-day.startRange.nextMonthDay, .flatpickr-day.endRange.nextMonthDay {
            background: #1978e5;
            border-color: #1978e5;
        }

        /* Styliser les jours désactivés (déjà réservés) en rouge clair barré */
        .flatpickr-day.flatpickr-disabled, .flatpickr-day.flatpickr-disabled:hover {
            cursor: not-allowed;
            color: #ef4444 !important; /* rouge */
            background: #fee2e2 !important; /* fond rouge clair */
            text-decoration: line-through; /* barré */
        }

        .confirm-modal-overlay {
            background: rgba(15, 23, 42, 0.45);
            backdrop-filter: blur(4px);
        }
        .confirm-modal-card {
            border-radius: 1.25rem;
            box-shadow: 0 25px 50px -12px rgba(15, 23, 42, 0.25);
            overflow: hidden;
            max-width: 28rem;
            width: 100%;
            border: 1px solid #e2e8f0;
        }
        .confirm-modal-header {
            background: linear-gradient(135deg, #0f172a 0%, #1e3a5f 50%, #1978e5 100%);
            color: #fff;
            padding: 1.25rem 1.5rem;
            font-weight: 800;
            font-size: 1.125rem;
            letter-spacing: -0.02em;
            text-align: center;
        }
        .confirm-modal-body {
            background: #fff;
            padding: 1.5rem;
        }
        .confirm-field-label {
            font-size: 0.8125rem;
            font-weight: 700;
            color: #1978e5;
            margin-bottom: 0.35rem;
        }
        .confirm-input, .confirm-textarea {
            width: 100%;
            border: 1px solid #e2e8f0;
            border-radius: 0.75rem;
            padding: 0.75rem 1rem;
            font-size: 0.875rem;
            transition: border-color 0.15s, box-shadow 0.15s;
        }
        .confirm-input:focus, .confirm-textarea:focus {
            outline: none;
            border-color: #1978e5;
            box-shadow: 0 0 0 3px rgba(25, 120, 229, 0.15);
        }
        .confirm-phone-row {
            display: flex;
            border: 1px solid #e2e8f0;
            border-radius: 0.75rem;
            overflow: hidden;
            background: #fff;
        }
        .confirm-phone-prefix {
            padding: 0.75rem 0.85rem;
            background: #f8fafc;
            border-right: 1px solid #e2e8f0;
            font-size: 0.8125rem;
            font-weight: 700;
            color: #64748b;
            white-space: nowrap;
        }
        .confirm-phone-input {
            flex: 1;
            border: none;
            padding: 0.75rem 1rem;
            font-size: 0.875rem;
            min-width: 0;
        }
        .confirm-phone-input:focus {
            outline: none;
        }
        .confirm-hint {
            font-size: 0.6875rem;
            color: #94a3b8;
            font-style: italic;
            margin-top: 0.35rem;
        }

        /* Responsive: éviter le débordement du téléphone sur mobile */
        @media (max-width: 420px) {
            .confirm-modal-body {
                padding: 1.1rem;
            }

            .confirm-phone-row {
                flex-direction: column;
            }

            .confirm-phone-prefix {
                border-right: none;
                border-bottom: 1px solid #e2e8f0;
                width: 100%;
            }

            .confirm-phone-input {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="min-h-screen flex flex-col">
        @include('partials.navbar-main')

        <main class="grow mx-auto max-w-6xl px-6 py-10 w-full">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- Colonne de gauche : Choix des dates et Image -->
                <div class="lg:col-span-2 space-y-6">
                    <div class="panel p-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-5">Choisir les dates</h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <!-- Calendrier -->
                            <div class="bg-gray-50 rounded-xl p-4 flex justify-center items-center">
                                <input type="text" id="datePicker" class="hidden">
                            </div>
                            
                            <!-- Image de la console -->
                            <div class="bg-gray-50 rounded-xl p-6 flex justify-center items-center">
                                <img src="https://gmedia.playstation.com/is/image/SIEPDC/ps5-product-thumbnail-01-en-14sep21" alt="PlayStation 5 Slim" class="w-full max-w-xs object-contain drop-shadow-xl" id="consoleImage">
                            </div>
                        </div>

                        <!-- Alert info -->
                        <div class="bg-blue-50 border border-blue-100 rounded-xl p-3 flex items-center justify-between text-xs text-gray-600">
                            <span>Le tarif standard est majoré le weekend (Sam-Dim)</span>
                            <span class="font-bold text-primary" id="dailyPriceDisplay">-- DH / jour</span>
                        </div>
                    </div>
                </div>

                <!-- Colonne de droite : Récapitulatif -->
                <div class="lg:col-span-1">
                    <div class="panel p-6 sticky top-8">
                        <h2 class="text-lg font-bold text-gray-900 mb-5">Récapitulatif</h2>
                        
                        <!-- Produit sélectionné -->
                        <div class="flex items-center gap-4 bg-gray-50 p-3 rounded-xl mb-6">
                            <div class="bg-white p-2 rounded-lg border border-gray-200">
                                <img src="https://gmedia.playstation.com/is/image/SIEPDC/ps5-product-thumbnail-01-en-14sep21" alt="PS5" class="h-8 w-8 object-contain" id="recapImage">
                            </div>
                            <div>
                                <h3 class="font-bold text-sm text-gray-900" id="recapTitle">Chargement...</h3>
                                <p id="brand" class="text-[10px] text-gray-500 mt-0.5"></p>
                            </div>
                        </div>

                        <!-- Détails de réservation -->
                        <div class="space-y-3 mb-6">
                            <div class="flex justify-between items-center text-xs">
                                <span class="text-gray-500 font-medium">Durée</span>
                                <span class="font-bold text-gray-900" id="durationDisplay">0 jour</span>
                            </div>
                            <div class="flex justify-between items-center text-xs">
                                <span class="text-gray-500 font-medium">Dates</span>
                                <span class="font-bold text-gray-900 text-[10px]" id="datesDisplay">Non sélectionnées</span>
                            </div>
                        </div>

                        <!-- Manettes supplémentaires -->
                        <div class="mb-6">
                            <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-2">Manettes supplémentaires</label>
                            <div class="flex items-center justify-between bg-gray-50 p-2 rounded-xl border border-gray-200">
                                <div class="flex items-center gap-3">
                                    <div class="bg-white p-1 rounded-lg border border-gray-200">
                                        <!-- Image réelle de Google (Manette Xbox/PS5) -->
                                        <img src="https://cdn.kulturegeek.fr/wp-content/uploads/2022/08/DualSense-Edge-Manette-PS5.jpg" alt="Manette" class="h-8 w-8 object-contain">
                                    </div>
                                    <span id="prixManette" class="text-xs font-bold text-gray-900">Manettes (+0 DH)</span>
                                </div>
                                <div class="flex items-center bg-white rounded-lg border border-gray-200">
                                    <button type="button" id="btn-minus" class="w-8 h-8 flex items-center justify-center text-gray-600 hover:text-primary transition-colors disabled:opacity-30 disabled:cursor-not-allowed" disabled>
                                        <i class="fas fa-minus text-[10px]"></i>
                                    </button>
                                    <span id="manettes-count" class="w-6 text-center font-bold text-xs text-gray-900">1</span>
                                    <button type="button" id="btn-plus" class="w-8 h-8 flex items-center justify-center text-gray-600 hover:text-primary transition-colors disabled:opacity-30 disabled:cursor-not-allowed">
                                        <i class="fas fa-plus text-[10px]"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Coupon -->
                        <div class="mb-6">
                            <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-2">Coupon de réduction</label>
                            <div class="flex gap-2">
                                <input type="text" id="couponInput" placeholder="CODE10" class="grow rounded-lg border border-gray-200 px-3 py-1.5 text-xs focus:border-primary focus:outline-none">
                                <button type="button" id="btnApplyCoupon" class="bg-gray-900 hover:bg-gray-800 text-white px-4 py-1.5 rounded-lg text-xs font-bold transition-colors">OK</button>
                            </div>
                            <p id="couponAuthHint" class="hidden mt-1.5 text-[10px] font-medium text-amber-700">Les coupons nécessitent un compte connecté.</p>
                        </div>

                        <!-- Total -->
                        <div class="flex justify-between items-center mb-6 pt-5 border-t border-gray-100">
                            <span class="text-sm font-bold text-gray-900">Total</span>
                            <span class="text-xl font-black text-primary" id="totalDisplay">0 DH</span>
                        </div>

                        <button id="btnReserve" class="w-full bg-primary hover:bg-blue-600 text-white font-bold py-3 text-sm rounded-xl shadow-lg shadow-blue-200 transition-colors">
                            <span>Réserver maintenant</span>
                        </button>
                    </div>
                </div>
            </div>
        </main>

        @include('partials.footer-main')

        <!-- Modal confirmation (téléphone + adresse) -->
        <div id="confirmReservationModal" class="fixed inset-0 z-200 hidden items-center justify-center p-4 confirm-modal-overlay" aria-hidden="true">
            <div class="confirm-modal-card bg-white" role="dialog" aria-labelledby="confirmModalTitle">
                <div class="confirm-modal-header" id="confirmModalTitle">Confirmation de réservation</div>
                <div class="confirm-modal-body space-y-5">
                    <p class="text-xs text-gray-500 leading-relaxed">Indiquez vos coordonnées pour finaliser la location. Ces informations sont enregistrées avec votre réservation.</p>
                    <div>
                        <label class="confirm-field-label" for="confirmPhone">Numéro de téléphone</label>
                        <div class="confirm-phone-row">
                            <span class="confirm-phone-prefix" aria-hidden="true">+212</span>
                            <input type="tel" id="confirmPhone" class="confirm-phone-input" placeholder="6 12 34 56 78" autocomplete="tel" maxlength="20">
                        </div>
                        <p class="confirm-hint">Indicatif Maroc (+212). Saisissez votre numéro sans le préfixe international.</p>
                    </div>
                    <div>
                        <label class="confirm-field-label" for="confirmAddress">Adresse de livraison / domicile</label>
                        <textarea id="confirmAddress" class="confirm-textarea min-h-22 resize-y" rows="3" placeholder="Rue, quartier, ville..." maxlength="5000"></textarea>
                        <p class="confirm-hint">Adresse complète pour la livraison ou la prise en charge.</p>
                    </div>
                    <div class="flex flex-col-reverse sm:flex-row gap-2 pt-1">
                        <button type="button" id="btnConfirmReservationCancel" class="w-full sm:flex-1 rounded-xl border border-gray-200 py-3 text-sm font-bold text-gray-600 hover:bg-gray-50 transition-colors">Annuler</button>
                        <button type="button" id="btnConfirmReservationSubmit" class="w-full sm:flex-1 rounded-xl bg-primary py-3 text-sm font-bold text-white shadow-lg shadow-blue-200 hover:bg-blue-600 transition-colors">Confirmer la réservation</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts pour le calendrier -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/fr.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/ar.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        function t(key, fallback, options = {}) {
            return fallback;
        }

        function getCurrentLng() {
            return 'fr';
        }

        function getDateLocale(lng) {
            return 'fr-FR';
        }

        function formatDuration(days, lng) {
            if (lng === 'ar') {
                return `${days} ${t('reservation.duration.dayAr', 'يوم')}`;
            }
            const label = days === 1 ? t('reservation.duration.dayOne', 'jour') : t('reservation.duration.dayMany', 'jours');
            return `${days} ${label}`;
        }

        function getExtraControllerPrice(count) {
            if (count === 3) return 25;
            if (count === 4) return 50;
            return 0;
        }

        function buildAuthJsonHeaders() {
            const h = { 'Content-Type': 'application/json', 'Accept': 'application/json' };
            const t = localStorage.getItem('token');
            if (t) {
                h['Authorization'] = 'Bearer ' + t;
            }
            return h;
        }

        async function initPage() {
            // Recuperer l'ID de la console depuis l'URL
            const urlParams = new URLSearchParams(window.location.search);
            const consoleId = urlParams.get('console_id');

            // S'il n'y a pas de paramètre console dans l'URL on retourne au catalogue
            if (!consoleId) {
                await Swal.fire({
                    icon: 'warning',
                    title: t('reservation.validation.missingConsole.title', 'Console manquante'),
                    text: t('reservation.validation.missingConsole.text', 'Veuillez sélectionner une console depuis le catalogue.')
                });
                window.location.href = '/catalogue';
                return;
            }

            if (!localStorage.getItem('token')) {
                const hint = document.getElementById('couponAuthHint');
                const ci = document.getElementById('couponInput');
                const ba = document.getElementById('btnApplyCoupon');
                if (hint) {
                    hint.classList.remove('hidden');
                }
                if (ci) {
                    ci.disabled = true;
                    ci.classList.add('bg-gray-100', 'text-gray-400');
                }
                if (ba) {
                    ba.disabled = true;
                    ba.classList.add('opacity-50', 'cursor-not-allowed');
                }
            }

            let currentConsoleInfo = null;
            let reservedDatesArray = [];

            // 0. Fetch pour recuperer les dates deja reservees (Avant de creer le calendrier)
            try {
                let resDates = await fetch(`/api/consoles/${consoleId}/reserved-dates`, {
                    headers: { 'Accept': 'application/json' }
                });
                
                if (resDates.ok) {
                    reservedDatesArray = await resDates.json();
                } else {
                    console.error('Erreur SQL ou Serveur:', await resDates.text());
                }
            } catch (e) {
                console.error('Erreur recuperation dates :', e);
            }

            // Sécurité : Si l'API plante, on s'assure que Flatpickr reçoit bien un tableau vide au minimum
            if (!Array.isArray(reservedDatesArray)) {
                reservedDatesArray = [];
            }

            // --- Gestion des Manettes ---

            let manettePrix=document.getElementById("prixManette");
            let manettesCount = 1;
            const maxManettes = 4;
            const btnMinus = document.getElementById('btn-minus');
            const btnPlus = document.getElementById('btn-plus');
            const countDisplay = document.getElementById('manettes-count');
            let fp;
           
            

            function updateManettesCounter() {
                if(countDisplay) countDisplay.innerText = manettesCount;
                if(btnMinus) btnMinus.disabled = manettesCount <= 1;
                if(btnPlus) btnPlus.disabled = manettesCount >= maxManettes;
                const btnReserve = document.getElementById("btnReserve");

                if (btnReserve) {
                    if (manettesCount < 1) {
                        btnReserve.disabled = true;
                        btnReserve.classList.add("opacity-50", "cursor-not-allowed");
                    } else {
                        btnReserve.disabled = false;
                        btnReserve.classList.remove("opacity-50", "cursor-not-allowed");
                    }
                }
                
                // Mettre à jour l'affichage du prix de la manette
                if (manettePrix) {
                    const extra = getExtraControllerPrice(manettesCount);
                    manettePrix.innerHTML = t(
                        'reservation.controllers.priceWithExtraHtml',
                        `Manettes (+${extra} DH)`,
                        { extra }
                    );
                }
                
                // Recalculer le devis si on a déjà 2 dates choisies
                if (fp && fp.selectedDates && fp.selectedDates.length === 2 && currentConsoleInfo) {
                    calculateReservationWithApi(fp.selectedDates[0], fp.selectedDates[1]);
                }
            }

            

            if (btnMinus && btnPlus) {
                btnMinus.addEventListener('click', () => {
                    if (manettesCount > 1) { manettesCount--; updateManettesCounter(); }
                });
                btnPlus.addEventListener('click', () => {
                    if (manettesCount < maxManettes) { manettesCount++; updateManettesCounter(); }
                });
            }

            updateManettesCounter();
            // ----------------------------

            // caledrier creation
            const currentLng = getCurrentLng();
            fp = flatpickr("#datePicker", {
                inline: true,
                mode: "range",
                locale: currentLng === 'ar' ? flatpickr.l10ns.ar : flatpickr.l10ns.fr,
                minDate: "today",
                showMonths: 1,
                disable: reservedDatesArray, // <--- C'est ICI qu'on donne le tableau [ {from, to}, ... ] au calendrier !
                onChange: function(selectedDates, dateStr, instance) {
                    if (selectedDates.length === 2 && currentConsoleInfo) {
                        calculateReservationWithApi(selectedDates[0], selectedDates[1]);
                    } else if(selectedDates.length === 1) {
                         document.getElementById('durationDisplay').innerText = formatDuration(0, getCurrentLng());
                         document.getElementById('datesDisplay').innerText = t('reservation.summary.selecting', 'Sélection en cours...');
                         document.getElementById('totalDisplay').innerText = "0 DH";
                    }
                }
            });

            window.addEventListener('psh:i18n:changed', () => {
                try {
                    const lng = getCurrentLng();
                    if (fp) {
                        fp.set('locale', lng === 'ar' ? flatpickr.l10ns.ar : flatpickr.l10ns.fr);
                    }
                    updateManettesCounter();
                } catch (e) {}
            });

            
            try {
                let res = await fetch(`/api/consoles/${consoleId}`, {
                    headers: { 'Accept': 'application/json' }
                });
                
                let json = await res.json();
                
                if(json.id) {
                    currentConsoleInfo = json;
                    
                    
                    if(document.getElementById('consoleImage')) document.getElementById('consoleImage').src = currentConsoleInfo.image;
                    if(document.getElementById('recapImage')) document.getElementById('recapImage').src = currentConsoleInfo.image;
                    if(document.getElementById('brand')) document.getElementById('brand').innerText = `${t('common.brand', 'Marque')} : ${currentConsoleInfo.brand}`;
                    
                    if(document.getElementById('recapTitle')) document.getElementById('recapTitle').innerText = currentConsoleInfo.name;
                    if(document.getElementById('dailyPriceDisplay')) document.getElementById('dailyPriceDisplay').innerText = `${currentConsoleInfo.daily_price} DH / jour`;
                }

            } catch (e) {
                console.error('Erreur :', e);
                await Swal.fire({
                    icon: 'error',
                    title: t('common.error', 'Erreur'),
                    text: t('reservation.validation.loadConsoleError', 'Impossible de charger les détails de cette console.')
                });
            }

            // 3. demande au backend le calcul 
            async function calculateReservationWithApi(start, end) {
                const options = { day: 'numeric', month: 'short' };
                const lng = getCurrentLng();
                const dateLocale = getDateLocale(lng);
                document.getElementById('datesDisplay').innerText = `${start.toLocaleDateString(dateLocale, options)} - ${end.toLocaleDateString(dateLocale, options)}`;
                
                const couponCode = document.getElementById('couponInput').value.trim();

                try {
                    let res = await fetch("/api/reservations/calculate", {
                        method: "POST",
                        headers: buildAuthJsonHeaders(),
                        body: JSON.stringify({
                            console_id: currentConsoleInfo.id,
                            start_date: `${start.getFullYear()}-${String(start.getMonth() + 1).padStart(2, '0')}-${String(start.getDate()).padStart(2, '0')}`,
                            end_date: `${end.getFullYear()}-${String(end.getMonth() + 1).padStart(2, '0')}-${String(end.getDate()).padStart(2, '0')}`,
                            nombre_manettes: manettesCount,
                            coupon_code: couponCode !== "" ? couponCode : null
                        })
                    });
                    
                    let response = await res.json();
                    
                    if (res.ok && response.data) {
                        let info = response.data;
                        document.getElementById('durationDisplay').innerText = formatDuration(info.days, lng);
                        
                        // 1. On calcule le prix supplémentaire des manettes
                        let prixManettes = getExtraControllerPrice(manettesCount);

                        // 2. On ajoute ce prix au total renvoyé par l'API
                        let finalTotal = parseFloat(info.total) + prixManettes;

                        // S'il y a un discount, on peut l'afficher proprement en barrant l'ancien prix
                        if(info.discount > 0) {
                             let finalSubtotal = parseFloat(info.subtotal) + prixManettes;
                             document.getElementById('totalDisplay').innerHTML = `<span class="text-xs text-gray-400 line-through mr-2">${finalSubtotal} DH</span> ${finalTotal} DH`;
                        } else {
                             document.getElementById('totalDisplay').innerText = `${finalTotal} DH`;
                        }

                    } else {
                        console.error("Erreur API:", response.message || response);
                        await Swal.fire({
                            icon: 'error',
                            title: t('reservation.calculation.errorTitle', 'Erreur de calcul'),
                            text: t('reservation.calculation.errorText', 'Erreur lors du calcul : ') + (response.message || t('common.unauthorized', 'Non autorisé'))
                        });
                    }
                    
                } catch (e) {
                    console.error("Erreur d'estimation avec API", e);
                }
            }

            // Attacher l'événement au bouton OK du coupon pour forcer un recalcul (devis)
            document.getElementById('btnApplyCoupon').addEventListener('click', () => {
                // 1. On récupère les dates sélectionnées dans le calendrier
                let dates = fp.selectedDates;
                
                // 2. Si on a bien choisi 2 dates (début et fin)
                if (dates.length === 2) {
                    let dateDebut = dates[0];
                    let dateFin = dates[1];
                    
                    // On lance le calcul du prix
                    calculateReservationWithApi(dateDebut, dateFin);
                } else {
                    // Sinon, on affiche un message d'erreur
                    Swal.fire({
                        icon: 'warning',
                        title: t('reservation.validation.missingDates.title', 'Dates manquantes'),
                        text: t('reservation.validation.missingDates.text', "Sélectionnez d'abord vos dates !")
                    });
                }
            });

            const confirmModal = document.getElementById('confirmReservationModal');
            const confirmPhone = document.getElementById('confirmPhone');
            const confirmAddress = document.getElementById('confirmAddress');
            const btnConfirmCancel = document.getElementById('btnConfirmReservationCancel');
            const btnConfirmSubmit = document.getElementById('btnConfirmReservationSubmit');

            function openConfirmModal() {
                confirmModal.classList.remove('hidden');
                confirmModal.classList.add('flex');
                confirmModal.setAttribute('aria-hidden', 'false');
                confirmPhone.focus();
            }

            function closeConfirmModal() {
                confirmModal.classList.remove('flex');
                confirmModal.classList.add('hidden');
                confirmModal.setAttribute('aria-hidden', 'true');
            }

            btnConfirmCancel.addEventListener('click', () => {
                closeConfirmModal();
            });

            confirmModal.addEventListener('click', (e) => {
                if (e.target === confirmModal) {
                    closeConfirmModal();
                }
            });

            // 4. Bouton Réserver : ouvre le formulaire de confirmation
            const btnReserve = document.getElementById('btnReserve');
            btnReserve.addEventListener('click', async () => {
                if (typeof fp === 'undefined' || !fp.selectedDates || fp.selectedDates.length !== 2) {
                    await Swal.fire({
                        icon: 'warning',
                        title: t('reservation.validation.datesRequired.title', 'Dates requises'),
                        text: t('reservation.validation.datesRequired.text', "Veuillez d'abord sélectionner une date de début et de fin sur le calendrier.")
                    });
                    return;
                }

                if (!currentConsoleInfo) {
                    await Swal.fire({
                        icon: 'warning',
                        title: t('reservation.validation.pleaseWait.title', 'Veuillez patienter'),
                        text: t('reservation.validation.pleaseWait.text', "Les informations de la console ne sont pas encore chargées.")
                    });
                    return;
                }

                confirmPhone.value = '';
                confirmAddress.value = '';
                openConfirmModal();
            });

            btnConfirmSubmit.addEventListener('click', async () => {
                const phoneDigits = confirmPhone.value.replace(/\D/g, '');
                const addressVal = confirmAddress.value.trim();

                if (phoneDigits.length < 9) {
                    await Swal.fire({
                        icon: 'warning',
                        title: t('reservation.validation.phoneInvalid.title', 'Téléphone invalide'),
                        text: t('reservation.validation.phoneInvalid.text', 'Entrez un numéro valide (au moins 9 chiffres après +212).')
                    });
                    return;
                }

                if (addressVal.length < 10) {
                    await Swal.fire({
                        icon: 'warning',
                        title: t('reservation.validation.addressTooShort.title', 'Adresse trop courte'),
                        text: t('reservation.validation.addressTooShort.text', 'Indiquez une adresse complète (au moins 10 caractères).')
                    });
                    return;
                }

                const phoneStored = '+212' + phoneDigits;
                const start = fp.selectedDates[0];
                const end = fp.selectedDates[1];
                const couponCode = document.getElementById('couponInput').value.trim();

                btnConfirmSubmit.disabled = true;
                btnConfirmSubmit.textContent = t('common.sending', 'Envoi...');

                try {
                    const res = await fetch("/api/reservations", {
                        method: "POST",
                        headers: buildAuthJsonHeaders(),
                        body: JSON.stringify({
                            console_id: currentConsoleInfo.id,
                            start_date: `${start.getFullYear()}-${String(start.getMonth() + 1).padStart(2, '0')}-${String(start.getDate()).padStart(2, '0')}`,
                            end_date: `${end.getFullYear()}-${String(end.getMonth() + 1).padStart(2, '0')}-${String(end.getDate()).padStart(2, '0')}`,
                            nombre_manettes: manettesCount,
                            coupon_code: couponCode !== "" ? couponCode : null,
                            phone: phoneStored,
                            address: addressVal
                        })
                    });

                    const response = await res.json();

                    if (res.ok && response.data) {
                        closeConfirmModal();
                        await Swal.fire({
                            icon: 'success',
                            title: t('reservation.success.title', 'Réservation confirmée'),
                            text: t('reservation.success.text', "Félicitations, votre réservation est enregistrée !")
                        });
                        window.location.href = '/catalogue';
                    } else {
                        let errorMsg = response.message || "Erreur lors de la réservation.";
                        if (response.errors) {
                            const validationErrors = Object.values(response.errors).flat().join("\n");
                            errorMsg += "\n" + validationErrors;
                        }
                        await Swal.fire({
                            icon: 'error',
                            title: t('reservation.failure.title', 'Réservation échouée'),
                            text: errorMsg
                        });
                    }
                } catch (e) {
                    console.error("Erreur réseau pour reserver:", e);
                    await Swal.fire({
                        icon: 'error',
                        title: t('common.networkError', 'Erreur réseau'),
                        text: t('common.networkErrorText', "Une erreur de connexion est survenue.")
                    });
                } finally {
                    btnConfirmSubmit.disabled = false;
                    btnConfirmSubmit.textContent = t('reservation.confirm.submit', 'Confirmer la réservation');
                }
            });

        } // fin de initPage()

        // 5. Lancement immédiat de la fonction
        initPage();
    </script>
</body>
</html>
