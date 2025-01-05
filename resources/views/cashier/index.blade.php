<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Kasir</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/vue@3.3.4/dist/vue.global.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script> <!-- Menambahkan jsPDF -->
    <style>
        .product-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 0.5rem;
        }

        .card {
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .list-group-item {
            border: none;
            padding: 15px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .list-group-item:hover {
            background-color: #f8f9fa;
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

        h2.text-center {
            font-weight: 700;
            margin-bottom: 20px;
            color: #333;
        }

        .cart-item {
            padding: 12px;
            margin-bottom: 10px;
            border-radius: 8px;
            background-color: #f9f9f9;
        }

        .cart-item:hover {
            background-color: #f1f1f1;
        }

        .product-title {
            font-size: 1.1rem;
            font-weight: 600;
        }

        .product-price {
            color: #28a745;
            font-weight: 600;
        }

        .btn-icon {
            font-size: 1.2rem;
        }

        .cart-total {
            font-size: 1.2rem;
            font-weight: 600;
            color: #333;
        }

        .text-muted {
            font-size: 0.9rem;
        }

        .container {
            margin-top: 30px;
        }

        .card-body {
            padding: 20px;
        }
    </style>
</head>

<body>
    <div id="app" class="container mt-5">
        <div class="row">
            <!-- Form Pencarian Produk -->
            <form method="GET" action="{{ route('cashier.index') }}" class="mb-4">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari produk..." value="{{ request('search') }}">
                    <button class="btn btn-primary-custom" type="submit">Cari</button>
                </div>
            </form>

            <!-- Daftar Produk -->
            <div class="col-md-8">
                <h2>Daftar Produk</h2>
                <div style="max-height: 730px; overflow-y: auto; border: 1px solid #ddd; padding: 15px; border-radius: 8px;">
                    <div class="row">
                        <div class="col-md-4 mb-3" v-for="product in products" :key="product.id">
                            <div class="card">
                                <img :src="product.image ? ('/storage/' + product.image) : '/images/default.png'" 
                                     :alt="product.name" class="product-image" />
                                <div class="card-body">
                                    <h5 class="product-title">@{{ product.name }}</h5>
                                    <p class="product-price">Rp @{{ product.price }}</p>
                                    <p class="card-text">Stok: @{{ product.stock }}</p>
                                    <div class="d-flex justify-content-between">
                                        <button class="btn btn-danger btn-icon" @click="decreaseQuantity(product)">-</button>
                                        <input 
                                            type="number" 
                                            class="form-control w-50 text-center" 
                                            :value="cart[product.id]?.quantity || 0" 
                                            @input="updateQuantity(product, $event.target.value)"
                                            min="0" 
                                            :max="product.stock"
                                        />
                                        <button class="btn btn-success btn-icon" @click="increaseQuantity(product)">+</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Keranjang Belanja -->
            <div class="col-md-4">
                <h2 class="text-center">Keranjang</h2>
                <div class="mb-3">
                    <label for="customer-name" class="form-label">Nama Customer (Opsional)</label>
                    <input type="text" class="form-control" id="customer-name" v-model="customerName" placeholder="Masukkan nama customer">
                </div>
                <div class="card shadow-sm">
                    <div class="card-body">
                        <p v-if="Object.keys(cart).length === 0" class="text-center text-muted">Keranjang kosong</p>
                        
                        <ul class="list-group mb-3" v-else>
                            <li class="list-group-item d-flex justify-content-between align-items-center cart-item" 
                                v-for="(item, id) in cart" :key="id">
                                <div>
                                    <strong>@{{ item.name }}</strong>
                                    <p class="mb-0 text-muted">@{{ item.quantity }} x Rp @{{ item.price }}</p>
                                </div>
                                <div>
                                    <span class="text-success">Rp @{{ item.quantity * item.price }}</span>
                                    <button class="btn btn-sm btn-danger ms-2" @click="removeItem(id)">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </li>
                        </ul>

                        <h4 class="cart-total text-end">Total: <span class="text-primary">Rp @{{ totalPrice }}</span></h4>

                        <button class="btn btn-primary-custom w-100 mt-3" @click="checkout">
                            <i class="bi bi-cart-check"></i> Checkout
                        </button>
                        
                        <br><br>

                        <a href="{{ route('cashier.history') }}" class="btn btn-secondary mb-3 w-100">
                            <i class="bi bi-clock-history"></i> Lihat Riwayat Kasir
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const app = Vue.createApp({
            data() {
                return {
                    products: @json($products),
                    cart: {},
                    customerName: '',
                };
            },
            computed: {
                totalPrice() {
                    return Object.values(this.cart).reduce((total, item) => total + (item.price * item.quantity), 0);
                }
            },
            methods: {
                increaseQuantity(product) {
                    if (!this.cart[product.id]) {
                        this.cart[product.id] = { ...product, quantity: 1 };
                    } else if (this.cart[product.id].quantity < product.stock) {
                        this.cart[product.id].quantity++;
                    }
                },
                decreaseQuantity(product) {
                    if (this.cart[product.id] && this.cart[product.id].quantity > 0) {
                        this.cart[product.id].quantity--;
                        if (this.cart[product.id].quantity === 0) {
                            delete this.cart[product.id];
                        }
                    }
                },
                updateQuantity(product, value) {
                    const quantity = parseInt(value);
                    if (quantity >= 0 && quantity <= product.stock) {
                        if (!this.cart[product.id]) {
                            this.cart[product.id] = { ...product, quantity };
                        } else {
                            this.cart[product.id].quantity = quantity;
                        }
                    }
                },
                removeItem(id) {
                    delete this.cart[id];
                },
                checkout() {
                    if (Object.keys(this.cart).length === 0) {
                        alert('Keranjang kosong!');
                        return;
                    }

                    fetch('{{ route('cashier.checkout') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                        body: JSON.stringify({
                            cart: this.cart,
                            customer_name: this.customerName,
                        }),
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Checkout berhasil!');
                            this.cart = {}; // Reset keranjang
                            this.generatePDF(); // Memanggil fungsi untuk menghasilkan PDF
                        } else if (data.error) {
                            alert(data.error);
                        }
                    })
                    .catch(error => console.error('Error:', error));
                },
                generatePDF() {
                    const { jsPDF } = window.jspdf;
                    const doc = new jsPDF();

                    doc.setFontSize(18);
                    doc.text('Struk Pembelian', 105, 10, { align: 'center' });

                    if (this.customerName) {
                        doc.setFontSize(12);
                        doc.text(`Nama Customer: ${this.customerName}`, 20, 20);
                    }

                    let y = 30;
                    doc.setFontSize(12);
                    Object.values(this.cart).forEach((item, index) => {
                        doc.text(`${item.name} (${item.quantity} x Rp ${item.price}) - Rp ${item.quantity * item.price}`, 20, y);
                        y += 10;
                    });

                    doc.text(`Total: Rp ${this.totalPrice}`, 20, y + 10);
                    doc.save('struk-pembelian.pdf');
                }
            }
        });

        app.mount('#app');
    </script>
</body>

</html>
