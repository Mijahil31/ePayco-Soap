<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Payment;


class Confirmacion extends Mailable
{
    use Queueable, SerializesModels;

    public $pago;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Payment $pago)
    {
        $this->pago = $pago;
        foreach($this->pago->Wallet as $wallet){}
        // foreach($this->pago->user_payments as $users){}
        foreach($this->pago->Wallet->usuario as $usuario_wallet){}
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.confirmacion');
    }
}
