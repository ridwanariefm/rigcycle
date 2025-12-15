@extends('layouts.frontend')

@section('title', 'Belanja Komputer & Part')

@section('content')

<div class="mb-10 w-full"> 
    
    <div x-data="{ activeSlide: 1, totalSlides: 3, interval: null }"
         x-init="interval = setInterval(() => { activeSlide = (activeSlide % totalSlides) + 1 }, 5000)"
         @mouseenter="clearInterval(interval)"
         @mouseleave="interval = setInterval(() => { activeSlide = (activeSlide % totalSlides) + 1 }, 5000)"
         
         class="relative overflow-hidden bg-gray-900 h-[250px] md:h-[400px]"> 

        <div class="flex transition-transform duration-500 ease-out h-full"
             :style="`transform: translateX(-${(activeSlide - 1) * 100}%)`">
            
            <div class="w-full flex-shrink-0 relative bg-cover bg-center" style="background-image: url('https://picsum.photos/id/1018/1920/1080');">
                <div class="absolute inset-0 bg-black/40 flex items-center justify-center px-4 sm:px-6 lg:px-8"> 
                    <div class="text-center text-white p-6">
                        <h2 class="text-3xl md:text-5xl font-extrabold mb-2">PROMO AWAL TAHUN!</h2>
                        <p class="text-xl md:text-2xl font-light">Diskon 10% untuk semua VGA Card terbaru.</p>
                        <a href="#" class="mt-4 inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-6 rounded-full transition">Belanja Sekarang</a>
                    </div>
                </div>
            </div>

            <div class="w-full flex-shrink-0 relative bg-cover bg-center" style="background-image: url('https://picsum.photos/id/1080/1920/1080');">
                <div class="absolute inset-0 bg-indigo-900/60 flex items-center justify-center px-4 sm:px-6 lg:px-8">
                     <div class="text-center text-white p-6">
                        <h2 class="text-3xl md:text-5xl font-extrabold mb-2">Bekas Rasa Baru!</h2>
                        <p class="text-xl md:text-2xl font-light">Garansi 6 bulan untuk semua komponen *used*.</p>
                        <a href="{{ route('home', ['condition' => 'used']) }}" class="mt-4 inline-block bg-white hover:bg-gray-100 text-indigo-600 font-semibold py-2 px-6 rounded-full transition">Lihat Produk Bekas</a>
                    </div>
                </div>
            </div>

            <div class="w-full flex-shrink-0 relative bg-cover bg-center" style="background-image: url('https://picsum.photos/id/1025/1920/1080');">
                <div class="absolute inset-0 bg-gray-900/60 flex items-center justify-center px-4 sm:px-6 lg:px-8">
                    <div class="text-center text-white p-6">
                        <h2 class="text-3xl md:text-5xl font-extrabold mb-2">PC Building Kit</h2>
                        <p class="text-xl md:text-2xl font-light">Mulai rakit PC impianmu, gratis konsultasi.</p>
                        <a href="#" class="mt-4 inline-block bg-emerald-500 hover:bg-emerald-600 text-white font-semibold py-2 px-6 rounded-full transition">Mulai Merakit</a>
                    </div>
                </div>
            </div>

        </div>

        <div class="absolute bottom-4 left-0 right-0 flex justify-center space-x-2">
            <template x-for="i in totalSlides" :key="i">
                <button @click="activeSlide = i; clearInterval(interval); interval = setInterval(() => { activeSlide = (activeSlide % totalSlides) + 1 }, 5000)"
                        :class="{'bg-white': activeSlide === i, 'bg-white/50 hover:bg-white': activeSlide !== i}"
                        class="w-3 h-3 rounded-full transition-colors duration-300"></button>
            </template>
        </div>
        
        <button @click="activeSlide = activeSlide > 1 ? activeSlide - 1 : totalSlides; clearInterval(interval); interval = setInterval(() => { activeSlide = (activeSlide % totalSlides) + 1 }, 5000)"
                class="absolute top-1/2 left-0 transform -translate-y-1/2 text-white p-4 rounded-r-lg bg-black/30 hover:bg-black/50 transition hidden md:block z-20">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
        </button>
        <button @click="activeSlide = activeSlide < totalSlides ? activeSlide + 1 : 1; clearInterval(interval); interval = setInterval(() => { activeSlide = (activeSlide % totalSlides) + 1 }, 5000)"
                class="absolute top-1/2 right-0 transform -translate-y-1/2 text-white p-4 rounded-l-lg bg-black/30 hover:bg-black/50 transition hidden md:block z-20">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        </button>

    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

    <div class="mb-8 text-center md:text-left">
        <h1 class="text-3xl font-extrabold text-gray-900">Katalog Produk</h1>
        <p class="mt-2 text-gray-500">Temukan komponen PC terbaik untuk kebutuhan rakitanmu.</p>
    </div>

    <div class="mb-10 bg-white p-5 rounded-2xl shadow-sm border border-gray-100">
        <form action="{{ route('home') }}" method="GET">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center">
                
                <div class="md:col-span-5 relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" 
                        class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-xl leading-5 bg-gray-50 placeholder-gray-500 focus:outline-none focus:bg-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-all" 
                        placeholder="Cari prosesor, vga, ram...">
                </div>

                <div class="md:col-span-3">
                    <select name="category_id" class="block w-full py-2.5 px-3 border border-gray-300 bg-white rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm cursor-pointer">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="md:col-span-2">
                    <select name="condition" class="block w-full py-2.5 px-3 border border-gray-300 bg-white rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm cursor-pointer">
                        <option value="">Semua Kondisi</option>
                        <option value="new" {{ request('condition') == 'new' ? 'selected' : '' }}>Baru (New)</option>
                        <option value="used" {{ request('condition') == 'used' ? 'selected' : '' }}>Bekas (Used)</option>
                    </select>
                </div>

                <div class="md:col-span-2 flex gap-2">
                    <button type="submit" class="w-full bg-indigo-600 text-white px-4 py-2.5 rounded-xl hover:bg-indigo-700 text-sm font-bold transition shadow-lg shadow-indigo-200">
                        Cari
                    </button>
                    @if(request()->has('search') || request()->has('category_id') || request()->has('condition'))
                        <a href="{{ route('home') }}" class="bg-gray-100 text-gray-500 px-3 py-2.5 rounded-xl hover:bg-gray-200 text-sm font-medium transition flex items-center justify-center" title="Reset Filter">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                        </a>
                    @endif
                </div>
            </div>
        </form>
    </div>

    @if($products->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($products as $product)
                <div class="group relative bg-white border border-gray-200 rounded-2xl flex flex-col overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    
                    <a href="{{ route('product.show', $product->slug) }}" class="block">
                        <div class="aspect-w-1 aspect-h-1 bg-gray-200 group-hover:opacity-90 transition-opacity h-56 overflow-hidden relative">
                            <div class="absolute top-2 left-2 z-10">
                                @if(strtolower($product->condition) == 'new' || strtolower($product->condition) == 'baru')
                                    <span class="bg-emerald-500 text-white text-[10px] font-bold px-2 py-1 rounded-md shadow-sm uppercase tracking-wide">Baru</span>
                                @else
                                    <span class="bg-amber-500 text-white text-[10px] font-bold px-2 py-1 rounded-md shadow-sm uppercase tracking-wide">Bekas</span>
                                @endif
                            </div>

                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover object-center">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-gray-50 text-gray-300">
                                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                            @endif

                            <div class="absolute inset-x-0 bottom-0 p-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300 bg-gradient-to-t from-black/50 to-transparent">
                                <form action="{{ route('cart.store') }}" method="POST"> 
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="w-full bg-white text-gray-900 font-bold py-2 rounded-lg shadow-lg hover:bg-gray-100 flex items-center justify-center gap-2">
                                        <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                        + Keranjang
                                    </button>
                                </form>
                            </div>
                        </div>
                    </a> <div class="flex-1 p-4 flex flex-col justify-between">
                        <div>
                            <p class="text-xs text-indigo-600 font-semibold uppercase tracking-wide mb-1">
                                {{ $product->category->name }}
                            </p>
                            <h3 class="text-sm font-bold text-gray-900 line-clamp-2 min-h-[2.5rem]">
                                <a href="{{ route('product.show', $product->slug) }}" class="hover:text-indigo-600 transition-colors"> 
                                     {{ $product->name }}
                                </a>
                                </h3>
                        </div>
                        <div class="mt-3 flex items-center justify-between">
                            <p class="text-lg font-extrabold text-gray-900">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </p>
                            <div class="text-xs text-gray-500 flex items-center gap-1">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                                Stok: {{ $product->stock }}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-10">
            {{ $products->appends(request()->query())->links() }}
        </div>
    
    @else
        <div class="text-center py-20 bg-white rounded-2xl border border-gray-100 shadow-sm">
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-gray-50 mb-6">
                <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
            <h2 class="text-xl font-bold text-gray-900">Produk tidak ditemukan</h2>
            <p class="text-gray-500 mt-2 max-w-sm mx-auto">
                Maaf, kami tidak dapat menemukan produk yang sesuai dengan filter pencarian Anda.
            </p>
            <a href="{{ route('home') }}" class="mt-6 inline-flex items-center px-6 py-2 border border-transparent text-sm font-medium rounded-full shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 transition">
                Reset Filter
            </a>
        </div>
    @endif

</div>
@endsection