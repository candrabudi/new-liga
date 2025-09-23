<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinanceSetting extends Model
{
    protected $fillable = [
        'min_deposit',
        'max_deposit',
        'min_withdraw',
        'max_withdraw',
    ];
}
