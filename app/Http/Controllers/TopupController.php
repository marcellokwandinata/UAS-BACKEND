<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\Topup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TopupController extends Controller
{
    // halaman list topup
    public function index(Request $request)
    {
        if ($request->id) {
            $topups = Topup::where('transaction_code', 'like', '%' . $request->id . '%')->get();

            if ($topups->isEmpty()) {
                return redirect('/topups')
                    ->with('error', 'Kode transaksi tidak ditemukan.');
            }
        } else {
            $topups = Topup::orderBy('created_at', 'desc')->get();
        }

        return view('list_topup', compact('topups'));
    }

    // halaman form create
    public function create()
    {
        return view('create_topup');
    }

    // simpan topup
    public function store(Request $request)
    {
        $request->validate([
            'payment_method' => 'required',
            'nominal' => 'required|numeric|min:1000',
        ]);

        $user = Auth::user();
        $nominal = (int) $request->nominal;

        DB::transaction(function () use ($request, $user, $nominal) {
            // lock untuk hindari race condition
            $lastTopup = Topup::lockForUpdate()->latest()->first();

            if ($lastTopup && $lastTopup->transaction_code) {
                $number = (int) substr($lastTopup->transaction_code, 3) + 1;
            } else {
                $number = 1;
            }

            $transactionCode = 'TRX' . str_pad($number, 3, '0', STR_PAD_LEFT);

            // tambah saldo user
            $user->balance += $nominal;
            $user->save();

            // simpan topup
            $topup = Topup::create([
                'transaction_code' => $transactionCode,
                'payment_method' => $request->payment_method,
                'nominal' => $nominal,
                'status' => 'Success',
            ]);

            // simpan riwayat
            History::create([
                'transaction_code' => $transactionCode,
                'title' => 'Top Up ' . $topup->payment_method,
                'description' => 'Berhasil',
                'amount' => $nominal,
                'balance_after' => $user->balance,
                'transaction_time' => now(),
            ]);
        });

        return redirect('/topups')
            ->with('success', 'Top up berhasil.');
    }

    // GET /topups/{id}
    public function show($id)
    {
        $topup = Topup::where('transaction_code', $id)->firstOrFail();

        return view('detail_topup', compact('topup'));
    }
}