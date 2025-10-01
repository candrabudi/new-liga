<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'user_id',
        'full_name',
        'gender',
        'address',
        'postcode',
        'state',
        'contact_no',
        'email',
        'telegram',
        'whatsapp',
        'wechat',
        'line',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
