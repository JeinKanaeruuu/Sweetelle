<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .invoice-container {
            width: 100%;
            max-width: 800px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .header p {
            margin: 5px 0;
            font-size: 14px;
            color: #555;
        }
        .details {
            margin-bottom: 20px;
        }
        .details .row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        .details .row span {
            font-size: 14px;
        }
        .items {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .items th, .items td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
            font-size: 14px;
        }
        .items th {
            background-color: #f5f5f5;
        }
        .total {
            text-align: right;
            font-size: 16px;
            font-weight: bold;
        }
        .footer {
            text-align: center;
            font-size: 12px;
            color: #555;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <div class="header">
            <h1>Sweetelle</h1>
            <p>Aneka Kue Tradisional dan Modern</p>
        </div>
        <div class="details">
            <div class="row">
              <span><strong>Invoice:</strong> #{{ $data['invoice_number'] }}</span>
                <span><strong>Date:</strong> {{ $data['date'] }}</span>
            </div>
            <div class="row">
                <span><strong>Customer:</strong> {{ $data['customer_name'] }}</span>
                <span><strong>Contact:</strong> {{ $data['customer_contact'] }}</span>
            </div>
        </div>
        <table class="items">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Item</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data['items'] as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ $item['quantity'] }}</td>
                    <td>Rp {{ number_format($item['price'], 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($item['quantity'] * $item['price'], 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="total">Total: Rp {{ number_format($data['total'], 0, ',', '.') }}</div>
        <div class="footer">
            <p>Terima kasih atas pesanan Anda!</p>
            <p>Sweetelle - Aneka Kue untuk Momen Istimewa Anda</p>
        </div>
    </div>
</body>
</html>
