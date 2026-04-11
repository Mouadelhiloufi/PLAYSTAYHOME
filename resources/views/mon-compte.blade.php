<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Compte - PLAYSTAIHOME</title>
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
        .nav-link { position: relative; display: inline-flex; align-items: center; height: 40px; font-size: 0.875rem; font-weight: 600; color: #4b5563; transition: color .2s ease; }
        .nav-link::after { content: ""; position: absolute; left: 0; bottom: -1px; width: 100%; height: 2px; background: #1978e5; transform: scaleX(0); transform-origin: center; transition: transform .2s ease; }
        .nav-link:hover, .nav-link.active { color: #1978e5; }
        .nav-link:hover::after, .nav-link.active::after { transform: scaleX(1); }
    </style>
</head>
<body>
    <div class="min-h-screen flex flex-col">
        @include('partials.navbar-main')

        <main class="flex-grow mx-auto max-w-4xl px-4 py-8 w-full">
            
            <!-- EN-TÊTE PROFIL -->
            <div class="bg-white rounded-3xl border border-gray-100 shadow-[0_4px_20px_rgba(15,23,42,0.03)] p-8 flex flex-col md:flex-row items-center justify-between mb-8 mt-2 relative overflow-hidden">
                <div class="flex items-center gap-6 z-10 w-full mb-6 md:mb-0">
                    <div id="profileBigAvatar" class="h-20 w-20 flex-shrink-0 rounded-full bg-blue-100 flex items-center justify-center text-primary font-black text-2xl shadow-inner border border-blue-200 uppercase">
                        <i class="fa-solid fa-user text-xl"></i>
                    </div>
                    <div>
                        <h1 id="profileNameDisplay" class="text-2xl md:text-3xl font-black text-gray-900 tracking-tight">Chargement...</h1>
                        <p id="profileEmailDisplay" class="text-sm font-medium text-gray-500 mt-1">Veuillez patienter...</p>
                    </div>
                </div>
                <div class="flex flex-col gap-3 items-end z-10 md:w-auto w-full">
                    <a href="/modifier-profil" class="w-full md:w-auto bg-white hover:bg-gray-50 border border-gray-200 text-gray-900 px-6 py-2.5 rounded-xl text-sm font-bold shadow-sm transition-all duration-200 whitespace-nowrap text-center">
                        Modifier le profil
                    </a>
                    <button id="pageLogoutBtn" class="pr-6 text-gray-400 hover:text-red-500 text-xs font-bold px-2 py-1 transition-colors flex items-center gap-1">
                        <i class="fa-solid fa-power-off"></i> Se déconnecter
                    </button>
                </div>
            </div>

            <!-- TABS -->
            <div class="flex gap-8 border-b border-gray-200 mb-10 overflow-x-auto pb-1">
                <button class="pb-3 text-sm font-bold text-primary border-b-2 border-primary whitespace-nowrap">Mes Réservations</button>
                <button class="pb-3 text-sm font-bold text-gray-400 hover:text-gray-600 transition-colors whitespace-nowrap">Mes Coupons</button>
                <button class="pb-3 text-sm font-bold text-gray-400 hover:text-gray-600 transition-colors whitespace-nowrap">Factures</button>
            </div>

            <!-- COUNTDOWN SI RÉSERVATION IMMINENTE -->
            <div id="countdownContainer" class="hidden mb-12">
                <h2 class="text-lg font-black text-gray-900 uppercase tracking-tight mb-4">COUNTDOWN RESERVATION</h2>
                <div class="bg-gray-900 rounded-3xl p-6 md:p-8 text-white shadow-xl shadow-gray-200 flex flex-col items-center justify-between gap-6 md:flex-row md:items-start relative overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-r from-primary to-blue-900 opacity-90"></div>
                    <i class="fa-solid fa-gamepad text-9xl absolute -right-4 -bottom-6 opacity-20 transform -rotate-12"></i>
                    
                    <div class="z-10 relative text-center md:text-left">
                        <p id="countdownTitle" class="text-2xl font-black mb-1 text-white truncate max-w-full">Console</p>
                        <p class="text-blue-200 text-sm font-medium"><i class="fa-regular fa-clock mr-2 animate-pulse"></i> Temps restant avant fermeture :</p>
                    </div>
                    
                    <div class="flex gap-3 md:gap-4 z-10 relative" id="countdownTimer">
                        <!-- Chiffres du countdown -->
                    </div>
                </div>
            </div>

            <!-- LISTE DES RÉSERVATIONS -->
            <div id="reservationsList" class="space-y-5">
                <div class="text-center py-10 text-gray-400">
                    <i class="fa-solid fa-spinner fa-spin text-3xl mb-3"></i>
                    <p class="text-sm">Chargement de vos réservations...</p>
                </div>
            </div>

        </main>
        
        <footer class="border-t border-gray-200 bg-white py-12 mt-12">
            <div class="mx-auto flex max-w-4xl flex-col items-center justify-center px-6">
                <p class="text-center text-xs text-gray-400">
                    © 2026 PLAYSTAIHOME. All rights reserved.
                </p>
            </div>
        </footer>
    </div>

    <!-- SCRIPT DE LOGIQUE -->
    <script>
        document.addEventListener('DOMContentLoaded', async () => {
            const token = localStorage.getItem('token');
            if (!token) {
                window.location.href = '/login';
                return;
            }

            // Gestion Déconnexion
            const logoutBtn = document.getElementById('pageLogoutBtn');
            if (logoutBtn) {
                logoutBtn.addEventListener('click', async () => {
                    const conf = confirm('Voulez-vous vraiment vous déconnecter ?');
                    if(!conf) return;

                    try {
                        await fetch('/api/logout', {
                            method: 'POST',
                            headers: { 'Authorization': 'Bearer ' + token, 'Accept': 'application/json' }
                        });
                    } catch(e) {}
                    localStorage.removeItem('token');
                    window.location.href = '/login';
                });
            }

            // Récupération Profil Utilisateur
            try {
                let userRes = await fetch('/api/user', {
                    headers: { 'Authorization': 'Bearer ' + token, 'Accept': 'application/json' }
                });
                let user = await userRes.json();
                
                if (user && user.name) {
                    document.getElementById('profileNameDisplay').innerText = user.name;
                    
                    // Formatage date 'Client depuis x'
                    let memberSince = "";
                    if (user.created_at) {
                        const dateObj = new Date(user.created_at);
                        const mm = dateObj.toLocaleString('fr-FR', { month: 'long' });
                        memberSince = mm.charAt(0).toUpperCase() + mm.slice(1) + ' ' + dateObj.getFullYear();
                    } else {
                        memberSince = "2026";
                    }

                    document.getElementById('profileEmailDisplay').innerText = `${user.email} • Client depuis ${memberSince}`;
                    
                    // Avatar ou initiales
                    if (user.photo_url) {
                        document.getElementById('profileBigAvatar').innerHTML = `<img src="${user.photo_url}" alt="${user.name}" class="h-full w-full object-cover rounded-full">`;
                    } else {
                        const initials = user.name.substring(0, 2).toUpperCase();
                        document.getElementById('profileBigAvatar').innerHTML = initials;
                    }
                }
            } catch (e) {
                console.error("Erreur profil:", e);
            }

            // Récupération Réservations
            try {
                let res = await fetch('/api/reservations', {
                    headers: { 'Authorization': 'Bearer ' + token, 'Accept': 'application/json' }
                });
                
                let repData = await res.json();
                let reservationsList = Array.isArray(repData) ? repData : repData.data; 
                if(!reservationsList) reservationsList = [];

                let listHtml = '';
                let nextReservation = null;
                const now = new Date();

                if (reservationsList.length === 0) {
                    listHtml = `
                        <div class="bg-white rounded-3xl border border-gray-100 p-12 text-center shadow-sm">
                            <p class="text-gray-500 font-medium mb-6">Vous n'avez effectué aucune réservation pour le moment.</p>
                            <a href="/catalogue" class="inline-block bg-primary text-white px-6 py-3 rounded-xl text-sm font-bold shadow-sm hover:bg-blue-600 transition-colors">Explorer le catalogue</a>
                        </div>`;
                } else {
                    reservationsList.forEach(reservation => {
                        const cName = reservation.console ? reservation.console.name : "Console PlayStation/Xbox";
                        const cImg = reservation.console && reservation.console.image ? reservation.console.image : "https://gmedia.playstation.com/is/image/SIEPDC/ps5-product-thumbnail-01-en-14sep21";
                        
                        const dStart = new Date(reservation.start_date);
                        const dEnd = new Date(reservation.end_date);
                        const diffDays = Math.ceil(Math.abs(dEnd - dStart) / (1000 * 60 * 60 * 24)) + 1;

                        const dateText = `Du ${dStart.toLocaleDateString('fr-FR')} au ${dEnd.toLocaleDateString('fr-FR')} (${diffDays} jours)`;

                        let badgeHtml = '';
                        let rightSideAction = '';

                        // Déterminer le statut visuel
                        if (dStart > now && reservation.status === 'active') {
                            badgeHtml = `<span class="bg-yellow-50 text-yellow-600 px-3 py-1 rounded-full text-[10px] font-black tracking-wider uppercase border border-yellow-100">EN ATTENTE DE VALIDATION</span>`;
                            rightSideAction = `<button class="text-red-500 text-xs font-bold hover:underline" onclick="alert('L\\'annulation n\\'est pas disponible.')">Annuler la demande</button>`;
                            
                            // Trouver la réservation la plus proche pour le countdown
                            if(!nextReservation || dStart < nextReservation.date) {
                                nextReservation = { date: dStart, name: cName, label: 'Temps restant avant le début :' };
                            }
                        } else if (dStart <= now && dEnd >= now && reservation.status === 'active') {
                            badgeHtml = `<span class="bg-green-50 text-green-600 px-3 py-1 rounded-full text-[10px] font-black tracking-wider uppercase border border-green-100">RÉSERVATION VALIDÉE</span>`;
                            rightSideAction = `<button class="text-primary text-xs font-bold hover:underline">Facture PDF</button>`;
                            
                            // Activer le compte à rebours pour la fin de la réservation en cours
                            if(!nextReservation || dEnd < nextReservation.date) {
                                nextReservation = { date: dEnd, name: cName, label: 'Temps restant avant fermeture :' };
                            }
                        } else {
                            badgeHtml = `<span class="bg-gray-100 text-gray-500 px-3 py-1 rounded-full text-[10px] font-black tracking-wider uppercase border border-gray-200">TERMINÉE</span>`;
                            rightSideAction = `<button class="text-primary text-xs font-bold hover:underline">Facture PDF</button>`;
                        }

                        // Apparence "Coupon appliqué"
                        let priceBottomText = 'Total payé';
                        if (reservation.coupon_id) {
                            priceBottomText = `<span class="text-green-500">Coupon appliqué</span>`;
                        }

                        // HTML de la ligne/carte de réservation
                        listHtml += `
                            <div class="bg-white rounded-3xl border border-gray-100 shadow-[0_2px_15px_rgba(15,23,42,0.03)] p-6 md:p-8 flex flex-col md:flex-row items-center md:items-start justify-between gap-6 hover:shadow-md transition-shadow">
                                <!-- Box Gauche -->
                                <div class="flex flex-col md:flex-row items-center md:items-start gap-6 w-full">
                                    <div class="bg-gray-50 p-4 rounded-2xl border border-gray-100 flex-shrink-0">
                                        <img src="${cImg}" alt="${cName}" class="h-20 w-20 object-contain drop-shadow-sm">
                                    </div>
                                    <div class="text-center md:text-left flex flex-col justify-center pt-2">
                                        <div class="mb-3">${badgeHtml}</div>
                                        <h3 class="text-xl md:text-2xl font-black text-gray-900 tracking-tight">${cName}</h3>
                                        <p class="text-sm text-gray-500 font-medium mt-1">${dateText}</p>
                                    </div>
                                </div>

                                <!-- Box Droite -->
                                <div class="flex flex-col items-center md:items-end justify-between w-full md:w-auto h-full border-t border-gray-100 md:border-0 pt-6 md:pt-2 md:pl-6 shrink-0">
                                    <div class="text-center md:text-right">
                                        <p class="text-3xl font-black text-primary">${reservation.total_price} DH</p>
                                        <p class="text-[10px] text-gray-400 uppercase tracking-widest font-bold mt-1">${priceBottomText}</p>
                                    </div>
                                    <div class="mt-6 md:mt-8 md:text-right text-center w-full">
                                        ${rightSideAction}
                                    </div>
                                </div>
                            </div>
                        `;
                    });
                }
                
                document.getElementById('reservationsList').innerHTML = listHtml;

                // ACTIVATION DU CHRONOMÈTRE SI UNE RÉSERVATION ARRIVE
                if(nextReservation) {
                    const ctn = document.getElementById('countdownContainer');
                    ctn.classList.remove('hidden');
                    document.getElementById('countdownTitle').innerText = nextReservation.name;
                    
                    // Mettre à jour le label ("Temps restant avant...")
                    const labelElem = ctn.querySelector('.text-blue-200.text-sm.font-medium');
                    if(labelElem) {
                        labelElem.innerHTML = `<i class="fa-regular fa-clock mr-2 animate-pulse"></i> ${nextReservation.label}`;
                    }
                    
                    const updateCount = () => {
                        const distance = nextReservation.date.getTime() - new Date().getTime();
                        
                        if (distance <= 0) {
                            document.getElementById('countdownTimer').innerHTML = `<p class="text-white font-bold text-xl uppercase tracking-wide">C'est terminé !</p>`;
                            return;
                        }
                        
                        const d = Math.floor(distance / (1000 * 60 * 60 * 24));
                        const h = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                        const m = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                        const s = Math.floor((distance % (1000 * 60)) / 1000);
                        
                        const bx = (val, lbl) => `
                            <div class="flex flex-col items-center justify-center bg-white/20 backdrop-blur-sm border border-white/20 rounded-2xl w-[4.5rem] h-[5.5rem] md:w-[5.5rem] md:h-[6rem] shadow-sm">
                                <span class="text-2xl md:text-4xl font-black leading-none tracking-tighter">${val.toString().padStart(2, '0')}</span>
                                <span class="text-[10px] uppercase tracking-widest font-bold opacity-80 mt-1">${lbl}</span>
                            </div>
                        `;

                        document.getElementById('countdownTimer').innerHTML = bx(d, 'Jours') + bx(h, 'Heures') + bx(m, 'Mins') + bx(s, 'Secs');
                    };
                    
                    updateCount();
                    setInterval(updateCount, 1000);
                }

            } catch (e) {
                console.error("Erreur au chargement des réservations.", e);
                document.getElementById('reservationsList').innerHTML = `<p class="text-center text-red-500 py-10 font-bold">Impossible de charger vos données de réservation.</p>`;
            }
        });
    </script>
</body>
</html>
