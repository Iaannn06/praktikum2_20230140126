<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
     public function up(): void // Menambahkan kolom 'category_id' pada tabel 'products' dan mengatur relasi dengan tabel 'category'
{
    Schema::table('products', function (Blueprint $table) { // Menambahkan kolom 'category_id' sebagai foreign key yang mengacu pada tabel 'category'
        $table->foreignId('category_id')->nullable()->after('user_id')->constrained('category')->cascadeOnDelete(); // Menambahkan kolom 'category_id' yang dapat bernilai null, diletakkan setelah kolom 'user_id', dan mengatur relasi dengan tabel 'category' serta menghapus data produk jika kategori dihapus
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product', function (Blueprint $table) {
            //
        });
    }
};
