<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ActivityLog;

class LandingPages extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Accessors to get the full URL for the image
    public function getImageUrlAttribute()
    {
        return asset('storage/' . $this->image_path);
    }
    
}
