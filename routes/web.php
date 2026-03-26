<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ActivityLogController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

require __DIR__.'/auth.php';
require __DIR__.'/profile.php';

Route::middleware(['auth', \App\Http\Middleware\EnsureUserIsAdmin::class])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Inventory must be declared before resource 'books/{book}' to avoid route parameter collision.
    Route::get('books/inventory', [BookController::class, 'inventory'])->name('books.inventory');
    Route::resource('books', BookController::class);
    Route::get('loans', [LoanController::class, 'index'])->name('loans.index');
    Route::get('reports', [ReportController::class, 'index'])->name('reports.index');

    Route::resource('reservations', ReservationController::class)->only(['index', 'create', 'store']);
    Route::post('reservations/{reservation}/cancel', [ReservationController::class, 'cancel'])->name('reservations.cancel');

    Route::get('activity', [ActivityLogController::class, 'index'])->name('activity.index');

    Route::post('books/{book}/borrow', [BookController::class, 'borrow'])->name('books.borrow');
    Route::post('books/borrow/bulk', [BookController::class, 'borrowBulk'])->name('books.borrow.bulk');
    Route::patch('books/{book}/return', [BookController::class, 'returnBook'])->name('books.return');

    // Admin management
    Route::get('admins', [AdminController::class, 'index'])->name('admins.index');
    Route::get('admins/create', [AdminController::class, 'create'])->name('admins.create');
    Route::post('admins', [AdminController::class, 'store'])->name('admins.store');
});
