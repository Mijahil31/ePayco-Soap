<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Payment;
use App\Models\Wallet;
use App\Models\ConfirmPayment;

class PaymentController extends Controller
{
    /* Funcion para pagar*/
    public function pagar(Request $request){
        $billetera = Wallet::whereHas('user', function ($query) use ($request){
            $query->where('document', $request->document)
                  ->where('phone', $request->phone);
        })->first();

        foreach($billetera->usuario as $users){}

        if ($billetera->value >= $request->pago) {
            $pago = Payment::create([
                'id_walltet' => $billetera->id,
                'value' => $request->value,
                'description'=> $request->description,
                'id_user_payments'=> $request->id_user_payments
            ]);


        }
    }


    /* Funcion para confirmar el pago*/
    public function confirmarPago(Request $request){

    }
}
