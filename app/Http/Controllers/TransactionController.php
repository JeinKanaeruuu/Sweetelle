<?php

namespace App\Http\Controllers;

use App\Models\Transaction; // Pastikan model Transaction sudah ada
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $transactions = Transaction::with('items.product')
            ->where('user_id', $user->id)
            ->get()
            ->map(function ($transaction) {
                // Gabungkan nama produk terkait
                $transaction->product_names = $transaction->items->map(function ($item) {
                    return $item->product->name;
                })->join(', '); // Gabungkan nama produk dengan koma
                return $transaction;
            });
    
        return view('transactions.index', compact('transactions'));
    }
    
    
}
