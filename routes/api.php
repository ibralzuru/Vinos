<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
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

Route::get('/', function () {
    return "Welcome to my store";
});

// Rutas de Registro
Route::post('/register', [UserController::class, 'register']);


//login
Route::post('/login', [UserController::class, 'login']);

//logout
Route::group(
    ['middleware' => 'jwt.auth'],
    function () {
        Route::get('/logout', [UserController::class, 'logout']);
        Route::get('/profile', [UserController::class, 'profile']);
        Route::put('/profile/update', [UserController::class, 'update']);
    }
);
//product
Route::group(
    ['middleware' => 'jwt.auth'],
    function () {
        Route::post('/create', [ProductController::class, 'create']);
        Route::get('/get/{id}', [ProductController::class, 'getProductId']);
        Route::post('/edit/{id}', [ProductController::class, 'editProductById']);
        Route::get('/get', [ProductController::class, 'getAllProducts']);
        Route::delete('/delete/{id}', [ProductController::class, 'deleteProductById']);
    }
);
