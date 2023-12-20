<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['comment', 'rate', 'user_id', 'place_id', 'file_review'];
    
    
    
    // RELATION AVEC LA TABLE USER
    public function users() : HasOne
    {
        return $this->hasOne(User::class);
    }
    
    // RELATION AVEC LA TABLE PLACE
    public function place() : HasOne
    {
        return $this->HasOne(Place::class);
    }

    // RELATION AVEC LA TABLE SUBLIKE
    public function sublikes() : HasMany
    {
        return $this->hasMany(Sublike::class);
    }

    // RELATION AVEC LA TABLE PICTURE
    public function pictures() : HasMany
    {
        return $this->hasMany(Picture::class);
    }
}
