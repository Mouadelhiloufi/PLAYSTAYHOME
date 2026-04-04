<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - PLAYSTAIHOME</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f6f7f8;
            color: #0f172a;
        }

        .text-primary {
            color: #2f6bff;
        }

        .bg-primary {
            background-color: #2f6bff;
        }

        .nav-link {
            position: relative;
            display: inline-flex;
            align-items: center;
            height: 40px;
            font-size: 0.875rem;
            font-weight: 600;
            color: #4b5563;
            transition: color .2s ease;
        }

        .nav-link::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: -1px;
            width: 100%;
            height: 2px;
            background: #2f6bff;
            transform: scaleX(0);
            transform-origin: center;
            transition: transform .2s ease;
        }

        .nav-link:hover,
        .nav-link.active {
            color: #2f6bff;
        }

        .nav-link:hover::after,
        .nav-link.active::after {
            transform: scaleX(1);
        }
    </style>
</head>
<body class="min-h-screen">
    <div class="flex min-h-screen flex-col">
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
                        <a href="/" class="nav-link">Home</a>
                        <a href="/catalogue" class="nav-link">Catalogue</a>
                        <a href="/contact" class="nav-link active">Contact Us</a>
                        <a href="/faq" class="nav-link">FAQ</a>
                        <a href="/register" class="nav-link">Sign Up</a>
                        <a href="/login" class="nav-link">Sign In</a>
                    </nav>
                </div>
            </div>
        </header>

        <main class="flex-1">
            <section class="mx-auto max-w-6xl px-6 py-12 md:py-20">
                <div class="mb-12">
                    <h1 class="mb-4 text-4xl font-black tracking-tight text-gray-900 md:text-5xl">Get in Touch</h1>
                    <p class="max-w-2xl text-lg text-gray-600">
                        We're here to help you find your dream home or answer any questions about our property management services.
                    </p>
                </div>

                <div class="grid grid-cols-1 gap-12 lg:grid-cols-2">
                    <div class="rounded-xl border border-gray-200 bg-white p-8 shadow-sm">
                        <form class="flex flex-col gap-6">
                            <div class="flex flex-col gap-2">
                                <label class="text-sm font-semibold text-gray-900">Full Name</label>
                                <input type="text" placeholder="John Doe" class="h-12 w-full rounded-lg border border-gray-300 bg-white px-4 text-gray-900 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                            </div>

                            <div class="flex flex-col gap-2">
                                <label class="text-sm font-semibold text-gray-900">Email</label>
                                <input type="email" placeholder="john@example.com" class="h-12 w-full rounded-lg border border-gray-300 bg-white px-4 text-gray-900 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                            </div>

                            <div class="flex flex-col gap-2">
                                <label class="text-sm font-semibold text-gray-900">Subject</label>
                                <input type="text" placeholder="How can we help?" class="h-12 w-full rounded-lg border border-gray-300 bg-white px-4 text-gray-900 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                            </div>

                            <div class="flex flex-col gap-2">
                                <label class="text-sm font-semibold text-gray-900">Message</label>
                                <textarea rows="4" placeholder="Your message here..." class="w-full rounded-lg border border-gray-300 bg-white p-4 text-gray-900 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100"></textarea>
                            </div>

                            <button class="flex w-full items-center justify-center gap-2 rounded-lg py-4 font-bold text-white shadow-lg" style="background-color: #1978e5;">
                                <i class="fa-regular fa-paper-plane"></i>
                                <span>Send Message</span>
                            </button>
                        </form>
                    </div>

                    <div class="flex flex-col gap-6">
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <div class="flex flex-col gap-3 rounded-xl border border-gray-200 bg-white p-6">
                                <div class="flex h-10 w-10 items-center justify-center rounded-full text-primary" style="background-color: rgba(25, 120, 229, 0.1);">
                                    <i class="fa-solid fa-phone"></i>
                                </div>
                                <h3 class="font-bold text-gray-900">Call Us</h3>
                                <p class="text-sm text-gray-600">+1 (555) 000-0000</p>
                                <p class="text-xs text-gray-500">Mon-Fri: 9am - 6pm</p>
                            </div>

                            <div class="flex flex-col gap-3 rounded-xl border border-gray-200 bg-white p-6">
                                <div class="flex h-10 w-10 items-center justify-center rounded-full text-primary" style="background-color: rgba(25, 120, 229, 0.1);">
                                    <i class="fa-regular fa-envelope"></i>
                                </div>
                                <h3 class="font-bold text-gray-900">Email Us</h3>
                                <p class="text-sm text-gray-600">hello@playstaihome.com</p>
                                <p class="text-xs text-gray-500">Fast response within 24h</p>
                            </div>

                            <div class="flex flex-col gap-3 rounded-xl border border-gray-200 bg-white p-6">
                                <div class="flex h-10 w-10 items-center justify-center rounded-full text-primary" style="background-color: rgba(25, 120, 229, 0.1);">
                                    <i class="fa-solid fa-location-dot"></i>
                                </div>
                                <h3 class="font-bold text-gray-900">Visit Us</h3>
                                <p class="text-sm leading-relaxed text-gray-600">123 Property Lane,<br>San Francisco, CA 94103</p>
                            </div>

                            <div class="flex flex-col gap-3 rounded-xl border border-gray-200 bg-white p-6">
                                <div class="flex h-10 w-10 items-center justify-center rounded-full text-primary" style="background-color: rgba(25, 120, 229, 0.1);">
                                    <i class="fa-solid fa-share-nodes"></i>
                                </div>
                                <h3 class="font-bold text-gray-900">Social Media</h3>
                                <div class="flex gap-4 text-gray-500">
                                    <a href="#" class="hover:text-blue-600"><i class="fa-solid fa-globe"></i></a>
                                    <a href="#" class="hover:text-blue-600"><i class="fa-solid fa-users"></i></a>
                                    <a href="#" class="hover:text-blue-600"><i class="fa-solid fa-camera"></i></a>
                                </div>
                            </div>
                        </div>

                        <div class="relative min-h-[320px] overflow-hidden rounded-xl border border-gray-200 shadow-inner">
                            <div
                                class="absolute inset-0 bg-cover bg-center"
                                style="background-image: linear-gradient(rgba(15, 23, 42, 0.24), rgba(15, 23, 42, 0.24)), url('https://lh3.googleusercontent.com/aida-public/AB6AXuA3sA8GXsoYaa-tEk9ZoOTIQwoo5hgPs3KJ6Tz9PRe_dpoDQ9pvQDQt4i0ZZM8b5PIuoDsifd_6U5-ArympLBqoIYX-qLBp2L7NqLU0UGAPepQ278uiLQ_nXtIzlINqOB7M20wOi7DtsKbNDV8LPOLT8q8yKBYocMXccloASNnkh3XPPvI_GiXtKmd7fQQOIkkMbF9q6MynIyaNyIjSguI0kOX0sfgYC83nnwbtShCtPC1bOVjiAjKshOxg5y2TuyEfsj4RRwZem4Sl');"
                            ></div>
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="flex h-14 w-14 items-center justify-center rounded-full text-white shadow-xl" style="background-color: #1978e5;">
                                    <i class="fa-solid fa-location-dot text-lg"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <footer class="border-t border-gray-200 bg-white px-6 py-12 md:px-10">
            <div class="mx-auto max-w-6xl">
                <div class="grid grid-cols-1 gap-12 md:grid-cols-4">
                    <div class="md:col-span-2">
                        <div class="mb-6 flex items-center gap-3 text-primary">
                            <i class="fab fa-playstation text-2xl opacity-50"></i>
                            <h2 class="text-xl font-bold text-gray-900">PLAYSTAIHOME</h2>
                        </div>
                        <p class="max-w-sm text-sm leading-relaxed text-gray-500">
                            Redefining the property experience. We help you find, buy, and manage your dream homes with cutting-edge technology and local expertise.
                        </p>
                    </div>

                    <div>
                        <h4 class="mb-6 font-bold text-gray-900">Quick Links</h4>
                        <ul class="flex flex-col gap-4 text-sm text-gray-600">
                            <li><a href="#" class="hover:text-blue-600">Find a Home</a></li>
                            <li><a href="#" class="hover:text-blue-600">List Your Property</a></li>
                            <li><a href="#" class="hover:text-blue-600">Market Reports</a></li>
                            <li><a href="#" class="hover:text-blue-600">Agent Finder</a></li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="mb-6 font-bold text-gray-900">Company</h4>
                        <ul class="flex flex-col gap-4 text-sm text-gray-600">
                            <li><a href="#" class="hover:text-blue-600">About Us</a></li>
                            <li><a href="#" class="hover:text-blue-600">Careers</a></li>
                            <li><a href="#" class="hover:text-blue-600">Privacy Policy</a></li>
                            <li><a href="#" class="hover:text-blue-600">Terms of Service</a></li>
                        </ul>
                    </div>
                </div>

                <div class="mt-12 border-t border-gray-200 pt-8 text-center">
                    <p class="text-xs text-gray-500">© 2026 PLAYSTAIHOME Real Estate. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
