<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class CustomerAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('customer.login'); // Nama view form login customer
    }

    // Mengarahkan ke provider (Google)
    public function redirectToProvider()
    {
        Log::info('Redirecting to Google');
        return Socialite::driver('google')->redirect();
    }

    // Menangani callback dari Google
    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->user();

        // Cari atau buat pengguna di database
        $user = User::where('email', $googleUser->getEmail())->first();

        if (!$user) {
            // Jika pengguna belum ada, buat pengguna baru
            $user = User::create([
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'password' => bcrypt(str::random(16)), // Ganti dengan password acak
            ]);
        }

        // Masuk ke aplikasi
        Auth::login($user, true);

        return redirect()->intended('cashier.index'); // Ganti dengan rute tujuan setelah login
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Cek apakah kredensial sesuai
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            
            // Periksa role user
            if ($user->role === 'USER' || 'Super ADMIN' || 'Admin') {
                // Redirect ke dashboard customer
                return redirect()->intended('cashier');
            } else {
                // Logout jika user bukan customer
                Auth::logout();
                return redirect()->back()->withErrors(['email' => 'Login gagal, cek email dan password Anda.']);
            }
        }

        // Jika gagal login
        return redirect()->back()->withErrors(['email' => 'Login gagal, cek email dan password Anda.']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}

