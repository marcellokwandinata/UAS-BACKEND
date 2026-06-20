<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('securities', function (Blueprint $table) {
            $table->string('user_id')->nullable()->after('id');
            $table->string('name')->nullable()->after('user_id');
            $table->string('type')->nullable()->after('name');
            $table->string('status')->default('aktif')->after('type');
        });
    }

    public function down(): void
    {
        Schema::table('securities', function (Blueprint $table) {
            $table->dropColumn(['user_id', 'name', 'type', 'status']);
        });
    }
};