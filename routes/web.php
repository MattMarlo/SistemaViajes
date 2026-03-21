<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\DestinoController;
use App\Http\Controllers\ReservaController;
use App\Models\Cliente;
use App\Models\Reserva;
use GuzzleHttp\Client;

Route::get('/', function () {
    return view('layouts.main');
});
Route::prefix('usuarios')->group(function() {
    Route::get('/', [UserController::class, 'index'])->name('usuarios');
    Route::get('/create', [UserController::class, 'create'])->name('usuarios.create');
    Route::post('/store', [UserController::class, 'store'])->name('usuarios.store');
    Route::delete('/destroy/{id}', [UserController::class, 'destroy'])->name('usuarios.destroy');
    Route::get('/edit/{id}', [UserController::class, 'edit'])->name('usuarios.edit');
    Route::put('/update/{id}', [UserController::class, 'update'])->name('usuarios.update');
});
Route::prefix('clientes')->group(function() {
    Route::get('/', [ClienteController::class, 'index'])->name('clientes');
    Route::get('/create', [ClienteController::class, 'create'])->name('clientes.create');
    Route::post('/store', [ClienteController::class, 'store'])->name('clientes.store');
    Route::delete('/destroy/{id}', [ClienteController::class, 'destroy'])->name('clientes.destroy');
    Route::get('/edit/{id}', [ClienteController::class, 'edit'])->name('clientes.edit');
    Route::put('/update/{id}', [ClienteController::class, 'update'])->name('clientes.update');
});
Route::prefix('destinos')->group(function() {
    Route::get('/', [DestinoController::class, 'index'])->name('destinos');
    Route::get('/create', [DestinoController::class, 'create'])->name('destinos.create');
    Route::post('/store', [DestinoController::class, 'store'])->name('destinos.store');
    Route::delete('/destroy/{id}', [DestinoController::class, 'destroy'])->name('destinos.destroy');
    Route::get('/edit/{id}', [DestinoController::class, 'edit'])->name('destinos.edit');
    Route::put('/update/{id}', [DestinoController::class, 'update'])->name('destinos.update');
});
Route::prefix('reservas')->group(function() {
    Route::get('/', [ReservaController::class, 'index'])->name('reservas');
    Route::get('/create', [ReservaController::class, 'create'])->name('reservas.create');
    Route::post('/store', [ReservaController::class, 'store'])->name('reservas.store');
    
});


