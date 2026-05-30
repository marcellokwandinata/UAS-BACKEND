<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    /**
     * GET /user
     * Menampilkan dashboard utama nasabah setelah login.
     */
    public function index()
    {
        $user = Auth::user();
        return view('User.index', compact('user'));
    }

    /**
     * GET /user/{id}
     * Menampilkan detail profil satu nasabah.
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('User.show', compact('user'));
    }

    /**
     * GET /user/{id}/edit
     * Menampilkan form edit profil nasabah.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        if (Auth::id() != $user->id) {
            return redirect()->route('user.index')->with('error', 'Akses dilarang!');
        }

        return view('User.edit', compact('user'));
    }

    /**
     * PATCH /user/{id}
     * Menyimpan perubahan data profil nasabah.
     */
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

    /**
     * DELETE /user/{id}
     * Menghapus akun nasabah dari database.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        Auth::logout();
        $user->delete();

        return redirect()->route('login')->with('success', 'Akun berhasil dihapus.');
    }
}
