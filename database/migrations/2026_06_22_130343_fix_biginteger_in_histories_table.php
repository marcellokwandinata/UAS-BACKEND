<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
{
    Schema::table('histories', function (Blueprint $table) {
        $table->bigInteger('balance_after')->unsigned()->change();
        $table->bigInteger('amount')->unsigned()->change();
    });
}

public function down(): void
{
    Schema::table('histories', function (Blueprint $table) {
        $table->integer('balance_after')->unsigned()->change();
        $table->integer('amount')->unsigned()->change();
    });
}
    
};
