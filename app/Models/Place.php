<?php

namespace App\Models;

use App\Http\Controllers\PlaceController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Place extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'street', 'postcode', 'city', 'description', 'x', 'y', 'category_id', 'file'];

    /*     public static function getAll()
    {
        return Place::select('places.*', 'categories.name_category as category')
            ->join('categories', 'places.category_id', '=', 'categories.id')
            ->orderBy('name_category')
            ->get();
    }
 */
    public function Category(): HasOne
    {
        return $this->HasOne(Category::class);
    }

    public function getCategory()
    {
        $category = Category::find($this->category_id);
        return $category->name_category;
    }

    public function categories()
    {
        return $this->belongsTo(Category::class);
    }
}
