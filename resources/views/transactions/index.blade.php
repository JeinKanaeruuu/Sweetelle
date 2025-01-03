@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-extrabold text-center mb-6 text-gray-800 tracking-widest">Daftar Transaksi</h1>

    @if($transactions->isEmpty())
        <p class="text-center text-gray-500">Belum ada transaksi yang dilakukan.</p>
    @else
        <div class="overflow-hidden rounded-lg shadow-lg">
            <table class="min-w-full bg-white divide-y divide-gray-200">
                <thead style="background-color: #ffffff; color: #8b0330;">
                    <tr>
                        <th class="py-3 px-6 text-left text-xs font-bold uppercase tracking-wider">ID Transaksi</th>
                        <th class="py-3 px-6 text-left text-xs font-bold uppercase tracking-wider">Produk</th>
                        <th class="py-3 px-6 text-center text-xs font-bold uppercase tracking-wider">Jumlah</th>
                        <th class="py-3 px-6 text-right text-xs font-bold uppercase tracking-wider">Total Harga</th>
                        <th class="py-3 px-6 text-center text-xs font-bold uppercase tracking-wider">Status</th>
                        <th class="py-3 px-6 text-right text-xs font-bold uppercase tracking-wider">Tanggal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach ($transactions as $transaction)
                        <tr class="hover:bg-gray-50 transition ease-in-out duration-150">
                            <td class="border-l-4 border-indigo-500 px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="text-sm font-medium text-gray-900">{{ $transaction->id }}</div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-800 font-semibold">{{ $transaction->product_names }}</div>
                            </td>
                            <td class="text-center px-6 py-4">
                                <div class="text-sm text-gray-800">{{ $transaction->items->sum('quantity') }}</div>
                            </td>
                            <td class="text-right px-6 py-4">
                                <div class="text-sm text-green-600 font-bold">Rp {{ number_format($transaction->total, 2, ',', '.') }}</div>
                            </td>
                            <td class="text-center px-6 py-4">
                                @if($transaction->status == 'Diproses')
                                    <span class="px-3 py-1 inline-flex leading-5 font-semibold rounded-full bg-yellow-200 text-yellow-800">Diproses</span>
                                @elseif($transaction->status == 'Dikirim')
                                    <span class="px-3 py-1 inline-flex leading-5 font-semibold rounded-full bg-blue-200 text-blue-800">Dikirimkan</span>
                                @elseif($transaction->status == 'Dibatalkan')
                                    <span class="px-3 py-1 inline-flex leading-5 font-semibold rounded-full bg-red-200 text-red-800">Dibatalkan</span>
                                @else
                                    <span class="px-3 py-1 inline-flex leading-5 font-semibold rounded-full bg-green-200 text-green-800">Selesai</span>
                                @endif
                            </td>
                            <td class="text-right px-6 py-4 text-sm text-gray-500">
                                {{ $transaction->created_at->format('d M Y, H:i') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                
            </table>
        </div>
    @endif
</div>
@endsection
