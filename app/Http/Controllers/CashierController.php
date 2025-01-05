<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\CashierHistory; // Import model CashierHistory'
use Illuminate\Support\Facades\DB;
use Dompdf\Dompdf;
use Dompdf\Options;


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

        // Kirim data produk ke view
        return view('cashier.index', compact('products'));
    }

    public function checkout(Request $request)
    {
        $data = $request->validate([
            'cart' => 'required|array',
            'cart.*.id' => 'required|exists:products,id',
            'cart.*.quantity' => 'required|integer|min:1',
            'customer_name' => 'nullable|string|max:255',
        ]);

        // Proses checkout
        foreach ($data['cart'] as $item) {
            $product = Product::find($item['id']);
            if ($product->stock >= $item['quantity']) {
                // Mengurangi stok
                $product->stock -= $item['quantity'];
                $product->save();
            } else {
                return response()->json(['error' => 'Stok tidak cukup untuk produk ' . $product->name], 400);
            }
        }

        return response()->json(['success' => true]);
    }
    
    public function showHistory(Request $request)
    {
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');
    
        // Query riwayat kasir
        $query = CashierHistory::with('user')->orderBy('transaction_time', 'desc');
    
        if ($startDate) {
            $query->whereDate('transaction_time', '>=', $startDate);
        }
    
        if ($endDate) {
            $query->whereDate('transaction_time', '<=', $endDate);
        }
    
        $history = $query->get();
    
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

public function generatePDF(Request $request, $id)
{
    // Ambil data transaksi berdasarkan ID
    $history = CashierHistory::with('user')->find($id);
    
    // Pastikan data transaksi ditemukan
    if (!$history) {
        return redirect()->route('cashier.history')->with('error', 'Transaksi tidak ditemukan!');
    }

    // Siapkan data untuk invoice
    $data = [
        'invoice_number' => $history->id,  // ID transaksi sebagai nomor invoice
        'date' => $history->transaction_time->format('Y-m-d'),
        'customer_name' => $history->customer_name,
        'customer_contact' => $history->customer_contact ?? 'N/A',
        'items' => [],  // Kita akan mengisi data items berdasarkan nama produk
        'total' => $history->total_price,
    ];

    // Memecah nama produk yang dibeli dan menghitung quantity serta harga
    $productNames = explode(', ', $history->product_name);
    $quantities = explode(', ', $history->quantity);
    $prices = explode(', ', $history->price);

    foreach ($productNames as $index => $productName) {
        $data['items'][] = [
            'name' => $productName,
            'quantity' => $quantities[$index],
            'price' => $prices[$index],
        ];
    }

    // Configure Dompdf options
    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isRemoteEnabled', true);

    $dompdf = new Dompdf($options);

    // Render HTML view with the data
    $html = view('cashier.invoice', compact('data'))->render();

    // Load HTML into Dompdf
    $dompdf->loadHtml($html);

    // Set paper size and orientation
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    // Stream the generated PDF
    return $dompdf->stream("Invoice_" . $data['invoice_number'] . ".pdf", ["Attachment" => false]);
}

}