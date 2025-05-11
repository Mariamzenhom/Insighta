<x-app-layout>
    <x-slot name="header">
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Therapy Sessions') }}
        </h2>
    </x-slot>

    <section class="px-4 py-4">
        <a href="{{ route('therapy.session.create') }}"
           class="mb-4 inline-block px-4 py-2 bg-indigo-600 rounded hover:bg-indigo-700">
            + {{ __('Create New Session') }}
        </a>

        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto mt-4">
            <table class="min-w-full bg-white border rounded shadow">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">#</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Client</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Therapist</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Date</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Duration</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sessions as $index => $session)
                        <tr class="border-t">
                            <td class="px-4 py-2">{{ $index + 1 }}</td>
                            <td class="px-4 py-2">{{ $session->user->name ?? 'N/A' }}</td>
                            <td class="px-4 py-2">{{ $session->therapist->user->name  }}</td>
                            <td class="px-4 py-2">{{ \Carbon\Carbon::parse($session->date)->format('Y-m-d H:i') }}</td>
                            <td class="px-4 py-2">{{ $session->duration }} minutes</td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-gray-500">
                                {{ __('No therapy sessions found.') }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>


        </div>
    </section>
</x-app-layout>
