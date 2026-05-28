<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
     // halaman list
    // GET /histories
    public function index()
    {
        $histories = History::all();

        return view('list_history', compact('histories'));
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

        return view('list_history', compact('histories'));
    }

    // POST /histories
    public function store(Request $request)
    {
        $history = History::create([
            'title' => $request->title,
            'description' => $request->description,
            'amount' => $request->amount,
        ]);

        return redirect('/histories');
    }

    // DELETE /histories/{id}
    public function destroy($id)
    {
        $history = History::find($id);

        if ($history) {
        $history->delete();
        }

        return redirect('/histories');
    }
}