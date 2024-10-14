<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\MedicineController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/phpinfo', function () {
    return phpinfo();
});

Route::get('/ping-mongodb', function () {
    $connection = DB::connection('mongodb');
    $msg = 'MongoDB is accessible!';
    try {
        $connection->command(['ping' => 1]);
    } catch (\Exception  $e) {
        $msg = 'MongoDB is not accessible. Error: ' . $e->getMessage();
    }
    return ['msg' => $msg];
});

Route::get('/', [HomepageController::class, 'index'])->name('homepage');

Route::get('/catalogue', [MedicineController::class, 'indexCatalogue'])->name('catalogue');

Route::get('/prescription', function () {
    return Inertia::render('Prescription');
})->name('prescription');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::prefix('dashboard')->group(function () {
        Route::get('/', fn() => Inertia::render('Dashboard'))->name('dashboard');

        // Manage medicine category
        Route::resource('category', CategoryController::class)->names('dashboard.category');

        // Manage medicine
        Route::resource('medicine', MedicineController::class)->names('dashboard.medicine');
    });

    Route::resource('cart', CartController::class)->names('cart');
});
