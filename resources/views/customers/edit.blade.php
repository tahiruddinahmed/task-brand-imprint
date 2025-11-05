<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between text-gray-900 dark:text-gray-100">
                <h2 class="text-xl font-bold">Customer Management</h2>

            </div>
            <div class="bg-white mt-4 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <h2 class="text-center text-2xl font-bold">Edit Customer</h2>
                    <form method="POST" action="{{ route('customers.update', $customer) }}">
                        @csrf()
                        @method('PUT')

                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$customer->name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div class="mt-2">
                            <x-input-label for="phone" :value="__('Phone')" />
                            <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="$customer->phone" />
                            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                        </div>


                        <div class="mt-2">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="text" name="email" :value="$customer->email" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>


                        <div class="mt-2">
                            <x-input-label for="address" :value="__('Address')" />
                            <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="$customer->address" />
                            <x-input-error :messages="$errors->get('address')" class="mt-2" />
                        </div>


                        <div class="mt-4">
                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-150 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                                Update Customer > 
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
