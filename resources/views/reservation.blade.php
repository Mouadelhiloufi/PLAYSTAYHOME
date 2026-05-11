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
    </style>
</head>
<body>
    <div class="min-h-screen flex flex-col">
        @include('partials.navbar-main')

        <main class="flex-grow mx-auto max-w-6xl px-6 py-10 w-full">
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
                                    <span id="manettes-count" class="w-6 text-center font-bold text-xs text-gray-900">0</span>
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
                                <input type="text" id="couponInput" placeholder="CODE10" class="flex-grow rounded-lg border border-gray-200 px-3 py-1.5 text-xs focus:border-primary focus:outline-none">
                                <button type="button" id="btnApplyCoupon" class="bg-gray-900 hover:bg-gray-800 text-white px-4 py-1.5 rounded-lg text-xs font-bold transition-colors">OK</button>
                            </div>
                        </div>

                        <!-- Total -->
                        <div class="flex justify-between items-center mb-6 pt-5 border-t border-gray-100">
                            <span class="text-sm font-bold text-gray-900">Total</span>
                            <span class="text-xl font-black text-primary" id="totalDisplay">0 DH</span>
                        </div>

                        <button id="btnReserve" class="w-full bg-primary hover:bg-blue-600 text-white font-bold py-3 text-sm rounded-xl shadow-lg shadow-blue-200 transition-colors">
                            Réserver maintenant
                        </button>
                    </div>
                </div>
            </div>
        </main>

        <footer class="border-t border-gray-200 bg-white mt-12">
            <div class="mx-auto max-w-6xl px-6 py-12">
                <div class="grid grid-cols-1 gap-8 md:grid-cols-4">
                    <div>
                        <div class="flex items-center gap-2 text-primary font-black text-xl mb-4">
                            <i class="fab fa-playstation"></i> PLAYSTAYHOME
                        </div>
                        <p class="text-xs text-gray-400">Making homes smarter, safer, and more comfortable with cutting-edge technology.</p>
                    </div>
                    <div>
                        <h4 class="font-bold mb-4 text-sm">Product</h4>
                        <ul class="space-y-2 text-xs text-gray-500">
                            <li>Smart Lighting</li>
                            <li>Security Cameras</li>
                            <li>Thermostats</li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-bold mb-4 text-sm">Company</h4>
                        <ul class="space-y-2 text-xs text-gray-500">
                            <li>About Us</li>
                            <li>Careers</li>
                            <li>Privacy Policy</li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-bold mb-4 text-sm">Follow Us</h4>
                        <div class="flex gap-3">
                            <div class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center text-gray-600"><i class="fa-solid fa-share-nodes"></i></div>
                            <div class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center text-gray-600"><i class="fa-solid fa-globe"></i></div>
                        </div>
                    </div>
                </div>
                <div class="text-center text-xs text-gray-400 mt-12 pt-8 border-t border-gray-100">
                    © 2026 <strong>PLAYSTAYHOME</strong>. All rights reserved.
                </div>
            </div>
        </footer>
    </div>

    <!-- Scripts pour le calendrier -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/fr.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        async function initPage() {
            // Verification si l'user est connecté
            const token = localStorage.getItem('token');
            if (!token) {
                await Swal.fire({
                    icon: 'warning',
                    title: 'Connexion requise',
                    text: "Vous devez être connecté pour effectuer une réservation."
                });
                window.location.href = '/register';
                return;
            }

            // Recuperer l'ID de la console depuis l'URL
            const urlParams = new URLSearchParams(window.location.search);
            const consoleId = urlParams.get('console_id');

            // S'il n'y a pas de paramètre console dans l'URL on retourne au catalogue
            if (!consoleId) {
                await Swal.fire({
                    icon: 'warning',
                    title: 'Console manquante',
                    text: "Veuillez sélectionner une console depuis le catalogue."
                });
                window.location.href = '/catalogue';
                return;
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
            let manettesCount = 0;
            const maxManettes = 4;
            const btnMinus = document.getElementById('btn-minus');
            const btnPlus = document.getElementById('btn-plus');
            const countDisplay = document.getElementById('manettes-count');
            let fp;
           
            

            function updateManettesCounter() {
                if(countDisplay) countDisplay.innerText = manettesCount;
                if(btnMinus) btnMinus.disabled = manettesCount <= 0;
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
                if(manettesCount < 3){
                    manettePrix.innerHTML = "Manettes (+0 DH)";
                } else if(manettesCount == 3){
                    manettePrix.innerHTML = "Manettes (+25 DH)";
                } else if(manettesCount == 4){
                    manettePrix.innerHTML = "Manettes (+50 DH)";
                }
                
                // Recalculer le devis si on a déjà 2 dates choisies
                if (fp && fp.selectedDates && fp.selectedDates.length === 2 && currentConsoleInfo) {
                    calculateReservationWithApi(fp.selectedDates[0], fp.selectedDates[1]);
                }
            }

            

            if (btnMinus && btnPlus) {
                btnMinus.addEventListener('click', () => {
                    if (manettesCount > 0) { manettesCount--; updateManettesCounter(); }
                });
                btnPlus.addEventListener('click', () => {
                    if (manettesCount < maxManettes) { manettesCount++; updateManettesCounter(); }
                });
            }

            updateManettesCounter();
            // ----------------------------

            // caledrier creation
            fp = flatpickr("#datePicker", {
                inline: true,
                mode: "range",
                locale: "fr",
                minDate: "today",
                showMonths: 1,
                disable: reservedDatesArray, // <--- C'est ICI qu'on donne le tableau [ {from, to}, ... ] au calendrier !
                onChange: function(selectedDates, dateStr, instance) {
                    if (selectedDates.length === 2 && currentConsoleInfo) {
                        calculateReservationWithApi(selectedDates[0], selectedDates[1]);
                    } else if(selectedDates.length === 1) {
                         document.getElementById('durationDisplay').innerText = "0 jour";
                         document.getElementById('datesDisplay').innerText = "Sélection en cours...";
                         document.getElementById('totalDisplay').innerText = "0 DH";
                    }
                }
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
                    if(document.getElementById('brand')) document.getElementById('brand').innerText =`brand : ${currentConsoleInfo.brand}`
                    
                    if(document.getElementById('recapTitle')) document.getElementById('recapTitle').innerText = currentConsoleInfo.name;
                    if(document.getElementById('dailyPriceDisplay')) document.getElementById('dailyPriceDisplay').innerText = `${currentConsoleInfo.daily_price} DH / jour`;
                }

            } catch (e) {
                console.error('Erreur :', e);
                await Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    text: "Impossible de charger les détails de cette console."
                });
            }

            // 3. demande au backend le calcul 
            async function calculateReservationWithApi(start, end) {
                const options = { day: 'numeric', month: 'short' };
                document.getElementById('datesDisplay').innerText = `${start.toLocaleDateString('fr-FR', options)} - ${end.toLocaleDateString('fr-FR', options)}`;
                
                const couponCode = document.getElementById('couponInput').value.trim();

                try {
                    let res = await fetch("/api/reservations/calculate", {
                        method: "POST",
                        headers: { 
                            "Content-Type": "application/json",
                            "Accept": "application/json",
                            "Authorization": "Bearer " + token
                        },
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
                        document.getElementById('durationDisplay').innerText = `${info.days} jour(s)`;
                        
                        // 1. On calcule le prix supplémentaire des manettes
                        let prixManettes = 0;
                        if (manettesCount === 3) prixManettes = 25;
                        if (manettesCount === 4) prixManettes = 50;

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
                            title: 'Erreur de calcul',
                            text: "Erreur lors du calcul : " + (response.message || "Non autorisé")
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
                        title: 'Dates manquantes',
                        text: "Sélectionnez d'abord vos dates !"
                    });
                }
            });

            // 4. Action du bouton Final : Créer la réservation
            const btnReserve = document.getElementById('btnReserve');
            btnReserve.addEventListener('click', async () => {
                if (!token) {
                    await Swal.fire({
                        icon: 'warning',
                        title: 'Connexion requise',
                        text: "Créez d'abord un compte pour finaliser votre réservation."
                    });
                    window.location.href = '/register';
                    return;
                }

                if (typeof fp === 'undefined' || !fp.selectedDates || fp.selectedDates.length !== 2) {
                    await Swal.fire({
                        icon: 'warning',
                        title: 'Dates requises',
                        text: "Veuillez d'abord sélectionner une date de début et de fin sur le calendrier."
                    });
                    return;
                }
                
                if (!currentConsoleInfo) {
                    await Swal.fire({
                        icon: 'warning',
                        title: 'Veuillez patienter',
                        text: "Les informations de la console ne sont pas encore chargées."
                    });
                    return;
                }

                btnReserve.innerText = "Création en cours...";
                btnReserve.disabled = true;
                btnReserve.classList.add("opacity-70", "cursor-not-allowed");

                const start = fp.selectedDates[0];
                const end = fp.selectedDates[1];
                const couponCode = document.getElementById('couponInput').value.trim();

                try {
                    let res = await fetch("/api/reservations", {
                        method: "POST",
                        headers: { 
                            "Content-Type": "application/json",
                            "Accept": "application/json",
                            "Authorization": "Bearer " + token
                        },
                        body: JSON.stringify({
                            console_id: currentConsoleInfo.id,
                            start_date: `${start.getFullYear()}-${String(start.getMonth() + 1).padStart(2, '0')}-${String(start.getDate()).padStart(2, '0')}`,
                            end_date: `${end.getFullYear()}-${String(end.getMonth() + 1).padStart(2, '0')}-${String(end.getDate()).padStart(2, '0')}`,
                            nombre_manettes: manettesCount,
                            coupon_code: couponCode !== "" ? couponCode : null // Envoi du coupon
                        })
                    });
                    
                    let response = await res.json();
                    
                    if (res.ok && response.data) {
                        await Swal.fire({
                            icon: 'success',
                            title: 'Réservation confirmée',
                            text: "Félicitations, votre réservation est confirmée !"
                        });
                        // Rediriger vers l'historique ou le catalogue
                        window.location.href = '/catalogue';
                    } else {
                        // En cas de validation failed coté serveur
                        let errorMsg = response.message || "Erreur lors de la réservation.";
                        if (response.errors) {
                            // Concaténer toutes les alertes de validation
                            let validationErrors = Object.values(response.errors).flat().join("\n");
                            errorMsg += "\n" + validationErrors;
                        }
                        await Swal.fire({
                            icon: 'error',
                            title: 'Réservation échouée',
                            text: errorMsg
                        });
                    }
                } catch (e) {
                    console.error("Erreur réseau pour reserver:", e);
                    await Swal.fire({
                        icon: 'error',
                        title: 'Erreur réseau',
                        text: "Une erreur de connexion est survenue."
                    });
                } finally {
                    // Remettre le bouton à son état d'origine en cas d'erreur
                    btnReserve.innerText = "Réserver maintenant";
                    btnReserve.disabled = false;
                    btnReserve.classList.remove("opacity-70", "cursor-not-allowed");
                    updateManettesCounter();
                }
            });

        } // fin de initPage()

        // 5. Lancement immédiat de la fonction
        initPage();
    </script>
</body>
</html>
