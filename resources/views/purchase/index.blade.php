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
                <h1 class="text-xl font-bold">Purchase Management</h1>

                <div>
                    <a href="{{ route('purchases.create') }}"
                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Purchase a product</a>
                </div>
            </div>
            <div class="bg-white mt-4 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table id="pruchaseTable" class="display">
                        <thead>
                            <tr>
                                <th>SNO</th>
                                <th>Product Details</th>
                                <th>Customer Details</th>
                                <th>Purchased On</th>
                                @can('admin')
                                    <th>Action</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>

                            @php
                                $sno = 1;
                            @endphp
                            @foreach ($purchases as $purchase)
                                <tr>
                                    <td>{{ $sno++ }}</td>
                                    <td>
                                      <h3 class="font-bold underline">{{ $purchase->product->name }}</h3>
                                      <p class="italic mt-2">Quantity: {{ $purchase->quantity }} </p>
                                    
                                    </td>
                                    <td>
                                        <h3 class="font-bold underline">{{ $purchase->customer->name }}</h3>
                                        <p class="mt-2">Contact: <a href="">{{ $purchase->customer->phone }}</a></p>
                                        <p>Email: <a href="">{{ $purchase->customer->email }}</a></p>

                                    </td>
                                    <td>{{ $purchase->created_at->diffForHumans() }}</td>
                                    @can('admin')
                                        <td class="flex justify-center items-center">
                                            <form method="POST" action="{{ route('purchases.destroy', $purchase) }}">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                    class="ms-2 bg-red-700 hover:bg-red-900 text-white font-bold py-1 px-2 rounded">Delete</button>

                                            </form>
                                        </td>
                                    @endcan
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
        $('#pruchaseTable').DataTable();
    });
</script>
