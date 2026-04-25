<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 dark:border-gray-700">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100 tracking-tight">Product List</h2>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">Manage your product inventory</p>
                        </div>

                        @can('admin-only')
                            <x-add-product :url="route('product.create')" :name="'Product'" />
                        @endcan
                    </div>

                    @if (session('success'))
                        <div class="mb-4 px-4 py-3 bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-700 text-green-700 dark:text-green-300 rounded-lg text-sm">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-50 dark:bg-gray-700 text-gray-600 dark:text-gray-300 text-sm uppercase tracking-wide">
                                    <th class="py-3 px-4 border-b border-gray-200 dark:border-gray-600">#</th>
                                    <th class="py-3 px-4 border-b border-gray-200 dark:border-gray-600">NAME</th>
                                    <th class="py-3 px-4 border-b border-gray-200 dark:border-gray-600">QUANTITY</th>
                                    <th class="py-3 px-4 border-b border-gray-200 dark:border-gray-600">PRICE</th>
                                    <th class="py-3 px-4 border-b border-gray-200 dark:border-gray-600">CATEGORY</th>
                                    <th class="py-3 px-4 border-b border-gray-200 dark:border-gray-600">OWNER</th>
                                    <th class="py-3 px-4 border-b border-gray-200 dark:border-gray-600 text-center">ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-600">
                                @forelse ($products as $index => $product)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition duration-150">
                                        <td class="py-3 px-4 text-gray-500 dark:text-gray-400 text-sm">{{ $index + 1 }}</td>
                                        <td class="py-3 px-4 font-medium text-gray-900 dark:text-white">{{ $product->name }}</td>
                                        <td class="py-3 px-4">
                                            <span class="{{ $product->qty > 10 ? 'bg-green-100 text-green-700 dark:bg-green-900/40 dark:text-green-300' : 'bg-red-100 text-red-700 dark:bg-red-900/40 dark:text-red-300' }} py-1 px-2 rounded-full text-xs font-semibold border border-current opacity-80">
                                                {{ $product->qty }}
                                            </span>
                                        </td>
                                        <td class="py-3 px-4 text-gray-600 dark:text-gray-300 text-sm">
                                            Rp {{ number_format($product->price, 0, ',', '.') }}
                                        </td>
                                        <td class="py-3 px-4">
                                            <span class="bg-indigo-100 text-indigo-700 dark:bg-indigo-900/40 dark:text-indigo-300 py-1 px-2 rounded-md text-xs font-medium border border-indigo-200 dark:border-indigo-800">
                                                {{ $product->category->name ?? 'Belum ada' }}
                                            </span>
                                        </td>
                                        <td class="py-3 px-4 text-gray-500 dark:text-gray-400 text-sm">
                                            {{ $product->user->name ?? 'admin' }}
                                        </td>
                                        <td class="py-3 px-4">
                                            <div class="flex justify-center items-center gap-3">
                                                <a href="{{ route('product.show', $product->id) }}" class="text-indigo-500 hover:text-indigo-600 dark:text-indigo-400 dark:hover:text-indigo-300 transition" title="View Detail">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                </a>

                                                @can('admin-only')
                                                    <a href="{{ route('product.edit', $product->id) }}" class="text-yellow-600 dark:text-yellow-500 hover:scale-110 transition transform" title="Edit Product">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                        </svg>
                                                    </a>

                                                    <form action="{{ route('product.delete', $product->id) }}" method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-600 dark:text-red-500 hover:scale-110 transition transform" title="Delete Product" onclick="return confirm('Yakin mau hapus produk ini?')">
                                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="py-12 text-center text-gray-500 dark:text-gray-400 italic">
                                            Belum ada data produk yang tersedia.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>