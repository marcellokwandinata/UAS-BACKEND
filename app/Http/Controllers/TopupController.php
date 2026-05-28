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
            return response()->json([
                'success' => false,
                'message' => 'Maaf, Topup tidak berhasil..'
            ], 404);
        }

        $topups = Topup::all();
        return view('list_topup', compact('topups'));
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
}