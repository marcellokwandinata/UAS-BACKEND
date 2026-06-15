<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    // Menampilkan halaman utama nasabah setelah login
    public function index()
    {
        $user = Auth::user();
        return view('User.index', compact('user'));
    }

    // Menampilkan detail profil nasabah
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('User.show', compact('user'));
    }

    // Menampilkan halaman edit profil nasabah
    public function edit($id)
    {
        $user = User::findOrFail($id);

        if (Auth::id() != $user->id) {
            return redirect()->route('user.index')->with('error', 'Akses dilarang!');
        }

        return view('User.edit', compact('user'));
    }

    // Menyimpan perubahan data profil nasabah
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'full_name' => 'required|string|max:255',
            'email'     => 'required|string|email|max:255|unique:users,email,' . $id,
        ]);

        $user->update($request->only(['full_name', 'email']));

        return redirect()->route('user.index')->with('success', 'Profil berhasil diperbarui!');
    }

    // Menghapus akun nasabah dari database
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        Auth::logout();
        $user->delete();

        return redirect()->route('login')->with('success', 'Akun berhasil dihapus.');
    }

    // Menampilkan halaman ganti password
    public function changePasswordForm($id)
    {
        $user = User::findOrFail($id);

        if (Auth::id() != $user->id) {
            return redirect()->route('user.index')->with('error', 'Akses dilarang!');
        }

        return view('User.change_password', compact('user'));
    }

    // Menyimpan password baru nasabah
    public function changePassword(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if (Auth::id() != $user->id) {
            return redirect()->route('user.index')->with('error', 'Akses dilarang!');
        }

        $request->validate([
            'current_password' => 'required',
            'new_password'     => 'required|string|min:6|confirmed',
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password lama salah.']);
        }

        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return redirect()->route('user.index')->with('success', 'Password berhasil diubah!');
    }
}
