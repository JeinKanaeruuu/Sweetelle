<?php

namespace App\Http\Controllers;

use App\Models\Product; // Pastikan model Product diimport
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class ProductController extends Controller
{
    // Menampilkan detail produk
    public function show($id)
    {
        $product = Product::findOrFail($id); // ambil produk berdasarkan ID
        return view('products.detail', compact('product'));
    }

    public function showLogs()
{
    $logs = Activity::where('subject_type', 'App\Models\Product')->get();
    return view('admin.activity_logs', compact('logs'));
}
    
public function showProducts(Request $request)
{
    $sortBy = $request->input('sort_by', 'asc'); // Default 'asc' jika tidak ada input
    
    // Mengambil produk dan mengurutkannya berdasarkan harga
    $products = Product::where('stock', '>', 0)
                       ->orderBy('price', $sortBy) // Mengurutkan berdasarkan harga
                       ->get();
    
    // Mengirim produk ke view
    return view('products.index', compact('products'));
}

public function showPortfolio()
{
    $products = Product::all(); // Ambil semua produk dari database
    return view('portfolio', compact('products'));
}


}
