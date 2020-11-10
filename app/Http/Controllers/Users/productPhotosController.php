<?php

namespace App\Http\Controllers\Users;

use App\Models\Product;
use App\Models\ProductPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\productPhotosRequest;

class productPhotosController extends Controller
{
    public function index()
    {
        $photos = ProductPhoto::paginate(10);
        // $photos = ProductPhoto::with('product')->paginate();
        // $photos = Product::getActive()->with('ProductImages')->get();
        // $proPhoto = $photos->ProductesImages->where('active',1);
        // $photo2 = $products->ProductImages->get();
        // return $photos;
        return \view('users.productPhotos.index',\compact('photos'));
    }

    public function create()
    {
        $products = Product::getActive()->get();
        return \view('users.productPhotos.create',\compact('products'));
    }

    public function store(productPhotosRequest $request)
    {
        // GET STATUS
            if (!$request->has('active')) 
            {
                   $request->request->add(['active' => 0]);
            }else
            {
                $request->request->add(['active' => 1]);
            }
        // GET TYPE
            if (!$request->has('type')) 
            {
                $request->request->add(['type' => 0]);
            }else
            {
                $request->request->add(['type' => 1]);
            }
        // CREATE DATA
            $create = ProductPhoto::create(
                [
                    'photo'     => $request->photo->store('productPhotos','public'),
                    'product_id'    => $request->product_id,
                    'type'          => $request->type,
                    'active'        => $request->active
                ]);
            return \redirect()->route('productPhotos')->with(['success' => 'A New Photo Added Succrsfaly']);
    }


    public function edit($id)
    {
        
        $photo = ProductPhoto::find($id);

        if (!$photo) 
        {
           return \redirect()->route('productPhotos')->with(['errors' => 'This Photo Not Found']);
        }else
        {
            $products = Product::getActive()->get();
            return \view('users.productPhotos.edit',compact('photo','products'));
        }
       
        
    }


    public function update(productPhotosRequest $request, $id)
    {
        try 
        {
            $photo = ProductPhoto::find($id);
            if (!$photo) 
            {
                return \redirect()->route('productPhotos')->with(['errors' => 'This Photo Not Found']);

            }else
            {
                $products = Product::getActive()->get();

            // UPDATE STATUS
                if (!$request->has('active')) 
                {
                $request->request->add(['active' => 0]);
                }else
                {
                    $request->request->add(['active' => 1]);
                }

            // UPDATE TYPE
                if (!$request->has('type')) 
                {
                $request->request->add(['type' => 0]);
                }else
                {
                    $request->request->add(['type' => 1]);
                }

            // UPDATE ALL DATA
        
            DB::beginTransaction();

            // CHECK IMAGE
                if ($request->hasFile('photo')) 
                {
                    Storage::disk('public')->delete('public/assets/images/',$photo->photo);
                    $save_image = $request->photo->store('productPhotos','public');
                    $photo->photo = $save_image;
                    $photo->save();
                }
            
              $photo->update(
                [
                    'product_id'       => $request->product_id,
                ]);

                $photo->active = $request->active;
                $photo->type = $request->type;
                $photo->save();
            DB::commit();

                return \redirect()->route('productPhotos')->with(['success' => 'Photo Updated Successfaly']);
            }
            
        } catch (\Throwable $th) 
        {
            return $th;
            return \redirect()->route('productPhotos')->with(['errors' => 'We Have An Error Please Try Again Later']);
        }
    }


    public function delete($id)
    {
        $photo = ProductPhoto::find($id);

        if (!$photo) 
        {
           return \redirect()->route('productPhotos')->with(['errors' => 'This Photo Not Found']);
        }else
        {
           if ($photo->active == 1) 
           {
               return \redirect()->back()->with(['errors' => 'Photo Must Be Un Activate To Delete']);
           }else
           {
                Storage::disk('public')->delete('public/assets/images/',$photo->photo);
                $photo->delete();
                return \redirect()->route('productPhotos')->with(['success' => 'photo Deleted Successfaly']);
           }
        }
    }


    public function status($id)
    {
        $photo = ProductPhoto::find($id);

        if (!$photo) 
        {
           return \redirect()->route('productPhotos')->with(['errors' => 'This Photo Not Found']);
        }else
        {
           if ($photo->active == 1) 
           {
               $photo->update(
                   [
                        'active' => 0
                   ]);
               return \redirect()->back()->with(['success' => 'Photo Un Activated Successfaly']);
           }else
           {
                $photo->update(
                    [
                        'active' => 1
                    ]);
                return \redirect()->back()->with(['success' => 'Photo  Activated Successfaly']);
           }
        }
    }
}
