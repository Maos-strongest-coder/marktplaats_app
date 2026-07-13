<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\IndexController;
use App\Http\Controllers\AdvertisementController;

Route::get('/', [IndexController::class, 'index'])->name('index');

Route::get('/advertisements/{advertisement}', [AdvertisementController::class, 'show'])->name('advertisements.show');