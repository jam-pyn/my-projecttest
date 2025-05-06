<div class="card-body">
    <div class="row">
        <div class="col-md-6">
            <x-input type="text" wire:model.live="search" wire:keydown.enter="confirmsearch"
                placeholder="Search Transactions..." />
        </div>
    </div>


    <div class="mb-6 pr-4 pl-4">
        @if ($dishes->count() > 0)

        <table class="w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <div class="flex justify-left">
                            {{ __('Dish Name') }}
                        </div>

                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        {{ __('Price') }}
                    </th>
                    <th scope="col"
                    class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                    {{ __('Cetegory') }}
                </th>
                    <th scope="col"
                        class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                        {{ __('Actions') }}
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($dishes as $dish)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex justify-left">
                                {{ $dish->dish_name }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex justify-center">
                                {{ $dish->price }}
                            </div>
                        </td>
                      
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex justify-left">
                                {{ $dish->category?->category }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap ">

                            <div class="flex justify-center">
                                <form>
                                    <a href="{{ route('dishes.show', $dish) }}"
                                        class="btn-actions inline-flex items-center flex-grow px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-wider hover:bg-gray-700 active:bg-gray-900">
                                        {{ __('View') }}
                                    </a>
                                </form>
                                <form>
                                    <a href="{{ route('dishes.edit', $dish->id) }}"
                                        class="btn-actions inline-flex items-center flex-grow px-4 py-2 ml-4 bg-indigo-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-wider hover:bg-gray-700 active:bg-gray-900">
                                        {{ __('Edit') }}
                                    </a>
                                </form>
                                <form action="{{ route('dishes.destroy', $dish->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="btn-actions inline-flex items-center flex-grow px-4 py-2 ml-4 bg-red-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-wider hover:bg-red-700 active:bg-red-900">
                                        {{ __('Delete') }}
                                    </button>
                                </form>
                            </div>


                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
            {{ $dishes->links() }}
        @else
            <p>ไม่พบผู้ใช้</p>
        @endif
    </div>



</div>

