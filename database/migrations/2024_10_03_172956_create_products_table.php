<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image')->nullable();
            $table->text('description');
            $table->integer('stock');
            $table->decimal('price', 10, 2);
            $table->decimal('discount_percentage', 5, 2)->default(0); // kolom diskon
            $table->date('start_date')->nullable(); // tanggal mulai diskon
            $table->date('end_date')->nullable(); // tanggal berakhir diskon
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
