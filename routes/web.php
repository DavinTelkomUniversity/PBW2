<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

// Nama    : Davin Wahyu Wardana
// NIM     : 6706223003
// Kelas   : D3IF-4603

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
 
    Route::post('/vehicleStore', [VehicleController::class, 'store'])->name('vehicle.store');
    Route::get('/vehicle', [VehicleController::class, 'index'])->name('vehicle.daftarVehicle');
    Route::get('/vehicleTambah', [VehicleController::class, 'create'])->name('vehicle.registrasi');
    Route::put('/vehicleUpdate/{id}', [VehicleController::class, 'update'])->name('vehicle.update');
    Route::get('/vehicleUpdate/{id}', [VehicleController::class, 'edit'])->name('vehicle.editVehicle');

    Route::post('/transactionStore', [TransactionController::class, 'store'])->name('transaction.store');
    Route::get('/transaction', [TransactionController::class, 'index'])->name('transaction.daftarTransaction');
    Route::get('/transactionTambah', [TransactionController::class, 'create'])->name('transaction.registrasi');
    Route::put('/transactionUpdate/{id}', [TransactionController::class, 'update'])->name('transaction.update');
    Route::get('/transactionUpdate/{id}', [TransactionController::class, 'edit'])->name('transaction.editTransaction');
});

require __DIR__.'/auth.php';
// Nama    : Davin Wahyu Wardana
// NIM     : 6706223003
// Kelas   : D3IF-4603
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
