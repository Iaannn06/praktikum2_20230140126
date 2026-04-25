<x-app-layout>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center gap-4">
                    <a href="{{ route('product.index') }}" class="text-gray-400 hover:text-gray-200 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                        </svg>
                    </a>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-100 tracking-tight">Product Detail</h2>
                        <p class="text-sm text-gray-400 mt-0.5">Viewing product #{{ $product->id }}</p>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    @can('update', $product)
                        <x-edit-button :url="route('product.edit', $product->id)" />
                    @endcan
                    
                    @can('delete', $product)
                        <x-delete-button :action="route('product.delete', $product->id)" />
                    @endcan
                </div>
            </div>

            <div class="bg-gray-800 rounded-xl border border-gray-700/75 overflow-hidden shadow-lg">
                <div class="divide-y divide-gray-700/50">
                    
                    <div class="flex items-center px-6 py-5">
                        <div class="w-1/3 text-sm text-gray-400 font-medium">Product Name</div>
                        <div class="w-2/3 text-base font-bold text-gray-100">{{ $product->name }}</div>
                    </div>

                    <div class="flex items-center px-6 py-5">
                        <div class="w-1/3 text-sm text-gray-400 font-medium">Quantity</div>
                        <div class="w-2/3">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ $product->qty > 10 ? 'bg-green-900/40 text-green-400 border border-green-800/50' : 'bg-red-900/40 text-red-400 border border-red-800/50' }}">
                                {{ $product->qty }} In Stock
                            </span>
                        </div>
                    </div>

                    <div class="flex items-center px-6 py-5">
                        <div class="w-1/3 text-sm text-gray-400 font-medium">Price</div>
                        <div class="w-2/3 text-base font-bold text-gray-100">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </div>
                    </div>

                    <div class="flex items-center px-6 py-5">
                        <div class="w-1/3 text-sm text-gray-400 font-medium">Category</div>
                        <div class="w-2/3">
                            <span class="inline-flex items-center px-3 py-1 rounded-md text-xs font-semibold bg-indigo-900/40 text-indigo-300 border border-indigo-800/50 uppercase tracking-wider">
                                {{ $product->category->name ?? 'Uncategorized' }}
                            </span>
                        </div>
                    </div>

                    <div class="flex items-center px-6 py-5">
                        <div class="w-1/3 text-sm text-gray-400 font-medium">Owner</div>
                        <div class="w-2/3 flex items-center gap-3">
                            <div class="h-8 w-8 rounded-full bg-indigo-600/80 flex items-center justify-center text-white text-xs font-bold uppercase shadow-sm">
                                {{ substr($product->user->name ?? 'A', 0, 1) }}
                            </div>
                            <span class="text-base font-medium text-gray-100">{{ $product->user->name ?? 'admin' }}</span>
                        </div>
                    </div>

                    <div class="flex items-center px-6 py-5">
                        <div class="w-1/3 text-sm text-gray-400 font-medium">Created At</div>
                        <div class="w-2/3 text-sm text-gray-100">
                            {{ $product->created_at->format('d M Y, H:i') }}
                        </div>
                    </div>

                    <div class="flex items-center px-6 py-5">
                        <div class="w-1/3 text-sm text-gray-400 font-medium">Updated At</div>
                        <div class="w-2/3 text-sm text-gray-100">
                            {{ $product->updated_at->format('d M Y, H:i') }}
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>