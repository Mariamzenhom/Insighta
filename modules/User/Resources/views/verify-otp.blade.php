<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Verify OTP') }}
        </h2>
    </x-slot>

    <div class="max-w-xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
        <form method="POST" action="{{ route('child.verifyOtp') }}">
            @csrf

            {{-- OTP Field --}}
            <div class="mb-4">
                <label for="otp" class="block text-sm font-medium text-gray-700">Enter OTP</label>
                <input type="text" id="otp" name="otp" required class="w-full p-2 border border-gray-300 rounded-lg" placeholder="Enter the OTP sent to your email">
            </div>

            <div class="mt-6">
                <x-primary-button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700">
                    {{ __('Verify OTP') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
