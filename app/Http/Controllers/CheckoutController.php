<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Midtrans\Config;
use Midtrans\Snap;

class CheckoutController extends Controller
{
    public function index()
    {
        $carts = Cart::with('product')->where('user_id', Auth::id())->get();

        if ($carts->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang Anda kosong.');
        }
        
        // Di sini Anda mungkin juga perlu me-load data provinsi/kota jika menggunakan RajaOngkir
        return view('checkout.index', compact('carts'));
    }

    public function store(Request $request)
    {
        // A. VALIDASI DATA BARU (MEMASTIKAN SEMUA KOLOM BARU ADA)
        $request->validate([
            // Data Alamat Lengkap
            'user_name' => 'required|string|max:255',
            'user_phone' => 'required|string|max:15',
            'shipping_address' => 'required|string|max:500', // Ini adalah kolom 'address' yang lebih spesifik
            'province' => 'required|string',
            'city' => 'required|string',
            'zip_code' => 'required|string|max:10',

            // Data Biaya & Kurir
            'courier' => 'required|string|max:50',
            'shipping_cost' => 'required|numeric|min:0',
            'subtotal' => 'required|numeric|min:0', // Subtotal produk sebelum ongkir
            'total_price' => 'required|numeric|min:0', // Total akhir (Subtotal + Ongkir)
            'payment_method' => 'required|string', // Midtrans, COD, dll.
        ]);
        
        // Cek Total Harga untuk Keamanan (Opsional tapi disarankan)
        $carts = Cart::where('user_id', Auth::id())->get();
        $calculatedSubtotal = $carts->sum(fn($cart) => $cart->product->price * $cart->quantity);

        if ($calculatedSubtotal != $request->subtotal) {
             return back()->withInput()->with('error', 'Kesalahan perhitungan subtotal. Silakan refresh halaman.');
        }
        // Catatan: Jika total_price sudah dihitung di frontend (subtotal + ongkir), validasi ini cukup.

        // 1. Simpan Data Order ke Database
        $order = DB::transaction(function () use ($request, $carts) {
            $user = Auth::user();
            
            // Generate Nomor Order Unik
            $orderNumber = 'ORD-' . strtoupper(Str::random(10));

            // Membuat Order Utama
            $order = Order::create([
                'user_id' => $user->id,
                'order_number' => $orderNumber,
                
                // --- DATA HARGA & BIAYA BARU ---
                'subtotal' => $request->subtotal,
                'shipping_cost' => $request->shipping_cost,
                'total_price' => $request->total_price,
                
                // --- DATA ALAMAT & PENGIRIMAN BARU ---
                'user_name' => $request->user_name,
                'user_phone' => $request->user_phone,
                'address' => $request->shipping_address, // Simpan alamat lengkap ke kolom 'address'
                'shipping_address' => $request->shipping_address, // Jika Anda ingin memisahkan kolom 'address' lama (opsional)
                'province' => $request->province,
                'city' => $request->city,
                'zip_code' => $request->zip_code,
                'courier' => $request->courier,

                // --- DATA STATUS & PEMBAYARAN ---
                'status' => 'unpaid',
                'payment_method' => $request->payment_method,
            ]);

            // Pindahkan Cart ke Order Items
            foreach ($carts as $cart) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cart->product_id,
                    'quantity' => $cart->quantity, 
                    'price' => $cart->product->price, // Harga satuan
                ]);
            }

            // Hapus Keranjang setelah berhasil pindah
            Cart::where('user_id', $user->id)->delete();
            
            return $order;
        });

        // 2. KONFIGURASI MIDTRANS
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');

        // 3. Buat Parameter Transaksi Midtrans
        // JANGAN LUPA memasukkan item_details agar Midtrans tahu rincian belanja
        $itemDetails = $order->items->map(function ($item) {
            return [
                'id' => $item->product_id,
                'price' => $item->price, // Harga satuan dari OrderItem
                'quantity' => $item->quantity,
                'name' => $item->product->name,
            ];
        })->values()->all();

        // Tambahkan biaya pengiriman sebagai item terpisah (disarankan)
        $itemDetails[] = [
            'id' => 'SHIPPING',
            'price' => $order->shipping_cost,
            'quantity' => 1,
            'name' => 'Biaya Pengiriman',
        ];

        $params = [
            'transaction_details' => [
                'order_id' => $order->order_number, 
                'gross_amount' => $order->total_price, // Total Harga Akhir
            ],
            'customer_details' => [
                'first_name' => $order->user_name, // Gunakan nama penerima di order
                'email' => Auth::user()->email,
                'phone' => $order->user_phone, // Nomor HP penerima
            ],
            'item_details' => $itemDetails, // Detail Item & Biaya Kirim
        ];
        
        // 4. Minta Snap Token
        $snapToken = Snap::getSnapToken($params);

        return view('checkout.payment', compact('snapToken', 'order'));
    }
}