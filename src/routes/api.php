<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\DressCategoryController;
use App\Http\Controllers\DressController;
use App\Http\Controllers\DressUserController;
use App\Http\Controllers\MainController;
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
/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

//Route::get('/', function () {
//    return view('home');
//});




Route::prefix('dress')->name('dress.')->group(function () {
    // /api/dress?
    Route::get('', [DressController::class, 'get'])->name('get');

    // api/dress/list
    Route::get('list', [DressController::class, 'list'])->name('list');

    // api/dress/save
    Route::post('save', [DressController::class, 'save'])->name('save');

    // api/category/delete
    Route::delete('delete', [DressController::class, 'delete'])->name('delete');

//     /api/dress/get
    Route::get('get', [DressController::class, 'get'])->name('get');


    Route::resource('dress', DressController::class);

});
///////////////////////////////////////////////////////////////////////////////////////////////////////

Route::prefix('category')->name('category.')->group(function () {
    // /api/category?
    Route::get('', [CategoryController::class, 'get'])->name('save');

    // api/category/save
    Route::post('save', [CategoryController::class, 'save'])->name('save');
});
///////////////////////////////////////////////////////////////////////////////////////////////////////

Route::prefix('user')->name('user.')->group(function () {
    // /api/user?
    Route::get('', [UserController::class, 'get'])->name('save');

    // api/user/save
    Route::post('save', [UserController::class, 'save'])->name('save');
});
/////////////////////////////////////////////////////////////////////////////////////////////////////////

Route::prefix('dress_category')->name('dress_category.')->group(function () {
    // api/dress_category/save
    Route::post('save', [DressCategoryController::class, 'save'])->name('save');
});
/////////////////////////////////////////////////////////////////////////////////////////////////////////

Route::prefix('dress_user')->name('dress_user.')->group(function () {
    // api/dress_user/save
    Route::post('save', [DressUserController::class, 'save'])->name('save');
});
/////////////////////////////////////////////////////////////////////////////////////////////////////////

Route::prefix('color')->name('color.')->group(function () {
    // /api/category?
    Route::get('', [CategoryController::class, 'get'])->name('save');

    // api/category/save
    Route::post('save', [ColorController::class, 'save'])->name('save');
});

/////////////////////////////////////////////////////////////////////////////////////////////////////////

Route::prefix('photo')->name('photo.')->group(function () {
    // /api/photo?
    Route::get('', [DressController::class, 'get'])->name('get');

    // api/photo/list
    Route::get('list', [DressController::class, 'list'])->name('list');
});


//
//Route::get('home', [MainController::class, 'get']);
