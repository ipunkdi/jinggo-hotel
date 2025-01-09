<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    {{-- Breadcrumbs --}}
    <nav class="flex" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse px-4 lg:px-12">
            <li class="inline-flex items-center">
            <a href="/general-manager/users/create" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                Users
            </a>
            </li>
            <li>
            <div class="flex items-center">
                <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                </svg>
                <a href="#" class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">Create</a>
            </div>
            </li>
        </ol>
    </nav>

    {{-- Title --}}
    <h3 class="text-3xl font-bold dark:text-white px-4 lg:px-12">Users</h3>

    <section class="bg-white dark:bg-gray-900">
        <div class="bg-white border border-gray-200 rounded-lg shadow py-8 px-4 mx-auto max-w-2xl lg:py-8">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Add a new user</h2>

            @if ($errors->any())
                <div class="text-red-500">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="/general-manager/users/{{ $user->id }}" method="post">
                @csrf
                @method('PUT')
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <div class="w-full">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                        <input type="text" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type email" required value="{{ old('email', $user->email) }}">
                    </div>
                    <div class="w-full">
                        <label for="role" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Role</label>
                        <select id="role" name="role_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            @foreach ($roles as $role)
                                <option value="{{ $role->name }}" {{ $user->roles->pluck('name')->contains($role->name) ? 'selected' : '' }}>
                                    {{ $role->name }}
                                </option>
                            @endforeach
                        </select>                        
                    </div>
                </div>
                <button type="submit" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-amber-500 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-700 hover:bg-amber-600">
                    Save
                </button>
                <button data-modal-toggle="deleteModal" type="button" class="py-2 px-3 text-sm font-medium text-gray-900 hover:bg-gray-100 rounded-lg focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                    Cancel
                </button>
            </form>
        </div>
    </section>
</x-app-layout>