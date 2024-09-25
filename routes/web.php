<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


Route::get('/', [UserController::class, 'index'])->name('users.index');

Route::post('/soft-delete/{id}', [UserController::class, 'softDelete'])->name('users.softDelete');

Route::get('/trashed', [UserController::class, 'trashed'])->name('users.trashed');

Route::post('/force-delete/{id}', [UserController::class, 'forceDelete'])->name('users.forceDelete');

Route::post('/restore/{id}', [UserController::class, 'restore'])->name('users.restore');
