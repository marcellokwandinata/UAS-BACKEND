<?php

namespace App\Http\Controllers;

use App\Models\Beneficiary;
use App\Models\User;
use Illuminate\Http\Request;

class BeneficiaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $beneficiaries = Beneficiary::all();

        return view(
            'beneficiaries.index',
            compact('beneficiaries')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('beneficiaries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'account_number' => 'required',
        'beneficiary_name' => 'required'
    ]);

    $userTujuan = User::where('account_number', $request->account_number)->first();

    if (!$userTujuan) {
        return back()
            ->withInput()
            ->with('error', 'Nomor rekening tidak ditemukan.');
    }

    Beneficiary::create([
        'user_id' => auth()->id(),
        'account_number' => $userTujuan->account_number,
        'beneficiary_name' => $userTujuan->full_name
    ]);

    return redirect()
        ->route('beneficiaries.index')
        ->with('success', 'Beneficiary berhasil ditambahkan.');
}

    /**
     * Display the specified resource.
     */
    public function show(Beneficiary $beneficiary)
    {
        return view('beneficiaries.show', compact('beneficiary'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Beneficiary $beneficiary)
    {
        return view('beneficiaries.edit', compact('beneficiary'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Beneficiary $beneficiary)
    {
        $request->validate([
            'beneficiary_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:255',
        ]);

        $beneficiary->update(
            $request->only('beneficiary_name', 'account_number')
        );

        return redirect()
            ->route('beneficiaries.index')
            ->with('success', 'Beneficiary updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Beneficiary $beneficiary)
    {
        $beneficiary->delete();

        return redirect()
            ->route('beneficiaries.index')
            ->with('success', 'Beneficiary deleted successfully');
    }
}