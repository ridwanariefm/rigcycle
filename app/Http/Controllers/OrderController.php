<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Snap; // Untuk method pay()
use Exception; // Untuk menangani error dari Midtrans

class OrderController extends Controller
{
    /**
     * Menampilkan halaman detail pesanan (orders.show).
     */
    public function show(Order $order)
    {
        // 1. KEAMANAN: Pastikan yang melihat adalah pemilik pesanan
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Akses ditolak.');
        }

        // 2. Load relasi (items dan product) agar bisa tampil di View
        $order->load('items.product');

        // 3. Tampilkan View detail
        // Asumsi view ada di 'orders.show'
        return view('orders.show', compact('order'));
    }

    /**
     * Memproses pembayaran Midtrans (orders.pay).
     */
    public function pay(Order $order)
    {
        // 1. KEAMANAN: Pastikan yang mau bayar adalah pemilik order
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // 2. Jika status sudah lunas, jangan biarkan bayar lagi
        if ($order->status == 'paid') {
            return redirect()->route('dashboard')->with('success', 'Order ini sudah lunas.');
        }

        // 3. KONFIGURASI MIDTRANS
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');

        // 4. BUAT SNAP TOKEN BARU
        $params = [
            'transaction_details' => [
                'order_id' => $order->order_number, // Gunakan No. Order yang sama
                'gross_amount' => $order->total_price,
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
            ],
            // Pastikan Anda juga memasukkan daftar item di sini untuk Midtrans!
            'item_details' => $order->items->map(function ($item) {
                return [
                    'id' => $item->product_id,
                    'price' => $item->product->price,
                    'quantity' => $item->quantity,
                    'name' => $item->product->name,
                ];
            })->values()->all(),
            // Tambahkan biaya kirim jika ada di tabel order
            // Note: Cek apakah Midtrans memperbolehkan total harga yang sudah termasuk ongkir tanpa item_details ongkir
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
            
            // 5. Tampilkan View Pembayaran
            return view('checkout.payment', compact('snapToken', 'order'));

        } catch (Exception $e) {
            // Gunakan Exception yang sudah di-import
            return back()->with('error', 'Terjadi kesalahan saat memproses pembayaran: ' . $e->getMessage());
        }
    }
}