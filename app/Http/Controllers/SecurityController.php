<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SecurityController extends Controller
{
    public function index()
    {
        $securities = DB::table('securities')->get();
        return view('security_index', compact('securities'));
    }

    public function create()
    {
        return view('create_security');
    }

    public function show($id)
    {
        $security = DB::table('securities')->where('id', $id)->first();
        if (!$security) abort(404);
        return view('security_show', compact('security'));
    }

    public function store(Request $request)
    {
         DB::table('securities')->insert([
        'id'         => uniqid('', true),
        'user_id'    => auth()->id(),
        'name'       => $request->name,
        'type'       => $request->type,
        'status'     => $request->status,
        'created_at' => now(),
        'updated_at' => now(),
        ]);

        return redirect('/securities')->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $security = DB::table('securities')->where('id', $id)->first();
        if (!$security) abort(404);
        return view('security_edit', compact('security'));
    }

    public function update(Request $request, $id)
    {
        DB::table('securities')->where('id', $id)->update([
            'name'       => $request->name,
            'type'       => $request->type,
            'status'     => $request->status,
            'updated_at' => now(),
        ]);

        return redirect('/securities')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        DB::table('securities')->where('id', $id)->delete();
        return redirect('/securities')->with('success', 'Data berhasil dihapus.');
    }
    public function pinEdit()
    {
        return view('security_pin');
    }

    public function pinUpdate(Request $request)
{
    if ($request->new_pin !== $request->confirm_pin) {
        return back()->withErrors(['PIN baru dan konfirmasi PIN tidak cocok.']);
    }

    if (strlen($request->new_pin) !== 6 || !ctype_digit($request->new_pin)) {
        return back()->withErrors(['PIN harus 6 digit angka.']);
    }

    $existing = DB::table('securities')->where('type', 'pin')->first();

    if ($existing) {
        DB::table('securities')->where('type', 'pin')->update([
            'status'     => 'aktif',
            'updated_at' => now(),
        ]);
    } else {
        DB::table('securities')->insert([
            'user_id'    => auth()->id(),
            'name'       => 'PIN Transaksi',
            'type'       => 'pin',
            'status'     => 'aktif',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    return redirect()->route('security.pin')->with('success', 'PIN anda berhasil diubah.');
}

}