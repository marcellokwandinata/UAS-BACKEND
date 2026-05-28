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

        return response()->json([
            'success' => true,
            'data' => $topups
        ]);
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

        return response()->json([
            'success' => true,
            'data' => $topup
        ]);
    }

    // POST /topups
    public function store(Request $request)
    {
        $topup = Topup::create([
            'provider' => $request->provider,
            'nominal' => $request->nominal,
            'status' => $request->status,
        ]);

        return response()->json([
            'success' => true,
            'data' => $topup
        ]);
    }
}