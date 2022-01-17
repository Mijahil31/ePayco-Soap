<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Wallet extends Model
{
    use HasFactory;

    protected $table = 'wallet';
    protected $primaryKey  = 'id';

    protected $fillable = [
        'id_user',
        'value',
    ];


    public function User()
    {
        return $this->hasOne(User);
    }
}
