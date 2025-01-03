<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function about()
    {
        return view('about'); // Pastikan Anda memiliki view about.blade.php
    }
}
