<?php

namespace App\Http\Controllers\Users;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::getActive()->get();
        return \view('users.welcome',\compact('categories'));
    }

    public function showProducts($id)
    {
        $products = Category::with('products')->find($id);
        $activeProduct = $products->products->where('active',1);
        $active_photos = Product::with('ProductesImages')->getActive()->get();
        // $data = $active_photos->productes_images->where('active',1);
        // return $data;
        return \view('users.categoryProducts',\compact('activeProduct','active_photos'));
    }
}
