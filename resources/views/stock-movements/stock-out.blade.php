<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Stock Out</h2>
            <p class="text-sm text-gray-500 mt-1">
                Record medicine issued out from the inventory.
            </p>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-xl p-6">
                <form method="POST" action="{{ route('stock-out.store') }}" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="medicine_id" class="block text-sm font-medium text-gray-700">Medicine</label>
                            <select name="medicine_id" id="medicine_id"
                                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500">
                                <option value="">Select medicine</option>
                                @foreach($medicines as $medicine)
                                    <option value="{{ $medicine->id }}" {{ old('medicine_id') == $medicine->id ? 'selected' : '' }}>
                                        {{ $medicine->name }} (Available: {{ $medicine->quantity }} {{ $medicine->unit }})
                                    </option>
                                @endforeach
                            </select>
                            @error('medicine_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity Issued</label>
                            <input type="number" name="quantity" id="quantity" value="{{ old('quantity') }}" min="1"
                                   class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500">
                            @error('quantity')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="reference" class="block text-sm font-medium text-gray-700">Reference</label>
                            <input type="text" name="reference" id="reference" value="{{ old('reference') }}"
                                   placeholder="ISSUE-001"
                                   class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500">
                            @error('reference')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="destination_or_source" class="block text-sm font-medium text-gray-700">Destination</label>
                            <input type="text" name="destination_or_source" id="destination_or_source" value="{{ old('destination_or_source') }}"
                                   placeholder="OPD, Maternity, Ward"
                                   class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500">
                            @error('destination_or_source')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="movement_date" class="block text-sm font-medium text-gray-700">Movement Date</label>
                            <input type="date" name="movement_date" id="movement_date"
                                   value="{{ old('movement_date', now()->format('Y-m-d')) }}"
                                   class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500">
                            @error('movement_date')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="notes" class="block text-sm font-medium text-gray-700">Notes</label>
                        <textarea name="notes" id="notes" rows="4"
                                  class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500">{{ old('notes') }}</textarea>
                        @error('notes')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex flex-col sm:flex-row gap-3 pt-4">
                        <button type="submit"
                                class="px-6 py-3 rounded-lg bg-red-600 text-white font-semibold hover:bg-red-700 transition shadow">
                            Save Stock Out
                        </button>

                        <a href="{{ route('stock-movements.index') }}"
                           class="px-6 py-3 rounded-lg bg-gray-200 text-gray-800 font-semibold hover:bg-gray-300 transition text-center">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>