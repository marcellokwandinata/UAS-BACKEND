<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up(): void
{
    Schema::table('cards', function (Blueprint $table) {
        $table->string('cardholder_name')->nullable()->after('user_id');
        $table->string('card_type')->nullable()->after('cardholder_name');
        $table->string('expired_at')->nullable()->after('card_type');
        $table->decimal('card_limit', 15, 2)->nullable()->after('expired_at');
        $table->string('status')->default('aktif')->after('card_limit');
    });
}

public function down(): void
{
    Schema::table('cards', function (Blueprint $table) {
        $table->dropColumn(['cardholder_name', 'card_type', 'expired_at', 'card_limit', 'status']);
    });
}
};
