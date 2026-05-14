<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - playstayhome</title>
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
    @include('partials.header-auth', ['variant' => 'login'])

    <!-- Main Content -->
    <main class="flex-grow flex">
        <!-- Left Side - Blue Section -->
        <div class="hidden md:flex md:w-1/2 bg-primary items-center justify-center p-12 relative overflow-hidden">
            <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 40px 40px;"></div>
            <div class="relative z-10 max-w-lg text-white">
                <h1 class="text-5xl font-black leading-tight mb-6" data-i18n="login.heroTitle">Rejoignez la communauté mondiale du gaming.</h1>
                <p class="text-xl text-white/80 mb-8" data-i18n="login.heroSubtitle">Accédez à des événements exclusifs, connectez-vous avec des joueurs professionnels et trouvez votre prochaine équipe compétitive.</p>
                <div class="flex gap-4">
                    <div class="bg-white/10 backdrop-blur-md p-4 rounded-xl border border-white/20 flex items-center gap-3">
                        <i class="fas fa-gamepad text-3xl"></i>
                        <div>
                            <p class="font-bold text-lg">10M+</p>
                            <p class="text-xs text-white/60 uppercase tracking-wider" data-i18n="login.activePlayers">Joueurs actifs</p>
                        </div>
                    </div>
                    <div class="bg-white/10 backdrop-blur-md p-4 rounded-xl border border-white/20 flex items-center gap-3">
                        <i class="fas fa-trophy text-3xl"></i>
                        <div>
                            <p class="font-bold text-lg">500+</p>
                            <p class="text-xs text-white/60 uppercase tracking-wider" data-i18n="login.dailyTournaments">Tournois quotidiens</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side - Login Form -->
        <div class="w-full md:w-1/2 flex items-center justify-center px-4 py-8 sm:p-8 md:p-12 bg-gray-50">
            <div class="w-full max-w-[480px]">
                <div class="mb-10">
                    <h2 class="text-gray-900 text-4xl font-black mb-2">Bienvenue</h2>
                    <p class="text-gray-500 text-lg">Connectez-vous à votre compte playstayhome.</p>
                </div>
                <form class="space-y-5" id="loginForm">
                    <div class="space-y-2">
                        <label class="block text-gray-700 text-sm font-semibold uppercase tracking-wider">Adresse e-mail</label>
                        <div class="relative input-wrapper">
                            <svg class="w-5 h-5 absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <input id="email" name="email" type="email" data-parsley-type="email" data-parsley-required="true" required placeholder="votre@email.com" class="w-full pl-12 pr-4 py-4 rounded-lg border border-gray-200 bg-white focus:ring-2 focus:ring-primary focus:border-transparent outline-none">
                        </div>
                    </div>
                    <div class="space-y-2">
                        <div class="flex items-center justify-between">
                            <label class="block text-gray-700 text-sm font-semibold uppercase tracking-wider">Mot de passe</label>
                            <a class="text-sm font-medium text-primary hover:underline" href="#">Mot de passe oublié ?</a>
                        </div>
                        <div class="relative input-wrapper">
                            <svg class="w-5 h-5 absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                            <input id="password" name="password" type="password" data-parsley-minlength="6" data-parsley-required="true" required placeholder="••••••••" class="w-full pl-12 pr-4 py-4 rounded-lg border border-gray-200 bg-white focus:ring-2 focus:ring-primary focus:border-transparent outline-none">
                        </div>
                    </div>
                    <div class="flex items-center gap-3 pt-2">
                        <input type="checkbox" id="remember" class="rounded border-gray-300 text-primary focus:ring-primary">
                        <label for="remember" class="text-sm text-gray-500">Se souvenir de moi pendant 30 jours</label>
                    </div>
                    <button type="submit" class="w-full bg-primary hover:bg-blue-700 text-white font-bold py-4 rounded-lg text-lg shadow-lg">Connexion</button>
                </form>
                @if (config('services.google.enabled'))
                <div class="my-6 flex items-center gap-3">
                    <div class="h-px flex-1 bg-gray-200"></div>
                    <span class="text-xs font-semibold uppercase tracking-wider text-gray-400">ou</span>
                    <div class="h-px flex-1 bg-gray-200"></div>
                </div>
                <a href="{{ route('auth.google.redirect') }}{{ request()->filled('redirect') ? '?' . http_build_query(['redirect' => request('redirect')]) : '' }}" class="w-full inline-flex items-center justify-center gap-3 rounded-lg border border-gray-300 bg-white py-3.5 text-sm font-semibold text-gray-700 hover:bg-gray-50">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" class="h-5 w-5" aria-hidden="true">
                        <path fill="#FFC107" d="M43.6 20.5H42V20H24v8h11.3C33.6 32.7 29.2 36 24 36c-6.6 0-12-5.4-12-12s5.4-12 12-12c3 0 5.7 1.1 7.8 2.9l5.7-5.7C33.8 6.1 29.2 4 24 4 12.9 4 4 12.9 4 24s8.9 20 20 20 20-8.9 20-20c0-1.3-.1-2.4-.4-3.5z"/>
                        <path fill="#FF3D00" d="M6.3 14.7l6.6 4.8C14.7 15.2 19 12 24 12c3 0 5.7 1.1 7.8 2.9l5.7-5.7C33.8 6.1 29.2 4 24 4 16.3 4 9.7 8.3 6.3 14.7z"/>
                        <path fill="#4CAF50" d="M24 44c5.1 0 9.8-1.9 13.4-5l-6.2-5.2C29.2 35.2 26.7 36 24 36c-5.2 0-9.6-3.3-11.2-8l-6.5 5C9.6 39.6 16.3 44 24 44z"/>
                        <path fill="#1976D2" d="M43.6 20.5H42V20H24v8h11.3c-.8 2.3-2.2 4.2-4.1 5.6l.1-.1 6.2 5.2C37 38.3 44 33 44 24c0-1.3-.1-2.4-.4-3.5z"/>
                    </svg>
                    <span>Continuer avec Google</span>
                </a>
                @endif
                <div class="mt-8 pt-8 border-t border-gray-200 text-center">
                    <p class="text-gray-600">
                        <span>Pas de compte ?</span>
                        <a class="text-primary font-bold hover:underline ml-1" href="/register{{ request()->getQueryString() ? '?' . request()->getQueryString() : '' }}">Créer un compte</a>
                    </p>
                </div>
            </div>
        </div>
    </main>

    @include('partials.footer-auth')



    <script id="google-error-data" type="application/json">@json(session('google_error'))</script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/parsleyjs"></script>

    <script>
        const t = window.t || ((key, defaultStr) => defaultStr || key);
        function getPostLoginRedirect(fallback) {
            const qs = new URLSearchParams(window.location.search);
            let raw = qs.get('redirect');
            if (!raw) {
                return fallback;
            }
            try {
                raw = decodeURIComponent(raw);
            } catch (e) {
                return fallback;
            }
            if (!raw.startsWith('/') || raw.startsWith('//')) {
                return fallback;
            }
            try {
                const u = new URL(raw, window.location.origin);
                if (u.origin !== window.location.origin) {
                    return fallback;
                }
                return u.pathname + u.search + u.hash;
            } catch (e2) {
                return fallback;
            }
        }

        const params = new URLSearchParams(window.location.search);
        const googleToken = params.get('token');
        const googleRole = params.get('role');
        const googleSuccess = params.get('google');

        if (googleToken && googleSuccess === '1') {
            const postLogin = getPostLoginRedirect('/');
            localStorage.setItem('token', googleToken);
            localStorage.setItem('role', googleRole || 'client');
            const cleanUrl = window.location.origin + window.location.pathname;
            window.history.replaceState({}, '', cleanUrl);
            if ((googleRole || 'client') === 'admin') {
                window.location.href = '/admin/dashboard';
            } else {
                window.location.href = postLogin;
            }
        }

        const googleErrorNode = document.getElementById('google-error-data');
        const googleError = googleErrorNode ? JSON.parse(googleErrorNode.textContent || 'null') : null;

        if (googleError) {
            Swal.fire({
                icon: 'error',
                title: t('login.js.googleErrorTitle', 'Connexion Google echouee'),
                text: googleError
            });
        }

        const parsleyForm = $('#loginForm').parsley({
            errorsContainer: (parsleyField) => parsleyField.$element.closest('.input-wrapper')
        });

        document.getElementById('loginForm').addEventListener('submit', handleLogin);

        async function handleLogin(event) {
            event.preventDefault();

            if (!parsleyForm.validate()) {
                return;
            }

            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            try {
                const response = await fetch('/api/login', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ email, password })
                });

                if (response.ok) {
                    
                    const data = await response.json();
                    localStorage.setItem('token', data.token);
                    localStorage.setItem('role', data.user?.role || 'client');

                    if (data.user && data.user.role === 'admin') {
                        window.location.href = '/admin/dashboard';
                        return;
                    }
                    window.location.href = getPostLoginRedirect('/');
                } else {
                    const errorData = await response.json();
                    const message = errorData.message || t('login.js.loginFailedMsg', 'Login failed. Please check your credentials and try again.');
                    await Swal.fire({
                        icon: 'error',
                        title: t('login.js.loginFailedTitle', 'Connexion échouée'),
                        text: message
                    });
                }
            } catch (error) {
                console.error('Error during login:', error);
                await Swal.fire({
                    icon: 'error',
                    title: t('login.js.errorTitle', 'Erreur'),
                    text: t('login.js.errorMsg', 'An error occurred. Please try again later.')
                });
            }
        }
    </script>




</body>
</html>
