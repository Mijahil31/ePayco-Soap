<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controller\ConfirmPayment;
use App\Http\Controller\UserController;
use App\Http\Controller\WalletController;
use App\Http\Controller\PaymentController;

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

Route::resource('user', UserController::class);
Route::resource('payment', PaymentController::class);
Route::resource('wallet', WalletController::class);
Route::resource('confirm', ConfirmPayment::class);
