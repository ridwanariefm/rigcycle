<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'RigCycle - Market Part Bekas')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>

<body class="bg-gray-50 font-sans text-gray-900 antialiased flex flex-col min-h-screen">

    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center gap-2">
                    <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                        <div class="bg-indigo-600 text-white p-1.5 rounded group-hover:bg-indigo-700 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                            </svg>
                        </div>
                        <h1
                            class="text-2xl font-bold text-gray-900 tracking-tight group-hover:text-indigo-600 transition">
                            RigCycle</h1>
                    </a>
                </div>

                <div class="flex items-center space-x-6">

                    @auth
                        <a href="{{ route('cart.index') }}" class="text-gray-700 hover:text-indigo-600 relative">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>

                            @auth
                                @php
                                    // Menghitung total quantity (misal: beli 2 RAM = muncul angka 2)
                                    // Jika ingin menghitung jenis barang saja, ganti sum('quantity') menjadi count()
                                    $cartCount = \App\Models\Cart::where('user_id', Auth::id())->sum('quantity');
                                @endphp

                                @if($cartCount > 0)
                                    <span
                                        class="absolute -top-2 -right-2 bg-red-500 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full shadow-sm border border-white">
                                        {{ $cartCount }}
                                    </span>
                                @endif
                            @endauth
                        </a>

                        <div class="relative group h-full flex items-center">
                            <button
                                class="flex items-center gap-2 text-gray-700 font-medium hover:text-indigo-600 focus:outline-none h-full transition-colors">

                                <div
                                    class="h-8 w-8 rounded-full bg-indigo-100 flex items-center justify-center overflow-hidden border border-gray-200">
                                    @if(Auth::user()->avatar)
                                        <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Avatar"
                                            class="h-full w-full object-cover">
                                    @else
                                        <span
                                            class="text-xs font-bold text-indigo-600">{{ substr(Auth::user()->name, 0, 1) }}</span>
                                    @endif
                                </div>

                                <span>{{ Auth::user()->name }}</span>

                                <svg class="w-4 h-4 transition-transform group-hover:rotate-180" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>

                            <div class="absolute right-0 top-full w-48 hidden group-hover:block pt-2 z-50">
                                <div class="bg-white rounded-md shadow-lg py-1 border border-gray-100">
                                    @if(Auth::user()->role === 'admin')
                                        <a href="{{ route('admin.products.index') }}"
                                            class="block px-4 py-2 text-sm font-bold text-indigo-600 hover:bg-indigo-50">
                                            ⚙️ Halaman Admin
                                        </a>
                                        <div class="border-t border-gray-100 my-1"></div>
                                    @endif
                                    <a href="{{ route('dashboard') }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600">
                                        Dashboard & History
                                    </a>
                                    <a href="{{ route('profile.edit') }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600">
                                        Edit Profile
                                    </a>
                                    <div class="border-t border-gray-100 my-1"></div>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit"
                                            class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                            Logout
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                    @else
                        <a href="{{ route('login') }}"
                            class="text-gray-600 hover:text-indigo-600 font-medium transition">Masuk</a>
                        <a href="{{ route('register') }}"
                            class="bg-indigo-600 text-white px-5 py-2 rounded-full hover:bg-indigo-700 transition shadow-md font-medium">Daftar</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="flex-grow">
        @yield('content')
    </main>

    <footer class="bg-white border-t mt-12 py-8">
        <div class="max-w-7xl mx-auto px-4 text-center text-gray-400 text-sm">
            &copy; 2025 RigCycle Indonesia. All rights reserved.
        </div>
    </footer>

    <script src="//unpkg.com/alpinejs" defer></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @stack('scripts')

</body>

</html>