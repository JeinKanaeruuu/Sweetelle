<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::where('user_id', Auth::id())->with('product')->get();
        return view('cart.index', compact('carts'));
    }

    public function add(Request $request, $productId)
{
    // Validasi input quantity
    $request->validate([
        'quantity' => 'required|integer|min:1',
    ]);

    $product = Product::findOrFail($productId);

    // Cek apakah jumlah yang diminta melebihi stok yang tersedia
    $quantity = $request->input('quantity');
    if ($quantity > $product->stock) {
        return redirect()->back()->with('error', 'Maaf, stok produk hanya tersedia ' . $product->stock . ' item.');
    }

    // Cek apakah produk sudah ada di keranjang
    $cart = Cart::firstOrCreate(
        ['user_id' => Auth::id(), 'product_id' => $productId],
        ['quantity' => $quantity] // Simpan quantity dari input
    );

    // Jika produk sudah ada, tambahkan quantity
    if (!$cart->wasRecentlyCreated) {
        // Periksa apakah total quantity yang akan ditambahkan tidak melebihi stok
        if ($cart->quantity + $quantity > $product->stock) {
            return redirect()->back()->with('error', 'Maaf, stok produk hanya tersedia ' . $product->stock . ' item.');
        }
        $cart->quantity += $quantity; // Tambahkan quantity dari input
        $cart->save();
    }

    return redirect()->back()->with('success', 'Produk ditambahkan ke keranjang.');
}

    

    public function update(Request $request, $cartId)
    {
        $cart = Cart::where('user_id', Auth::id())->findOrFail($cartId);
        $quantity = $request->input('quantity');

        if ($quantity < 1) {
            $cart->delete();
            return redirect()->back()->with('success', 'Produk dihapus dari keranjang.');
        }

        $product = $cart->product;
        if ($product->stock < $quantity) {
            return redirect()->back()->with('error', 'Stok produk tidak mencukupi.');
        }

        $cart->quantity = $quantity;
        $cart->save();

        return redirect()->back()->with('success', 'Keranjang diperbarui.');
    }

    public function remove($cartId)
    {
        $cart = Cart::where('user_id', Auth::id())->findOrFail($cartId);
        $cart->delete();

        return redirect()->back()->with('success', 'Produk dihapus dari keranjang.');
    }
}
