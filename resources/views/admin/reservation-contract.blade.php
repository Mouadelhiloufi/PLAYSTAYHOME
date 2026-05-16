<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contrat de location - PlayStayHome</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Noto+Naskh+Arabic:wght@400;500;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <style>
        :root {
            --primary: #165fce;
            --primary-dark: #0f4fa8;
            --border: #dce7f5;
            --text: #0f172a;
            --muted: #64748b;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background: linear-gradient(180deg, #f4f8ff 0%, #eef4fb 100%);
            color: var(--text);
        }

        .page-shell {
            min-height: 100vh;
            padding: 32px 18px;
            display: flex;
            align-items: flex-start;
            justify-content: center;
        }

        .card {
            width: 100%;
            max-width: 980px;
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 22px;
            overflow: hidden;
            box-shadow: 0 30px 60px rgba(15, 23, 42, 0.12);
        }

        .hero {
            background: linear-gradient(135deg, #0f172a 0%, var(--primary-dark) 50%, var(--primary) 100%);
            color: #fff;
            padding: 24px 28px;
            display: grid;
            grid-template-columns: 96px 1fr;
            gap: 18px;
            align-items: center;
        }

        .logo-box {
            width: 96px;
            height: 96px;
            border-radius: 18px;
            background: rgba(255,255,255,0.12);
            border: 1px solid rgba(255,255,255,0.24);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .logo-box img {
            width: 88px;
            height: 88px;
            object-fit: contain;
        }

        .hero h1 {
            margin: 0;
            font-size: 32px;
            font-weight: 900;
            letter-spacing: -0.03em;
        }

        .hero p {
            margin: 6px 0 0;
            font-size: 14px;
            opacity: 0.95;
        }

        .meta {
            display: flex;
            flex-wrap: wrap;
            gap: 10px 24px;
            padding: 14px 28px;
            border-bottom: 1px solid var(--border);
            background: #f8fbff;
            font-size: 12px;
            color: var(--muted);
        }

        .content {
            padding: 24px 28px 30px;
            display: grid;
            gap: 16px;
        }

        .section {
            border: 1px solid var(--border);
            border-radius: 16px;
            overflow: hidden;
            background: #fff;
        }

        .section-head {
            background: #f3f7ff;
            color: var(--primary-dark);
            padding: 12px 16px;
            font-size: 14px;
            font-weight: 800;
            border-bottom: 1px solid var(--border);
        }

        .section-body {
            padding: 16px;
        }

        .grid-2 {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
        }

        .field {
            border: 1px solid #d7e3f5;
            border-radius: 12px;
            padding: 12px 14px;
            min-height: 58px;
            background: #fff;
        }

        .label {
            display: block;
            font-size: 11px;
            font-weight: 700;
            color: #6b7280;
            margin-bottom: 6px;
        }

        .value {
            font-size: 14px;
            font-weight: 700;
            color: #111827;
            word-break: break-word;
        }

        .fr-title, .ar-title {
            margin: 0 0 10px;
            font-size: 13px;
            font-weight: 800;
        }

        .fr-title { color: var(--text); }
        .ar-title {
            color: var(--primary);
            font-family: 'Noto Naskh Arabic', 'Tahoma', serif;
            direction: rtl;
            text-align: right;
        }

        .split {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
        }

        ul {
            margin: 0;
            padding-left: 18px;
        }

        ul li {
            margin-bottom: 7px;
            line-height: 1.5;
        }

        .arabic-list {
            direction: rtl;
            text-align: right;
            padding-right: 18px;
            padding-left: 0;
            font-family: 'Noto Naskh Arabic', 'Tahoma', serif;
        }

        .arabic-list li {
            margin-bottom: 7px;
            line-height: 1.7;
        }

        .signatures {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;
        }

        .sign-box {
            border: 1px solid var(--border);
            border-radius: 14px;
            min-height: 110px;
            padding: 14px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .sign-title {
            font-size: 13px;
            font-weight: 800;
            color: var(--primary-dark);
            margin: 0;
        }

        .sign-line {
            height: 38px;
            border-bottom: 1px solid #9db6de;
        }

        .footer-note {
            margin-top: 2px;
            border: 1px solid var(--border);
            border-radius: 14px;
            background: #f8fbff;
            padding: 12px 14px;
            font-size: 12px;
            color: #334155;
        }

        .footer-note.ar {
            font-family: 'Noto Naskh Arabic', 'Tahoma', serif;
            direction: rtl;
            text-align: right;
        }

        .actions {
            padding: 0 28px 28px;
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .btn {
            border: none;
            border-radius: 14px;
            padding: 12px 18px;
            font-size: 14px;
            font-weight: 800;
            cursor: pointer;
            transition: transform .15s ease, opacity .15s ease;
        }

        .btn:hover { transform: translateY(-1px); }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-dark), var(--primary));
            color: #fff;
        }

        .btn-ghost {
            background: #eef4fb;
            color: #0f172a;
        }

        .loading {
            padding: 42px 20px;
            text-align: center;
            color: var(--muted);
            font-weight: 700;
        }

        .rtl {
            direction: rtl;
            text-align: right;
            font-family: 'Noto Naskh Arabic', 'Tahoma', serif;
        }

        @media (max-width: 768px) {
            .hero, .grid-2, .split, .signatures {
                grid-template-columns: 1fr;
            }

            .page-shell {
                padding: 14px;
            }

            .hero, .meta, .content, .actions {
                padding-left: 16px;
                padding-right: 16px;
            }
        }

        @media print {
            body {
                background: #fff;
            }
            .actions {
                display: none !important;
            }
            .page-shell {
                padding: 0;
            }
            .card {
                box-shadow: none;
                border-radius: 0;
                border: none;
            }
        }
    </style>
</head>
<body>
@php
    $logoPath = public_path('images/site-logo-navbar.png');
    $logoSrc = file_exists($logoPath)
        ? 'data:image/png;base64,' . base64_encode(file_get_contents($logoPath))
        : asset('images/site-logo-navbar.png');
@endphp
<div class="page-shell">
    <div class="card" id="contractRoot" data-reservation-id="{{ $reservationId }}">
        <div class="hero">
            <div class="logo-box">
                <img id="contractLogo" src="{{ $logoSrc }}" alt="PlayStayHome">
            </div>
            <div>
                <h1>PLAYSTAYHOME</h1>
                <p>Contrat de location de console de jeux / عقد كراء الكونصول</p>
            </div>
        </div>

        <div class="meta">
            <span>Référence contrat: <strong id="contractRef">--</strong></span>
            <span>Réservation: <strong id="reservationIdLabel">--</strong></span>
            <span>Date d'édition: <strong id="issueDate">--</strong></span>
        </div>

        <div id="loadingState" class="loading">Chargement de la réservation...</div>

        <div id="contractContent" class="content hidden">
            <section class="section">
                <div class="section-head">1. Informations du client</div>
                <div class="section-body split">
                    <div>
                        <p class="fr-title">Version Française</p>
                        <div class="grid-2">
                            <div class="field"><span class="label">Nom complet</span><div class="value" id="clientNameFr">--</div></div>
                            <div class="field"><span class="label">Numéro de téléphone</span><div class="value" id="phoneFr">--</div></div>
                            <div class="field"><span class="label">Numéro CIN</span><div class="value" id="cinFr">--</div></div>
                            <div class="field"><span class="label">Adresse</span><div class="value" id="addressFr">--</div></div>
                        </div>
                    </div>
                    <div>
                        <p class="ar-title">النسخة بالدارجة</p>
                        <div class="grid-2 rtl">
                            <div class="field"><span class="label">الاسم الكامل</span><div class="value" id="clientNameAr">--</div></div>
                            <div class="field"><span class="label">رقم الهاتف</span><div class="value" id="phoneAr">--</div></div>
                            <div class="field"><span class="label">رقم البطاقة الوطنية</span><div class="value" id="cinAr">--</div></div>
                            <div class="field"><span class="label">العنوان</span><div class="value" id="addressAr">--</div></div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="section">
                <div class="section-head">2. Détails de la location</div>
                <div class="section-body split">
                    <div>
                        <p class="fr-title">Version Française</p>
                        <div class="grid-2">
                            <div class="field"><span class="label">Type de console</span><div class="value" id="consoleFr">--</div></div>
                            <div class="field"><span class="label">Prix de location</span><div class="value" id="priceFr">--</div></div>
                            <div class="field"><span class="label">Date de prise</span><div class="value" id="startFr">--</div></div>
                            <div class="field"><span class="label">Date de retour</span><div class="value" id="endFr">--</div></div>
                        </div>
                    </div>
                    <div>
                        <p class="ar-title">النسخة بالدارجة</p>
                        <div class="grid-2 rtl">
                            <div class="field"><span class="label">نوع الكونصول</span><div class="value" id="consoleAr">--</div></div>
                            <div class="field"><span class="label">ثمن الكراء</span><div class="value" id="priceAr">--</div></div>
                            <div class="field"><span class="label">تاريخ الاستلام</span><div class="value" id="startAr">--</div></div>
                            <div class="field"><span class="label">تاريخ الإرجاع</span><div class="value" id="endAr">--</div></div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="section">
                <div class="section-head">3. Engagement du client</div>
                <div class="section-body split">
                    <div>
                        <p class="fr-title">Version Française</p>
                        <ul>
                            <li>Le client s'engage à retourner la console en bon état de fonctionnement.</li>
                            <li>En cas de casse, perte ou vol, le client accepte de payer la valeur totale de la console et des accessoires.</li>
                            <li>Le respect des délais de retour est obligatoire.</li>
                        </ul>
                    </div>
                    <div>
                        <p class="ar-title">النسخة بالدارجة</p>
                        <ul class="arabic-list">
                            <li>الزبون كيلتازم يرجّع الكونصول فحالة مزيانة وخدامة.</li>
                            <li>إلا كان الكسر ولا الضياع ولا السرقة، الزبون كيتحمل خلّاص القيمة الكاملة ديال الكونصول واللواحق.</li>
                            <li>احترام تاريخ الإرجاع إجباري.</li>
                        </ul>
                    </div>
                </div>
            </section>

            <section class="section">
                <div class="section-head">4. Conditions générales</div>
                <div class="section-body split">
                    <div>
                        <p class="fr-title">Version Française</p>
                        <ul>
                            <li>Tout retard entraîne des frais supplémentaires selon la politique PlayStayHome.</li>
                            <li>Usage interdit: modification matérielle/logicielle, revente ou sous-location.</li>
                            <li>Le propriétaire se réserve le droit de refuser une location sans justification.</li>
                        </ul>
                    </div>
                    <div>
                        <p class="ar-title">النسخة بالدارجة</p>
                        <ul class="arabic-list">
                            <li>أي تأخير كيترتب عليه مصاريف إضافية حسب شروط الشركة.</li>
                            <li>ممنوع التعديل فالجهاز، ولا البيع، ولا إعادة الكراء لشي طرف آخر.</li>
                            <li>المالك عندو الحق يرفض أي طلب كراء بلا ما يقدّم السبب.</li>
                        </ul>
                    </div>
                </div>
            </section>

            <section class="section">
                <div class="section-head">5. Signature</div>
                <div class="section-body">
                    <div class="split">
                        <div>
                            <p class="fr-title">Version Française</p>
                            <div class="signatures">
                                <div class="sign-box">
                                    <p class="sign-title">Signature du client</p>
                                    <div class="sign-line"></div>
                                </div>
                                <div class="sign-box">
                                    <p class="sign-title">Signature PlayStayHome</p>
                                    <div class="sign-line"></div>
                                </div>
                            </div>
                            <div class="grid-2" style="margin-top:12px;">
                                <div class="field"><span class="label">Date</span><div class="value" id="dateFr">--</div></div>
                                <div class="field"><span class="label">Cachet</span><div class="value">--</div></div>
                            </div>
                        </div>
                        <div>
                            <p class="ar-title">النسخة بالدارجة</p>
                            <div class="signatures rtl">
                                <div class="sign-box">
                                    <p class="sign-title">توقيع الزبون</p>
                                    <div class="sign-line"></div>
                                </div>
                                <div class="sign-box">
                                    <p class="sign-title">توقيع الشركة</p>
                                    <div class="sign-line"></div>
                                </div>
                            </div>
                            <div class="grid-2 rtl" style="margin-top:12px;">
                                <div class="field"><span class="label">التاريخ</span><div class="value" id="dateAr">--</div></div>
                                <div class="field"><span class="label">الخاتم</span><div class="value">--</div></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <div class="footer-note">Ce document est préparé automatiquement à partir de la réservation.</div>
            <div class="footer-note ar">هاد الوثيقة كتتحضر أوتوماتيكيا انطلاقا من معلومات الحجز.</div>
        </div>

        <div class="actions">
            <button id="downloadBtn" class="btn btn-primary" type="button">Télécharger le PDF</button>
            <button id="printBtn" class="btn btn-ghost" type="button">Imprimer / Sauver en PDF</button>
        </div>
    </div>
</div>

<script>
    const reservationId = document.getElementById('contractRoot').dataset.reservationId;

    function getToken() {
        return localStorage.getItem('token');
    }

    function formatDate(value) {
        if (!value) return '--';
        const date = new Date(value);
        if (Number.isNaN(date.getTime())) return '--';
        return date.toLocaleDateString('fr-FR', { day: '2-digit', month: 'short', year: 'numeric' });
    }

    function formatPhone(value) {
        return value || '--';
    }

    function consoleArabic(value) {
        const label = String(value || '').toLowerCase();
        if (label.includes('ps5')) return 'بلايستيشن 5';
        if (label.includes('ps4')) return 'بلايستيشن 4';
        if (label.includes('xbox series x')) return 'إكس بوكس سيريس إكس';
        if (label.includes('xbox')) return 'إكس بوكس';
        return value || '--';
    }

    function fillValue(id, value) {
        const el = document.getElementById(id);
        if (el) el.textContent = value ?? '--';
    }

    async function loadReservation() {
        const token = getToken();
        if (!token) {
            window.location.href = '/login';
            return;
        }

        try {
            const meResponse = await fetch('/api/user', {
                headers: { 'Authorization': 'Bearer ' + token, 'Accept': 'application/json' }
            });
            if (!meResponse.ok) throw new Error('Unauthorized');
            const me = await meResponse.json();
            if (me?.role !== 'admin') {
                window.location.href = '/mon-compte';
                return;
            }

            const response = await fetch(`/api/reservations/${reservationId}`, {
                headers: { 'Authorization': 'Bearer ' + token, 'Accept': 'application/json' }
            });

            if (!response.ok) {
                throw new Error('Impossible de charger la réservation');
            }

            const payload = await response.json();
            const reservation = payload?.data;
            if (!reservation) {
                throw new Error('Réservation introuvable');
            }

            const clientName = reservation.user?.name || 'Client inconnu';
            const phone = formatPhone(reservation.phone);
            const address = reservation.address || '--';
            const cin = reservation.cin || reservation.user?.cin || '--';
            const consoleName = reservation.console?.name || 'Console inconnue';
            const price = reservation.total_price ? `${reservation.total_price} DH` : '0 DH';
            const startDate = formatDate(reservation.start_date);
            const endDate = formatDate(reservation.end_date);
            const issueDate = new Date().toLocaleDateString('fr-FR', { day: '2-digit', month: 'short', year: 'numeric' });
            const reference = `PSH-${String(reservation.id).padStart(5, '0')}`;

            fillValue('clientNameFr', clientName);
            fillValue('phoneFr', phone);
            fillValue('cinFr', cin);
            fillValue('addressFr', address);
            fillValue('clientNameAr', clientName);
            fillValue('phoneAr', phone);
            fillValue('cinAr', cin);
            fillValue('addressAr', address);
            fillValue('consoleFr', consoleName);
            fillValue('consoleAr', consoleArabic(consoleName));
            fillValue('priceFr', price);
            fillValue('priceAr', price);
            fillValue('startFr', startDate);
            fillValue('startAr', startDate);
            fillValue('endFr', endDate);
            fillValue('endAr', endDate);
            fillValue('dateFr', issueDate);
            fillValue('dateAr', issueDate);
            fillValue('contractRef', reference);
            fillValue('reservationIdLabel', reservation.id);
            fillValue('issueDate', issueDate);

            document.getElementById('loadingState').classList.add('hidden');
            document.getElementById('contractContent').classList.remove('hidden');

            return { reservation, reference };
        } catch (error) {
            document.getElementById('loadingState').textContent = 'Impossible de charger la réservation.';
            console.error(error);
            throw error;
        }
    }

    async function downloadPdf() {
        const root = document.getElementById('contractRoot');
        const downloadBtn = document.getElementById('downloadBtn');
        const printBtn = document.getElementById('printBtn');

        if (!window.html2pdf) {
            window.print();
            return;
        }

        const options = {
            margin: [8, 8, 8, 8],
            filename: `Contrat-PlayStayHome-${reservationId}.pdf`,
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: {
                scale: 2,
                useCORS: true,
                backgroundColor: '#ffffff'
            },
            jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' },
            pagebreak: { mode: ['avoid-all', 'css', 'legacy'] }
        };

        downloadBtn.disabled = true;
        printBtn.disabled = true;
        downloadBtn.textContent = 'Génération...';

        try {
            await html2pdf().set(options).from(root).save();
        } finally {
            downloadBtn.disabled = false;
            printBtn.disabled = false;
            downloadBtn.textContent = 'Télécharger le PDF';
        }
    }

    document.getElementById('downloadBtn').addEventListener('click', downloadPdf);
    document.getElementById('printBtn').addEventListener('click', () => window.print());

    (async () => {
        try {
            await loadReservation();
            setTimeout(() => downloadPdf(), 600);
        } catch (error) {
            // keep visible for debugging
        }
    })();
</script>
</body>
</html>
