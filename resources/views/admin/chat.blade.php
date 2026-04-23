<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Chat - playstayhome</title>
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
    @vite(['resources/js/app.js'])
    <style>
        body { font-family: 'Inter', sans-serif; background: #d6e2e9; color: #111827; overflow: hidden; }
        #chatMessages::-webkit-scrollbar,
        #usersList::-webkit-scrollbar {
            width: 6px;
        }
        #chatMessages::-webkit-scrollbar-track,
        #usersList::-webkit-scrollbar-track {
            background: transparent;
        }
        #chatMessages::-webkit-scrollbar-thumb,
        #usersList::-webkit-scrollbar-thumb {
            background-color: #9cb3c0;
            border-radius: 20px;
        }
        /* Cache la scrollbar native du textarea */
        textarea::-webkit-scrollbar { display: none; }
        textarea { -ms-overflow-style: none; scrollbar-width: none; }

        .tg-chat-bg { background: #d2dee6; }
        .tg-header { background: #d2dee6; border-bottom: 1px solid #bfd0d9; }
        .tg-input-wrap { background: #d2dee6; border-top: 1px solid #bfd0d9; }
        .tg-date-pill { color: #6d7f8c; }
        .tg-bubble {
            border-radius: 14px;
            box-shadow: 0 2px 8px rgba(15, 23, 42, 0.08);
            font-size: 14px;
            line-height: 1.45;
        }
        .tg-bubble-out { background: #3f8198; color: #f5fbff; border-top-right-radius: 6px; }
        .tg-bubble-in { background: #ffffff; color: #253546; border-top-left-radius: 6px; }
        .tg-time { font-size: 11px; font-weight: 600; opacity: .75; }
        .tg-message-text { white-space: pre-wrap; word-break: break-word; }
        .tg-avatar {
            height: 36px;
            width: 36px;
            border-radius: 999px;
            border: 1px solid rgba(255, 255, 255, 0.5);
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            overflow: hidden;
            flex-shrink: 0;
        }
        .tg-avatar-admin {
            background-image: url('/images/admin-support.svg');
            background-color: #edf4fa;
            border-color: #bcd0dc;
        }
        .tg-avatar-user {
            background: #3f8198;
            color: #e8f7ff;
        }
        .tg-input {
            border-radius: 999px;
            border: 1px solid #c9d7de;
            background: #f3f7f9;
            color: #253546;
        }
        .tg-input::placeholder { color: #8a9ba7; }
        .tg-send {
            background: #6ea8bd;
            color: #fff;
            border-radius: 999px;
        }
    </style>
</head>
<body class="flex h-screen">

    <!-- Sidebar / Menu Latéral -->
    <aside class="w-[260px] bg-white border-r border-gray-100 flex flex-col justify-between py-8 px-6 shrink-0 h-full z-20">
        <div>
            <!-- Logo -->
            <div class="flex items-center gap-2 px-2 mb-12">
                <i class="fa-solid fa-gamepad text-primary text-2xl"></i>
                <span class="font-black text-xl tracking-tight">PLAYSTAYHOME</span>
            </div>
            
            <!-- Navigation -->
            <nav class="flex flex-col gap-2">
                <a href="/admin/dashboard" class="text-gray-500 hover:text-gray-900 hover:bg-gray-50 px-5 py-3.5 rounded-xl font-bold text-sm transition-colors">
                    Dashboard
                </a>
                <a href="/admin/reservations" class="text-gray-500 hover:text-gray-900 hover:bg-gray-50 px-5 py-3.5 rounded-xl font-bold text-sm transition-colors">
                    Réservations
                </a>
                <a href="/admin/users" class="text-gray-500 hover:text-gray-900 hover:bg-gray-50 px-5 py-3.5 rounded-xl font-bold text-sm transition-colors">
                    Utilisateurs
                </a>
                <a href="/admin/consoles-games" class="text-gray-500 hover:text-gray-900 hover:bg-gray-50 px-5 py-3.5 rounded-xl font-bold text-sm transition-colors">
                    Consoles & Jeux
                </a>
                <a href="/admin/chat" class="bg-primary text-white px-5 py-3.5 rounded-xl font-bold text-sm flex items-center shadow-[0_4px_15px_rgba(25,120,229,0.2)]">
                    Support Chat
                </a>
            </nav>
        </div>
        
        <div class="border-t border-gray-100 pt-6 mt-10">
            <a href="#" class="text-red-500 hover:text-red-600 hover:bg-red-50 px-5 py-3.5 rounded-xl font-black text-sm transition-colors flex items-center">
                Déconnexion
            </a>
        </div>
    </aside>

    <!-- Contenu Principal (Interface Chat Admin) -->
    <main class="flex-1 flex overflow-hidden">
        
        <!-- Colonne Gauche : Liste des clients -->
        <div class="w-[350px] border-r border-[#bfd0d9] flex flex-col shrink-0 bg-[#d2dee6]">
            <div class="p-6 border-b border-[#bfd0d9] shrink-0">
                <h2 class="text-xl font-black text-gray-900 tracking-tight mb-4">Messages</h2>
                <!-- Barre de recherche -->
                <div class="relative">
                    <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-[#7b92a2]"></i>
                    <input type="text" placeholder="Rechercher un client..." class="w-full bg-[#edf3f6] border border-[#bfd0d9] text-gray-900 rounded-xl pl-10 pr-4 py-2.5 text-sm font-medium focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all">
                </div>
            </div>
            
            <!-- Liste des conversations -->
            <div id="usersList" class="flex-1 overflow-y-auto p-3 space-y-1">
                
                <!-- Client Actif (Toi ou Sarah par ex) -->
                <button class="w-full flex items-center gap-3 p-3 rounded-2xl bg-blue-50 border border-blue-100 text-left transition-colors relative">
                    <div class="relative shrink-0">
                        <div class="w-12 h-12 rounded-full bg-blue-200 text-primary flex items-center justify-center font-bold text-lg">M</div>
                        <span class="absolute bottom-0 right-0 h-3.5 w-3.5 rounded-full bg-green-500 border-2 border-white"></span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex justify-between items-baseline mb-0.5">
                            <h3 class="font-bold text-gray-900 text-sm truncate">Mouad</h3>
                            <span class="text-[10px] font-bold text-primary">10:35</span>
                        </div>
                        <p class="text-xs text-primary font-semibold truncate">C'est noté ! Merci beaucoup.</p>
                    </div>
                </button>

                <!-- Client Inactif -->
                <button class="w-full flex items-center gap-3 p-3 rounded-2xl hover:bg-gray-50 text-left transition-colors">
                    <div class="relative shrink-0">
                        <div class="w-12 h-12 rounded-full bg-gray-100 text-gray-500 flex items-center justify-center font-bold text-lg">S</div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex justify-between items-baseline mb-0.5">
                            <h3 class="font-bold text-gray-900 text-sm truncate">Sarah L.</h3>
                            <span class="text-[10px] font-bold text-gray-400">Hier</span>
                        </div>
                        <p class="text-xs text-gray-500 truncate">Bonjour, j'aimerais savoir s'il...</p>
                    </div>
                </button>
                
            </div>
        </div>

        <!-- Colonne Droite : Zone de Chat Active -->
        <div class="flex-1 flex flex-col tg-chat-bg">
            
            <!-- Header du Chat en cours -->
            <div class="tg-header p-4 md:p-5 flex justify-between items-center shrink-0 z-10">
                <div class="flex items-center gap-4 hidden" id="chatHeaderInfo">
                    <div class="shrink-0" id="headerAvatarContainer">
                        <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold shadow-inner">M</div>
                    </div>
                    <div>
                        <h2 class="text-base font-black text-gray-900 tracking-tight" id="activeUserName">Chargement...</h2>
                        <p class="text-xs font-bold text-[#6d7f8c]" id="activeUserRef">Client #--</p>
                    </div>
                </div>
            </div>

            <!-- Messages Dynamiques -->
            <div id="chatMessages" class="flex-1 overflow-y-auto px-4 py-5 md:px-6 md:py-6 flex flex-col gap-4 relative">
                <!-- Les messages seront chargés ici asynchrone par le JS -->
            </div>

            <!-- Zone de saisie -->
            <div class="tg-input-wrap p-3 md:p-4 shrink-0">
                <form id="chatForm" class="flex items-end gap-2">
                    <button type="button" class="h-[44px] w-[44px] rounded-full border border-[#bfd0d9] text-[#7993a3] bg-[#edf3f6] flex items-center justify-center flex-shrink-0">
                        <i class="fa-regular fa-face-smile text-base"></i>
                    </button>
                    <div class="relative flex-grow">
                        <textarea id="messageInput" rows="1" class="tg-input w-full px-4 py-3 text-sm font-medium focus:outline-none focus:ring-2 focus:ring-[#8fb4c4]/30 focus:border-[#8fb4c4] transition-all resize-none h-[44px]" placeholder="Répondre au client..." style="min-height: 44px; max-height: 120px;"></textarea>
                    </div>
                    <button id="sendMessageBtn" type="submit" class="tg-send hover:brightness-95 h-[44px] w-[44px] flex items-center justify-center shadow-sm transition-transform active:scale-95 shrink-0">
                        <i class="fa-solid fa-paper-plane text-sm"></i>
                    </button>
                </form>
            </div>

        </div>

    </main>

    <script>
        document.addEventListener('DOMContentLoaded', async () => {
            const token = localStorage.getItem('token');
            if (!token) window.location.href = '/login';

            let urlParams = new URLSearchParams(window.location.search);
            let currentUserId = urlParams.get('user');

            // Écoute temps réel sur le canal de l'admin
            try {
                let meRes = await fetch('/api/user', {
                    headers: { 'Authorization': 'Bearer ' + token, 'Accept': 'application/json' }
                });
                let me = await meRes.json();
                let myAdminId = me.id;

                if (window.Echo) {
                    window.Echo.private(`chat.${myAdminId}`)
                        .listen('MessageSent', (e) => {
                            if (!currentUserId || !e || !e.message) return;

                            const senderId = String(e.message.sender_id);
                            const receiverId = String(e.message.receiver_id);

                            if (senderId === String(currentUserId) || receiverId === String(currentUserId)) {
                                loadMessages();
                            }
                        });
                }
            } catch (e) {
                console.error('Erreur websocket admin:', e);
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
                return escapeHtml(value).split('\n').join('\n');
            }

            // Scroller automatiquement vers le bas de la zone de messages
            const chatMessages = document.getElementById('chatMessages');
            if (chatMessages) chatMessages.scrollTop = chatMessages.scrollHeight;

            async function loadMessages() {
                if (!currentUserId) {
                    document.getElementById('chatMessages').innerHTML = '<div class="text-center text-gray-400 mt-10 text-sm">Veuillez sélectionner un utilisateur à gauche pour discuter.</div>';
                    return;
                }

                // 1. Récupérer mon ID
                let userRes = await fetch('/api/user', {
                    headers: { 'Authorization': 'Bearer ' + token, 'Accept': 'application/json' }
                });
                let currentUser = await userRes.json();
                let myAdminId = currentUser.id;

                try {
                    let res = await fetch('/api/chat/' + currentUserId, {
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json',
                            'Authorization': 'Bearer ' + token
                        }
                    });
                    let cvsHistorique = await res.json();

                    if (cvsHistorique.length > 0) {
                        let chatHtml = '<div class="flex justify-center my-1"><span class="tg-date-pill text-xs font-semibold">Historique de discussion</span></div>';
                        
                        let lastDateStr = "";
                        let today = new Date();
                        let yesterday = new Date();
                        yesterday.setDate(today.getDate() - 1);

                        const formatDateStr = (date) => date.getFullYear() + '-' + String(date.getMonth() + 1).padStart(2, '0') + '-' + String(date.getDate()).padStart(2, '0');
                        let todayStr = formatDateStr(today);
                        let yesterdayStr = formatDateStr(yesterday);

                        cvsHistorique.forEach(message => {
                            let dateObj = new Date(message.created_at);
                            let msgDateStr = formatDateStr(dateObj);
                            
                            // ======= LOGIQUE DATE (Aujourd'hui, Hier) =======
                            if (msgDateStr !== lastDateStr) {
                                let displayText = "";
                                if (msgDateStr === todayStr) {
                                    displayText = "Aujourd'hui";
                                } else if (msgDateStr === yesterdayStr) {
                                    displayText = "Hier";
                                } else {
                                    displayText = String(dateObj.getDate()).padStart(2, '0') + '/' + String(dateObj.getMonth() + 1).padStart(2, '0') + '/' + dateObj.getFullYear();
                                }

                                chatHtml += `
                                <div class="flex justify-center my-3">
                                    <span class="tg-date-pill text-xs font-semibold">${displayText}</span>
                                </div>`;
                                
                                lastDateStr = msgDateStr; 
                            }
                            
                            // ======= LOGIQUE HEURE =======
                            let time = dateObj.getHours().toString().padStart(2, '0') + ':' + dateObj.getMinutes().toString().padStart(2, '0');

                            // Si c'est l'admin (Moi) qui a envoyé (Bulle Droite Bleue)
                            if (message.sender_id === myAdminId) {
                                chatHtml += `
                                <div class="flex items-end gap-2 max-w-[92%] md:max-w-[78%] self-end mb-3">
                                    <div class="tg-bubble tg-bubble-out px-4 py-3">
                                        <p class="tg-message-text">${formatTelegramLikeText(message.message)}</p>
                                        <div class="tg-time text-slate-100 mt-2 text-right">${time}</div>
                                    </div>
                                    <div class="tg-avatar tg-avatar-admin"></div>
                                </div>`;
                            } 
                            // Si c'est le Client (Bulle Gauche Blanche)
                            else {
                                // On récupère sa photo de profil s'il l'a depuis l'historique API ! 
                                // (On gère le cas où "sender" n'est pas fourni par l'API pour éviter les erreurs)
                                let clientPhoto = "";
                                if (message.sender && message.sender.photo_url) {
                                    clientPhoto = `<img src="${escapeHtml(message.sender.photo_url)}" class="w-9 h-9 rounded-full object-cover shrink-0 border border-white/50" alt="Client">`;
                                } else if (message.sender && message.sender.photo) {
                                    clientPhoto = `<img src="/storage/${escapeHtml(message.sender.photo)}" class="w-9 h-9 rounded-full object-cover shrink-0 border border-white/50" alt="Client">`;
                                } else {
                                    let initLetter = message.sender && message.sender.name ? message.sender.name.charAt(0).toUpperCase() : 'C';
                                    clientPhoto = `<div class="w-9 h-9 rounded-full bg-gray-100 text-gray-500 flex items-center justify-center font-bold text-xs shrink-0">${escapeHtml(initLetter)}</div>`;
                                }

                                chatHtml += `
                                <div class="flex items-end gap-2 max-w-[92%] md:max-w-[78%] mb-3">
                                    ${clientPhoto}
                                    <div class="tg-bubble tg-bubble-in px-4 py-3">
                                        <p class="tg-message-text">${formatTelegramLikeText(message.message)}</p>
                                        <div class="tg-time text-slate-500 mt-2 text-right">${time}</div>
                                    </div>
                                </div>`;
                            }
                        });

                        const chatContainer = document.getElementById('chatMessages');
                        chatContainer.innerHTML = chatHtml;
                        
                        // en attend 100 miliseconde jusque les photo sont chargé 
                        // et ensuite on calcule la hauteur pour faire scroll down
                        setTimeout(() => {
                            chatContainer.scrollTop = chatContainer.scrollHeight;
                        }, 100);

                    } else {
                        document.getElementById('chatMessages').innerHTML = '<div class="text-center text-[#6d7f8c] mt-10 text-sm">Le client n\'a pas encore envoyé de message.</div>';
                    }
                } catch(e) {
                    console.error("Erreur:", e);
                }
            }

            // Charger les messages au démarrage
            loadMessages();

            // EVENT LISTENER POUR ENVOYER UN APPEL API (Bouton Submit)
            const chatForm = document.getElementById('chatForm');
            const messageInput = document.getElementById('messageInput');
            const sendMessageBtn = document.getElementById('sendMessageBtn');

            messageInput.addEventListener('keydown', (e) => {
                if (e.key === 'Enter' && !e.shiftKey) {
                    e.preventDefault();
                    chatForm.requestSubmit(sendMessageBtn);
                }
            });

            chatForm.addEventListener('submit', async (e) => {
                e.preventDefault(); 
                const text = messageInput.value.trim();

                if (!text || !currentUserId) return; 

                try {
                    let response = await fetch('/api/chat/' + currentUserId, {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json',
                            'Authorization': 'Bearer ' + token
                        },
                        body: JSON.stringify({ message: text }) 
                    });

                    if (response.ok) {
                        messageInput.value = ''; 
                        loadMessages(); // On actualise l'historique direct
                    }
                } catch (error) {
                    console.error("Erreur lors de l'envoi du message :", error);
                }
            });

            // Charger la petite liste des clients sur la gauche
            async function loadClientsList() {
                try {
                    let response = await fetch('/api/users', {
                        headers: { 'Accept': 'application/json', 'Authorization': 'Bearer ' + token }
                    });
                    if (response.ok) {
                        let users = await response.json();
                        let clientsListHtml = '';
                        
                        let clientsOnly = users.filter(u => u.role !== 'admin');

                        clientsOnly.forEach(user => {
                            let isCurrent = (String(user.id) === String(currentUserId));
                            let initial = user.name.charAt(0).toUpperCase();

                            let userAvatar = user.photo_url
                                ? `<img src="${escapeHtml(user.photo_url)}" class="w-12 h-12 rounded-full object-cover">`
                                : user.photo
                                    ? `<img src="/storage/${escapeHtml(user.photo)}" class="w-12 h-12 rounded-full object-cover">`
                                    : `<div class="w-12 h-12 rounded-full ${isCurrent ? 'bg-blue-200 text-primary' : 'bg-gray-100 text-gray-500'} flex items-center justify-center font-bold text-lg">${escapeHtml(initial)}</div>`;

                            // On n'utilise plus window.currentClientPhoto, on passe juste currentClientPhoto en variable simple
                            // L'avatar du client actuel sera géré dans l'affichage des messages plus bas
                            
                            // Au lieu d'utiliser JavaScript complexes (pushState, switchUser), on utilise de simples liens HTML
                            clientsListHtml += `
                            <a href="/admin/chat?user=${user.id}" class="w-full flex items-center gap-3 p-3 rounded-2xl ${isCurrent ? 'bg-blue-50 border border-blue-100' : 'hover:bg-[#d9e6ee] border border-transparent'} text-left transition-colors relative mb-1">
                                <div class="relative shrink-0">
                                    ${userAvatar}
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex justify-between items-baseline mb-0.5">
                                        <h3 class="font-bold text-gray-900 text-sm truncate">${escapeHtml(user.name)}</h3>
                                        <span class="text-[10px] font-bold ${isCurrent ? 'text-primary' : 'text-gray-400'}">Client</span>
                                    </div>
                                    <p class="text-xs ${isCurrent ? 'text-primary font-semibold' : 'text-gray-500'} truncate">#USR-${String(user.id).padStart(4, '0')}</p>
                                </div>
                            </a>`;

                            if (isCurrent) {
                                document.getElementById('chatHeaderInfo').classList.remove('hidden');
                                document.getElementById('activeUserName').textContent = user.name;
                                document.getElementById('activeUserRef').textContent = `Client #USR-${String(user.id).padStart(4, '0')}`;
                                // Actualise l'avatar dans l'en-tête
                                let headerAvatar = document.getElementById('headerAvatarContainer');
                                if (headerAvatar) {
                                    if (user.photo_url) {
                                        headerAvatar.innerHTML = `<img src="${escapeHtml(user.photo_url)}" class="w-10 h-10 rounded-full object-cover border border-white/60" alt="${escapeHtml(user.name)}">`;
                                    } else if(user.photo) {
                                        headerAvatar.innerHTML = `<img src="/storage/${escapeHtml(user.photo)}" class="w-10 h-10 rounded-full object-cover border border-white/60" alt="${escapeHtml(user.name)}">`;
                                    } else {
                                        headerAvatar.innerHTML = `<div class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-lg">${escapeHtml(initial)}</div>`;
                                    }
                                }
                            }
                        });
                        
                        document.getElementById('usersList').innerHTML = clientsListHtml;
                    }
                } catch (error) {
                    console.error(error);
                }
            }

            loadClientsList();
        });
    </script>
</body>
</html>
