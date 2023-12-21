<?php

namespace App\Models;

use App\Http\Controllers\PlaceController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Place extends Model
{
    use HasFactory;


    protected $fillable = ['title', 'street', 'postcode', 'city', 'description', 'x', 'y', 'file', 'user_id'];



    // RELATION AVEC LA TABLE CATEGORIE
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    // RELATION AVEC LA TABLE REVIEW
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }



    // RELATION AVEC LA TABLE PICTURE
    public function pictures(): HasMany
    {
        return $this->hasMany(Picture::class);
    }

    // RELATION AVEC LA TABLE USERS
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
