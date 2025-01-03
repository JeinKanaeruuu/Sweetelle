<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
// database/migrations/xxxx_xx_xx_xxxxxx_add_discount_to_products_table.php
public function up()
{
    Schema::table('products', function (Blueprint $table) {
        $table->decimal('discount_percentage', 5, 2)->default(0)->after('price'); // menambahkan kolom diskon
        $table->date('start_date')->nullable()->after('discount_percentage'); // menambahkan kolom tanggal mulai
        $table->date('end_date')->nullable()->after('start_date'); // menambahkan kolom tanggal berakhir
    });
}

public function down()
{
    Schema::table('products', function (Blueprint $table) {
        $table->dropColumn(['discount_percentage', 'start_date', 'end_date']); // menghapus kolom jika rollback
    });
}

};
