<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Selected_pictures_places extends Model
{
    use HasFactory;

    protected $fillable = ['place_id', 'picture_id'];

}
