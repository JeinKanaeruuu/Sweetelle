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
            $table->decimal('discount', 8, 2)->default(0); // Kolom diskon dengan tipe decimal
        });
    }
    
    public function down()
    {
        Schema::table('cashier_histories', function (Blueprint $table) {
            $table->dropColumn('discount');
        });
    }
};
