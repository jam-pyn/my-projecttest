<div class="card-body">
    <div class="row">
        <div class="col-md-6">
            <x-input type="text" wire:model.live="search" wire:keydown.enter="confirmsearch"
                placeholder="Search Transactions..." />
        </div>
    </div>


    <div class="mb-6 pr-4 pl-4">
        {--ตรวจสอบจำนวน Rows $user --}
        @if ($users->count() > 0)


            <table class="w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <div class="flex justify-left">
                                {{ __('Name') }}
                            </div>

                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <div class="flex justify-left">
                                {{ __('Email') }}
                            </div>
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <div class="flex justify-center">
                                {{ __('Actions') }}
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($users as $user)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex justify-left">
                                    {{ $user->name }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex justify-left">
                                    {{ $user->email }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap ">

                                <div class="flex justify-center">
                                    <form>
                                        <a href="{{ route('users.show', $user) }}"
                                            class="btn-actions inline-flex items-center flex-grow px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-wider hover:bg-gray-700 active:bg-gray-900">
                                            {{ __('View') }}
                                        </a>
                                    </form>
                                    <form>
                                        <a href="{{ route('users.edit', $user->id) }}"
                                            class="btn-actions inline-flex items-center flex-grow px-4 py-2 ml-4 bg-indigo-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-wider hover:bg-gray-700 active:bg-gray-900">
                                            {{ __('Edit') }}
                                        </a>
                                    </form>
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST">
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

            {{ $users->links() }}
        @else
            <p>ไม่พบผู้ใช้</p>
        @endif
    </div>

   

</div>
