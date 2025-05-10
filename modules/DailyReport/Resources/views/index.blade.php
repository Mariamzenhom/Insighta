<x-app-layout>
    <x-slot name="header">
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Daily Reports') }}
        </h2>
    </x-slot>

    <section class="px-4 py-4">

        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto mt-4">
            <table class="min-w-full bg-white border rounded shadow">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Report Title</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">User</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Status</th>
                    </tr>
                </thead>
                <tbody>
                     @forelse($reports as  $report)
                        <tr class="border-t">
                            <td class="px-4 py-2">{{ $report->report ?? 'N/A' }}</td>
                            <td class="px-4 py-2">{{ $report->user->name ?? 'N/A' }}</td>
                            <td class="px-4 py-2">{{ $report->status ?? 'N/A' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 text-gray-500">
                                {{ __('No reports found.') }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </section>
</x-app-layout>
