<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between text-gray-900 dark:text-gray-100">
                <h2 class="text-3xl font-bold">Purchase Management</h2>

            </div>
            <div class="bg-white mt-4 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <h2 class="text-center text-xl font-bold">Purchase a Product</h2>
                    <form method="POST" action="{{ route('purchases.store') }}">
                        @csrf()

                        <div>
                            <x-input-label for="product_id" :value="_('Choose Product')" />

                            <select name="product_id" id="product_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                <option value="" disabled {{ old('product_id') ? '' : 'selected' }}>Browse a product</option>
                                @forelse ($products as $product)
                                    <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>{{ $product->name }}</option>
                                @empty
                                 <option value="none">No Item to purchase</option>   
                                @endforelse
                            </select>
                            <x-input-error :messages="$errors->get('product_id')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="customer_id" :value="_('Product Buy For')" />

                            <select name="customer_id" id="customer_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                <option value="" disabled {{ old('customer_id') ? '' : 'selected' }}>Select a customer</option>

                                @foreach ($customers as $customer)
                                 <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>{{ $customer->name}}</option>
                                @endforeach

                            </select>

                            <x-input-error :messages="$errors->get('customer_id')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="quantity" :value="__('Quantity')" />
                            <x-text-input id="quantity" class="block mt-1 w-full" type="number" name="quantity" :value="old('quantity')"/>
                            <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
                        </div>


                        <div class="mt-4">
                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-150 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                                Purchase > 
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
