<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Selected_pictures_review extends Model
{
    use HasFactory;

    protected $fillable = ['review_id', 'picture_review_id'];

}
