<?php

namespace App\Http\Controllers\Users;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
   
    
    public function index()
    {
        $products = Product::paginate(10);
        return \view('users.products.index',compact('products'));
    }

   
    public function create()
    {
        $categories = Category::getActive()->get();
        // return $categories;
        return \view('users\products\create',\compact('categories'));
    }

    
    public function store(ProductRequest $request)
    {
        // return $request;

        try 
        {
            // SAVE STATUS
                if (!$request->has('active')) 
                {
                $request->request->add(['active' => 0]);
                }else
                {
                    $request->request->add(['active' => 1]);
                }
            
            // CREATE ALL DATA
            
            DB::beginTransaction();
            
                $create = Product::create(
                    [
                        'name'              => $request->name,
                        'category_id'       => $request->category_id,
                        'price'             => $request->price,
                        'desc'              => $request->desc,
                    ]);
                    $create->active = $request->active;
                    $create->save();
            DB::commit();
                    return \redirect()->route('products')->with(['success' => 'A New Product Added Successfaly']);

        } catch (\Throwable $th) 
        {
            return $th;
            DB::rollback();
            return \redirect()->route('products')->with(['errors' => 'We Have An Error Please Try Again Later']);
        }

    }

   
    public function show(Product $product)
    {
        //
    }

    
    public function edit($id)
    {
        try 
        {
            $product = Product::find($id);
            if (!$product) 
            {
               return \redirect()->route('products')->with(['errors' => 'This Product Not Found']);
            }else
            {
                $categories  = Category::getActive()->get();
                // return $categories;
                return \view('users\products\edit',\compact('product','categories'));
            }
            // return $product;
            
        } catch (\Throwable $th) 
        {
            return $th;
            return \redirect()->route('products')->with(['errors' => 'We Have An Error Please Try Again Later']);
        }
    }

   
    public function update(ProductRequest $request,$id)
    {
        try 
        {
            $product = Product::find($id);
            if (!$product) 
            {
               return \redirect()->route('products')->with(['errors' => 'This Product Not Found']);
            }else
            {
              // UPDATE STATUS
                    if (!$request->has('active')) 
                    {
                    $request->request->add(['active' => 0]);
                    }else
                    {
                        $request->request->add(['active' => 1]);
                    }

                // UPDATE ALL DATA
            
                DB::beginTransaction();
                
                  $product->update(
                    [
                        'name'              => $request->name,
                        'category_id'       => $request->category_id,
                        'price'             => $request->price,
                        'desc'              => $request->desc,
                    ]);
                    $product->active = $request->active;
                    $product->save();
            DB::commit();
                    return \redirect()->route('products')->with(['success' => 'A New Product Added Successfaly']);
            }
            
            
        } catch (\Throwable $th) 
        {
            return $th;
            DB::rollback();
            return \redirect()->route('products')->with(['errors' => 'We Have An Error Please Try Again Later']);
        }
    }

   
    public function delete($id)
    {
        try 
        {
            $product = Product::with('ProductesImages')->find($id);

            if (!$product) 
            {
               return \redirect()->route('products')->with(['errors' => 'This Product Not Found']);
            }else
            {
               if ($product->active == 1) 
               {
                   return \redirect()->back()->with(['errors' => 'Make Product Un Ative Before Delete It']);

               }else
               {
                // CHECK IF CATEGORY HAVE ACTIVE PRODUCT  
                    
                     $active_photos = $product->ProductesImages->where('active',1)->count();
                     $unActive_photos = $product->ProductesImages->where('active',0);
                  
                  
                      if ($active_photos != 0)  
                      {
                          return \redirect()->route('products')->with(['errors' => 'This Product Have Active Photos']);
                      }else
                      {
                // CHANGE CATEGORY STATUS
                          if ($product->active == 1) 
                          {
                            return \redirect()->back()->with(['errors' => 'Product Must Be Un Activate To Delete']);
                          }else
                          {
                              
                DB::beginTransaction();
                              
                              Storage::disk('public')->delete('public/assets/images/',$product->photo);
                              
                              foreach ($unActive_photos as $pro) 
                              {
                                  $pro->delete();
                              }
                              $product->delete();
                DB::commit();
                              return \redirect()->route('products')->with(['success' => 'Product Deleted Successfaly']);
                           }
                      }
               }
            }
 
        } catch (\Throwable $th) 
        {
            return $th;
            DB::rollback();
            return \redirect()->route('products')->with(['errors' => 'We Have An Error Please Try Again Later']);
        }
    }

    public function status($id)
    {
        try 
        {
            $product = Product::with('ProductesImages')->find($id);
                    if (!$product) 
                    {
                    return \redirect()->route('products')->with(['errors' => 'This Product Not Found']);
                    }else
                    {

            // CHECK IF PRODUCT HAVE ACTIVE PHOTOS
                    $active_photos = $product->ProductesImages->where('active',1)->count();
                    // return $active_photos;
                    if ($active_photos != 0)  
                    {
                        return \redirect()->route('products')->with(['errors' => 'This Product Have Active Photos']);
                    }else
                    {
                // CHANGE CATEGORY STATUS
                        if ($product->active == 1) 
                        {
                            $product->update(
                                [
                                        'active' => 0
                                ]);
                                return \redirect()->back()->with(['success' => 'Product Is Un Activate Successfaly']);

                        }else
                        {
                                $product->update(
                                    [
                                        'active' => 1
                                    ]);
                                    return \redirect()->back()->with(['success' => 'Product Is Activate Successfaly']);
                        }
                    }
                }
 
        } catch (\Throwable $th) 
        {
            return $th;
            return \redirect()->route('products')->with(['errors' => 'We Have An Error Please Try Again Later']);
        }
    }
}
