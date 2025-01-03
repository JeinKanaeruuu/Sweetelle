<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    // Add 'customer_name', 'testimonial', and 'image' to the fillable array
    protected $fillable = [
        'customer_name',  // Customer's name
        'testimonial',    // Testimonial content
        'image',          // Image path (optional)
    ];
}