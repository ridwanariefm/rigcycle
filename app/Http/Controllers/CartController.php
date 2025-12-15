<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // 1. Menampilkan Isi Keranjang
    public function index()
    {
        // Ambil keranjang milik user yang sedang login
        $carts = Cart::with('product')->where('user_id', Auth::id())->get();
        
        return view('cart.index', compact('carts'));
    }

    // 2. Proses Tambah ke Keranjang
    public function store(Request $request)
    {
        // Pastikan User Login Dulu
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login untuk belanja.');
        }

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        // Cek apakah produk ini sudah ada di keranjang user?
        $existingCart = Cart::where('user_id', Auth::id())
                            ->where('product_id', $request->product_id)
                            ->first();

        if ($existingCart) {
            // Jika sudah ada, cukup tambahkan jumlahnya
            $existingCart->increment('quantity', $request->quantity);
        } else {
            // Jika belum ada, buat baris baru
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
                'quantity' => $request->quantity
            ]);
        }

        return redirect()->back()->with('success', 'Produk berhasil masuk keranjang!');
    }

    // Ganti parameternya dari $cartId menjadi Cart $cart
    public function update(Request $request, $cartId)
    {
        // 1. Cari Item Cart Manual (Pastikan milik user yang login)
        $cart = \App\Models\Cart::where('user_id', Auth::id())
                                ->where('id', $cartId)
                                ->firstOrFail();

        // 2. Validasi Input
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        // 3. Debugging: Pastikan input masuk (Boleh dihapus nanti)
        // dd($request->quantity); 

        // 4. Cek Stok Produk
        if ($request->quantity > $cart->product->stock) {
            return back()->with('error', 'Stok tidak cukup! Sisa: ' . $cart->product->stock);
        }

        // 5. UPDATE MANUAL (SOLUSI INTI)
        // Kita tidak pakai $cart->update([]), tapi kita set manual.
        // Cara ini mengabaikan masalah di $fillable.
        $cart->quantity = $request->quantity;
        
        // Simpan perubahan
        $cart->save(); 

        return back()->with('success', 'Jumlah barang berhasil diubah.');
    }

    // 3. Hapus Item dari Keranjang
    public function destroy(Cart $cart)
    {
        // Pastikan yang menghapus adalah pemilik keranjang
        if ($cart->user_id !== Auth::id()) {
            abort(403);
        }

        $cart->delete();

        return redirect()->back()->with('success', 'Item dihapus dari keranjang.');
    }
}