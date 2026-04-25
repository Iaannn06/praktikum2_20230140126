<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all(); // Bisa diakses Admin & User (Read-Only)
        return view('product.index', compact('products'));
    }

    public function create()
    {
        Gate::authorize('admin-only'); //hanya admin yang bisa akses form buat produk baru

        $categories = Category::all();
        return view('product.create', compact('categories'));
    }

    public function store(StoreProductRequest $request)
    {
        Gate::authorize('admin-only'); //admin yang boleh simpan produk baru

        $validated = $request->validated();
        $validated['user_id'] = auth()->id();

        Product::create($validated);

        return redirect()->route('product.index')->with('success', 'Product created successfully.');
    }

    public function show($id)
    {
        $product = Product::findOrFail($id); // Bisa diakses Admin & User (Read-Only)
        return view('product.view', compact('product'));
    }

    public function edit(Product $product)
    {
        Gate::authorize('admin-only'); //hanya admin yang bisa edit produk

        $users = User::orderBy('name')->get();
        $categories = Category::all();

        return view('product.edit', compact('product', 'users', 'categories'));
    }

    public function update(UpdateProductRequest $request, $id)
    {
        
        Gate::authorize('admin-only'); // hanya admin yang bisa update produk

        $product = Product::findOrFail($id);
        $validated = $request->validated();
        $product->update($validated);

        return redirect()->route('product.index')->with('success', 'Product updated successfully.');
    }

    public function delete($id)
    {
        // Cuma Admin yang boleh hapus barang
        Gate::authorize('admin-only');

        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('product.index')->with('success', 'Product berhasil dihapus');
    }
}