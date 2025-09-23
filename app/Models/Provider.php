<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    protected $fillable = [
        'name',
        'code',
        'sort_order',
        'logo',
        'path_image',
        'is_maintenance',
    ];

    public function games()
    {
        return $this->hasMany(Game::class);
    }
}
