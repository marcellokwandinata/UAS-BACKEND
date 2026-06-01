<?php

use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Berikut adalah route API untuk aplikasi Digital Banking.
| Mengakomodasi kebutuhan deposit, tarik tunai (withdrawal), transfer,
| serta riwayat transaksi nasabah.
|
*/

Route::prefix('transactions')->group(function () {
    Route::post('/deposit', [TransactionController::class, 'deposit'])->name('transactions.deposit');
    Route::post('/withdraw', [TransactionController::class, 'withdraw'])->name('transactions.withdraw');
    Route::post('/transfer', [TransactionController::class, 'transfer'])->name('transactions.transfer');
    Route::get('/', [TransactionController::class, 'index'])->name('transactions.index');
    Route::get('/{id}', [TransactionController::class, 'show'])->name('transactions.show');
});

Route::get('/balance', [TransactionController::class, 'balance'])->name('balance');
