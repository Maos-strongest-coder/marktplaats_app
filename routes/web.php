<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdvertisementController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\InboxController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\EmailVerificationController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

Route::get('/advertisements/my', [AdvertisementController::class, 'myAdvertisements'])->name('advertisements.my')->middleware('auth', 'verified');

Route::get('/advertisements/create', [AdvertisementController::class, 'create'])->name('advertisements.create')->middleware('auth', 'verified');
Route::post('/advertisements', [AdvertisementController::class, 'store'])->name('advertisements.store')->middleware('auth', 'verified');

Route::get('/advertisements/{advertisement}', [AdvertisementController::class, 'show'])->name('advertisements.show');




Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register')->middleware('guest');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/email/verify', [EmailVerificationController::class, 'notice'])->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', [EmailVerificationController::class, 'send'])->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login']);

Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/forgot-password',[PasswordController::class , 'showLinkRequestForm'])->middleware('guest')->name('password.request');

Route::post('/forgot-password', [PasswordController::class , 'sendResetLinkEmail'])->middleware('guest')->name('password.email');

Route::get('/reset-password/{token}', [PasswordController::class , 'showResetForm'])->middleware('guest')->name('password.reset');

Route::post('/reset-password', [PasswordController::class , 'reset'])->middleware('guest')->name('password.update');

Route::get('/messages/inbox', [InboxController::class, 'inbox'])->name('inbox')->middleware('auth', 'verified');

Route::post('messages/send', [MessageController::class, 'sendMessage'])->name('messages.send')->middleware('auth');

Route::get('/settings', [SettingsController::class, 'showSettings'])->name('settings.show')->middleware('auth');

Route::put('/settings', [SettingsController::class, 'update'])->name('settings.update');

Route::get('/advertisements/{advertisement}/edit', [AdvertisementController::class, 'edit'])->name('advertisements.edit')->middleware('auth');

Route::put('/advertisements/{advertisement}', [AdvertisementController::class, 'update'])->name('advertisements.update')->middleware('auth');