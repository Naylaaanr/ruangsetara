<?php

use App\Http\Controllers\Admin\PlaceController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:5,1');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::resource('places', PlaceController::class)->except(['show']);
    
});

Route::get('/tempat', [\App\Http\Controllers\PlaceController::class, 'index'])->name('places.index');
Route::get('/tempat/{place}', [\App\Http\Controllers\PlaceController::class, 'show'])->name('places.show');
Route::get('/rekomendasi', [\App\Http\Controllers\PlaceController::class, 'recommend'])->name('recommendations.index');


