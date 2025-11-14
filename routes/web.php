<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route("login");
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Products protected routes (only admin can access)
Route::resource('products', ProductController::class)
    ->except('show')
    ->middleware(['auth', 'can:admin']);

// Customer route (Access: admin and employee)

Route::middleware(['auth', 'can:employee-management'])->group(function () {
    Route::get('/customers/trash/', [CustomerController::class, 'trashIndex'])
    ->name('customers.trash');

    Route::delete('/customers/force-delete/{customer}', [CustomerController::class, 'forceDelete'])
        ->withTrashed() // Use withTrashed() to ensure the model is found
        ->name('customers.forceDelete');

    Route::patch('/customers/trash/{customer}', [CustomerController::class, 'restore'])
    ->withTrashed()
    ->name('customers.restore');

    Route::delete('/customers/{customer}/softdelete', [CustomerController::class, 'softDelete'])
    ->name('customers.softDelete');
});

Route::resource('customers', CustomerController::class)
    ->except(['show', 'destroy'])
    ->middleware(['auth', 'can:employee-management']);

/**
 * Purchase routes
 */
Route::resource('purchases', PurchaseController::class)
    ->only(['index', 'create', 'store', 'destroy'])
    ->middleware(['auth', 'can:employee-management']);

require __DIR__.'/auth.php';
