<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil Kategori (Untuk Dropdown Filter)
        $categories = Category::all();

        // 2. Query Produk (Load kategori agar hemat query)
        $query = Product::with('category')->latest();

        // 3. Logika SEARCH
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

        // 6. Pagination (12 produk per halaman agar rapi di Grid 3 atau 4 kolom)
        $products = $query->paginate(12)->withQueryString();

        return view('home', compact('products', 'categories'));
    }
}