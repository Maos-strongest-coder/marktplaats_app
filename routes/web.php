<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdvertisementController;
use App\Http\Controllers\BidController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\InboxController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\EmailVerificationController;

// public routes
Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

// guest routes
Route::middleware(['guest'])->group(function()  {

    Route::prefix('register')
        ->name('register.')
        ->controller(RegisterController::class)
        ->group(function() {

            Route::get('', 'show')
                ->name('show');

            Route::post('', 'store')
                ->name('store');
        });

    Route::prefix('login')
        ->controller(LoginController::class)
        ->group(function() {
            
            Route::get('', 'showLoginForm')
                ->name('login');
            
            Route::post('', 'login')
                ->name('login.attempt');
        });

    Route::prefix('forgot-password')
        ->name('password.')
        ->controller(PasswordController::class)
        ->group(function() {

            Route::get('', 'showLinkRequestForm')
                ->name('request');
            Route::post('', 'sendResetLink')
                ->name('email');
         });

    Route::prefix('reset-password')
        ->name('password.')
        ->controller(PasswordController::class)
        ->group(function() {

            Route::get('{token}', 'showResetForm')
                ->name('reset');
            Route::post('', 'reset')
                ->name('update');

        });
});

// authenticated routes
Route::middleware(['auth'])->group(function()  {
    
    Route::prefix('email')
        ->name('verification.')
        ->controller(EmailVerificationController::class)
        ->group(function() {
        
            Route::get('verify', 'notice')
                ->name('notice');

            Route::post('verification-notification', 'send')
                ->name('send')
                ->middleware('throttle:6,1');
            
            Route::get('verify/{id}/{hash}', 'verify')
                ->name('verify')
                ->middleware('signed');
            
    });

    Route::prefix('settings')
        ->name('settings.')
        ->controller(SettingsController::class)
        ->group(function() {
            
            Route::get('', 'showSettings')
                ->name('show');
            Route::put('', 'update')
                ->name('update');
        });

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // authenticated and verified routes
    Route::middleware(['verified'])->group(function()  {
    
        Route::prefix('advertisements')
            ->name('advertisements.')
            ->controller(AdvertisementController::class)
            ->group(function() {
                
                Route::get('my', 'myAdvertisements')
                        ->name('my');

                Route::get('create', 'create')
                        ->name('create');

                Route::post('', 'store')
                        ->name('store');

                Route::get('{advertisement}', 'show')
                        ->name('show');

                Route::get('{advertisement}/edit', 'edit')
                        ->name('edit');

                Route::put('{advertisement}', 'update')
                        ->name('update');
                
                Route::delete('{advertisement}', 'destroy')
                    ->name('destroy');
                
                Route::get('{advertisement}/promote', 'promoteForm')
                    ->name('promote');

                Route::post('{advertisement}/promote', 'promote')
                    ->name('promote');

                Route::post('{advertisement}/bids', [BidController::class, 'store'])
                    ->name('bids.store');
            });
    
    
        Route::prefix('messages')
            ->name('messages.')
            ->group(function() {
                
                Route::get('inbox', [InboxController::class, 'inbox'])
                    ->name('inbox');

                Route::post('send', [MessageController::class, 'sendMessage'])
                    ->name('send');
            });
    });
});