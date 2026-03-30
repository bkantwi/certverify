<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'showHome'])->name('home');
Route::post('/verify-certificate', [HomeController::class, 'verify']);
