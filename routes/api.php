<?php

use App\Http\Controllers\API\mobilController;
use App\Http\Controllers\API\sewaController;
use App\Http\Controllers\API\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CustomerController;
use Illuminate\Auth\Events\Login;

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
    // untuk tabel customer ( bebas akses).
    Route::group(['prefix' => 'v1'], function ($router) {
    
        Route::get('customer', [CustomerController::class, 'index']);
    Route::get('customer/{id}', [CustomerController::class, 'show']);
    });
    // Harus Login.
    Route::group(['middleware' => 'auth:api','prefix' => 'v1'], function ($router) {
    //untuk table customer
    Route::post('customer', [CustomerController::class, 'store']);
    Route::put('customer/{id}', [CustomerController::class, 'update']);
    Route::delete('customer/{id}', [CustomerController::class, 'destroy']);
    Route::get('customerR', [CustomerController::class, 'indexRelasi']);
    // untuk tabel products 
    Route::get('mobil', [mobilController::class, 'index']);
    Route::get('mobil/{id}', [mobilController::class, 'show']);
    Route::post('mobil', [mobilController::class, 'store']);
    Route::put('mobil/{id}', [mobilController::class, 'update']);
    Route::delete('mobil/{id}', [mobilController::class, 'destroy']);
    //tes relasi antar tabel
    Route::get('mobilR', [mobilController::class, 'indexRelasi']);

    // untuk tabel sewa tanpa penggunaan resource
    Route::get('sewa', [sewaController::class, 'index']);
    Route::get('sewa/{id}', [sewaController::class, 'show']);
    Route::post('sewa', [sewaController::class, 'store']);
    Route::put('sewa/{id}', [sewaController::class, 'update']);
    Route::delete('sewa/{id}', [sewaController::class, 'destroy']);
    //tes relasi antar tabel
    Route::get('sewaR', [sewaController::class, 'indexRelasi']);
});


Route::group(['middleware' => 'api','prefix' => 'auth'], function ($router) {

    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);

    Route::get('password', function () {
        return bcrypt('nanda08');
    });

});
