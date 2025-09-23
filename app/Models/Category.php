<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'sort_order',
        'is_maintenance',
    ];

    public function games()
    {
        return $this->belongsToMany(Game::class, 'game_categories')
            ->withPivot('seq_no')
            ->withTimestamps();
    }
}
