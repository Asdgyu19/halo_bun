<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    // ✅ Tampilkan profil user
    public function show()
    {
        $user = Auth::user();
        return view('front.profile.show', compact('user'));
    }

    // ✅ Update profil user
    public function update(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:50', 'unique:users,username,'.$user->id],
            'email'    => ['required', 'email', 'unique:users,email,'.$user->id],
            'phone'    => ['nullable', 'string', 'max:20'],
            'city'     => ['nullable', 'string', 'max:100'],
            'password' => ['nullable', 'confirmed', 'min:6'],
        ]);

        // kalau password diisi → hash baru
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return back()->with('ok', 'Profil berhasil diperbarui.');
    }
}
