<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Wajib diganti jadi true biar bisa dipakai
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'qty' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama produk wajib diisi!',
            'name.max' => 'Nama produk terlalu panjang, maksimal 255 karakter.',
            'qty.required' => 'Jumlah (kuantitas) wajib diisi!',
            'qty.integer' => 'Jumlah harus berupa angka bulat!',
            'price.required' => 'Harga produk wajib diisi!',
            'price.numeric' => 'Harga harus berupa angka yang valid!',
            'category_id' => 'required|exists:category,id',
        ];
    }
}