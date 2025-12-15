@extends('layouts.frontend')

@section('title', $product->name . ' - RigCycle')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        <div class="mb-6">
            <a href="{{ route('home') }}" class="text-gray-500 hover:text-indigo-600 transition flex items-center gap-1">
                &larr; Kembali Belanja
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="grid grid-cols-1 md:grid-cols-2">

                <div class="bg-gray-100 h-96 md:h-auto flex items-center justify-center relative group min-h-[400px]">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                            class="max-w-full max-h-[400px] object-contain p-8 mix-blend-multiply transition-transform duration-500 hover:scale-105">
                    @else
                        <span class="text-gray-400 text-lg">Tidak ada gambar</span>
                    @endif

                    <span
                        class="absolute top-4 left-4 px-3 py-1 text-sm font-bold rounded-full {{ $product->condition == 'new' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                        {{ $product->condition == 'new' ? 'Baru' : 'Bekas' }}
                    </span>
                </div>

                <div class="p-8 md:p-12 flex flex-col justify-center">

                    <div class="flex items-center gap-2 mb-4 text-sm">
                        <span
                            class="text-indigo-600 font-bold uppercase tracking-wider">{{ $product->category->name }}</span>
                        <span class="text-gray-300">&bull;</span>
                        <span class="text-gray-500 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                </path>
                            </svg>
                            {{ $product->store->name }}
                        </span>
                    </div>

                    <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-4 leading-tight">
                        {{ $product->name }}
                    </h1>

                    <div class="text-3xl font-bold text-gray-900 mb-6">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </div>

                    <div class="prose prose-sm text-gray-500 mb-8 border-t border-b border-gray-100 py-4">
                        <p class="mb-2 font-semibold text-gray-700">Deskripsi:</p>
                        <p>{{ $product->description ?? 'Tidak ada deskripsi detail untuk produk ini.' }}</p>
                        <p class="mt-2 text-xs text-gray-400">Berat: {{ $product->weight }} gram</p>
                    </div>

                    <form action="{{ route('cart.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        <div class="flex items-center gap-4">
                            <div class="w-24">
                                <label for="quantity" class="sr-only">Jumlah</label>
                                <input type="number" name="quantity" id="quantity" value="1" min="1"
                                    class="block w-full border-gray-300 rounded-lg text-center focus:ring-indigo-500 focus:border-indigo-500 h-12">
                            </div>

                            <button type="submit"
                                class="flex-1 bg-indigo-600 text-white px-8 py-3 rounded-lg font-bold text-lg hover:bg-indigo-700 transition shadow-lg hover:shadow-xl transform active:scale-95 flex justify-center items-center gap-2 h-12">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                </svg>
                                Masukkan Keranjang
                            </button>
                        </div>
                    </form>

                    @if(session('success'))
                        <div class="mt-4 p-3 bg-green-100 text-green-700 rounded text-sm text-center font-medium">
                            {{ session('success') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection