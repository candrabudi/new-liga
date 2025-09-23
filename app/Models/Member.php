<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
        'user_id',
        'ext_code',
        'referrer_code',
        'payment_channel_id',
        'account_name',
        'account_number',
        'balance',
        'is_active',
        'is_verified',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function paymentChannel()
    {
        return $this->belongsTo(PaymentChannel::class);
    }
}
