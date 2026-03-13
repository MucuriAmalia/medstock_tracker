<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\StockMovementController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Categories
    Route::resource('categories', CategoryController::class);

    // Medicines
    Route::resource('medicines', MedicineController::class);

    // Stock movements
    Route::get('/stock-movements', [StockMovementController::class, 'index'])->name('stock-movements.index');

    Route::get('/stock-in', [StockMovementController::class, 'createStockIn'])->name('stock-in.create');
    Route::post('/stock-in', [StockMovementController::class, 'storeStockIn'])->name('stock-in.store');

    Route::get('/stock-out', [StockMovementController::class, 'createStockOut'])->name('stock-out.create');
    Route::post('/stock-out', [StockMovementController::class, 'storeStockOut'])->name('stock-out.store');

    // Reports
    Route::prefix('reports')->name('reports.')->group(function () {
        Route::get('/', [ReportController::class, 'index'])->name('index');

        Route::get('/stock-summary', [ReportController::class, 'stockSummary'])->name('stock-summary');
        Route::get('/low-stock', [ReportController::class, 'lowStock'])->name('low-stock');
        Route::get('/expiry', [ReportController::class, 'expiry'])->name('expiry');
        Route::get('/stock-movements', [ReportController::class, 'stockMovements'])->name('stock-movements');

        Route::get('/stock-summary/pdf', [ReportController::class, 'exportStockSummaryPdf'])->name('stock-summary.pdf');
        Route::get('/low-stock/pdf', [ReportController::class, 'exportLowStockPdf'])->name('low-stock.pdf');
        Route::get('/expiry/pdf', [ReportController::class, 'exportExpiryPdf'])->name('expiry.pdf');
        Route::get('/stock-movements/pdf', [ReportController::class, 'exportStockMovementsPdf'])->name('stock-movements.pdf');
    });
});

require __DIR__.'/auth.php';