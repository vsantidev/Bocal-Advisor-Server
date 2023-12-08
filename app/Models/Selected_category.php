<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Selected_category extends Model
{
    use HasFactory;

    protected $fillable = ['place_id', 'category_id'];

}
