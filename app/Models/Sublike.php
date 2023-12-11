<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sublike extends Model
{
    use HasFactory;

    protected $fillable = ['name_react', 'user_id', 'review_id'];

}
