<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductApiController extends Controller
{
    public function index()
    {
        $products = Product::with('category', 'user')->get();
        return response()->json([
            'message' => 'Daftar produk berhasil diambil',
            'data' => $products
        ], 200);
    }

    public function store(StoreProductRequest $request)
    {
        try {
            $validated = $request->validated();
            $validated['user_id'] = Auth::id();

            $product = Product::create($validated);

            return response()->json([
                'message' => 'Produk berhasil ditambahkan!!',
                'data' => $product,
            ], 201);
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Gagal nambah produk'], 500);
        }
    }

    public function show($id)
    {
        $product = Product::with('category', 'user')->find($id);

        if (!$product) {
            return response()->json(['message' => 'Product tidak ditemukan'], 404);
        }

        return response()->json([
            'message' => 'Detail produk berhasil diambil',
            'data' => $product
        ], 200);
    }

    public function update(UpdateProductRequest $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product tidak ditemukan'], 404);
        }

        $product->update($request->validated());

        return response()->json([
            'message' => 'Produk berhasil diupdate',
            'data' => $product
        ], 200);
    }

    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product tidak ditemukan'], 404);
        }

        $product->delete();

        return response()->json([
            'message' => 'Produk berhasil dihapus'
        ], 200);
    }
}