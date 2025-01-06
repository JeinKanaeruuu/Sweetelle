<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('cashier_histories', function (Blueprint $table) {
            // Menambahkan kolom transaction_id
            $table->string('transaction_id')->nullable()->after('id'); // Kolom ini setelah kolom id
        });
    }

    public function down()
    {
        Schema::table('cashier_histories', function (Blueprint $table) {
            // Menghapus kolom transaction_id jika rollback migration
            $table->dropColumn('transaction_id');
        });
    }
};
