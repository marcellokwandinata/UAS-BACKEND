<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class transaction extends Model
{
    // 1. Tentukan nama tabel di database secara eksplisit (opsional, untuk mencegah error typo jika nama class menggunakan huruf kecil)
    protected $table = 'transactions';

    // 2. Mass Assignment: Daftarkan kolom yang boleh diisi saat melakukan insert/create data
    protected $fillable = [
        'user_id',            // ID nasabah yang melakukan transaksi/pemilik rekening
        'type',               // Jenis: 'deposit' (top up), 'withdrawal' (tarik tunai), atau 'transfer'
        'amount',             // Nominal uang transaksi
        'recipient_account',  // Nomor rekening tujuan (jika jenis transaksinya adalah transfer)
        'description',        // Catatan atau keterangan transaksi (misal: "Bayar uang kos")
        'status',             // Status transaksi: 'pending', 'success', atau 'failed'
    ];

    // 3. Casting Data (Opsion  al tapi direkomendasikan): Mengubah tipe data field secara otomatis saat dipanggil di Laravel
    protected $casts = [
        'amount' => 'decimal:2', // Memastikan nominal uang dibaca sebagai desimal/float
    ];

    /**
     * RELASI: Menghubungkan Transaksi ke User (Nasabah Pengirim)
     * Artinya: Setiap 1 transaksi, pasti dimiliki oleh 1 User.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * RELASI TAMBAHAN (Opsional): Menghubungkan Transaksi ke User Penerima (Jika sesama pengguna bank tersebut)
     * Relasi ini berguna jika kamu ingin menampilkan NAMA penerima di riwayat transaksi, bukan cuma nomor rekeningnya.
     * Syaratnya: Di tabel users kelompokmu harus ada kolom 'account_number'.
     */
    public function recipient(): BelongsTo
    {
        return $this->belongsTo(User::class, 'recipient_account', 'account_number');
    }
}
