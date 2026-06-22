<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up(): void
{
    Schema::table('cards', function (Blueprint $table) {
        if (!Schema::hasColumn('cards', 'user_id')) {
            $table->unsignedBigInteger('user_id')->nullable()->after('id');
        }
    });
}
    public function down(): void
    {
    Schema::table('cards', function (Blueprint $table) {
        $table->dropForeign(['user_id']);
        $table->dropColumn('user_id');
    });
}
};
