<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentOwner extends Model
{
    protected $fillable = [
        'payment_channel_id',
        'account_name',
        'account_number',
        'is_active',
        'qris_image'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function channel()
    {
        return $this->belongsTo(PaymentChannel::class, 'payment_channel_id');
    }
}
