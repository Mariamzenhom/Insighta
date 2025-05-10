<x-app-layout>
    <x-slot name="header">
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Therapists') }}
        </h2>
    </x-slot>

    <section class="px-4 py-4">

            <a href="{{ route('therapist.create') }}"
            class="mb-4 inline-block px-4 py-2 bg-indigo-600 rounded hover:bg-indigo-700">
                + {{ __('Add Therapist') }}
            </a>
            
        <div class="overflow-x-auto mt-4">
            <table class="min-w-full bg-white border rounded shadow">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">{{ __('Name') }}</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">{{ __('Specialty') }}</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">{{ __('Rating') }}</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">{{ __('Price') }}</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $therapist)
                        <tr class="border-t">
                            <td class="px-4 py-2">{{ $therapist->user?->name }}</td>
                            <td class="px-4 py-2">{{ $therapist->specialty }}</td>
                            <td class="px-4 py-2">{{ $therapist->rating }}</td>
                            <td class="px-4 py-2">{{ $therapist->price }}</td>
                            <td class="px-4 py-2">
                                <a href="{{ route('therapist.edit', ['id' => $therapist->id]) }}" class="text-blue-600 hover:underline mr-2">Edit</a>
                                <form action="{{ route('therapist.delete', ['id' => $therapist->id]) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-gray-500">{{ __('No therapists found.') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>


        </div>
    </section>
</x-app-layout>
