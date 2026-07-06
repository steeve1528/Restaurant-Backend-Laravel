<?php

use App\Http\Controllers\TableController;
use Illuminate\Support\Facades\Route;

Route::get('/tables', [TableController::class, 'index'])->name('tables.index');
Route::post('/tables/{table}/{action}', [TableController::class, 'action'])->name('tables.action');
