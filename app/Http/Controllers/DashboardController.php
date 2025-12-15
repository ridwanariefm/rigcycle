<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Transaction;
use Exception; // Import Exception untuk penanganan error yang lebih baik

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // 1. Ambil Order yang statusnya masih 'unpaid', DENGAN relasi items.product untuk menghindari N+1 problem
        $unpaidOrders = Order::where('user_id', $user->id)
                             ->where('status', 'unpaid')
                             ->with('items.product') // <--- EAGER LOAD BARANG YANG DIBELI
                             ->get();

        // 2. Konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');

        // 3. Loop dan Cek Status ke Midtrans
        foreach ($unpaidOrders as $order) {
            try {
                // Minta status ke Midtrans berdasarkan Order ID
                $status = Transaction::status($order->order_number);

                // Logika Update Status
                $newStatus = null;
                if ($status->transaction_status == 'settlement' || $status->transaction_status == 'capture') {
                    $newStatus = 'paid';
                } 
                else if ($status->transaction_status == 'expire') {
                    $newStatus = 'expired';
                }
                else if ($status->transaction_status == 'cancel' || $status->transaction_status == 'deny') {
                    $newStatus = 'cancelled';
                }

                if ($newStatus && $order->status !== $newStatus) {
                    $order->update(['status' => $newStatus]);
                }

            } catch (Exception $e) {
                // Gunakan class Exception yang sudah di-import
                continue;
            }
        }

        // 4. Ambil Data Terbaru (yang mungkin barusan di-update) untuk ditampilkan
        // Pastikan eager load juga di sini
        $orders = Order::where('user_id', $user->id)
                       ->with('items.product') // <--- EAGER LOAD UTAMA UNTUK VIEW
                       ->latest()
                       ->get();

        return view('dashboard', compact('orders'));
    }
}