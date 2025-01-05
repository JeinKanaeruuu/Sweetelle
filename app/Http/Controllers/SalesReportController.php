<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalesReportController extends Controller
{
    public function showDetailedSalesReport(Request $request)
    {
        // Menangani filter tanggal
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
    
        // Jika tidak ada filter, ambil data semua transaksi
        $query = DB::table('cashier_histories')
            ->join('products', 'cashier_histories.product_name', '=', 'products.name')
            ->select('products.name as product_name', 'products.price', DB::raw('SUM(cashier_histories.quantity) as total_quantity'))
            ->groupBy('products.name', 'products.price'); // Tambahkan group by harga
    
        if ($startDate && $endDate) {
            // Jika ada filter, ambil data berdasarkan tanggal
            $query->whereBetween('cashier_histories.transaction_time', [$startDate, $endDate]);
        }
    
        // Ambil ringkasan penjualan produk yang terjual beserta jumlah dan harga
        $salesSummary = $query->get();
    
        // Ambil total pendapatan dan jumlah transaksi
        $totalEarnings = $salesSummary->sum(function ($item) {
            return $item->price * $item->total_quantity;
        });
    
        $totalTransactions = DB::table('cashier_histories')
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                return $query->whereBetween('transaction_time', [$startDate, $endDate]);
            })
            ->count();
    
        $averageEarnings = $totalTransactions > 0 ? $totalEarnings / $totalTransactions : 0;
    
        // Kirim data ke view
        return view('cashier.sales_report', compact(
            'totalEarnings', 
            'totalTransactions', 
            'averageEarnings', 
            'salesSummary'
        ));
    }
    

    public function showSalesReportByCategory(Request $request)
    {
        // Menangani filter tanggal
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
    
        // Query untuk mengambil penjualan berdasarkan kategori dan menghitung total pendapatan per kategori
        $query = DB::table('cashier_histories')
            ->join('products', 'cashier_histories.product_name', '=', 'products.name')
            ->select(
                'products.category',
                DB::raw('SUM(cashier_histories.quantity) as total_quantity'),
                DB::raw('SUM(cashier_histories.quantity * products.price) as total_revenue')  // Total pendapatan per kategori
            )
            ->groupBy('products.category');
    
        // Jika ada filter tanggal
        if ($startDate && $endDate) {
            $query->whereBetween('cashier_histories.transaction_time', [$startDate, $endDate]);
        }
    
        // Ambil data penjualan per kategori
        $salesSummaryPerCategory = $query->get();
    
        // Kirim data ke view
        return view('cashier.sales_report_category', compact('salesSummaryPerCategory'));
    }
    
    
}
