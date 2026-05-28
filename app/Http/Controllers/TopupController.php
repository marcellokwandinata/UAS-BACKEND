<?php

namespace App\Http\Controllers;

use App\Models\Topup;
use Illuminate\Http\Request;

class TopupController extends Controller
{
   // halaman list
    public function index()
    {
        $topups = Topup::all();

        return view('list_topup', compact('topups'));
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

    // POST /topups
    // halaman form create
    public function create()
    {
        return view('create_topup');
    }

    // simpan data
    public function store(Request $request)
    {
        Topup::create([
            'payment_method' => $request->payment_method,
            'nominal' => $request->nominal,
            'status' => $request->status,
        ]);

        return redirect('/topups');
    }

    public function destroy($id)
    {
       $topup = Topup::find($id);

        if ($topup) {
            $topup->delete();

            return redirect('/topups')
                ->with('success', 'Data berhasil dihapus!');
        }

        return redirect('/topups')
            ->with('error', 'Data tidak ditemukan!');
    }
}