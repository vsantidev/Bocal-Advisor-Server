<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'password',
        'username',
        'birthday',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // RELATION AVEC LA TABLE PLACE
    public function places() : HasMany
    {
        return $this->hasMany(Place::class);
    }

    // RELATION AVEC LA TABLE REVIEW
    public function reviews() : HasMany
    {
        return $this->hasMany(Review::class);
    }

    // RELATION AVEC LA TABLE SUBLIKES
    public function sublikes() : HasMany
    {
        return $this->hasMany(Sublike::class);
    }

    // RELATION AVEC LA TABLE PICTURES
    public function pictures() : HasMany
    {
        return $this->hasMany(Picture::class);
    }
}
