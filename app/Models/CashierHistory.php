<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashierHistory extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak sesuai dengan konvensi
    protected $table = 'cashier_histories';

    // Tentukan kolom yang dapat diisi (fillable)
    protected $fillable = [
        'user_id',
        'customer_name',  // Tambahkan kolom customer_name
        'product_name',
        'quantity',
        'total_price',
        'transaction_time'
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
}