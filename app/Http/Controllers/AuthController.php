<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * GET /login
     * Menampilkan halaman login.
     */
    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('user.index');
        }
        return view('Auth.login');
    }

    /**
     * GET /register
     * Menampilkan form pendaftaran akun baru.
     */
    public function create()
    {
        if (Auth::check()) {
            return redirect()->route('user.index');
        }
        return view('Auth.create');
    }

    /**
     * POST /login
     * Memproses verifikasi login nasabah.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            return redirect()->route('user.index');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    /**
     * POST /register
     * Menyimpan data nasabah baru ke database dan generate nomor rekening.
     */
    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email'     => 'required|string|email|max:255|unique:users',
            'password'  => 'required|string|min:6|confirmed', //confirmed untuk konfirm ulang pw
        ]);

        // Generate nomor rekening unik: awalan 1000 + 6 angka acak
        do {
            $accountNumber = '1000' . rand(100000, 999999);
        } while (User::where('account_number', $accountNumber)->exists());

        $user = User::create([
            'full_name'      => $request->full_name,
            'email'          => $request->email,
            'password'       => Hash::make($request->password),
            'account_number' => $accountNumber,
        ]);

        Auth::login($user);

        return redirect()->route('user.index')->with('success', 'Akun berhasil dibuat!');
    }

    /**
     * POST /logout
     * Keluar dari aplikasi.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
