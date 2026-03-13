<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Stock Movements Report</h2>
                <p class="text-sm text-gray-500 mt-1">Track all stock in and stock out activities.</p>
            </div>
            <div class="flex justify-end">
    <a href="{{ route('reports.stock-movements.pdf', request()->query()) }}"
       class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
        Export PDF
    </a>
</div>

            <a href="{{ route('reports.index') }}"
               class="inline-flex items-center px-4 py-2 bg-gray-100 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-200">
                Back to Reports
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white shadow rounded-xl p-6">
                <form method="GET" action="{{ route('reports.stock-movements') }}" class="grid grid-cols-1 md:grid-cols-5 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Movement Type</label>
                        <select name="type" class="w-full rounded-lg border-gray-300 shadow-sm">
                            <option value="">All</option>
                            <option value="in" @selected(request('type') === 'in')>Stock In</option>
                            <option value="out" @selected(request('type') === 'out')>Stock Out</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Medicine</label>
                        <select name="medicine_id" class="w-full rounded-lg border-gray-300 shadow-sm">
                            <option value="">All Medicines</option>
                            @foreach ($medicines as $medicine)
                                <option value="{{ $medicine->id }}" @selected(request('medicine_id') == $medicine->id)>
                                    {{ $medicine->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Date From</label>
                        <input type="date" name="date_from" value="{{ request('date_from') }}"
                               class="w-full rounded-lg border-gray-300 shadow-sm">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Date To</label>
                        <input type="date" name="date_to" value="{{ request('date_to') }}"
                               class="w-full rounded-lg border-gray-300 shadow-sm">
                    </div>

                    <div class="flex items-end gap-2">
                        <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                            Filter
                        </button>

                        <a href="{{ route('reports.stock-movements') }}"
                           class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200">
                            Reset
                        </a>
                    </div>
                </form>
            </div>

            <div class="bg-white shadow rounded-xl overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left">
                        <thead class="bg-gray-50 text-gray-700">
                            <tr>
                                <th class="px-4 py-3">Date</th>
                                <th class="px-4 py-3">Medicine</th>
                                <th class="px-4 py-3">Category</th>
                                <th class="px-4 py-3">Type</th>
                                <th class="px-4 py-3">Quantity</th>
                                <th class="px-4 py-3">Reference</th>
                                <th class="px-4 py-3">User</th>
                                <th class="px-4 py-3">Notes</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($movements as $movement)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3">
                                        {{ \Carbon\Carbon::parse($movement->movement_date)->format('d M Y') }}
                                    </td>
                                    <td class="px-4 py-3 font-medium text-gray-900">
                                        {{ $movement->medicine?->name }}
                                    </td>
                                    <td class="px-4 py-3">
                                        {{ $movement->medicine?->category?->name ?? '-' }}
                                    </td>
                                    <td class="px-4 py-3">
                                        @if ($movement->type === 'in')
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700">Stock In</span>
                                        @else
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-700">Stock Out</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3">{{ $movement->quantity }}</td>
                                    <td class="px-4 py-3">{{ $movement->reference ?? '-' }}</td>
                                    <td class="px-4 py-3">{{ $movement->user?->name ?? '-' }}</td>
                                    <td class="px-4 py-3">{{ $movement->notes ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-4 py-4 text-center text-gray-500">No stock movements found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="p-4">
                    {{ $movements->links() }}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>