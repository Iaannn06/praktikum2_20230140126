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
    ];

    // (Kalau ada relasi ke tabel User, biarin aja di bawahnya)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}