<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan Rinci</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f7fa;
        }

        .container {
            margin-top: 50px;
        }

        .card {
            border-radius: 12px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            padding: 30px;
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 15px;
        }

        .card-text {
            font-size: 1.2rem;
            color: #007bff;
            font-weight: bold;
        }

        .table th, .table td {
            text-align: center;
            padding: 20px;
            font-size: 1.1rem;
            vertical-align: middle;
        }

        .table thead {
            background-color: #007bff;
            color: white;
        }

        .table tbody tr:hover {
            background-color: #f1f1f1;
        }

        .form-label {
            font-weight: 500;
            color: #333;
        }

        .btn-primary-custom {
            background-color: #5e72e4;
            border: none;
            padding: 10px 20px;
            font-size: 1rem;
            border-radius: 5px;
            color: white;
            font-weight: 600;
        }

        .btn-primary-custom:hover {
            background-color: #4c63d2;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="text-center mb-4">Laporan Penjualan Rinci</h2>

        <!-- Form Filter Tanggal -->
        <form action="{{ route('cashier.sales_report') }}" method="GET" class="mb-4">
            <div class="row">
                <div class="col-md-4">
                    <label for="start_date" class="form-label">Tanggal Mulai</label>
                    <input type="date" id="start_date" name="start_date" class="form-control"
                        value="{{ request('start_date') }}">
                </div>
                <div class="col-md-4">
                    <label for="end_date" class="form-label">Tanggal Akhir</label>
                    <input type="date" id="end_date" name="end_date" class="form-control"
                        value="{{ request('end_date') }}">
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary-custom w-100">Filter</button>
                </div>
            </div>
        </form>

        <!-- Menampilkan Total Pendapatan, Jumlah Transaksi, dan Rata-rata -->
        <div class="row mb-4">
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Pendapatan</h5>
                        <p class="card-text">Rp {{ number_format($totalEarnings, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Jumlah Transaksi</h5>
                        <p class="card-text">{{ $totalTransactions }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Rata-rata Pendapatan</h5>
                        <p class="card-text">Rp {{ number_format($averageEarnings, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
        </div>
        <a href="{{ route('cashier.history') }}" class="btn btn-primary-custom mb-4">Kembali ke Riwayat Kasir</a>
        <!-- Ringkasan Penjualan -->
        <h4>Ringkasan Penjualan</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Jumlah Terjual</th>
                    <th>Total Pendapatan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($salesSummary as $item)
                    <tr>
                        <td>{{ $item->product_name }}</td>
                        <td>{{ $item->total_quantity }}</td>
                        <td>Rp {{ number_format($item->total_quantity * $item->price, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
