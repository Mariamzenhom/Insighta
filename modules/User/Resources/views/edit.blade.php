<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">Edit User</h2>
    </x-slot>

    <div class="max-w-xl mx-auto mt-10">
        <form method="POST" action="{{ route('users.update', $user->id) }}"  >
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label>Name</label>
    <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full p-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full p-2 border rounded" required>
            </div>
            <div class="mt-4">
                <x-primary-button class="bg-blue-600 hover:bg-blue-700 w-full">
                    Update User
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
