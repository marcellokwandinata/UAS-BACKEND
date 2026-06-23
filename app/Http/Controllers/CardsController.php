<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CardsController extends Controller
{
    public function index()
    {
        $cards = DB::table('cards')->get();
        $pinSecurity = DB::table('securities')
            ->where('type', 'pin')
            ->orderBy('updated_at', 'desc')
            ->first();
        return view('cards.index', compact('cards', 'pinSecurity'));
    }

    public function create()
    {
        return view('cards.create_cards');
    }

public function store(Request $request)
{
    // Generate nomor kartu 16 digit
    $cardNumber = implode(' ', str_split(str_pad(rand(0, 9999999999999999), 16, '0', STR_PAD_LEFT), 4));

    // Generate expired date 5 tahun dari sekarang
    $expiredAt = now()->addYears(5)->format('m/y');

    // Limit default berdasarkan tipe kartu
    $limitMap = [
        'debit'   => 10000000,
        'credit'  => 50000000,
        'prepaid' => 5000000,
        'virtual' => 20000000,
    ];
    $cardLimit = $limitMap[$request->card_type] ?? 10000000;

    DB::table('cards')->insert([
        'user_id'         => auth()->id(),
        'cardholder_name' => $request->cardholder_name,
        'card_number'     => $cardNumber,
        'card_type'       => $request->card_type,
        'expired_at'      => $expiredAt,
        'card_limit'      => $cardLimit,
        'status'          => 'aktif',
        'created_at'      => now(),
        'updated_at'      => now(),
    ]);

    return redirect('/cards/user/' . auth()->id())->with('success', 'Kartu berhasil ditambahkan. Nomor kartu: ' . $cardNumber);
}
    public function show($id)
    {
        $card = DB::table('cards')->where('id', $id)->firstOrFail();
        return view('show_cards', compact('card'));
    }

    public function edit($id)
    {
        $card = DB::table('cards')->where('id', $id)->first();

        if (!$card) {
            abort(404, 'Kartu tidak ditemukan.');
        }

        return view('edit_cards', compact('card'));
    }

    public function update(Request $request, $id)
    {
        DB::table('cards')->where('id', $id)->update([
            'cardholder_name' => $request->cardholder_name,
            'card_type'       => $request->card_type,
            'card_number'     => $request->card_number,
            'expired_at'      => $request->expired_at,
            'card_limit'      => $request->card_limit,
            'status'          => $request->status,
            'updated_at'      => now(),
        ]);

        return redirect('/cards')->with('success', 'Kartu berhasil diperbarui.');
    }

    public function destroy($id)
    {
        DB::table('cards')->where('id', $id)->delete();
        return redirect('/cards')->with('success', 'Kartu berhasil dihapus.');
    }
    public function setLimitForm($id)
    {
        $card = DB::table('cards')->where('id', $id)->first();

        if (!$card) {
            abort(404, 'Kartu tidak ditemukan.');
        }


        if ($card->user_id != Auth::id()) {
            return redirect()->route('cards_index')->with('error', 'Akses dilarang!');
        }

        return view('cards.set_limit', compact('card'));
    }
    public function setLimit(Request $request, $id)
    {
        $card = DB::table('cards')->where('id', $id)->first();

        if (!$card) {
            abort(404, 'Kartu tidak ditemukan.');
        }


        if ($card->user_id != Auth::id()) {
            return redirect()->route('cards_index')->with('error', 'Akses dilarang!');
        }

        $request->validate([
            'card_limit' => 'required|numeric|min:0',
        ]);

        DB::table('cards')->where('id', $id)->update([
            'card_limit' => $request->card_limit,
            'updated_at' => now(),
        ]);

        return redirect('/cards/' . $id)->with('success', 'Limit kartu berhasil diperbarui.');
    }


    public function cardsByUser($user_id)
    {
        // User hanya boleh lihat kartu miliknya sendiri
        if (Auth::id() != $user_id) {
            return redirect()->route('cards_index')->with('error', 'Akses dilarang!');
        }

        $cards = DB::table('cards')
            ->where('user_id', $user_id)
            ->orderBy('created_at', 'desc')
            ->get();

        $user = DB::table('users')->where('id', $user_id)->first();

        return view('cards.by_user', compact('cards', 'user'));
    }
}