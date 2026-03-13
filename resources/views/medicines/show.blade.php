<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">{{ $medicine->name }}</h2>
                <p class="text-sm text-gray-500 mt-1">
                    Detailed view of the selected medicine and its stock information.
                </p>
            </div>

            <div class="flex flex-col sm:flex-row gap-3">
                <a href="{{ route('medicines.edit', $medicine) }}"
                   class="inline-flex items-center justify-center rounded-lg bg-yellow-500 px-5 py-3 text-sm font-semibold text-white shadow hover:bg-yellow-600 transition">
                    Edit Medicine
                </a>

                <a href="{{ route('medicines.index') }}"
                   class="inline-flex items-center justify-center rounded-lg bg-gray-200 px-5 py-3 text-sm font-semibold text-gray-800 shadow hover:bg-gray-300 transition">
                    Back to Medicines
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white shadow rounded-xl p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Medicine Name</p>
                        <p class="mt-1 text-base font-semibold text-gray-900">{{ $medicine->name }}</p>
                    </div>

                    <div>
                        <p class="text-sm font-medium text-gray-500">Category</p>
                        <p class="mt-1 text-base text-gray-900">{{ $medicine->category?->name ?? 'N/A' }}</p>
                    </div>

                    <div>
                        <p class="text-sm font-medium text-gray-500">Dosage Form</p>
                        <p class="mt-1 text-base text-gray-900">{{ $medicine->dosage_form }}</p>
                    </div>

                    <div>
                        <p class="text-sm font-medium text-gray-500">Strength</p>
                        <p class="mt-1 text-base text-gray-900">{{ $medicine->strength ?: 'N/A' }}</p>
                    </div>

                    <div>
                        <p class="text-sm font-medium text-gray-500">Unit</p>
                        <p class="mt-1 text-base text-gray-900">{{ $medicine->unit }}</p>
                    </div>

                    <div>
                        <p class="text-sm font-medium text-gray-500">Current Quantity</p>
                        <p class="mt-1 text-base font-semibold text-gray-900">
                            {{ $medicine->quantity }} {{ $medicine->unit }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm font-medium text-gray-500">Reorder Level</p>
                        <p class="mt-1 text-base text-gray-900">{{ $medicine->reorder_level }}</p>
                    </div>

                    <div>
                        <p class="text-sm font-medium text-gray-500">Batch Number</p>
                        <p class="mt-1 text-base text-gray-900">{{ $medicine->batch_number ?: 'N/A' }}</p>
                    </div>

                    <div>
                        <p class="text-sm font-medium text-gray-500">Expiry Date</p>
                        <p class="mt-1 text-base text-gray-900">
                            {{ $medicine->expiry_date ? $medicine->expiry_date->format('d M Y') : 'N/A' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm font-medium text-gray-500">Supplier</p>
                        <p class="mt-1 text-base text-gray-900">{{ $medicine->supplier ?: 'N/A' }}</p>
                    </div>

                    <div>
                        <p class="text-sm font-medium text-gray-500">Stock Status</p>
                        <div class="mt-2">
                            @php
                                $status = $medicine->stockStatus();
                            @endphp

                            @if($status === 'Expired')
                                <span class="inline-flex rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                                    {{ $status }}
                                </span>
                            @elseif($status === 'Low Stock')
                                <span class="inline-flex rounded-full bg-yellow-100 px-3 py-1 text-xs font-semibold text-yellow-700">
                                    {{ $status }}
                                </span>
                            @elseif($status === 'Expiring Soon')
                                <span class="inline-flex rounded-full bg-orange-100 px-3 py-1 text-xs font-semibold text-orange-700">
                                    {{ $status }}
                                </span>
                            @else
                                <span class="inline-flex rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                    {{ $status }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="md:col-span-2 xl:col-span-3">
                        <p class="text-sm font-medium text-gray-500">Description</p>
                        <p class="mt-1 text-base text-gray-900">
                            {{ $medicine->description ?: 'No description provided.' }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-white shadow rounded-xl p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-bold text-gray-900">Stock Movement History</h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full border-collapse">
                        <thead>
                            <tr class="bg-gray-50 border-b">
                                <th class="text-left px-4 py-3 text-sm font-semibold text-gray-600">Date</th>
                                <th class="text-left px-4 py-3 text-sm font-semibold text-gray-600">Type</th>
                                <th class="text-left px-4 py-3 text-sm font-semibold text-gray-600">Quantity</th>
                                <th class="text-left px-4 py-3 text-sm font-semibold text-gray-600">Reference</th>
                                <th class="text-left px-4 py-3 text-sm font-semibold text-gray-600">Source / Destination</th>
                                <th class="text-left px-4 py-3 text-sm font-semibold text-gray-600">Handled By</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($medicine->stockMovements as $movement)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-4 py-3 text-sm text-gray-700">
                                        {{ $movement->movement_date?->format('d M Y') }}
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
                                    <td class="px-4 py-3 text-sm text-gray-700">{{ $movement->quantity }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-700">{{ $movement->reference ?: 'N/A' }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-700">{{ $movement->destination_or_source ?: 'N/A' }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-700">{{ $movement->user?->name ?? 'N/A' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-4 py-6 text-center text-sm text-gray-500">
                                        No stock movements recorded for this medicine yet.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="bg-white shadow rounded-xl p-6">
                <h3 class="text-lg font-bold text-red-600 mb-4">Danger Zone</h3>

                <form action="{{ route('medicines.destroy', $medicine) }}" method="POST"
                      onsubmit="return confirm('Are you sure you want to delete this medicine?');">
                    @csrf
                    @method('DELETE')

                    <button type="submit"
                            class="px-6 py-3 rounded-lg bg-red-600 text-white font-semibold hover:bg-red-700 transition shadow">
                        Delete Medicine
                    </button>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>