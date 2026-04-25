<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-100">
                    
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <h2 class="text-2xl font-semibold">Category List</h2>
                            <p class="text-gray-400 text-sm">Manage your category</p>
                        </div>
                        <a href="{{ route('category.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-md transition duration-150 ease-in-out">
                            + Add Category
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-700 text-gray-300 text-sm uppercase tracking-wide">
                                    <th class="py-3 px-4 border-b border-gray-600 rounded-tl-md">No</th>
                                    <th class="py-3 px-4 border-b border-gray-600">Name</th>
                                    <th class="py-3 px-4 border-b border-gray-600">Total Product</th>
                                    <th class="py-3 px-4 border-b border-gray-600 rounded-tr-md text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($categories as $index => $category)
                                    <tr class="hover:bg-gray-700 transition duration-150 border-b border-gray-600">
                                        <td class="py-3 px-4">{{ $index + 1 }}</td>
                                        <td class="py-3 px-4">{{ $category->name }}</td>
                                        
                                        <td class="py-3 px-4">{{ $category->products_count }}</td>
                                        
                                        <td class="py-3 px-4 text-center">
                                            <a href="{{ route('category.edit', $category->id) }}" class="text-blue-400 hover:text-blue-300 mr-3">Edit</a>
                                            <form action="{{ route('category.destroy', $category->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-400 hover:text-red-300" onclick="return confirm('Yakin mau hapus kategori ini?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="py-6 text-center text-gray-400">Belum ada kategori. Silakan tambah kategori baru.</td>
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