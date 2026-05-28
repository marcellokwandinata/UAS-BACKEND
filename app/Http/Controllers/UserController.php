<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // HALAMAN PERTAMA (LOGIN & REGISTER)
    
    // Form Login
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('User.index');
        }
        return view('User.login');
    }

    // Proses Login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/User');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    // Form Register
    public function create()
    {
        return view('User.create');
    }

    // Proses Register
    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect()->route('User.index')->with('success', 'Rekening berhasil dibuat!');
    }

    // Proses Logout (Dipicu dari Halaman Kedua)
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'Anda telah keluar dari aplikasi.');
    }
    
    // HALAMAN KEDUA 
    public function index()
    {
        // Proteksi: Jika belum login, tendang balik ke halaman pertama (login)
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        $user = Auth::user();
        return view('User.index', compact('user'));
    }

}