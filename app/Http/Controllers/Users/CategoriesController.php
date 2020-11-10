<?php

namespace App\Http\Controllers\Users;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\Storage;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(10);
        return \view('users.categories.index',\compact('categories'));
    }

    public function create()
    {
        return \view('users.categories.create');
    }

    public function store(CategoryRequest $request)
    {
        
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
            
                $create = Category::create(
                    [
                        'name'      => $request->name,
                        'photo'     => $request->photo->store('category','public'),
                    ]);
                    $create->active = $request->active;
                    $create->save();
            DB::commit();
                    return \redirect()->route('categories')->with(['success' => 'A New Category Added Successfaly']);

        } catch (\Throwable $th) 
        {
            return $th;
            DB::rollback();
            return \redirect()->route('categories')->with(['errors' => 'We Have An Error Please Try Again Later']);
        }
    }

    public function edit($id)
    {
        try 
        {
            // GET CATEGORY
                $category = Category::find($id);

            // CHECK IF CATEGORY IS FOUND 
                if (!$category) 
                {
                   return \redirect()->route('categories')->with(['errors' => 'This Category Not Found']);
                }else
                {
                    return \view('users.categories.edit',compact('category'));
                }

        } catch (\Throwable $th) 
        {
            return $th;
            return \redirect()->route('categories')->with(['errors' => 'We Have An Error Please Try Again Later']);
        }
    }

    public function update(CategoryRequest $request,$id)
    {
        try 
        {
            // GET CATEGORY
                $category = Category::find($id);

            // CHECK IF CATEGORY IS FOUND 
                if (!$category) 
                {
                   return \redirect()->route('categories')->with(['errors' => 'This Category Not Found']);
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

                // UPDATE DATA
                
                DB::beginTransaction();
                
                    $category->update(
                        [
                            'name'      => $request->name,
                            
                        ]);

                        $category->active = $request->active;
                        $category->save();
               

                // UPDATE IMAGE
                    if ($request->hasFile('photo')) 
                    {
                        Storage::disk('public')->delete('public/assets/images/',$category->photo);
                        $save_image = $request->photo->store('category','public');
                        $category->photo = $save_image;
                        $category->save();
                    }
                
                DB::commit();
                        return \redirect()->route('categories')->with(['success' => 'Update Category Successfaly']);
                }

        } catch (\Throwable $th) 
        {
            return $th;
            DB::rollback();
            return \redirect()->route('categories')->with(['errors' => 'We Have An Error Please Try Again Later']);
        }
    }






    public function delete($id)
    {
        try 
        {
            // GET CATEGORY
                $category = Category::with('products')->find($id);

            // CHECK IF CATEGORY IS FOUND 
                if (!$category) 
                {
                   return \redirect()->route('categories')->with(['errors' => 'This Category Not Found']);
                }else
                {
                   
                    // CHECK IF CATEGORY HAVE ACTIVE PRODUCT  
                    
                       $active_products = $category->products->where('active',1)->count();
                       $unActive_products = $category->products->where('active',0);
                    //    return $unActive_products;
                    
                        if ($active_products != 0)  
                        {
                            return \redirect()->route('categories')->with(['errors' => 'This Category Have Active Products']);
                        }else
                        {
                    // CHANGE CATEGORY STATUS
                            if ($category->active == 1) 
                            {
                              return \redirect()->back()->with(['errors' => 'category Must Be Un Activate To Delete']);
                            }else
                            {
                                Storage::disk('public')->delete('public/assets/images/',$category->photo);
                                
                                foreach ($unActive_products as $cats) 
                                {
                                    $cats->delete();
                                }
                                $category->delete();
                                return \redirect()->route('categories')->with(['success' => 'Category Deleted Successfaly']);
                             }
                        }
                }

            } catch (\Throwable $th) 
            {
                return $th;
                return \redirect()->route('categories')->with(['errors' => 'We Have An Error Please Try Again Later']);
            }
    }

    public function status($id)
    {
        try 
        {
            // GET CATEGORY
                $category = Category::with('products')->find($id);
                // return $category;

            // CHECK IF CATEGORY IS FOUND 
                if (!$category) 
                {
                   return \redirect()->route('categories')->with(['errors' => 'This Category Not Found']);
                }else
                {
                  
                    // CHECK IF CATEGORY HAVE ACTIVE PRODUCT  
                       $active_products = $category->products->where('active',1)->count();
                    //    return $active_products;
                        if ($active_products != 0)  
                        {
                            return \redirect()->route('categories')->with(['errors' => 'This Category Have Active Products']);
                        }else
                        {
                    // CHANGE CATEGORY STATUS
                            if ($category->active == 1) 
                            {
                                $category->update(
                                    [
                                         'active' => 0
                                    ]);
                                    return \redirect()->back()->with(['success' => 'category Is Un Activate Successfaly']);
             
                            }else
                            {
                                 $category->update(
                                     [
                                         'active' => 1
                                     ]);
                                     return \redirect()->back()->with(['success' => 'category Is Activate Successfaly']);
                             }
                        }
                }

        } catch (\Throwable $th) 
        {
            return $th;
            return \redirect()->route('categories')->with(['errors' => 'We Have An Error Please Try Again Later']);
        }
    }
}
