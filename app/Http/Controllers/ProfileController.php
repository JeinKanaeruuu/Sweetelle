<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman profil pengguna.
     */
    public function show()
    {
        $user = Auth::user(); // Mendapatkan data pengguna yang sedang login
        return view('customer.profile', compact('user')); // Pastikan view 'customer.profile' sudah ada
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Cek apakah nama sudah terpakai oleh pengguna lain
        if (User::where('name', $request->name)->where('id', '!=', $id)->exists()) {
            return redirect()->back()->with('error', 'Nama sudah dipakai.')->withInput();
        }

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->save();

        return redirect()->back()->with('success', 'Profil Anda berhasil diperbarui.');
    }
}
