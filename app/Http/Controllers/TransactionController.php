<?php

namespace App\Http\Controllers;

use App\Models\transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    /**
     * Helper to get authenticated user or fallback to user_id parameter for testing/development.
     */
    private function resolveUser(Request $request): ?User
    {
        $user = auth()->user();
        if (! $user) {
            $userId = $request->input('user_id') ?: $request->header('X-User-Id');
            if ($userId) {
                $user = User::find($userId);
            }
        }

        return $user;
    }

    /**
     * Tampilkan riwayat transaksi pengguna.
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        
        // Jika tidak authenticated, check untuk API fallback
        if (! $user) {
            $userId = $request->input('user_id') ?: $request->header('X-User-Id');
            if ($userId) {
                $user = User::find($userId);
            }
        }

        // Jika masih tidak ada user, return error
        if (! $user) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'User tidak terautentikasi atau user_id tidak valid.',
                ], 401);
            }
            return redirect()->route('login');
        }

        // Ambil transaksi di mana user merupakan pengirim atau penerima transfer
        $transactions = transaction::where(function ($query) use ($user) {
            $query->where('user_id', $user->id)
                ->orWhere('recipient_account', $user->account_number);
        })
            ->with(['user', 'recipient'])
            ->orderBy('created_at', 'desc')
            ->get();

        // Return JSON jika request adalah API
        if ($request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Riwayat transaksi berhasil diambil.',
                'data' => $transactions,
            ]);
        }

        // Return view untuk web
        return view('Transaction.index', compact('transactions'));
    }

    /**
     * Tampilkan form transfer.
     */
    public function transferForm(Request $request)
    {
        // if (! auth()->check()) {
        //     return redirect()->route('login');
        // }
         $accountNumber = $request->account_number;
         return view('Transaction.transfer', compact('accountNumber'));
        //return view('Transaction.transfer');
    }

    /**
     * Melakukan Deposit / Top Up Saldo.
     */
    public function deposit(Request $request)
    {
        $user = $this->resolveUser($request);
        if (! $user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User tidak terautentikasi atau user_id tidak valid.',
            ], 401);
        }

        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric|min:1000',
            'description' => 'nullable|string|max:255',
        ], [
            'amount.required' => 'Nominal deposit wajib diisi.',
            'amount.numeric' => 'Nominal deposit harus berupa angka.',
            'amount.min' => 'Nominal deposit minimal adalah Rp 1.000.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validasi gagal.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $amount = $request->input('amount');
        $description = $request->input('description') ?: 'Deposit / Top Up Saldo';

        try {
            $transaction = DB::transaction(function () use ($user, $amount, $description) {
                // Update saldo user
                $user->balance += $amount;
                $user->save();

                // Catat transaksi
                return transaction::create([
                    'user_id' => $user->id,
                    'type' => 'deposit',
                    'amount' => $amount,
                    'recipient_account' => null,
                    'description' => $description,
                    'status' => 'success',
                ]);
            });

            return response()->json([
                'status' => 'success',
                'message' => 'Deposit berhasil dilakukan.',
                'data' => [
                    'transaction' => $transaction,
                    'new_balance' => $user->balance,
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan sistem saat memproses deposit.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Melakukan Penarikan Tunai / Withdrawal.
     */
    public function withdraw(Request $request)
    {
        $user = $this->resolveUser($request);
        if (! $user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User tidak terautentikasi atau user_id tidak valid.',
            ], 401);
        }

        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric|min:1000',
            'description' => 'nullable|string|max:255',
        ], [
            'amount.required' => 'Nominal penarikan wajib diisi.',
            'amount.numeric' => 'Nominal penarikan harus berupa angka.',
            'amount.min' => 'Nominal penarikan minimal adalah Rp 1.000.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validasi gagal.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $amount = $request->input('amount');
        $description = $request->input('description') ?: 'Tarik Tunai';

        if ($user->balance < $amount) {
            return response()->json([
                'status' => 'error',
                'message' => 'Saldo tidak mencukupi untuk melakukan penarikan tunai.',
            ], 400);
        }

        try {
            $transaction = DB::transaction(function () use ($user, $amount, $description) {
                // Kurangi saldo user
                $user->balance -= $amount;
                $user->save();

                // Catat transaksi
                return transaction::create([
                    'user_id' => $user->id,
                    'type' => 'withdrawal',
                    'amount' => $amount,
                    'recipient_account' => null,
                    'description' => $description,
                    'status' => 'success',
                ]);
            });

            return response()->json([
                'status' => 'success',
                'message' => 'Penarikan tunai berhasil dilakukan.',
                'data' => [
                    'transaction' => $transaction,
                    'new_balance' => $user->balance,
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan sistem saat memproses penarikan tunai.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Melakukan Transfer Saldo ke Rekening Lain.
     */
    public function transfer(Request $request)
    {
        $user = auth()->user();
        if (! $user) {
            $userId = $request->input('user_id') ?: $request->header('X-User-Id');
            if ($userId) {
                $user = User::find($userId);
            }
        }

        if (! $user) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'User tidak terautentikasi atau user_id tidak valid.',
                ], 401);
            }
            return redirect()->route('login');
        }

        $validator = Validator::make($request->all(), [
            'recipient_account' => 'required|string',
            'amount' => 'required|numeric|min:1000',
            'description' => 'nullable|string|max:255',
        ], [
            'recipient_account.required' => 'Nomor rekening tujuan wajib diisi.',
            'amount.required' => 'Nominal transfer wajib diisi.',
            'amount.numeric' => 'Nominal transfer harus berupa angka.',
            'amount.min' => 'Nominal transfer minimal adalah Rp 1.000.',
        ]);

        if ($validator->fails()) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validasi gagal.',
                    'errors' => $validator->errors(),
                ], 422);
            }
            return back()->withErrors($validator)->withInput();
        }

        $recipientAccount = $request->input('recipient_account');
        $amount = $request->input('amount');
        $description = $request->input('description') ?: 'Transfer Saldo';

        // Cek apakah transfer ke diri sendiri
        if ($recipientAccount === $user->account_number) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Tidak dapat melakukan transfer ke rekening sendiri.',
                ], 400);
            }
            return back()->withErrors(['recipient_account' => 'Tidak dapat melakukan transfer ke rekening sendiri.'])->withInput();
        }

        // Cek apakah nomor rekening penerima ada
        $recipient = User::where('account_number', $recipientAccount)->first();
        if (! $recipient) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Nomor rekening tujuan tidak ditemukan.',
                ], 404);
            }
            return back()->withErrors(['recipient_account' => 'Nomor rekening tujuan tidak ditemukan.'])->withInput();
        }

        // Cek kecukupan saldo
        if ($user->balance < $amount) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Saldo tidak mencukupi untuk melakukan transfer.',
                ], 400);
            }
            return back()->withErrors(['amount' => 'Saldo tidak mencukupi untuk melakukan transfer.'])->withInput();
        }

        try {
            $transaction = DB::transaction(function () use ($user, $recipient, $amount, $description, $recipientAccount) {
                // Kurangi saldo pengirim
                $user->balance -= $amount;
                $user->save();

                // Tambah saldo penerima
                $recipient->balance += $amount;
                $recipient->save();

                // Catat transaksi transfer
                return transaction::create([
                    'user_id' => $user->id,
                    'type' => 'transfer',
                    'amount' => $amount,
                    'recipient_account' => $recipientAccount,
                    'description' => $description,
                    'status' => 'success',
                ]);
            });

            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Transfer berhasil dilakukan.',
                    'data' => [
                        'transaction' => $transaction,
                        'new_balance' => $user->balance,
                    ],
                ]);
            }

            return redirect()->route('transfer.form')
                ->with('success', 'Transfer berhasil dilakukan. Saldo Anda sekarang: Rp ' . number_format($user->balance, 0, ',', '.'));
        } catch (\Exception $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Terjadi kesalahan sistem saat memproses transfer.',
                    'error' => $e->getMessage(),
                ], 500);
            }
            return back()->withErrors(['error' => 'Terjadi kesalahan sistem saat memproses transfer.'])->withInput();
        }
    }

    /**
     * Tampilkan detail transaksi spesifik.
     */
    public function show(Request $request, $id)
    {
        $user = $this->resolveUser($request);
        if (! $user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User tidak terautentikasi atau user_id tidak valid.',
            ], 401);
        }

        $transaction = transaction::with(['user', 'recipient'])->find($id);

        if (! $transaction) {
            return response()->json([
                'status' => 'error',
                'message' => 'Transaksi tidak ditemukan.',
            ], 404);
        }

        // Cek apakah user berhak melihat transaksi ini (pemilik atau penerima transfer)
        $isOwner = $transaction->user_id === $user->id;
        $isRecipient = $transaction->recipient_account === $user->account_number;

        if (! $isOwner && ! $isRecipient) {
            return response()->json([
                'status' => 'error',
                'message' => 'Anda tidak memiliki hak untuk melihat detail transaksi ini.',
            ], 403);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Detail transaksi berhasil diambil.',
            'data' => $transaction,
        ]);
    }

    /**
     * Tampilkan saldo dan info rekening saat ini.
     */
    public function balance(Request $request)
    {
        $user = $this->resolveUser($request);
        if (! $user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User tidak terautentikasi atau user_id tidak valid.',
            ], 401);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Informasi saldo berhasil diambil.',
            'data' => [
                'name' => $user->name,
                'account_number' => $user->account_number,
                'balance' => $user->balance,
            ],
        ]);
    }
}
