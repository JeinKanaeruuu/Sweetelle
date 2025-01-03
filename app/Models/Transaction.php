<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TransactionItem;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total',
        'payment_method',
        'status',
        'payment_proof',
        'shipping_address',
        'phone',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(TransactionItem::class);
    }

    public function products()
    {
        return $this->hasManyThrough(
            Product::class,
            TransactionItem::class,
            'transaction_id', // Foreign key di TransactionItem
            'id',             // Foreign key di Product
            'id',             // Local key di Transaction
            'product_id'      // Local key di TransactionItem
        );
    }
    
}
