<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\OrdenController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\UsuarioAdminController;
use App\Http\Controllers\ZonaController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/dashboard', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

Route::middleware(['auth', 'permission:0'])->group(function () {
    Route::resource('categoria', CategoriaController::class)->parameters([
        'categoria' => 'categoria'
    ]);
    Route::resource('usuario', UsuarioAdminController::class);
    Route::resource('zona', ZonaController::class);
});

Route::middleware(['auth', 'permission:1'])->group(function () {
    Route::resource('producto', ProductoController::class);
    Route::resource('orden', OrdenController::class);
    Route::resource('reserva', ReservaController::class);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

require __DIR__ . '/auth.php';
