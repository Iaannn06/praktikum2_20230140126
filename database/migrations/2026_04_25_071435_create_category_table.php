<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
  public function up(): void // Membuat tabel 'category'
{
    Schema::create('category', function (Blueprint $table) { // Membuat tabel 'category' dengan kolom 'id', 'name', dan timestamps
        $table->id(); // Kolom 'id' sebagai primary key dengan auto-increment
        $table->string('name')->unique(); // Kolom 'name' untuk menyimpan nama kategori, dengan constraint unik
        $table->timestamps(); // Kolom 'created_at' dan 'updated_at' untuk mencatat waktu pembuatan dan pembaruan data
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category');
    }
};
