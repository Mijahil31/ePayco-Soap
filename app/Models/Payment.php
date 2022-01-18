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
        'id_user_payments',
        'code'
    ];


    public function Wallet()
    {
        return $this->hasOne(Wallet::class, 'id', 'id_walltet');
    }

    /**
     * Get all of the comments for the Payment
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function user_payments(): HasMany
    {
        return $this->hasMany(User::class, 'id', 'id_user_payments');
    }
}
