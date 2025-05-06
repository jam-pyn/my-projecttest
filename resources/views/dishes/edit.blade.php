<style>
    .invalid-feedback {
        color: red;
    }
</style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dishes Update') }}
        </h2>
    </x-slot>

    <form action="{{ route('dishes.update', $dish) }}" method="post">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{ $dish->id }}">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="px-4 py-5 sm:p-6">
                                <div class="mt-6 grid grid-cols-1 gap-6 sm:grid-cols-6">
                                    <div class="col-span-6 sm:col-span-4">
                                        <label for="dish_name" class="block text-sm font-medium text-gray-700">
                                            {{ __('Dish Name') }}
                                        </label>
                                        <input type="text" name="dish_name" id="dish_name"
                                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                            value="{{ old('dish_name', $dish->dish_name) }}">
                                        @error('dish_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-span-6 sm:col-span-4">
                                        <label for="price" class="block text-sm font-medium text-gray-700">
                                            {{ __('Price') }}
                                        </label>

                                        <input type="text" name="price" id="price"
                                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                            value="{{ old('price', $dish->price) }}">
                                        @error('price')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-span-6 sm:col-span-4">
                                        <label for="category" class="block text-sm font-medium text-gray-700">
                                            {{ __('Category') }}
                                        </label>

                                        <input type="text" name="category" id="category_id"
                                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                            value="{{ old('category_id', $dish->category->category) }}">
                                        @error('category')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    </div>
                                </div>
                                <div class="mt-4 flex justify-end">
                                    <button
                                        class="inline-flex items-center px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                        type="submit">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>


</x-app-layout>
