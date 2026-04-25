<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model // Model untuk tabel 'category'
{
    use HasFactory;  // Menggunakan trait HasFactory untuk mendukung fitur factory pada model ini
    protected $table = 'category';  // Menentukan nama tabel yang digunakan oleh model ini, yaitu 'category'
    
    protected $guarded = ['id']; // Menentukan kolom yang tidak boleh diisi secara massal, dalam hal ini 'id' yang merupakan primary key

    public function products() // Mendefinisikan relasi one-to-many antara Category dan Product, dimana satu kategori dapat memiliki banyak produk
    {
        return $this->hasMany(Product::class); // Mengembalikan relasi hasMany yang menghubungkan model Category dengan model Product
    }
}