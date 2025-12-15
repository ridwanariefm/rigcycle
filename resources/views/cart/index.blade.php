@extends('layouts.frontend')

@section('title', 'Keranjang Belanja')

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <h1 class="text-2xl font-bold mb-6">Keranjang Belanja</h1>

    @if($carts->count() > 0)
        <div class="flex flex-col lg:flex-row gap-8">
            
            <div class="flex-1">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    
                    <div class="bg-gray-50 px-6 py-4 border-b border-gray-100 text-sm font-semibold text-gray-500 uppercase tracking-wider hidden md:flex items-center">
                        <div class="w-1/2">Produk</div>
                        <div class="w-1/6 text-center">Harga</div>
                        <div class="w-1/6 text-center">Jumlah</div>
                        <div class="w-1/6 text-right">Total</div>
                    </div>

                    @php $grandTotal = 0; @endphp
                    @foreach($carts as $cart)
                        @php 
                            $subtotal = $cart->product->price * $cart->quantity;
                            $grandTotal += $subtotal;
                        @endphp

                        <div class="p-6 border-b border-gray-100 flex flex-col md:flex-row items-center gap-6">
                            
                            <div class="w-full md:w-1/2 flex items-center gap-4">
                                <div class="h-20 w-20 flex-shrink-0 overflow-hidden rounded-lg border border-gray-200 bg-gray-100">
                                    @if($cart->product->image)
                                        <img src="{{ asset('storage/' . $cart->product->image) }}" class="h-full w-full object-cover">
                                    @else
                                        <div class="flex items-center justify-center h-full text-xs text-gray-400">No Image</div>
                                    @endif
                                </div>
                                <div>
                                    <h3 class="text-base font-bold text-gray-900">{{ $cart->product->name }}</h3>
                                    <p class="text-sm text-gray-500">{{ $cart->product->category->name }}</p>
                                    
                                    <form action="{{ route('cart.destroy', $cart->id) }}" method="POST" class="mt-2">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 text-sm hover:underline flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <div class="w-full md:w-1/6 flex justify-between md:justify-center items-center">
                                <span class="md:hidden font-semibold text-gray-500 text-sm">Harga:</span>
                                <div class="text-gray-500 text-sm">Rp {{ number_format($cart->product->price, 0, ',', '.') }}</div>
                            </div>

                            <div class="w-full md:w-1/6 flex justify-between md:justify-center items-center">
                                <span class="md:hidden font-semibold text-gray-500 text-sm">Jumlah:</span>
                                
                                <div class="flex flex-col items-end md:items-center">
                                    <form action="{{ route('cart.update', $cart->id) }}" method="POST" class="update-cart-form">
                                        @csrf
                                        @method('PATCH')
                                        
                                        <div class="flex items-center border border-gray-300 rounded-md w-max">
                                            <button type="button" 
                                                class="px-3 py-1 text-gray-600 hover:bg-gray-100 border-r border-gray-300 disabled:opacity-50"
                                                onclick="updateQuantity(this, -1)"
                                                {{ $cart->quantity <= 1 ? 'disabled' : '' }}>
                                                -
                                            </button>

                                            <input type="number" name="quantity" value="{{ $cart->quantity }}" 
                                                class="w-12 text-center border-none p-1 text-sm focus:ring-0 appearance-none bg-white"
                                                min="1" max="{{ $cart->product->stock }}" readonly>

                                            <button type="button" 
                                                class="px-3 py-1 text-gray-600 hover:bg-gray-100 border-l border-gray-300"
                                                onclick="updateQuantity(this, 1)">
                                                +
                                            </button>
                                        </div>
                                    </form>
                                    <div class="text-[10px] text-gray-400 mt-1">Stok: {{ $cart->product->stock }}</div>
                                </div>
                            </div>

                            <div class="w-full md:w-1/6 flex justify-between md:justify-end items-center">
                                <span class="md:hidden font-semibold text-gray-500 text-sm">Total:</span>
                                <div class="font-bold text-indigo-600 text-lg">Rp {{ number_format($subtotal, 0, ',', '.') }}</div>
                            </div>

                        </div>
                    @endforeach
                </div>
            </div>

            <div class="w-full lg:w-96">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 sticky top-24">
                    <h2 class="text-lg font-bold text-gray-900 mb-4">Ringkasan Belanja</h2>
                    
                    <div class="flex justify-between items-center mb-6">
                        <span class="text-lg font-bold text-gray-900">Total Tagihan</span>
                        <span class="text-2xl font-extrabold text-indigo-600">Rp {{ number_format($grandTotal, 0, ',', '.') }}</span>
                    </div>

                    <a href="{{ route('checkout.index') }}" class="block w-full bg-indigo-600 text-white text-center py-3 rounded-lg font-bold hover:bg-indigo-700 transition shadow-lg hover:shadow-indigo-500/30">
                        Checkout Sekarang
                    </a>
                </div>
            </div>
        </div>
    @else
        <div class="text-center py-20 bg-white rounded-xl shadow-sm border border-gray-100">
            <div class="bg-indigo-50 w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-900 mb-2">Keranjangmu Kosong</h2>
            <p class="text-gray-500 mb-8">Wah, sepertinya kamu belum memilih komponen impianmu.</p>
            <a href="{{ route('home') }}" class="inline-block bg-indigo-600 text-white px-8 py-3 rounded-full font-bold hover:bg-indigo-700 transition">
                Mulai Belanja
            </a>
        </div>
    @endif
</div>

<script>
    function updateQuantity(button, change) {
        // 1. Ambil elemen input di dekat tombol yang diklik
        const form = button.closest('form');
        const input = form.querySelector('input[name="quantity"]');
        const currentVal = parseInt(input.value);
        const maxStock = parseInt(input.getAttribute('max'));

        // 2. Hitung nilai baru
        let newVal = currentVal + change;

        // 3. Validasi: Tidak boleh kurang dari 1
        if (newVal < 1) newVal = 1;

        // 4. Validasi: Tidak boleh lebih dari stok
        if (newVal > maxStock) {
            alert('Stok maksimal hanya ' + maxStock + ' item!');
            return; // Batalkan
        }

        // 5. Set nilai baru ke input
        input.value = newVal;

        // 6. Submit form secara otomatis
        form.submit();
    }
</script>

@endsection