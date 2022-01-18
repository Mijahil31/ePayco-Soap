<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConfirmPaymentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\PaymentController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


// Route::resources([
//     'user' => UserController::class,
//     'payment' => PaymentController::class,
//     'wallet' => WalletController::class,
//     'confirm' => ConfirmPaymentController::class,
// ]);

Route::post('/user', [UserController::class, 'registro_cliente']);
Route::get('/user/{id}', [UserController::class, 'show']);
Route::get('/user', [UserController::class, 'consultaUsuario']);
Route::put('/wallet', [WalletController::class, 'recargarBilletera']);
