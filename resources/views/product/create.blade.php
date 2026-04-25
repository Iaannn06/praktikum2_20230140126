<x-app-layout>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 rounded-xl border border-gray-700 overflow-hidden shadow-2xl">
                <div class="p-8 text-gray-100">
                    
                    <div class="flex items-center mb-8">
                        <a href="{{ route('product.index') }}" class="text-gray-400 hover:text-white mr-4 transition transform hover:-translate-x-1">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </a>
                        <div>
                            <h2 class="text-2xl font-bold tracking-tight">Add Product</h2>
                            <p class="text-sm text-gray-400 mt-1">Fill in the details to add a new product</p>
                        </div>
                    </div>

                    <form action="{{ route('product.store') }}" method="POST">
                        @csrf

                        <div class="mb-6">
                            <label for="name" class="block text-sm font-semibold text-gray-300 mb-2">Product Name <span class="text-red-500">*</span></label>
                            <input type="text" name="name" id="name" 
                                class="w-full bg-gray-700 border-gray-600 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 text-white placeholder-gray-500 transition"
                                placeholder="e.g. Wireless Headphones" value="{{ old('name') }}" required>
                            @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-6">
                            <label for="category_id" class="block text-sm font-semibold text-gray-300 mb-2">Category <span class="text-red-500">*</span></label>
                            <select name="category_id" id="category_id" 
                                class="w-full bg-gray-700 border-gray-600 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 text-white transition" required>
                                <option value="" disabled selected>-- Select Category --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                            <div>
                                <label for="qty" class="block text-sm font-semibold text-gray-300 mb-2">Quantity <span class="text-red-500">*</span></label>
                                <input type="number" name="qty" id="qty" 
                                    class="w-full bg-gray-700 border-gray-600 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 text-white transition"
                                    placeholder="0" value="{{ old('qty') }}" min="0" required>
                                @error('qty') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label for="price" class="block text-sm font-semibold text-gray-300 mb-2">Price (Rp) <span class="text-red-500">*</span></label>
                                <input type="number" name="price" id="price" 
                                    class="w-full bg-gray-700 border-gray-600 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 text-white transition"
                                    placeholder="0" value="{{ old('price') }}" min="0" required>
                                @error('price') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="flex justify-end items-center gap-4 border-t border-gray-700 pt-8">
                            <a href="{{ route('product.index') }}" 
                                class="px-6 py-2 bg-transparent border border-gray-600 text-gray-300 rounded-lg hover:bg-gray-700 hover:text-white transition font-medium">
                                Cancel
                            </a>
                            <button type="submit" 
                                class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-500 active:bg-indigo-700 transition font-bold shadow-lg shadow-indigo-500/20">
                                Save Product
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>