<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Select Child and Send OTP') }}
        </h2>
    </x-slot>

    <div class="max-w-xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
        <form method="POST" action="{{ route('parent.selectChildAndSendOtp') }}">
            @csrf

            {{-- Select Child --}}
            <div class="mb-4">
                <label for="child_email" class="block text-sm font-medium text-gray-700">Child Email</label>
                <input type="email" id="child_email" name="child_email" required class="w-full p-2 border border-gray-300 rounded-lg" placeholder="Enter child's email">
            </div>

            <div class="mt-6">
                <x-primary-button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700">
                    {{ __('Send OTP') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
