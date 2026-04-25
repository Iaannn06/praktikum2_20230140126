<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'name' => 'sometimes|required|string|max:255',
            'qty' => 'sometimes|required|integer|min:1',
            'price' => 'sometimes|required|numeric|min:0',
            'category_id' => 'required|exists:category,id',
        ];
    }

    
    public function messages(): array
    {
        return [
            'name.required' => 'Nama produk tidak boleh kosong.',
            'qty.required' => 'Jumlah (kuantitas) harus diisi.',
            'price.required' => 'Harga tidak boleh kosong.',
            'category_id.required' => 'Kategori wajib dipilih bro!',
            'category_id.exists' => 'Kategori yang dipilih nggak ada di database.',
        ];
    }
}