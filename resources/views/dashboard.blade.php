<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">
                    MedStock Dashboard
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Overview of medicine inventory, stock alerts, and recent stock activity.
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

        {{-- Quick Navigation --}}
<div class="bg-white shadow rounded-xl p-6">

    <div class="flex items-center justify-between mb-6">
        <div>
            <h3 class="text-lg font-bold text-gray-900">
                Quick Navigation
            </h3>
            <p class="text-sm text-gray-500">
                Access the most commonly used pharmacy inventory actions.
            </p>
        </div>
    </div>

    {{-- Primary Navigation --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

        {{-- Medicines --}}
        <a href="{{ route('medicines.index') }}"
           class="group rounded-xl border border-blue-100 bg-blue-50 p-5 hover:bg-blue-100 transition shadow-sm">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm text-blue-600 font-semibold">
                        Medicines
                    </p>

                    <h4 class="text-lg font-bold text-gray-900 mt-1">
                        Manage Medicines
                    </h4>

                    <p class="text-sm text-gray-600 mt-2">
                        View, add and update medicine records.
                    </p>
                </div>

                <div class="text-3xl">
                    💊
                </div>

            </div>

        </a>


        {{-- Categories --}}
        <a href="{{ route('categories.index') }}"
           class="group rounded-xl border border-green-100 bg-green-50 p-5 hover:bg-green-100 transition shadow-sm">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm text-green-600 font-semibold">
                        Categories
                    </p>

                    <h4 class="text-lg font-bold text-gray-900 mt-1">
                        Manage Categories
                    </h4>

                    <p class="text-sm text-gray-600 mt-2">
                        Organize medicines into groups.
                    </p>
                </div>

                <div class="text-3xl">
                    🗂️
                </div>

            </div>

        </a>


        {{-- Stock In --}}
        <a href="{{ route('stock.in.create') }}"
           class="group rounded-xl border border-emerald-100 bg-emerald-50 p-5 hover:bg-emerald-100 transition shadow-sm">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm text-emerald-600 font-semibold">
                        Stock In
                    </p>

                    <h4 class="text-lg font-bold text-gray-900 mt-1">
                        Receive Medicines
                    </h4>

                    <p class="text-sm text-gray-600 mt-2">
                        Record new medicine deliveries.
                    </p>
                </div>

                <div class="text-3xl">
                    📥
                </div>

            </div>

        </a>


        {{-- Stock Out --}}
        <a href="{{ route('stock.out.create') }}"
           class="group rounded-xl border border-rose-100 bg-rose-50 p-5 hover:bg-rose-100 transition shadow-sm">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm text-rose-600 font-semibold">
                        Stock Out
                    </p>

                    <h4 class="text-lg font-bold text-gray-900 mt-1">
                        Issue Medicines
                    </h4>

                    <p class="text-sm text-gray-600 mt-2">
                        Track medicines issued to patients.
                    </p>
                </div>

                <div class="text-3xl">
                    📤
                </div>

            </div>

        </a>

    </div>


    {{-- Secondary Shortcuts --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">

        <a href="{{ route('medicines.create') }}"
           class="bg-gray-50 border rounded-xl p-4 hover:bg-gray-100 transition shadow-sm">

            <p class="text-sm text-gray-500">
                Shortcut
            </p>

            <h4 class="font-bold text-gray-900 mt-1">
                Add New Medicine
            </h4>

            <p class="text-sm text-gray-600 mt-1">
                Quickly register a new medicine in stock.
            </p>

        </a>


        <a href="{{ route('categories.create') }}"
           class="bg-gray-50 border rounded-xl p-4 hover:bg-gray-100 transition shadow-sm">

            <p class="text-sm text-gray-500">
                Shortcut
            </p>

            <h4 class="font-bold text-gray-900 mt-1">
                Create Category
            </h4>

            <p class="text-sm text-gray-600 mt-1">
                Add a new medicine classification.
            </p>

        </a>


        <a href="{{ route('stock.movements.index') }}"
           class="bg-gray-50 border rounded-xl p-4 hover:bg-gray-100 transition shadow-sm">

            <p class="text-sm text-gray-500">
                Shortcut
            </p>

            <h4 class="font-bold text-gray-900 mt-1">
                View Stock History
            </h4>

            <p class="text-sm text-gray-600 mt-1">
                See all stock in and stock out movements.
            </p>

        </a>

    </div>

</div>

            {{-- Summary Cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-5 gap-6">
                <div class="bg-white shadow rounded-xl p-6">
                    <p class="text-sm font-medium text-gray-500">Total Medicines</p>
                    <h3 class="mt-2 text-3xl font-bold text-gray-900">{{ $totalMedicines }}</h3>
                </div>

                <div class="bg-white shadow rounded-xl p-6">
                    <p class="text-sm font-medium text-gray-500">Total Stock Quantity</p>
                    <h3 class="mt-2 text-3xl font-bold text-gray-900">{{ number_format($totalStockQuantity) }}</h3>
                </div>

                <div class="bg-white shadow rounded-xl p-6">
                    <p class="text-sm font-medium text-gray-500">Low Stock Items</p>
                    <h3 class="mt-2 text-3xl font-bold text-yellow-600">{{ $lowStockCount }}</h3>
                </div>

                <div class="bg-white shadow rounded-xl p-6">
                    <p class="text-sm font-medium text-gray-500">Expired Medicines</p>
                    <h3 class="mt-2 text-3xl font-bold text-red-600">{{ $expiredCount }}</h3>
                </div>

                <div class="bg-white shadow rounded-xl p-6">
                    <p class="text-sm font-medium text-gray-500">Expiring Soon</p>
                    <h3 class="mt-2 text-3xl font-bold text-orange-600">{{ $expiringSoonCount }}</h3>
                </div>
            </div>

            {{-- Alerts Section --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="bg-white shadow rounded-xl p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-bold text-gray-900">Low Stock Alerts</h3>
                    </div>

                    @forelse($lowStockMedicines as $medicine)
                        <div class="flex items-center justify-between border-b py-3 last:border-b-0">
                            <div>
                                <p class="font-semibold text-gray-900">{{ $medicine->name }}</p>
                                <p class="text-sm text-gray-500">
                                    {{ $medicine->category?->name ?? 'No Category' }}
                                </p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-semibold text-yellow-600">
                                    {{ $medicine->quantity }} {{ $medicine->unit }}
                                </p>
                                <p class="text-xs text-gray-500">
                                    Reorder at {{ $medicine->reorder_level }}
                                </p>
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500">No low stock medicines at the moment.</p>
                    @endforelse
                </div>

                <div class="bg-white shadow rounded-xl p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-bold text-gray-900">Expiring Soon</h3>
                    </div>

                    @forelse($expiringMedicines as $medicine)
                        <div class="flex items-center justify-between border-b py-3 last:border-b-0">
                            <div>
                                <p class="font-semibold text-gray-900">{{ $medicine->name }}</p>
                                <p class="text-sm text-gray-500">
                                    Batch: {{ $medicine->batch_number ?: 'N/A' }}
                                </p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-semibold text-orange-600">
                                    {{ $medicine->expiry_date?->format('d M Y') }}
                                </p>
                                <p class="text-xs text-gray-500">
                                    {{ $medicine->quantity }} {{ $medicine->unit }}
                                </p>
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500">No medicines are expiring within 30 days.</p>
                    @endforelse
                </div>
            </div>

            {{-- Recent Movements --}}
            <div class="bg-white shadow rounded-xl p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-bold text-gray-900">Recent Stock Movements</h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full border-collapse">
                        <thead>
                            <tr class="bg-gray-50 border-b">
                                <th class="text-left px-4 py-3 text-sm font-semibold text-gray-600">Date</th>
                                <th class="text-left px-4 py-3 text-sm font-semibold text-gray-600">Medicine</th>
                                <th class="text-left px-4 py-3 text-sm font-semibold text-gray-600">Type</th>
                                <th class="text-left px-4 py-3 text-sm font-semibold text-gray-600">Quantity</th>
                                <th class="text-left px-4 py-3 text-sm font-semibold text-gray-600">Handled By</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentMovements as $movement)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-4 py-3 text-sm text-gray-700">
                                        {{ $movement->movement_date?->format('d M Y') }}
                                    </td>
                                    <td class="px-4 py-3 text-sm text-gray-900 font-medium">
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
                                        {{ $movement->user?->name ?? 'N/A' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-6 text-center text-sm text-gray-500">
                                        No stock movements recorded yet.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>