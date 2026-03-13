<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Expiry Report</h2>
                <p class="text-sm text-gray-500 mt-1">Monitor expired and soon-to-expire medicines.</p>
            </div>
            <div class="flex justify-end">
    <a href="{{ route('reports.expiry.pdf', request()->query()) }}"
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
                <form method="GET" action="{{ route('reports.expiry') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Search Medicine</label>
                        <input type="text" name="search" value="{{ request('search') }}"
                               class="w-full rounded-lg border-gray-300 shadow-sm"
                               placeholder="Enter medicine name">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                        <select name="category_id" class="w-full rounded-lg border-gray-300 shadow-sm">
                            <option value="">All Categories</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @selected(request('category_id') == $category->id)>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Expiry Status</label>
                        <select name="expiry_status" class="w-full rounded-lg border-gray-300 shadow-sm">
                            <option value="">All</option>
                            <option value="expired" @selected(request('expiry_status') === 'expired')>Expired</option>
                            <option value="30_days" @selected(request('expiry_status') === '30_days')>Within 30 Days</option>
                            <option value="90_days" @selected(request('expiry_status') === '90_days')>Within 90 Days</option>
                        </select>
                    </div>

                    <div class="flex items-end gap-2">
                        <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                            Filter
                        </button>

                        <a href="{{ route('reports.expiry') }}"
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
                                <th class="px-4 py-3">Medicine</th>
                                <th class="px-4 py-3">Category</th>
                                <th class="px-4 py-3">Batch Number</th>
                                <th class="px-4 py-3">Quantity</th>
                                <th class="px-4 py-3">Expiry Date</th>
                                <th class="px-4 py-3">Supplier</th>
                                <th class="px-4 py-3">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($medicines as $medicine)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 font-medium text-gray-900">{{ $medicine->name }}</td>
                                    <td class="px-4 py-3">{{ $medicine->category?->name }}</td>
                                    <td class="px-4 py-3">{{ $medicine->batch_number ?? '-' }}</td>
                                    <td class="px-4 py-3">{{ $medicine->quantity }}</td>
                                    <td class="px-4 py-3">{{ \Carbon\Carbon::parse($medicine->expiry_date)->format('d M Y') }}</td>
                                    <td class="px-4 py-3">{{ $medicine->supplier ?? '-' }}</td>
                                    <td class="px-4 py-3">
                                        @if (\Carbon\Carbon::parse($medicine->expiry_date)->isPast())
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-700">Expired</span>
                                        @elseif (\Carbon\Carbon::parse($medicine->expiry_date)->lessThanOrEqualTo(now()->addDays(30)))
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-700">Expiring Soon</span>
                                        @else
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700">Valid</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-4 py-4 text-center text-gray-500">No medicines found for expiry report.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="p-4">
                    {{ $medicines->links() }}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>