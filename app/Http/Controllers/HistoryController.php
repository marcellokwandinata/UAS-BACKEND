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
            return redirect('/histories')
                ->with('error', 'ID tidak ditemukan!');
        }

        return view('list_history', [
            'histories' => [$history]
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

        return redirect('/histories');
    }

    // DELETE /histories/{id}
    public function destroy($id)
    {
        $history = History::find($id);

        if ($history) {
            $history->delete();

            return redirect('/histories')
                ->with('success', 'Data berhasil dihapus!');
        }

        return redirect('/histories')
            ->with('error', 'Data tidak ditemukan!');
    }
}