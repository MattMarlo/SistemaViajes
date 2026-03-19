<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
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
