<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function show()
    {
        /** @var User $user */
        $user = Auth::user();
        return view('profile.show', compact('user'));
    }

    public function update(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();
        
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        // Update nama
        $user->name = $request->name;

        // Handle upload avatar
        if ($request->hasFile('avatar')) {
            // Hapus avatar lama jika ada
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }

            // Upload avatar baru
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $avatarPath;
        }

        $user->save();

        return redirect()->route('profile.show')->with('success', 'Profile berhasil diperbarui!');
    }
}
