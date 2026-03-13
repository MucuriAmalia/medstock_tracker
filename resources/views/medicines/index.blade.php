<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Medicines</h2>
                <p class="text-sm text-gray-500 mt-1">
                    Manage all medicines in the inventory.
                </p>
            </div>

            <a href="{{ route('medicines.create') }}"
               class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-5 py-3 text-sm font-semibold text-white shadow hover:bg-blue-700 transition">
                + Add Medicine
            </a>
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
                                <th class="text-left px-4 py-3 text-sm font-semibold text-gray-600">Name</th>
                                <th class="text-left px-4 py-3 text-sm font-semibold text-gray-600">Category</th>
                                <th class="text-left px-4 py-3 text-sm font-semibold text-gray-600">Dosage Form</th>
                                <th class="text-left px-4 py-3 text-sm font-semibold text-gray-600">Strength</th>
                                <th class="text-left px-4 py-3 text-sm font-semibold text-gray-600">Quantity</th>
                                <th class="text-left px-4 py-3 text-sm font-semibold text-gray-600">Status</th>
                                <th class="text-left px-4 py-3 text-sm font-semibold text-gray-600">Expiry Date</th>
                                <th class="text-left px-4 py-3 text-sm font-semibold text-gray-600">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($medicines as $medicine)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-4 py-3 text-sm font-medium text-gray-900">
                                        {{ $medicine->name }}
                                    </td>
                                    <td class="px-4 py-3 text-sm text-gray-700">
                                        {{ $medicine->category?->name ?? 'N/A' }}
                                    </td>
                                    <td class="px-4 py-3 text-sm text-gray-700">
                                        {{ $medicine->dosage_form }}
                                    </td>
                                    <td class="px-4 py-3 text-sm text-gray-700">
                                        {{ $medicine->strength ?: 'N/A' }}
                                    </td>
                                    <td class="px-4 py-3 text-sm text-gray-700">
                                        {{ $medicine->quantity }} {{ $medicine->unit }}
                                    </td>
                                    <td class="px-4 py-3 text-sm">
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
                                    </td>
                                    <td class="px-4 py-3 text-sm text-gray-700">
                                        {{ $medicine->expiry_date ? $medicine->expiry_date->format('d M Y') : 'N/A' }}
                                    </td>
                                    <td class="px-4 py-3 text-sm text-gray-700">
                                        <div class="flex items-center gap-3">
                                            <a href="{{ route('medicines.show', $medicine) }}"
                                               class="text-blue-600 hover:underline">View</a>
                                            <a href="{{ route('medicines.edit', $medicine) }}"
                                               class="text-yellow-600 hover:underline">Edit</a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-4 py-6 text-center text-sm text-gray-500">
                                        No medicines have been added yet.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="px-4 py-4 border-t bg-gray-50">
                    {{ $medicines->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>