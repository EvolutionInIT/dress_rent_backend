<?php

use App\Http\Controllers\V1\Admin\BookingController;
use App\Http\Controllers\V1\Admin\CategoryController;
use App\Http\Controllers\V1\Admin\ColorController;
use App\Http\Controllers\V1\Admin\DressController;
use App\Http\Controllers\V1\Admin\PhotoController;
use App\Http\Controllers\V1\Admin\SizeController;
use App\Http\Controllers\V1\Admin\UserController;
use App\Http\Controllers\V1\AuthController;
use App\Http\Controllers\V1\Client\Rent\CategoryController as CategoryControllerClientRent;
use App\Http\Controllers\V1\Client\Rent\Booking\SaveBookingClientRentController;
use App\Http\Controllers\V1\Client\LanguageControllerClient;
use App\Http\Controllers\V1\Admin\ComponentController;
use App\Http\Controllers\V1\Client\Rent\Catalog\DressCatalogController;
use App\Http\Controllers\V1\Client\Rent\Catalog\ListDressCatalogController;
use Illuminate\Support\Facades\Route;

Route
    ::prefix('language')->name('language.')
    ->withoutMiddleware('auth.role')
    ->group(function () {
        Route::get('list', [LanguageControllerClient::class, 'list'])->name('list');
    });

Route
    ::prefix('auth')->name('auth.')
    ->withoutMiddleware('auth.role')
    ->group(function () {
        Route::post('login', [AuthController::class, 'login'])->name('login');
        Route::post('refresh', [AuthController::class, 'refreshToken'])->name('refresh');
    });

Route
    ::prefix('auth')->name('auth.')
    ->group(function () {
        Route::get('user', [AuthController::class, 'getAuthUser'])->name('user');
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    });

//client module
Route
    ::prefix('client')
    ->name('client.')
    ->withoutMiddleware('auth.role')
    ->group(function () {

        //client module rent
        Route::prefix('rent')->name('rent.')->group(function () {

            Route::prefix('dress')->name('dress.')->group(function () {
                Route::get('', [DressCatalogController::class, 'dress'])->name('dress');
                Route::get('list', [ListDressCatalogController::class, 'list'])->name('list');
            });

            Route::prefix('category')->name('category.')->group(function () {
                Route::get('list', [CategoryControllerClientRent::class, 'list'])->name('list');
            });

            Route::prefix('booking')->name('booking.')->group(function () {
                Route::post('save', [SaveBookingClientRentController::class, 'save'])->name('save');
            });

        });

    });

//admin module
Route::prefix('admin')->name('admin.')->group(function () {

    //admin module rent
    Route::prefix('rent')->name('rent.')->group(function () {

        Route
            ::prefix('dress')
            ->name('dress.')
            ->group(function () {
                Route::get('', [DressController::class, 'get'])->name('get');
                Route::get('list', [DressController::class, 'list'])->name('list');
                Route::post('save', [DressController::class, 'save'])->name('save');
                Route::post('delete', [DressController::class, 'delete'])->name('delete');
                Route::post('update', [DressController::class, 'update'])->name('update');
            });

        Route
            ::prefix('component')
            ->name('component.')
            ->withoutMiddleware('auth.role')
            ->group(function () {
                Route::post('save', [ComponentController::class, 'save'])->name('save');
                Route::get('list', [ComponentController::class, 'list'])->name('list');
                Route::post('update', [ComponentController::class, 'update'])->name('update');
            });

        Route
            ::prefix('category')
            ->name('category.')
            ->group(function () {
                Route::get('', [CategoryController::class, 'get'])->name('get');
                Route::get('list', [CategoryController::class, 'list'])->name('list');
                Route::post('save', [CategoryController::class, 'save'])->name('save');
                Route::post('delete', [CategoryController::class, 'delete'])->name('delete');
                Route::get('listClient', [CategoryController::class, 'list'])->name('list');
            });


        Route
            ::prefix('booking')
            ->name('booking.')
            ->group(function () {
                Route::get('list', [BookingController::class, 'list'])->name('list');
                Route::post('save', [BookingController::class, 'save'])->name('save');
                Route::post('cancel', [BookingController::class, 'cancel'])->name('cancel');
                Route::get('status', [BookingController::class, 'status'])->name('status');
            });

        Route
            ::prefix('color')
            ->name('color.')
            ->group(function () {
                Route::get('', [ColorController::class, 'get'])->name('get');
                Route::post('save', [ColorController::class, 'save'])->name('save');
                Route::get('list', [ColorController::class, 'list'])->name('list');
                Route::post('delete', [ColorController::class, 'delete'])->name('delete');
            });

        Route
            ::prefix('size')
            ->name('size.')
            ->group(function () {
                Route::get('', [SizeController::class, 'get'])->name('get');
                Route::post('save', [SizeController::class, 'save'])->name('save');
                Route::get('list', [SizeController::class, 'list'])->name('list');
                Route::post('delete', [SizeController::class, 'delete'])->name('delete');
            });

        Route
            ::prefix('photo')
            ->name('photo.')
            ->group(function () {
                Route::get('', [PhotoController::class, 'get'])->name('get');
                Route::post('save', [PhotoController::class, 'save'])->name('save');
                Route::get('list', [PhotoController::class, 'list'])->name('list');
                Route::post('delete', [PhotoController::class, 'delete'])->name('delete');
            });

        Route
            ::prefix('user')
            ->name('user.')
            ->group(function () {
                Route::get('', [UserController::class, 'get'])->name('get');
                Route::post('save', [UserController::class, 'save'])->name('save');
                Route::get('list', [UserController::class, 'list'])->name('list');
                Route::post('delete', [UserController::class, 'delete'])->name('delete');
            });

    });
});



