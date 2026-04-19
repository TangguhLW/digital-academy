<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('profile.edit', [
            'user' => Auth::user()
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $rules = [
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'avatar' => ['nullable', 'image', 'max:5120'],
            'avatar_base64' => ['nullable', 'string'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ];

        if ($user->role === 'siswa') {
            $rules['telepon'] = ['nullable', 'string', 'max:20'];
            $rules['umur'] = ['nullable', 'integer', 'min:5', 'max:100'];
            $rules['kelas'] = ['nullable', 'string', 'max:50'];
        } elseif ($user->role === 'admin') {
            $rules['telepon'] = ['nullable', 'string', 'max:20'];
        }

        $validated = $request->validate($rules);

        // Reset verification if phone changed
        if (isset($validated['telepon']) && $validated['telepon'] !== $user->telepon) {
            $user->phone_verified_at = null;
        }

        if (!empty($validated['avatar_base64'])) {
            $base64_image = $validated['avatar_base64'];
            @list($type, $file_data) = explode(';', $base64_image);
            @list(, $file_data) = explode(',', $file_data);
            $image_data = base64_decode($file_data);
            $image_name = 'avatars/' . uniqid() . '.jpg';
            Storage::disk('public')->put($image_name, $image_data);
            
            if ($user->avatar && !str_starts_with($user->avatar, 'http') && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }
            $validated['avatar'] = $image_name;
            unset($validated['avatar_base64']);
        } elseif ($request->hasFile('avatar')) {
            if ($user->avatar && !str_starts_with($user->avatar, 'http') && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }
            $validated['avatar'] = $request->file('avatar')->store('avatars', 'public');
            unset($validated['avatar_base64']);
        } else {
            unset($validated['avatar']);
            unset($validated['avatar_base64']);
        }

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return back()->with('success', 'Profile berhasil diperbarui.');
    }
}
