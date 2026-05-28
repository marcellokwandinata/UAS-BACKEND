<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    // GET /histories
    public function index()
    {
        $histories = History::all();

        return response()->json([
            'success' => true,
            'data' => $histories
        ]);
    }

    // GET /histories/{id}
    public function show($id)
    {
        $history = History::find($id);

        if (!$history) {
            return response()->json([
                'success' => false,
                'message' => 'Maaf, History tidak ditemukan..'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $history
        ]);
    }

    // POST /histories
    public function store(Request $request)
    {
        $history = History::create([
            'title' => $request->title,
            'description' => $request->description,
            'amount' => $request->amount,
        ]);

        return response()->json([
            'success' => true,
            'data' => $history
        ]);
    }

    // DELETE /histories/{id}
    public function destroy($id)
    {
        $history = History::find($id);

        if (!$history) {
            return response()->json([
                'success' => false,
                'message' => 'Maaf, History tidak ditemukan..'
            ], 404);
        }

        $history->delete();

        return response()->json([
            'success' => true,
            'message' => 'History berhasil dihapus!'
        ]);
    }
}