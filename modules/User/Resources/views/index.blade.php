<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Users') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto mt-10">
        {{-- Create User --}}
        <div class="bg-white p-6 rounded shadow-md mb-6">
            <form method="POST" action="{{ route('users.store') }}">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm">Name</label>
                        <input type="text" name="name" class="w-full p-2 border rounded" required>
                    </div>
                    <div>
                        <label class="block text-sm">Email</label>
                        <input type="email" name="email" class="w-full p-2 border rounded" required>
                    </div>
                    <div>
                        <label class="block text-sm">Password</label>
                        <input type="password" name="password" class="w-full p-2 border rounded" required>
                    </div>
                    <div>
                        <label class="block text-sm">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="w-full p-2 border rounded" required>
                    </div>
                </div>
                <div class="mt-4">
                    <x-primary-button class="bg-green-600 hover:bg-green-700 w-full">
                        {{ __('Create User') }}
                    </x-primary-button>
                </div>
            </form>
        </div>

        {{-- User Table --}}
        <div class="bg-white p-6 rounded shadow-md">
            <table class="w-full text-sm text-left">
                <thead>
                    <tr class="text-gray-600 border-b">
                        <th class="py-2">ID</th>
                        <th class="py-2">Name</th>
                        <th class="py-2">Email</th>
                        <th class="py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="border-b">
                           <td>{{ $user['id'] }}</td>
                            <td>{{ $user['name'] }}</td>
                            <td>{{ $user['email'] }}</td>
                            <td class="py-2 space-x-2">
                                {{-- Edit --}}
                                <a href="{{ route('users.edit', $user['id']) }}" class="text-blue-600 hover:underline">Edit</a>

                                {{-- Delete --}}
                                <form action="{{ route('users.destroy', $user['id']) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- Pagination --}}
            {{-- <div class="mt-4">
                {{ $users->links() }}
            </div> --}}
        </div>
    </div>
</x-app-layout>
