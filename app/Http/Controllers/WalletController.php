<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Wallet;

class WalletController extends Controller
{

    public function show($id)
    {
        //
    }

    public function recargarBilletera(Request $request){

        try {

            $usuario = User::where('document', $request->document)->where('phone', $request->phone)->first();
            $id_usuario = $usuario->id;

            $billetera_value = Wallet::where('id_user', $id_usuario)->first();
            $billetera_value = $billetera_value->value + $request->value;

            $billetera = Wallet::where('id_user', $id_usuario)->update(['value'=>$billetera_value]);

            $data = [
                'success' => 'true',
                'cod_error' => 00,
                'data'=>[
                    'id'=>$usuario->id,
                    'name'=>$usuario->name,
                    'email'=>$usuario->email,
                    'document'=>$usuario->document,
                    'phone'=>$usuario->phone,
                    'wallet'=>$billetera_value
                ]
            ];
            return response()->xml($data);

        } catch (\Throwable $th) {

            $data = [
                'success' => 'false',
                'cod_error' => 404,
                'message_error'=>'Error al recargar billetera'
            ];

            return response()->xml($data);
        }
    }

}
