<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un compte - playstayhome</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#1978e5'
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        input.parsley-success,
        textarea.parsley-success,
        select.parsley-success {
            border: 2px solid #10b981 !important;
            background-color: #f0fdf4;
        }

        input.parsley-error,
        textarea.parsley-error,
        select.parsley-error {
            border: 2px solid #ef4444 !important;
            background-color: #fef2f2;
        }

        .parsley-error-list {
            list-style: none;
            padding: 0;
            margin: 8px 0 0 0;
        }

        .parsley-error-list > li {
            color: #ef4444;
            font-size: 0.875rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .parsley-error-list > li:before {
            content: "✕";
            font-weight: bold;
        }

    </style>
</head>
<body class="bg-gray-50 font-sans min-h-screen flex flex-col">
    <!-- Header -->
    <header class="flex items-center justify-between border-b border-gray-200 bg-white px-10 py-3 sticky top-0 z-50">
        <div class="flex items-center gap-4 text-primary">
            <i class="fab fa-playstation text-4xl"></i>
            <h2 class="text-gray-900 text-xl font-bold">PLAYSTAYHOME</h2>
        </div>
        <div class="flex items-center gap-8">
            <nav class="hidden md:flex items-center gap-9">
                <a class="text-gray-600 text-sm font-medium hover:text-primary" href="/">Accueil</a>
                <a class="text-gray-600 text-sm font-medium hover:text-primary" href="catalogue">Catalogue</a>
                <a class="text-gray-600 text-sm font-medium hover:text-primary" href="contact">Contact</a>
                <a class="text-gray-600 text-sm font-medium hover:text-primary" href="faq">FAQ</a>
                
            </nav>
            <a href="/login" class="bg-primary text-white px-5 py-2 rounded-lg text-sm font-bold hover:bg-blue-700">Connexion</a>
        </div>
    </header>

    <!-- Main Content -->
    <main class="grow flex">
        <!-- Left Side - Blue Section -->
        <div class="hidden md:flex md:w-1/2 bg-primary items-center justify-center p-12 relative overflow-hidden">
            <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 40px 40px;"></div>
            <div class="relative z-10 max-w-lg text-white">
                <h1 class="text-5xl font-black leading-tight mb-6">Join the global gaming community.</h1>
                <p class="text-xl text-white/80 mb-8">Unlock exclusive access to gaming events, connect with pro players, and find your next competitive home.</p>
                <div class="flex gap-4">
                    <div class="bg-white/10 backdrop-blur-md p-4 rounded-xl border border-white/20 flex items-center gap-3">
                        <i class="fas fa-gamepad text-3xl"></i>
                        <div>
                            <p class="font-bold text-lg">10M+</p>
                            <p class="text-xs text-white/60 uppercase tracking-wider">Active Gamers</p>
                        </div>
                    </div>
                    <div class="bg-white/10 backdrop-blur-md p-4 rounded-xl border border-white/20 flex items-center gap-3">
                        <i class="fas fa-trophy text-3xl"></i>
                        <div>
                            <p class="font-bold text-lg">500+</p>
                            <p class="text-xs text-white/60 uppercase tracking-wider">Daily Tournaments</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side - Register Form -->
        <div class="w-full md:w-1/2 flex items-center justify-center p-12 bg-gray-50">
            <div class="w-full max-w-120">  
                <div class="mb-10">
                    <h2 class="text-gray-900 text-4xl font-black mb-2">Créer un compte</h2>
                    <p class="text-gray-500 text-lg">Rejoignez playstayhome dès aujourd'hui.</p>
                </div>
                <form class="space-y-5" id="registerForm">
                    <div class="space-y-2">
                        <label class="block text-gray-700 text-sm font-semibold uppercase tracking-wider">Nom complet</label>
                        <div class="relative input-wrapper">
                            <svg class="w-5 h-5 absolute left-4 top-10 -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            <input id="fullName" name="fullName" type="text" data-parsley-minlength="4" data-parsley-required="true" placeholder="Jean Dupont" class="w-full pl-12 pr-4 py-4 rounded-lg border border-gray-200 bg-white focus:ring-2 focus:ring-primary focus:border-transparent outline-none">
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="block text-gray-700 text-sm font-semibold uppercase tracking-wider">Adresse e-mail</label>
                        <div class="relative input-wrapper">
                            <svg class="w-5 h-5 absolute left-4 top-10 -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <input id="email" name="email" type="email" data-parsley-type="email" data-parsley-required="true" placeholder="votre@email.com" class="w-full pl-12 pr-4 py-4 rounded-lg border border-gray-200 bg-white focus:ring-2 focus:ring-primary focus:border-transparent outline-none">
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="block text-gray-700 text-sm font-semibold uppercase tracking-wider">Mot de passe</label>
                        <div class="relative input-wrapper">
                            <svg class="w-5 h-5 absolute left-4 top-10 -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                            <input id="password" name="password" type="password" placeholder="••••••••" data-parsley-minlength="6" data-parsley-required="true" class="w-full pl-12 pr-4 py-4 rounded-lg border border-gray-200 bg-white focus:ring-2 focus:ring-primary focus:border-transparent outline-none">
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="block text-gray-700 text-sm font-semibold uppercase tracking-wider">Confirmer le mot de passe</label>
                        <div class="relative input-wrapper">
                            <svg class="w-5 h-5 absolute left-4 top-10 -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                            <input id="confirm_password" name="confirm_password" type="password" placeholder="••••••••" data-parsley-equalto="#password" data-parsley-required="true" class="w-full pl-12 pr-4 py-4 rounded-lg border border-gray-200 bg-white focus:ring-2 focus:ring-primary focus:border-transparent outline-none">
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="block text-gray-700 text-sm font-semibold uppercase tracking-wider">Photo de profil (optionnel)</label>
                        <div class="relative input-wrapper">
                            <input id="photo" name="photo" type="file" accept="image/*" class="w-full px-4 py-3 rounded-lg border border-gray-200 bg-white focus:ring-2 focus:ring-primary focus:border-transparent outline-none">
                        </div>
                    </div>
                    <div class="flex items-center gap-3 pt-2">
                        <input type="checkbox" id="terms" class="rounded border-gray-300 text-primary focus:ring-primary">
                        <label for="terms" class="text-sm text-gray-500">
                            J'accepte les <a href="#" class="text-primary hover:underline">Conditions générales</a>
                        </label>
                    </div>
                    <button type="submit" class="w-full bg-primary hover:bg-blue-700 text-white font-bold py-4 rounded-lg text-lg shadow-lg">Créer un compte</button>
                </form>
                <div class="mt-8 pt-8 border-t border-gray-200 text-center">
                    <p class="text-gray-600">
                        Vous avez déjà un compte ?
                        <a class="text-primary font-bold hover:underline ml-1" href="/login">Connexion</a>
                    </p>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 px-10 py-10">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center gap-4 text-gray-400">
                <img src="{{ asset('images/footer-logo-icon.png') }}" alt="PLAYSTAYHOME" class="h-8 w-auto object-contain opacity-50">
                <span class="text-sm font-semibold uppercase tracking-widest">PLAYSTAYHOME</span>
            </div>
            <div class="flex gap-8">
                <a class="text-gray-400 hover:text-primary text-sm" href="#">Confidentialité</a>
                <a class="text-gray-400 hover:text-primary text-sm" href="#">Conditions</a>
                <a class="text-gray-400 hover:text-primary text-sm" href="#">Cookies</a>
                <a class="text-gray-400 hover:text-primary text-sm" href="#">Statut</a>
            </div>
            <p class="text-gray-400 text-sm">© 2026 <strong>PLAYSTAYHOME</strong>. Tous droits réservés.</p>
        </div>
    </footer>
</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/parsleyjs"></script>

<script>
    const parsleyForm = $("#registerForm").parsley({
        errorsContainer: (parsleyField) => parsleyField.$element.closest('.input-wrapper')
    });

    document.getElementById('registerForm').addEventListener('submit', handleRegister);


    async function handleRegister(event) {
        event.preventDefault();

        if (!parsleyForm.validate()) {
            return;
        }

        const name = document.getElementById("fullName").value;
        const email = document.getElementById("email").value;
        const password = document.getElementById("password").value;
        const confirmPassword = document.getElementById("confirm_password").value;
        const photoFile = document.getElementById("photo").files[0];
        const termsAccepted = document.getElementById("terms").checked;

        if (!termsAccepted) {
            await Swal.fire({
                icon: 'warning',
                title: 'Conditions requises',
                text: 'Please accept the Terms & Conditions.'
            });
            return;
        }

        try {
            const formData = new FormData();
            formData.append('name', name);
            formData.append('email', email);
            formData.append('password', password);
            formData.append('password_confirmation', confirmPassword);
            
            if (photoFile) {
                formData.append('photo', photoFile);
            }

            const response = await fetch('http://playstayhome.test/api/register', {
                method: 'POST',
                // Ne pas mettre de Content-Type ici, le navigateur le met tout seul avec le boundary pour FormData
                body: formData,
            });

            console.log(response);
            if (response.ok) {
                await Swal.fire({
                    icon: 'success',
                    title: 'Inscription réussie',
                    text: 'Registration successful! Please log in.'
                });
                window.location.href = '/login';
            } else {
                const errorData = await response.json();
                const message = errorData.message || 'Registration failed.';
                await Swal.fire({
                    icon: 'error',
                    title: 'Échec inscription',
                    text: 'Registration failed: ' + message
                });
            }
        } catch (error) {
            console.error('Error:', error);
            await Swal.fire({
                icon: 'error',
                title: 'Erreur',
                text: 'An error occurred during registration. Please try again later.'
            });
        }
    }
</script>
</html>
