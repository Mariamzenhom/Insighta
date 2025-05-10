<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Book a Therapy Session') }}
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">

        @if(session('success'))
            <div class="alert alert-success mb-4 p-4 text-green-800 bg-green-100 border border-green-300 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger mb-4 p-4 text-red-800 bg-red-100 border border-red-300 rounded">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('book.session') }}" class="space-y-4">
            @csrf

            <!-- Select Therapist -->
            <div class="mb-4">
                <label for="therapist_id" class="block text-sm font-medium text-gray-700">Select Therapist:</label>
                <select id="therapist_id" name="therapist_id" required class="block mt-1 w-full p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                    @foreach($items as $therapist)
                        <option value="{{ $therapist->id }}">{{ $therapist->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Session Time -->
            <div class="mb-4">
                <label for="session_time" class="block text-sm font-medium text-gray-700">Session Time:</label>
                <input type="datetime-local" name="session_time" id="session_time" required class="w-full mt-1 p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
            </div>
            <!-- Next Step Button -->
            <div class="mt-4 flex justify-between">
                <button type="submit" class="py-2 px-4 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500">Book Session</button>
            </div>

        </form>
    </div>
</x-app-layout>
