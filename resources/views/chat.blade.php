<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Support - playstayhome</title>
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
    <!-- IMPORTANT: On importe le fichier JS compilé par Vite pour avoir accès à Echo -->
    @vite(['resources/js/app.js'])
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #d6e2e9;
            color: #111827;
        }

        .nav-link { position: relative; display: inline-flex; align-items: center; height: 40px; font-size: 0.875rem; font-weight: 600; color: #4b5563; transition: color .2s ease; }
        .nav-link::after { content: ""; position: absolute; left: 0; bottom: -1px; width: 100%; height: 2px; background: #1978e5; transform: scaleX(0); transform-origin: center; transition: transform .2s ease; }
        .nav-link:hover, .nav-link.active { color: #1978e5; }
        .nav-link:hover::after, .nav-link.active::after { transform: scaleX(1); }

        .tg-shell {
            border-radius: 0;
            overflow: hidden;
            border: 1px solid #c5d3db;
            box-shadow: none;
            background: #d2dee6;
        }

        .tg-header {
            background: #d2dee6;
            color: #1f2a33;
            border-bottom: 1px solid #bfd0d9;
        }

        .tg-header-sub {
            color: rgba(31, 42, 51, 0.6);
        }

        .tg-chat-bg {
            background-color: #d2dee6;
            background-image: none;
        }

        .tg-date-pill {
            background: transparent;
            color: #6d7f8c;
            border: none;
            padding: 0;
        }

        .tg-bubble {
            border-radius: 14px;
            box-shadow: 0 2px 8px rgba(15, 23, 42, 0.08);
            font-size: 14px;
            line-height: 1.45;
        }

        .tg-bubble-in {
            background: #ffffff;
            color: #253546;
            border-top-left-radius: 6px;
        }

        .tg-bubble-out {
            background: #3f8198;
            color: #f5fbff;
            border-top-right-radius: 6px;
        }

        .tg-message-text {
            white-space: pre-wrap;
            word-break: break-word;
        }

        .tg-command {
            color: #2a8ed9;
            font-weight: 700;
        }

        .tg-time {
            font-size: 11px;
            font-weight: 600;
            opacity: .75;
        }

        #chatMessages::-webkit-scrollbar { width: 6px; }
        #chatMessages::-webkit-scrollbar-track { background: transparent; }
        #chatMessages::-webkit-scrollbar-thumb { background-color: #9cb3c0; border-radius: 20px; }

        .tg-avatar {
            height: 36px;
            width: 36px;
            border-radius: 999px;
            border: 1px solid rgba(255, 255, 255, 0.5);
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        .tg-avatar-user {
            background: #3f8198;
            color: #e8f7ff;
        }

        .tg-avatar-admin {
            background-image: url('/images/admin-support.svg');
            background-color: #edf4fa;
            border-color: #bcd0dc;
        }

        .tg-input-wrap {
            background: #d2dee6;
            border-top: 1px solid #bfd0d9;
        }

        .tg-input {
            border-radius: 999px;
            border: 1px solid #c9d7de;
            background: #f3f7f9;
            color: #253546;
        }

        .tg-input::placeholder {
            color: #8a9ba7;
        }

        .tg-send {
            background: #6ea8bd;
            color: #fff;
            border-radius: 999px;
        }
    </style>
</head>
<body class="flex flex-col min-h-screen">
    @include('partials.navbar-main')

    <main class="flex-grow flex flex-col w-full px-0 py-0">

        <!-- Interface de Chat Complète -->
        <div class="tg-shell flex-grow flex flex-col min-h-0 h-full w-full">
            
            <!-- En-tête du Chat (La personne en face) -->
            <div class="tg-header px-4 py-3 md:px-6 md:py-4 flex justify-between items-center z-10 sticky top-0">
                <div class="flex items-center gap-3">
                    <div class="tg-avatar tg-avatar-admin flex-shrink-0"></div>
                    <div>
                        <h2 class="text-base md:text-lg font-bold tracking-tight">Soutien</h2>
                        <p class="text-xs font-semibold tg-header-sub flex items-center gap-1">
                            1 membre
                        </p>
                    </div>
                </div>
            </div>

            <!-- Zone des messages (Historique) -->
            <div id="chatMessages" class="tg-chat-bg flex-grow px-4 py-5 md:px-6 md:py-6 flex flex-col gap-4 overflow-y-auto relative">
                
                <!-- Date Separator -->
                <div class="flex justify-center my-1">
                    <span class="tg-date-pill text-xs font-semibold">Apr 23 · 12:40 PM</span>
                </div>

                <!-- Bulle de l'Admin (Gauche) -->
                <div class="flex items-end gap-2 max-w-[92%] md:max-w-[78%] self-end">
                    <div class="tg-bubble tg-bubble-out px-4 py-3">
                        <p class="messageAdmin tg-message-text">Bonjour 👋</p>
                        <div class="tg-time text-slate-100 mt-2 text-right">12:40 PM</div>
                    </div>
                    <div class="tg-avatar tg-avatar-user flex items-center justify-center flex-shrink-0" id="myUserAvatarPreview">
                        <i class="fa-regular fa-user text-sm"></i>
                    </div>
                </div>

                <!-- Bulle de l'Utilisateur (Droite) -->
                

               
            </div>

            <!-- Zone de saisie -->
            <div class="tg-input-wrap p-3 md:p-4 z-10">
                <form id="chatForm" class="flex items-end gap-2">
                    <button type="button" class="h-[44px] w-[44px] rounded-full border border-[#bfd0d9] text-[#7993a3] bg-[#edf3f6] flex items-center justify-center flex-shrink-0">
                        <i class="fa-regular fa-face-smile text-base"></i>
                    </button>
                    <div class="relative flex-grow">
                        <textarea id="messageInput" rows="1" class="tg-input w-full px-4 py-3 text-sm font-medium focus:outline-none focus:ring-2 focus:ring-[#8fb4c4]/30 focus:border-[#8fb4c4] transition-all resize-none h-[44px]" placeholder="Ecrire un message..." style="min-height: 44px; max-height: 120px;"></textarea>
                    </div>
                    <button id="sendMessageBtn" type="submit" class="tg-send hover:brightness-95 h-[44px] w-[44px] flex items-center justify-center shadow-sm transition-transform active:scale-95 flex-shrink-0">
                        <i class="fa-solid fa-paper-plane text-sm"></i>
                    </button>
                </form>
            </div>

        </div>
    </main>

    <script>
        // Logique UI basique pour s'assurer que c'est sécurisé (Redirection si non connecté)
        document.addEventListener('DOMContentLoaded', async () => { // Ajout de 'async' ici
            let messageContainer=document.getElementById("chatMessages");
            const token = localStorage.getItem('token');
            if(!token) {
                window.location.href = '/login';
            }

            // Variables globales pour le chat
            let myUserId = null;
            let myUserPhotoUrl = null;
            let myUserName = 'U';

            // 1. Récupérer l'ID de l'utilisateur et démarrer l'écoute temps réel !
            try {
                let userRes = await fetch('/api/user', {
                    headers: { 'Authorization': 'Bearer ' + token, 'Accept': 'application/json' }
                });
                let currentUser = await userRes.json();
                myUserId = currentUser.id;
                myUserPhotoUrl = currentUser.photo_url || null;
                myUserName = currentUser.name || 'U';

                const myUserAvatarPreview = document.getElementById('myUserAvatarPreview');
                if (myUserAvatarPreview && myUserPhotoUrl) {
                    myUserAvatarPreview.innerHTML = `<img src="${escapeHtml(myUserPhotoUrl)}" class="h-full w-full rounded-full object-cover" alt="${escapeHtml(myUserName)}">`;
                } else if (myUserAvatarPreview) {
                    myUserAvatarPreview.innerHTML = `<span class="text-sm font-bold uppercase">${escapeHtml(myUserName.charAt(0))}</span>`;
                }

                // === ÉCOUTE DES WEBSOCKETS (LARAVEL REVERB) ===
                if(window.Echo) {
                    // On rejoint le canal privé de cet utilisateur
                    window.Echo.private(`chat.${myUserId}`)
                        .listen('MessageSent', (e) => {
                            // Quand un message arrive (exemple : l'Admin a répondu)
                            console.log("Nouveau message temps réel : ", e.message);
                            
                            // On recharge simplement les messages pour que le nouveau message s'affiche !
                            // (On pourrait aussi l'ajouter manuellement dans le HTML pour optimiser)
                            loadMessages();
                        });
                }
            } catch(e) {
                console.error("Erreur chargement User :", e);
            }

            function escapeHtml(value) {
                return String(value)
                    .replaceAll('&', '&amp;')
                    .replaceAll('<', '&lt;')
                    .replaceAll('>', '&gt;')
                    .replaceAll('"', '&quot;')
                    .replaceAll("'", '&#039;');
            }

            function formatTelegramLikeText(value) {
                return escapeHtml(value)
                    .split('\n')
                    .map((line) => {
                        if (line.trim().startsWith('/')) {
                            const splitIndex = line.indexOf(' ');
                            if (splitIndex > 0) {
                                const command = line.slice(0, splitIndex);
                                const rest = line.slice(splitIndex);
                                return `<span class="tg-command">${command}</span>${rest}`;
                            }
                            return `<span class="tg-command">${line}</span>`;
                        }
                        return line;
                    })
                    .join('\n');
            }

            function renderMyAvatarHtml() {
                if (myUserPhotoUrl) {
                    return `<div class="tg-avatar tg-avatar-user flex items-center justify-center flex-shrink-0"><img src="${escapeHtml(myUserPhotoUrl)}" class="h-full w-full rounded-full object-cover" alt="${escapeHtml(myUserName)}"></div>`;
                }
                return `<div class="tg-avatar tg-avatar-user flex items-center justify-center flex-shrink-0"><span class="text-sm font-bold uppercase">${escapeHtml(myUserName.charAt(0))}</span></div>`;
            }

            async function loadMessages() {
                try {
                    let res = await fetch('/api/chat/0', {
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json',
                            'Authorization': 'Bearer ' + token
                        }
                    });
                    
                    let cvsHistorique = await res.json();
                    if(cvsHistorique.length > 0) {
                        let chatHtml = '<div class="flex justify-center my-1"><span class="tg-date-pill text-xs font-semibold">Historique de discussion</span></div>';
                        
                        let lastDateStr = "";
                        let today = new Date();
                    let yesterday = new Date();
                    yesterday.setDate(today.getDate() - 1);

                    // Formater une date JS en 'YYYY-MM-DD'
                    const formatDateStr = (date) => date.getFullYear() + '-' + String(date.getMonth() + 1).padStart(2, '0') + '-' + String(date.getDate()).padStart(2, '0');
                    let todayStr = formatDateStr(today);
                    let yesterdayStr = formatDateStr(yesterday);

                    cvsHistorique.forEach(message => {
                        let dateObj = new Date(message.created_at);
                        
                        // ======= LOGIQUE DATE (Aujourd'hui, Hier) =======
                        let msgDateStr = formatDateStr(dateObj);
                        
                        // Si la date du message actuel est différente de celle du message précédent, on affiche un séparateur
                        if (msgDateStr !== lastDateStr) {
                            let displayText = "";
                            if (msgDateStr === todayStr) {
                                displayText = "Aujourd'hui";
                            } else if (msgDateStr === yesterdayStr) {
                                displayText = "Hier";
                            } else {
                                // Exemple: "11/04/2026" pour les dates plus anciennes
                                displayText = String(dateObj.getDate()).padStart(2, '0') + '/' + String(dateObj.getMonth() + 1).padStart(2, '0') + '/' + dateObj.getFullYear();
                            }

                            chatHtml += `
                            <div class="flex justify-center my-3">
                                <span class="tg-date-pill text-xs font-semibold">${displayText}</span>
                            </div>`;
                            
                            lastDateStr = msgDateStr; // On met à jour la dernière date vue
                        }
                        
                        // ======= LOGIQUE HEURE & BULLES =======
                        // Formater l'heure
                        let time = dateObj.getHours().toString().padStart(2, '0') + ':' + dateObj.getMinutes().toString().padStart(2, '0');

                        if (message.sender_id === myUserId) {
                            chatHtml += `
                            <div class="flex items-end gap-2 max-w-[92%] md:max-w-[78%] self-end mb-3">
                                <div class="tg-bubble tg-bubble-out px-4 py-3">
                                    <p class="messageUser tg-message-text">${formatTelegramLikeText(message.message)}</p>
                                    <div class="tg-time text-slate-100 mt-2 text-right">${time}</div>
                                </div>
                                ${renderMyAvatarHtml()}
                            </div>`;
                        } 
                        // Si c'est l'admin (Bulle Gauche Blanche)
                        else {
                            chatHtml += `
                            <div class="flex items-end gap-2 max-w-[92%] md:max-w-[78%] mb-3">
                                <div class="tg-avatar tg-avatar-admin flex-shrink-0"></div>
                                <div class="tg-bubble tg-bubble-in px-4 py-3">
                                    <p class="messageAdmin tg-message-text">${formatTelegramLikeText(message.message)}</p>
                                    <div class="tg-time text-slate-500 mt-2 text-right">${time}</div>
                                </div>
                            </div>`;
                        }
                    });

                    // On injecte le tout dans la zone de chat et on scrolle
                    const chatContainer = document.getElementById('chatMessages');
                    chatContainer.innerHTML = chatHtml;
                    
                    setTimeout(() => {
                        chatContainer.scrollTop = chatContainer.scrollHeight;
                        // Si le conteneur lui-même n'a pas de scroll et que c'est la page qui grandit :
                        window.scrollTo({ top: document.body.scrollHeight, behavior: 'smooth' });
                    }, 100);

                }
                else{
                    document.getElementById('chatMessages').innerHTML = '<div class="text-center text-gray-400 mt-10 text-sm">Envoyez le premier message pour lancer la discussion avec notre équipe de support.</div>';
                }
            }catch(e){

            }
                
                    
               
            }
            loadMessages();

            // === 2. EVENT LISTENER POUR ENVOYER UN MESSAGE ===
            const chatForm = document.getElementById('chatForm');
            const messageInput = document.getElementById('messageInput');
            const sendMessageBtn = document.getElementById('sendMessageBtn');

            messageInput.addEventListener('keydown', (e) => {
                // Entrée envoie le message, sans retour à la ligne.
                // Shift + Entrée permet de garder un saut de ligne si besoin.
                if (e.key === 'Enter' && !e.shiftKey) {
                    e.preventDefault();
                    chatForm.requestSubmit(sendMessageBtn);
                }
            });

            chatForm.addEventListener('submit', async (e) => {
                e.preventDefault(); // Empêche la page de se recharger
                const text = messageInput.value.trim();

                if (!text) return; // Ne rien faire si le message est vide

                try {
                    let response = await fetch('/api/chat/0', {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json',
                            'Authorization': 'Bearer ' + token
                        },
                        body: JSON.stringify({ message: text }) // On envoie le message saisi (Laravel attend le champ "message")
                    });

                    if (response.ok) {
                        messageInput.value = ''; // On vide le champ de texte
                        loadMessages(); // On actualise l'historique direct pour y voir le nouveau message apparaitre
                    }
                } catch (error) {
                    console.error("Erreur lors de l'envoi du message :", error);
                }
            });
        });
    </script>
</body>
</html>
