<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Topup;
use App\Models\History;
use App\Models\Beneficiary;

class UserController extends Controller
{
    // Menampilkan halaman utama nasabah setelah login
    public function index()
    {
        $user = Auth::user();
        $beneficiaries = Beneficiary::all();
        return view('User.index', compact('user', 'beneficiaries'));
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

    public function addBalance(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);

        $user = Auth::user();
        $amount = (float) $request->input('amount');

        // Tambah saldo user
        $user->balance += $amount;
        $user->save();

        // Generate kode transaksi
        $lastTopup = Topup::latest()->first();

        if ($lastTopup && $lastTopup->transaction_code) {
            $number = (int) substr($lastTopup->transaction_code, 3) + 1;
        } else {
            $number = 1;
        }

        $transactionCode = 'TRX' . str_pad($number, 3, '0', STR_PAD_LEFT);

        // Simpan ke tabel topups
        Topup::create([
            'transaction_code' => $transactionCode,
            'payment_method' => 'Top Up Saldo',
            'nominal' => $amount,
            'status' => 'Success',
        ]);

        // Simpan ke history
        History::create([
            'transaction_code' => $transactionCode,
            'title' => 'Top Up Saldo',
            'description' => 'Berhasil',
            'amount' => $amount,
            'balance_after' => $user->balance,
            'transaction_time' => now(),
        ]);

        return redirect()->route('user.index')
            ->with(
                'success',
                'Top Up berhasil sebesar Rp ' .
                number_format($amount, 0, ',', '.')
            );
    }

    public function resetBalance(Request $request)
    {
        $user = Auth::user();
        $user->balance = 0;
        $user->save();

        return redirect()->route('user.index')->with('success', 'Saldo berhasil direset ke Rp 0');
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

