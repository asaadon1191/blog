<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "categories";

    protected $fillable = 
    [
        'name','photo','active'
    ];

    public function status()
    {
        return $this->active == 0 ? 'Not Active' : 'Active';
    }

// SCOPES
    public function scopeGetActive($qry)
    {
        return $qry->where(['active' => 1]);
    }


// RELATIONS
    public function products()
    {
        return $this->hasMany(Product::class);
    }

}
