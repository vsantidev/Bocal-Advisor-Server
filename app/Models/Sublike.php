<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Sublike extends Model
{
    use HasFactory;

    protected $fillable = ['name_react', 'user_id', 'review_id'];

    // RELATION AVEC LA TABLE USER
    public function users() : HasOne
    {
        return $this->hasOne(User::class);
    }

    // RELATION AVEC LA TABLE REVIEW
    public function reviews() : HasOne
    {
        return $this->hasOne(Review::class);
    }
    
}
