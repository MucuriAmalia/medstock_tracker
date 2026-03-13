<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\StockMovement;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalMedicines = Medicine::count();

        $totalStockQuantity = Medicine::sum('quantity');

        $lowStockCount = Medicine::whereColumn('quantity', '<=', 'reorder_level')->count();

        $expiredCount = Medicine::whereNotNull('expiry_date')
            ->whereDate('expiry_date', '<', now()->toDateString())
            ->count();

        $expiringSoonCount = Medicine::whereNotNull('expiry_date')
            ->whereDate('expiry_date', '>=', now()->toDateString())
            ->whereDate('expiry_date', '<=', now()->addDays(30)->toDateString())
            ->count();

        $recentMovements = StockMovement::with(['medicine', 'user'])
            ->latest()
            ->take(5)
            ->get();

        $lowStockMedicines = Medicine::with('category')
            ->whereColumn('quantity', '<=', 'reorder_level')
            ->orderBy('quantity')
            ->take(5)
            ->get();

        $expiringMedicines = Medicine::with('category')
            ->whereNotNull('expiry_date')
            ->whereDate('expiry_date', '>=', now()->toDateString())
            ->whereDate('expiry_date', '<=', now()->addDays(30)->toDateString())
            ->orderBy('expiry_date')
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalMedicines',
            'totalStockQuantity',
            'lowStockCount',
            'expiredCount',
            'expiringSoonCount',
            'recentMovements',
            'lowStockMedicines',
            'expiringMedicines'
        ));
    }
}