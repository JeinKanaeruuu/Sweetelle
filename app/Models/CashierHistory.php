<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;

class CashierHistory extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak sesuai dengan konvensi
    protected $table = 'cashier_histories';

    // Tentukan kolom yang dapat diisi (fillable)
    protected $fillable = [
        'user_id',
        'customer_name',
        'product_name',
        'quantity',
        'total_price',
        'transaction_time',
        'transaction_id',  // Tambahkan kolom transaction_id
        'discount',  // Tambahkan kolom discount
        'payment_method_id',
    ];

    // Kamu bisa menambahkan waktu transaksi secara otomatis
    protected $dates = ['transaction_time'];

    public function user()
    {
        return $this->belongsTo(User::class); // Asumsikan user_id adalah kolom yang menghubungkan
    }

    protected $casts = [
        'transaction_time' => 'datetime',
    ];

        public function applyDiscount($discount)
    {
        // Menghitung total_price setelah diskon
        $this->discount = $discount;
        $this->total_price -= $this->total_price * ($discount / 100);
    }

    public function paymentMethod()
{
    return $this->belongsTo(PaymentMethod::class, 'payment_method_id');
}

}