<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Wallet;

class UserController extends Controller
{

    public function registro_cliente(Request $request)
    {
        try {

            $user_creado = User::create([
                'name'=> $request->name,
                'email'=> $request->email,
                'document'=>$request->document,
                'phone'=>$request->phone,
            ]);

            $wallet = Wallet::create([
                'id_user' => $user_creado->id,
                'value' => 0.0
            ]);

            $data = [
                'success' => 'true',
                'cod_error' => 00,
                'data'=>'Usuario Creado con exito'
            ];
            return response()->xml($data);

        } catch (\Throwable $th) {

            $data = [
                'success' => 'false',
                'cod_error' => 505,
                'message_error'=>'Error al crear usuario'
            ];
            return response()->xml($data);
        }

    }

    public function show($id)
    {
        try {

            $usuario = User::find($id);

            $data = [
                'success' => 'true',
                'cod_error' => 00,
                'data'=>[
                    'id'=>$usuario->id,
                    'name'=>$usuario->name,
                    'email'=>$usuario->email,
                    'document'=>$usuario->document,
                    'phone'=>$usuario->phone
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

    public function consultaUsuario(Request $request){

        try {
            $usuario = User::where('document', $request->document)->where('phone', $request->phone)->first();
            $data = [
                'success' => 'true',
                'cod_error' => 00,
                'data'=>[
                    'id'=>$usuario->id,
                    'name'=>$usuario->name,
                    'email'=>$usuario->email,
                    'document'=>$usuario->document,
                    'phone'=>$usuario->phone
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

}
