<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\GeneralInfoController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\RoomTypesController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\ReservedRoomController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});


Route::group(['prefix' => 'dashboard', 'auth:sanctum', 'verified'], function () {
    Route::get('/', function () {
        return redirect()->route('general');
    });

    // General
    Route::get('/general', [GeneralInfoController::class, 'index'])->name('general');
    Route::post('/general', [GeneralInfoController::class, 'store'])->name('general.store');
    Route::patch('/general/{general}', [GeneralInfoController::class, 'update'])->name('general.update');

    // Services
    Route::group(['prefix' => 'services'], function () {
        Route::get('/', [ServicesController::class, 'index'])->name('services.index');
        Route::get('/create', [ServicesController::class, 'create'])->name('services.create');
        Route::post('/', [ServicesController::class, 'store'])->name('services.store');
        Route::get('/{service}/edit', [ServicesController::class, 'edit'])->name('services.edit');
        Route::patch('/{service}', [ServicesController::class, 'update'])->name('services.update');
        Route::delete('/{service}', [ServicesController::class, 'destroy'])->name('services.destroy');
    });

    // Room types
    Route::group(['prefix' => 'room-type'], function () {
        Route::get('/', [RoomTypesController::class, 'index'])->name('room_type.index');
        Route::get('/create', [RoomTypesController::class, 'create'])->name('room_type.create');
        Route::post('/', [RoomTypesController::class, 'store'])->name('room_type.store');
        Route::get('/{room_type}/edit', [RoomTypesController::class, 'edit'])->name('room_type.edit');
        Route::patch('/{room_type}', [RoomTypesController::class, 'update'])->name('room_type.update');
        Route::delete('/{room_type}', [RoomTypesController::class, 'destroy'])->name('room_type.destroy');
    });

    // Rooms
    Route::group(['prefix' => 'rooms'], function () {
        Route::get('/', [RoomController::class, 'index'])->name('rooms.index');
        Route::get('/create', [RoomController::class, 'create'])->name('rooms.create');
        Route::post('/', [RoomController::class, 'store'])->name('rooms.store');
        Route::get('/{room}/edit', [RoomController::class, 'edit'])->name('rooms.edit');
        Route::patch('/{room}', [RoomController::class, 'update'])->name('rooms.update');
        Route::delete('/{room}', [RoomController::class, 'destroy'])->name('rooms.destroy');
    });

    // Media
    Route::get('/media', [MediaController::class, 'index'])->name('media');

    // Reserved rooms
    Route::get('/reserved-rooms', [ReservedRoomController::class, 'index'])->name('reserved.index');
    Route::delete('/reserved-rooms/{reservedRoom}', [ReservedRoomController::class, 'destroy'])->name('reserved.destroy');
});

// Public routes
Route::get('/', function () {
    return Inertia::render('Home');
})->name('home');
Route::get('/rooms', [RoomController::class, 'roomsPublic'])->name('rooms.public');

Route::get('/galerie', function () {
    return Inertia::render('Media');
})->name('media');

Route::get('/contact', [GeneralInfoController::class, 'contact'])->name('contact');

// Reserved rooms
Route::post('/reserved-rooms', [ReservedRoomController::class, 'store'])->name('reserved.public');
