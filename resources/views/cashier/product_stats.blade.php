@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Statistik Produk Terjual</h1>

    <!-- Filter Periode -->
    <form method="GET" action="{{ route('cashier.product-stats') }}">
        <div class="form-group">
            <label for="period">Pilih Periode</label>
            <select name="period" id="period" class="form-control">
                <option value="daily" {{ request('period') === 'daily' ? 'selected' : '' }}>Harian</option>
                <option value="monthly" {{ request('period') === 'monthly' ? 'selected' : '' }}>Bulanan</option>
                <option value="yearly" {{ request('period') === 'yearly' ? 'selected' : '' }}>Tahunan</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Tampilkan</button>
    </form>

    <hr>

    <!-- Produk Terjual Terbanyak -->
    <h3>Produk Terjual Terbanyak ({{ ucfirst($period) }})</h3>
    @if ($mostSoldProduct)
        <p><strong>Nama Produk:</strong> {{ $mostSoldProduct->product_name }}</p>
        <p><strong>Total Terjual:</strong> {{ $mostSoldProduct->total_sold }} unit</p>
    @else
        <p>Tidak ada data.</p>
    @endif

    <!-- Produk Terjual Terdikit -->
    <h3>Produk Terjual Terdikit ({{ ucfirst($period) }})</h3>
    @if ($leastSoldProduct)
        <p><strong>Nama Produk:</strong> {{ $leastSoldProduct->product_name }}</p>
        <p><strong>Total Terjual:</strong> {{ $leastSoldProduct->total_sold }} unit</p>
    @else
        <p>Tidak ada data.</p>
    @endif
</div>
@endsection
