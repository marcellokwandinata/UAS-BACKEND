<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\User;
use App\Models\transaction;

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

   // Menampilkan daftar semua nasabah, dengan fitur search
    public function dashboard(Request $request)
    {
        $search = $request->input('search');

        $users = User::when($search, function ($query, $search) {
            $query->where('full_name', 'like', '%' . $search . '%')
                  ->orWhere('account_number', 'like', '%' . $search . '%');
        })->get();

        return view('Admin.dashboard', compact('users', 'search'));
    }

    // Menampilkan detail satu nasabah dari sisi admin
    public function show($id)
    {
        $user = User::findOrFail($id);

        $transactions = transaction::where('user_id' , $user->id)
            ->orWhere('recipient_account' , $user->account_number)
            ->latest()
            ->get();
            
        return view('Admin.show', compact('user' , 'transactions'));
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