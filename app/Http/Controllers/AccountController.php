<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $accounts = Account::all();

        return view('accounts.index', compact('accounts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('accounts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'account_number' => 'required|string|max:255|unique:accounts',
            'account_name' => 'required|string|max:255',
            'balance' => 'required|numeric',
            'account_type' => 'required|string|max:255',
        ]);

        Account::create($request->only(
            'user_id',
            'account_number',
            'balance',
            'account_name',
            'account_type'
        ));

        return redirect()
            ->route('accounts.index')
            ->with('success', 'Account created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Account $account)
    {
        return view('accounts.show', compact('account'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Account $account)
    {
        return view('accounts.edit', compact('account'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Account $account)
    {
        $request->validate([
            'account_number' => 'required|string|max:255',
            'balance' => 'required|numeric',
            'account_name' => 'required|string|max:255',
            'account_type' => 'required|string|max:255',
        ]);

        $account->update($request->only(
            'account_number',
            'balance',
            'account_name',
            'account_type'
        ));

        return redirect()
            ->route('accounts.index')
            ->with('success', 'Account updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Account $account)
    {
        $account->delete();

        return redirect()
            ->route('accounts.index')
            ->with('success', 'Account deleted successfully');
    }
}