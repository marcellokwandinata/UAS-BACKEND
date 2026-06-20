<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
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
        return view('cards_index', compact('cards', 'pinSecurity'));
    }

    public function create()
    {
        return view('create_cards');
    }

    public function store(Request $request)
    {
        DB::table('cards')->insert([
            'id'          => uniqid('', true),
            'cardholder_name' => $request->cardholder_name,
            'card_number' => $request->card_number,
            'card_type'   => $request->card_type,
            'expired_date'=> $request->expired_date,
            'card_limit'  => $request->card_limit,
            'status'      => $request->status ?? 'aktif',
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);

        return redirect('/cards')->with('success', 'Kartu berhasil ditambahkan.');
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
            'expired_date'    => $request->expired_date,
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
}