<?php

namespace Tests\Feature;

use App\Models\transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TransactionTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test mendapatkan informasi saldo saat ini.
     */
    public function test_user_can_get_balance(): void
    {
        $user = User::factory()->create([
            'balance' => 500000.00,
        ]);

        // Menggunakan header X-User-Id sebagai fallback simulasi autentikasi
        $response = $this->getJson('/api/balance', [
            'X-User-Id' => $user->id,
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'status' => 'success',
                'message' => 'Informasi saldo berhasil diambil.',
                'data' => [
                    'name' => $user->name,
                    'account_number' => $user->account_number,
                    'balance' => 500000.00,
                ],
            ]);
    }

    /**
     * Test deposit berhasil.
     */
    public function test_user_can_deposit(): void
    {
        $user = User::factory()->create([
            'balance' => 10000.00,
        ]);

        $response = $this->postJson('/api/transactions/deposit', [
            'amount' => 50000.00,
            'description' => 'Top Up Bulanan',
        ], [
            'X-User-Id' => $user->id,
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'status' => 'success',
                'message' => 'Deposit berhasil dilakukan.',
                'data' => [
                    'new_balance' => 60000.00,
                ],
            ]);

        $user->refresh();
        $this->assertEquals(60000.00, $user->balance);

        // Pastikan transaksi tercatat
        $this->assertDatabaseHas('transactions', [
            'user_id' => $user->id,
            'type' => 'deposit',
            'amount' => 50000.00,
            'description' => 'Top Up Bulanan',
            'status' => 'success',
        ]);
    }

    /**
     * Test validasi deposit.
     */
    public function test_deposit_validation(): void
    {
        $user = User::factory()->create();

        // Nominal kurang dari Rp 1.000
        $response = $this->postJson('/api/transactions/deposit', [
            'amount' => 500,
        ], [
            'X-User-Id' => $user->id,
        ]);

        $response->assertStatus(422)
            ->assertJson([
                'status' => 'error',
                'message' => 'Validasi gagal.',
            ]);
    }

    /**
     * Test penarikan tunai berhasil.
     */
    public function test_user_can_withdraw(): void
    {
        $user = User::factory()->create([
            'balance' => 100000.00,
        ]);

        $response = $this->postJson('/api/transactions/withdraw', [
            'amount' => 40000.00,
            'description' => 'Tarik di ATM',
        ], [
            'X-User-Id' => $user->id,
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'status' => 'success',
                'message' => 'Penarikan tunai berhasil dilakukan.',
                'data' => [
                    'new_balance' => 60000.00,
                ],
            ]);

        $user->refresh();
        $this->assertEquals(60000.00, $user->balance);

        // Pastikan transaksi tercatat
        $this->assertDatabaseHas('transactions', [
            'user_id' => $user->id,
            'type' => 'withdrawal',
            'amount' => 40000.00,
            'description' => 'Tarik di ATM',
            'status' => 'success',
        ]);
    }

    /**
     * Test penarikan tunai gagal karena saldo kurang.
     */
    public function test_withdraw_fails_due_to_insufficient_balance(): void
    {
        $user = User::factory()->create([
            'balance' => 20000.00,
        ]);

        $response = $this->postJson('/api/transactions/withdraw', [
            'amount' => 30000.00,
        ], [
            'X-User-Id' => $user->id,
        ]);

        $response->assertStatus(400)
            ->assertJson([
                'status' => 'error',
                'message' => 'Saldo tidak mencukupi untuk melakukan penarikan tunai.',
            ]);
    }

    /**
     * Test transfer berhasil.
     */
    public function test_user_can_transfer(): void
    {
        $sender = User::factory()->create([
            'balance' => 150000.00,
        ]);

        $recipient = User::factory()->create([
            'balance' => 50000.00,
        ]);

        $response = $this->postJson('/api/transactions/transfer', [
            'recipient_account' => $recipient->account_number,
            'amount' => 50000.00,
            'description' => 'Bayar Buku',
        ], [
            'X-User-Id' => $sender->id,
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'status' => 'success',
                'message' => 'Transfer berhasil dilakukan.',
                'data' => [
                    'new_balance' => 100000.00,
                ],
            ]);

        $sender->refresh();
        $recipient->refresh();

        $this->assertEquals(100000.00, $sender->balance);
        $this->assertEquals(100000.00, $recipient->balance);

        // Pastikan transaksi tercatat
        $this->assertDatabaseHas('transactions', [
            'user_id' => $sender->id,
            'type' => 'transfer',
            'amount' => 50000.00,
            'recipient_account' => $recipient->account_number,
            'description' => 'Bayar Buku',
            'status' => 'success',
        ]);
    }

    /**
     * Test transfer gagal ke rekening sendiri.
     */
    public function test_transfer_fails_to_own_account(): void
    {
        $user = User::factory()->create([
            'balance' => 100000.00,
        ]);

        $response = $this->postJson('/api/transactions/transfer', [
            'recipient_account' => $user->account_number,
            'amount' => 20000.00,
        ], [
            'X-User-Id' => $user->id,
        ]);

        $response->assertStatus(400)
            ->assertJson([
                'status' => 'error',
                'message' => 'Tidak dapat melakukan transfer ke rekening sendiri.',
            ]);
    }

    /**
     * Test transfer gagal karena rekening tidak ditemukan.
     */
    public function test_transfer_fails_due_to_non_existent_account(): void
    {
        $user = User::factory()->create([
            'balance' => 100000.00,
        ]);

        $response = $this->postJson('/api/transactions/transfer', [
            'recipient_account' => '9999999999', // Rekening fiktif
            'amount' => 20000.00,
        ], [
            'X-User-Id' => $user->id,
        ]);

        $response->assertStatus(404)
            ->assertJson([
                'status' => 'error',
                'message' => 'Nomor rekening tujuan tidak ditemukan.',
            ]);
    }

    /**
     * Test mendapatkan riwayat transaksi (baik sebagai pengirim maupun penerima transfer).
     */
    public function test_user_can_view_transaction_history(): void
    {
        $userA = User::factory()->create();
        $userB = User::factory()->create();

        // Buat beberapa transaksi untuk userA
        transaction::create([
            'user_id' => $userA->id,
            'type' => 'deposit',
            'amount' => 100000.00,
            'status' => 'success',
            'description' => 'Deposit Awal',
        ]);

        transaction::create([
            'user_id' => $userA->id,
            'type' => 'transfer',
            'amount' => 30000.00,
            'recipient_account' => $userB->account_number,
            'status' => 'success',
            'description' => 'Bayar makan',
        ]);

        // Buat transfer dari userB ke userA
        transaction::create([
            'user_id' => $userB->id,
            'type' => 'transfer',
            'amount' => 15000.00,
            'recipient_account' => $userA->account_number,
            'status' => 'success',
            'description' => 'Kembalian',
        ]);

        // Ambil riwayat transaksi userA
        $response = $this->getJson('/api/transactions', [
            'X-User-Id' => $userA->id,
        ]);

        $response->assertStatus(200);
        $data = $response->json('data');

        // userA harus memiliki total 3 transaksi di riwayatnya
        $this->assertCount(3, $data);
    }
}
