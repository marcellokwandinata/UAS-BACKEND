<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Kita ganti 'create' menjadi 'table' untuk menambahkan kolom ke tabel users yang sudah ada
        Schema::table('users', function (Blueprint $table) {
            // Kolom email dan password tidak perlu ditulis lagi karena sudah dibuat di file asli
            
            // Ubah kolom name bawaan laravel agar sesuai dengan keinginanmu jika diperlukan, 
            // atau tambahkan saja kolom full_name dan account_number yang baru:
            if (!Schema::hasColumn('users', 'full_name')) {
                $table->string('full_name')->after('id');
            }
            
            if (!Schema::hasColumn('users', 'account_number')) {
                $table->string('account_number')->nullable()->after('password');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Logika untuk menghapus kolom jika migrasi di-rollback
            $table->dropColumn(['full_name', 'account_number']);
        });
    }
};