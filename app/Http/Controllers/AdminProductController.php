<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminProductController extends Controller
{
    // 1. Halaman Daftar Produk
    public function index(Request $request)
    {
        // 1. Ambil Data Kategori (Untuk isi dropdown filter di View)
        $categories = Category::all();

        // 2. Mulai Query Dasar
        $query = Product::with('category', 'store')->latest();

        // 3. Logika SEARCH (Nama & Deskripsi)
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        // 4. Logika FILTER KATEGORI
        if ($request->has('category_id') && $request->category_id != '') {
            $query->where('category_id', $request->category_id);
        }

        // 5. Logika FILTER KONDISI
        if ($request->has('condition') && $request->condition != '') {
            $query->where('condition', $request->condition);
        }

        // 6. Eksekusi Pagination (Jangan lupa appends agar filter tidak hilang saat ganti halaman)
        $products = $query->paginate(10)->withQueryString();
        
        return view('admin.products.index', compact('products', 'categories'));
    }

    // 2. Halaman Form Tambah Produk
    public function create()
    {
        $categories = Category::all();
        $stores = Store::all();
        return view('admin.products.create', compact('categories', 'stores'));
    }

    // 3. Proses Simpan Data (Store)
    public function store(Request $request)
    {
        // A. Validasi Input (Sudah ditambah validasi Stock)
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer|min:0', // <--- TAMBAHAN VALIDASI STOK
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'category_id' => 'required',
            'store_id' => 'required',
            'condition' => 'required',
            'description' => 'required|string',
        ]);

        // B. Proses Upload Gambar
        $imagePath = $request->file('image')->store('products', 'public');

        // C. Simpan ke Database
        Product::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name) . '-' . time(),
            'price' => $request->price,
            'stock' => $request->stock, // <--- TAMBAHAN MENYIMPAN STOK
            'image' => $imagePath,
            'category_id' => $request->category_id,
            'store_id' => $request->store_id,
            'weight' => $request->weight ?? 1000,
            'condition' => $request->condition,
            'description' => $request->description, // Ambil dari input, jangan hardcode
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    // 4. Tampilkan Halaman Edit
    public function edit(Product $product)
    {
        $categories = Category::all();
        $stores = Store::all();
        return view('admin.products.edit', compact('product', 'categories', 'stores'));
    }

    // 5. Proses Update Data
    public function update(Request $request, Product $product)
    {
        // A. Validasi (Sudah ditambah validasi Stock)
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer|min:0', // <--- TAMBAHAN VALIDASI STOK
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
            'category_id' => 'required',
            'store_id' => 'required',
            'condition' => 'required',
            'description' => 'required|string',
        ]);

        // B. Siapkan Data Update
        $data = $request->except(['image']);
        $data['slug'] = Str::slug($request->name);

        // C. Cek Upload Gambar Baru
        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        // D. Lakukan Update
        $product->update($data); // Stock otomatis terupdate karena ada di $data

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui!');
    }

    // 6. Proses Hapus Data
    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus!');
    }
}