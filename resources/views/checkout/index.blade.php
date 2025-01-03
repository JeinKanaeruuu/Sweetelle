@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-center mb-6">Checkout</h1>

    @if(session('error'))
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <form id="checkoutForm" action="{{ route('checkout.process') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-6">
            <h2 class="text-2xl font-semibold mb-4">Detail Transaksi</h2>
            <table class="min-w-full bg-white rounded-lg shadow-md overflow-hidden">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="py-3 px-4 text-left">Produk</th>
                        <th class="py-3 px-4 text-left">Harga</th>
                        <th class="py-3 px-4 text-left">Jumlah</th>
                        <th class="py-3 px-4 text-left">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($carts as $cart)
                        <tr class="border-b hover:bg-gray-100">
                            <td class="py-2 px-4">{{ $cart->product->name }}</td>
                            <td class="py-2 px-4">Rp {{ number_format($cart->product->price, 2, ',', '.') }}</td>
                            <td class="py-2 px-4">{{ $cart->quantity }}</td>
                            <td class="py-2 px-4">Rp {{ number_format($cart->product->price * $cart->quantity, 2, ',', '.') }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="3" class="py-2 px-4 text-right font-bold">Total:</td>
                        <td class="py-2 px-4 font-bold">Rp {{ number_format($total, 2, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="mb-4">
            <label for="phone" class="block text-gray-700 font-semibold mb-2">Nomor Handphone:</label>
            <input type="text" name="phone" id="phone" required class="border border-gray-300 rounded-lg px-4 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-150" placeholder="Masukkan nomor handphone">
            @error('phone')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="payment_method" class="block text-gray-700">Metode Pembayaran</label>
            <select name="payment_method" id="payment_method" required class="w-full border rounded p-2 mt-2" onchange="togglePaymentDetails()">
                <option value="">Pilih Metode</option>
                <option value="QRIS" {{ old('payment_method') == 'QRIS' ? 'selected' : '' }}>QRIS</option>
                <option value="Transfer Bank" {{ old('payment_method') == 'Transfer Bank' ? 'selected' : '' }}>Transfer Bank</option>
            </select>
            @error('payment_method')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div id="paymentDetails" class="mb-4 hidden">
            <div id="qrisDetails" class="hidden">
                <h3 class="text-lg font-semibold">Scan QRIS Berikut:</h3>
                <img src="{{ asset('assets/images/Rickrolling_QR_code.png') }}" alt="QRIS" class="mt-2 rounded shadow-lg"> <!-- Ganti dengan path ke gambar QRIS yang sesuai -->
            </div>
            <div id="bankDetails" class="hidden">
                <h3 class="text-lg font-semibold">Nomor Rekening:</h3>
                <p class="mt-2">123-456-7890 (Bank ABC)</p> <!-- Ganti dengan nomor rekening yang sesuai -->
            </div>
        </div>

        <div class="mb-4">
            <label for="shipping_address" class="block text-gray-700">Alamat Pengiriman</label>
            <textarea id="shipping_address" name="shipping_address" required rows="4" placeholder="Masukkan alamat pengiriman" class="border border-gray-300 rounded-lg px-4 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-150"></textarea>
        </div>

        <div class="mb-4">
            <label for="payment_proof" class="block text-gray-700">Bukti Pembayaran</label>
            <input type="file" name="payment_proof" id="payment_proof" accept="image/*" required class="w-full border rounded p-2 mt-2">
            @error('payment_proof')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="bg-green-500 text-white px-6 py-3 rounded-lg shadow hover:bg-green-600 transition duration-200 w-full">Proses Pembayaran</button>
    </form>
</div>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    document.getElementById('checkoutForm').addEventListener('submit', function(event) {
        const phone = document.getElementById('phone').value.trim();
        const paymentMethod = document.getElementById('payment_method').value.trim();
        const shippingAddress = document.getElementById('shipping_address').value.trim();
        const paymentProof = document.getElementById('payment_proof').value.trim();

        if (!phone || phone.length < 10 || isNaN(phone)) {
            event.preventDefault();
            swal("Error!", "Nomor handphone harus berisi minimal 10 angka dan hanya angka!", "error");
            return;
        }

        if (!paymentMethod || !shippingAddress || !paymentProof) {
            event.preventDefault();
            swal("Error!", "Silakan lengkapi semua kolom sebelum melanjutkan!", "error");
            return;
        }

        swal({
            title: "Proses Pembayaran",
            text: "Pembayaran berhasil diproses!",
            icon: "success",
            button: "OK",
        });
    });

    function togglePaymentDetails() {
        const paymentMethod = document.getElementById('payment_method').value;
        const qrisDetails = document.getElementById('qrisDetails');
        const bankDetails = document.getElementById('bankDetails');
        const paymentDetails = document.getElementById('paymentDetails');

        if (paymentMethod === 'QRIS') {
            paymentDetails.classList.remove('hidden');
            qrisDetails.classList.remove('hidden');
            bankDetails.classList.add('hidden');
        } else if (paymentMethod === 'Transfer Bank') {
            paymentDetails.classList.remove('hidden');
            qrisDetails.classList.add('hidden');
            bankDetails.classList.remove('hidden');
        } else {
            paymentDetails.classList.add('hidden');
            qrisDetails.classList.add('hidden');
            bankDetails.classList.add('hidden');
        }
    }
</script>

<style>
    body {
        background-color: #f8f9fa;
    }

    h1 {
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
    }

    .rounded-lg {
        border-radius: 10px;
    }

    .bg-green-500 {
        background-color: #28a745;
    }

    .hover\:bg-green-600:hover {
        background-color: #218838;
    }
</style>

@endsection
