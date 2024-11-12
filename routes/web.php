<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ProfileController;
use App\Http\Controllers\API\SettingController;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\API\CardDetailsController;

// Route::get('/dashboard', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return redirect(route('login'));
});

Route::group([
    'middleware' => [
        'auth:sanctum',
        'verified',
    ],
], function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::controller(AuthController::class)->group(function () {
        Route::post('logout', 'logout');
    });

    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::view('/profile/edit', 'profile.edit')->name('profile.edit');
});

Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::get('/admin', function () {
        return 'admin';
    })->name('admin');

    Route::get('/settings', [SettingController::class, 'getSettings']);
    Route::post('/settings', [SettingController::class, 'updateSettings']);

    Route::view('/settings/edit', 'settings')->name('settings');
});

Route::middleware(['guest'])->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::post('register', 'register');
        Route::post('login', 'login');
    });

    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');

    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');
});
