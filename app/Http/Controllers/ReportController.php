<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Medicine;
use App\Models\StockMovement;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ReportController extends Controller
{
    public function index()
    {
        return view('reports.index');
    }

    public function stockSummary(Request $request)
    {
        $query = Medicine::with('category');

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('stock_status')) {
            if ($request->stock_status === 'low') {
                $query->whereColumn('quantity', '<=', 'reorder_level')
                      ->where('quantity', '>', 0);
            } elseif ($request->stock_status === 'out') {
                $query->where('quantity', 0);
            } elseif ($request->stock_status === 'in') {
                $query->whereColumn('quantity', '>', 'reorder_level');
            }
        }

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $medicines = $query->latest()->paginate(10)->withQueryString();
        $categories = Category::orderBy('name')->get();

        return view('reports.stock-summary', compact('medicines', 'categories'));
    }

    public function lowStock(Request $request)
    {
        $query = Medicine::with('category')
            ->whereColumn('quantity', '<=', 'reorder_level');

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $medicines = $query->orderBy('quantity')->paginate(10)->withQueryString();
        $categories = Category::orderBy('name')->get();

        return view('reports.low-stock', compact('medicines', 'categories'));
    }

    public function expiry(Request $request)
    {
        $query = Medicine::with('category')->whereNotNull('expiry_date');

        if ($request->filled('expiry_status')) {
            if ($request->expiry_status === 'expired') {
                $query->whereDate('expiry_date', '<', Carbon::today());
            } elseif ($request->expiry_status === '30_days') {
                $query->whereBetween('expiry_date', [Carbon::today(), Carbon::today()->copy()->addDays(30)]);
            } elseif ($request->expiry_status === '90_days') {
                $query->whereBetween('expiry_date', [Carbon::today(), Carbon::today()->copy()->addDays(90)]);
            }
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $medicines = $query->orderBy('expiry_date')->paginate(10)->withQueryString();
        $categories = Category::orderBy('name')->get();

        return view('reports.expiry', compact('medicines', 'categories'));
    }

    public function stockMovements(Request $request)
    {
        $query = StockMovement::with(['medicine.category', 'user']);

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('medicine_id')) {
            $query->where('medicine_id', $request->medicine_id);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('movement_date', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('movement_date', '<=', $request->date_to);
        }

        $movements = $query->latest('movement_date')->paginate(10)->withQueryString();
        $medicines = Medicine::orderBy('name')->get();

        return view('reports.stock-movements', compact('movements', 'medicines'));
    }

    public function exportStockSummaryPdf(Request $request)
{
    $query = Medicine::with('category');

    if ($request->filled('category_id')) {
        $query->where('category_id', $request->category_id);
    }

    if ($request->filled('stock_status')) {
        if ($request->stock_status === 'low') {
            $query->whereColumn('quantity', '<=', 'reorder_level')
                  ->where('quantity', '>', 0);
        } elseif ($request->stock_status === 'out') {
            $query->where('quantity', 0);
        } elseif ($request->stock_status === 'in') {
            $query->whereColumn('quantity', '>', 'reorder_level');
        }
    }

    if ($request->filled('search')) {
        $query->where('name', 'like', '%' . $request->search . '%');
    }

    $medicines = $query->orderBy('name')->get();

    $pdf = Pdf::loadView('reports.pdf.stock-summary', compact('medicines'))
        ->setPaper('a4', 'landscape');

    return $pdf->download('stock-summary-report.pdf');
}

public function exportLowStockPdf(Request $request)
{
    $query = Medicine::with('category')
        ->whereColumn('quantity', '<=', 'reorder_level');

    if ($request->filled('category_id')) {
        $query->where('category_id', $request->category_id);
    }

    if ($request->filled('search')) {
        $query->where('name', 'like', '%' . $request->search . '%');
    }

    $medicines = $query->orderBy('quantity')->get();

    $pdf = Pdf::loadView('reports.pdf.low-stock', compact('medicines'))
        ->setPaper('a4', 'landscape');

    return $pdf->download('low-stock-report.pdf');
}

public function exportExpiryPdf(Request $request)
{
    $query = Medicine::with('category')->whereNotNull('expiry_date');

    if ($request->filled('expiry_status')) {
        if ($request->expiry_status === 'expired') {
            $query->whereDate('expiry_date', '<', now()->toDateString());
        } elseif ($request->expiry_status === '30_days') {
            $query->whereBetween('expiry_date', [now()->toDateString(), now()->addDays(30)->toDateString()]);
        } elseif ($request->expiry_status === '90_days') {
            $query->whereBetween('expiry_date', [now()->toDateString(), now()->addDays(90)->toDateString()]);
        }
    }

    if ($request->filled('category_id')) {
        $query->where('category_id', $request->category_id);
    }

    if ($request->filled('search')) {
        $query->where('name', 'like', '%' . $request->search . '%');
    }

    $medicines = $query->orderBy('expiry_date')->get();

    $pdf = Pdf::loadView('reports.pdf.expiry', compact('medicines'))
        ->setPaper('a4', 'landscape');

    return $pdf->download('expiry-report.pdf');
}

public function exportStockMovementsPdf(Request $request)
{
    $query = StockMovement::with(['medicine.category', 'user']);

    if ($request->filled('type')) {
        $query->where('type', $request->type);
    }

    if ($request->filled('medicine_id')) {
        $query->where('medicine_id', $request->medicine_id);
    }

    if ($request->filled('date_from')) {
        $query->whereDate('movement_date', '>=', $request->date_from);
    }

    if ($request->filled('date_to')) {
        $query->whereDate('movement_date', '<=', $request->date_to);
    }

    $movements = $query->latest('movement_date')->get();

    $pdf = Pdf::loadView('reports.pdf.stock-movements', compact('movements'))
        ->setPaper('a4', 'landscape');

    return $pdf->download('stock-movements-report.pdf');
}
}