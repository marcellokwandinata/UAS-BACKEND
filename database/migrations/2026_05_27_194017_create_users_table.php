<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'name') && !Schema::hasColumn('users', 'full_name')) {
                $table->renameColumn('name', 'full_name');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'full_name') && !Schema::hasColumn('users', 'name')) {
                $table->renameColumn('full_name', 'name');
            }
        });
    }
};