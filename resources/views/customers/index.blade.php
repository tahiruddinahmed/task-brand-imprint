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
                <h1 class="text-xl font-bold">Customer Management</h1>

                <div class="flex items-center">

                    <div class="me-2">
                        <a href="{{ route('customers.trash') }}"
                            class="inline-flex items-center justify-center 
                                    bg-transparent 
                                    border-2 border-red-600
                                    text-red-600 
                                    font-semibold 
                                    py-2
                                    px-6
                                    rounded-xl 
                                    transition duration-150 ease-in-out
                                    hover:bg-red-600 
                                    hover:text-white 
                                    hover:shadow-lg
                                    focus:outline-none focus:ring-4 focus:ring-red-300 focus:ring-opacity-50"
                            >
                            <!-- Icon for "Trash" (optional but good practice) -->
                            <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                </path>
                            </svg>
                            Trash
                        </a>
                    </div>
                    <a href="{{ route('customers.create') }}"
                        class="ms-4 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                        Create Customer
                    </a>
                </div>
            </div>
            <div class="bg-white mt-4 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
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
                                        <div>
                                            <a href="{{ route('customers.edit', $customer) }}"
                                                class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-1 px-2 rounded">
                                                Edit
                                            </a>
                                        </div>

                                        <form method="POST" action="{{ route('customers.softDelete', $customer) }}">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                class="ms-2 bg-red-700 hover:bg-red-900 text-white font-bold py-1 px-2 rounded">
                                                Tash
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
