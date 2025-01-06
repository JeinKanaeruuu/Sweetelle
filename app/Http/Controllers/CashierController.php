<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\CashierHistory;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\PaymentMethod;


class CashierController extends Controller
{
    public function index(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('customer.login'); // Mengarahkan ke halaman login
        }

        // Ambil query pencarian dari parameter GET
        $search = $request->query('search');

        // Filter produk berdasarkan nama jika ada query pencarian
        $products = Product::when($search, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%');
        })->get();

        $paymentMethods = PaymentMethod::all(); // Ambil semua metode pembayaran

        // Kirim data produk ke view
        return view('cashier.index', compact('products', 'paymentMethods'));
    }

    public function checkout(Request $request)
    {
        $cart = $request->input('cart');
        $customerName = $request->input('customer_name');
        $paymentMethodId = $request->input('payment_method_id');
        $discount = $request->input('discount', 0); // Ambil diskon dari request
        
        if (!$cart || !is_array($cart)) {
            return response()->json(['error' => 'Keranjang kosong atau data tidak valid.'], 400);
        }
    
        $errors = [];
        $totalPrice = 0;
        $transactionTime = now();
        $transactionId = 'TX-' . strtoupper(uniqid());
    
        foreach ($cart as $item) {
            $product = Product::find($item['id']);
    
            if (!$product) {
                $errors[] = "Produk dengan ID {$item['id']} tidak ditemukan.";
                continue;
            }
    
            if ($product->stock < $item['quantity']) {
                $errors[] = "Stok untuk produk '{$product->name}' tidak mencukupi.";
                continue;
            }
    
            // Hitung harga produk total sebelum diskon
            $productTotalPrice = $product->price * $item['quantity'];
            
            // Hitung diskon (jika ada)
            $productTotalPriceWithDiscount = $productTotalPrice;
            if ($discount > 0) {
                $productTotalPriceWithDiscount -= $productTotalPrice * ($discount / 100);
            }
    
            $totalPrice += $productTotalPriceWithDiscount;
            $product->stock -= $item['quantity'];
            $product->save();
    
            // Simpan data transaksi tanpa menyimpan diskon
            CashierHistory::create([
                'user_id' => Auth::id(),
                'customer_name' => $customerName,
                'product_name' => $product->name,
                'quantity' => $item['quantity'],
                'total_price' => $productTotalPriceWithDiscount, // Harga setelah diskon
                'transaction_time' => $transactionTime,
                'transaction_id' => $transactionId,
                'payment_method_id' => $paymentMethodId,
                'discount' => $discount
            ]);
        }
    
        if (!empty($errors)) {
            return response()->json(['error' => implode('<br>', $errors)], 400);
        }
    
        return response()->json([
            'success' => "Transaksi berhasil! Total: Rp " . number_format($totalPrice, 0, ',', '.'),
            'transaction_id' => $transactionId
        ], 200);
    }
    
    

    public function showHistory(Request $request)
    {
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');
        
        // Query riwayat kasir
        $query = CashierHistory::with(['user', 'paymentMethod'])->orderBy('transaction_time', 'desc');
        
        if ($startDate) {
            $query->whereDate('transaction_time', '>=', $startDate);
        }
        
        if ($endDate) {
            $query->whereDate('transaction_time', '<=', $endDate);
        }
        
        // Ambil semua data transaksi
        $history = $query->get();
        
        // Kelompokkan transaksi berdasarkan transaction_id
        $groupedHistory = $history->groupBy('transaction_id')->map(function ($transactions) {
            $merged = [];
            $totalPrice = 0;
            $customerName = $transactions->first()->customer_name;
            $userName = $transactions->first()->user->name;
            $transactionTime = $transactions->first()->transaction_time;
            $paymentMethodName = $transactions->first()->paymentMethod->name ?? 'Unknown';
            $discount = $transactions->first()->discount ?? 0;
    
            // Gabungkan produk dan jumlah yang sama
            foreach ($transactions as $transaction) {
                $productName = $transaction->product_name;
                $quantity = $transaction->quantity;
    
                // Jika produk sudah ada dalam $merged, tambahkan quantity
                if (isset($merged[$productName])) {
                    $merged[$productName]['quantity'] += $quantity;
                } else {
                    $merged[$productName] = ['quantity' => $quantity, 'name' => $productName];
                }
    
                // Tambahkan total harga
                $totalPrice += $transaction->total_price;
            }
    
            // Gabungkan produk dan jumlahnya menjadi satu string
            $productDetails = [];
            foreach ($merged as $product) {
                $productDetails[] = "{$product['name']} {$product['quantity']}x";
            }
    
            return (object) [
                'transaction_id' => $transactions->first()->transaction_id,
                'user_name' => $userName,
                'customer_name' => $customerName,
                'payment_method' => $paymentMethodName, // Tambahkan metode pembayaran
                'product_details' => implode(', ', $productDetails),
                'total_price' => $totalPrice,
                'transaction_time' => $transactionTime,
                'discount' => $discount,
            ];
        });
    
        // Pendapatan
        $dailyEarnings = CashierHistory::whereDate('transaction_time', today())->sum('total_price');
        $monthlyEarnings = CashierHistory::whereMonth('transaction_time', now()->month)->sum('total_price');
        $yearlyEarnings = CashierHistory::whereYear('transaction_time', now()->year)->sum('total_price');
    
        // Produk terjual terbanyak
        $topProductDaily = CashierHistory::selectRaw('product_name, SUM(quantity) as total_quantity')
            ->whereDate('transaction_time', today())
            ->groupBy('product_name')
            ->orderByDesc('total_quantity')
            ->first();
    
        $topProductMonthly = CashierHistory::selectRaw('product_name, SUM(quantity) as total_quantity')
            ->whereMonth('transaction_time', now()->month)
            ->groupBy('product_name')
            ->orderByDesc('total_quantity')
            ->first();
    
        $topProductYearly = CashierHistory::selectRaw('product_name, SUM(quantity) as total_quantity')
            ->whereYear('transaction_time', now()->year)
            ->groupBy('product_name')
            ->orderByDesc('total_quantity')
            ->first();
    
        // Produk terjual terdikit harian
        $leastProductDaily = DB::table('products')
            ->leftJoin('cashier_histories', function ($join) {
                $join->on('products.name', '=', 'cashier_histories.product_name')
                    ->whereDate('cashier_histories.transaction_time', today());
            })
            ->select('products.name as product_name', DB::raw('COALESCE(SUM(cashier_histories.quantity), 0) as total_quantity'))
            ->groupBy('products.name')
            ->orderBy('total_quantity', 'asc')
            ->first();

        // Produk terjual terdikit bulanan
        $leastProductMonthly = DB::table('products')
            ->leftJoin('cashier_histories', function ($join) {
                $join->on('products.name', '=', 'cashier_histories.product_name')
                    ->whereMonth('cashier_histories.transaction_time', now()->month);
            })
            ->select('products.name as product_name', DB::raw('COALESCE(SUM(cashier_histories.quantity), 0) as total_quantity'))
            ->groupBy('products.name')
            ->orderBy('total_quantity', 'asc')
            ->first();

        // Produk terjual terdikit tahunan
        $leastProductYearly = DB::table('products')
            ->leftJoin('cashier_histories', function ($join) {
                $join->on('products.name', '=', 'cashier_histories.product_name')
                    ->whereYear('cashier_histories.transaction_time', now()->year);
            })
            ->select('products.name as product_name', DB::raw('COALESCE(SUM(cashier_histories.quantity), 0) as total_quantity'))
            ->groupBy('products.name')
            ->orderBy('total_quantity', 'asc')
            ->first();

        // Kirim data ke view
        return view('cashier.history', compact(
            'groupedHistory',
            'history',
            'dailyEarnings',
            'monthlyEarnings',
            'yearlyEarnings',
            'topProductDaily',
            'topProductMonthly',
            'topProductYearly',
            'leastProductDaily',
            'leastProductMonthly',
            'leastProductYearly'
        ));
    }


    
    
    public function getEarnings(Request $request)
    {
        // Pendapatan Harian
        $dailyEarnings = CashierHistory::whereDate('transaction_time', today())->sum('total_price');

        // Pendapatan Bulanan
        $monthlyEarnings = CashierHistory::whereMonth('transaction_time', now()->month)->sum('total_price');

        // Pendapatan Tahunan
        $yearlyEarnings = CashierHistory::whereYear('transaction_time', now()->year)->sum('total_price');

        // Kirim data pendapatan ke view
        return view('cashier.index', compact('dailyEarnings', 'monthlyEarnings', 'yearlyEarnings'));
    }

public function downloadInvoice($transactionId)
{
    // Ambil riwayat kasir berdasarkan transaction_id
    $history = CashierHistory::where('transaction_id', $transactionId)->get();
    $history = CashierHistory::with('paymentMethod')->where('transaction_id', $transactionId)->get();


    // Jika data tidak ditemukan
    if ($history->isEmpty()) {
        return redirect()->route('cashier.history')->with('error', 'Transaksi tidak ditemukan!');
    }

    // Generasi PDF menggunakan data yang ada
    $pdf = PDF::loadView('cashier.invoice', compact('history'));

    // Return response untuk langsung download file
    return $pdf->stream('invoice-' . $transactionId . '.pdf');
}

public function getPaymentMethods()
{
    $paymentMethods = \App\Models\PaymentMethod::all();
    return response()->json($paymentMethods);
}



}
