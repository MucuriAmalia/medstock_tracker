<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Reports</h2>
            <p class="text-sm text-gray-500 mt-1">Inventory and stock monitoring reports.</p>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <a href="{{ route('reports.stock-summary') }}" class="bg-white p-6 rounded-xl shadow border hover:shadow-md transition">
                    <h3 class="text-lg font-bold text-gray-900">Stock Summary</h3>
                    <p class="text-sm text-gray-500 mt-2">View all medicines and their current stock status.</p>
                </a>

                <a href="{{ route('reports.low-stock') }}" class="bg-white p-6 rounded-xl shadow border hover:shadow-md transition">
                    <h3 class="text-lg font-bold text-gray-900">Low Stock</h3>
                    <p class="text-sm text-gray-500 mt-2">Identify medicines that need replenishment.</p>
                </a>

                <a href="{{ route('reports.expiry') }}" class="bg-white p-6 rounded-xl shadow border hover:shadow-md transition">
                    <h3 class="text-lg font-bold text-gray-900">Expiry Report</h3>
                    <p class="text-sm text-gray-500 mt-2">Track expired and soon-to-expire medicines.</p>
                </a>

                <a href="{{ route('reports.stock-movements') }}" class="bg-white p-6 rounded-xl shadow border hover:shadow-md transition">
                    <h3 class="text-lg font-bold text-gray-900">Stock Movements</h3>
                    <p class="text-sm text-gray-500 mt-2">Review stock in and stock out history.</p>
                </a>
            </div>

        </div>
    </div>
</x-app-layout>