@extends('layouts.frontend')

@section('title', 'Detail Pesanan #' . $order->order_number)

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        <div class="mb-8 flex justify-between items-center">
            <h1 class="text-3xl font-bold text-gray-900">Detail Pesanan #{{ $order->order_number }}</h1>
            <a href="{{ route('dashboard') }}"
                class="inline-flex items-center text-sm font-medium text-indigo-600 hover:text-indigo-800">
                &larr; Kembali ke Riwayat
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <div class="lg:col-span-2 space-y-8">

                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4 border-b pb-2">Produk yang Dibeli</h2>
                    <div class="space-y-4">
                        @foreach($order->items as $item)
                            <div
                                class="flex justify-between items-start border-b border-gray-100 pb-4 last:border-b-0 last:pb-0">
                                <div class="flex items-center gap-4">
                                    
                                    {{-- 🌟 MODIFIKASI DIMULAI DI SINI: MENAMPILKAN GAMBAR 🌟 --}}
                                    <div class="w-16 h-16 bg-gray-100 rounded-lg overflow-hidden flex items-center justify-center">
                                        @if($item->product && $item->product->image)
                                            <img src="{{ asset('storage/' . $item->product->image) }}" 
                                                 alt="{{ $item->product->name }}" 
                                                 class="w-full h-full object-cover">
                                        @else
                                            {{-- Placeholder jika gambar tidak ada --}}
                                            <svg class="w-6 h-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        @endif
                                    </div>
                                    {{-- 🌟 MODIFIKASI BERAKHIR DI SINI 🌟 --}}
                                    
                                    <div>
                                        <p class="font-medium text-gray-900">{{ $item->product->name ?? 'Produk Dihapus' }}</p>
                                        <p class="text-sm text-gray-500">
                                            Rp {{ number_format($item->product->price, 0, ',', '.') }} x {{ $item->quantity }}
                                        </p>
                                    </div>
                                </div>
                                <div class="text-base font-bold text-gray-900">
                                    Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4 border-b pb-2">Rincian Biaya</h2>
                    <div class="space-y-2 text-gray-700">
                        <div class="flex justify-between">
                            <span>Subtotal Produk ({{ $order->items->sum('quantity') }} Barang)</span>
                            <span>Rp {{ number_format($order->subtotal, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Biaya Pengiriman</span>
                            <span>Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between font-bold text-lg pt-2 border-t border-dashed mt-4 text-gray-900">
                            <span>TOTAL TAGIHAN</span>
                            <span class="text-indigo-600">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

            </div>

            <div class="lg:col-span-1 space-y-8">

                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4 border-b pb-2">Status & Pembayaran</h2>

                    <div class="space-y-4">
                        <p class="text-sm text-gray-500">Status Pesanan:</p>
                        @php
                            $statusData = [
                                'unpaid' => ['bg-yellow-100', 'text-yellow-800', 'Menunggu Pembayaran'],
                                'paid' => ['bg-green-100', 'text-green-800', 'Pembayaran Diterima'],
                                'expired' => ['bg-gray-100', 'text-gray-800', 'Kadaluarsa'],
                                'cancelled' => ['bg-red-100', 'text-red-800', 'Dibatalkan'],
                            ];
                            $status = strtolower($order->status);
                            $currentStatus = $statusData[$status] ?? ['bg-blue-100', 'text-blue-800', ucfirst($order->status)];
                        @endphp
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold {{ $currentStatus[0] }} {{ $currentStatus[1] }}">
                            {{ $currentStatus[2] }}
                        </span>

                        @if($order->status == 'unpaid')
                            <p class="text-sm text-gray-700 pt-2">Segera lakukan pembayaran untuk memproses pesanan Anda.</p>
                            <a href="{{ route('orders.pay', $order->id) }}"
                                class="block w-full text-center mt-4 text-white bg-indigo-600 hover:bg-indigo-700 px-4 py-2 rounded-lg font-bold shadow-md transition">
                                Bayar Sekarang
                            </a>
                        @endif
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4 border-b pb-2">Alamat Pengiriman</h2>
                    <p class="font-medium text-gray-900">{{ $order->user_name }} ({{ $order->user_phone }})</p>
                    <p class="text-sm text-gray-700 mt-1">
                        {{ $order->shipping_address }} <br>
                        {{ $order->city }}, {{ $order->province }} - {{ $order->zip_code }}
                    </p>
                    <p class="text-xs text-indigo-600 mt-2 font-semibold">
                        Kurir: {{ $order->courier }}
                    </p>
                </div>
            </div>

        </div>

    </div>
@endsection