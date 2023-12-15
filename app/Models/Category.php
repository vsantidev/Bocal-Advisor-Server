<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name_category'];

/*     public function place():HasMany
    {
        return $this->HasMany(Place::class);
    } */
    public function places(): HasMany
    {
        return $this->hasMany(Place::class);
    }
}
