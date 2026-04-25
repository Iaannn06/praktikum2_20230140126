<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100 tracking-tight">Product List
                            </h2>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">Manage your product inventory</p>
                        </div>

                        @can('manage-product')
                            <x-add-product :url="route('product.create')" :name="'Product'" />
                        @endcan
                    </div>

                    @if (session('success'))
                        <div
                            class="mb-4 px-4 py-3 bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-700 text-green-700 dark:text-green-300 rounded-lg text-sm">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-700 text-gray-300 text-sm uppercase tracking-wide">
                                    <th class="py-3 px-4 border-b border-gray-600">#</th>
                                    <th class="py-3 px-4 border-b border-gray-600">NAME</th>
                                    <th class="py-3 px-4 border-b border-gray-600">QUANTITY</th>
                                    <th class="py-3 px-4 border-b border-gray-600">PRICE</th>
                                    <th class="py-3 px-4 border-b border-gray-600">CATEGORY</th>
                                    <th class="py-3 px-4 border-b border-gray-600">OWNER</th>
                                    <th class="py-3 px-4 border-b border-gray-600 text-center">ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($products as $index => $product)
                                    <tr class="hover:bg-gray-700 transition duration-150 border-b border-gray-600">
                                        <td class="py-3 px-4 text-gray-400">{{ $index + 1 }}</td>
                                        <td class="py-3 px-4 font-medium text-white">{{ $product->name }}</td>
                                        <td class="py-3 px-4">
                                            <span
                                                class="{{ $product->qty > 10 ? 'bg-green-900 text-green-300' : 'bg-red-900 text-red-300' }} py-1 px-2 rounded-full text-xs">
                                                {{ $product->qty }}
                                            </span>
                                        </td>
                                        <td class="py-3 px-4 text-gray-300">Rp
                                            {{ number_format($product->price, 0, ',', '.') }}
                                        </td>

                                        <td class="py-3 px-4">
                                            <span class="bg-indigo-900 text-indigo-300 py-1 px-2 rounded-md text-xs">
                                                {{ $product->category->name ?? 'Belum ada' }}
                                            </span>
                                        </td>

                                        <td class="py-3 px-4 text-gray-400 text-sm">{{ $product->user->name ?? 'admin' }}
                                        </td>

                                        <td class="py-3 px-4 text-center">
                                            <div class="flex justify-center gap-2">
                                                <a href="{{ route('product.show', $product->id) }}"
                                                    class="text-indigo-400 hover:text-indigo-300">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path
                                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                </a>
                                                <a href="{{ route('product.edit', $product->id) }}"
                                                    class="border border-yellow-500 text-yellow-500 hover:bg-yellow-500 hover:text-gray-900 px-2 py-1 rounded text-xs transition">
                                                    Edit
                                                </a>
                                                <form action="{{ route('product.delete', $product->id) }}" method="POST"
                                                    class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="border border-red-500 text-red-500 hover:bg-red-500 hover:text-white px-2 py-1 rounded text-xs transition"
                                                        onclick="return confirm('Yakin mau hapus?')">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="py-6 text-center text-gray-500 italic">Belum ada data produk.
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