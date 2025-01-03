<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Kasir</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Riwayat Kasir</h2>

        <!-- Menampilkan Pendapatan Harian, Bulanan, dan Tahunan -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Pendapatan Harian</h5>
                        <p class="card-text">Rp {{ number_format($dailyEarnings, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Pendapatan Bulanan</h5>
                        <p class="card-text">Rp {{ number_format($monthlyEarnings, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Pendapatan Tahunan</h5>
                        <p class="card-text">Rp {{ number_format($yearlyEarnings, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <a href="{{ route('cashier.index') }}" class="btn btn-primary mb-3">
            Kembali ke Halaman Kasir
        </a>

        @if($history->isEmpty())
            <p>Belum ada riwayat transaksi.</p>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kasir</th>
                        <th>Nama Customer</th> 
                        <th>Produk</th>
                        <th>Jumlah</th>
                        <th>Total Harga</th>
                        <th>Waktu Transaksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($history as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->user->name }}</td>
                            <td>{{ $item->customer_name ?? 'Nama tidak tersedia' }}</td>  <!-- Menampilkan nama customer jika ada -->
                            <td>{{ $item->product_name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>Rp {{ number_format($item->total_price, 0, ',', '.') }}</td>
                            <td>{{ $item->transaction_time->format('d-m-Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</body>
</html>
