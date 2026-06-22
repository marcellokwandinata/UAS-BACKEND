<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up(): void
{
    Schema::table('cards', function (Blueprint $table) {
        $columns = [
            'cardholder_name', 'expiry_date', 'cvv', 'card_type',
            'card_number', 'status', 'balance', 'pin'
        ];

        foreach ($columns as $column) {
            if (!Schema::hasColumn('cards', $column)) {
                match($column) {
                    'cardholder_name' => $table->string('cardholder_name')->nullable()->after('user_id'),
                    'expiry_date'     => $table->string('expiry_date')->nullable(),
                    'cvv'             => $table->string('cvv')->nullable(),
                    'card_type'       => $table->string('card_type')->nullable(),
                    'card_number'     => $table->string('card_number')->nullable(),
                    'status'          => $table->string('status')->nullable(),
                    'balance'         => $table->bigInteger('balance')->default(0),
                    'pin'             => $table->string('pin')->nullable(),
                    default           => null,
                };
            }
        }
    });
}

public function down(): void
{
    Schema::table('cards', function (Blueprint $table) {
        $table->dropColumn(['cardholder_name', 'card_type', 'expired_at', 'card_limit', 'status']);
    });
}
};
