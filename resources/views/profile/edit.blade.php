@extends('layouts.frontend')

@section('title', 'Pengaturan Akun')

@section('content')
    <div class="bg-gray-50 min-h-screen py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mb-10">
                <h1 class="text-3xl font-bold text-gray-900">Pengaturan Akun</h1>
                <p class="mt-1 text-gray-500">Kelola profil, keamanan, dan preferensi akun Anda.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <div class="lg:col-span-1">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sticky top-24">
                        <div class="flex items-center gap-4 mb-6">
                            <div
                                class="h-16 w-16 bg-indigo-100 rounded-full flex items-center justify-center text-indigo-600 font-bold text-2xl overflow-hidden border-2 border-white shadow-sm">
                                @if(Auth::user()->avatar)
                                    <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}"
                                        class="h-full w-full object-cover">
                                @else
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                @endif
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900">{{ Auth::user()->name }}</h3>
                                <p class="text-sm text-gray-500">{{ Auth::user()->email }}</p>
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ Auth::user()->role === 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-green-100 text-green-800' }} mt-1">
                                    {{ ucfirst(Auth::user()->role) }}
                                </span>
                            </div>
                        </div>

                        <nav class="space-y-1">
                            <a href="#profile-info" id="nav-profile-info"
                                class="sidebar-link flex items-center px-3 py-2 text-sm font-medium rounded-md transition-colors">
                                <svg class="flex-shrink-0 -ml-1 mr-3 h-5 w-5" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Profil Saya
                            </a>
                            <a href="#update-password" id="nav-update-password"
                                class="sidebar-link flex items-center px-3 py-2 text-sm font-medium rounded-md transition-colors">
                                <svg class="flex-shrink-0 -ml-1 mr-3 h-5 w-5" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                    </path>
                                </svg>
                                Keamanan
                            </a>
                            <a href="#delete-account" id="nav-delete-account"
                                class="sidebar-link flex items-center px-3 py-2 text-sm font-medium rounded-md transition-colors">
                                <svg class="flex-shrink-0 -ml-1 mr-3 h-5 w-5" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                    </path>
                                </svg>
                                Hapus Akun
                            </a>
                        </nav>
                    </div>
                </div>

                <div class="lg:col-span-2 space-y-8 relative">

                    <div id="profile-info"
                        class="scroll-section bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden scroll-mt-24">
                        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50 flex items-center gap-2">
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0c0 .667.333 1 1 1v1m0 0a2 2 0 104 0V8a2 2 0 10-4 0V6z">
                                </path>
                            </svg>
                            <h2 class="text-lg font-bold text-gray-900">Informasi Pribadi</h2>
                        </div>
                        <div class="p-6">
                            <div class="max-w-xl">
                                @include('profile.partials.update-profile-information-form')
                            </div>
                        </div>
                    </div>

                    <div id="update-password"
                        class="scroll-section bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden scroll-mt-24">
                        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50 flex items-center gap-2">
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                </path>
                            </svg>
                            <h2 class="text-lg font-bold text-gray-900">Update Password</h2>
                        </div>
                        <div class="p-6">
                            <div class="max-w-xl">
                                @include('profile.partials.update-password-form')
                            </div>
                        </div>
                    </div>

                    <div id="delete-account"
                        class="scroll-section bg-white rounded-2xl shadow-sm border border-red-100 overflow-hidden scroll-mt-24">
                        <div class="px-6 py-4 border-b border-red-100 bg-red-50 flex items-center gap-2">
                            <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                </path>
                            </svg>
                            <h2 class="text-lg font-bold text-red-600">Zona Bahaya</h2>
                        </div>
                        <div class="p-6">
                            <div class="max-w-xl">
                                @include('profile.partials.delete-user-form')
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- SCRIPT SCROLL SPY --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const sections = document.querySelectorAll('.scroll-section');
            const navLinks = document.querySelectorAll('.sidebar-link');

            // Fungsi untuk menghapus kelas aktif lama dan menambah yang baru
            function setActiveLink(id) {
                navLinks.forEach(link => {
                    // Hapus style Aktif (Biru)
                    link.classList.remove('bg-indigo-50', 'text-indigo-700');
                    link.querySelector('svg').classList.remove('text-indigo-500');

                    // Tambah style Inaktif (Abu)
                    link.classList.add('text-gray-600', 'hover:bg-gray-50', 'hover:text-gray-900');
                    link.querySelector('svg').classList.add('text-gray-400');

                    // Jika href sesuai dengan ID section, jadikan Aktif
                    if (link.getAttribute('href') === '#' + id) {
                        link.classList.remove('text-gray-600', 'hover:bg-gray-50', 'hover:text-gray-900');
                        link.querySelector('svg').classList.remove('text-gray-400');

                        link.classList.add('bg-indigo-50', 'text-indigo-700');
                        link.querySelector('svg').classList.add('text-indigo-500');
                    }
                });
            }

            // 1. Deteksi saat User Scroll manual
            window.addEventListener('scroll', () => {
                let current = '';

                sections.forEach(section => {
                    const sectionTop = section.offsetTop;
                    const sectionHeight = section.clientHeight;

                    // Jika posisi scroll ada di area section ini (-150 untuk offset header)
                    if (pageYOffset >= (sectionTop - 150)) {
                        current = section.getAttribute('id');
                    }
                });

                if (current) {
                    setActiveLink(current);
                }
            });

            // 2. Deteksi saat Link diklik (Biar langsung pindah warna)
            navLinks.forEach(link => {
                link.addEventListener('click', function (e) {
                    // Ambil ID tujuan dari href (#profile-info -> profile-info)
                    const targetId = this.getAttribute('href').substring(1);
                    setActiveLink(targetId);
                });
            });

            // Set default aktif pertama kali load
            setActiveLink('profile-info');
        });
    </script>
@endsection