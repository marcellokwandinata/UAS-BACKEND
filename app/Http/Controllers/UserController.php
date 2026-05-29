<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    /**
     * GET /users
     * Menampilkan Halaman Utama Akun Pengguna (Dashboard)
     */
    public function index() {
        // Mengambil data user / nasabah yang saat ini sedang aktif login di session
        $user = Auth::user();
        
        // Melempar datanya ke file resources/views/User/index.blade.php
        return view('User.index', compact('user'));
    }

    /**
     * GET /users/{id}
     * Detail informasi satu nasabah spesifik (untuk kebutuhan internal/pengembangan ke depan)
     */
    public function show($id) {
        $user = User::findOrFail($id);
        return response()->json($user, 200);
    }

    /**
     * PATCH /users/{id}
     * Update data profil akun nasabah jika ada perubahan data
     */
    public function update(Request $request, $id) {
        $user = User::findOrFail($id);
        
        $request->validate([
            'full_name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255|unique:users,email,'.$id,
        ]);

        $user->update($request->only(['full_name', 'email']));
        return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    }

    /**
     * DELETE /users/{id}
     * Menghapus akun nasabah dari database 
     */
    public function destroy($id) {
        $user = User::findOrFail($id);
        $user->delete();
        
        return redirect()->route('login')->with('success', 'Akun berhasil dihapus.');
    }
}