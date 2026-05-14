<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Compte - playstayhome</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
<body>
    <div class="min-h-screen flex flex-col">
        @include('partials.navbar-main')

        <main class="grow mx-auto max-w-4xl px-4 py-8 w-full">
            
            <!-- EN-TÊTE PROFIL -->
            <div class="bg-white rounded-3xl border border-gray-100 shadow-[0_4px_20px_rgba(15,23,42,0.03)] p-8 flex flex-col md:flex-row items-center justify-between mb-8 mt-2 relative overflow-hidden">
                <div class="flex items-center gap-6 z-10 w-full mb-6 md:mb-0">
                    <div id="profileBigAvatar" class="h-20 w-20 shrink-0 rounded-full bg-blue-100 flex items-center justify-center text-primary font-black text-2xl shadow-inner border border-blue-200 uppercase">
                        <i class="fa-solid fa-user text-xl"></i>
                    </div>
                    <div>
                        <h1 id="profileNameDisplay" class="text-2xl md:text-3xl font-black text-gray-900 tracking-tight" data-i18n="monCompte.loading">Chargement...</h1>
                        <p id="profileEmailDisplay" class="text-sm font-medium text-gray-500 mt-1" data-i18n="monCompte.pleaseWait">Veuillez patienter...</p>
                    </div>
                </div>
                <div class="flex flex-col gap-3 items-end z-10 md:w-auto w-full">
                    <a href="/modifier-profil" class="w-full md:w-auto bg-white hover:bg-gray-50 border border-gray-200 text-gray-900 px-6 py-2.5 rounded-xl text-sm font-bold shadow-sm transition-all duration-200 whitespace-nowrap text-center" data-i18n="monCompte.editProfile">
                        Modifier le profil
                    </a>
                    <button id="pageLogoutBtn" class="pr-6 text-gray-400 hover:text-red-500 text-xs font-bold px-2 py-1 transition-colors flex items-center gap-1">
                        <i class="fa-solid fa-power-off"></i> <span data-i18n="monCompte.logout">Se déconnecter</span>
                    </button>
                </div>
            </div>

            <!-- TABS -->
            <div class="flex gap-8 border-b border-gray-200 mb-10 overflow-x-auto pb-1">
                <button class="pb-3 text-sm font-bold text-primary border-b-2 border-primary whitespace-nowrap" data-i18n="monCompte.myReservations">Mes Réservations</button>
            </div>

            <!-- COUNTDOWN SI RÉSERVATION IMMINENTE -->
            <div id="countdownContainer" class="hidden mb-12">
                <h2 class="text-lg font-black text-gray-900 uppercase tracking-tight mb-4" data-i18n="monCompte.countdownTitle">COUNTDOWN RESERVATION</h2>
                <div class="bg-gray-900 rounded-3xl p-6 md:p-8 text-white shadow-xl shadow-gray-200 flex flex-col items-center justify-between gap-6 md:flex-row md:items-start relative overflow-hidden">
                    <div class="absolute inset-0 bg-linear-to-r from-primary to-blue-900 opacity-90"></div>
                    <i class="fa-solid fa-gamepad text-9xl absolute -right-4 -bottom-6 opacity-20 transform -rotate-12"></i>
                    
                    <div class="z-10 relative text-center md:text-left">
                        <p id="countdownTitle" class="text-2xl font-black mb-1 text-white truncate max-w-full" data-i18n="monCompte.console">Console</p>
                        <p class="text-blue-200 text-sm font-medium"><i class="fa-regular fa-clock mr-2 animate-pulse"></i> <span data-i18n="monCompte.timeBeforeClosing">Temps restant avant fermeture :</span></p>
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
                    <p class="text-sm" data-i18n="monCompte.loadingReservations">Chargement de vos réservations...</p>
                </div>
            </div>

        </main>
        
        @include('partials.footer-main')
    </div>

    <!-- SCRIPT DE LOGIQUE -->
    <script>
        document.addEventListener('DOMContentLoaded', async () => {
            const t = (key, defaultStr) => (window.PSH_I18N && typeof window.PSH_I18N.t === 'function') ? window.PSH_I18N.t(key, { defaultValue: defaultStr || key }) : (defaultStr || key);
            const token = localStorage.getItem('token');
            if (!token) {
                window.location.href = '/login';
                return;
            }

            const DAY_MS = 24 * 60 * 60 * 1000;
            const HOUR_MS = 60 * 60 * 1000;
            const MINUTE_MS = 60 * 1000;
            const SECOND_MS = 1000;

            const logoutBtn = document.getElementById('pageLogoutBtn');
            if (logoutBtn) {
                logoutBtn.addEventListener('click', async () => {
                    const result = await Swal.fire({
                        icon: 'question',
                        title: t('monCompte.js.logoutTitle', 'Déconnexion'),
                        text: t('monCompte.js.logoutText', 'Voulez-vous vraiment vous déconnecter ?'),
                        showCancelButton: true,
                        confirmButtonText: t('monCompte.js.logoutConfirm', 'Oui, se déconnecter'),
                        cancelButtonText: t('monCompte.js.logoutCancel', 'Annuler')
                    });
                    if (!result.isConfirmed) return;

                    try {
                        await fetch('/api/logout', {
                            method: 'POST',
                            headers: { 'Authorization': 'Bearer ' + token, 'Accept': 'application/json' }
                        });
                    } catch (e) {}

                    localStorage.removeItem('token');
                    window.location.href = '/login';
                });
            }

            try {
                const userRes = await fetch('/api/user', {
                    headers: { 'Authorization': 'Bearer ' + token, 'Accept': 'application/json' }
                });
                const user = await userRes.json();

                if (user && user.name) {
                    const profileNameDisplay = document.getElementById('profileNameDisplay');
                    const profileEmailDisplay = document.getElementById('profileEmailDisplay');
                    const profileBigAvatar = document.getElementById('profileBigAvatar');

                    const memberSinceLabel = user.created_at ? (() => {
                        const dateObj = new Date(user.created_at);
                        const locale = window.PSH_I18N?.getLanguage?.() === 'ar' ? 'ar-MA' : 'fr-FR';
                        const month = dateObj.toLocaleString(locale, { month: 'long' });
                        return month.charAt(0).toUpperCase() + month.slice(1) + ' ' + dateObj.getFullYear();
                    })() : '2026';

                    if (profileNameDisplay) profileNameDisplay.innerText = user.name;
                    if (profileEmailDisplay) profileEmailDisplay.innerText = `${user.email} • ${t('monCompte.js.clientSince', 'Client depuis')} ${memberSinceLabel}`;

                    if (profileBigAvatar && user.photo_url) {
                        profileBigAvatar.innerHTML = `<img src="${user.photo_url}" alt="${user.name}" class="h-full w-full object-cover rounded-full">`;
                    } else {
                        const initials = user.name.substring(0, 2).toUpperCase();
                        if (profileBigAvatar) profileBigAvatar.innerHTML = initials;
                    }
                }
            } catch (e) {
                console.error('Erreur profil:', e);
            }

            const pickNextReservation = (reservations, now) => {
                let nextReservation = null;

                reservations.forEach(reservation => {
                        const normalizedStatus = String(reservation.status || '').toLowerCase();
                        if (!['active', 'accepted'].includes(normalizedStatus)) {
                        return;
                    }

                    const startDate = new Date(reservation.start_date);
                    const endDate = new Date(reservation.end_date);
                    let targetDate = null;
                    let label = '';

                    if (startDate > now) {
                        targetDate = startDate;
                        label = t('monCompte.js.timeBeforeStart', 'Temps restant avant le début :');
                    } else if (endDate >= now) {
                        targetDate = endDate;
                        label = t('monCompte.js.timeBeforeClosing', 'Temps restant avant fermeture :');
                    }

                    if (!targetDate) {
                        return;
                    }

                    if (!nextReservation || targetDate < nextReservation.date) {
                        nextReservation = {
                            date: targetDate,
                            name: reservation.console ? reservation.console.name : t('monCompte.js.defaultConsole', 'Console PlayStation/Xbox'),
                            label: label,
                        };
                    }
                });

                return nextReservation;
            };

            const startCountdown = (target) => {
                const container = document.getElementById('countdownContainer');
                const timer = document.getElementById('countdownTimer');
                const labelElem = container.querySelector('.text-blue-200.text-sm.font-medium');

                container.classList.remove('hidden');
                document.getElementById('countdownTitle').innerText = target.name;

                if (labelElem) {
                    labelElem.innerHTML = `<i class="fa-regular fa-clock mr-2 animate-pulse"></i> ${target.label}`;
                }

                const renderCountdown = () => {
                    const distance = target.date.getTime() - Date.now();

                    if (distance <= 0) {
                        timer.innerHTML = `<p class="text-white font-bold text-xl uppercase tracking-wide">${t('monCompte.js.countdownFinished', 'C\'est terminé !')}</p>`;
                        return;
                    }

                    const days = Math.floor(distance / DAY_MS);
                    const hours = Math.floor((distance % DAY_MS) / HOUR_MS);
                    const minutes = Math.floor((distance % HOUR_MS) / MINUTE_MS);
                    const seconds = Math.floor((distance % MINUTE_MS) / SECOND_MS);

                    const box = (value, label) => `
                        <div class="flex flex-col items-center justify-center bg-white/20 backdrop-blur-sm border border-white/20 rounded-2xl w-[4.5rem] h-[5.5rem] md:w-[5.5rem] md:h-[6rem] shadow-sm">
                            <span class="text-2xl md:text-4xl font-black leading-none tracking-tighter">${String(value).padStart(2, '0')}</span>
                            <span class="text-[10px] uppercase tracking-widest font-bold opacity-80 mt-1">${label}</span>
                        </div>
                    `;

                    timer.innerHTML = box(days, t('monCompte.js.days', 'Jours')) + box(hours, t('monCompte.js.hours', 'Heures')) + box(minutes, t('monCompte.js.mins', 'Mins')) + box(seconds, t('monCompte.js.secs', 'Secs'));
                };

                renderCountdown();
                setInterval(renderCountdown, 1000);
            };

            // Extraire la logique de rendu pour pouvoir la rappeler
            let currentSafeReservations = [];
            const loadAndRenderReservations = async () => {
                const res = await fetch('/api/reservations', {
                    headers: { 'Authorization': 'Bearer ' + token, 'Accept': 'application/json' }
                });

                if (!res.ok) {
                    throw new Error('Erreur au chargement des réservations');
                }

                const repData = await res.json();
                const reservationsList = Array.isArray(repData) ? repData : repData.data;
                const safeReservations = reservationsList || [];
                const now = new Date();

                currentSafeReservations = safeReservations;
                renderReservations(safeReservations, now);

                const nextReservation = pickNextReservation(safeReservations, now);
                if (nextReservation) {
                    startCountdown(nextReservation);
                }
            };

            window.cancelReservation = async (reservationId) => {
                const result = await Swal.fire({
                    icon: 'warning',
                    title: 'Annuler la réservation',
                    text: 'Voulez-vous vraiment annuler cette réservation en attente ?',
                    showCancelButton: true,
                    confirmButtonText: 'Oui, annuler',
                    cancelButtonText: 'Retour',
                    confirmButtonColor: '#dc2626'
                });

                if (!result.isConfirmed) return;

                try {
                    const response = await fetch(`/api/reservations/${reservationId}/cancel`, {
                        method: 'PUT',
                        headers: {
                            'Authorization': 'Bearer ' + token,
                            'Accept': 'application/json'
                        }
                    });

                    const payload = await response.json().catch(() => ({}));

                    if (!response.ok) {
                        throw new Error(payload.message || 'Impossible d\'annuler cette réservation.');
                    }

                    await Swal.fire({
                        icon: 'success',
                        title: 'Réservation annulée',
                        text: payload.message || 'Votre réservation a été annulée avec succès.'
                    });

                    await loadAndRenderReservations();
                } catch (error) {
                    await Swal.fire({
                        icon: 'error',
                        title: 'Erreur',
                        text: error.message || 'Une erreur est survenue pendant l\'annulation.'
                    });
                }
            };

            const renderReservations = (safeReservations, now) => {
                let listHtml = '';
                if (safeReservations.length === 0) {
                    listHtml = `
                        <div class="bg-white rounded-3xl border border-gray-100 p-12 text-center shadow-sm">
                            <p class="text-gray-500 font-medium mb-6">${t('monCompte.js.noReservations', "Vous n'avez effectué aucune réservation pour le moment.")}</p>
                            <a href="/catalogue" class="inline-block bg-primary text-white px-6 py-3 rounded-xl text-sm font-bold shadow-sm hover:bg-blue-600 transition-colors">${t('monCompte.js.exploreCatalog', 'Explorer le catalogue')}</a>
                        </div>`;
                } else {
                    safeReservations.forEach(reservation => {
                        const cName = reservation.console ? reservation.console.name : t('monCompte.js.defaultConsole', 'Console PlayStation/Xbox');
                        const cImg = reservation.console && reservation.console.image ? reservation.console.image : 'https://gmedia.playstation.com/is/image/SIEPDC/ps5-product-thumbnail-01-en-14sep21';
                        const dStart = new Date(reservation.start_date);
                        const dEnd = new Date(reservation.end_date);
                        const diffDays = reservation.duration_days ?? 1;
                        const dateText = t('monCompte.js.dateRange', 'Du :start au :end (:days jours)')
                            .replace(':start', dStart.toLocaleDateString('fr-FR'))
                            .replace(':end', dEnd.toLocaleDateString('fr-FR'))
                            .replace(':days', diffDays);

                        let badgeHtml = '';
                        let rightSideAction = '';
                        const infoTitle = t('monCompte.js.infoTitle', 'Information');
                        const cancelUnavailableText = t('monCompte.js.cancelNotAvailable', "L'annulation n'est pas disponible.");

                        const rawStatus = String(reservation.status || '').toLowerCase();
                        let displayStatus = rawStatus;

                        if (rawStatus === 'active') {
                            displayStatus = dStart > now ? 'pending' : 'accepted';
                        } else if (rawStatus === 'completed') {
                            displayStatus = 'accepted';
                        } else if (rawStatus === 'cancelled') {
                            displayStatus = 'refused';
                        }

                        if (displayStatus === 'pending') {
                            badgeHtml = `<span class="bg-yellow-50 text-yellow-700 px-3 py-1 rounded-full text-[10px] font-black tracking-wider uppercase border border-yellow-100">En attente de confirmation</span>`;
                                rightSideAction = `<button type="button" class="text-red-500 text-xs font-bold hover:underline" onclick="window.cancelReservation(${reservation.id})">${t('monCompte.js.cancelRequest', 'Annuler la réservation')}</button>`;
                        } else if (displayStatus === 'accepted') {
                            badgeHtml = `<span class="bg-green-50 text-green-600 px-3 py-1 rounded-full text-[10px] font-black tracking-wider uppercase border border-green-100">Réservation confirmée</span>`;
                            rightSideAction = `<button class="text-primary text-xs font-bold hover:underline">${t('monCompte.js.invoicePdf', 'Facture PDF')}</button>`;
                        } else if (displayStatus === 'refused') {
                            badgeHtml = `<span class="bg-red-50 text-red-600 px-3 py-1 rounded-full text-[10px] font-black tracking-wider uppercase border border-red-100">Réservation refusée</span>`;
                            rightSideAction = `<span class="text-xs font-bold text-gray-400">${t('monCompte.js.completed', 'TERMINÉE')}</span>`;
                        }

                        let priceBottomText = t('monCompte.js.totalPaid', 'Total payé');
                        if (reservation.coupon_id) {
                            priceBottomText = `<span class="text-green-500">${t('monCompte.js.couponApplied', 'Coupon appliqué')}</span>`;
                        }

                        listHtml += `
                            <div class="bg-white rounded-3xl border border-gray-100 shadow-[0_2px_15px_rgba(15,23,42,0.03)] p-6 md:p-8 flex flex-col md:flex-row items-center md:items-start justify-between gap-6 hover:shadow-md transition-shadow">
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
            };

            window.addEventListener('psh:i18n:changed', () => {
                if (currentSafeReservations) {
                    renderReservations(currentSafeReservations, new Date());
                }
            });

            try {
                await loadAndRenderReservations();
            } catch (e) {
                console.error('Erreur au chargement des réservations.', e);
                document.getElementById('reservationsList').innerHTML = `<p class="text-center text-red-500 py-10 font-bold">${t('monCompte.js.errorLoadingReservations', 'Impossible de charger vos données de réservation.')}</p>`;
            }
        });
    </script>
</body>
</html>
