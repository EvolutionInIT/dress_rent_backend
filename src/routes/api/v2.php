<?php

use App\Http\Controllers\V2\Client\Rent\Booking\SaveBookingClientRentController;
use App\Http\Controllers\V2\Client\Rent\Booking\SomeSaveBookingClientRentController;
use Illuminate\Support\Facades\Route;


//client module
Route
    ::prefix('client')
    ->name('client.')
    ->withoutMiddleware('auth.role')
    ->group(function () {

        //client module rent
        Route::prefix('rent')->name('rent.')->group(function () {

            Route::prefix('booking')->name('booking.')->group(function () {
                Route::post('save', [SaveBookingClientRentController::class, 'save'])->name('save');
            });

            Route::prefix('booking')->name('booking.')->group(function () {
                Route::post('someSave', [SomeSaveBookingClientRentController::class, 'save'])->name('save');
            });

        });

    });




