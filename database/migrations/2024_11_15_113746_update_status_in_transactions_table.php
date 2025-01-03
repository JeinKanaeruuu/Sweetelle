<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->enum('status', ['Diproses', 'Dikirim', 'Diterima', 'Dibatalkan'])->default('Diproses')->change();
        });
    }

    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->enum('status', ['Diproses', 'Dikirim', 'Diterima'])->default('Diproses')->change();
        });
    }
};
