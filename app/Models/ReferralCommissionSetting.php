<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReferralCommissionSetting extends Model
{
    protected $fillable = [
        'percentage',
        'min_deposit',
        'max_commission',
        'is_active',
    ];
}
