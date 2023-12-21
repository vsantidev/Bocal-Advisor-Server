<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CategoryPlace extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'place_id'];

    public function places(): HasMany
    {
        return $this->hasMany(Place::class);
    }
}
