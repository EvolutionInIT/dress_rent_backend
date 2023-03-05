<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\DressCategoryController;
use App\Http\Controllers\DressController;
use App\Http\Controllers\DressUserController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('dress')->name('dress.')->group(function () {
    // /api/dress?
    Route::get('', [DressController::class, 'get'])->name('get');

    // api/dress/list
    Route::get('list', [DressController::class, 'list'])->name('list');

//    // api/dress/save
//    Route::post('save', [DressController::class, 'save'])->name('save');
//
//    // api/dress/delete
//    Route::delete('delete', [DressController::class, 'delete'])->name('delete');
//
//    // api/dress/update
//    Route::patch('update', [DressController::class, 'update'])->name('update');
});
///////////////////////////////////////////////////////////////////////////////////////////////////////

Route::prefix('category')->name('category.')->group(function () {
//    // /api/category/get
//    Route::get('', [CategoryController::class, 'get'])->name('get');
//
//    // api/category/save
//    Route::post('save', [CategoryController::class, 'save'])->name('save');
//
    // api/category/list
    Route::get('list', [CategoryController::class, 'list'])->name('list');
//
//    // api/category/delete
//    Route::delete('delete', [CategoryController::class, 'delete'])->name('delete');
});
/////////////////////////////////////////////////////////////////////////////////////////////////////////
//
//Route::prefix('user')->name('user.')->group(function () {
//    // /api/user?
//    Route::get('', [UserController::class, 'get'])->name('get');
//
//    // api/user/save
//    Route::post('save', [UserController::class, 'save'])->name('save');
//
//    // api/user/list
//    Route::get('list', [UserController::class, 'list'])->name('list');
//
//    // api/user/delete
//    Route::delete('delete', [UserController::class, 'delete'])->name('delete');
//});
///////////////////////////////////////////////////////////////////////////////////////////////////////////
//
//Route::prefix('dress_category')->name('dress_category.')->group(function () {
//    // api/dress_category/save
//    Route::post('save', [DressCategoryController::class, 'save'])->name('save');
//});
///////////////////////////////////////////////////////////////////////////////////////////////////////////
//
//Route::prefix('dress_user')->name('dress_user.')->group(function () {
//    // api/dress_user/save
//    Route::post('save', [DressUserController::class, 'save'])->name('save');
//});
///////////////////////////////////////////////////////////////////////////////////////////////////////////
//
//Route::prefix('color')->name('color.')->group(function () {
//    // /api/color?
//    Route::get('', [ColorController::class, 'get'])->name('get');
//
//    // api/color/save
//    Route::post('save', [ColorController::class, 'save'])->name('save');
//
//    // api/color/list
//    Route::get('list', [ColorController::class, 'list'])->name('list');
//
//    // api/color/delete
//    Route::delete('delete', [ColorController::class, 'delete'])->name('delete');
//});
//
///////////////////////////////////////////////////////////////////////////////////////////////////////////
//
//Route::prefix('photo')->name('photo.')->group(function () {
//    // /api/photo?
//    Route::get('', [PhotoController::class, 'get'])->name('get');
//
//    // api/photo/save
//    Route::post('save', [PhotoController::class, 'save'])->name('save');
//
//    // api/photo/list
//    Route::get('list', [PhotoController::class, 'list'])->name('list');
//
//    // api/photo/delete
//    Route::delete('delete', [PhotoController::class, 'delete'])->name('delete');
//});
//
///////////////////////////////////////////////////////////////////////////////////////////////////////////
//
//Route::prefix('size')->name('size.')->group(function () {
//    // /api/size?
//    Route::get('', [SizeController::class, 'get'])->name('get');
//
//    // api/size/save
//    Route::post('save', [SizeController::class, 'save'])->name('save');
//
//    // api/size/list
//    Route::get('list', [SizeController::class, 'list'])->name('list');
//
//    // api/size/delete
//    Route::delete('delete', [SizeController::class, 'delete'])->name('delete');
//});
//
///////////////////////////////////////////////////////////////////////////////////////////////////////////
//
//Route::prefix('booking')->name('booking.')->group(function () {
//
//    // api/booking/list
//    Route::get('list', [BookingController::class, 'list'])->name('list');
//
//    // api/booking/save
//    Route::post('save', [BookingController::class, 'save'])->name('save');
//
//    // api/booking/cancel
//    Route::patch('cancel', [BookingController::class, 'cancel'])->name('cancel');
//
//    // api/booking/status
//    Route::get('status', [BookingController::class, 'status'])->name('status');
//
//    // api/booking/available
//    Route::get('available', [BookingController::class, 'available'])->name('available');
//});
/////////////////////////////////////////////////////////////////////////////////////////////////////////


