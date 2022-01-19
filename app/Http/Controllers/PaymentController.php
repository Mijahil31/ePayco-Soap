<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Payment;
use App\Models\Wallet;
use App\Mail\Confirmacion;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{
    /* Funcion para pagar*/
    public function pagar(Request $request){


        try {

            $billetera = Wallet::whereHas('user', function ($query) use ($request){
                $query->where('document', $request->document)
                      ->where('phone', $request->phone);
            })->first();

            foreach($billetera->usuario as $users){}

            if ($billetera->value >= $request->value) {
                $pago = Payment::create([
                    'id_walltet' => $billetera->id,
                    'value' => $request->value,
                    'code' => rand(100000,999999),
                    'description'=> $request->description,
                    'id_user_payments'=> $request->id_user_payments
                ]);

                Mail::to($billetera->usuario->email)->send(new Confirmacion($pago));
                $data = [
                    'success' => true,
                    'cod_error' => 00,
                    'data'=>[
                        'id'=>$billetera->usuario->id,
                        'name'=>$billetera->usuario->name,
                        'email'=>$billetera->usuario->email,
                        'document'=>$billetera->usuario->document,
                        'phone'=>$billetera->usuario->phone,
                        'wallet'=>$billetera->value
                    ]
                ];
                return response()->xml($data);
            }else{

                $data = [
                    'success' => false,
                    'cod_error' => 504,
                    'data'=>'No tiene saldo suficiente'
                ];
                return response()->xml($data);
            }

        } catch (\Throwable $th) {
            $data = [
                'success' => false,
                'cod_error' => 505,
                'data'=>'Error al pagar'
            ];
            return response()->xml($data);
        }

    }


    /* Funcion para confirmar el pago*/
    public function confirmarPago(Request $request){

        try {

            $pago = Payment::where('code', $request->code)->first();
            foreach ($pago->wallet->usuario as $payment){}

            if ($pago->wallet->value >= $pago->value) {

                Payment::where('code', $request->code)
                        ->update([
                            'confirm'=>true
                        ]);

                $saldo = Wallet::find($pago->wallet->id);
                $saldo = $saldo->value - $pago->value;

                Wallet::where('id', $pago->wallet->id)
                        ->update([
                        'value' => $saldo
                        ]);

                $billetera = Wallet::whereHas('user', function ($query) use ($pago){
                    $query->where('id', $pago->id_user_payments);
                })->first();

                $saldo_ = $billetera->value + $pago->value;

                Wallet::where('id', $billetera->id)
                        ->update([
                            'value'=> $saldo_
                        ]);

                $data = [
                    'success' => true,
                    'cod_error' => 00,
                    'data'=>'Pago completado con exito'
                ];
                return response()->xml($data);

            } else {

                $data = [
                    'success' => false,
                    'cod_error' => 504,
                    'data'=>'No posee saldo disponible'
                ];
                return response()->xml($data);
            }

        } catch (\Throwable $th) {

            $data = [
                'success' => false,
                'cod_error' => 505,
                'data'=>'Error al procesar confirmacion del pago'
            ];
            return response()->xml($data);

        }


    }
}
