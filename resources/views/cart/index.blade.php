@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-4xl font-bold text-center mb-8 text-gray-800">Keranjang Belanja</h1>

    @if(session('success'))
        <div class="bg-green-50 text-green-600 p-4 rounded-md shadow-md mb-6">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-50 text-red-600 p-4 rounded-md shadow-md mb-6">
            {{ session('error') }}
        </div>
    @endif

    @if($carts->isEmpty())
        <p class="text-center text-lg text-gray-500">Keranjang Anda kosong.</p>
    @else
        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="min-w-full text-sm text-gray-700">
                <thead>
                    <tr class="border-b bg-gray-200 text-left">
                        <th class="py-4 px-6">Produk</th>
                        <th class="py-4 px-6">Harga</th>
                        <th class="py-4 px-6">Jumlah</th>
                        <th class="py-4 px-6">Total</th>
                        <th class="py-4 px-6">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $grandTotal = 0; @endphp
                    @foreach($carts as $cart)
                        @php
                            $total = $cart->product->price * $cart->quantity;
                            $grandTotal += $total;
                        @endphp
                        <tr class="border-b hover:bg-gray-50 transition duration-150">
                            <td class="py-4 px-6 flex items-center">
                                @if($cart->product->image)
                                    <img src="{{ asset('storage/' . $cart->product->image) }}" alt="{{ $cart->product->name }}" class="w-16 h-16 object-cover rounded mr-4 shadow">
                                @else
                                    <img src="{{ asset('images/default.png') }}" alt="Default Image" class="w-16 h-16 object-cover rounded mr-4 shadow">
                                @endif
                                <span class="text-lg font-semibold">{{ $cart->product->name }}</span>
                            </td>
                            <td class="py-4 px-6">Rp {{ number_format($cart->product->price, 2, ',', '.') }}</td>
                            <td class="py-4 px-6">
                                <form action="{{ route('cart.update', $cart->id) }}" method="POST" class="flex items-center">
                                    @csrf
                                    @method('PUT')
                                    <input type="number" name="quantity" value="{{ $cart->quantity }}" min="1" class="w-14 py-1 px-2 border rounded-md focus:ring focus:ring-gray-200">
                                    <button type="submit" class="ml-2 text-blue-600 hover:underline">Update</button>
                                </form>
                            </td>
                            <td class="py-4 px-6">Rp {{ number_format($total, 2, ',', '.') }}</td>
                            <td class="py-4 px-6">
                                <form action="{{ route('cart.remove', $cart->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    <tr class="border-t">
                        <td colspan="3" class="py-4 px-6 text-right font-semibold">Total Keseluruhan:</td>
                        <td class="py-4 px-6 font-semibold">Rp {{ number_format($grandTotal, 2, ',', '.') }}</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="mt-8 text-center">
            <a href="{{ route('checkout') }}" class="inline-block bg-orange-500 text-white px-8 py-3 rounded-lg hover:bg-orange-600 transition duration-300">Lanjutkan ke Pembayaran</a>
        </div>
    @endif
</div>
@endsection
