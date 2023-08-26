<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ExampleController;
use App\Http\Controllers\Web\CartController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [LoginController::class, 'login']);
Route::post('refresh', [LoginController::class, 'refresh']);
Route::get('listUser', [LoginController::class, 'listUser'])->middleware('jwt.auth');
Route::get('list', [ExampleController::class, 'index']);