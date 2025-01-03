<!DOCTYPE html>
<html lang="en">

<style>
        .product-image {
        width: 100%; /* Ukuran lebar penuh */
        height: 200px; /* Tinggi tetap */
        object-fit: cover; /* Jaga proporsi gambar */
        border-radius: 0.5rem; /* Opsional: sudut membulat */
    }

    .list-group-item {
        border: none;
        padding: 15px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .list-group-item:hover {
        background-color: #f8f9fa;
    }

    .text-muted {
        font-size: 0.9rem;
    }

    .btn-danger {
        font-size: 0.8rem;
    }

    h2.text-center {
        font-weight: 700;
        margin-bottom: 20px;
        color: #333;
    }
</style>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Kasir</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/vue@3.3.4/dist/vue.global.js"></script>

</head>
<body>
    <div id="app" class="container mt-5">
        <div class="row">
        <!-- Form Pencarian -->
        <form method="GET" action="{{ route('cashier.index') }}" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari produk..." value="{{ request('search') }}">
                <button class="btn btn-primary" type="submit">Cari</button>
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
                                 :alt="product.name" 
                                 class="product-image" />
                            <div class="card-body">
                                <h5 class="card-title">@{{ product.name }}</h5>
                                <p class="card-text">Stok: @{{ product.stock }}</p>
                                <p class="card-text">Harga: Rp @{{ product.price }}</p>
                                <div class="d-flex justify-content-between">
                                    <button class="btn btn-danger" @click="decreaseQuantity(product)">-</button>
                                    <span>@{{ cart[product.id]?.quantity || 0 }}</span>
                                    <button class="btn btn-success" @click="increaseQuantity(product)">+</button>
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
                           <!-- Input Nama Customer (Opsional) -->
                           <div class="mb-3">
                            <label for="customer-name" class="form-label">Nama Customer (Opsional)</label>
                            <input type="text" class="form-control" id="customer-name" v-model="customerName" placeholder="Masukkan nama customer">
                        </div>    
    <div class="card shadow-sm">
        <div class="card-body">
            <!-- Jika keranjang kosong -->
            <p v-if="Object.keys(cart).length === 0" class="text-center text-muted">Keranjang kosong</p>
            
            <!-- Daftar item dalam keranjang -->
            <ul class="list-group mb-3" v-else>
                <li class="list-group-item d-flex justify-content-between align-items-center" 
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

        

            <!-- Total Harga -->
            <h4 class="text-end">Total: <span class="text-primary">Rp @{{ totalPrice }}</span></h4>
            



            <!-- Tombol Checkout -->
            <button class="btn btn-primary w-100 mt-3" @click="checkout">
                <i class="bi bi-cart-check"></i> Checkout
            </button>
            
            <br> <br>

            <a href="{{ route('cashier.history') }}" class="btn btn-secondary mb-3">
                <i class="bi bi-clock-history"></i> Lihat Riwayat Kasir
            </a>
        </div>
    </div>
</div>

    <script>
        const app = Vue.createApp({
            data() {
                return {
                    products: @json($products),
                    cart: {},
                    searchQuery: '',
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
                    } else {
                        alert('Stok tidak mencukupi!');
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
                            customer_name: this.customerName  // Sertakan nama customer
                        }),
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Checkout berhasil!');
                            this.cart = {}; // Reset keranjang
                        } else if (data.error) {
                            alert(data.error);
                        }
                    })
                    .catch(error => console.error('Error:', error));
                }

                        }
        });

        app.mount('#app');
    </script>
</body>
</html>
