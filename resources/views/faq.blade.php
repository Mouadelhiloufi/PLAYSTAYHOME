<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ - PLAYSTAIHOME</title>
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
            color: #1978e5;
        }

        .bg-primary {
            background-color: #1978e5;
        }

        .border-primary {
            border-color: #1978e5;
        }

        .nav-link {
            position: relative;
            display: inline-flex;
            align-items: center;
            height: 40px;
            font-size: 0.875rem;
            font-weight: 500;
            color: #4b5563;
            transition: color 0.2s ease;
        }

        .nav-link::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: 0;
            width: 100%;
            height: 2px;
            background-color: #1978e5;
            transform: scaleX(0);
            transform-origin: center;
            transition: transform 0.2s ease;
        }

        .nav-link:hover {
            color: #111827;
        }

        .nav-link:hover::after,
        .nav-link.active::after {
            transform: scaleX(1);
        }

        .nav-link.active {
            color: #111827;
        }

        summary {
            list-style: none;
        }

        summary::-webkit-details-marker {
            display: none;
        }

        details .faq-chevron {
            transition: transform 0.25s ease;
        }

        details[open] .faq-chevron {
            transform: rotate(180deg);
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
                        <a href="/contact" class="nav-link">Contact Us</a>
                        <a href="/faq" class="nav-link active">FAQ</a>
                        <a href="/register" class="nav-link">Sign Up</a>
                        <a href="/login" class="nav-link">Sign In</a>
                    </nav>

                    
                </div>
            </div>
        </header>

        <main class="mx-auto w-full max-w-4xl flex-1 px-4 py-10 lg:px-0">
            <section class="mb-10">
                <div class="flex flex-col gap-3">
                    <h1 class="text-4xl font-black tracking-tight text-gray-900 lg:text-5xl">Frequently Asked Questions</h1>
                    <p class="max-w-2xl text-lg text-gray-600">
                        Everything you need to know about PLAYSTAIHOME products and services. Can't find what you're looking for? Reach out to our team.
                    </p>
                </div>
            </section>

            <section class="mb-12">
                <div class="mb-6 flex items-center gap-3">
                    <i class="fa-solid fa-truck text-primary"></i>
                    <h2 class="text-2xl font-bold text-gray-900">Delivery &amp; Setup</h2>
                </div>

                <div class="space-y-4">
                    <details open class="overflow-hidden rounded-xl border border-gray-200 bg-white">
                        <summary class="flex cursor-pointer items-center justify-between gap-6 p-5">
                            <p class="font-semibold text-gray-900">How long does delivery take?</p>
                            <i class="fa-solid fa-chevron-down faq-chevron text-gray-500"></i>
                        </summary>
                        <div class="border-t border-gray-100 px-5 pb-5 pt-4 text-gray-600">
                            Standard delivery usually takes 3-5 business days depending on your location. Express shipping options are available at checkout for 1-2 day delivery.
                        </div>
                    </details>

                    <details class="overflow-hidden rounded-xl border border-gray-200 bg-white">
                        <summary class="flex cursor-pointer items-center justify-between gap-6 p-5">
                            <p class="font-semibold text-gray-900">Do you provide professional installation?</p>
                            <i class="fa-solid fa-chevron-down faq-chevron text-gray-500"></i>
                        </summary>
                        <div class="border-t border-gray-100 px-5 pb-5 pt-4 text-gray-600">
                            Yes! We offer professional white-glove installation services in most metropolitan areas. You can select "Professional Installation" during the checkout process.
                        </div>
                    </details>

                    <details class="overflow-hidden rounded-xl border border-gray-200 bg-white">
                        <summary class="flex cursor-pointer items-center justify-between gap-6 p-5">
                            <p class="font-semibold text-gray-900">What happens if my device arrives damaged?</p>
                            <i class="fa-solid fa-chevron-down faq-chevron text-gray-500"></i>
                        </summary>
                        <div class="border-t border-gray-100 px-5 pb-5 pt-4 text-gray-600">
                            We offer a 100% replacement guarantee for damaged arrivals. Please report any shipping damage within 48 hours of delivery by contacting our support team with photos of the packaging and item.
                        </div>
                    </details>
                </div>
            </section>

            <section class="mb-12">
                <div class="mb-6 flex items-center gap-3">
                    <i class="fa-solid fa-credit-card text-primary"></i>
                    <h2 class="text-2xl font-bold text-gray-900">Pricing &amp; Payments</h2>
                </div>

                <div class="space-y-4">
                    <details class="overflow-hidden rounded-xl border border-gray-200 bg-white">
                        <summary class="flex cursor-pointer items-center justify-between gap-6 p-5">
                            <p class="font-semibold text-gray-900">What payment methods do you accept?</p>
                            <i class="fa-solid fa-chevron-down faq-chevron text-gray-500"></i>
                        </summary>
                        <div class="border-t border-gray-100 px-5 pb-5 pt-4 text-gray-600">
                            We accept all major credit cards (Visa, Mastercard, Amex), PayPal, and offer financing options through Affirm for qualifying purchases.
                        </div>
                    </details>

                    <details class="overflow-hidden rounded-xl border border-gray-200 bg-white">
                        <summary class="flex cursor-pointer items-center justify-between gap-6 p-5">
                            <p class="font-semibold text-gray-900">Are there any monthly subscription fees?</p>
                            <i class="fa-solid fa-chevron-down faq-chevron text-gray-500"></i>
                        </summary>
                        <div class="border-t border-gray-100 px-5 pb-5 pt-4 text-gray-600">
                            While core hardware functionality does not require a subscription, our "Pro Home" cloud storage and advanced automation features are available as a monthly or yearly plan.
                        </div>
                    </details>
                </div>
            </section>

            <section class="mb-16">
                <div class="mb-6 flex items-center gap-3">
                    <i class="fa-solid fa-user-gear text-primary"></i>
                    <h2 class="text-2xl font-bold text-gray-900">Account Management</h2>
                </div>

                <div class="space-y-4">
                    <details class="overflow-hidden rounded-xl border border-gray-200 bg-white">
                        <summary class="flex cursor-pointer items-center justify-between gap-6 p-5">
                            <p class="font-semibold text-gray-900">How do I reset my password?</p>
                            <i class="fa-solid fa-chevron-down faq-chevron text-gray-500"></i>
                        </summary>
                        <div class="border-t border-gray-100 px-5 pb-5 pt-4 text-gray-600">
                            Go to the login page and click "Forgot Password." We will send an authentication link to your registered email address to set a new password.
                        </div>
                    </details>

                    <details class="overflow-hidden rounded-xl border border-gray-200 bg-white">
                        <summary class="flex cursor-pointer items-center justify-between gap-6 p-5">
                            <p class="font-semibold text-gray-900">Can I add multiple users to my home account?</p>
                            <i class="fa-solid fa-chevron-down faq-chevron text-gray-500"></i>
                        </summary>
                        <div class="border-t border-gray-100 px-5 pb-5 pt-4 text-gray-600">
                            Absolutely. Within the PLAYSTAIHOME app settings, navigate to "Manage Household" to invite family members using their email addresses.
                        </div>
                    </details>
                </div>
            </section>

            <section class="rounded-2xl border px-8 py-10 text-center" style="background-color: rgba(25, 120, 229, 0.08); border-color: rgba(25, 120, 229, 0.18);">
                <div class="mx-auto flex max-w-2xl flex-col items-center gap-6">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900 lg:text-3xl">Still have questions?</h3>
                        <p class="mt-2 text-gray-600">Our customer happiness team is available 24/7 to help you out.</p>
                    </div>

                    <div class="flex flex-wrap justify-center gap-4">
                        <button class="flex items-center gap-2 rounded-lg px-8 py-3 font-bold text-white bg-primary">
                            <i class="fa-regular fa-comment-dots"></i>
                            <span>Live Chat</span>
                        </button>
                        <button class="flex items-center gap-2 rounded-lg border border-gray-200 bg-white px-8 py-3 font-bold text-gray-900">
                            <i class="fa-regular fa-envelope"></i>
                            <span>Email Support</span>
                        </button>
                    </div>
                </div>
            </section>
        </main>

        <footer class="border-t border-gray-200 bg-white px-6 py-12 lg:px-8">
            <div class="mx-auto max-w-6xl">
                <div class="grid grid-cols-1 gap-12 md:grid-cols-4">
                    <div>
                        <div class="mb-4 flex items-center gap-3 text-primary">
                            <i class="fab fa-playstation text-2xl opacity-50"></i>
                            <span class="font-bold text-gray-900">PLAYSTAIHOME</span>
                        </div>
                        <p class="text-sm leading-relaxed text-gray-500">
                            Making homes smarter, safer, and more comfortable with cutting-edge technology.
                        </p>
                    </div>

                    <div>
                        <h4 class="mb-4 font-bold text-gray-900">Product</h4>
                        <ul class="space-y-2 text-sm text-gray-500">
                            <li><a href="#" class="hover:text-primary">Smart Lighting</a></li>
                            <li><a href="#" class="hover:text-primary">Security Cameras</a></li>
                            <li><a href="#" class="hover:text-primary">Thermostats</a></li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="mb-4 font-bold text-gray-900">Company</h4>
                        <ul class="space-y-2 text-sm text-gray-500">
                            <li><a href="#" class="hover:text-primary">About Us</a></li>
                            <li><a href="#" class="hover:text-primary">Careers</a></li>
                            <li><a href="#" class="hover:text-primary">Privacy Policy</a></li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="mb-4 font-bold text-gray-900">Follow Us</h4>
                        <div class="flex gap-4">
                            <a href="#" class="flex h-8 w-8 items-center justify-center rounded-full bg-gray-100 text-gray-600 hover:text-primary">
                                <i class="fa-solid fa-share-nodes text-sm"></i>
                            </a>
                            <a href="#" class="flex h-8 w-8 items-center justify-center rounded-full bg-gray-100 text-gray-600 hover:text-primary">
                                <i class="fa-solid fa-globe text-sm"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="mt-12 border-t border-gray-100 pt-8 text-center text-xs text-gray-400">
                    © 2026 PLAYSTAIHOME Inc. All rights reserved.
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
