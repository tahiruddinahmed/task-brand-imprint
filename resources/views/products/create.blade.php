<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between text-gray-900 dark:text-gray-100">
                <h2 class="text-xl font-bold">Product Management</h2>

            </div>
            <div class="bg-white mt-4 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <h2 class="text-center text-2xl font-bold">Add Product</h2>
                    <form method="POST" action="{{ route('products.store') }}">
                        @csrf()

                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div class="mt-2">
                            <x-input-label for="remark" :value="__('Remark')" />
                            <x-text-input id="remark" class="block mt-1 w-full" type="text" name="remark" :value="old('remark')" autofocus autocomplete="remark" />
                            <x-input-error :messages="$errors->get('remark')" class="mt-2" />
                        </div>


                        <div class="mt-4">
                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-150 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                                Add Product > 
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
