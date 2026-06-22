<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\LoginHistory;

class SecurityController extends Controller
{
    public function index()
    {
        $securities = DB::table('securities')->get();
        return view('security_index', compact('securities'));
    }

    public function create()
    {
        return view('create_security');
    }

    public function show($id)
    {
        $security = DB::table('securities')->where('id', $id)->first();
        if (!$security) abort(404);
        return view('security_show', compact('security'));
    }

    public function store(Request $request)
    {
        DB::table('securities')->insert([
            'user_id'    => auth()->id(),
            'name'       => $request->name,
            'type'       => $request->type,
            'status'     => $request->status,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect('/securities')->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $security = DB::table('securities')->where('id', $id)->first();
        if (!$security) abort(404);
        return view('security_edit', compact('security'));
    }

    public function update(Request $request, $id)
    {
        DB::table('securities')->where('id', $id)->update([
            'name'       => $request->name,
            'type'       => $request->type,
            'status'     => $request->status,
            'updated_at' => now(),
        ]);

        return redirect('/securities')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        DB::table('securities')->where('id', $id)->delete();
        return redirect('/securities')->with('success', 'Data berhasil dihapus.');
    }

    public function pinEdit()
    {
        $pinSecurity = DB::table('securities')
            ->where('user_id', Auth::id())
            ->where('type', 'pin')
            ->first();

        return view('security_pin_edit', compact('pinSecurity'));
    }

    public function pinUpdate(Request $request)
    {
        $request->validate([
            'pin' => 'required|digits:6|confirmed',
        ]);

        $existing = DB::table('securities')
            ->where('user_id', Auth::id())
            ->where('type', 'pin')
            ->first();

        if ($existing) {
            DB::table('securities')->where('id', $existing->id)->update([
                'name'       => Hash::make($request->pin),
                'status'     => 'aktif',
                'updated_at' => now(),
            ]);
        } else {
            DB::table('securities')->insert([
                'user_id'    => Auth::id(),
                'name'       => Hash::make($request->pin),
                'type'       => 'pin',
                'status'     => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return redirect('/securities')->with('success', 'PIN berhasil diperbarui.');
    }

    public function loginHistory()
    {
        $histories = DB::table('login_histories')
            ->where('user_id', Auth::id())
            ->orderBy('logged_in_at', 'desc')
            ->paginate(10);

        return view('securities.login_history', compact('histories'));
    }

    public static function recordLogin(Request $request)
    {
        DB::table('login_histories')->insert([
            'user_id'    => Auth::id(),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'status'     => 'berhasil',
            'logged_in_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function verifyPin(Request $request)
    {
        $request->validate([
            'pin' => 'required|digits:6',
        ]);

        $pinRecord = DB::table('securities')
            ->where('user_id', Auth::id())
            ->where('type', 'pin')
            ->where('status', 'aktif')
            ->first();

        // Cek apakah user sudah punya PIN
        if (!$pinRecord) {
            return back()->withErrors(['pin' => 'PIN belum diatur. Silakan atur PIN terlebih dahulu.']);
        }

        // Verifikasi PIN
        if (!Hash::check($request->pin, $pinRecord->name)) {
            return back()->withErrors(['pin' => 'PIN yang Anda masukkan salah.']);
        }

        session(['pin_verified' => true, 'pin_verified_at' => now()->timestamp]);

        $redirect = $request->input('redirect', '/transaction');

        return redirect($redirect)->with('success', 'PIN berhasil diverifikasi.');
    }

    public function verifyPinForm(Request $request)
    {
        $redirect = $request->query('redirect', '/transaction');
        return view('securities.verify_pin', compact('redirect'));
    }
}