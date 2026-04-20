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
        body { font-family: 'Inter', sans-serif; background: #f8fafc; color: #111827; }
        .nav-link { position: relative; display: inline-flex; align-items: center; height: 40px; font-size: 0.875rem; font-weight: 600; color: #4b5563; transition: color .2s ease; }
        .nav-link::after { content: ""; position: absolute; left: 0; bottom: -1px; width: 100%; height: 2px; background: #1978e5; transform: scaleX(0); transform-origin: center; transition: transform .2s ease; }   
        .nav-link:hover, .nav-link.active { color: #1978e5; }
        .nav-link:hover::after, .nav-link.active::after { transform: scaleX(1); }

        /* Scrollbar custom pour le chat */
        #chatMessages::-webkit-scrollbar {
            width: 6px;
        }
        #chatMessages::-webkit-scrollbar-track {
            background: transparent;
        }
        #chatMessages::-webkit-scrollbar-thumb {
            background-color: #cbd5e1;
            border-radius: 20px;
        }
    </style>
</head>
<body class="flex flex-col min-h-screen">
    @include('partials.navbar-main')

    <main class="flex-grow flex flex-col max-w-4xl mx-auto w-full px-4 py-8">
        
        <!-- Header de la page -->
        <div class="mb-6">
            <h1 class="text-2xl md:text-3xl font-black text-gray-900 tracking-tight">Assistance Client</h1>
            <p class="text-gray-500 font-medium text-sm mt-2">Discutez en direct avec notre équipe en cas de problème ou de question.</p>
        </div>

        <!-- Interface de Chat Complète -->
        <div class="flex-grow flex flex-col bg-white rounded-3xl border border-gray-100 shadow-[0_4px_20px_rgba(15,23,42,0.03)] overflow-hidden min-h-[500px]">
            
            <!-- En-tête du Chat (La personne en face) -->
            <div class="border-b border-gray-100 p-4 md:px-8 md:py-6 flex justify-between items-center bg-white z-10 sticky top-0">
                <div class="flex items-center gap-4">
                    <div class="relative">
                        <div class="h-12 w-12 rounded-full bg-blue-50 flex items-center justify-center text-primary border border-blue-100 shadow-inner">
                            <i class="fa-solid fa-headset text-xl"></i>
                        </div>
                        <span class="absolute bottom-0 right-0 h-3.5 w-3.5 rounded-full bg-green-500 border-2 border-white"></span>
                    </div>
                    <div>
                        <h2 class="text-base font-black text-gray-900 tracking-tight">Équipe PLAYSTAYHOME</h2>
                        <p class="text-xs font-bold text-green-500 flex items-center gap-1">
                            <span class="inline-block h-1.5 w-1.5 rounded-full bg-green-500 animate-pulse"></span>
                            En ligne
                        </p>
                    </div>
                </div>
            </div>

            <!-- Zone des messages (Historique) -->
            <div id="chatMessages" class="flex-grow p-4 md:p-8 bg-gray-50/50 flex flex-col gap-6 overflow-y-auto relative">
                
                <!-- Date Separator -->
                <div class="flex justify-center my-2">
                    <span class="text-[10px] font-black uppercase tracking-widest text-gray-400 bg-white px-4 py-1.5 rounded-full shadow-sm border border-gray-100">Aujourd'hui</span>
                </div>

                <!-- Bulle de l'Admin (Gauche) -->
                <div class="flex items-end gap-3 max-w-[85%] md:max-w-[70%]">
                    <div class="h-8 w-8 rounded-full bg-blue-50 flex items-center justify-center text-primary flex-shrink-0 shadow-sm border border-blue-100">
                        <i class="fa-solid fa-headset text-xs"></i>
                    </div>
                    <div class="bg-white p-4 rounded-2xl rounded-bl-sm shadow-[0_2px_10px_rgba(15,23,42,0.02)] border border-gray-100 text-sm font-medium text-gray-700 leading-relaxed relative group">
                        <p class="messageAdmin">Bonjour ! 👋 Bienvenue sur le chat d'assistance <strong>PLAYSTAYHOME</strong>. Avez-vous une question concernant une réservation de console ou de manettes ?</p>
                        <div class="text-[10px] font-bold text-gray-400 mt-2 flex items-center gap-1">
                            <p class="time">10:35</p>
                        </div>
                    </div>
                </div>

                <!-- Bulle de l'Utilisateur (Droite) -->
                <div class="flex items-end gap-3 max-w-[85%] md:max-w-[70%] self-end flex-row-reverse">
                    <div class="bg-primary hover:bg-blue-600 transition-colors p-4 rounded-2xl rounded-br-sm shadow-sm text-sm font-medium text-white leading-relaxed">
                        <p class="messageUser">Bonjour, j'aimerais savoir s'il y a des remises si je prolonge ma location d'une semaine supplémentaire ?</p>
                        <div class="text-[10px] font-bold text-blue-200 mt-2 flex items-center justify-end gap-1">
                            <p class="time">10:35</p> <i class="fa-solid fa-check-double drop-shadow-sm"></i>
                        </div>
                    </div>
                </div>

                <!-- Bulle de l'Admin en train d'écrire... (Optionnel pour le design) -->
                <div class="flex items-end gap-3 max-w-[85%] md:max-w-[70%] mt-2">
                    <div class="h-8 w-8 rounded-full bg-blue-50 flex items-center justify-center text-primary flex-shrink-0 shadow-sm border border-blue-100">
                        <i class="fa-solid fa-headset text-xs"></i>
                    </div>
                    <div class="bg-white px-4 py-3 rounded-2xl rounded-bl-sm shadow-sm border border-gray-100 flex items-center gap-1.5 h-[42px]">
                        <span class="h-1.5 w-1.5 bg-gray-300 rounded-full animate-bounce"></span>
                        <span class="h-1.5 w-1.5 bg-gray-300 rounded-full animate-bounce" style="animation-delay: 0.1s"></span>
                        <span class="h-1.5 w-1.5 bg-gray-300 rounded-full animate-bounce" style="animation-delay: 0.2s"></span>
                    </div>
                </div>
            </div>

            <!-- Zone de saisie -->
            <div class="bg-white border-t border-gray-100 p-4 md:p-6 z-10">
                <form id="chatForm" class="flex items-center gap-3">
                    <div class="relative flex-grow">
                        <textarea id="messageInput" rows="1" class="w-full bg-gray-50 border border-gray-200 text-gray-900 rounded-2xl pl-4 pr-12 py-3.5 text-sm font-medium focus:outline-none focus:ring-2 focus:ring-primary/20 focus:bg-white focus:border-primary transition-all placeholder-gray-400 resize-none h-[50px] scrollbar-hide" placeholder="Écrivez votre message..." style="min-height: 50px; max-height: 120px;"></textarea>
                    </div>
                    <button type="button" class="bg-white border border-gray-200 hover:bg-gray-50 text-gray-500 hover:text-primary h-[50px] w-[50px] rounded-2xl flex items-center justify-center shadow-sm transition-colors flex-shrink-0">
                        <i class="fa-solid fa-paperclip"></i>
                    </button>
                    <button type="submit" class="bg-primary hover:bg-blue-600 text-white h-[50px] w-[50px] rounded-2xl flex items-center justify-center shadow-sm transition-transform active:scale-95 flex-shrink-0">
                        <i class="fa-solid fa-paper-plane"></i>
                    </button>
                </form>
                <div class="text-center mt-3 hidden md:block">
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Temps de réponse habituel : moins de 5 minutes</p>
                </div>
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

            // 1. Récupérer l'ID de l'utilisateur et démarrer l'écoute temps réel !
            try {
                let userRes = await fetch('/api/user', {
                    headers: { 'Authorization': 'Bearer ' + token, 'Accept': 'application/json' }
                });
                let currentUser = await userRes.json();
                myUserId = currentUser.id;

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
                        let chatHtml = '<div class="flex justify-center my-4"><span class="text-[10px] font-black uppercase tracking-widest text-gray-400 bg-white px-4 py-1.5 rounded-full shadow-sm border border-gray-100">Historique de discussion</span></div>';
                        
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
                            <div class="flex justify-center my-6">
                                <span class="text-[10px] font-black uppercase tracking-widest text-gray-400 bg-white px-4 py-1.5 rounded-full shadow-sm border border-gray-100">${displayText}</span>
                            </div>`;
                            
                            lastDateStr = msgDateStr; // On met à jour la dernière date vue
                        }
                        
                        // ======= LOGIQUE HEURE & BULLES =======
                        // Formater l'heure
                        let time = dateObj.getHours().toString().padStart(2, '0') + ':' + dateObj.getMinutes().toString().padStart(2, '0');

                        if (message.sender_id === myUserId) {
                            chatHtml += `
                            <div class="flex items-end gap-3 max-w-[85%] md:max-w-[70%] self-end flex-row-reverse mb-4">
                                <div class="bg-primary hover:bg-blue-600 transition-colors p-4 rounded-2xl rounded-br-sm shadow-sm text-sm font-medium text-white leading-relaxed">
                                    <p class="messageUser">${message.message}</p>
                                    <div class="text-[10px] font-bold text-blue-200 mt-2 flex items-center justify-end gap-1">
                                        <p class="time">${time}</p>
                                    </div>
                                </div>
                            </div>`;
                        } 
                        // Si c'est l'admin (Bulle Gauche Blanche)
                        else {
                            chatHtml += `
                            <div class="flex items-end gap-3 max-w-[85%] md:max-w-[70%] mb-4">
                                <div class="h-8 w-8 rounded-full bg-blue-50 flex items-center justify-center text-primary flex-shrink-0 shadow-sm border border-blue-100">
                                    <i class="fa-solid fa-headset text-xs"></i>
                                </div>
                                <div class="bg-white p-4 rounded-2xl rounded-bl-sm shadow-[0_2px_10px_rgba(15,23,42,0.02)] border border-gray-100 text-sm font-medium text-gray-700 leading-relaxed relative group">
                                    <p class="messageAdmin">${message.message}</p>
                                    <div class="text-[10px] font-bold text-gray-400 mt-2 flex items-center gap-1">
                                        <p class="time">${time}</p>
                                    </div>
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
