<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Detail') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <div class="mt-6 grid grid-cols-1 gap-6 sm:grid-cols-6">

                        <!-- Name -->
                        <div class="col-span-6 sm:col-span-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">
                                {{ __('Name') }}
                            </label>
                            <input type="text" id="name"
                                class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                value="{{ $user->name }}" disabled>
                        </div>

                        <!-- Email -->
                        <div class="col-span-6 sm:col-span-4">
                            <label for="email" class="block text-sm font-medium text-gray-700">
                                {{ __('Email') }}
                            </label>
                            <input type="text" id="email"
                                class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                value="{{ $user->email }}" disabled>
                        </div>

                        <!-- Role (ถ้ามีการเชื่อมกับ Role) -->
                        @if($user->role)
                            <div class="col-span-6 sm:col-span-4">
                                <label for="role" class="block text-sm font-medium text-gray-700">
                                    {{ __('Role') }}
                                </label>
                                <input type="text" id="role"
                                    class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                    value="{{ $user->role->role_code }}" disabled>
                            </div>
                        @endif
                    </div>

                    <div class="mt-4 flex justify-end">
                        <a href="{{ route('users.index') }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Back to Users List') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
