
        document.addEventListener('DOMContentLoaded', async () => {
            const t = window.t || ((key, defaultStr) => defaultStr || key);
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
                    document.getElementById('profileNameDisplay').innerText = user.name;

                    let memberSince = '';
                    if (user.created_at) {
                        const dateObj = new Date(user.created_at);
                        const mm = dateObj.toLocaleString('fr-FR', { month: 'long' });
                        memberSince = mm.charAt(0).toUpperCase() + mm.slice(1) + ' ' + dateObj.getFullYear();
                    } else {
                        memberSince = '2026';
                    }

                    document.getElementById('profileEmailDisplay').innerText = `${user.email} • ${t('monCompte.js.clientSince', 'Client depuis')} ${memberSince}`;

                    if (user.photo_url) {
                        document.getElementById('profileBigAvatar').innerHTML = `<img src="${user.photo_url}" alt="${user.name}" class="h-full w-full object-cover rounded-full">`;
                    } else {
                        const initials = user.name.substring(0, 2).toUpperCase();
                        document.getElementById('profileBigAvatar').innerHTML = initials;
                    }
                }
            } catch (e) {
                console.error('Erreur profil:', e);
            }

            const pickNextReservation = (reservations, now) => {
                let nextReservation = null;

                reservations.forEach(reservation => {
                    if (reservation.status !== 'active') {
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
            const renderReservations = (safeReservations, now) => {
                let listHtml = '';
                if (safeReservations.length === 0) {
                    listHtml = `
                        <div class="bg-white rounded-3xl border border-gray-100 p-12 text-center shadow-sm">
                            <p class="text-gray-500 font-medium mb-6">${t('monCompte.js.noReservations', 'Vous n\\'avez effectué aucune réservation pour le moment.')}</p>
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

                        if (dStart > now && reservation.status === 'active') {
                            badgeHtml = `<span class="bg-yellow-50 text-yellow-600 px-3 py-1 rounded-full text-[10px] font-black tracking-wider uppercase border border-yellow-100">${t('monCompte.js.pendingValidation', 'EN ATTENTE DE VALIDATION')}</span>`;
                            rightSideAction = `<button class="text-red-500 text-xs font-bold hover:underline" onclick="Swal.fire({icon:'info',title:t('monCompte.js.infoTitle', 'Information'),text:t('monCompte.js.cancelNotAvailable', 'L\\'annulation n\\'est pas disponible.')})">${t('monCompte.js.cancelRequest', 'Annuler la demande')}</button>`;
                        } else if (dStart <= now && dEnd >= now && reservation.status === 'active') {
                            badgeHtml = `<span class="bg-green-50 text-green-600 px-3 py-1 rounded-full text-[10px] font-black tracking-wider uppercase border border-green-100">${t('monCompte.js.reservationValidated', 'RÉSERVATION VALIDÉE')}</span>`;
                            rightSideAction = `<button class="text-primary text-xs font-bold hover:underline">${t('monCompte.js.invoicePdf', 'Facture PDF')}</button>`;
                        } else {
                            badgeHtml = `<span class="bg-gray-100 text-gray-500 px-3 py-1 rounded-full text-[10px] font-black tracking-wider uppercase border border-gray-200">${t('monCompte.js.completed', 'TERMINÉE')}</span>`;
                            rightSideAction = `<button class="text-primary text-xs font-bold hover:underline">${t('monCompte.js.invoicePdf', 'Facture PDF')}</button>`;
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
                // Update simple texts that needed JS logic
                if (document.getElementById('profileEmailDisplay').innerText.includes('•')) {
                    const email = document.getElementById('profileEmailDisplay').innerText.split('•')[0].trim();
                    const memberSince = document.getElementById('profileEmailDisplay').innerText.split('depuis')[1] || '';
                    document.getElementById('profileEmailDisplay').innerText = `${email} • ${t('monCompte.js.clientSince', 'Client depuis')} ${memberSince}`;
                }
            });

            try {
                const res = await fetch('/api/reservations', {
                    headers: { 'Authorization': 'Bearer ' + token, 'Accept': 'application/json' }
                });

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
            } catch (e) {
                console.error('Erreur au chargement des réservations.', e);
                document.getElementById('reservationsList').innerHTML = `<p class="text-center text-red-500 py-10 font-bold">${t('monCompte.js.errorLoadingReservations', 'Impossible de charger vos données de réservation.')}</p>`;
            }
        });
    