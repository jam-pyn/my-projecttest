<style>
    .alert-success {
        color: #155724;
        background-color: #d4edda;
        border-color: #c3e6cb;
        padding: 15px;
        margin-bottom: 20px;
        border: 1px solid transparent;
        border-radius: 4px;
    }

    .alert-error {
        color: #c40d00;
        background-color: #edd4d4;
        border-color: #e6c3c3;
        padding: 15px;
        margin-bottom: 20px;
        border: 1px solid transparent;
        border-radius: 4px;
    }

    .btn-actions {
        margin: 0;
    }
</style>


<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Roles List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('error'))
                <div class="alert alert-error">
                    {{ session('error') }}
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <a href="{{ route('roles.create') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-wider hover:bg-gray-700 active:bg-gray-900">
                {{ __('Add Role') }}
            </a>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
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
                                {{ __('Role Code') }}
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('Actions') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($roles as $role)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex justify-left">
                                        {{ $role->role_name }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex justify-center">
                                        {{ $role->role_code }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap ">

                                    <div class="flex justify-center">
                                        <form>
                                            <a href="{{ route('roles.show', $role) }}"
                                                class="btn-actions inline-flex items-center flex-grow px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-wider hover:bg-gray-700 active:bg-gray-900">
                                                {{ __('View') }}
                                            </a>
                                        </form>
                                        <form>
                                            <a href="{{ route('roles.edit', $role->id) }}"
                                                class="btn-actions inline-flex items-center flex-grow px-4 py-2 ml-4 bg-indigo-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-wider hover:bg-gray-700 active:bg-gray-900">
                                                {{ __('Edit') }}
                                            </a>
                                        </form>
                                        <form action="{{ route('roles.destroy', $role->id) }}" method="POST">
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
            </div>
        </div>
    </div>
</x-app-layout>
