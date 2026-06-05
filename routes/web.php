<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminReservationController;
use App\Http\Controllers\AdminRoomController;
use App\Http\Controllers\AdminSettingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/reservar',            [ReservationController::class, 'select'])->name('reservation.select');
Route::get('/pago',                [ReservationController::class, 'checkout'])->name('reservation.checkout');
Route::post('/pago',               [ReservationController::class, 'store'])->name('reservation.store');
Route::get('/confirmacion/{code}', [ReservationController::class, 'confirmation'])->name('reservation.confirmation');

// ── Admin ────────────────────────────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('login',  [AdminAuthController::class, 'loginForm'])->name('login');
    Route::post('login', [AdminAuthController::class, 'login'])->name('login.post');
    Route::post('logout',[AdminAuthController::class, 'logout'])->name('logout');

    Route::middleware('auth')->group(function () {
        Route::get('/', fn () => redirect()->route('admin.habitaciones'))->name('dashboard');

        // Habitaciones
        Route::get('habitaciones',           [AdminRoomController::class, 'index'])->name('habitaciones');
        Route::get('habitaciones/{room}',    [AdminRoomController::class, 'show'])->name('habitaciones.show');
        Route::patch('habitaciones/{room}',  [AdminRoomController::class, 'update'])->name('habitaciones.update');
        Route::post('habitaciones/{room}/fotos', [AdminRoomController::class, 'uploadPhotos'])->name('habitaciones.fotos.upload');

        // Fotos (resource independiente)
        Route::delete('fotos/{image}',          [AdminRoomController::class, 'deletePhoto'])->name('fotos.delete');
        Route::patch('fotos/{image}/primary',   [AdminRoomController::class, 'setPrimary'])->name('fotos.primary');
        Route::patch('fotos/{image}/order',     [AdminRoomController::class, 'reorderPhoto'])->name('fotos.order');

        // Reservas
        Route::get('reservas',                          [AdminReservationController::class, 'index'])->name('reservas');
        Route::patch('reservas/{reservation}/status',   [AdminReservationController::class, 'updateStatus'])->name('reservas.status');

        // Configuración
        Route::get('configuracion',  [AdminSettingController::class, 'edit'])->name('configuracion');
        Route::put('configuracion',  [AdminSettingController::class, 'update'])->name('configuracion.update');
    });
});
