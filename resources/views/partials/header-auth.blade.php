{{-- Header auth pages: full nav from lg; mobile/tablet hamburger with drawer (hamburger → X on hover or when open) --}}
@php
    $variant = $variant ?? 'login';
    $isLogin = $variant === 'login';
    $drawerId = 'auth-nav-drawer-' . $variant;
@endphp
@include('partials.nav-burger-styles')
<header id="site-auth-header" class="flex items-center justify-between gap-3 border-b border-gray-200 bg-white px-4 py-3 sm:px-6 lg:px-10 sticky top-0 z-50">
    <div class="flex min-w-0 flex-1 items-center gap-2 text-primary sm:gap-4">
        <a href="/" class="flex min-w-0 items-center gap-2 text-primary sm:gap-3" aria-label="PLAYSTAYHOME">
            <span class="flex h-12 shrink-0 items-center overflow-visible">
                <img src="{{ asset('images/site-logo-navbar.png') }}" alt="" class="h-16 w-auto object-contain -my-2" width="120" height="48">
            </span>
            <span class="truncate text-lg font-bold tracking-tight text-gray-900 sm:text-xl">PLAYSTAYHOME</span>
        </a>
    </div>
    <div class="flex shrink-0 items-center gap-3 sm:gap-6">
        <nav class="hidden lg:flex items-center gap-9" aria-label="Navigation principale">
            <a class="text-gray-600 text-sm font-medium hover:text-primary" href="/" data-i18n="common.home">Accueil</a>
            <a class="text-gray-600 text-sm font-medium hover:text-primary" href="/catalogue" data-i18n="common.catalogue">Catalogue</a>
            <a class="text-gray-600 text-sm font-medium hover:text-primary" href="/contact" data-i18n="common.contact">Contact</a>
            <a class="text-gray-600 text-sm font-medium hover:text-primary" href="/faq" data-i18n="common.faq">FAQ</a>

        </nav>
        @if($isLogin)
            <a href="/register" class="hidden lg:inline-flex items-center justify-center bg-primary text-white px-5 py-2 rounded-lg text-sm font-bold hover:bg-blue-700 transition-colors" data-i18n="common.register">Créer un compte</a>
        @else
            <a href="/login" class="hidden lg:inline-flex items-center justify-center bg-primary text-white px-5 py-2 rounded-lg text-sm font-bold hover:bg-blue-700 transition-colors" data-i18n="common.login">Connexion</a>
        @endif

        <div class="relative lg:hidden">
            <button
                type="button"
                class="auth-burger-toggle"
                id="auth-nav-toggle-{{ $variant }}"
                aria-expanded="false"
                aria-controls="{{ $drawerId }}"
                aria-label="Ouvrir le menu"
            >
                <span class="auth-burger-bar auth-burger-top" aria-hidden="true"></span>
                <span class="auth-burger-bar auth-burger-mid" aria-hidden="true"></span>
                <span class="auth-burger-bar auth-burger-bot" aria-hidden="true"></span>
            </button>
            <div
                id="{{ $drawerId }}"
                class="auth-nav-panel absolute right-0 top-full z-50 mt-2 hidden min-w-[16.5rem] max-w-[calc(100vw-2rem)] rounded-xl border border-gray-200 bg-white py-2 shadow-xl ring-1 ring-black/5"
                role="menu"
                aria-label="Navigation"
            >
                <a role="menuitem" class="block px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-primary" href="/" data-i18n="common.home">Accueil</a>
                <a role="menuitem" class="block px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-primary" href="/catalogue" data-i18n="common.catalogue">Catalogue</a>
                <a role="menuitem" class="block px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-primary" href="/contact" data-i18n="common.contact">Contact</a>
                <a role="menuitem" class="block px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-primary" href="/faq" data-i18n="common.faq">FAQ</a>
                <div class="my-2 border-t border-gray-100" role="presentation"></div>
                <a role="menuitem" class="block px-4 py-2.5 text-sm font-semibold text-primary hover:bg-blue-50" href="/login" data-i18n="common.login">Connexion</a>
                <a role="menuitem" class="block px-4 py-2.5 text-sm font-semibold text-primary hover:bg-blue-50" href="/register" data-i18n="common.register">Créer un compte</a>
            </div>
        </div>
    </div>
</header>
<script>
(function () {
    var btn = document.getElementById('auth-nav-toggle-{{ $variant }}');
    var panel = document.getElementById('{{ $drawerId }}');
    if (!btn || !panel) return;

    function setOpen(open) {
        btn.setAttribute('aria-expanded', open ? 'true' : 'false');
        btn.setAttribute('aria-label', open ? 'Fermer le menu' : 'Ouvrir le menu');
        btn.classList.toggle('is-open', open);
        panel.classList.toggle('hidden', !open);
    }

    btn.addEventListener('click', function (e) {
        e.stopPropagation();
        var open = btn.getAttribute('aria-expanded') === 'true';
        setOpen(!open);
    });

    document.addEventListener('click', function () {
        setOpen(false);
    });

    panel.addEventListener('click', function (e) {
        e.stopPropagation();
    });

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') setOpen(false);
    });
})();
</script>
