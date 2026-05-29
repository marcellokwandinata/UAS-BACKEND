<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\Topup;
use Illuminate\Http\Request;

class TopupController extends Controller
{
   // halaman list topup
    public function index()
    {
        $topups = Topup::all();
        return view('list_topup', compact('topups'));
    }

    // halaman form create
    // POST /topups
    public function create()
    {
        return view('create_topup');
    }

    // simpen topup
    public function store(Request $request)
    {
        // saldo awal sebagai contoh
        $balance = session('balance', 5000000);

        $nominal = (int) $request->nominal;

        // cek saldo
        if ($nominal > $balance) {
            return redirect('/topups')
                ->with('error', 'Saldo tidak cukup!');
        }

        // update saldo
        $newBalance = $balance - $nominal;
        session(['balance' => $newBalance]);

        // simpan topup
        $topup = Topup::create([
            'payment_method' => $request->payment_method,
            'nominal' => $nominal,
            'status' => 'Success',
        ]);

        // auto masuk ke history
        History::create([
            'title' => 'Topup via ' . $topup->payment_method,
            'description' => 'Transaksi berhasil',
            'amount' => $nominal,
            'balance_after' => $newBalance,
            'transaction_time' => now(),
        ]);

        return redirect('/topups')
            ->with('success', 'Topup berhasil!');
    }

    // GET /topups/{id}
    public function show($id)
    {
        $topup = Topup::find($id);

        if (!$topup) {
            return redirect('/topups')
                ->with('error', 'ID tidak ditemukan!');
        }

        return view('list_topup', [
            'topups' => [$topup]
        ]);
    }
}