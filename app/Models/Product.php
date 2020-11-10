<?php

namespace App\Models;

use App\Models\Category;
use App\Models\ProductPhoto;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "products";

    protected $fillable = 
    [
        'name','category_id','desc','price','active'
    ];

// SCOPES

    public function scopeGetActive($qry)
    {
        return $qry->where(['active' => 1]);
    }
// RELATIONES

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function ProductesImages()
    {
        return $this->hasMany(ProductPhoto::class);
    }

// GENERALES
    public function status()
    {
        return $this->active == 0 ? 'Not Active' : 'Active';
    }


}
