<header class="sticky top-0 z-50 border-b border-gray-200 bg-white">
    <div class="mx-auto flex w-full max-w-7xl items-center justify-between px-6 py-3 md:px-10">
        <div class="flex items-center gap-4 text-primary">
            <a href="/" class="flex items-center gap-4 text-primary">
                <i class="fab fa-playstation text-4xl"></i>
                <span class="text-xl font-bold tracking-tight text-gray-900">PLAYSTAIHOME</span>
            </a>
        </div>

        <div class="flex flex-1 items-center justify-end gap-8">
            <nav class="hidden items-center gap-9 md:flex">
                    <a href="/" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
                    <a href="/catalogue" class="nav-link {{ request()->routeIs('catalogue') ? 'active' : '' }}">Catalogue</a>
                    <a href="/contact" class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">Contact Us</a>
                    <a href="/faq" class="nav-link {{ request()->routeIs('faq') ? 'active' : '' }}">FAQ</a>
                <!-- <a href="/reservation" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">reservation</a>
                <a href="/profile" class="nav-link {{ request()->routeIs('catalogue') ? 'active' : '' }}">profile</a>
                <a href="/chat" class="nav-link {{ request()->routeIs('catalogue') ? 'active' : '' }}">Chat</a>
                 -->

                @guest
                    
                    <a href="/register" class="nav-link {{ request()->routeIs('register') ? 'active' : '' }}">Sign Up</a>
                    <a href="/login" class="nav-link {{ request()->routeIs('login') ? 'active' : '' }}">Sign In</a>
                @endguest
            </nav>
        </div>
    </div>
</header>
