<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Profil - PLAYSTAIHOME</title>
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

        <main class="flex-grow mx-auto max-w-2xl px-4 py-8 w-full mt-4">
            
            <!-- EN-TÊTE -->
            <div class="mb-8 flex items-center justify-between">
                <h1 class="text-2xl font-black text-gray-900 tracking-tight">Modifier mon profil</h1>
                <a href="/mon-compte" class="text-sm font-medium text-gray-500 hover:text-gray-900 transition-colors">
                    <i class="fa-solid fa-arrow-left mr-2"></i> Retour au compte
                </a>
            </div>

            <!-- FORMULAIRE -->
            <div class="bg-white rounded-3xl border border-gray-100 shadow-[0_4px_20px_rgba(15,23,42,0.03)] p-8">
                
                <div id="errorBox" class="hidden mb-6 bg-red-50 text-red-600 px-4 py-3 rounded-xl text-sm font-medium border border-red-100">
                </div>
                
                <div id="successBox" class="hidden mb-6 bg-green-50 text-green-600 px-4 py-3 rounded-xl text-sm font-medium border border-green-100">
                </div>

                <form id="profileForm" class="space-y-6">
                    
                    <!-- Avatar Preview -->
                    <div class="flex items-center gap-6 mb-8">
                        <div id="previewAvatar" class="h-20 w-20 flex-shrink-0 rounded-full bg-blue-100 flex items-center justify-center text-primary font-black text-2xl shadow-inner border border-blue-200 overflow-hidden">
                            <i class="fa-solid fa-user text-xl"></i>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-900 mb-2">Changer la photo de profil</label>
                            <input type="file" id="photoInput" name="photo" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-primary hover:file:bg-blue-100 transition-all">
                        </div>
                    </div>

                    <!-- Nom -->
                    <div>
                        <label class="block text-sm font-bold text-gray-900 mb-2">Nom complet</label>
                        <input type="text" id="nameInput" name="name" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all text-sm font-medium text-gray-900 placeholder-gray-400" placeholder="Votre nom">
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-bold text-gray-900 mb-2">Adresse E-mail</label>
                        <input type="email" id="emailInput" name="email" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all text-sm font-medium text-gray-900 placeholder-gray-400" placeholder="vous@exemple.com">
                    </div>

                    <div class="border-t border-gray-100 pt-6 mt-6">
                        <h2 class="text-sm font-bold text-gray-900 mb-4">Changer le mot de passe (optionnel)</h2>
                        
                        <!-- Mot de passe -->
                        <div class="mb-4">
                            <label class="block text-xs font-bold text-gray-700 mb-2">Nouveau mot de passe</label>
                            <input type="password" id="passwordInput" name="password" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all text-sm font-medium text-gray-900 placeholder-gray-400" placeholder="Laisser vide pour ne pas changer">
                        </div>

                        <!-- Confirmation -->
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-2">Confirmer le mot de passe</label>
                            <input type="password" id="passwordConfirmInput" name="password_confirmation" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all text-sm font-medium text-gray-900 placeholder-gray-400" placeholder="Confirmer le nouveau mot de passe">
                        </div>
                    </div>

                    <!-- Bouton Submit -->
                    <div class="pt-4">
                        <button type="submit" id="submitBtn" class="w-full bg-primary hover:bg-blue-600 text-white px-6 py-3.5 rounded-xl text-sm font-bold shadow-sm transition-all duration-200 flex items-center justify-center gap-2">
                            <span>Enregistrer les modifications</span>
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <!-- Scripts de logique -->
    <script>
        (async function() {
            const token = localStorage.getItem('token');
            if(!token) {
                window.location.href = '/login';
                return;
            }

            // Pré-remplir les données actuelles
            try {
                let res = await fetch('/api/user', {
                    headers: { 'Authorization': 'Bearer ' + token, 'Accept': 'application/json' }
                });
                
                if (res.ok) {
                    let user = await res.json();
                    document.getElementById('nameInput').value = user.name || '';
                    document.getElementById('emailInput').value = user.email || '';
                    
                    if (user.photo_url) {
                        document.getElementById('previewAvatar').innerHTML = `<img src="${user.photo_url}" class="h-full w-full object-cover">`;
                    } else if (user.name) {
                        document.getElementById('previewAvatar').innerHTML = `<span class="text-xl">${user.name.substring(0, 2).toUpperCase()}</span>`;
                    }
                }
            } catch (e) {
                console.error("Erreur de chargement de l'utilisateur", e);
            }

            // Gérer la soumission
            document.getElementById('profileForm').addEventListener('submit', async (e) => {
                e.preventDefault();
                
                const btn = document.getElementById('submitBtn');
                const errorBox = document.getElementById('errorBox');
                const successBox = document.getElementById('successBox');
                
                btn.disabled = true;
                btn.innerHTML = `<i class="fa-solid fa-spinner fa-spin"></i> Enregistrement...`;
                btn.classList.add('opacity-70');
                errorBox.classList.add('hidden');
                successBox.classList.add('hidden');

                const formData = new FormData();
                formData.append('name', document.getElementById('nameInput').value);
                formData.append('email', document.getElementById('emailInput').value);
                
                const password = document.getElementById('passwordInput').value;
                const passwordConfirm = document.getElementById('passwordConfirmInput').value;
                
                if(password) {
                    formData.append('password', password);
                    formData.append('password_confirmation', passwordConfirm);
                }

                const photoInput = document.getElementById('photoInput');
                if(photoInput.files.length > 0) {
                    formData.append('photo', photoInput.files[0]);
                }

                try {
                    let response = await fetch('/api/user/update', {
                        method: 'POST',
                        headers: {
                            'Authorization': 'Bearer ' + token,
                            'Accept': 'application/json'
                        },
                        body: formData
                    });

                    let data = await response.json();

                    if (response.ok) {
                        successBox.innerText = data.message || "Profil mis à jour avec succès !";
                        successBox.classList.remove('hidden');
                        document.getElementById('passwordInput').value = '';
                        document.getElementById('passwordConfirmInput').value = '';
                        
                        // Si une nouvelle image a été uploadée, on simule le délai avant redirection
                        setTimeout(() => {
                            window.location.href = '/mon-compte';
                        }, 1500);

                    } else {
                        // Afficher les erreurs de validation
                        let errorMsg = data.message || "Une erreur est survenue";
                        if(data.errors) {
                            const firstKey = Object.keys(data.errors)[0];
                            errorMsg = data.errors[firstKey][0];
                        }
                        errorBox.innerText = errorMsg;
                        errorBox.classList.remove('hidden');
                    }
                } catch (error) {
                    errorBox.innerText = "Erreur de connexion au serveur.";
                    errorBox.classList.remove('hidden');
                } finally {
                    btn.disabled = false;
                    btn.innerHTML = `<span>Enregistrer les modifications</span>`;
                    btn.classList.remove('opacity-70');
                }
            });
            
            // Preview de la nouvelle image sélectionnée en temps réel
            document.getElementById('photoInput').addEventListener('change', function(e) {
                if(e.target.files && e.target.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(evt) {
                        document.getElementById('previewAvatar').innerHTML = `<img src="${evt.target.result}" class="h-full w-full object-cover">`;
                    }
                    reader.readAsDataURL(e.target.files[0]);
                }
            });
        })();
    </script>
</body>
</html>
