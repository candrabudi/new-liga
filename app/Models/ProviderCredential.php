<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProviderCredential extends Model
{
    protected $fillable = [
        'url',
        'agent_code',
        'agent_token',
    ];
}
