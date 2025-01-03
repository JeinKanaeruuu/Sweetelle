<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CheckoutController extends Controller
{
    public function showCheckoutForm()
    {
        $carts = Cart::where('user_id', Auth::id())->with('product')->get();
        if ($carts->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang belanja Anda kosong.');
        }

        $total = $carts->sum(function($cart) {
            return $cart->product->price * $cart->quantity;
        });

        return view('checkout.index', compact('carts', 'total'));
    }

    public function processCheckout(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|in:QRIS,Transfer Bank',
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'phone' => 'required|numeric|digits_between:10,15',
        ]);

        $carts = Cart::where('user_id', Auth::id())->with('product')->get();
        if ($carts->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang belanja Anda kosong.');
        }

        $total = $carts->sum(function($cart) {
            return $cart->product->price * $cart->quantity;
        });

        // Upload bukti pembayaran
        if ($request->hasFile('payment_proof')) {
            $paymentProofPath = $request->file('payment_proof')->store('payment_proofs', 'public');
        }

        // Buat transaksi
        $transaction = Transaction::create([
            'user_id' => Auth::id(),
            'total' => $total,
            'payment_method' => $request->payment_method,
            'payment_proof' => $paymentProofPath,
            'shipping_address' => $request->shipping_address, // Simpan alamat pengiriman
            'phone' => $request->phone, // Simpan nomor handphone
            'status' => 'Diproses',
        ]);

        // Buat item transaksi dan kurangi stok produk
        foreach ($carts as $cart) {
            TransactionItem::create([
                'transaction_id' => $transaction->id,
                'product_id' => $cart->product_id,
                'quantity' => $cart->quantity,
                'price' => $cart->product->price,
            ]);

            // Kurangi stok produk
            $cart->product->decrement('stock', $cart->quantity);
        }

        // Kosongkan keranjang
        Cart::where('user_id', Auth::id())->delete();

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil diproses.');
    }
}
