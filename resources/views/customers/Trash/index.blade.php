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
                <h1 class="text-3xl font-bold">Customer Management</h1>

                <div class="flex items-center">

                    <div>
                        <a href="{{ route('customers.index') }}" class="bg-transparent border-2 border-indigo-500 hover:border-indigo-700 py-2 px-3 rounded">Back</a>
                    </div>

                    <div>
                        <a href="{{ route('customers.create') }}"
                            class="ms-4 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                            Create Customer
                        </a>
                    </div>
                </div>
            </div>
            <div class="bg-white mt-4 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-xl font-bold">Trash Customers</h2>
                    <table id="customerTable" class="display">
                        <thead>
                            <tr>
                                <th>SNO</th>
                                <th>Customer Info</th>
                                @can('admin')
                                    <th>Created_by</th>
                                @endcan
                                <th>Address</th>
                                <th>Added On</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @php
                                $sno = 1;
                            @endphp
                            @foreach ($customers as $customer)
                                <tr>
                                    <td>{{ $sno++ }}</td>
                                    <td>
                                        <h3 class="font-bold">{{ $customer->name }}</h3>
                                        <p class="mt-2"><a href="">{{ $customer->email }}</a></p>
                                        <p><a href="">{{ $customer->phone }}</a></p>
                                    </td>
                                    @can('admin')
                                        <td>
                                            {{ $customer->user->name }}
                                        </td>
                                    @endcan
                                    <td><a href="">{{ $customer->address }}</a></td>
                                    <td>{{ $customer->created_at->diffForHumans() }}</td>
                                    <td class="flex items-center">

                                        <form method="POST" action="{{ route('customers.restore', $customer) }}">
                                            @csrf
                                            @method('PATCH')
                                            
                                            <button type="submit"
                                                class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-1 px-2 rounded">
                                                restore
                                            </button>
                                        </form>

                                        <form method="POST" action="{{ route('customers.forceDelete', $customer) }}">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                class="ms-2 bg-red-700 hover:bg-red-900 text-white font-bold py-1 px-2 rounded">
                                                Delete permanently
                                            </button>
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



<script>
    $(document).ready(function() {
        $('#customerTable').DataTable();
    });
</script>
