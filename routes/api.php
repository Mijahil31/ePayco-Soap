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

Route::post('/user', [UserController::class, 'registro_cliente']); /* Se registra el usuario */
Route::get('/user/{id}', [UserController::class, 'show']); /* Se muestra el usuario desde el id */
Route::get('/user', [UserController::class, 'consultaUsuario']); /* Se consulta el usuario mediante sus datos */

Route::put('/wallet', [WalletController::class, 'recargarBilletera']); /* Se recarga la billetera */
Route::get('/wallet', [WalletController::class, 'consultarSaldo']); /* Se consulta el saldo actual de la billetera */

Route::post('/payment', [PaymentController::class, 'pagar']); /* ruta para pagar */
Route::put('/payment', [PaymentController::class, 'confirmarPago']); /* Ruta para confirmar el pago */
