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
    
}
