<?php

use App\Http\Controllers\V1\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\DressCategoryController;
use App\Http\Controllers\V1\CategoryController;
use App\Http\Controllers\V1\DressController;
use App\Http\Controllers\V1\Client\LanguageController;
use App\Http\Controllers\DressUserController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route
    ::prefix('auth')
    ->name('auth.')
    ->withoutMiddleware('auth.role')
    ->group(function () {
        Route::post('login', [AuthController::class, 'login'])->name('login');
        Route::get('user', [AuthController::class, 'getAuthUser'])->name('user');
        Route::post('refresh', [AuthController::class, 'refreshToken'])->name('refresh');
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    });

Route
    ::prefix('dress')
    ->name('dress.')
    ->withoutMiddleware('auth.role')
    ->group(function () {
        Route::get('list', [DressController::class, 'list'])->name('list');
        Route::get('', [DressController::class, 'get'])->name('get');
    });

Route
    ::prefix('category')
    ->name('category.')
    ->withoutMiddleware('auth.role')
    ->group(function () {
        Route::get('list', [CategoryController::class, 'list'])->name('list');
    });

Route
    ::prefix('language')
    ->name('language.')
    ->withoutMiddleware('auth.role')
    ->group(function () {
        Route::get('list', [LanguageController::class, 'list'])->name('list');
    });


//default with auth.role middleware
Route::prefix('auth')->name('auth.')->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});

Route::prefix('dress')->name('dress.')->group(function () {

    Route::post('save', [DressController::class, 'save'])->name('save');
    Route::delete('delete', [DressController::class, 'delete'])->name('delete');
    Route::patch('update', [DressController::class, 'update'])->name('update');
});

Route::prefix('category')->name('category.')->group(function () {
    Route::get('', [CategoryController::class, 'get'])->name('get');
    Route::post('save', [CategoryController::class, 'save'])->name('save');
    Route::delete('delete', [CategoryController::class, 'delete'])->name('delete');
});

Route::prefix('user')->name('user.')->group(function () {
    Route::get('', [UserController::class, 'get'])->name('get');
    Route::post('save', [UserController::class, 'save'])->name('save');
    Route::get('list', [UserController::class, 'list'])->name('list');
    Route::delete('delete', [UserController::class, 'delete'])->name('delete');
});

Route::prefix('dress_category')->name('dress_category.')->group(function () {
    Route::post('save', [DressCategoryController::class, 'save'])->name('save');
});

Route::prefix('dress_user')->name('dress_user.')->group(function () {
    Route::post('save', [DressUserController::class, 'save'])->name('save');
});

Route::prefix('color')->name('color.')->group(function () {
    Route::get('', [ColorController::class, 'get'])->name('get');
    Route::post('save', [ColorController::class, 'save'])->name('save');
    Route::get('list', [ColorController::class, 'list'])->name('list');
    Route::delete('delete', [ColorController::class, 'delete'])->name('delete');
});

Route::prefix('photo')->name('photo.')->group(function () {
    Route::get('', [PhotoController::class, 'get'])->name('get');
    Route::post('save', [PhotoController::class, 'save'])->name('save');
    Route::get('list', [PhotoController::class, 'list'])->name('list');
    Route::delete('delete', [PhotoController::class, 'delete'])->name('delete');
});

Route::prefix('size')->name('size.')->group(function () {
    Route::get('', [SizeController::class, 'get'])->name('get');
    Route::post('save', [SizeController::class, 'save'])->name('save');
    Route::get('list', [SizeController::class, 'list'])->name('list');
    Route::delete('delete', [SizeController::class, 'delete'])->name('delete');
});

Route::prefix('booking')->name('booking.')->group(function () {
    Route::get('list', [BookingController::class, 'list'])->name('list');
    Route::post('save', [BookingController::class, 'save'])->name('save');
    Route::patch('cancel', [BookingController::class, 'cancel'])->name('cancel');
    Route::get('status', [BookingController::class, 'status'])->name('status');
    Route::get('available', [BookingController::class, 'available'])->name('available');
});
