<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClienteController;
use App\Models\Cliente;
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