<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // tampil semua user
    public function index()
    {
        $users = User::all();

        return view('users.index', compact('users'));
    }

    // form tambah user
    public function create()
    {
        return view('users.create');
    }

    // simpan user baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        return redirect()->route('users.index')
            ->with('success', 'User berhasil ditambahkan');
    }

    // detail user
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    // form edit user
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    // update user
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('users.index')
            ->with('success', 'User berhasil diupdate');
    }

    // hapus user
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'User berhasil dihapus');
    }
}

