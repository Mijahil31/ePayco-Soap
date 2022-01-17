<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Wallet;
use App\Model\User;

class Payment extends Model
{
    use HasFactory;
    protected $table = 'payments';
    protected $primaryKey  = 'id';

    protected $fillable = [
        'id_walltet',
        'value',
        'description',
        'id_user_payments'
    ];


    public function Wallet()
    {
        return $this->hasOne(Wallet);
    }

    public function user_payments()
    {
        return $this->hasOne(User);
    }
}
