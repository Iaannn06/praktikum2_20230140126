<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate; 
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('product.index', compact('products'));
    }

    public function store(StoreProductRequest $request)
    {
        // Kalau lolos validasi, ambil datanya
        $validated = $request->validated();
        $validated['user_id'] = auth()->id(); 

        Product::create($validated);

        return redirect()->route('product.index')->with('success', 'Product created successfully.');
    }

    public function create()
    {
        $users = User::orderBy('name')->get();
        return view('product.create', compact('users'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('product.view', compact('product'));
    }

   public function update(UpdateProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);

        // Jangan lupa Gate dari modul kemarin tetap ada
        Gate::authorize('update', $product);

        // Ambil data yang udah divalidasi
        $validated = $request->validated();

        $product->update($validated);

        return redirect()->route('product.index')->with('success', 'Product updated successfully.');
    }

    public function edit(Product $product)
    {
        Gate::authorize('update', $product);

        $users = User::orderBy('name')->get();
        return view('product.edit', compact('product', 'users'));
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);

        Gate::authorize('delete', $product);

        $product->delete();

        return redirect()->route('product.index')->with('success', 'Product berhasil dihapus');
    }
}