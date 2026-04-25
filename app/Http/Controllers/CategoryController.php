<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('products')->get();
        return view('category.index', compact('categories'));
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:category,name'
        ]);

        Category::create(['name' => $request->name]);

        return redirect()->route('category.index')->with('success', 'Kategori berhasil ditambahkan!');
    }



    public function edit(Category $category)
    {
        return view('category.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:category,name,' . $category->id
        ]);

        $category->update(['name' => $request->name]);
        return redirect()->route('category.index')->with('success', 'Kategori berhasil diupdate!');
    }

    public function destroy(Category $category)
    {
    
        if ($category->products()->count() > 0) {
            return redirect()->back()->with('error', 'Gagal hapus! Masih ada produk di kategori ini.');
        }

        $category->delete();
        return redirect()->route('category.index')->with('success', 'Kategori berhasil dihapus!');
    }
}