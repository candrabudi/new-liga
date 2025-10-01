<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    protected $fillable = [
        'full_name',
        'username',
        'email',
        'phone_number',
        'password',
        'role',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function member()
    {
        return $this->hasOne(Member::class, 'user_id', 'id');
    }

    public function favouriteGames()
    {
        return $this->belongsToMany(Game::class, 'game_favourites')
            ->withTimestamps();
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function kycDocuments()
    {
        return $this->hasMany(KycDocument::class);
    }

    public function latestKyc()
    {
        return $this->hasOne(KycDocument::class)->latestOfMany();
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
