<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Picture extends Model
{
    use HasFactory;

    protected $fillable = ['name'];


    
    // RELATION AVEC LA TABLE REVIEW
    public function reviews() : HasOne
    {
        return $this->hasOne(Review::class);
    }

    
    // RELATION AVEC LA TABLE REVIEW
    public function places() : HasOne
    {
        return $this->hasOne(Place::class);
    }
}
