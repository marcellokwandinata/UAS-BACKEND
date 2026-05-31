<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    // halaman list history
    // GET /histories
    public function index()
    {
        if ($request->id) {
            $histories = History::where('id', $request->id)
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            $histories = History::orderBy('created_at', 'desc')
                ->get();
        }

        return view('list_history', compact('histories'));
    }

    // detail history
    public function show($id)
    {
        $history = History::find($id);

        if (!$history) {
            return redirect('/histories')
                ->with('error', 'Data tidak ditemukan!');
        }

        return view('history_detail', compact('history'));
    }
}

  