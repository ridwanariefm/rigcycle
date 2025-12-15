@extends('layouts.frontend')

@section('title', 'Dashboard & Riwayat - RigCycle')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Dashboard Saya</h1>
                <p class="text-gray-500 mt-1">Selamat datang kembali, <span
                        class="font-semibold text-indigo-600">{{ Auth::user()->name }}</span>!</p>
            </div>
            <a href="{{ route('profile.edit') }}"
                class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 shadow-sm transition">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                Edit Profil & Password
            </a>
        </div>

        <div class="bg-white overflow-hidden shadow-sm rounded-xl border border-gray-100">
            <div class="p-6 border-b border-gray-100 bg-gray-50">
                <h2 class="text-lg font-bold text-gray-800">Riwayat Pembelian</h2>
            </div>

            @if($orders->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-gray-600">
                        <thead
                            class="bg-white border-b border-gray-100 uppercase text-xs font-bold text-gray-500 tracking-wider">
                            <tr>
                                <th class="px-6 py-4">No. Order</th>
                                <th class="px-6 py-4">Tanggal</th>
                                <th class="px-6 py-4">Produk Dibeli</th> <th class="px-6 py-4">Total Harga</th>
                                <th class="px-6 py-4">Status</th>
                                <th class="px-6 py-4 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50 bg-white">
                            @foreach($orders as $order)
                                <tr class="hover:bg-gray-50 transition">
                                    
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        #{{ $order->order_number }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $order->created_at->format('d M Y') }}
                                        <div class="text-xs text-gray-400">{{ $order->created_at->format('H:i') }} WIB</div>
                                    </td>

                                    <td class="px-6 py-4">
                                        @foreach($order->items as $item)
                                            <div class="flex items-center gap-2 mb-1 last:mb-0">
                                                <a href="{{ route('product.show', $item->product->slug) }}" 
                                                    class="text-sm font-medium text-gray-800 hover:text-indigo-600 hover:underline">
                                                    {{ $item->product->name }}
                                                </a>
                                                <span class="text-xs text-gray-400"> (x{{ $item->quantity }})</span>
                                            </div>
                                        @endforeach
                                        <div class="font-bold text-indigo-600 text-base mt-2">
                                             Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 font-bold text-gray-900 whitespace-nowrap">
                                        Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                    </td>
                                    
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                            $statusClass = [
                                                'paid' => ['bg-green-100', 'text-green-800', 'Lunas'],
                                                'unpaid' => ['bg-yellow-100', 'text-yellow-800', 'Menunggu Bayar'],
                                                'expired' => ['bg-gray-100', 'text-gray-800', 'Kadaluarsa'],
                                                'cancelled' => ['bg-red-100', 'text-red-800', 'Dibatalkan'],
                                            ];
                                            $currentStatus = $statusClass[strtolower($order->status)] ?? ['bg-blue-100', 'text-blue-800', ucfirst($order->status)];
                                        @endphp

                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $currentStatus[0] }} {{ $currentStatus[1] }}">
                                            @if($order->status == 'paid')
                                                <svg class="mr-1.5 h-2 w-2 text-green-400" fill="currentColor" viewBox="0 0 8 8"><circle cx="4" cy="4" r="3" /></svg>
                                            @elseif($order->status == 'unpaid')
                                                <svg class="mr-1.5 h-2 w-2 text-yellow-400" fill="currentColor" viewBox="0 0 8 8"><circle cx="4" cy="4" r="3" /></svg>
                                            @endif
                                            {{ $currentStatus[2] }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 text-right whitespace-nowrap text-sm font-medium">
                                        <a href="{{ route('orders.show', $order->id) }}" class="text-indigo-600 hover:text-indigo-800 text-xs font-bold mr-3">Detail</a>
                                        
                                        @if($order->status == 'unpaid')
                                            <a href="{{ route('orders.pay', $order->id) }}"
                                                class="text-white bg-indigo-600 hover:bg-indigo-700 px-3 py-2 rounded-md text-xs font-bold shadow-sm transition">
                                                Bayar Sekarang
                                            </a>
                                        @elseif($order->status == 'paid')
                                            <span class="text-green-600 font-bold flex items-center justify-end gap-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                Selesai
                                            </span>
                                        @else
                                            <span class="text-gray-400">-</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-16">
                    <div class="mx-auto h-24 w-24 bg-indigo-50 rounded-full flex items-center justify-center mb-4">
                        <svg class="h-10 w-10 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900">Belum ada riwayat pembelian</h3>
                    <p class="mt-1 text-gray-500">Yuk, mulai cari komponen PC impianmu sekarang!</p>
                    <div class="mt-6">
                        <a href="{{ route('home') }}"
                            class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Mulai Belanja &rarr;
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection