<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        return "Hi, admin! Kamu bisa mengelola kategori produk di sini.";
    }
}