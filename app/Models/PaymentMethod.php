<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaymentMethod extends Model
{
    use HasFactory;

    // Nama tabel (jika tidak sesuai konvensi)
    protected $table = 'payment_methods';

    // Kolom yang dapat diisi (fillable)
    protected $fillable = [
        'name', // Nama metode pembayaran
    ];

    // Relasi dengan CashierHistory
    public function cashierHistories()
    {
        return $this->hasMany(CashierHistory::class, 'payment_method_id');
    }
}