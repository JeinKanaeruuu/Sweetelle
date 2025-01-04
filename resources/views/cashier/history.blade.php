<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Kasir</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f7fa;
            margin: 0;
            padding: 0;
        }

        .container {
            margin-top: 50px;
        }

        .card {
            border-radius: 12px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
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

        .table {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
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
            cursor: pointer;
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

        .table-responsive {
            margin-top: 30px;
        }

        .header {
            text-align: center;
            margin-bottom: 40px;
        }

        .header h2 {
            font-size: 2rem;
            color: #333;
            font-weight: 700;
        }

        .header p {
            font-size: 1.1rem;
            color: #666;
            font-weight: 400;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2>Riwayat Kasir</h2>
            <p>Berikut adalah riwayat transaksi yang telah dilakukan</p>
        </div>

        <!-- Form Filter Tanggal -->
        <form action="{{ route('cashier.history') }}" method="GET" class="mb-4">
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

        <!-- Menampilkan Pendapatan Harian, Bulanan, dan Tahunan -->
        <div class="row mb-4">
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Pendapatan Harian</h5>
                        <p class="card-text">Rp {{ number_format($dailyEarnings, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Pendapatan Bulanan</h5>
                        <p class="card-text">Rp {{ number_format($monthlyEarnings, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Pendapatan Tahunan</h5>
                        <p class="card-text">Rp {{ number_format($yearlyEarnings, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <a href="{{ route('cashier.index') }}" class="btn btn-primary-custom mb-4">Kembali ke Halaman Kasir</a>

        @if($history->isEmpty())
            <p class="text-center text-muted">Belum ada riwayat transaksi.</p>
        @else
            <div class="table-responsive">
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
                            <td>{{ $item->customer_name ?? 'Nama tidak tersedia' }}</td>
                            <td>{{ $item->product_name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>Rp {{ number_format($item->total_price, 0, ',', '.') }}</td>
                            <td>{{ $item->transaction_time->format('d-m-Y H:i') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</body>

</html>
