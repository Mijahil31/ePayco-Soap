<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Payment;
use App\Models\User;

class ConfirmPayment extends Model
{
    use HasFactory;
    protected $table = 'confirm_payments';
    protected $primaryKey  = 'id';

    protected $fillable = [
        'id_user',
        'id_payments',
        'code'
    ];


    public function User()
    {
        return $this->hasOne(User);
    }

    public function Payment()
    {
        return $this->hasOne(Payment);
    }
}
