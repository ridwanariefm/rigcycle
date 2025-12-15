@extends('layouts.frontend')

@section('title', 'Selesaikan Pembayaran')

{{-- PUSH SCRIPT MIDTRANS KE HEAD --}}
@push('scripts')
    <script type="text/javascript"
            src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="{{ config('midtrans.client_key') }}"></script>
@endpush

@section('content')
<div class="max-w-7xl mx-auto px-4 py-10 flex flex-col items-center justify-center min-h-[60vh]">
    
    <div class="max-w-md w-full space-y-8 bg-white p-10 rounded-xl shadow-lg border border-gray-100 text-center relative z-10">
        
        <div class="mx-auto flex items-center justify-center h-20 w-20 rounded-full bg-indigo-100 mb-6 animate-pulse">
            <svg class="h-10 w-10 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
        </div>

        <div>
            <h2 class="text-3xl font-extrabold text-gray-900">Pesanan Dibuat!</h2>
            <p class="mt-2 text-gray-500">Silakan selesaikan pembayaran Anda melalui Midtrans.</p>
        </div>
        
        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
            <div class="flex justify-between items-center mb-2">
                <span class="text-xs text-gray-500 uppercase font-bold tracking-wider">ID Order</span>
                <span class="font-mono text-gray-800 font-bold">{{ $order->order_number }}</span>
            </div>
            
            <div class="flex justify-between items-center border-t border-gray-200 pt-2 mt-2">
                <span class="text-xs text-gray-500 uppercase font-bold tracking-wider">Total Tagihan</span>
                <span class="text-xl font-extrabold text-indigo-600">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
            </div>
        </div>

        <div class="mt-4 text-left border-t border-gray-100 pt-4">
             <p class="text-xs text-gray-400 font-semibold mb-2">RINGKASAN ITEM:</p>
             <ul class="text-sm space-y-1 text-gray-600">
                 @foreach($order->items as $item)
                    <li class="flex justify-between">
                        <span class="truncate w-2/3">{{ $item->product->name }} (x{{ $item->quantity }})</span>
                        <span>Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</span>
                    </li>
                 @endforeach
             </ul>
        </div>

        <div class="mt-8 space-y-3">
            <button id="pay-button" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-base font-bold text-white bg-indigo-600 hover:bg-indigo-700 transition-all transform hover:scale-105 hover:shadow-lg focus:outline-none ring-2 ring-offset-2 ring-indigo-500">
                Bayar Sekarang 💳
            </button>
            
            <a href="{{ route('dashboard') }}" class="block text-sm text-gray-500 hover:text-indigo-600 font-medium">
                Kembali ke Dashboard
            </a>
        </div>
    </div>

</div>

<div id="result-modal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <div class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-sm sm:w-full sm:p-6">
            <div>
                <div id="icon-success" class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100 hidden">
                    <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <div id="icon-pending" class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-yellow-100 hidden">
                    <svg class="h-6 w-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div id="icon-error" class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 hidden">
                    <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </div>

                <div class="mt-3 text-center sm:mt-5">
                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Judul Pesan</h3>
                    <div class="mt-2">
                        <p class="text-sm text-gray-500" id="modal-message">Isi pesan detail akan muncul di sini.</p>
                    </div>
                </div>
            </div>
            <div class="mt-5 sm:mt-6">
                <button type="button" onclick="window.location.href='{{ route('dashboard') }}'" class="inline-flex justify-center w-full rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm">
                    OK, Mengerti
                </button>
            </div>
        </div>
    </div>
</div>

{{-- SCRIPT LOGIC PEMBAYARAN --}}
<script type="text/javascript">
    var payButton = document.getElementById('pay-button');
    
    // Elemen Modal
    var modal = document.getElementById('result-modal');
    var modalTitle = document.getElementById('modal-title');
    var modalMessage = document.getElementById('modal-message');
    var iconSuccess = document.getElementById('icon-success');
    var iconPending = document.getElementById('icon-pending');
    var iconError = document.getElementById('icon-error');

    function showModal(type, title, message) {
        // 1. Reset Icon (Sembunyikan semua)
        iconSuccess.classList.add('hidden');
        iconPending.classList.add('hidden');
        iconError.classList.add('hidden');

        // 2. Munculkan Icon sesuai Tipe
        if(type === 'success') iconSuccess.classList.remove('hidden');
        else if(type === 'pending' || type === 'warning') iconPending.classList.remove('hidden');
        else iconError.classList.remove('hidden');

        // 3. Set Text
        modalTitle.innerText = title;
        modalMessage.innerText = message;

        // 4. Munculkan Modal (Hapus class hidden)
        modal.classList.remove('hidden');
    }

    payButton.addEventListener('click', function () {
        window.snap.pay('{{ $snapToken }}', {
            onSuccess: function(result){
                showModal('success', 'Pembayaran Berhasil!', 'Terima kasih, pembayaran Anda telah kami terima. Barang akan segera diproses.');
            },
            onPending: function(result){
                showModal('pending', 'Menunggu Pembayaran', 'Silakan selesaikan pembayaran Anda sesuai instruksi.');
            },
            onError: function(result){
                showModal('error', 'Pembayaran Gagal', 'Maaf, terjadi kesalahan saat memproses pembayaran Anda.');
            },
            onClose: function(){
                showModal('warning', 'Pembayaran Belum Selesai', 'Anda menutup popup pembayaran sebelum menyelesaikan transaksi.');
            }
        })
    });
</script>
@endsection