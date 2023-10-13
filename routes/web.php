<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/app/absensi');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('app')->middleware(['auth'])->group(function () {
    Route::get('/users', [App\Http\Controllers\App\UserController::class, 'index'])->name('app.users.index');
    Route::get('/users/create', [App\Http\Controllers\App\UserController::class, 'create'])->name('app.users.create');
    Route::get('/users/{user}/edit-password', [App\Http\Controllers\App\UserController::class, 'editPassword'])->name('app.users.edit-password');
    Route::get('/users/{user}/edit-role', [App\Http\Controllers\App\UserController::class, 'editRole'])->name('app.users.edit-role');
    Route::post('/users', [App\Http\Controllers\App\UserController::class, 'store'])->name('app.users.store');
    Route::put('/users/{user}/update-password', [App\Http\Controllers\App\UserController::class, 'updatePassword'])->name('app.users.update-password');
    Route::put('/users/{user}/update-role', [App\Http\Controllers\App\UserController::class, 'updateRole'])->name('app.users.update-role');
    Route::delete('/users/{user}', [App\Http\Controllers\App\UserController::class, 'destroy'])->name('app.users.destroy');

    Route::get('/absensi', [App\Http\Controllers\App\AbsensiController::class, 'index'])->name('app.absensi.index');
    Route::get('/absensi/create', [App\Http\Controllers\App\AbsensiController::class, 'create'])->name('app.absensi.create');
    Route::post('/absensi', [App\Http\Controllers\App\AbsensiController::class, 'store'])->name('app.absensi.store');


    Route::get('/rekap-absensi', [App\Http\Controllers\App\RekapAbsensiController::class, 'index'])->name('app.rekap-absensi.index');
    Route::get('/rekap-absensi-per-bulan', [App\Http\Controllers\App\RekapAbsensiController::class, 'rekapPerBulan'])->name('app.rekap-absensi-per-bulan.index');
});

require __DIR__ . '/auth.php';
