<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class ProductPhoto extends Model
{
    protected $table = "product_photos";
    protected $fillable = 
    [
        'product_id','photo','active','type'
    ];



// SCOPES
    // GET ACTIVE PRODUCT PHOTOS
    public function scopeGetActive($qry)
    {
        $qry->where('active',1);
    }

    
// RELATIONS
    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }

// GENERAL
    public function status()
    {
        return $this->active == 0 ? 'Not Active' : 'Active';
    }

    public function type()
    {
        return $this->type == 0 ? 'Sub Photo' : 'Main Photo';
    }
}
