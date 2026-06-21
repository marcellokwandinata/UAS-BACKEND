<?php

namespace App\Http\Controllers;

use App\Models\Saving;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SavingController extends Controller
{
    public function index()
    {
        $savings = Saving::where('user_id', Auth::id())->get();

        return view('Saving.index', compact('savings'));
    }

    public function create()
    {
        return view('Saving.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'saving_name' => 'required|string|max:255',
            'target_amount' => 'required|numeric|min:1',
            'target_date' => 'nullable|date',
        ]);

        Saving::create([
            'user_id' => Auth::id(),
            'saving_name' => $request->saving_name,
            'target_amount' => $request->target_amount,
            'current_amount' => 0,
            'target_date' => $request->target_date,
        ]);

        return redirect()
            ->route('saving.index')
            ->with('success', 'Tabungan berhasil dibuat.');
    }

    public function show($id)
    {
        $saving = Saving::findOrFail($id);

        if ($saving->user_id != Auth::id()) {
            abort(403);
        }

        return view('Saving.show', compact('saving'));
    }

    public function edit($id)
    {
        $saving = Saving::findOrFail($id);

        if ($saving->user_id != Auth::id()) {
            abort(403);
        }

        return view('Saving.edit', compact('saving'));
    }

    public function update(Request $request, $id)
    {
        $saving = Saving::findOrFail($id);

        if ($saving->user_id != Auth::id()) {
            abort(403);
        }

        $request->validate([
            'saving_name' => 'required|string|max:255',
            'target_amount' => 'required|numeric|min:1',
            'target_date' => 'nullable|date',
        ]);

        $saving->update([
            'saving_name' => $request->saving_name,
            'target_amount' => $request->target_amount,
            'target_date' => $request->target_date,
        ]);

        return redirect()
            ->route('saving.show', $saving->id)
            ->with('success', 'Tabungan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $saving = Saving::findOrFail($id);

        if ($saving->user_id != Auth::id()) {
            abort(403);
        }

        $saving->delete();

        return redirect()
            ->route('saving.index')
            ->with('success', 'Tabungan berhasil dihapus.');
    }

    public function deposit(Request $request, $id)
    {
        $saving = Saving::findOrFail($id);

        if ($saving->user_id != Auth::id()) {
            abort(403);
        }

        $request->validate([
            'amount' => 'required|numeric|min:1000',
        ]);

        DB::transaction(function () use ($saving, $request) {
            $saving->increment('current_amount', $request->amount);
        });

        return redirect()
            ->route('saving.show', $saving->id)
            ->with('success', 'Dana berhasil ditambahkan.');
    }
}