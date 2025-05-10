<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Session') }}
        </h2>
    </x-slot>

    <div class="max-w-xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
        <form method="POST" action="{{ route('therapy.session.store') }}">
            @csrf

            {{-- User --}}
            <div class="mb-4">
                <label for="user_id" class="block text-sm font-medium text-gray-700">User</label>
                <select name="user_id" id="user_id" required class="w-full p-2 border border-gray-300 rounded-lg">
                    <option disabled selected>Select User</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">
                            {{ $user->name }} ({{ $user->email }})
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Therapist --}}
             <div class="mb-4">
                <label for="therapist_id" class="block text-sm font-medium text-gray-700">Therapist</label>
                <select name="therapist_id" id="therapist_id" required class="w-full p-2 border border-gray-300 rounded-lg">
                    <option disabled selected>Select Therapist</option>
                    @foreach($therapists as $therapist)
                        <option value="{{ $therapist->id }}">
                            {{ $therapist->user->name }} - {{ $therapist->specialty }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Session Time --}}
            <div class="mb-4">
                <label for="session_time" class="block text-sm font-medium text-gray-700">Session Time</label>
                <input type="datetime-local" id="session_time" name="session_time"
                    required class="w-full p-2 border border-gray-300 rounded-lg">
            </div>

            {{-- Notes --}}
            <div class="mb-4">
                <label for="notes" class="block text-sm font-medium text-gray-700">Notes</label>
                <textarea name="notes" id="notes" rows="3" class="w-full p-2 border border-gray-300 rounded-lg"></textarea>
            </div>


            <div class="mt-6">
                <x-primary-button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700">
                    {{ __('Create Session') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
