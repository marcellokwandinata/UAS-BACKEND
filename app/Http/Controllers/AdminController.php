<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\User;

class AdminController extends Controller
{
    // Menampilkan halaman login admin
    public function index()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('Auth.admin_login');
    }

    // Memproses verifikasi login admin
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('admin')->attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau password admin salah.',
        ])->onlyInput('email');
    }

    // Menampilkan form register admin
    public function register()
    {
        return view('Auth.admin_register');
    }

    // Menyimpan data admin baru ke database
    public function storeAdmin(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email'     => 'required|string|email|max:255|unique:admins',
            'password'  => 'required|string|min:6|confirmed',
        ]);

        $admin = Admin::create([
            'full_name' => $request->full_name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
        ]);

        Auth::guard('admin')->login($admin);

        return redirect()->route('admin.dashboard');
    }

    // Menampilkan daftar semua nasabah yang terdaftar
    public function dashboard()
    {
        $users = User::all();
        return view('Admin.dashboard', compact('users'));
    }

    // Menampilkan detail satu nasabah dari sisi admin
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('Admin.show', compact('user'));
    }

    // Menghapus akun nasabah dari sisi admin
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Akun nasabah berhasil dihapus.');
    }

    // Logout di halaman admin
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('Auth.admin_login');
    }
}