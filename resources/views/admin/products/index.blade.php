<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Products List
        </h2>
    </x-slot>

    <div>
        <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">

            <div class="block mb-4">
                <a href="{{ route('products.create') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 disabled:opacity-25 transition ease-in-out duration-150">
                    Add Product
                </a>
            </div>

            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200 w-full table-auto">
                                <thead>
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            ID
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Name
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Tags
                                        </th>
                                        <th scope="col" class="px-6 py-3 bg-gray-50">
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($products as $product)
                                        <tr>
                                            <td scope="row" class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $product->id }}
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $product->name }}
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                @foreach ($product->tags as $tag)
                                                    <span
                                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                        {{ $tag->name }}
                                                    </span>
                                                @endforeach
                                            </td>

                                            <td class="px-1 py-4 align-content-around">
                                                <a href="{{ route('products.show', $product->id) }}"
                                                    class="text-indigo-600 hover:text-indigo-600 mb-2 mr-2"><button
                                                        class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:ring focus:ring-red-200 active:bg-red-600 disabled:opacity-25 transition">
                                                        {{ __('View') }}
                                                    </button></a>

                                                <a href="{{ route('products.edit', $product->id) }}"
                                                    class="text-indigo-600 hover:text-indigo-600 mb-2 mr-2">
                                                    <x-jet-secondary-button>
                                                        {{ __('Edit') }}
                                                    </x-jet-secondary-button>
                                                </a>

                                                <form class="p-0 m-0 inline-flex items-center justify-center"
                                                    action="{{ route('products.destroy', $product->id) }}" method="POST"
                                                    onsubmit="return confirm('Are you sure?');">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit"
                                                        class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:ring focus:ring-red-200 active:bg-red-600 disabled:opacity-25 transition"
                                                        value="Delete">
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                {{ $products->links() }}
            </div>

        </div>
    </div>
</x-app-layout>
