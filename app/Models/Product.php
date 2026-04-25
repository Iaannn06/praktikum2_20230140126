<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Tambahin blok kode ini bro!
    protected $fillable = [
        'name',
        'qty',
        'price',
        'user_id',
        'category_id',
    ];

    // (Kalau ada relasi ke tabel User, biarin aja di bawahnya)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category() // Mendefinisikan relasi many-to-one antara Product dan Category, dimana banyak produk dapat dimiliki oleh satu kategori
    {
        return $this->belongsTo(Category::class); // Mengembalikan relasi belongsTo yang menghubungkan model Product dengan model Category
    }
}