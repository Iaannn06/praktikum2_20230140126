<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryApiController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        
        return response()->json([
            'message' => 'Daftar kategori berhasil diambil',
            'data' => $categories
        ], 200);
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255'
            ]);

            $category = Category::create($validated);

            return response()->json([
                'message' => 'Kategori berhasil ditambahkan',
                'data' => $category
            ], 201);
            
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Gagal menambah kategori',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json(['message' => 'Kategori tidak ditemukan'], 404);
        }

        return response()->json([
            'message' => 'Detail kategori berhasil diambil',
            'data' => $category
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json(['message' => 'Kategori tidak ditemukan'], 404);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $category->update($validated);

        return response()->json([
            'message' => 'Kategori berhasil diupdate',
            'data' => $category
        ], 200);
    }


    public function destroy($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json(['message' => 'Kategori tidak ditemukan'], 404);
        }

        $category->delete();

        return response()->json([
            'message' => 'Kategori berhasil dihapus'
        ], 200);
    }
}