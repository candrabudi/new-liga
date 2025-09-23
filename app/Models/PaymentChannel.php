<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentChannel extends Model
{
    protected $fillable = [
        'type',
        'name',
        'code',
        'slug',
        'logo',
        'is_active',
        'metadata'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'metadata' => 'array',
    ];

    public function owners()
    {
        return $this->hasMany(PaymentOwner::class, 'payment_channel_id');
    }
}
