<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'platform',
        'name',
        'link',
        'icon',
        'is_active',
    ];
}
