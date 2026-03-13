<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\StockMovement;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class StockMovementController extends Controller
{
    public function index(): View
    {
        $movements = StockMovement::with(['medicine', 'user'])
            ->latest('movement_date')
            ->latest('id')
            ->paginate(10);

        return view('stock-movements.index', compact('movements'));
    }

    public function createStockIn(): View
    {
        $medicines = Medicine::orderBy('name')->get();

        return view('stock-movements.stock-in', compact('medicines'));
    }

    public function storeStockIn(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'medicine_id' => ['required', 'exists:medicines,id'],
            'quantity' => ['required', 'integer', 'min:1'],
            'reference' => ['nullable', 'string', 'max:100'],
            'destination_or_source' => ['nullable', 'string', 'max:255'],
            'movement_date' => ['required', 'date'],
            'notes' => ['nullable', 'string'],
        ]);

        $medicine = Medicine::findOrFail($validated['medicine_id']);

        StockMovement::create([
            'medicine_id' => $medicine->id,
            'user_id' => Auth::id(),
            'type' => 'in',
            'quantity' => $validated['quantity'],
            'reference' => $validated['reference'],
            'destination_or_source' => $validated['destination_or_source'],
            'movement_date' => $validated['movement_date'],
            'notes' => $validated['notes'],
        ]);

        $medicine->increment('quantity', $validated['quantity']);

        return redirect()
            ->route('stock-movements.index')
            ->with('success', 'Stock in recorded successfully.');
    }

    public function createStockOut(): View
    {
        $medicines = Medicine::orderBy('name')->get();

        return view('stock-movements.stock-out', compact('medicines'));
    }

    public function storeStockOut(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'medicine_id' => ['required', 'exists:medicines,id'],
            'quantity' => ['required', 'integer', 'min:1'],
            'reference' => ['nullable', 'string', 'max:100'],
            'destination_or_source' => ['nullable', 'string', 'max:255'],
            'movement_date' => ['required', 'date'],
            'notes' => ['nullable', 'string'],
        ]);

        $medicine = Medicine::findOrFail($validated['medicine_id']);

        if ($validated['quantity'] > $medicine->quantity) {
            return back()
                ->withInput()
                ->withErrors([
                    'quantity' => 'Stock out quantity cannot be greater than the available stock.',
                ]);
        }

        StockMovement::create([
            'medicine_id' => $medicine->id,
            'user_id' => Auth::id(),
            'type' => 'out',
            'quantity' => $validated['quantity'],
            'reference' => $validated['reference'],
            'destination_or_source' => $validated['destination_or_source'],
            'movement_date' => $validated['movement_date'],
            'notes' => $validated['notes'],
        ]);

        $medicine->decrement('quantity', $validated['quantity']);

        return redirect()
            ->route('stock-movements.index')
            ->with('success', 'Stock out recorded successfully.');
    }
}