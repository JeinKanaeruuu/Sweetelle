<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - {{ $history[0]->transaction_id }}</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            max-width: 800px;
            margin: 40px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .header img {
            max-width: 120px;
            margin-bottom: 10px;
        }

        .header h1 {
            font-size: 28px;
            margin: 0;
            color: #333;
        }

        .header p {
            font-size: 14px;
            color: #555;
        }

        .invoice-details {
            margin-bottom: 20px;
        }

        .invoice-details p {
            margin: 5px 0;
            font-size: 16px;
        }

        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .invoice-table th, .invoice-table td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        .invoice-table th {
            background-color: #f5f5f5;
            color: #333;
            text-transform: uppercase;
        }

        .invoice-table tr:nth-child(odd) {
            background-color: #f9f9f9;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 12px;
            color: #777;
        }

        .footer p {
            margin: 5px 0;
        }

        .footer .note {
            font-style: italic;
            font-size: 13px;
        }

        .summary {
            margin-top: 20px;
            text-align: right;
            font-size: 16px;
        }

        .summary p {
            margin: 5px 0;
        }

        .total-payment {
            font-size: 20px;
            font-weight: bold;
            color: #333;
            margin-top: 20px;
            text-align: right;
        }

        .highlight {
            font-size: 18px;
            font-weight: bold;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header Section -->
        <div class="header">
            <img src="logo_url.png" alt="Logo"> <!-- Ganti dengan URL logo -->
            <h1>INVOICE</h1>
            <p>Toko Elektronik XYZ</p>
        </div>

        <!-- Invoice Details Section -->
        <div class="invoice-details">
            <p><strong>Nomor Invoice:</strong> {{ $history[0]->transaction_id }}</p>
            <p><strong>Customer:</strong> {{ $history[0]->customer_name ?? 'Nama tidak tersedia' }}</p>
            <p><strong>Waktu Transaksi:</strong> {{ $history[0]->transaction_time->format('d-m-Y H:i') }}</p>
        </div>

        <!-- Invoice Table Section -->
        <table class="invoice-table">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Jumlah</th>
                    <th>Total Harga</th>
                </tr>
            </thead>
            <tbody>
                @foreach($history as $item)
                    @php
                        $priceBeforeDiscount = $item->total_price / (1 - ($item->discount / 100));
                        $unitPrice = $priceBeforeDiscount / $item->quantity;
                    @endphp
                    <tr>
                        <td>{{ $item->product_name }}</td>
                        <td>{{ $item->quantity }}x</td>
                        <td>Rp {{ number_format($unitPrice * $item->quantity, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <p><strong>Kasir:</strong> {{ $history[0]->user->name }}</p>
        <p><strong>Metode Pembayaran:</strong> {{ $history[0]->paymentMethod->name ?? 'Metode pembayaran tidak tersedia' }}</p>

        <!-- Summary Section -->
        <div class="summary">
            <p class="highlight">Total Harga (Sebelum Diskon): Rp {{ number_format($history->sum(function ($item) {
                return $item->total_price / (1 - ($item->discount / 100));
            }), 0, ',', '.') }}</p>
            <p class="highlight">Total Diskon: {{ number_format($history[0]->discount, 0, ',', '.') }} %</p>
        </div>

        <!-- Total Pembayaran Section -->
        <div class="total-payment">
            <p>Total Pembayaran: Rp {{ number_format($history->sum('total_price'), 0, ',', '.') }}</p>
        </div>

        <!-- Footer Section -->
        <div class="footer">
            <p>Terima kasih telah berbelanja di Toko Elektronik XYZ!</p>
            <p class="note">Invoice ini adalah bukti pembayaran yang sah.</p>
            <p>Hubungi kami di: support@tokoxyz.com | +62 812 3456 7890</p>
        </div>
    </div>
</body>
</html>
