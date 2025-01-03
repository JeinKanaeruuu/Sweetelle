<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Testimonial;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $sortBy = $request->input('sort_by', 'asc'); // Default 'asc' jika tidak ada input
    
        // Mengambil produk dan mengurutkannya berdasarkan harga
        $products = Product::where('stock', '>', 0)
                           ->orderBy('price', $sortBy) // Mengurutkan berdasarkan harga
                           ->get();
        $testimonials = Testimonial::all();  // Ambil semua testimonial


        return view('home', compact('products',  'testimonials'));
    }
}

