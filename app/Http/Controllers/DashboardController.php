<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request; // Tidak terpakai, bisa dihapus
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; // Gunakan Facade Log untuk logging error
use Midtrans\Config;
use Midtrans\Transaction;
use Exception;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // 1. Ambil semua Order milik user yang masih 'unpaid'
        $unpaidOrders = Order::where('user_id', $user->id)
                             ->where('status', 'unpaid')
                             // Hanya butuh ID dan order_number untuk dicek
                             ->get(['id', 'order_number', 'status']); 

        // 2. Konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');

        // 3. Loop dan Cek Status ke Midtrans
        foreach ($unpaidOrders as $order) {
            try {
                /**
                 * Memberi tahu Intelephense bahwa $status adalah Objek Standar (stdClass)
                 * yang dikembalikan oleh Midtrans API.
                 * @var \stdClass $status
                 */
                $status = Transaction::status($order->order_number);

                $newStatus = null;
                $transactionStatus = $status->transaction_status;
                
                // Logika Update Status
                if ($transactionStatus == 'settlement' || $transactionStatus == 'capture') {
                    $newStatus = 'paid';
                } 
                else if ($transactionStatus == 'expire') {
                    $newStatus = 'expired';
                }
                else if ($transactionStatus == 'cancel' || $transactionStatus == 'deny' || $transactionStatus == 'failure') {
                    $newStatus = 'cancelled';
                }

                // Update hanya jika status baru berbeda
                if ($newStatus && $order->status !== $newStatus) {
                    $order->update(['status' => $newStatus]);
                    Log::info("Order [{$order->order_number}] status updated to: {$newStatus}");
                }

            } catch (Exception $e) {
                // Log error Midtrans API call tanpa menghentikan loop
                Log::error("Midtrans status check failed for order [{$order->order_number}]: " . $e->getMessage());
                continue;
            }
        }

        // 4. Ambil Data Terbaru (semua status) untuk ditampilkan di Dashboard
        $orders = Order::where('user_id', $user->id)
                       ->with('items.product') // EAGER LOAD UTAMA UNTUK VIEW
                       ->latest()
                       ->get();

        return view('dashboard', compact('orders'));
    }
}