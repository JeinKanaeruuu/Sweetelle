<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'image',
        'description',
        'stock',
        'price',
        'discount_percentage',
        'start_date',
        'end_date',
    ];

    // Accessor untuk harga setelah diskon
    public function getDiscountedPriceAttribute()
    {
        $today = now();
        if ($this->discount_percentage > 0 && 
            $this->start_date <= $today && 
            $this->end_date >= $today) {
            return $this->price - ($this->price * $this->discount_percentage / 100);
        }
        return $this->price;
    }

    public function reduceStock($quantity)
{
    if ($this->stock >= $quantity) {
        $this->stock -= $quantity;
        $this->save();
    } else {
        throw new \Exception("Stock tidak mencukupi untuk {$this->name}");
    }
}

}
