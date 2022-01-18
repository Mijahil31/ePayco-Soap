<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Wallet;

class WalletController extends Controller
{

    public function consultarSaldo(Request $request)
    {
        try {

            $billetera = Wallet::whereHas('user', function ($query) use ($request){
                $query->where('document', $request->document)
                      ->where('phone', $request->phone);
            })->first();

            foreach($billetera->usuario as $users){}

            $data = [
                'success' => 'true',
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

        } catch (\Throwable $th) {

            $data = [
                'success' => 'false',
                'cod_error' => 404,
                'message_error'=>'Usuario no existe'
            ];

            return response()->xml($data);
        }

    }

    public function recargarBilletera(Request $request){

        try {

            $billetera = Wallet::whereHas('user', function ($query) use ($request){
                $query->where('document', $request->document)
                      ->where('phone', $request->phone);
            })->first();

            foreach($billetera->usuario as $users){}

            $billetera_value = $billetera->value + $request->value;

            $billetera_update = Wallet::whereHas('user', function ($query) use ($request){
                $query->where('document', $request->document)->where('phone', $request->phone);
            })->update([
                'value'=> $billetera_value
            ]);

            $data = [
                'success' => 'true',
                'cod_error' => 00,
                'data'=>[
                    'id'=>$billetera->usuario->id,
                    'name'=>$billetera->usuario->name,
                    'email'=>$billetera->usuario->email,
                    'document'=>$billetera->usuario->document,
                    'phone'=>$billetera->usuario->phone,
                    'wallet'=>$billetera_value
                ]
            ];
            return response()->xml($data);

        } catch (\Throwable $th) {

            $data = [
                'success' => 'false',
                'cod_error' => 505,
                'message_error'=>'Error al recargar billetera'
            ];

            return response()->xml($data);
        }
    }

}
