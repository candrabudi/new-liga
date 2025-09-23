<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = [
        'provider_id',
        'name',
        'game_code',
        'game_image',
        'main_category',
        'sort_order',
        'is_maintenance',
    ];

    // Relasi ke provider
    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

    // Relasi ke categories
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'game_categories')
            ->withPivot('seq_no')
            ->withTimestamps();
    }

    // Relasi ke users yang favourite game ini
    public function favouritedBy()
    {
        return $this->belongsToMany(User::class, 'favourites')
            ->withTimestamps();
    }
}
