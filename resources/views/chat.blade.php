<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Support - PLAYSTAIHOME</title>
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
                        <h2 class="text-base font-black text-gray-900 tracking-tight">Équipe PLAYSTAIHOME</h2>
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
                        Bonjour ! 👋 Bienvenue sur le chat d'assistance PLAYSTAIHOME. Avez-vous une question concernant une réservation de console ou de manettes ?
                        <div class="text-[10px] font-bold text-gray-400 mt-2 flex items-center gap-1">
                            10:30
                        </div>
                    </div>
                </div>

                <!-- Bulle de l'Utilisateur (Droite) -->
                <div class="flex items-end gap-3 max-w-[85%] md:max-w-[70%] self-end flex-row-reverse">
                    <div class="bg-primary hover:bg-blue-600 transition-colors p-4 rounded-2xl rounded-br-sm shadow-sm text-sm font-medium text-white leading-relaxed">
                        Bonjour, j'aimerais savoir s'il y a des remises si je prolonge ma location d'une semaine supplémentaire ?
                        <div class="text-[10px] font-bold text-blue-200 mt-2 flex items-center justify-end gap-1">
                            10:35 <i class="fa-solid fa-check-double drop-shadow-sm"></i>
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
                <form class="flex items-center gap-3">
                    <div class="relative flex-grow">
                        <textarea rows="1" class="w-full bg-gray-50 border border-gray-200 text-gray-900 rounded-2xl pl-4 pr-12 py-3.5 text-sm font-medium focus:outline-none focus:ring-2 focus:ring-primary/20 focus:bg-white focus:border-primary transition-all placeholder-gray-400 resize-none h-[50px] scrollbar-hide" placeholder="Écrivez votre message..." style="min-height: 50px; max-height: 120px;"></textarea>
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
        document.addEventListener('DOMContentLoaded', () => {
            const token = localStorage.getItem('token');
            if(!token) {
                window.location.href = '/login';
            }
            
            // Scroller automatiquement vers le bas de la zone de messages
            const chatMessages = document.getElementById('chatMessages');
            if (chatMessages) {
                chatMessages.scrollTop = chatMessages.scrollHeight;
            }
        });
    </script>
</body>
</html>