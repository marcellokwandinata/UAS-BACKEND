<?php

namespace App\Http\Controllers;

use App\Models\Topup;
use Illuminate\Http\Request;

class TopupController extends Controller
{
    // GET /topups
    public function index()
    {
        $topups = Topup::all();

        return view('create_topup', compact('topup'));
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

        return view('create_topup', compact('topup'));
    }

    // POST /topups
    public function store(Request $request)
    {
        $topup = Topup::create([
            'payment_method' => $request->payment_method,
            'nominal' => $request->nominal,
            'status' => $request->status,
        ]);

        return view('create_topup', compact('topup'));
    }
}