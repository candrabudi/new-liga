<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'user_id', 'referred_user_id', 'type', 'trx_type', 'status', 'payment_channel_id',
        'proof', 'updated_by', 'amount', 'reason',
    ];

    public function sourceUser()
    {
        return $this->belongsTo(User::class, 'referred_user_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function paymentChannel()
    {
        return $this->belongsTo(PaymentChannel::class);
    }

    public function paymentOwner()
    {
        return $this->belongsTo(PaymentOwner::class, 'id', 'payment_channel_id');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
