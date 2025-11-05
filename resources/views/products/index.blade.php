<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <x-alert name="success" />

            <div class="flex justify-between text-gray-900 dark:text-gray-100">
                <h1 class="text-xl font-bold">Product Management</h1>

                <div>
                    <a href="{{ route('products.create') }}"
                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Add Product</a>
                </div>
            </div>
            <div class="bg-white mt-4 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table id="productTable" class="display">
                        <thead>
                            <tr>
                                <th>SNO</th>
                                <th>Product Name</th>
                                <th>Remarks</th>
                                <th>Added On</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @php
                                $sno = 1;
                            @endphp
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $sno++ }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->remark }}</td>
                                    <td>{{ $product->created_at->diffForHumans() }}</td>
                                    <td class="flex items-center">
                                        <a href="{{ route('products.edit', $product) }}"
                                            class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-1 px-2 rounded">Edit</a>
                                        <form method="POST" action="{{ route('products.destroy', $product) }}">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                class="ms-2 bg-red-700 hover:bg-red-900 text-white font-bold py-1 px-2 rounded">Delete</button>

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
</x-app-layout>


<!-- In your Blade view file or a linked JS file -->
<script>
    $(document).ready(function() {
        $('#productTable').DataTable();
    });
</script>
