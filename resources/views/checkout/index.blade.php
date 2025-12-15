@extends('layouts.frontend')

@section('title', 'Isi Alamat Pengiriman')

@section('content')
    {{-- HITUNG SUBTOTAL DAN BIAYA KIRIM DI AWAL (AGAR BISA DIAKSES SEMUA INPUT) --}}
    @php 
        $subtotal = 0;
        // Hitung Subtotal Harga Produk
        foreach($carts as $cart) {
            $subtotal += $cart->product->price * $cart->quantity;
        }
        $shippingCost = 15000; // Biaya kirim dummy (GANTI JADI DINAMIS JIKA SUDAH ADA RAJAONGKIR)
        $finalTotal = $subtotal + $shippingCost;
    @endphp

    <div class="max-w-5xl mx-auto px-4 py-10">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Pengiriman & Pembayaran</h1>
            <p class="text-gray-500 mt-1">Lengkapi alamat tujuan dan pilih opsi pengiriman.</p>
        </div>

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <form action="{{ route('checkout.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                <div class="md:col-span-2 space-y-6">
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                        <h2 class="text-xl font-bold mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Detail Penerima
                        </h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-gray-700 font-bold mb-2 text-sm" for="user_name">Nama Penerima</label>
                                <input type="text" name="user_name" id="user_name" value="{{ old('user_name', Auth::user()->name) }}"
                                    class="w-full border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 @error('user_name') border-red-500 @enderror"
                                    placeholder="Nama Lengkap" required>
                                @error('user_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-gray-700 font-bold mb-2 text-sm" for="user_phone">Nomor HP</label>
                                <input type="tel" name="user_phone" id="user_phone" value="{{ old('user_phone') }}"
                                    class="w-full border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 @error('user_phone') border-red-500 @enderror"
                                    placeholder="08xxxxxxxxxx" required>
                                @error('user_phone') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2 text-sm" for="shipping_address">Alamat Lengkap</label>
                            <textarea name="shipping_address" id="shipping_address" rows="3"
                                class="w-full border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 @error('shipping_address') border-red-500 @enderror"
                                placeholder="Nama Jalan, Nomor Rumah, RT/RW, Kelurahan..." required>{{ old('shipping_address') }}</textarea>
                            @error('shipping_address') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-gray-700 font-bold mb-2 text-sm" for="province">Provinsi</label>
                                <input type="text" name="province" id="province" value="{{ old('province') }}"
                                    class="w-full border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 @error('province') border-red-500 @enderror"
                                    placeholder="Contoh: Jawa Barat" required>
                                @error('province') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                            
                            <div>
                                <label class="block text-gray-700 font-bold mb-2 text-sm" for="city">Kota/Kabupaten</label>
                                <input type="text" name="city" id="city" value="{{ old('city') }}"
                                    class="w-full border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 @error('city') border-red-500 @enderror"
                                    placeholder="Contoh: Bandung" required>
                                @error('city') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                            
                            <div>
                                <label class="block text-gray-700 font-bold mb-2 text-sm" for="zip_code">Kode Pos</label>
                                <input type="text" name="zip_code" id="zip_code" value="{{ old('zip_code') }}"
                                    class="w-full border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 @error('zip_code') border-red-500 @enderror"
                                    placeholder="40xxx" required>
                                @error('zip_code') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                        <h2 class="text-xl font-bold mb-4">Pilih Kurir & Metode Bayar</h2>
                        
                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2 text-sm" for="courier">Opsi Pengiriman</label>
                            <select name="courier" id="courier" class="w-full border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 @error('courier') border-red-500 @enderror" required>
                                <option value="">-- Pilih Kurir Pengiriman --</option>
                                <option value="JNE Reguler" {{ old('courier') == 'JNE Reguler' ? 'selected' : '' }}>JNE Reguler (Rp {{ number_format(15000, 0, ',', '.') }})</option>
                                <option value="J&T Express" {{ old('courier') == 'J&T Express' ? 'selected' : '' }}>J&T Express (Rp {{ number_format(15000, 0, ',', '.') }})</option>
                                <option value="SiCepat Reguler" {{ old('courier') == 'SiCepat Reguler' ? 'selected' : '' }}>SiCepat Reguler (Rp {{ number_format(15000, 0, ',', '.') }})</option>
                            </select>
                            @error('courier') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <input type="hidden" name="payment_method" value="Midtrans">
                    </div>

                    {{-- DIJAMIN $subtotal, $shippingCost, dan $finalTotal sudah didefinisikan di awal --}}
                    <input type="hidden" name="subtotal" id="subtotal_input" value="{{ $subtotal }}">
                    <input type="hidden" name="shipping_cost" id="shipping_cost_input" value="{{ $shippingCost }}">
                    <input type="hidden" name="total_price" id="total_price_input" value="{{ $finalTotal }}">
                </div>

                <div class="md:col-span-1">
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 sticky top-24">
                        <h2 class="text-lg font-bold mb-4 border-b pb-2">Ringkasan Pesanan</h2>

                        <ul class="space-y-3 mb-4 max-h-60 overflow-y-auto pr-2">
                            @foreach($carts as $cart)
                                <li class="flex justify-between text-sm">
                                    <span class="text-gray-600 truncate w-2/3">{{ $cart->product->name }} (x{{ $cart->quantity }})</span>
                                    <span class="font-medium">Rp {{ number_format($cart->product->price * $cart->quantity, 0, ',', '.') }}</span>
                                </li>
                            @endforeach
                        </ul>

                        <div class="border-t pt-4 space-y-2">
                            <div class="flex justify-between text-sm text-gray-700">
                                <span>Subtotal Produk</span>
                                <span class="font-medium">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between text-sm text-gray-700">
                                <span>Biaya Pengiriman</span>
                                <span class="font-medium text-green-600">+ Rp {{ number_format($shippingCost, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <div class="border-t pt-4 flex justify-between items-center mt-4">
                            <span class="font-bold text-lg">TOTAL BAYAR</span>
                            <span class="font-bold text-xl text-indigo-600" id="final_total_display">
                                Rp {{ number_format($finalTotal, 0, ',', '.') }}
                            </span>
                        </div>

                        <button type="submit"
                            class="w-full bg-indigo-600 text-white py-3 mt-6 rounded-lg font-bold hover:bg-indigo-700 transition shadow-lg hover:shadow-indigo-500/30">
                            Lanjut Pembayaran 💳
                        </button>
                    </div>
                </div>

            </div>
        </form>
    </div>

    @push('scripts')
    <script>
        // SCRIPT JIKA ANDA MENGGUNAKAN HARDCODE BIAYA KIRIM
        document.addEventListener('DOMContentLoaded', function() {
            // Logika JS tidak perlu menghitung ulang, cukup menampilkan nilai yang sudah dihitung PHP
            // Jika ada perubahan Kurir, Anda perlu AJAX di sini!
        });
    </script>
    @endpush
@endsection