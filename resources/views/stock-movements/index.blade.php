<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Stock Movements</h2>
                <p class="text-sm text-gray-500 mt-1">
                    Track all stock in and stock out activity.
                </p>
            </div>

            <div class="flex flex-col sm:flex-row gap-3">
                <a href="{{ route('stock-in.create') }}"
                   class="inline-flex items-center justify-center rounded-lg bg-green-600 px-5 py-3 text-sm font-semibold text-white shadow hover:bg-green-700 transition">
                    + Stock In
                </a>

                <a href="{{ route('stock-out.create') }}"
                   class="inline-flex items-center justify-center rounded-lg bg-red-600 px-5 py-3 text-sm font-semibold text-white shadow hover:bg-red-700 transition">
                    + Stock Out
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 rounded-lg bg-green-100 border border-green-200 px-4 py-3 text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow rounded-xl overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full border-collapse">
                        <thead>
                            <tr class="bg-gray-50 border-b">
                                <th class="text-left px-4 py-3 text-sm font-semibold text-gray-600">Date</th>
                                <th class="text-left px-4 py-3 text-sm font-semibold text-gray-600">Medicine</th>
                                <th class="text-left px-4 py-3 text-sm font-semibold text-gray-600">Type</th>
                                <th class="text-left px-4 py-3 text-sm font-semibold text-gray-600">Quantity</th>
                                <th class="text-left px-4 py-3 text-sm font-semibold text-gray-600">Reference</th>
                                <th class="text-left px-4 py-3 text-sm font-semibold text-gray-600">Source / Destination</th>
                                <th class="text-left px-4 py-3 text-sm font-semibold text-gray-600">Handled By</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($movements as $movement)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-4 py-3 text-sm text-gray-700">
                                        {{ $movement->movement_date?->format('d M Y') }}
                                    </td>
                                    <td class="px-4 py-3 text-sm font-medium text-gray-900">
                                        {{ $movement->medicine?->name ?? 'N/A' }}
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        @if($movement->type === 'in')
                                            <span class="inline-flex rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                                Stock In
                                            </span>
                                        @elseif($movement->type === 'out')
                                            <span class="inline-flex rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                                                Stock Out
                                            </span>
                                        @else
                                            <span class="inline-flex rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700">
                                                Adjustment
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-sm text-gray-700">
                                        {{ $movement->quantity }}
                                    </td>
                                    <td class="px-4 py-3 text-sm text-gray-700">
                                        {{ $movement->reference ?: 'N/A' }}
                                    </td>
                                    <td class="px-4 py-3 text-sm text-gray-700">
                                        {{ $movement->destination_or_source ?: 'N/A' }}
                                    </td>
                                    <td class="px-4 py-3 text-sm text-gray-700">
                                        {{ $movement->user?->name ?? 'N/A' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-4 py-6 text-center text-sm text-gray-500">
                                        No stock movements recorded yet.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="px-4 py-4 border-t bg-gray-50">
                    {{ $movements->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>