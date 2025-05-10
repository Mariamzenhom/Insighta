<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ isset($therapist) ? __('Edit Therapist') : __('Create Therapist') }}
        </h2>
    </x-slot>

    <div class="max-w-xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
        <form method="POST" action="{{ isset($therapist) ? route('therapist.update', $therapist->id) : route('therapist.store') }}">
            @csrf
            @if(isset($therapist))
                @method('PUT')
            @endif

            {{-- User Select --}}
            <div class="mb-4">
                <label for="user_id" class="block text-sm font-medium text-gray-700">User</label>
                <select name="user_id" id="user_id" required class="w-full p-2 border border-gray-300 rounded-lg">
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ isset($therapist) && $therapist->user_id == $user->id ? 'selected' : '' }}>
                            {{ $user->name }} ({{ $user->email }})
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Specialty --}}
            <div class="mb-4">
                <label for="specialty" class="block text-sm font-medium text-gray-700">Specialty</label>
                <input type="text" id="specialty" name="specialty" value="{{ old('specialty', $therapist->specialty ?? '') }}" required class="w-full p-2 border border-gray-300 rounded-lg">
            </div>

            {{-- Rating --}}
            <div class="mb-4">
                <label for="rating" class="block text-sm font-medium text-gray-700">Rating</label>
                <input type="number" step="0.01" max="5" min="0" id="rating" name="rating" value="{{ old('rating', $therapist->rating ?? 0) }}" class="w-full p-2 border border-gray-300 rounded-lg">
            </div>

            {{-- Price --}}
            <div class="mb-4">
                <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                <input type="number" step="0.01" id="price" name="price" value="{{ old('price', $therapist->price ?? '') }}" class="w-full p-2 border border-gray-300 rounded-lg">
            </div>

            <div class="mt-6">
                <x-primary-button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700">
                    {{ isset($therapist) ? 'Update Therapist' : 'Create Therapist' }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
