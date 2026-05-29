<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * GET /auth
     * Tampilkan halaman login awal
     */
    public function index() {
        if (Auth::check()) {
            return redirect()->route('user.index');
        }
        return view('User.login');
    }

    /**
     * GET /auth/create
     * Tampilkan form pendaftaran nasabah baru
     */
    public function create() {
        return view('User.create');
    }

    /**
     * POST /auth
     * Eksekusi verifikasi proses masuk (Login)
     */
    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('user.index');
        }

        return back()->withErrors(['email' => 'Email atau password salah.']);
    }

    /**
     * POST /auth/store
     * Simpan akun baru ke database phpMyAdmin + Auto Login
     */
    public function store(Request $request) {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        // Menyimpan data pendaftaran dan generate otomatis 10 digit nomor rekening acak
        $user = User::create([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'account_number' => '1000' . rand(100000, 999999), 
        ]);

        // Otomatis ubah status nasabah jadi aktif login setelah sukses mendaftar
        Auth::login($user);

        // Alihkan langsung ke halaman utama pengguna melalui endpoint /users
        return redirect()->route('user.index');
    }

    /**
     * DELETE /auth/{id}
     * Proses keluar dari sistem (Logout) dan menghancurkan session
     */
    public function logout(Request $request, $id) {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('login');
    }
}